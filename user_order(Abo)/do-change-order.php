<?php
require_once("../connect_server.php");

$user_name = $_POST["user_nmae"];
$userid = $_POST["ID"];
//user資料庫
$userSql = "SELECT user.id,user.user_name FROM user";
$userResult = $conn->query($userSql);
$userRows = $userResult->fetch_all(MYSQLI_ASSOC);
//user_order資料庫
$userOrderSql = "SELECT user_order.user_id FROM user_order";
$userOrderResult = $conn->query($userOrderSql);
$userOrderRows = $userOrderResult->fetch_all(MYSQLI_ASSOC);

$changeUserID = '';
foreach ($userRows as $row) {
    if ($row['user_name'] == $user_name) {
        $userExists = true;
        $changeUserID = $row["id"];
        break;
    } else {
        $userExists = false;
    }
};

if ($userExists) {
    $sql = "UPDATE user_order SET user_id ='$changeUserID' WHERE id =$userid ";
} else {
    echo "使用者不存在";
}


if ($conn->query($sql) === TRUE) {
    echo "更新資料完成, ";
} else {
    echo "新增資料錯誤: " . $conn->error;
}
$conn->close();
header("location:change-order.php?id=$userid");
