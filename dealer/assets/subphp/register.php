<?php
require_once('../../../db/connect.php'); // Include the database connection

// Retrieve the dealer's email and password from the POST request
$dealerEmail = $_POST['userEmailForRegister'];
$password = $_POST['passwordForRegister'];

// Check if the database connection has any errors
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error); // Terminate script if connection fails
}

// Prepare an SQL statement to check if the email already exists in the dealer table
$stmt = $conn->prepare("SELECT * FROM dealer WHERE dealerEmail = ?");
$stmt->bind_param("s", $dealerEmail); // Bind the dealer email to the SQL statement
$stmt->execute(); // Execute the SQL statement
$result = $stmt->get_result(); // Get the result set

// Check if any rows are returned, indicating the email already exists
if ($result->num_rows > 0) {
    // If email exists, alert the user and redirect to the index page
    echo "<script>alert('Email already exists');location.replace('../../../index.php');</script>";
} else {
    // If email does not exist, hash the password
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    // Prepare an SQL statement to insert the new dealer into the dealer table
    $stmt = $conn->prepare("INSERT INTO dealer (dealerEmail, password) VALUES (?, ?)");
    $stmt->bind_param("ss", $dealerEmail, $hashedPassword); // Bind the dealer email and hashed password to the SQL statement
    
    // Execute the insert statement and check if it was successful
    if ($stmt->execute()) {
        // If insert is successful, alert the user and redirect to the index page
        echo "<script>alert('Register successfully'); location.replace('../../../index.php');</script>";
    } else {
        // If there is an error inserting the email, alert the user with the error message and redirect to the index page
        echo "<script>alert('Error inserting email: " . $stmt->error . "'); location.replace('../../../index.php');</script>";
    }
}

// Close the statement and database connection
$stmt->close(); // Close the statement
$conn->close(); // Close the database connection
?>