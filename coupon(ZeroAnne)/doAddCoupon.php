<?php
require_once("../connect_server.php");
session_start();
if (!isset($_POST["name"])) {
    echo "請循正常管道進入";
    die;
}

// if (!isset($_POST["couponValid"], $_POST["discountType"])) {
//     echo "請輸入資料";
//     die;
// }
$_SESSION["error"]["filledData"] = $_POST;
if($_POST["startAt"] > $_POST["expiresAt"]){
    $message="請輸入正確日期";
    $_SESSION["error"]["message"]=$message;
    header("location: add-coupon.php");
    exit;
}
if(empty($_POST["name"] && $_POST["couponValid"] && $_POST["discountType"] && $_POST["discountValid"] && $_POST["startAt"] && $_POST["expiresAt"] && $_POST["priceMin"] && $_POST["maxUsage"] && $_POST["activityNum"] )){
    $message="請輸入所有欄位資料";
    $_SESSION["error"]["message"]=$message;
    header("location: add-coupon.php");
    exit;
}

$code = $_POST["code"];
$name = $_POST["name"];
$couponValid = $_POST["couponValid"];
$discountType = $_POST["discountType"];
$discountValid = $_POST["discountValid"];
$startAt = $_POST["startAt"];
$expiresAt = $_POST["expiresAt"];
$priceMin = $_POST["priceMin"];
$maxUsage = $_POST["maxUsage"];
$activityNum = $_POST["activityNum"];

//echo "$couponValid,$discountType,$code,$name,$discountValid,$startAt,$expiresAt,$priceMin,$maxUsage,$activityNum";

$sql = "INSERT INTO coupon (coupon_code, coupon_name, coupon_valid, discount_type, discount_valid, start_at, expires_at, price_min, max_usage, activity_num )
VALUES ('$code', '$name', '$couponValid', '$discountType', '$discountValid', '$startAt', '$expiresAt', '$priceMin', '$maxUsage', '$activityNum')";

if ($conn->query($sql) === TRUE) {
    echo "新增資料完成";
    $last_id = $conn->insert_id; //抓新增id名
    echo "最新一筆序號" . $last_id;
    $sqlcoupon = "SELECT * FROM coupon WHERE id=$last_id";
    $resultcoupon = $conn->query($sqlcoupon);
    $rowcoupon = $resultcoupon->fetch_assoc();
    var_dump($rowcoupon);
    session_destroy();
    header("location:coupon.php?id={$last_id}");
    
} else {
    echo "新增資料錯誤: " . $conn->error;
}
$conn->close();
