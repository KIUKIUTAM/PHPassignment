<?php
require_once('../../../db/connect.php');
session_start();

$orderStatus = "";
$sql = "
    SELECT * 
    FROM `orders` o
    JOIN `dealer` d ON o.dealerID = d.dealerID
    LEFT JOIN `salesmanager` s ON o.salesManagerID = s.salesManagerID 
    WHERE o.orderStatus = 4;
";
$stmt = $conn->prepare($sql);

$stmt->execute();

$result = $stmt->get_result();

$dataSet = [];
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {

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

        $deliveryDate = $row['deliveryDate'] == null ? "Not yet delivered" : $row['deliveryDate'];
        $salesManagerName = $row['managerName'] == null ? "Not yet assigned" : $row['managerName'];
        $salesManagerContact = $row['contactNumber'] == null ? "Not yet assigned" : $row['contactNumber'];

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
    echo json_encode(['status' => 'success', 'data' => $dataSet]);
}

// Close the statement and connection
$stmt->close();
$conn->close();
?>