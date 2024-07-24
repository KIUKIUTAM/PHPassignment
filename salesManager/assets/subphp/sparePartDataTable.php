<?php
require_once('../../../db/connect.php');

$sql = "SELECT 
    sparepart.sparePartImage,
    sparepart.sparePartNum,
    sparepart.sparePartName,
    sparepart.stockItemQty,
    sparepart.weight,
    sparepart.price,
    sparepart.discountPrice,
    disabledsparepart.disable
 FROM `sparepart` LEFT JOIN `disabledsparepart` ON sparepart.sparePartNum = disabledsparepart.sparePartNum;";
$stmt = $conn->prepare($sql);

$stmt->execute();

$result = $stmt->get_result();

$dataSet = [];
if ($result->num_rows > 0) {

    while ($row = $result->fetch_assoc()) {

        if ($row['discountPrice'] == 0) {
            $row['discountPrice'] = "No Discount";
        } else {
            $row['discountPrice'] = "$" . $row['discountPrice'];
        }
        if($row['disable']==1){
            $disable = "Disabled";
        }else{
            $disable = "Enabled";
        }
        $dataSet[] = [
            $row['sparePartImage'],
            $row['sparePartNum'],
            $row['sparePartName'],
            $row['stockItemQty'],
            $row['weight'] . "kg",
            "$" . $row['price'],
            $row['discountPrice'],
            $disable
        ];
    }

    echo json_encode(['status' => 'success', 'data' => $dataSet]);
} else {
    echo json_encode(['status' => 'success', 'data' => $dataSet]);
}

// Close the statement and connection
$stmt->close();
$conn->close();
