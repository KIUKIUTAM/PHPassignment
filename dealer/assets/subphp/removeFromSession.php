<?php
session_start(); // Start the session to access session variables

header('Content-Type: application/json'); // Set the content type to JSON for the response

// Check if the request method is POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Decode the JSON input from the request body
    $input = json_decode(file_get_contents('php://input'), true);

    // Check if 'spareID' is set in the input
    if (isset($input['spareID'])) {
        $spareID = $input['spareID']; // Assign the 'spareID' value to a variable

        // Retrieve the cart array from the session, or initialize it as an empty array if it doesn't exist
        $retrievedArray = $_SESSION['cart'] ?? [];

        // Filter the cart array to remove the item with the specified 'spareID'
        $retrievedArray = array_filter($retrievedArray, function($item) use ($spareID) {
            return $item['spareID'] != $spareID;
        });

        // Update the session cart with the filtered array
        $_SESSION['cart'] = $retrievedArray;

        // Send a JSON response indicating success
        echo json_encode(['status' => 'success', 'message' => 'Item removed successfully']);
    } else {
        // Send a JSON response indicating an error due to invalid input
        echo json_encode(['status' => 'error', 'message' => 'Invalid input']);
    }
} else {
    // Send a JSON response indicating an error due to an invalid request method
    echo json_encode(['status' => 'error', 'message' => 'Invalid request method']);
}
?>