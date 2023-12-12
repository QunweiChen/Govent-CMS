<?php
require_once("govent_db_conntect.php");


$email=$_POST["email"];
$password=$_POST["password"];

// $password=md5($password);
// var_dump($email, $password);

// $sql="SELECT id, email, password FROM menber_list WHERE email='$email' AND password='$password' AND valid 1";

$sql="SELECT * FROM menber_list WHERE name='yuina'";

$result = $conn -> query($sql);
// var_dump($result);

$rows=$result->fetch_all(MYSQLI_ASSOC);
var_dump($rows);
