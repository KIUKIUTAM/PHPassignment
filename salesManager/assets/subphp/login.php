<?php
require_once('../../../db/connect.php');
session_start(); // Start the session at the beginning of the script

if (isset($_POST['userEmailForLogin'])) {
    // Fetch the form data
    $managerEmail = $_POST['userEmailForLogin'];
    $password = $_POST['passwordForLogin'];

    // Check the connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Use prepared statements to prevent SQL injection
    $stmt = $conn->prepare("SELECT salesManagerID,managerEmail,password FROM salesmanager WHERE managerEmail = ?");
    $stmt->bind_param("s", $managerEmail);
    $stmt->execute();
    $result = $stmt->get_result();

    // Check if any rows are returned
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();

        // Verify the password
        if (password_verify($password, $row['password'])) {
            $_SESSION['managerEmail'] = $row['managerEmail'];
            $_SESSION['managerID'] = $row['salesManagerID'];
            echo "<script>location.replace('../../homepage.php');</script>";
            exit();
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
