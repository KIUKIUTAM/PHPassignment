<?php
require_once('../../../db/connect.php');

$response = array();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_FILES['sparePartImage']) && $_FILES['sparePartImage']['error'] === UPLOAD_ERR_OK) {
        $uploadDir = '../../../assets/img/'; // Directory where the file will be saved
        $databaseDir = '../assets/img/';
        $uploadFile = $uploadDir . basename($_FILES['sparePartImage']['name']);
        $databaseDir = $databaseDir . basename($_FILES['sparePartImage']['name']);

        // Create the uploads directory if it doesn't exist
        if (!is_dir($uploadDir)) {
            mkdir($uploadDir, 0777, true);
        }

        // Move the uploaded file to the specified directory
        if (move_uploaded_file($_FILES['sparePartImage']['tmp_name'], $uploadFile)) {
            $response['success'] = true;
            $response['message'] = 'File uploaded successfully';
        } else {
            $response['success'] = false;
            $response['error'] = 'Failed to move uploaded file';
        }
    }


    $sql = "UPDATE sparepart SET";
    $params = array();
    $types = '';

    if(!isset($_POST['sparePartNum']) && $_POST['sparePartNum'] == "") {
       return;
    }
    if (isset($_POST['sparePartDescription']) && $_POST['sparePartDescription'] != "") {
        $sql .= " sparePartDescription = ?,";
        $params[] = $_POST['sparePartDescription'];
        $types .= 's';
    }
    if (isset($_POST['stockItemQty']) && $_POST['stockItemQty'] != "") {
        $sql .= " stockItemQty = ?,";
        $params[] = $_POST['stockItemQty'];
        $types .= 'i';
    }
    if (isset($_POST['price']) && $_POST['price'] != "") {
        $sql .= " price = ?,";
        $params[] = $_POST['price'];
        $types .= 'd';
    }
    if (isset($_POST['discountPrice']) && $_POST['discountPrice'] != "") {
        $sql .= " discountPrice = ?,";
        $params[] = $_POST['discountPrice'];
        $types .= 'd';
    }
    if (isset($databaseDir) && $databaseDir != "") {
        $sql .= " sparePartImage = ?,";
        $params[] = $databaseDir;
        $types .= 's';
    }
    $sql = rtrim($sql, ",");

    $sql .= " WHERE sparePartNum = ?";
    $params[] = $_POST['sparePartNum'];
    $types .= 's';

    $stmt = $conn->prepare($sql);
    if ($stmt) {
        $stmt->bind_param($types, ...$params);
        if ($stmt->execute()) {
            $response['success'] = true;
            $response['message'] = 'Record updated successfully';
        } else {
            $response['success'] = false;
            $response['error'] = 'Failed to update record';
        }
        $stmt->close();
    } else {
        $response['success'] = false;
        $response['error'] = 'Failed to prepare statement';
    }
}
// Return the response as JSON
header('Content-Type: application/json');
echo json_encode($response);

$conn->close();

// Redirect to the list of products
// Uncomment the lines below if you want to redirect after the JSON response
header('Location: ../../listOfProduct?Category=ALL');
exit();
