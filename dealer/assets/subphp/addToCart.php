<?php
session_start(); // Start or resume the current session

// Retrieve JSON data from the request body
$data = file_get_contents('php://input');
$arrayData = json_decode($data, true); // Decode the JSON data into an associative array

// Validate the input data
if (!$arrayData || !isset($arrayData['spareID']) || !isset($arrayData['spareQty'])) {
    echo json_encode(['status' => 'error', 'message' => 'Invalid input']); // Respond with an error if validation fails
    exit; // Terminate the script
}

$spareID = $arrayData['spareID']; // Extract the spare part ID from the input data
$spareQty = $arrayData['spareQty']; // Extract the quantity of the spare part from the input data

// Check if the cart exists in the session
if (isset($_SESSION['cart'])) {
    // Extract the 'spareID' values from the cart items
    $session_array_id = array_column($_SESSION['cart'], "spareID");
    // Check if the spare part is already in the cart
    if (!in_array($spareID, $session_array_id)) {
        // Item does not exist in the cart, add new item
        $session_array = array(
            "spareID" => $spareID,
            "spareQty" => $spareQty
        );
        $_SESSION['cart'][] = $session_array; // Add the new item to the cart
    } else {
        // Item exists in the cart, update the quantity
        foreach ($_SESSION['cart'] as &$value) {
            if ($value["spareID"] == $spareID) {
                // Update the quantity of the existing item
                $value['spareQty'] += $spareQty;
                break; // Stop the loop after updating
            }
        }
    }
} else {
    // Cart does not exist, create a new cart and add the item
    $session_array = array(
        "spareID" => $spareID,
        "spareQty" => $spareQty
    );
    $_SESSION['cart'][] = $session_array; // Initialize the cart with the first item
}

// Respond with a success message
echo json_encode(['status' => 'success', 'message' => 'Item added to cart']);