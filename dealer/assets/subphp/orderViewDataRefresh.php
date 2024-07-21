<?php
require_once('../../../db/connect.php');
session_start();
if (isset($_SESSION['dealer'])) {
    $dealerEmail = $_SESSION['dealer'];
}



$orderStatus = "";
$sql = "SELECT * FROM `orders`,`dealer` WHERE orders.dealerID = dealer.dealerID AND dealer.dealerEmail = '$dealerEmail'";
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
        }


        $deliveryDate = $row['deliveryDate'] == null ? "Not yet delivered" : $row['deliveryDate'];



        $dataSet[] = [
            sprintf('%06d', $row['orderID']),
            $row['orderDateTime'],
            $OrderStatus,
            $deliveryDate,
            "<button type='button' class='btn btn-outline-success' data-bs-toggle='modal' data-bs-target='#Modal-Detail' onclick='uploadOrderDetail(\"{$row['orderID']}\", \"{$row['orderDateTime']}\", \"{$row['deliveryAddress']}\", \"{$row['deliveryDate']}\", \"{$row['orderPrice']}\")'>Details</button>",
            "<button type='button' class='btn btn-outline-danger' id='cancelButton{$row['orderID']}' onclick='cancelOrder(\"{$row['orderID']}\", \"{$row['orderStatus']}\")'>Cancel Order</button>"
        ];
    }

    echo json_encode(['status' => 'success', 'data' => $dataSet]);
} else {
    echo json_encode(['status' => 'error', 'message' => 'No records found']);
}

// Close the statement and connection
$stmt->close();
$conn->close();
