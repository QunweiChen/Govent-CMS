<?php

if(!isset($_GET["id"])){
    header("location: menbert_list.php");
  }

$id=$_GET["id"];//為連結到id來源


require_once("govent_db_conntect.php");

// $sql = "SELECT * FROM menber_list WHERE id=$id AND valid=1";

$sql = "SELECT *
FROM menber_list
JOIN city 
ON menber_list.address = city.city_id 
JOIN menber_leval 
ON menber_list.menber_leval = menber_leval.leval_id 
WHERE menber_list.valid=1 AND menber_list.id = " . $id;

$result = $conn->query($sql);
// $userCount = $result->num_rows;?未知用途
$row = $result->fetch_assoc();
// var_dump($row);  //可拉出資料


// $sql = "SELECT *
// FROM menber_list
// JOIN menber_leval 
// ON menber_list.menber_leval = menber_leval.leval_id 
// WHERE menber_list.valid=1 AND menber_list.id = " . $row["id"];


?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Menber Data</title>

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

     <!-- bs-5 -->
     <!-- <link
            href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css"
            rel="stylesheet"
            integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN"
            crossorigin="anonymous"
        /> -->

</head>


<div class="modal fade" id="alertModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title" id="exampleModalLabel"> 警告</h1>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">確認刪除帳號</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">取消</button>
                    <a class="btn btn-primary" href="doDelete.php">確認刪除</a>
                </div>
            </div>
        </div>
    </div>

<body id="page-top">


    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="menber_dashboard.php">
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
                <a class="nav-link text-shadow-20" href="menber_dashboard.php">
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
                <a class="nav-link collapsed text-shadow-20" href="#" data-toggle="collapse" data-target="#collapseMember"
                    aria-expanded="true" aria-controls="collapseMember">
                    <i class="bi bi-people-fill"></i>
                    <span>會員管理</span>
                </a>
                <div id="collapseMember" class="collapse" aria-labelledby="headingMember" data-parent="#accordionSidebar">
                    <div class="bg-white-transparency py-2 collapse-inner rounded text-shadow-20">
                        <h6 class="collapse-header">Member Management</h6>
                        <a class="collapse-item" href="menber_list.php">會員清單</a>
                        <a class="collapse-item" href="menber_signup.php">會員註冊（客戶端）</a>
                        <a class="collapse-item" href="menber_login.php">會員登入（客戶端）</a>
                    </div>
                </div>
            </li>

            <!-- Nav Item - Utilities Collapse Menu -->
            <li class="nav-item">
                <a class="nav-link collapsed text-shadow-20" href="#" data-toggle="collapse" data-target="#collapseOrganizer"
                    aria-expanded="true" aria-controls="collapseOrganizer">
                    <i class="bi bi-building-fill"></i>
                    <span>主辦單位管理</span>
                </a>
                <div id="collapseOrganizer" class="collapse" aria-labelledby="headingOrganizer"
                    data-parent="#accordionSidebar">
                    <div class="bg-white-transparency py-2 collapse-inner rounded text-shadow-20">
                        <h6 class="collapse-header">Orangizer Management</h6>
                        <a class="collapse-item" href="#">主辦單位清單</a>
                        <a class="collapse-item" href="#">修改／新增</a>
                    </div>
                </div>
            </li>
            <li class="nav-item">
                <a class="nav-link collapsed text-shadow-20" href="#" data-toggle="collapse" data-target="#collapseEvent"
                    aria-expanded="true" aria-controls="collapseEvent">
                    <i class="bi bi-calendar-event-fill"></i>
                    <span>活動管理</span>
                </a>
                <div id="collapseEvent" class="collapse" aria-labelledby="headingEvent"
                    data-parent="#accordionSidebar">
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
                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="mr-3 d-none d-lg-inline text-gray-600 x-small">平台管理員</span>
                                <span class="mr-2 d-none d-lg-inline text-gray-600 small">妙蛙種子</span>
                                <img class="img-profile rounded-circle" src="img/undraw_profile.svg">
                            </a>
                            <!-- Dropdown - User Information -->
                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                aria-labelledby="userDropdown">
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

                    <!-- Page Heading -->
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800">會員資料</h1>
                    </div>

                    <!-- Content Row -->
                    <div>
                        <form action="doUpdate.php" method="post">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <input type="hidden" name="id" value="<?= $row["id"]?>">
                            <tr>
                                <th>ID</th>
                                <td>
                                <?= $row["id"]?>
                                </td>
                            </tr>
                            <tr>
                                <th>會員等級</th>
                                <td> <?= $row["leval_name"]?></td>
                            </tr>
                            <tr>
                                <th>姓名</th>
                                <td>
                                    <input type="text" class="form-contriol" name="name" value="<?= $row["name"]?>">
                                </td>
                            </tr>
                            <tr>
                                <th>Email</th>
                                <td>
                                    <input type="text" class="form-contriol" name="email" value="<?= $row["email"]?>">
                                </td>
                            </tr>
                            <tr>
                                <th>電話</th>
                                <td>
                                    <input type="tel" class="form-contriol" name="phone" value="<?= $row["phone"]?>">
                                </td>
                            </tr>
                            <tr>
                                <th>密碼</th>
                                <td>
                                    <input type="text" class="form-contriol" name="password" value="<?= $row["password"]?>">
                                </td>
                            </tr>
                            <tr>
                                <th>身分證</th>
                                <td>
                                    <?= $row["national_id"]?>
                                </td>
                            </tr>
                            <tr>
                                <th>地址</th>
                                <td>
                                <?=$row["city_name"]?><?=$row["dist_name"]?>
                                </td>
                            </tr>
                            <tr>
                                <th>出生日期</th>
                                <td>
                                    <input type="date" class="form-contriol" name="born_date" value="<?= $row["born_date"]?>">
                                </td>
                            </tr>
                            <tr>
                                <th>電子發票</th>
                                <td>
                                    <input type="text" class="form-contriol" name="invoice" value="<?= $row["invoice"]?>">
                                </td>
                            </tr>
                            <tr>
                                <th>註冊日期</th>
                                <td><?= $row["created_at"]?></td>
                            </tr>

                        </table>
                        <table>
                            <div class="py-2">
                                <button class="btn btn-primary btn-info " type="submit">修改</button>
                                <a class="btn btn-info text-white" href="menber_data.php?id=<?=$row["id"] ?>">取消</a>
                                <!-- <a class="btn btn-info text-white" href="?id=<?= $row["id"] ?>">Cancel</a> -->
                            </div>
                            <div>
                                <a type="button" href="#" data-toggle="modal" data-target="#alertModal" class="btn btn-danger">刪除帳號</a>
                                <!-- <a href="doDelete.php?id=<?= $row["id"] ?>" class="btn btn-danger">Delete</a> -->
                            </div>
                        </table>
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
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">登出</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">您確定要登出帳號嗎？</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">取消</button>
                    <a class="btn btn-primary" href="menber_login.php">登出</a>
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