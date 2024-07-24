<?php
require_once('../../../db/connect.php');
session_start();
if (isset($_SESSION['dealer'])) {
    $dealerEmail = $_SESSION['dealer'];
}



$orderStatus = "";
$sql = "
    SELECT * 
    FROM `orders` o
    JOIN `dealer` d ON o.dealerID = d.dealerID
    LEFT JOIN `salesmanager` s ON o.salesManagerID = s.salesManagerID
    WHERE d.dealerEmail = '$dealerEmail' AND o.orderStatus != 5;
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
        $salesManagerID = $row['salesManagerID'] == null ? "Not yet assigned" : $row['salesManagerID'];
        $salesManagerName = $row['managerName'] == null ? "Not yet assigned" : $row['managerName'];
        $salesManagerContact = $row['contactNumber'] == null ? "Not yet assigned" : $row['contactNumber'];

        $dataSet[] = [
            sprintf('%06d', $row['orderID']),
            $row['orderDateTime'],
            $OrderStatus,
            $deliveryDate,
            "<button type='button' class='btn btn-outline-success' data-bs-toggle='modal' data-bs-target='#Modal-Detail' onclick='uploadOrderDetail(\"{$row['orderID']}\", \"{$row['orderDateTime']}\", \"{$salesManagerID}\", \"{$salesManagerName}\", \"{$salesManagerContact}\", \"{$row['deliveryAddress']}\", \"{$deliveryDate}\", \"{$row['orderPrice']}\")'>Details</button>",
            "<button type='button' class='btn btn-outline-danger' id='cancelButton{$row['orderID']}' onclick='cancelOrder(\"{$row['orderID']}\", \"{$row['orderStatus']}\")'>Cancel</button>"
        ];
    }

    echo json_encode(['status' => 'success', 'data' => $dataSet]);
} else {
    echo json_encode(['status' => 'success', 'data' => $dataSet]);
}

// Close the statement and connection
$stmt->close();
$conn->close();
