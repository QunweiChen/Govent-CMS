<?php
session_start();

if(isset($_SESSION["menber"])){
    // header("location: menber_dashboard.php");
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

    <title>menber login</title>

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
    <link href="../Template/css/govent.css" rel="stylesheet">

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
                                        <h1 class="h4 text-gray-900 mb-4">歡迎回來!</h1>
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
                                        <hr>
                                        <a href="index.html" class="btn btn-google btn-user btn-block">
                                            <i class="fab fa-google fa-fw"></i> 透過 Google登入
                                        </a>
                                        <a href="index.html" class="btn btn-facebook btn-user btn-block">
                                            <i class="fab fa-facebook-f fa-fw"></i> 透過 Facebook登入
                                        </a>
                                    </form>
                                    <?php endif;?>
                                    <hr>
                                    <div class="text-center">
                                        <a class="small" href="forgot-password.html">忘記密碼?</a>
                                    </div>
                                    <div class="text-center">
                                        <a class="small" href="menber_signup.php">註冊新帳號!</a>
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