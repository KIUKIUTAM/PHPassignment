<?php
require_once('../../../db/connect.php');
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
if (!isset($arrayData['approveOrReject'])) {
    die(json_encode(['status' => 'error', 'message' => 'Invalid approveOrReject']));
}
if (!isset($arrayData['salesManagerID'])) {
    die(json_encode(['status' => 'error', 'message' => 'Invalid salesManagerID']));
}
if (!isset($arrayData['orderLine']) || !is_array($arrayData['orderLine'])) {
    die(json_encode(['status' => 'error', 'message' => 'Invalid orderLine']));
}

$orderID = $arrayData['orderID'];
$approveOrReject = $arrayData['approveOrReject'];
$salesManagerID = $arrayData['salesManagerID'];
$timezone = new DateTimeZone('Asia/Hong_Kong');
$currentDateTime = new DateTime('now', $timezone);

// Define the specific times
$nineAM = new DateTime('today 9:00 AM', $timezone);
$twoPM = new DateTime('today 2:00 PM', $timezone);
$fivePM = new DateTime('today 5:00 PM', $timezone);

// Determine the new time based on the current time
if ($currentDateTime < $nineAM) {
    // Before 9:00 AM
    $newTime = $nineAM;
} elseif ($currentDateTime < $twoPM) {
    // Between 9:00 AM and 2:00 PM
    $newTime = $twoPM;
} elseif ($currentDateTime < $fivePM) {
    // Between 2:00 PM and 5:00 PM
    $newTime = $fivePM;
} else {
    // After 5:00 PM, set to 9:00 AM the next day
    $newTime = new DateTime('tomorrow 9:00 AM');
}
$newTime->modify('+2 day');
$newDeliveryDate = $newTime->format('Y-m-d H:i:s');
// Begin transaction
$conn->begin_transaction();

try {
    // Prepare the SQL query for orders
    if ($approveOrReject == 1) { // approve
        $sql = "UPDATE `orders` SET `orderStatus` = 2, `salesManagerID` = ?,`deliveryDate` = ? WHERE `orderID` = ?"; // wait for delivery
        $stmt = $conn->prepare($sql);
        if ($stmt === false) {
            throw new Exception('Prepare statement failed: ' . $conn->error);
        }
        $stmt->bind_param("iss", $salesManagerID, $newDeliveryDate, $orderID);
        if (!$stmt->execute()) {
            throw new Exception('Execute statement failed: ' . $stmt->error);
        }
    } else { // reject
        $sql = "UPDATE `orders` SET `orderStatus` = 6 WHERE `orderID` = ?"; // rejected
        $stmt = $conn->prepare($sql);
        if ($stmt === false) {
            throw new Exception('Prepare statement failed: ' . $conn->error);
        }
        $stmt->bind_param("s", $orderID);
        if (!$stmt->execute()) {
            throw new Exception('Execute statement failed: ' . $stmt->error);
        }
    }
    $stmt->close();


    if ($approveOrReject == 1) {
        // Update stock quantities
        foreach ($arrayData['orderLine'] as $orderLine) {
            if (!isset($orderLine[4]) || !isset($orderLine[1])) {
                throw new Exception('Invalid orderLine data');
            }

            $sql = "UPDATE `sparepart` SET `stockItemQty` = `stockItemQty` - ? WHERE `sparePartNum` = ?";
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
    }
    // Commit transaction
    $conn->commit();
    echo json_encode(['status' => 'success', 'message' => 'Order processed successfully']);
} catch (Exception $e) {
    // Rollback transaction on error
    $conn->rollback();
    echo json_encode(['status' => 'error', 'message' => $e->getMessage()]);
} finally {
    $conn->close();
}
