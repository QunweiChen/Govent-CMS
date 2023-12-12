<?php
require_once("govent_db_conntect.php");

$name="Arisa";
$email="arisa@test.com.jp";
$password="12345";
$valid="1";


// $name=$_POST["name"];
// $email=$_POST["email"];
// $password=$_POST["password"];
// $repassword=$_POST["repassword"];

// var_dump($name, $email, $password, $repassword);

// if(empty($name)||empty($email)||empty($password)||empty($repassword)){
//     echo "請輸入必填欄位";
//     exit;
// }

// if($password!=$repassword){
//     echo "前後密碼不一致";
// }

$sql="SELECT * FROM menber_list WHERE email='$email'";
$result=$conn->query($sql);
$rowCount=$result->num_rows;
if($rowCount>0){
    die("此email已被註冊");
}
// 資料庫設定空值問題
// SQL寫入語法錯誤  變數名稱不可以重複


$time=date('Y-m-d H-i-s');
// $time=date('2023-11-23 11-11-11');
// $sql="INSERT INTO menber_list (name, email, password, created_at, valid)
// VALUES ('$name', '$email', '$password', '$time', $valid)";

$sqlUser="INSERT INTO menber_list (name, email, password, created_at, valid)
VALUES ('$name', '$email', '$password', '$time', $valid)";

// var_dump($sqlUser); //有取得資料
$resultUser=$conn->query($sqlUser);
// var_dump($resultUser);


if($conn->query($sqlUser)===TRUE){
    echo "更新成功";
}else{
    echo "更新資料錯誤: ". $conn->error;
}



// if ($conn->query($sqlUser) === TRUE) {
//     echo "新增資料完成";
// } else {
//     echo "新增資料錯誤: " . $conn->error;
// }


// if($conn->query($sql) === TRUE){
//     echo "註冊完成, ";
//     $last_id=$conn->insert_id;
//     echo "id序號為".$last_id;
// }else{
//     echo "註冊失敗 錯誤碼：". $conn->error;
// }
