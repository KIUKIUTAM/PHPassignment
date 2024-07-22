<?php
require_once('../../../db/connect.php');
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

session_start();


$dealerEmail = $_SESSION['dealer'] ?? '';

if (empty($dealerEmail)) {
    echo json_encode(['status' => 'fail', 'message' => 'Dealer email not found in session']);
    exit;
}


$stmt = $conn->prepare("SELECT dealerID, deliveryAddress FROM dealer WHERE dealerEmail = ?");
$stmt->bind_param("s", $dealerEmail);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $dealerID = $row['dealerID'];
    $deliveryAddress = $row['deliveryAddress'];
} else {
    echo json_encode(['status' => 'fail', 'message' => 'Dealer not found']);
    exit;
}


$data = file_get_contents('php://input');
$arrayData = json_decode($data, true);

if (json_last_error() !== JSON_ERROR_NONE) {
    echo json_encode(['status' => 'fail', 'message' => 'Invalid JSON data']);
    exit;
}

$spareIDArray = $arrayData['order'] ?? [];
$TotalPrice = $arrayData['TotalPrice'] ?? 0;

if (empty($spareIDArray) || $TotalPrice <= 0) {
    echo json_encode(['status' => 'fail', 'message' => 'Invalid order data']);
    exit;
}

$stmt = $conn->prepare("INSERT INTO orders (dealerID, deliveryAddress,orderPrice, orderStatus, orderDateTime) VALUES (?, ?,?, 1, CURRENT_TIMESTAMP())");
$stmt->bind_param("ssd", $dealerID, $deliveryAddress,$TotalPrice);
if ($stmt->execute()) {
    $orderID = $conn->insert_id;  

    $orderLineStmt = $conn->prepare("INSERT INTO orderline (orderID, sparePartNum, orderQty) VALUES (?, ?, ?)");
    foreach ($spareIDArray as $arr) {
        $sparePartNum = $arr[0];
        $orderQty = $arr[1];
        $orderLineStmt->bind_param("iii", $orderID, $sparePartNum, $orderQty);
        if (!$orderLineStmt->execute()) {
            echo json_encode(['status' => 'fail', 'message' => 'Orderline creation failed: ' . $orderLineStmt->error]);
            $orderLineStmt->close();
            $stmt->close();
            $conn->close();
            exit;
        }

        if (isset($_SESSION['cart']) && is_array($_SESSION['cart'])) {
            foreach ($_SESSION['cart'] as $key => $item) {
                if (isset($item['spareID']) && $item['spareID'] == $sparePartNum) {
                    unset($_SESSION['cart'][$key]);
                    break; 
                }
            }
            $_SESSION['cart'] = array_values($_SESSION['cart']);
        }
    }

    $orderLineStmt->close();

    
    echo json_encode(['status' => 'success', 'message' => 'Order created successfully', 'orderID' => $orderID]);
} else {
    echo json_encode(['status' => 'fail', 'message' => 'Order creation failed: ' . $stmt->error]);
}

$stmt->close();
$conn->close();
?>