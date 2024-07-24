<?php
require_once('../../../db/connect.php');

// Fetch input data
$data = file_get_contents('php://input');
$arrayData = json_decode($data, true);

// Function to execute a query with optional parameters
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

// Initialize response
$response = ['status' => 'success', 'data' => []];

// Query to count orders with status not equal to 5 or 6
$result = executeQuery($conn, "SELECT count(*) as orderCount FROM orders WHERE orderStatus != 5 AND orderStatus != 6");
if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $response['data']['orderCount'] = $row['orderCount'];
} else {
    $response['status'] = 'fail';
    $response['message'] = 'No orderCount found';
    echo json_encode($response);
    exit;
}

// Query to sum order prices with status not equal to 5 or 6
$result = executeQuery($conn, "SELECT SUM(orderPrice) as orderPriceCount FROM orders WHERE orderStatus != 5 AND orderStatus != 6");
if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $response['data']['orderPriceCount'] = $row['orderPriceCount'] ?? 0;
} else {
    $response['status'] = 'fail';
    $response['message'] = 'No orderPrice found';
    echo json_encode($response);
    exit;
}

// Set timezone and get start and end of the day
$timezone = new DateTimeZone('Asia/Hong_Kong');
$start = new DateTime('now', $timezone);
$start->setTime(0, 0, 0);
$end = new DateTime('now', $timezone);
$end->setTime(23, 59, 59);
$startStr = $start->format('Y-m-d H:i:s');
$endStr = $end->format('Y-m-d H:i:s');

// Query to sum order prices for today with status not equal to 5 or 6
$result = executeQuery($conn, "SELECT 
    SUM(orderPrice) AS orderPriceCountToday 
FROM 
    orders 
WHERE 
    orderDateTime BETWEEN ? AND ? 
    AND orderStatus != 5 
    AND orderStatus != 6", ["ss", $startStr, $endStr]);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $response['data']['orderPriceCountToday'] = $row['orderPriceCountToday'] ?? 0;
} else {
    $response['status'] = 'fail';
    $response['message'] = 'No orderPrice found for today';
    echo json_encode($response);
    exit;
}

// Output the JSON response
echo json_encode($response);

// Close the database connection
$conn->close();
?>