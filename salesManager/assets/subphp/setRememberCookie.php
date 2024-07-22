<?php
    $data = file_get_contents('php://input');
    $arrayData = json_decode($data, true);
    
    if(isset($arrayData['ManagerEmail']) ) {//&& isset($arrayData['ManagerPassword']
        $userEmail = $arrayData['ManagerEmail'];
        //$password = $arrayData['ManagerPassword'];
        setcookie("userEmailForManange", $userEmail, time() + (3600*24), "/");// 86400 = 1 day
        //setcookie("passwordForManange", $password, time() + (3600*24), "/");// 86400 = 1 day
        echo json_encode(['status' => 'success', 'message' => 'Remember cookie set']);
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Invalid input']);
    }
?>