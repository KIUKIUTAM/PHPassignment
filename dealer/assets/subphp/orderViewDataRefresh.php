<?php
require_once('../../../db/connect.php'); // Include the database connection
session_start(); // Start the session

// Check if the dealer session is set
if (isset($_SESSION['dealer'])) {
    $dealerEmail = $_SESSION['dealer']; // Get the dealer's email from the session
}

$orderStatus = ""; // Initialize order status variable
$sql = "
    SELECT * 
    FROM `orders` o
    JOIN `dealer` d ON o.dealerID = d.dealerID
    LEFT JOIN `salesmanager` s ON o.salesManagerID = s.salesManagerID
    WHERE d.dealerEmail = '$dealerEmail' AND o.orderStatus != 5;
"; // SQL query to fetch orders related to the dealer and exclude cancelled orders

$stmt = $conn->prepare($sql); // Prepare the SQL statement
$stmt->execute(); // Execute the SQL statement

$result = $stmt->get_result(); // Get the result set

$dataSet = []; // Initialize an array to hold the data set

// Check if there are any results
if ($result->num_rows > 0) {
    // Fetch each row and process the data
    while ($row = $result->fetch_assoc()) {
        // Determine the order status based on the orderStatus value
        $OrderStatus = "";
        switch ($row['orderStatus']) {
            case 1:
                $OrderStatus = "Wait for approval";
                break;
            case 2:
                $OrderStatus = "Wait for delivery";
                break;
            case 3:
                $OrderStatus = "Delivered";
                break;
            case 4:
                $OrderStatus = "Request Cancel";
                break;
            case 5:
                $OrderStatus = "Cancelled";
                break;
            case 6:
                $OrderStatus = "Rejected";
                break;
        }

        // Determine the delivery date, sales manager ID, name, and contact
        $deliveryDate = $row['deliveryDate'] == null ? "Not yet delivered" : $row['deliveryDate'];
        $salesManagerID = $row['salesManagerID'] == null ? "Not yet assigned" : $row['salesManagerID'];
        $salesManagerName = $row['managerName'] == null ? "Not yet assigned" : $row['managerName'];
        $salesManagerContact = $row['contactNumber'] == null ? "Not yet assigned" : $row['contactNumber'];

        // Add the processed data to the data set array
        $dataSet[] = [
            sprintf('%06d', $row['orderID']), // Format the order ID as a six-digit number
            $row['orderDateTime'], // Order date and time
            $OrderStatus, // Order status
            $deliveryDate, // Delivery date
            // Button for viewing order details
            "&lt;button type='button' class='btn btn-outline-success' data-bs-toggle='modal' data-bs-target='#Modal-Detail' onclick='uploadOrderDetail(\"{$row['orderID']}\", \"{$row['orderDateTime']}\", \"{$salesManagerID}\", \"{$salesManagerName}\", \"{$salesManagerContact}\", \"{$row['deliveryAddress']}\", \"{$deliveryDate}\", \"{$row['orderPrice']}\")'&gt;Details&lt;/button&gt;",
            // Button for cancelling the order
            "&lt;button type='button' class='btn btn-outline-danger' id='cancelButton{$row['orderID']}' onclick='cancelOrder(\"{$row['orderID']}\", \"{$row['orderStatus']}\")'&gt;Cancel&lt;/button&gt;"
        ];
    }

    // Return a success message with the data set
    echo json_encode(['status' => 'success', 'data' => $dataSet]);
} else {
    // Return a success message with an empty data set if no results are found
    echo json_encode(['status' => 'success', 'data' => $dataSet]);
}

// Close the statement and connection
$stmt->close(); // Close the statement
$conn->close(); // Close the database connection
?>