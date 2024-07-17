<?php
require_once('../db/connet.php'); 
session_start();
if (isset($_POST['submit'])) {
  
    $name =""; $phone =""; $faxNumber =""; $address =""; $password ="";
    $sql = "UPDATE dealer SET";
    $updates = [];
    
    if (isset($_POST['nameForUpdate'])&&trim($_POST['nameForUpdate']) != "") {
        $name = trim($_POST['nameForUpdate']);
        $updates[] = " dealerName='$name'";
    }
    if (isset($_POST['contactNumberForUpdate'])&&trim($_POST['contactNumberForUpdate']) != "") {
        $phone = trim($_POST['areaCodeForUpdate']) .'-'. trim($_POST['contactNumberForUpdate']);
        $updates[] = " contactNumber='$phone'";
    }
    if (isset($_POST['faxNumberForUpdate'])&&trim($_POST['faxNumberForUpdate']) != "") {
        $faxNumber = trim($_POST['faxAreaCodeForUpdate']) .'-'. trim($_POST['faxNumberForUpdate']);
        $updates[] = " faxNumber='$faxNumber'";
    }
    if (isset($_POST['deliveryAddressForUpdate'])&&trim($_POST['deliveryAddressForUpdate']) != "") {
        $address = trim($_POST['deliveryAddressForUpdate']);
        $updates[] = " deliveryAddress='$address'";
    }
    if (isset($_POST['passwordForUpdate'])&&trim($_POST['namepasswordForUpdateForUpdate']) != "") {
        $name = trim($_POST['passwordForUpdate']);
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
        $updates[] = " password='$hashedPassword'";
    }
    
    if (!empty($updates)) {
        $sql .= implode(",", $updates);
        $sql .= " WHERE dealerEmail = '".$_SESSION['dealer']."'"; 

        echo "<script>alert('SQL: " . $sql . "');</script>";

        if (mysqli_query($conn, $sql)) {
            echo "<script>alert('Update Success!'); location.replace('./information.php');</script>";
        } else {
            echo "<script>alert('Update Fail!'); location.replace('./information.php');</script>";
        }
    } else {
        echo "<script>alert('No fields to update!'); location.replace('./information.php');</script>";
    }

    mysqli_close($conn);
}
?>