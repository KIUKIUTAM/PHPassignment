<?php
// cart_count.php
session_start();
$total_rows = 0;
if (isset($_SESSION['cart'])) {
    $retrievedArray = $_SESSION['cart'];
    foreach ($retrievedArray as $row) {
        $total_rows++;
    }
}
header('Content-Type: application/json');
$response = [
    'cart_count' => $total_rows,
];

echo json_encode($response);
?>