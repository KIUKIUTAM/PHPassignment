<?php
require_once('../../../db/connect.php');
session_start();

$orderData = [];

$stmt = $conn->prepare("SELECT DATE_FORMAT(orderDateTime, '%Y-%m-%d') AS day, COUNT(*) AS orderCount FROM orders GROUP BY DATE_FORMAT(orderDateTime, '%Y-%m-%d') ORDER BY day;");
$stmt->execute();
$result = $stmt->get_result();
$months = [];
$orderCounts = [];
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $days[] = $row["day"];
        $orderCounts[] = $row["orderCount"];
    }
    echo json_encode(['status' => 'success', 'data' =>[$days, $orderCounts]]);
} else {
    echo json_encode(['status' => 'success', 'data' => []]);
}
$stmt->close();
$conn->close();
