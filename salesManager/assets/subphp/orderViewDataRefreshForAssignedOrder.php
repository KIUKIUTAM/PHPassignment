<?php
require_once('../../../db/connect.php');
session_start();
if(!isset($_SESSION['managerID'])){
    echo json_encode(['status' => 'error', 'message' => 'Please login first']);
    return;
}
$loginID = $_SESSION['managerID'];
$orderStatus = "";
$sql = "
    SELECT * 
    FROM `orders` o
    JOIN `dealer` d ON o.dealerID = d.dealerID
    LEFT JOIN `salesmanager` s ON o.salesManagerID = s.salesManagerID WHERE o.salesManagerID=$loginID;
";
$stmt = $conn->prepare($sql);

$stmt->execute();

$result = $stmt->get_result();

$dataSet = [];
if ($result->num_rows > 0) {
    
    while ($row = $result->fetch_assoc()) {

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


        $deliveryDate = $row['deliveryDate'] == null ? "Not yet delivered" : $row['deliveryDate'];

        $salesManagerName = $row['managerName'] == null ? "Not yet assigned" : $row['managerName'];
        $salesManagerContact = $row['contactNumber'] == null ? "Not yet assigned" : $row['contactNumber'];

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