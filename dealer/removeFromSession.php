<?php
session_start();

header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $input = json_decode(file_get_contents('php://input'), true);

    if (isset($input['spareID'])) {
        $spareID = $input['spareID'];

        // 假设 $retrievedArray 是从会话中检索到的数组
        $retrievedArray = $_SESSION['cart'] ?? [];

        // 过滤掉要删除的项
        $retrievedArray = array_filter($retrievedArray, function($item) use ($spareID) {
            return $item['spareID'] != $spareID;
        });

        // 更新会话中的数组
        $_SESSION['cart'] = $retrievedArray;

        echo json_encode(['status' => 'success', 'message' => 'Item removed successfully']);
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Invalid input']);
    }
} else {
    echo json_encode(['status' => 'error', 'message' => 'Invalid request method']);
}
?>