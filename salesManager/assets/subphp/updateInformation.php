<?php
require_once('../../../db/connect.php');
session_start();

if (isset($_POST['submit'])) {
    // Initialize variables
    $name = "";
    $phone = "";
    $faxNumber = "";
    $address = "";
    $password = "";
    $updates = [];

    // Collect data from the form
    if (isset($_POST['nameForUpdate']) && trim($_POST['nameForUpdate']) != "") {
        $name = trim($_POST['nameForUpdate']);
        $updates['dealerName'] = $name;
    }
    if (isset($_POST['contactNumberForUpdate']) && trim($_POST['contactNumberForUpdate']) != "") {
        $phone = trim($_POST['areaCodeForUpdate']) . '-' . trim($_POST['contactNumberForUpdate']);
        $updates['contactNumber'] = $phone;
    }
    if (isset($_POST['faxNumberForUpdate']) && trim($_POST['faxNumberForUpdate']) != "") {
        $faxNumber = trim($_POST['faxAreaCodeForUpdate']) . '-' . trim($_POST['faxNumberForUpdate']);
        $updates['faxNumber'] = $faxNumber;
    }
    if (isset($_POST['deliveryAddressForUpdate']) && trim($_POST['deliveryAddressForUpdate']) != "") {
        $address = trim($_POST['deliveryAddressForUpdate']);
        $updates['deliveryAddress'] = $address;
    }
    if (isset($_POST['passwordForUpdate']) && trim($_POST['passwordForUpdate']) != "") {
        $password = trim($_POST['passwordForUpdate']);
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
        $updates['password'] = $hashedPassword;
    }

    // If there are fields to update
    if (!empty($updates)) {
        $sql = "UPDATE dealer SET ";
        $params = [];
        $types = '';
        foreach ($updates as $column => $value) {
            $sql .= "$column = ?, ";
            $params[] = $value;
            $types .= 's';
        }
        $sql = rtrim($sql, ', ');  // Remove the trailing comma
        $sql .= " WHERE dealerEmail = ?";
        $params[] = $_SESSION['dealer'];
        $types .= 's';

        // Prepare and bind
        if ($stmt = $conn->prepare($sql)) {
            $stmt->bind_param($types, ...$params);

            // Execute the statement
            if ($stmt->execute()) {
                echo "<script>alert('Update Success!'); location.replace('../../information.php');</script>";
            } else {
                echo "<script>alert('Update Fail!'); location.replace('../../information.php');</script>";
            }

            // Close the statement
            $stmt->close();
        } else {
            echo "<script>alert('Prepare statement failed: " . $conn->error . "'); location.replace('../../information.php');</script>";
        }
    } else {
        echo "<script>alert('No fields to update!'); location.replace('../../information.php');</script>";
    }

    // Close the connection
    $conn->close();
}
?>