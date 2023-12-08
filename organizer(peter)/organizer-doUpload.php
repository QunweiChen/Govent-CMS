<?php
require_once("../connect_server.php");

$id = $_POST["id"];
$organizerType = $_POST["organizerType"];
$name = $_POST["name"];
$businessName = $_POST["businessName"];
$businessInvoice = $_POST["businessInvoice"];
$bankName = $_POST["bankName"];
$bankCode = $_POST["bankCode"];
$bankBranch = $_POST["bankBranch"];
$amountNumber = $_POST["amountNumber"];

$currentDateTime = date("Y-m-d H:i:s");


// echo "id: " . $id . "<br/>";
// echo "name: " . $name . "<br/>";
// echo "businessName: " . $businessName . "<br/>";
// echo "businessInvoice: " . $businessInvoice . "<br/>";
// echo "bankName: " . $bankName . "<br/>";
// echo "bankCode: " . $bankCode . "<br/>";
// echo "bankBranch: " . $bankBranch . "<br/>";
// echo "amountNumber: " . $amountNumber . "<br/>";

if (!isset($_POST["id"])) {
    $conn->close();
    header("location: organizer-list.php?");
} elseif ($_POST["organizerType"] == 0) {
    if (!isset($_POST["name"]) || !isset($_POST["bankCode"]) || !isset($_POST["bankName"]) || !isset($_POST["bankBranch"]) || !isset($_POST["amountNumber"])) {
        echo "欄位不可為空";
    } else {
        $sql = "UPDATE organizer SET name = '$name', bank_name = '$bankName', bank_code = '$bankCode', bank_branch = '$bankBranch', amount_number = '$amountNumber', update_at = '$currentDateTime' WHERE id = $id";

        if ($conn->query($sql) === TRUE) {
            echo "更新資料完成";
        } else {
            echo "新增資料錯誤: " . $conn->error;
        }
        $conn->close();
    }
} elseif ($_POST["organizerType"] == 1) {
    if (!isset($_POST["name"]) || !isset($_POST["businessName"]) || !isset($_POST["businessInvoice"]) || !isset($_POST["bankCode"]) || !isset($_POST["bankName"]) || !isset($_POST["bankBranch"]) || !isset($_POST["amountNumber"])) {
        echo "欄位不可為空";
    } else {
        $sql = "UPDATE organizer SET name = '$name', business_name = '$businessName', business_invoice = '$businessInvoice', bank_name = '$bankName', bank_code = '$bankCode', bank_branch = '$bankBranch', amount_number = '$amountNumber', update_at = '$currentDateTime' WHERE id = $id";

        if ($conn->query($sql) === TRUE) {
            echo "更新資料完成";
        } else {
            echo "新增資料錯誤: " . $conn->error;
        }
        $conn->close();
    }
}
header("location: organizer-profile.php?id=$id");
