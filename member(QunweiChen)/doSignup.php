<?php
require_once("../connect_server.php");
session_start();

$name=$_POST["name"];
$email=$_POST["email"];
$password=$_POST["password"];
$repassword=$_POST["repassword"];
$phone=$_POST["phone"];
$national_id=$_POST["national_id"];
$born_date=$_POST["born_date"];
$invoice=$_POST["invoice"];
$valid="1";

// var_dump($name, $email, $password, $repassword);

if(empty($name)||empty($email)||empty($password)||empty($repassword)||empty($phone)||empty($national_id)||empty($born_date)||empty($invoice)){
    // echo "請輸入必填欄位";
    $message="請輸入必填欄位";
    $_SESSION["error"]["message"]=$message;
    header("location: member_signup.php");
    exit;
}

if($password!=$repassword){
    // echo "前後密碼不一致";
    $message="前後密碼不一致";
    $_SESSION["error"]["message"]=$message;
    header("location: member_signup.php");
    exit;
}

$sql="SELECT * FROM member_list WHERE email='$email'";
$result=$conn->query($sql);
$rowCount=$result->num_rows;
if($rowCount>0){
    // die("此email已被註冊");
    $message="此email已被註冊";
    $_SESSION["error"]["message"]=$message;
    header("location: member_signup.php");
    exit;
}

$time=date('Y-m-d H-i-s');
$sqlUser="INSERT INTO member_list (name, email, password, phone, national_id, born_date, invoice, created_at, valid)
VALUES ('$name', '$email', '$password', '$phone', '$national_id', '$born_date', '$invoice', '$time', 1)";
// var_dump($sqlUser);
$resultUser=$conn->query($sqlUser);

if($conn->query($sqlUser) === TRUE){
    // echo "註冊完成, ";
    // $last_id=$conn -> insert_id;
    // echo "id序號為".$last_id;

    // 註冊完成後引導的登入畫面
    $resultMessage= "註冊完成, id序號為" . $conn->insert_id;
    header("location: member_login.php?messageSuccess=" . urldecode($resultMessage));
    exit;
}else{
    echo "註冊失敗 錯誤碼：". $conn->error;
}
// var_dump($messageA);

