<?php
require_once ('../db/connet.php');
?>

<?php
session_start(); // Start the session at the beginning of the script
if (isset($_POST['userEmail'])) {
    // Fetch the form data
    $dealerEmail = $_POST['UserEmail'];
    $password = $_POST['password'];

    // Check the connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Use prepared statements to prevent SQL injection
    $stmt = $conn->prepare("SELECT * FROM dealer WHERE dealerEmail = ? AND password = ?");
    $stmt->bind_param("ss", $dealerEmail, $password);
    $stmt->execute();
    $result = $stmt->get_result();

    // Check if any rows are returned
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $_SESSION['dealer'] = $row['dealerEmail'];
        header("Location: ./homepage.php");
        exit(); // Ensure no further code is executed after redirect
    } else {
        echo "<script>alert('Invalid LoginEmail or password');
          location.replace('../index.php');</script>";
       
    }

    // Close the statement and connection
    $stmt->close();
    $conn->close();
}
?>