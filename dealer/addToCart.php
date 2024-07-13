<?php 
session_start();

$data = file_get_contents('php://input');
$arrayData = json_decode($data, true);

if (!$arrayData || !isset($arrayData['spareID']) || !isset($arrayData['spareQty'])) {
    echo json_encode(['status' => 'error', 'message' => 'Invalid input']);
    exit;
}

$spareID = $arrayData['spareID'];
$spareQty = $arrayData['spareQty'];

if (isset($_SESSION['cart'])) {
    $session_array_id = array_column($_SESSION['cart'], "spareID");
    if (!in_array($spareID, $session_array_id)) {
        // Item does not exist, add new item
        $session_array = array(
            "spareID" => $spareID,
            "spareQty" => $spareQty
        );
        $_SESSION['cart'][] = $session_array;
    } else {
        // Item exists, update quantity
        foreach ($_SESSION['cart'] as &$value) {
            if ($value["spareID"] == $spareID) {
                // Update quantity
                $value['spareQty'] += $spareQty;
                break; // Stop the loop after updating
            }
        }
    }
} else {
    // Cart does not exist, create new cart and add item
    $session_array = array(
        "spareID" => $spareID,
        "spareQty" => $spareQty
    );
    $_SESSION['cart'][] = $session_array;
}

echo json_encode(['status' => 'success', 'message' => 'Item added to cart']);
?>