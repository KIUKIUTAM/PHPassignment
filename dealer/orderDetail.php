<?php
require_once('../db/connet.php');

$data = file_get_contents('php://input');
$arrayData = json_decode($data, true);
$orderID = $arrayData['orderID'];

$orderLine = [];

$stmt = $conn->prepare("SELECT s.sparePartName, o.sparePartNum, o.orderQty, s.price FROM orderline o JOIN sparepart s ON o.sparePartNum = s.sparePartNum WHERE orderID = ?");
$stmt->bind_param("s", $orderID);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
 
        $orderLine[] = [
            'sparePartName' => $row['sparePartName'],
            'sparePartNum' => $row['sparePartNum'],
            'orderQty' => $row['orderQty'],
            'price' => $row['price']
        ];
    }
    echo json_encode(['status' => 'success', 'orderLine' => $orderLine]);
} else {
    echo json_encode(['status' => 'fail', 'message' => 'No orderline found']);
}
?>