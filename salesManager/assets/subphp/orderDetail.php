<?php
require_once('../../../db/connect.php');
session_start();

// Get the raw POST data
$data = file_get_contents('php://input');
$arrayData = json_decode($data, true);

// Validate orderID
if (!isset($arrayData['orderID']) || empty($arrayData['orderID'])) {
    echo json_encode(['status' => 'error', 'message' => 'Invalid order ID']);
    exit();
}

$orderID = $arrayData['orderID'];
$orderLine = [];

// Prepare the SQL query
$stmt = $conn->prepare("SELECT s.sparePartName, o.sparePartNum, o.orderQty, s.price, s.stockItemQty FROM orderline o JOIN sparepart s ON o.sparePartNum = s.sparePartNum WHERE o.orderID = ?");
if (!$stmt) {
    echo json_encode(['status' => 'error', 'message' => 'Failed to prepare statement: ' . $conn->error]);
    exit();
}

// Bind parameters and execute the statement
$stmt->bind_param("s", $orderID);
$stmt->execute();
$result = $stmt->get_result();

// Fetch the results
$index = 1;
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $orderLine[] = [
            $index++,
            $row['sparePartNum'],
            $row['sparePartName'],
            $row['stockItemQty'],
            $row['orderQty'],
            "$" . $row['price']
        ];
    }
    $_SESSION['orderLine'] = $orderLine;
    echo json_encode(['status' => 'success', 'orderLine' => $orderLine]);
} else {
    echo json_encode(['status' => 'success', 'orderLine' => $orderLine]);
}

// Close the statement and connection
$stmt->close();
$conn->close();
?>