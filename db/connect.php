<?php 
    $hostname = "localhost";
    $username = "root";
    $password = "";
    $database = "projectdb";
    
    $conn = mysqli_connect($hostname,$username,$password,$database);

    if(!$conn){
        die("Connection failded". mysqli_connect_error());
    } else{
    
    }
?>