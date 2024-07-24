<?php
require_once('../../../db/connect.php');

// Fetch the raw POST data
$data = file_get_contents('php://input');
$arrayData = json_decode($data, true);

// Check if the connection is established
if ($conn) {
    // Prepare the SQL query to fetch sales manager data
    $stmt = $conn->prepare("SELECT salesManagerID, managerName FROM salesmanager");

    // Execute the query
    $stmt->execute();
    $result = $stmt->get_result();

    // Initialize an array to store the results
    $orderLine = [];

    // Check if there are any results
    if ($result->num_rows > 0) {
        // Process each row of the result set
        while ($row = $result->fetch_assoc()) {
            $orderLine[] = [
                'salesManagerID' => $row['salesManagerID'],
                'managerName' => $row['managerName']
            ];
        }

        // Return the data as a JSON response
        echo json_encode(['status' => 'success', 'data' => $orderLine]);
    } else {
        // Return a fail status if no data is found
        echo json_encode(['status' => 'fail', 'message' => 'No orderline found']);
    }

    // Close the statement and connection
    $stmt->close();
    $conn->close();
} else {
    // Return a fail status if the connection is not established
    echo json_encode(['status' => 'fail', 'message' => 'Database connection failed']);
}
?>