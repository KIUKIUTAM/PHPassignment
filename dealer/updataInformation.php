<?php
require_once('../db/connet.php'); 
session_start();
if (isset($_POST['submit'])) {
  
    $name = trim($_POST['nameForUpdata']);
    $email = trim($_POST['inputEmailForUpdata']);
    $phone = trim($_POST['areaCodeForUpdata']) . trim($_POST['contactNumberForUpdata']);
    $faxNumber = trim($_POST['faxAreaCodeForUpdata']) . trim($_POST['faxNumberForUpdata']);
    $address = trim($_POST['deliveryAddressForUpdata']);
    $password = trim($_POST['passwordForUpdata']);

    $sql = "UPDATE dealer SET";
    $updates = [];

    if ($name != "") {
        $updates[] = " dealerName='$name'";
    }
    if ($email != "") {
        $updates[] = " dealerEmail='$email'";
    }
    if (trim($_POST['contactNumberForUpdata']) != "") {
        $updates[] = " contactNumber='$phone'";
    }
    if (trim($_POST['faxNumberForUpdata']) != "") {
        $updates[] = " faxNumber='$faxNumber'";
    }
    if ($address != "") {
        $updates[] = " deliveryAddress='$address'";
    }
    if ($password != "") {
        $updates[] = " password='$password'";
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