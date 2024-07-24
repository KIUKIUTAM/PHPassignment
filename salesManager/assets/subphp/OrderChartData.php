<?php
require_once('../../../db/connect.php');
session_start();

// Initialize arrays to store the days and order counts
$days = [];
$orderCounts = [];

// Prepare the SQL query to fetch the order count per day, excluding certain statuses
$sql = "
    SELECT DATE_FORMAT(orderDateTime, '%Y-%m-%d') AS day, COUNT(*) AS orderCount 
    FROM orders 
    WHERE orderStatus != 5 AND orderStatus != 6 
    GROUP BY DATE_FORMAT(orderDateTime, '%Y-%m-%d') 
    ORDER BY day;
";
$stmt = $conn->prepare($sql);

// Execute the query
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    // Process each row of the result set
    while ($row = $result->fetch_assoc()) {
        $days[] = $row["day"];
        $orderCounts[] = $row["orderCount"];
    }

    // Return the data as a JSON response
    echo json_encode(['status' => 'success', 'data' => [$days, $orderCounts]]);
} else {
    // Return an empty data set as a JSON response
    echo json_encode(['status' => 'success', 'data' => []]);
}

// Close the statement and connection
$stmt->close();
$conn->close();
?>