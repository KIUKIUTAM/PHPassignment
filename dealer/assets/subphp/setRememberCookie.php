<?php
    // Read the raw POST data from the request body
    $data = file_get_contents('php://input');
    
    // Decode the JSON data into a PHP associative array
    $arrayData = json_decode($data, true);
    
    // Check if 'userName' key exists in the array
    if (isset($arrayData['userName'])) {
        // Assign the 'userName' value to a variable
        $username = $arrayData['userName'];

        // Set a cookie named "username" with the value of $username, expiring in 24 hours
        setcookie("username", $username, time() + (3600 * 24), "/");

        // Send a JSON response indicating success
        echo json_encode(['status' => 'success', 'message' => 'Remember cookie set']);
    } else {
        // Send a JSON response indicating an error due to invalid input
        echo json_encode(['status' => 'error', 'message' => 'Invalid input']);
    }
?>