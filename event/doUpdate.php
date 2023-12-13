<?php
require_once("../connect_server.php");



if(isset($_POST["update"])){
    $id =mysqli_real_escape_string($conn,$_POST["id"]) ;

    $event_name =mysqli_real_escape_string($conn,$_POST["event_name"]) ;
    $event_type_id =mysqli_real_escape_string($conn,$_POST["event_type_id"]) ;
    $start_date =mysqli_real_escape_string($conn,$_POST["start_date"]) ;
    $end_date =mysqli_real_escape_string($conn,$_POST["end_date"]) ;
    $address =mysqli_real_escape_string($conn,$_POST["address"]) ;
    $merchant_id =mysqli_real_escape_string($conn,$_POST["merchant_id"]) ;
    $images =mysqli_real_escape_string($conn,$_FILES["images"]["name"]) ;
    $event_price =mysqli_real_escape_string($conn,$_POST["event_price"]) ;

    $sql="UPDATE event SET event_name='$event_name',start_date='$start_date',end_date='$end_date',address='$address',merchant_id='$merchant_id',images='$images',event_price='$event_price' WHERE id=$id AND valid=1";

    if(mysqli_query($conn,$sql)){
        //echo "更新資料完成";
    }else{
        echo "更新資料錯誤 ";
    }

}



$conn->close(); 

header("location: event.php?id=$id");

?>