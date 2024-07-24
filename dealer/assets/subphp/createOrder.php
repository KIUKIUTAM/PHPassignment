<?php
require_once('../../../db/connect.php'); // Include the database connection

// Check for connection errors
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

session_start(); // Start the session

$dealerEmail = $_SESSION['dealer'] ?? ''; // Get the dealer email from the session

// Check if dealer email is present in the session
if (empty($dealerEmail)) {
    echo json_encode(['status' => 'fail', 'message' => 'Dealer email not found in session']);
    exit;
}

// Prepare and execute a query to get dealer information
$stmt = $conn->prepare("SELECT dealerID, deliveryAddress FROM dealer WHERE dealerEmail = ?");
$stmt->bind_param("s", $dealerEmail);
$stmt->execute();
$result = $stmt->get_result();

// Check if the dealer exists
if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $dealerID = $row['dealerID'];
    $deliveryAddress = $row['deliveryAddress'];
} else {
    echo json_encode(['status' => 'fail', 'message' => 'Dealer not found']);
    exit;
}

// Get JSON data from the request body
$data = file_get_contents('php://input');
$arrayData = json_decode($data, true);

// Check for JSON decoding errors
if (json_last_error() !== JSON_ERROR_NONE) {
    echo json_encode(['status' => 'fail', 'message' => 'Invalid JSON data']);
    exit;
}

$spareIDArray = $arrayData['order'] ?? []; // Get the order array
$TotalPrice = $arrayData['TotalPrice'] ?? 0; // Get the total price
$deliveryCost = $arrayData['deliveryCost'] ?? 0; // Get the delivery cost

// Validate the order data
if (empty($spareIDArray) || $TotalPrice <= 0 || $deliveryCost <= 0) {
    echo json_encode(['status' => 'fail', 'message' => 'Invalid order data']);
    exit;
}

// Prepare and execute the order insertion query
$stmt = $conn->prepare("INSERT INTO orders (dealerID, deliveryAddress,deliveryCost,orderPrice, orderStatus, orderDateTime) VALUES (?, ?,?,?, 1, CURRENT_TIMESTAMP())");
$stmt->bind_param("ssdd", $dealerID, $deliveryAddress, $deliveryCost, $TotalPrice);

if ($stmt->execute()) {
    $orderID = $conn->insert_id;  // Get the last inserted order ID

    // Prepare the order line insertion query
    $orderLineStmt = $conn->prepare("INSERT INTO orderline (orderID, sparePartNum, orderQty) VALUES (?, ?, ?)");
    foreach ($spareIDArray as $arr) {
        $sparePartNum = $arr[0];
        $orderQty = $arr[1];
        $orderLineStmt->bind_param("iii", $orderID, $sparePartNum, $orderQty);
        
        // Execute the order line insertion query
        if (!$orderLineStmt->execute()) {
            echo json_encode(['status' => 'fail', 'message' => 'Orderline creation failed: ' . $orderLineStmt->error]);
            $orderLineStmt->close();
            $stmt->close();
            $conn->close();
            exit;
        }

        // Remove the item from the session cart if it exists
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

    $orderLineStmt->close(); // Close the order line statement

    // Return a success message with the order ID
    echo json_encode(['status' => 'success', 'message' => 'Order created successfully', 'orderID' => $orderID]);
} else {
    // Return a failure message if the order creation failed
    echo json_encode(['status' => 'fail', 'message' => 'Order creation failed: ' . $stmt->error]);
}

$stmt->close(); // Close the order statement
$conn->close(); // Close the database connection
?>