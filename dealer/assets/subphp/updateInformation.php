<?php
require_once('../../../db/connect.php'); // Include the database connection file
session_start(); // Start the session to access session variables

// Check if the form is submitted
if (isset($_POST['submit'])) {
    // Initialize variables
    $name = "";
    $phone = "";
    $faxNumber = "";
    $address = "";
    $password = "";

    // Base SQL query for updating the dealer
    $sql = "UPDATE dealer SET";

    // Array to hold the fields to be updated
    $updates = [];

    // Check and prepare the 'name' field for update
    if (isset($_POST['nameForUpdate']) && trim($_POST['nameForUpdate']) != "") {
        $name = trim($_POST['nameForUpdate']);
        $updates[] = " dealerName='$name'";
    }

    // Check and prepare the 'contactNumber' field for update
    if (isset($_POST['contactNumberForUpdate']) && trim($_POST['contactNumberForUpdate']) != "") {
        $phone = trim($_POST['areaCodeForUpdate']) . '-' . trim($_POST['contactNumberForUpdate']);
        $updates[] = " contactNumber='$phone'";
    }

    // Check and prepare the 'faxNumber' field for update
    if (isset($_POST['faxNumberForUpdate']) && trim($_POST['faxNumberForUpdate']) != "") {
        $faxNumber = trim($_POST['faxAreaCodeForUpdate']) . '-' . trim($_POST['faxNumberForUpdate']);
        $updates[] = " faxNumber='$faxNumber'";
    }

    // Check and prepare the 'deliveryAddress' field for update
    if (isset($_POST['deliveryAddressForUpdate']) && trim($_POST['deliveryAddressForUpdate']) != "") {
        $address = trim($_POST['deliveryAddressForUpdate']);
        $updates[] = " deliveryAddress='$address'";
    }

    // Check and prepare the 'password' field for update
    if (isset($_POST['passwordForUpdate']) && trim($_POST['passwordForUpdate']) != "") {
        $password = trim($_POST['passwordForUpdate']);
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
        $updates[] = " password='$hashedPassword'";
    }

    // Check if there are fields to update
    if (!empty($updates)) {
        // Append the fields to the base SQL query
        $sql .= implode(",", $updates);
        // Add the condition to update the specific dealer based on the session email
        $sql .= " WHERE dealerEmail = '" . $_SESSION['dealer'] . "'";

        // Debugging alert to show the SQL query
        echo "<script>alert('SQL: " . $sql . "');</script>";

        // Execute the SQL query and check for success
        if (mysqli_query($conn, $sql)) {
            // Success alert and redirect
            echo "<script>alert('Update Success!'); location.replace('../../information.php');</script>";
        } else {
            // Failure alert and redirect
            echo "<script>alert('Update Fail!'); location.replace('../../information.php');</script>";
        }
        $stmt = $conn->prepare("SELECT dealerEmail,password,dealerName,deliveryAddress FROM dealer WHERE dealerEmail = ?");
        $stmt->bind_param("s", $_SESSION['dealer']);
        $stmt->execute();
        $result = $stmt->get_result();
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();

            if (empty($row['dealerName']) || empty($row['deliveryAddress'])) {
                $_SESSION['informationCompleted'] = false;
            } else {
                $_SESSION['informationCompleted'] = true;
                exit();
            }
        } else {
            echo "<script>alert('Invalid LoginEmail or password'); location.replace('../../../index.php');</script>";
        }
    } else {
        // Alert if no fields are provided for update and redirect
        echo "<script>alert('No fields to update!'); location.replace('../../information.php');</script>";
    }

    // Close the database connection
    mysqli_close($conn);
}
