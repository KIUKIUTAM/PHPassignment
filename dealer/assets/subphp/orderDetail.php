<?php
require_once('../../../db/connect.php');

$data = file_get_contents('php://input');
$arrayData = json_decode($data, true);
$orderID = $arrayData['orderID'];

$orderLine = [];

$stmt = $conn->prepare("SELECT s.sparePartName, o.sparePartNum, o.orderQty, s.price FROM orderline o JOIN sparepart s ON o.sparePartNum = s.sparePartNum WHERE orderID = ?");
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
            $row['orderQty'],
            "$".$row['price']
        ];
    }
    echo json_encode(['status' => 'success', 'orderLine' => $orderLine]);
} else {
    echo json_encode(['status' => 'success', 'orderLine' => $orderLine]);
}
$stmt->close();
$conn->close();
?>