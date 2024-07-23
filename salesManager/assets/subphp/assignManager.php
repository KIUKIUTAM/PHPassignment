<?php
require_once('../../../db/connect.php');

$data = file_get_contents('php://input');
$arrayData = json_decode($data, true);

$stmt = $conn->prepare("SELECT salesManagerID,managerName FROM salesmanager");
$stmt->execute();
$result = $stmt->get_result();
$index = 1;
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $orderLine[] = [
            $row['salesManagerID'],
            $row['managerName']
        ];
    }
    echo json_encode(['status' => 'success', 'data' => $orderLine]);
} else {
    echo json_encode(['status' => 'fail', 'message' => 'No orderline found']);
}
$stmt->close();
$conn->close();
?>