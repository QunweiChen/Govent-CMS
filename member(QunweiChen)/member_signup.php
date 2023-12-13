<?php
session_start();

if(isset($_SESSION["member"])){
    // header("location: member_dashboard.php");
    //若已登入 導入至dashboard
}
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

    <?php include('../public_head.php') ?>

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
                                <h1 class="h4 text-gray-900 mb-4 font-weight-bolder">註冊新帳號</h1>
                            </div>
                            <form action="doSignup.php" method="post" class="user">
                                <!-- name -->
                                <div class="form-group">
                                    <!-- <div class="col-sm-6 mb-3 mb-sm-0"> -->
                                        <input type="text"  name="name" class="form-control form-control-user" id="exampleName"
                                        placeholder="姓名">
                                    <!-- </div> -->
                                    <!-- <div class="col-sm-6">
                                        <input type="text" class="form-control form-control-user" id="exampleLastName"
                                            placeholder="Last Name">
                                    </div> -->
                                </div>
                                <!-- email -->
                                <div class="form-group">
                                    <input name="email" 
                                    type="email" 
                                    class="form-control form-control-user" id="exampleInputEmail"
                                    placeholder="Email">
                                </div>
                                <!-- phone -->
                                <div class="form-group">
                                    <input name="phone" 
                                    type="text" 
                                    class="form-control form-control-user" id="exampleInputEmail"
                                    placeholder="電話">
                                </div>
                                
                                <!-- password -->
                                <div class="form-group row">
                                    <div class="col-sm-6 mb-3 mb-sm-0">
                                        <input name="password" type="password" class="form-control form-control-user"
                                        id="exampleInputPassword" placeholder="密碼">
                                    </div>
                                    <div class="col-sm-6">
                                        <input name="repassword" type="password" class="form-control form-control-user"
                                        id="exampleRepeatPassword" placeholder="密碼確認">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <input name="national_id" 
                                    type="text" 
                                    class="form-control form-control-user" id="exampleInputEmail"
                                    placeholder="身分證">
                                </div>
                                <div class="form-group">
                                    <input name="born_date" 
                                    type="text" 
                                    class="form-control form-control-user" id="exampleInputEmail"
                                    placeholder="出生日期">
                                </div>
                                <div class="form-group">
                                    <input name="invoice" 
                                    type="text" 
                                    class="form-control form-control-user" id="exampleInputEmail"
                                    placeholder="電子發票">
                                </div>
                                <?php if(isset($_SESSION["error"]["message"])): ?>
                                    <div class="mt-2 text-danger">
                                        <?=$_SESSION["error"]["message"]?>
                                    </div>
                                <?php endif; ?>
                                <button type="submit" href="#" class="btn btn-primary btn-user btn-block">
                                    註冊新帳號
                                </button>
                            </form>
                            <hr>    
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