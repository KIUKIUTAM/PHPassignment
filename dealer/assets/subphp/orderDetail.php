<?php
require_once('../../../db/connect.php'); // Include the database connection

// Get JSON data from the request body
$data = file_get_contents('php://input');
$arrayData = json_decode($data, true);
$orderID = $arrayData['orderID']; // Extract the order ID from the JSON data

$orderLine = []; // Initialize an array to hold the order line details

// Prepare and execute a query to get order line details
$stmt = $conn->prepare("SELECT s.sparePartName, o.sparePartNum, s.sparePartImage, o.orderQty, s.price FROM orderline o JOIN sparepart s ON o.sparePartNum = s.sparePartNum WHERE orderID = ?");
$stmt->bind_param("s", $orderID);
$stmt->execute();
$result = $stmt->get_result();
$index = 1; // Initialize an index for numbering the order line items

// Check if there are any results
if ($result->num_rows > 0) {
    // Fetch each row and add it to the order line array
    while ($row = $result->fetch_assoc()) {
        $orderLine[] = [
            $index++, // Increment the index for each item
            $row['sparePartNum'], // Spare part number
            $row['sparePartName'], // Spare part name
            $row['sparePartImage'], // Spare part image
            $row['orderQty'], // Order quantity
            "$" . $row['price'] // Price formatted as a string with a dollar sign
        ];
    }
    // Return a success message with the order line details
    echo json_encode(['status' => 'success', 'orderLine' => $orderLine]);
} else {
    // Return a success message with an empty order line array if no results are found
    echo json_encode(['status' => 'success', 'orderLine' => $orderLine]);
}

$stmt->close(); // Close the statement
$conn->close(); // Close the database connection
?>