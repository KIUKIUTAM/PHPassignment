<?php
require_once('../../../db/connect.php');

// Fetch the raw POST data
$data = file_get_contents('php://input');
$arrayData = json_decode($data, true);

// Check if the required parameters are set in the input data
if (isset($arrayData['sparePartNum']) && isset($arrayData['disable'])) {
    $sparePartNum = $arrayData['sparePartNum'];
    $disable = $arrayData['disable'];

    // Check if the connection is established
    if ($conn->connect_error) {
        echo json_encode(['status' => 'error', 'message' => 'Connection failed: ' . $conn->connect_error]);
        exit();
    }

    // Prepare the SQL query based on the value of the disable parameter
    if ($disable == 0) {
        $sql = "DELETE FROM disabledsparepart WHERE `sparePartNum` = ?";
    } else {
        $sql = "INSERT INTO `disabledsparepart` (`sparePartNum`, `disable`) VALUES (?, ?)";
    }

    $stmt = $conn->prepare($sql);

    if ($stmt === false) {
        echo json_encode(['status' => 'error', 'message' => 'Prepare failed: ' . $conn->error]);
        exit();
    }

    // Bind parameters based on the value of the disable parameter
    if ($disable == 0) {
        $stmt->bind_param("s", $sparePartNum);
    } else {
        $stmt->bind_param("si", $sparePartNum, $disable);
    }

    // Execute the query and check for success
    if ($stmt->execute()) {
        echo json_encode(['status' => 'success']);
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Execute failed: ' . $stmt->error]);
    }

    // Close the statement and connection
    $stmt->close();
    $conn->close();
} else {
    // If the required parameters are not set, return an error status
    echo json_encode(['status' => 'error', 'message' => 'Missing parameters']);
}
?>