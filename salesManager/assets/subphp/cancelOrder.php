<?php
require_once('../../../db/connect.php');
// Check if the connection was successful
if ($conn->connect_error) {
    die(json_encode(['status' => 'error', 'message' => 'Connection failed: ' . $conn->connect_error]));
}

// Get the raw POST data
$data = file_get_contents('php://input');

// Decode the JSON data
$arrayData = json_decode($data, true);

// Validate the input data
if (!isset($arrayData['orderID']) || empty($arrayData['orderID'])) {
    die(json_encode(['status' => 'error', 'message' => 'Invalid order ID']));
}

// Prepare the SQL statement
if ($arrayData['cancelWay'] == 0) {
    $stmt = $conn->prepare("UPDATE orders SET orderStatus = 5 WHERE orderID = ?");//cancel directly
} 
else {
    $stmt = $conn->prepare("UPDATE orders SET orderStatus = 4 WHERE orderID = ?"); // request for cancellation
}

if ($stmt === false) {
    die(json_encode(['status' => 'error', 'message' => 'Prepare statement failed: ' . $conn->error]));
}

// Bind the parameters
$stmt->bind_param("s", $arrayData['orderID']);

// Execute the statement
if ($stmt->execute()) {
    echo json_encode(['status' => 'success', 'message' => 'Order cancellation request submitted']);
} else {
    echo json_encode(['status' => 'error', 'message' => 'Execute statement failed: ' . $stmt->error]);
}

// Close the statement and connection
$stmt->close();
$conn->close();
