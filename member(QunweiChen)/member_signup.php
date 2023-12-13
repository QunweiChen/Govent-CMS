<?php

session_start();
session_destroy();
if(isset($_SESSION["member"])){
    // header("location: member_dashboard.php");
    //若已登入 導入至dashboard
}

// 拉取地址資歷庫
require_once("govent_db_conntect.php");
$sql = "SELECT * FROM city";
$result = $conn->query($sql);
// var_dump($result);

if ($result->num_rows > 0) {
    $addresses = $result->fetch_all(MYSQLI_ASSOC);
    // echo "成功";
}
$conn->close();

?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title> Sign Up</title>

    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <!-- font awesome link -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"
        integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- bootstrap icon link -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.2/font/bootstrap-icons.min.css">
    <!-- 字體連結 -->
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">
    <link
        href="https://fonts.googleapis.com/css2?family=Noto+Sans+TC:wght@100;200;300;400;500;600;700;800;900&display=swap"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="css/govent.css" rel="stylesheet">

</head>

<body class="bg-gradient-primary">

    <div class="container">

        <div class="card o-hidden border-0 shadow-lg my-5">
            <div class="card-body p-0">
                <!-- Nested Row within Card Body -->
                <div class="row">
                    <div class="col-lg-5 d-none d-lg-block bg-register-image"></div>
                    <div class="col-lg-7">
                        <div class="p-5">
                            <div class="text-center">
                                <h1 class="h4 text-gray-900 mb-4">註冊新帳號!</h1>
                            </div>
                            <form action="doSignup.php" method="post" class="user">
                                <!-- name -->
                                <!-- <label>姓名</label> -->
                                <div class="form-group">
                                    <!-- <div class="col-sm-6 mb-3 mb-sm-0"> -->
                                        <input type="text"  name="name" class="form-control form-control-user" id="exampleName"
                                        placeholder="姓名"
                                        maxlength="50">
                                    <!-- </div> -->
                                    <!-- <div class="col-sm-6">
                                        <input type="text" class="form-control form-control-user" id="exampleLastName"
                                            placeholder="Last Name">
                                    </div> -->
                                </div>
                                <!-- email -->
                                <!-- <label>Email</label> -->
                                <div class="form-group">
                                    <input name="email" 
                                    type="email" 
                                    class="form-control form-control-user" id="exampleInputEmail"
                                    placeholder="Email" maxlength="50">
                                </div>
                                <!-- phone -->
                                <!-- <label>phone</label> -->
                                <div class="form-group">
                                    <input name="phone" 
                                    type="text" 
                                    class="form-control form-control-user" id="exampleInputEmail"
                                    placeholder="電話" maxlength="30">
                                </div>
                                
                                <!-- password -->
                                <!-- <label>密碼</label> -->
                                <div class="form-group row">
                                    <div class="col-sm-6 mb-3 mb-sm-0">
                                        <input name="password" type="password" class="form-control form-control-user"
                                        id="exampleInputPassword" placeholder="密碼"maxlength="50">
                                    </div>
                                    <div class="col-sm-6">
                                        <input name="repassword" type="password" class="form-control form-control-user"
                                        id="exampleRepeatPassword" placeholder="密碼確認" maxlength="50">
                                    </div>
                                </div>

                                <!-- national ID -->
                                <!-- <label>身分證</label> -->
                                <div class="form-group">
                                    <input name="national_id" 
                                    type="text" 
                                    class="form-control form-control-user" id="exampleInputEmail"
                                    placeholder="身分證" maxlength="30">
                                </div>

                                <!-- address -->
                                <!-- <label class="col">居住地</label> -->
                                <div class="form-group">
                                    <!-- <label class="col-3">居住地</label> -->
                                    <select type="text" name="address" class="input-group-text form-control-lg rounded-pill col" id="address" placeholder="居住地">
                                        <?php foreach($addresses as $address): ?>
                                            <option value="<?= $address["city_id"]; ?>">
                                                <?= $address["city_name"]; ?>, <?= $address["dist_name"]; ?>
                                            </option>
                                        <?php endforeach; ?>                               
                                    </select>          

                                </div>

                                <!-- gender -->
                                <div class="form-group row">
                                    <label class="col-3 m-s-5 text-gray-700">性別</label>
                                    <label class="col text-gray-700">女性</label>
                                    <div class="col">
                                        <input name="gender" 
                                        type="radio" 
                                        class="form-control form-control-sm text-gray-700"
                                        id="exampleInputGender" value="2"
                                        >
                                    </div>
                                    <label class="col text-gray-700">男性</label>
                                    <div class="col">
                                        <input name="gender" 
                                        type="radio" 
                                        class="form-control form-control-sm text-gray-700" 
                                        id="exampleInputGender" value="1"
                                        >
                                    </div>
                                </div>

                                <!-- born date -->
                                <!-- <label>出生日期</label> -->
                                <div class="form-group">
                                    <input name="born_date" 
                                    type="date" 
                                    class="form-control form-control-user" id="exampleInputEmail"
                                    placeholder="出生日期">
                                </div>
                                <!-- invoice -->
                                <!-- <label>電子發票</label> -->
                                <div class="form-group">
                                    <input name="invoice" 
                                    type="text" 
                                    class="form-control form-control-user" id="exampleInputEmail"
                                    placeholder="電子發票" maxlength="10">
                                </div>
                                <?php if(isset($_SESSION["error"]["message"])): ?>
                                    <div class="mt-2 text-danger">
                                        <?=$_SESSION["error"]["message"]?>
                                    </div>
                                <?php endif; ?>
                                <button type="submit" href="#" class="btn btn-primary btn-user btn-block">
                                    註冊新帳號
                                </button>
                                <!-- <hr>
                                <a href="index.html" class="btn btn-google btn-user btn-block">
                                    <i class="fab fa-google fa-fw"></i> 透過 google 註冊
                                </a>
                                <a href="index.html" class="btn btn-facebook btn-user btn-block">
                                    <i class="fab fa-facebook-f fa-fw"></i> 透過 Facebook 註冊
                                </a> -->
                            </form>
                            <hr>
                            <div class="text-center">
                                <a class="small" href="forgot-password.html">忘記密碼?</a>
                            </div>
                            <div class="text-center">
                                <a class="small" href="member_login.php">已經有帳號? 登入!</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="js/govent.js"></script>

</body>

</html>