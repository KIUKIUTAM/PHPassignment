<?php
require_once('../../../db/connect.php');

$sql = "SELECT * FROM `sparepart`;
";
$stmt = $conn->prepare($sql);

$stmt->execute();

$result = $stmt->get_result();

$dataSet = [];
if ($result->num_rows > 0) {
    
    while ($row = $result->fetch_assoc()) {

        if($row['discountPrice'] == 0){
            $row['discountPrice'] = "No Discount";
        }else{
            $row['discountPrice'] = "$".$row['discountPrice'];
        }
        $dataSet[] = [
            $row['sparePartImage'],
            $row['sparePartNum'],
            $row['sparePartName'],
            $row['stockItemQty'],
            $row['weight']."kg",
            "$".$row['price'],
            $row['discountPrice']
        ];
    }

    echo json_encode(['status' => 'success', 'data' => $dataSet]);
} else {
    echo json_encode(['status' => 'success', 'data' => $dataSet]);
}

// Close the statement and connection
$stmt->close();
$conn->close();
