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
    } else {
        $response['success'] = false;
        $response['error'] = 'No file uploaded or there was an upload error';
    }

    if ($response['success']) {
        $category = $_POST['Category']; // 1=Sheet Metal, 2=Major Assemblies, 3=Light Components, 4=Accessories
        $categoryLike = $category . '%';

        // Prepare the SQL query to get the last spare part number
        $stmt = $conn->prepare("SELECT sparePartNum FROM sparepart WHERE sparePartNum LIKE ? ORDER BY sparePartNum DESC LIMIT 1");
        $stmt->bind_param('s', $categoryLike);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $CategorylastID = (int)substr($row['sparePartNum'], strlen($category)) + 1;
        } else {
            $CategorylastID = 1;
        }

        $sparePartNum = $category . sprintf('%05d', $CategorylastID);
        $discountPrice = $_POST['discountPrice'] == '' ? NULL : $_POST['discountPrice'];
        // Prepare the SQL query to insert the new spare part
        $stmt = $conn->prepare("INSERT INTO sparepart (sparePartNum, sparePartName, sparePartDescription, stockItemQty, weight, price, discountPrice, sparePartImage) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param(
            'issiddds',
            $sparePartNum,
            $_POST['sparePartName'],
            $_POST['sparePartDescription'],
            $_POST['stockItemQty'],
            $_POST['weight'],
            $_POST['price'],
            $discountPrice,
            $databaseDir
        );

        if ($stmt->execute()) {
            $response['success'] = true;
            $response['message'] = 'Database insert successfully';
        } else {
            $response['success'] = false;
            $response['error'] = 'Database insert failed: ' . $stmt->error;
        }

        $stmt->close();
    }
} else {
    $response['success'] = false;
    $response['error'] = 'Invalid request method';
}

// Return the response as JSON
header('Content-Type: application/json');
echo json_encode($response);


$conn->close();
header('Location: ../../listOfProduct?Category=ALL');
?>