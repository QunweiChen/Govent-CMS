<?php
require_once("govent_db_conntect.php");

// if(!isset($_POST["name"])){
//     echo "請循正常管道進入此頁";
//     exit;
// }


// $id="512";
// $name="Miya";
// $email="miya@test.com";
// $phone="12345678";
// $password="12345";
// $born_date="2023-11-23 11-11-11";
// $invoice="EF23232ED";
// // 將所有欄位填滿後可以上傳


$id=$_POST["id"];
$name=$_POST["name"];
$email=$_POST["email"];
$phone=$_POST["phone"];
$password=$_POST["password"];
$born_date=$_POST["born_date"];
$invoice=$_POST["invoice"];


// var_dump($name, $email, $phone);
// 可取得

// $sql="UPDATE menber_list SET password='09115156413' WHERE id=476";

$sql="UPDATE menber_list SET name='$name', email='$email', phone='$phone', password='$password', born_date='$born_date', invoice='$invoice' WHERE id=$id";
var_dump($sql);
// 抓不到ID
// 在SQL可以成功上傳

// $sql="UPDATE menber_list SET name='$name' WHERE id=$id";
// 單獨一個資料上傳時可以成，兩個以上無法可以？！！！！*少了逗點

// 測試成功
if($conn->query($sql)===TRUE){
    echo "更新成功";
}else{
    echo "更新資料錯誤: ". $conn->error;
}

$conn->close();



// header("location: menber_edit.php?id=$id");