<?php
session_start();
session_destroy();
require_once("./db_conntect_govent.php");
$sqlActivity = "SELECT * FROM activity_category ";
$resultActivity = $conn->query($sqlActivity);
$rowsActivity = $resultActivity->fetch_all(MYSQLI_ASSOC);
// var_dump($rows)
?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>新增優惠券</title>

    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <!-- font awesome link -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- bootstrap icon link -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.2/font/bootstrap-icons.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous" />
    <!-- 字體連結 -->
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+TC:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="../Template/css/govent.css" rel="stylesheet">

</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
                <div class="sidebar-brand-icon rotate-n-15">
                    <i class="fa-solid fa-ticket"></i>
                </div>
                <div class="sidebar-brand-text mx-3">GoVent</div>
            </a>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            <!-- Sidebar Message -->
            <div class="sidebar-card d-none d-lg-flex">
                <img class="sidebar-card-illustration mb-2" src="../image/1.png" alt="...">
            </div>

            <!-- Nav Item - Dashboard -->
            <li class="nav-item active">
                <a class="nav-link text-shadow-20" href="index.html">
                    <i class="bi bi-speedometer"></i>
                    <span>平台管理</span></a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Heading -->
            <div class="sidebar-heading">
                Interface
            </div>

            <!-- Nav Item - Pages Collapse Menu -->
            <li class="nav-item">
                <a class="nav-link collapsed text-shadow-20" href="#" data-toggle="collapse" data-target="#collapseMember" aria-expanded="true" aria-controls="collapseMember">
                    <i class="bi bi-people-fill"></i>
                    <span>會員管理</span>
                </a>
                <div id="collapseMember" class="collapse" aria-labelledby="headingMember" data-parent="#accordionSidebar">
                    <div class="bg-white-transparency py-2 collapse-inner rounded text-shadow-20">
                        <h6 class="collapse-header">Member Management</h6>
                        <a class="collapse-item" href="#">會員清單</a>
                        <a class="collapse-item" href="#">會員註冊（客戶端）</a>
                        <a class="collapse-item" href="#">會員登入（客戶端）</a>
                    </div>
                </div>
            </li>

            <!-- Nav Item - Utilities Collapse Menu -->
            <li class="nav-item">
                <a class="nav-link collapsed text-shadow-20" href="#" data-toggle="collapse" data-target="#collapseOrganizer" aria-expanded="true" aria-controls="collapseOrganizer">
                    <i class="bi bi-building-fill"></i>
                    <span>主辦單位管理</span>
                </a>
                <div id="collapseOrganizer" class="collapse" aria-labelledby="headingOrganizer" data-parent="#accordionSidebar">
                    <div class="bg-white-transparency py-2 collapse-inner rounded text-shadow-20">
                        <h6 class="collapse-header">Orangizer Management</h6>
                        <a class="collapse-item" href="#">主辦單位清單</a>
                        <a class="collapse-item" href="#">修改／新增</a>
                    </div>
                </div>
            </li>
            <li class="nav-item">
                <a class="nav-link collapsed text-shadow-20" href="#" data-toggle="collapse" data-target="#collapseEvent" aria-expanded="true" aria-controls="collapseEvent">
                    <i class="bi bi-calendar-event-fill"></i>
                    <span>活動管理</span>
                </a>
                <div id="collapseEvent" class="collapse" aria-labelledby="headingEvent" data-parent="#accordionSidebar">
                    <div class="bg-white-transparency py-2 collapse-inner rounded text-shadow-20">
                        <h6 class="collapse-header">Event Management</h6>
                        <a class="collapse-item" href="#">活動清單</a>
                        <a class="collapse-item" href="#">票卷管理</a>
                    </div>
                </div>
            </li>
            <li class="nav-item text-shadow-20">
                <a class="nav-link" href="">
                    <i class="bi bi-border-width"></i>
                    <span>訂單管理</span></a>
            </li>
            <li class="nav-item">
                <a class="nav-link collapsed text-shadow-20" href="coupon-list.php" data-toggle="collapse" data-target="#collapseCoupon" aria-expanded="true" aria-controls="collapseCoupon">
                    <i class="bi bi-calendar-event-fill"></i>
                    <span>優惠卷管理</span>
                </a>
                <div id="collapseCoupon" class="collapse" aria-labelledby="headingCoupon" data-parent="#accordionSidebar">
                    <div class="bg-white-transparency py-2 collapse-inner rounded text-shadow-20">
                        <h6 class="collapse-header">Coupon Management</h6>
                        <a class="collapse-item" href="coupon-list.php?page=1$order=1">優惠券清單</a>
                        <a class="collapse-item" href="add-coupon.php">優惠券新增</a>
                        <a class="collapse-item" href="coupon-list-edit.php?page=1$order=1">編輯/刪除優惠券</a>
                    </div>
                </div>
            </li>
            <!-- Divider -->


            <!-- Divider -->
            <hr class="sidebar-divider d-none d-md-block">

            <!-- Sidebar Toggler (Sidebar) -->
            <div class="text-center d-none d-md-inline">
                <button class="rounded-circle border-0" id="sidebarToggle"></button>
            </div>



        </ul>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

                    <!-- Sidebar Toggle (Topbar) -->
                    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                        <i class="fa-solid fa-bars" style="color: #fd7e14;"></i>
                    </button>

                    <!-- Topbar Navbar -->
                    <ul class="navbar-nav ml-auto">

                        <!-- Nav Item - User Information -->
                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="mr-3 d-none d-lg-inline text-gray-600 x-small">平台管理員</span>
                                <span class="mr-2 d-none d-lg-inline text-gray-600 small">妙蛙種子</span>
                                <img class="img-profile rounded-circle" src="img/undraw_profile.svg">
                            </a>
                            <!-- Dropdown - User Information -->
                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                                <!-- <a class="dropdown-item" href="#">
                                    <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Profile
                                </a>
                                <a class="dropdown-item" href="#">
                                    <i class="fas fa-cogs fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Settings
                                </a>
                                <a class="dropdown-item" href="#">
                                    <i class="fas fa-list fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Activity Log
                                </a>
                                <div class="dropdown-divider"></div> -->
                                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                    登出
                                </a>
                            </div>
                        </li>

                    </ul>

                </nav>

                <div class="container-fluid">
                    <!-- Page Heading -->
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <div class="d-flex align-items-end ">
                            <h1 class="h3 mb-0 text-gray-800">新增優惠券</h1>
                            <!-- session -->
                            <?php if (isset($_SESSION["error"]["message"])) : ?>
                                <div class="ms-3 px-2 alert-danger text-danger" role="alert"><?= $_SESSION["error"]["message"] ?></div>
                            <?php endif; ?>
                            <!-- session -->
                        </div>
                        <a href="coupon-list.php" class="text-primary d-flex align-items-center">
                            <div>
                                回優惠券列表
                            </div>
                            <i class="bi bi-box-arrow-right fs-4 ms-3"></i>
                        </a>
                    </div>
                    <div class="container">
                        <form action="doAddCoupon.php" method="post">
                            <div class="row mb-3">
                                <label for="name" class="col-sm-2 col-form-label">優惠券名稱</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="name" name="name" placeholder="例 : 清涼優惠" value="<?= isset($_SESSION['error']['filledData']['name']) ? $_SESSION['error']['filledData']['name'] : ' 例 : 清涼優惠 ' ?>" require>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="code" class="col-sm-2 col-form-label">兌換代碼</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" id="code" name="code" placeholder="例: ABC1234" require>
                                </div>
                                <button type="button" class="col-sm-2 btn text-primary" id="codebtn">隨機生成一組亂碼</button>
                                <p class="fs-6">(自定義前三個字母後四個數字)</p>
                            </div>
                            <div class="row mb-3 align-items-center">
                                <label for="couponValid" class="col-sm-2 col-form-label">優惠券狀態</label>
                                <div class="col-sm-8">
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="couponValid" id="couponValid1" value="1" <?= (isset($_SESSION['error']['filledData']['couponValid']) && $_SESSION['error']['filledData']['couponValid'] == 1) ? 'checked' : '' ?> require>
                                        <label class="form-check-label" for="couponValid1">
                                            可使用
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="couponValid" id="couponValid2" value="2" <?= (isset($_SESSION['error']['filledData']['couponValid']) && $_SESSION['error']['filledData']['couponValid'] == 2) ? 'checked' : '' ?> require>
                                        <label class="form-check-label" for="couponValid0">
                                            已停用
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-3 align-items-center">
                                <label for="discountType" class="col-sm-2 col-form-label">折扣類型</label>
                                <div class="col-sm-8">
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="discountType" id="discountType" value="打折" <?= (isset($_SESSION['error']['filledData']['discountType']) && $_SESSION['error']['filledData']['discountType'] == '打折') ? 'checked' : '' ?> require>
                                        <label class="form-check-label" for="discountType1">
                                            依百分比折扣
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="discountType" id="discountType" value="金額" <?= (isset($_SESSION['error']['filledData']['discountType']) && $_SESSION['error']['filledData']['discountType'] == '金額') ? 'checked' : '' ?> require>
                                        <label class="form-check-label" for="discountType2">
                                            依金額折價
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="discountValid" class="col-sm-2 col-form-label">優惠券百分比折扣<br>/金額折價</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="discountValid" name="discountValid" placeholder="優惠券百分比折扣/金額折價 例:0.75/50" value="<?= isset($_SESSION['error']['filledData']['discountValid']) ? $_SESSION['error']['filledData']['discountValid'] : '優惠券百分比折扣/金額折價 例:0.75/50 ' ?>" require>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="startAt" class="col-sm-2 col-form-label">開始日期</label>
                                <div class="col-sm-4">
                                    <input type="date" class="form-control" id="startAt" name="startAt" value="<?= isset($_SESSION['error']['filledData']['startAt']) ? $_SESSION['error']['filledData']['startAt'] : ' ' ?>" onchange="updateCouponStatus(this)" require>
                                </div>
                                <label for="expiresAt" class="col-sm-2 col-form-label">到期日期</label>
                                <div class="col-sm-4">
                                    <input type="date" class="form-control" id="expiresAt" name="expiresAt" value="<?= isset($_SESSION['error']['filledData']['expiresAt']) ? $_SESSION['error']['filledData']['expiresAt'] : ' ' ?>" onchange="updateCouponStatus(this)" require>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="priceMin" class="col-sm-2 col-form-label">最低消費金額</label>
                                <div class="col-sm-4">
                                    <input type="text" class="form-control" id="priceMin" name="priceMin" value="<?= isset($_SESSION['error']['filledData']['priceMin']) ? $_SESSION['error']['filledData']['priceMin'] : ' ' ?>" require>
                                </div>
                                <label for="maxUsage" class="col-sm-2 col-form-label">可使用張數</label>
                                <div class="col-sm-4">
                                    <input type="text" class="form-control" id="priceMin" name="maxUsage" value="<?= isset($_SESSION['error']['filledData']['maxUsage']) ? $_SESSION['error']['filledData']['maxUsage'] : ' ' ?>" require>
                                </div>
                            </div>
                            <div class="row mb-3 ">
                                <label for="activityNum" class="col-form-label col-sm-2">活動類型</label>
                                <select class="form-select col-sm-10 " id="" name="activityNum">
                                    <?php foreach ($rowsActivity as $rowActivity) : ?>
                                        <option name="activity<?= $rowActivity["id"] ?>" value="<?= $rowActivity["id"] ?>" <?= isset($_SESSION['error']['filledData']['activityNum']) && $_SESSION['error']['filledData']['activityNum'] == $rowActivity["id"] ? 'selected' : '' ?>><?= $rowActivity["activity_name"] ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <button class="btn btn-primary" type="submit">送出</button>
                        </form>
                    </div>
                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

            <!-- Footer -->
            <footer class="sticky-footer bg-white">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <span>Copyright &copy; GOVENT 2023</span>
                    </div>
                </div>
            </footer>
            <!-- End of Footer -->

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <a class="btn btn-primary" href="login.html">Logout</a>
                </div>
            </div>
        </div>
    </div>

    <script>
        // 生成多个随机字母
        function generateRandomLetters(length) {
            const letters = Array.from({
                length: 26
            }, (_, i) => String.fromCharCode('A'.charCodeAt(0) + i));
            let randomLettersString = '';

            for (let i = 0; i < length; i++) {
                const randomLetter = letters[Math.floor(Math.random() * letters.length)];
                randomLettersString += randomLetter;
            }

            return randomLettersString;
        }

        // 生成多个随机数字
        function generateRandomNumbers(length) {
            const numbers = Array.from({
                length: 2
            }, (_, i) => (i + 1).toString());
            let numberString = '';

            for (let i = 0; i < length; i++) {
                const randomNumber = numbers[Math.floor(Math.random() * numbers.length)];
                numberString += randomNumber;
            }

            return numberString;
        }

        // 生成随机代码
        function generateRandomCode() {
            const numberOfRandomLetters = 3;
            const numberOfRandomNumbers = 4;

            const randomLettersString = generateRandomLetters(numberOfRandomLetters);
            const numberString = generateRandomNumbers(numberOfRandomNumbers);

            const codeRandom = randomLettersString + numberString;
            console.log(codeRandom);
            document.getElementById('code').value = codeRandom;
        }
        document.getElementById('codebtn').addEventListener('click', generateRandomCode);
        // 示例调用
        generateRandomCode();
    </script>
    <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="js/govent.js"></script>
    <script>
        // 函數：根據到期日期更新優惠券狀態
        function updateCouponStatus(dateInput) {
            // 從 HTML 元素中獲取日期
            let expirationDate = document.getElementById("expiresAt").value;
            let startDate = document.getElementById("startAt").value;
            if (!expirationDate) {
                return;
            }
            // 將日期轉換為時間戳
            let expirationTimestamp = new Date(expirationDate).getTime();
            let startTimestamp = new Date(startDate).getTime();
            // 獲取當前時間戳
            let currentTimestamp = new Date().getTime();

            // 比較時間戳並更新優惠券狀態
            if (expirationTimestamp < currentTimestamp || startTimestamp > currentTimestamp) {
                // 優惠券已過期
                document.getElementById("couponValid2").checked = true;
            } else {
                // 優惠券仍然有效
                document.getElementById("couponValid1").checked = true;
            }
        }

        // 在頁面加載時調用該函數
        window.onload = updateCouponStatus;
    </script>
    <!-- Page level plugins -->
    <script src="vendor/chart.js/Chart.min.js"></script>

    <!-- Page level custom scripts -->
    <script src="js/demo/chart-area-demo.js"></script>
    <script src="js/demo/chart-pie-demo.js"></script>

</body>

</html>