<?php
require_once ('../db/connet.php');
?>
<?php
$dealerEmail = $_POST['userEmail'];
$password = $_POST['password'];
$stmt = $conn->prepare("Insert into dealer (dealerEmail, password) values (?, ?)");
$stmt->bind_param("ss", $dealerEmail, $password);
if ($stmt->execute()) {
    echo "<script>alert('Register successfully');</script>";
    
} else {
    echo "<script>alert('Error inserting email: ". $stmt->error."');</script>";
}

$stmt->close();
$conn->close();
echo "<script>window.location.replace(
  '../index.php',
);</script>";
?>