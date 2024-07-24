<?php
require_once('../../../db/connect.php');
session_start();

// Check if the connection is valid
if (!$conn) {
    echo json_encode(['status' => 'error', 'message' => 'Database connection failed']);
    exit();
}

// Prepare the SQL query to fetch orders with status "Request Cancel"
$sql = "
    SELECT o.*, d.*, s.managerName, s.contactNumber 
    FROM `orders` o
    JOIN `dealer` d ON o.dealerID = d.dealerID
    LEFT JOIN `salesmanager` s ON o.salesManagerID = s.salesManagerID 
    WHERE o.orderStatus = 4;
";
$stmt = $conn->prepare($sql);

if (!$stmt) {
    echo json_encode(['status' => 'error', 'message' => 'Failed to prepare statement: ' . $conn->error]);
    exit();
}

// Execute the statement
$stmt->execute();
$result = $stmt->get_result();

$dataSet = [];
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        // Determine the order status
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

        // Determine the delivery date
        $deliveryDate = $row['deliveryDate'] == null ? "Not yet delivered" : $row['deliveryDate'];

        // Determine the sales manager details
        $salesManagerName = $row['managerName'] == null ? "Not yet assigned" : $row['managerName'];
        $salesManagerContact = $row['contactNumber'] == null ? "Not yet assigned" : $row['contactNumber'];

        // Append the data to the dataset
        $dataSet[] = [
            sprintf('%06d', $row['orderID']),
            htmlspecialchars($row['dealerID']),
            htmlspecialchars($row['orderDateTime']),
            htmlspecialchars($orderStatus),
            htmlspecialchars($deliveryDate),
            "<button type='button' class='btn btn-outline-success' data-bs-toggle='modal' data-bs-target='#Modal-Detail' onclick='uploadOrderDetail(\"" . htmlspecialchars($row['orderID']) . "\", \"" . htmlspecialchars($row['orderDateTime']) . "\", \"" . htmlspecialchars($row['orderStatus']) . "\", \"" . htmlspecialchars($salesManagerName) . "\", \"" . htmlspecialchars($salesManagerContact) . "\", \"" . htmlspecialchars($row['deliveryAddress']) . "\", \"" . htmlspecialchars($deliveryDate) . "\", \"" . htmlspecialchars($row['orderPrice']) . "\")'>Details</button>"
        ];
    }

    echo json_encode(['status' => 'success', 'data' => $dataSet]);
} else {
    echo json_encode(['status' => 'success', 'data' => []]);
}

// Close the statement and connection
$stmt->close();
$conn->close();
?>