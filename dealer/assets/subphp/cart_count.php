<?php
// cart_count.php - Script to count the number of items in the shopping cart and return it as JSON.

session_start(); // Start or resume the current session to access session variables.

$total_rows = 0; // Initialize a counter for the total number of items in the cart.

// Check if the 'cart' session variable is set, indicating that there is a cart.
if (isset($_SESSION['cart'])) {
    // Retrieve the cart array from the session.
    $retrievedArray = $_SESSION['cart'];
    // Loop through each item in the cart array and increment the total count.
    foreach ($retrievedArray as $row) {
        $total_rows++; // Increment the counter for each item found in the cart.
    }
}

// Set the content type of the response to JSON, so that the client knows how to parse it.
header('Content-Type: application/json');

// Prepare the response array with the total count of items in the cart.
$response = [
    'cart_count' => $total_rows // Key 'cart_count' holds the total number of items in the cart.
];

// Encode the response array to JSON and output it.
echo json_encode($response);
