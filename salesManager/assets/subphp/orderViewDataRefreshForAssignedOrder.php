<?php
require_once('../../../db/connect.php');
session_start();

// Check if the manager is logged in
if (!isset($_SESSION['managerID'])) {
    echo json_encode(['status' => 'error', 'message' => 'Please login first']);
    exit();
}

$loginID = $_SESSION['managerID'];
$orderStatus = "";

// Prepare the SQL query
$sql = "
    SELECT o.*, d.*, s.managerName, s.contactNumber 
    FROM `orders` o
    JOIN `dealer` d ON o.dealerID = d.dealerID
    LEFT JOIN `salesmanager` s ON o.salesManagerID = s.salesManagerID 
    WHERE o.salesManagerID = ?
";
$stmt = $conn->prepare($sql);

if (!$stmt) {
    echo json_encode(['status' => 'error', 'message' => 'Failed to prepare statement: ' . $conn->error]);
    exit();
}

// Bind parameters and execute the statement
$stmt->bind_param("i", $loginID);
$stmt->execute();
$result = $stmt->get_result();

$dataSet = [];
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        // Determine the order status
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

        // Determine the delivery date
        $deliveryDate = $row['deliveryDate'] == null ? "Not yet delivered" : $row['deliveryDate'];

        // Determine the sales manager details
        $salesManagerName = $row['managerName'] == null ? "Not yet assigned" : $row['managerName'];
        $salesManagerContact = $row['contactNumber'] == null ? "Not yet assigned" : $row['contactNumber'];

        // Append the data to the dataset
        $dataSet[] = [
            sprintf('%06d', $row['orderID']),
            $row['dealerID'],
            $row['orderDateTime'],
            $OrderStatus,
            $deliveryDate,
            "<button type='button' class='btn btn-outline-success' data-bs-toggle='modal' data-bs-target='#Modal-Detail' onclick='uploadOrderDetail(\"{$row['orderID']}\", \"{$row['orderDateTime']}\", \"{$row['orderStatus']}\", \"{$salesManagerName}\", \"{$salesManagerContact}\", \"{$row['deliveryAddress']}\", \"{$deliveryDate}\", \"{$row['orderPrice']}\")'>Details</button>"
        ];
    }

    echo json_encode(['status' => 'success', 'data' => $dataSet]);
} else {
    echo json_encode(['status' => 'success', 'data' => $dataSet]);
}

// Close the statement and connection
$stmt->close();
$conn->close();
?>