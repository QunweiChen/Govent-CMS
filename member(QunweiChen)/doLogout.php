<?php
session_start();

unset($_SESSION["menber"]);

header("location: menber_login.php");

?>

