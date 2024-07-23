<?php
require_once('../../../db/connect.php');

$data = file_get_contents('php://input');
$arrayData = json_decode($data, true);

function executeQuery($conn, $query, $params = []) {
    $stmt = $conn->prepare($query);
    if ($params) {
        $stmt->bind_param(...$params);
    }
    $stmt->execute();
    $result = $stmt->get_result();
    $stmt->close();
    return $result;
}

$response = ['status' => 'success', 'data' => []];

$result = executeQuery($conn, "SELECT count(*) as orderCount FROM orders");
if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $response['data']['orderCount'] = $row['orderCount'];
} else {
    $response['status'] = 'fail';
    $response['message'] = 'No orderCount found';
    echo json_encode($response);
    exit;
}

$result = executeQuery($conn, "SELECT SUM(orderPrice) as orderPriceCount FROM orders");
if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $response['data']['orderPriceCount'] = $row['orderPriceCount'];
} else {
    $response['status'] = 'fail';
    $response['message'] = 'No orderPrice found';
    echo json_encode($response);
    exit;
}

$timezone = new DateTimeZone('Asia/Hong_Kong');
$start = new DateTime('now', $timezone);
$start->setTime(0, 0, 0);
$end = new DateTime('now', $timezone);
$end->setTime(23, 59, 59);
$startStr = $start->format('Y-m-d H:i:s');
$endStr = $end->format('Y-m-d H:i:s');


$result = executeQuery($conn, "SELECT SUM(orderPrice) as orderPriceCountToday FROM orders WHERE orderDateTime BETWEEN ? AND ?", ["ss", $startStr, $endStr]);
if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $response['data']['orderPriceCountToday'] = $row['orderPriceCountToday'];
} else {
    $response['status'] = 'fail';
    $response['message'] = 'No orderPrice found for today';
    echo json_encode($response);
    exit;
}

echo json_encode($response);

$conn->close();
?>