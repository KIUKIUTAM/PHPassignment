<?php
require_once('../../../db/connect.php');
session_start();

// SQL query to fetch order data along with dealer and sales manager details
$sql = "
    SELECT * 
    FROM `orders` o
    JOIN `dealer` d ON o.dealerID = d.dealerID
    LEFT JOIN `salesmanager` s ON o.salesManagerID = s.salesManagerID;
";
$stmt = $conn->prepare($sql);

// Execute the query
$stmt->execute();
$result = $stmt->get_result();

// Initialize the data set array
$dataSet = [];

if ($result->num_rows > 0) {
    // Process each row of the result set
    while ($row = $result->fetch_assoc()) {
        // Determine order status
        $orderStatus = "";
        switch ($row['orderStatus']) {
            case 1:
                $orderStatus = "Wait for approval";
                break;
            case 2:
                $orderStatus = "Wait for delivery";
                break;
            case 3:
                $orderStatus = "Delivered";
                break;
            case 4:
                $orderStatus = "Request Cancel";
                break;
            case 5:
                $orderStatus = "Cancelled";
                break;
            case 6:
                $orderStatus = "Rejected";
                break;
        }

        // Determine delivery date
        $deliveryDate = $row['deliveryDate'] == null ? "Not yet delivered" : $row['deliveryDate'];

        // Determine sales manager details
        $salesManagerName = $row['managerName'] == null ? "Not yet assigned" : $row['managerName'];
        $salesManagerContact = $row['contactNumber'] == null ? "Not yet assigned" : $row['contactNumber'];

        // Add processed row to the data set
        $dataSet[] = [
            sprintf('%06d', $row['orderID']),
            $row['dealerID'],
            $row['orderDateTime'],
            $orderStatus,
            $deliveryDate,
            "<button type='button' class='btn btn-outline-success' data-bs-toggle='modal' data-bs-target='#Modal-Detail' onclick='uploadOrderDetail(\"{$row['orderID']}\", \"{$row['orderDateTime']}\", \"{$row['orderStatus']}\", \"{$salesManagerName}\", \"{$salesManagerContact}\", \"{$row['deliveryAddress']}\", \"{$deliveryDate}\", \"{$row['deliveryCost']}\", \"{$row['orderPrice']}\")'>Details</button>"
        ];
    }

    // Return the data set as a JSON response
    echo json_encode(['status' => 'success', 'data' => $dataSet]);
} else {
    // Return an empty data set as a JSON response
    echo json_encode(['status' => 'success', 'data' => $dataSet]);
}

// Close the statement and connection
$stmt->close();
$conn->close();
?>