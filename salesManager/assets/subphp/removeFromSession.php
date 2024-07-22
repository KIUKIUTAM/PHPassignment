<?php
session_start();

header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $input = json_decode(file_get_contents('php://input'), true);

    if (isset($input['spareID'])) {
        $spareID = $input['spareID'];

       
        $retrievedArray = $_SESSION['cart'] ?? [];

        $retrievedArray = array_filter($retrievedArray, function($item) use ($spareID) {
            return $item['spareID'] != $spareID;
        });

      
        $_SESSION['cart'] = $retrievedArray;

        echo json_encode(['status' => 'success', 'message' => 'Item removed successfully']);
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Invalid input']);
    }
} else {
    echo json_encode(['status' => 'error', 'message' => 'Invalid request method']);
}

?>