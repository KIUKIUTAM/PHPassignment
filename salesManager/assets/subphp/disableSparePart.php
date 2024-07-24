<?php
require_once('../../../db/connect.php');


$data = file_get_contents('php://input');
$arrayData = json_decode($data, true);

if (isset($arrayData['sparePartNum']) && isset($arrayData['disable'])) {
    $sparePartNum = $arrayData['sparePartNum'];
    $disable = $arrayData['disable'];


    if ($conn->connect_error) {
        die(json_encode(['status' => 'error', 'message' => 'Connection failed: ' . $conn->connect_error]));
    }


    if ($disable == 0) {
        $sql = "DELETE FROM disabledsparepart WHERE `sparePartNum` = ?";
    } else {
        $sql = "INSERT INTO `disabledsparepart` (`sparePartNum`, `disable`) VALUES (?, ?)";
    }

 
    $stmt = $conn->prepare($sql);


    if ($stmt === false) {
        die(json_encode(['status' => 'error', 'message' => 'Prepare failed: ' . $conn->error]));
    }

  
    if ($disable == 0) {
        $stmt->bind_param("s", $sparePartNum);
    } else {
        $stmt->bind_param("si", $sparePartNum, $disable);
    }

    if ($stmt->execute()) {
        echo json_encode(['status' => 'success']);
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Execute failed: ' . $stmt->error]);
    }

   
    $stmt->close();
    $conn->close();
} else {
    echo json_encode(['status' => 'error', 'message' => 'Missing parameters']);
}
?>