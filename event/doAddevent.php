<?php
require_once("../connect_server.php");

if (isset($_POST["add"])) {
    $event_name = mysqli_real_escape_string($conn, $_POST["event_name"]);
    $event_type_id = mysqli_real_escape_string($conn, $_POST["event_type_id"]);
    $start_date = mysqli_real_escape_string($conn, $_POST["start_date"]);
    $end_date = mysqli_real_escape_string($conn, $_POST["end_date"]);
    $address = mysqli_real_escape_string($conn, $_POST["address"]);
    $merchant_id = mysqli_real_escape_string($conn, $_POST["merchant_id"]);
    $images = mysqli_real_escape_string($conn, $_FILES["images"]["name"]);
    $event_price =mysqli_real_escape_string($conn,$_POST["event_price"]) ;

    $sql = "INSERT INTO event(event_name,event_type_id, start_date, end_date, address, merchant_id,images,event_price,valid) VALUES('$event_name','$event_type_id','$start_date','$end_date','$address','$merchant_id','$images','$event_price',1)";

    //var_dump($images);
    if (mysqli_query($conn, $sql)) {
       // echo "新增資料完成";
    } else {
        echo "新增資料錯誤 ";
    }
}

$conn->close(); 

header("location: event.php");
