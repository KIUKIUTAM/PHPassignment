<?php
require_once('../../../db/connect.php');
session_start();

// Check if the connection was successful
if ($conn->connect_error) {
    die(json_encode(['status' => 'error', 'message' => 'Connection failed: ' . $conn->connect_error]));
}

// Get the raw POST data
$data = file_get_contents('php://input');

// Decode the JSON data
$arrayData = json_decode($data, true);

// Validate the input data
if (!isset($arrayData['orderID']) || empty($arrayData['orderID'])) {
    die(json_encode(['status' => 'error', 'message' => 'Invalid order ID']));
}
if (!isset($arrayData['status']) || !in_array($arrayData['status'], [2, 5])) {
    die(json_encode(['status' => 'error', 'message' => 'Invalid cancel status']));
}
if (!isset($_SESSION['orderLine']) || !is_array($_SESSION['orderLine']) || empty($_SESSION['orderLine'])) {
    die(json_encode(['status' => 'error', 'message' => 'Invalid order line']));
}

$orderLines = $_SESSION['orderLine'];

try {
    // Begin a transaction
    $conn->begin_transaction();

    if ($arrayData['status'] == 2) {
        // Reject cancel request
        $stmt = $conn->prepare("UPDATE orders SET orderStatus = 2 WHERE orderID = ?");
        if ($stmt === false) {
            throw new Exception('Prepare statement failed: ' . $conn->error);
        }
        $stmt->bind_param("s", $arrayData['orderID']);
        if (!$stmt->execute()) {
            throw new Exception('Execute statement failed: ' . $stmt->error);
        }
        $stmt->close();
       
        echo json_encode(['status' => 'success', 'message' => 'Order cancel rejected successfully']);
    } else {
        // Cancel order
        $stmt = $conn->prepare("UPDATE orders SET orderStatus = 5, deliveryDate = NULL WHERE orderID = ?");
        if ($stmt === false) {
            throw new Exception('Prepare statement failed: ' . $conn->error);
        }
        $stmt->bind_param("s", $arrayData['orderID']);
        if (!$stmt->execute()) {
            throw new Exception('Execute statement failed: ' . $stmt->error);
        }
        $stmt->close();

        // Update stock quantities
        foreach ($orderLines as $orderLine) {
            $sql = "UPDATE sparepart SET stockItemQty = stockItemQty + ? WHERE sparePartNum = ?";
            $stmt = $conn->prepare($sql);
            if ($stmt === false) {
                throw new Exception('Prepare statement failed: ' . $conn->error);
            }

            $stmt->bind_param("ii", $orderLine[4], $orderLine[1]);
            if (!$stmt->execute()) {
                throw new Exception('Execute statement failed: ' . $stmt->error);
            }
            $stmt->close();
        }
        echo json_encode(['status' => 'success', 'message' => 'Order cancelled successfully']);
    }

    // Commit the transaction
    $conn->commit();
} catch (Exception $e) {
    // Rollback the transaction on error
    $conn->rollback();
    echo json_encode(['status' => 'error', 'message' => $e->getMessage()]);
}

// Close the connection
$conn->close();
?>