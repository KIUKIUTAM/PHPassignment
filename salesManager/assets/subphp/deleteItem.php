<?php
require_once('../../../db/connect.php');

// Fetch the raw POST data
$data = file_get_contents('php://input');
$arrayData = json_decode($data, true);

// Check if the sparePartNum is set in the input data
if (isset($arrayData['sparePartNum'])) {
    $sparePartNum = $arrayData['sparePartNum'];

    // Check if the connection is established
    if ($conn->connect_error) {
        echo json_encode(['status' => 'error', 'message' => 'Connection failed: ' . $conn->connect_error]);
        exit();
    }

    // Prepare the SQL query to check if the spare part is being used
    $sql = "
        SELECT sparepart.sparePartNum 
        FROM sparepart 
        INNER JOIN orderline ON sparepart.sparePartNum = orderline.sparePartNum  INNER JOIN orders ON orderline.orderID = orders.orderID
        WHERE sparepart.sparePartNum = ? AND orders.orderStatus <= 2 
        GROUP BY sparepart.sparePartNum
    ";
    $stmt = $conn->prepare($sql);

    if ($stmt === false) {
        echo json_encode(['status' => 'error', 'message' => 'Prepare failed: ' . $conn->error]);
        exit();
    }

    // Bind parameters and execute the query
    $stmt->bind_param('i', $sparePartNum);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        // If the spare part is being used, return a specific status
        echo json_encode(['status' => 'ItemUsing']);
    } else {
        // Close the previous statement
        $stmt->close();

        // Prepare the SQL query to delete the spare part
        $sql = "DELETE FROM sparepart WHERE sparePartNum = ?";
        $stmt = $conn->prepare($sql);

        if ($stmt === false) {
            echo json_encode(['status' => 'error', 'message' => 'Prepare failed: ' . $conn->error]);
            exit();
        }

        // Bind parameters and execute the delete query
        $stmt->bind_param('i', $sparePartNum);
        $stmt->execute();

        if ($stmt->affected_rows > 0) {
            // If the delete was successful, return a success status
            echo json_encode(['status' => 'success']);
        } else {
            // If the item was not found or already deleted, return an error status
            echo json_encode(['status' => 'error', 'message' => 'Item not found or already deleted']);
        }
    }

    // Close the statement and connection
    $stmt->close();
    $conn->close();
} else {
    // If the sparePartNum is not set, return an error status
    echo json_encode(['status' => 'error', 'message' => 'Missing parameters']);
}
?>