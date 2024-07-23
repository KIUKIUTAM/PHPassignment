<?php
require_once('../../../db/connect.php');
session_start();
$data = file_get_contents('php://input');
$arrayData = json_decode($data, true);
if(!isset($arrayData['orderID']) || empty($arrayData['orderID'])){
    die(json_encode(['status' => 'error', 'message' => 'Invalid order ID']));
}
$orderID = $arrayData['orderID'];

$orderLine = [];

$stmt = $conn->prepare("SELECT s.sparePartName, o.sparePartNum, o.orderQty, s.price,s.stockItemQty FROM orderline o JOIN sparepart s ON o.sparePartNum = s.sparePartNum WHERE orderID = ?");
$stmt->bind_param("s", $orderID);
$stmt->execute();
$result = $stmt->get_result();
$index = 1;
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
 
        $orderLine[] = [
            $index++,
            $row['sparePartNum'],
            $row['sparePartName'],
            $row['stockItemQty'],
            $row['orderQty'],
            "$".$row['price']
        ];
    }
    $_SESSION['orderLine'] = $orderLine;
    echo json_encode(['status' => 'success', 'orderLine' => $orderLine]);
} else {
    echo json_encode(['status' => 'success', 'orderLine' => $orderLine]);
}
$stmt->close();
$conn->close();
?>