<?php
require_once('../../../db/connect.php');

$data = file_get_contents('php://input');
$arrayData = json_decode($data, true);

if (isset($arrayData['sparePartNum'])) {
    $sparePartNum = $arrayData['sparePartNum'];

    if ($conn->connect_error) {
        die(json_encode(['status' => 'error', 'message' => 'Connection failed: ' . $conn->connect_error]));
    }

    $sql = "SELECT sparepart.sparePartNum FROM sparepart INNER JOIN orderline ON sparepart.sparePartNum = orderline.sparePartNum WHERE sparepart.sparePartNum = ? GROUP BY sparepart.sparePartNum";
    $stmt = $conn->prepare($sql);

    if ($stmt === false) {
        die(json_encode(['status' => 'error', 'message' => 'Prepare failed: ' . $conn->error]));
    }

    $stmt->bind_param('i', $sparePartNum);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        echo json_encode(['status' => 'ItemUsing']);
    } else {
        $stmt->close();

        $sql = "DELETE FROM sparepart WHERE sparePartNum = ?";
        $stmt = $conn->prepare($sql);

        if ($stmt === false) {
            die(json_encode(['status' => 'error', 'message' => 'Prepare failed: ' . $conn->error]));
        }

        $stmt->bind_param('i', $sparePartNum);
        $stmt->execute();

        if ($stmt->affected_rows > 0) {
            echo json_encode(['status' => 'success']);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Item not found or already deleted']);
        }
    }

    $stmt->close();
    $conn->close();
} else {
    echo json_encode(['status' => 'error', 'message' => 'Missing parameters']);
}
?>