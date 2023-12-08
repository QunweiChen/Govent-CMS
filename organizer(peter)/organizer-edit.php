<?php
require_once("../connect_server.php");

if (!isset($_GET["id"])) {
    header("location: organizer-list.php");
}
$id = $_GET["id"];

$sql = "SELECT organizer.*, member_list.name AS user_name, member_list.email AS user_email, member_list.phone AS user_phone FROM organizer
JOIN member_list ON organizer.user_id = member_list.id WHERE organizer.id = $id";
$result = $conn->query($sql);
$row = $result->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>主辦單位資料</title>

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

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link href="css/govent.css" rel="stylesheet">
    <link href="organizer.css" rel="stylesheet">

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
                <img class="sidebar-card-illustration" src="../image/drawkit-transport-scene-8.png" alt="...">
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
                        <a class="collapse-item" href="organizer-list.php">主辦單位清單</a>
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
                <a class="nav-link" href="">
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
                        <li class="nav-item dropdown no-arrow mx-3">
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

                    <form action="organizer-doUpload.php" method="post" enctype="multipart/form-data">
                        <!-- Page Heading -->
                        <input type="text" class="d-none" name="id" value="<?= $row["id"] ?>">
                        <input type="text" class="d-none" name="organizerType" value="<?= $row["organizer_type"] ?>">
                        <div class="d-sm-flex align-items-center mb-4 justify-content-between mx-4 pt-3">
                            <h1 class="h3 mb-0 text-gray-800 font-weight-bolder">編輯資料</h1>
                            <div class="d-flex">
                                <a class="btn btn-secondary mx-2" href="organizer-profile.php?id=<?= $row["id"] ?>">取消</a>
                                <input class="btn btn-main-color" type="submit" name="submit" value="儲存"></input>
                            </div>
                        </div>
                        <!-- Content Row -->
                        <div class="mx-4 pb-4">
                            <div class="row">
                                <div class="col-lg-4">
                                    <div class="card mb-4 border-0 shadow">
                                        <div class="card-body text-center">
                                            <style>
                                                .organizer-avatar-edit {
                                                    width: 200px;
                                                    height: 200px;
                                                    background: url("organizer_avatar/<?= $row["avatar"] ?>");
                                                    background-size: cover;
                                                    background-position: 50% 50%;
                                                    transition: 0.3s;
                                                }
                                            </style>
                                            <div class="d-inline-flex">
                                                <div class="organizer-avatar-edit rounded-circle mt-2 text-white d-flex align-items-center justify-content-center">

                                                </div>
                                            </div>
                                            <h4 class="my-3 font-weight-bolder"><?= $row["name"] ?></h4>

                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-8">
                                    <?php if ($row["organizer_type"] == 1) : ?>
                                        <div class="card mb-4 border-0 shadow">
                                            <div class="card-body">
                                                <div class="row">
                                                    <div class="col-sm-3">
                                                        <p class="mb-0">用戶類別</p>
                                                    </div>
                                                    <div class="col-sm-9">
                                                        <span class="mb-0 text-bg-company px-2 py-1 rounded">企業用戶</span>
                                                        <span class="mb-0 text-bg-danger px-2 py-1 rounded">無法變更</span>
                                                    </div>
                                                </div>
                                                <hr>
                                                <div class="row align-items-center">
                                                    <div class="col-sm-3">
                                                        <p class="mb-0">前台顯示名稱</p>
                                                    </div>
                                                    <div class="col-sm-9">
                                                        <input type="text" class="form-control" name="name" value="<?= $row["name"] ?>">
                                                    </div>
                                                </div>
                                                <hr>
                                                <div class="row align-items-center">
                                                    <div class="col-sm-3">
                                                        <p class="mb-0">公司抬頭</p>
                                                    </div>
                                                    <div class="col-sm-9">
                                                        <input type="text" class="form-control" name="businessName" value="<?= $row["business_name"] ?>">
                                                    </div>
                                                </div>
                                                <hr>
                                                <div class="row align-items-center">
                                                    <div class="col-sm-3">
                                                        <p class="mb-0">統一編號</p>
                                                    </div>
                                                    <div class="col-sm-9">
                                                        <input type="text" onkeyup="value=value.replace(/[^\d]/g,'') " class="form-control" name="businessInvoice" maxlength="8" value="<?= $row["business_invoice"] ?>">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    <?php else : ?>
                                        <div class="card mb-4 border-0 shadow">
                                            <div class="card-body">
                                                <div class="row align-items-center">
                                                    <div class="col-sm-3">
                                                        <p class="mb-0">用戶類別</p>
                                                    </div>
                                                    <div class="col-sm-9">
                                                        <span class="mb-0 text-bg-main-color px-2 py-1 rounded">個人用戶</span>
                                                        <span class="mb-0 text-bg-danger px-2 py-1 rounded">無法變更</span>
                                                    </div>
                                                </div>
                                                <hr>
                                                <div class="row align-items-center">
                                                    <div class="col-sm-3">
                                                        <p class="mb-0">前台顯示名稱</p>
                                                    </div>
                                                    <div class="col-sm-9">
                                                        <input type="text" class="form-control" name="name" value="<?= $row["name"] ?>">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    <?php endif ?>
                                    <div class="card mb-4 border-0 shadow">
                                        <div class="card-body">
                                            <div class="row align-items-center">
                                                <div class="col-sm-3">
                                                    <p class="mb-0">銀行戶名</p>
                                                </div>
                                                <div class="col-sm-9">
                                                    <input type="text" class="form-control" name="bankName" value="<?= $row["bank_name"] ?>">
                                                </div>
                                            </div>
                                            <hr>
                                            <div class="row align-items-center">
                                                <div class="col-sm-3">
                                                    <p class="mb-0">銀行代碼</p>
                                                </div>
                                                <div class="col-sm-9">
                                                    <input type="text" onkeyup="value=value.replace(/[^\d]/g,'') " class="form-control" name="bankCode" maxlength="3" value="<?= $row["bank_code"] ?>">
                                                </div>
                                            </div>
                                            <hr>
                                            <div class="row align-items-center">
                                                <div class="col-sm-3">
                                                    <p class="mb-0">分行</p>
                                                </div>
                                                <div class="col-sm-9">
                                                    <input type="text" class="form-control" name="bankBranch" value="<?= $row["bank_branch"] ?>">
                                                </div>
                                            </div>
                                            <hr>
                                            <div class="row align-items-center">
                                                <div class="col-sm-3">
                                                    <p class="mb-0">銀行帳號</p>
                                                </div>
                                                <div class="col-sm-9">
                                                    <input type="text" onkeyup="value=value.replace(/[^\d]/g,'') " class="form-control" name="amountNumber" value="<?= $row["amount_number"] ?>">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    
                                </div>
                            </div>
                        </div>
                    </form>
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
        import Swal from 'sweetalert2/dist/sweetalert2.js';
        import 'sweetalert2/src/sweetalert2.scss';
        Swal.fire({
            title: "Good job!",
            text: "You clicked the button!",
            icon: "success"
        });
    </script>
    <!-- Bootstrap core JavaScript-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
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
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

</body>

</html>