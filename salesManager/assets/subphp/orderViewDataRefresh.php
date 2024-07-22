<?php
require_once('../../../db/connect.php');
session_start();

$orderStatus = "";
$sql = "
    SELECT * 
    FROM `orders` o
    JOIN `dealer` d ON o.dealerID = d.dealerID
    LEFT JOIN `salesmanager` s ON o.salesManagerID = s.salesManagerID;
";
$stmt = $conn->prepare($sql);

$stmt->execute();

$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $dataSet = [];
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
            "<button type='button' class='btn btn-outline-success' data-bs-toggle='modal' data-bs-target='#Modal-Detail' onclick='uploadOrderDetail(\"{$row['orderID']}\", \"{$row['orderDateTime']}\", \"{$row['orderStatus']}\", \"{$salesManagerName}\", \"{$salesManagerContact}\", \"{$row['deliveryAddress']}\", \"{$deliveryDate}\", \"{$row['orderPrice']}\")'>Details</button>",
            "<button type='button' class='btn btn-outline-danger' id='cancelButton{$row['orderID']}' onclick='cancelOrder(\"{$row['orderID']}\", \"{$row['orderStatus']}\")'>Cancel</button>"
        ];
    }

    echo json_encode(['status' => 'success', 'data' => $dataSet]);
} else {
    echo json_encode(['status' => 'error', 'message' => 'No records found']);
}

// Close the statement and connection
$stmt->close();
$conn->close();
