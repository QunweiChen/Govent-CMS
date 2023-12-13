<?php

$severname= "localhost";
$username = "admin";
$password = "angus1009";
$dbname= "govent";

$conn = new mysqli($severname, $username, $password, $dbname);

if($conn->connect_error){
    die("connection failed: ". $conn->connect_error);
}else{
    // echo "connection successful";
};

?>