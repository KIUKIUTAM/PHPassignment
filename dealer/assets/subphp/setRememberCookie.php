<?php
    $data = file_get_contents('php://input');
    $arrayData = json_decode($data, true);
    
    if(isset($arrayData['userName'])){
        $username = $arrayData['userName'];
        setcookie("username", $username, time() + (3600*24), "/");
        echo json_encode(['status' => 'success', 'message' => 'Remember cookie set']);
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Invalid input']);
    }
?>