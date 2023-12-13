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

    <title>member login</title>

    <?php include('../public_head.php') ?>

</head>

<body class="bg-gradient-primary">

    <div class="container">

        <!-- Outer Row -->
        <div class="row justify-content-center">

            <div class="col-xl-10 col-lg-12 col-md-9">

                <div class="card o-hidden border-0 shadow-lg my-5">
                    <div class="card-body p-0">
                        <!-- Nested Row within Card Body -->
                        <div class="row">
                            <div class="col-lg-6 d-none d-lg-block bg-login-image"></div>
                            <div class="col-lg-6">
                                <div class="p-5">
                                    <div class="text-center">
                                        <h1 class="h4 text-gray-900 mb-4 font-weight-bolder">歡迎回來!</h1>
                                    </div>
                                    <?php if (isset($_GET['messageSuccess'])) {
                                        $resultMessage = urldecode($_GET['messageSuccess']);
                                        echo $resultMessage;
                                    }?>

                                    <?php if(isset($_SESSION["error"]["times"]) && $_SESSION["error"]["times"]>5): ?>
                                        <div class="text-danger text-center">已超過錯誤次數 請稍候再來</div>
                                    <?php else: ?>
                                    <form class="user" action="doLogin.php" method="post">
                                        <div class="form-group">
                                            <input type="email" 
                                            name="email"
                                            class="form-control form-control-user"
                                                id="exampleInputEmail" aria-describedby="emailHelp"
                                                placeholder="Email">
                                        </div>
                                        <div class="form-group">
                                            <input type="password" 
                                            name="password"
                                            class="form-control form-control-user"
                                                id="exampleInputPassword" placeholder="密碼">
                                        </div>
                                        <?php if(isset($_SESSION["error"]["message"])): ?>
                                            <div class="mt-2 text-danger">
                                                <?=$_SESSION["error"]["message"]?>
                                            </div>
                                        <?php endif; ?>
                                        <div class="form-group">
                                            <div class="custom-control custom-checkbox small">
                                                <input type="checkbox" class="custom-control-input" id="customCheck">
                                                <label class="custom-control-label" for="customCheck">記住我</label>
                                            </div>
                                        </div>
                                        <button href="" type="submit" class="btn btn-primary btn-user btn-block">
                                            登入
                                        </button>
                                        
                                    </form>
                                    <?php endif;?>
                                    <hr>
                                    <div class="text-center">
                                        <a class="small" href="member_signup.php">註冊新帳號!</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </div>
    </div>
    <?php
    unset($_SESSION["error"]["message"]);
    ?>

    <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="js/govent.js"></script>

</body>

</html>