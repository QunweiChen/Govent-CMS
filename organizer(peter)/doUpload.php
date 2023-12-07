<?php
require_once("../connect_server.php");

if ($_FILES["organizerAvatar"]["error"] > 0) {
    echo "Error: " . $_FILES["organizerAvatar"]["error"];
} else {
    // echo "檔案名稱: " . $_FILES["myfile"]["name"] . "<br/>";
    // echo "檔案類型: " . $_FILES["myfile"]["type"] . "<br/>";
    // echo "檔案大小: " . ($_FILES["myfile"]["size"] / 1024) . " Kb<br />";
    // echo "暫存名稱: " . $_FILES["myfile"]["tmp_name"];

    //在無法判斷檔名是否有中文的情況下，建議使用此方法(iconv( 原來的編碼 , 轉換的編碼 , 轉換的字串 ))避免掉中文檔名無法上傳的問題
    $extension = explode('.', $_FILES["organizerAvatar"]["name"]); //分割
    $ext = end($extension); //抓取尾數副檔名

    $fileName = md5(uniqid(rand())); //產生亂數檔名
    $target_path = "organizer_avatar/"; //指定上傳資料夾
    $target_path .= $fileName . "." . $ext; //合併 檔名 + 副檔名

    if (move_uploaded_file(
        $_FILES['organizerAvatar']['tmp_name'],
        iconv("UTF-8", "big5", $target_path)
    )) {
        // echo "檔案：" . $_FILES['organizerAvatar']['name'] . " 上傳成功!";
        // echo $fileName."<br>";
        // echo $target_path;
        $id = 1;
        $sql = "UPDATE organizer SET avatar = '$fileName' WHERE id = $id";

        if ($conn->query($sql) === TRUE) {
            echo "更新資料完成";
        } else {
            echo "新增資料錯誤: " . $conn->error;
        }
        $conn->close();
    } else {
        echo "檔案上傳失敗，請再試一次!";
    }
}
