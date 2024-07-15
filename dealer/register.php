<?php
require_once('../db/connet.php');

$dealerEmail = $_POST['userEmailForRegister'];
$password = $_POST['passwordForRegister'];

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$stmt = $conn->prepare("SELECT * FROM dealer WHERE dealerEmail = ?");
$stmt->bind_param("s", $dealerEmail);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    echo "<script>alert('Email already exists');location.replace('../index.php');</script>";
} else {
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    $stmt = $conn->prepare("INSERT INTO dealer (dealerEmail, password) VALUES (?, ?)");
    $stmt->bind_param("ss", $dealerEmail, $hashedPassword);
    if ($stmt->execute()) {
        echo "<script>alert('Register successfully'); location.replace('../index.php');</script>";
    } else {
        echo "<script>alert('Error inserting email: " . $stmt->error . "'); location.replace('../index.php');</script>";
    }
}

$stmt->close();
$conn->close();
?>