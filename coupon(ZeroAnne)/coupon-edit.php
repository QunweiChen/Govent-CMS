<?php
if (!isset($_GET["id"])) {
    header("location: coupon-list.php");
}
$id = $_GET["id"];
require_once("./db_conntect_govent.php");

$sql = "SELECT coupon.* ,coupon_valid_name, activity_name 
FROM coupon 
JOIN couponvalid ON coupon.coupon_valid=couponvalid.coupon_valid_id 
JOIN activity_category ON coupon.activity_num=activity_category.id WHERE coupon.id=$id";
$result = $conn->query($sql);
$row = $result->fetch_assoc();
// var_dump($row);
?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>修改優惠券</title>

    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <!-- font awesome link -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- bootstrap icon link -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.2/font/bootstrap-icons.min.css">
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
            <li class="nav-item text-shadow-20">
                <a class="nav-link" href="coupon-list.php">
                    <i class="bi bi-ticket-fill"></i>
                    <span>優惠卷管理</span></a>
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
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div class="container-fluid">
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800">更改優惠券</h1>
                        <div class="">
                            <a href="coupon-list.php" class="text-primary">回優惠券列表</a>
                        </div>
                    </div>
                    <div class="container">
                        <form action="doUpdateCoupon.php" method="post">
                            <input type="hidden" name="id" value="<?=$row["id"]?>">
                            <div class="row mb-3 align-items-center">
                                <label for="code" class="col-sm-2 col-form-label">ID</label>
                                <div class="col-sm-8">
                                    <div class=""><?= $row["id"] ?></div>
                                </div>
                            </div>
                            <div class="row mb-3 align-items-center">
                                <label for="name" class="col-sm-2 col-form-label">優惠券名稱</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" id="name" name="name" value="<?= $row["coupon_name"] ?>">
                                </div>
                            </div>
                            <div class="row mb-3 align-items-center">
                                <label for="code" class="col-sm-2 col-form-label">兌換代碼</label>
                                <div class="col-sm-8">
                                    <div class=""><?= $row["coupon_code"] ?></div>
                                </div>
                            </div>
                            <div class="row mb-3 align-items-center">
                                <label for="couponValid" class="col-sm-2 col-form-label">優惠券狀態</label>
                                <div class="col-sm-8">
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="couponValid" id="couponValid" value="1" <?php if($row["coupon_valid"]==1) echo "checked" ?> >
                                    <label class="form-check-label" for="couponValid1">
                                        可使用
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="couponValid" id="couponValid" value="0" <?php if($row["coupon_valid"]==0) echo "checked" ?> >
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
                                    <input class="form-check-input" type="radio" name="discountType" id="discountType" value="打折" <?php if($row["discount_type"]=="打折") echo "checked" ?> >
                                    <label class="form-check-label" for="discountType1">
                                        依百分比折扣
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="discountType" id="discountType" value="金額" <?php if($row["discount_type"]=="金額") echo "checked" ?>>
                                    <label class="form-check-label" for="discountType2">
                                        依金額折價
                                    </label>
                                </div>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="discountValid" class="col-sm-2 col-form-label text-nowrap">百分比折扣/金額折價</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="discountValid" name="discountValid" value="<?= $row["discount_valid"] ?>">
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="startAt" class="col-sm-2 col-form-label">開始日期</label>
                                <div class="col-sm-4">
                                    <input type="date" class="form-control" id="startAt" name="startAt" value="<?= $row["start_at"] ?>">
                                </div>
                                <label for="expiresAt" class="col-sm-2 col-form-label">到期日期</label>
                                <div class="col-sm-4">
                                    <input type="date" class="form-control" id="expiresAt" name="expiresAt" value="<?= $row["expires_at"] ?>">
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="priceMin" class="col-sm-2 col-form-label">最低消費金額</label>
                                <div class="col-sm-4">
                                    <input type="text" class="form-control" id="priceMin" name="priceMin" value="<?= $row["price_min"] ?>">
                                </div>
                                <label for="maxUsage" class="col-sm-2 col-form-label">可使用張數</label>
                                <div class="col-sm-4">
                                    <input type="text" class="form-control" id="priceMin" name="maxUsage" value="<?= $row["max_usage"] ?>">
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="activityNum" class="col-form-label col-sm-2">活動類型：</label>
                                <select class="col-form-select col-sm-10" id="" name="activityNum"  >
                                    <option name="activity1" value="1" <?php if($row["activity_num"]==1) echo "selected" ?>>演唱會</option>
                                    <option name="activity2" value="2" <?php if($row["activity_num"]==2) echo "selected" ?>>展覽</option>
                                    <option name="activity3" value="3" <?php if($row["activity_num"]==3) echo "selected" ?>>快閃限定活動</option>
                                    <option name="activity4" value="4" <?php if($row["activity_num"]==4) echo "selected" ?>>市集</option>
                                    <option name="activity5" value="5" <?php if($row["activity_num"]==5) echo "selected" ?>>粉絲見面會</option>
                                    <option name="activity6" value="6" <?php if($row["activity_num"]==6) echo "selected" ?>>課程講座</option>
                                    <option name="activity7" value="7" <?php if($row["activity_num"]==7) echo "selected" ?>>體育賽事</option>
                                    <option name="activity8" value="8" <?php if($row["activity_num"]==8) echo "selected" ?>>景點門票</option>
                                </select>
                            </div>
                            <button class="btn btn-primary" type="submit">儲存</button>
                            <a class="btn btn-primary" href="coupon.php?id=<?= $id ?>" >取消</a>
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

    <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="js/govent.js"></script>

    <!-- Page level plugins -->
    <script src="vendor/chart.js/Chart.min.js"></script>

    <!-- Page level custom scripts -->
    <script src="js/demo/chart-area-demo.js"></script>
    <script src="js/demo/chart-pie-demo.js"></script>

</body>

</html>