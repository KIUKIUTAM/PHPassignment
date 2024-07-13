<?php 
    $hostname = "localhost";
    $username = "root";
    $password = "";
    $database = "php_lmc_system";
    
    $conn = mysqli_connect($hostname,$username,$password,$database);

    if(!$conn){
        die("Connection failded". mysqli_connect_error());
    } else{
    
    }
?>