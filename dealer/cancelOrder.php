<?php
require_once('../db/connet.php');

if ($conn->connect_error) {
    die(json_encode(['status' => 'error', 'message' => 'Connection failed: ' . $conn->connect_error]));
}

$data = file_get_contents('php://input');
$arrayData = json_decode($data, true);

$stmt = $conn->prepare("UPDATE orders SET requestCancelStatus = 1 WHERE orderID = ?");
$stmt->bind_param("s", $arrayData['orderID']);
if ($stmt->execute()) {
    echo json_encode(['status' => 'success', 'message' => 'Order cancellation request submitted']);
} else {
    echo json_encode(['status' => 'error', 'message' => 'Execute statement failed: ' . $stmt->error]);
}

$stmt->close();
$conn->close();
?>?