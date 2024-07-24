<?php
require_once('../../../db/connect.php');

$response = array();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Check if the sparePartNum is set and not empty
    if (!isset($_POST['sparePartNum']) || $_POST['sparePartNum'] == "") {
        $response['success'] = false;
        $response['error'] = 'Missing sparePartNum';
        echo json_encode($response);
        exit();
    }

    $sparePartNum = $_POST['sparePartNum'];

    // Handle file upload
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
            $response['file_upload_success'] = true;
            $response['file_upload_message'] = 'File uploaded successfully';
        } else {
            $response['file_upload_success'] = false;
            $response['file_upload_error'] = 'Failed to move uploaded file';
        }
    }

    // Prepare the SQL query
    $sql = "UPDATE sparepart SET";
    $params = array();
    $types = '';

    // Check and bind parameters
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

    // Remove trailing comma and add WHERE clause
    $sql = rtrim($sql, ",");
    $sql .= " WHERE sparePartNum = ?";
    $params[] = $sparePartNum;
    $types .= 's';

    // Prepare and execute the statement
    $stmt = $conn->prepare($sql);
    if ($stmt) {
        $stmt->bind_param($types, ...$params);
        if ($stmt->execute()) {
            $response['success'] = true;
            $response['message'] = 'Record updated successfully';
        } else {
            $response['success'] = false;
            $response['error'] = 'Failed to update record: ' . $stmt->error;
        }
        $stmt->close();
    } else {
        $response['success'] = false;
        $response['error'] = 'Failed to prepare statement: ' . $conn->error;
    }
} else {
    $response['success'] = false;
    $response['error'] = 'Invalid request method';
}

// Return the response as JSON
header('Content-Type: application/json');
echo json_encode($response);

$conn->close();

// Redirect to the list of products
header('Location: ../../listOfProduct?Category=ALL');
exit();
?>