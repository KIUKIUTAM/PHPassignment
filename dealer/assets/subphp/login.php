<?php
require_once('../../../db/connect.php');
session_start(); // Start the session at the beginning of the script

if (isset($_POST['userEmailForLogin'])) {
    // Fetch the form data
    $dealerEmail = $_POST['userEmailForLogin'];
    $password = $_POST['passwordForLogin'];

    // Check the connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    // Use prepared statements to prevent SQL injection
    $stmt = $conn->prepare("SELECT dealerEmail,password,dealerName,deliveryAddress FROM dealer WHERE dealerEmail = ?");
    $stmt->bind_param("s", $dealerEmail);
    $stmt->execute();
    $result = $stmt->get_result();

    // Check if any rows are returned
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();

        // Verify the password
        if (password_verify($password, $row['password'])) {
            $_SESSION['dealer'] = $row['dealerEmail'];
            if (empty($row['dealerName']) || empty($row['deliveryAddress'])) {
                echo "<script>alert('Please complete your profile first'); location.replace('../../information.php');</script>";
                $_SESSION['informationCompleted'] = false;
            } else {
                echo "<script>location.replace('../../homepage.php');</script>";
                exit();
            }
        } else {
            echo "<script>alert('Invalid LoginEmail or password'); location.replace('../../../index.php');</script>";
        }
    } else {
        echo "<script>alert('Invalid LoginEmail or password'); location.replace('../../../index.php');</script>";
    }

    // Close the statement and connection
    $stmt->close();
    $conn->close();
}
?>