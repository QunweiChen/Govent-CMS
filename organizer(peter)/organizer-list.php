<?php
require_once("../connect_server.php");

$sqlTotal = "SELECT * FROM organizer WHERE valid = 1";
$resultTotal = $conn->query($sqlTotal);
$totalUser = $resultTotal->num_rows;
$perPage = 10;

$pageCount = ceil($totalUser / $perPage); //celi=無條件進位

if (isset($_GET["search"])) {
    $search = $_GET["search"];
    $sql = "SELECT organizer.*, member_list.name AS user_name, member_list.email AS user_email FROM organizer
    JOIN member_list ON organizer.user_id = member_list.id WHERE organizer.name LIKE '%$search%' AND organizer.valid = 1
    ORDER BY id ASC";
    // $sql = "SELECT * FROM organizer WHERE name LIKE '%$search%'";
} elseif (isset($_GET["page"]) && isset($_GET["order"])) {
    $page = $_GET["page"];
    $order = $_GET["order"];
    switch ($order) {
        case 1:
            $orderSql = "id ASC"; //ASC升幕
            break;
        case 2:
            $orderSql = "name ASC";
            break;
        case 3:
            $orderSql = "name DESC";
            break;
        case 4:
            $orderSql = "organizer_type ASC";
            break;
        case 5:
            $orderSql = "organizer_type DESC";
            break;
        case 6:
            $orderSql = "user_name ASC";
            break;
        case 7:
            $orderSql = "user_name DESC";
            break;
        case 8:
            $orderSql = "created_at ASC";
            break;
        case 9:
            $orderSql = "created_at DESC";
            break;
        default:
            $orderSql = "id ASC";
    }
    $startItem = ($page - 1) * $perPage;
    $sql = "SELECT organizer.*, member_list.name AS user_name, member_list.email AS user_email FROM organizer
    JOIN member_list ON organizer.user_id = member_list.id WHERE organizer.valid = 1
    ORDER BY $orderSql LIMIT $startItem,$perPage";
} else {
    $order = 1;
    $page = 1;
    $sql = "SELECT organizer.*, member_list.name AS user_name, member_list.email AS user_email FROM organizer
    JOIN member_list ON organizer.user_id = member_list.id WHERE organizer.valid = 1
    ORDER BY id ASC LIMIT 0,$perPage";
}
$result = $conn->query($sql);
$rows = $result->fetch_all(MYSQLI_ASSOC);
?>



<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>主辦單位清單</title>

    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <!-- font awesome link -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- bootstrap icon link -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.2/font/bootstrap-icons.min.css">
    <!-- 字體連結 -->
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+TC:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">

    <!-- 動畫效果 -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />
    <!-- alert效果 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <!-- Custom styles for this template-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link href="css/govent.css" rel="stylesheet">
    <link href="organizer.css" rel="stylesheet">

</head>

<body id="page-top">
    <!-- 照結果顯示alert -->
    <?php include('alert.php'); ?>
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
                        <a class="collapse-item" href="organizer-add.php">手動新增</a>
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

                    <!-- Page Heading -->

                    <div class="d-sm-flex align-items-center pt-3 mb-4 mx-4">
                        <h1 class="h3 mb-0 text-gray-800 font-weight-bolder">主辦單位清單</h1>
                        <?php if (!isset($_GET["search"])) : ?>
                            <div class="dropdown">
                                <button class="btn btn-main-color dropdown-toggle py-1 mx-3" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false" data-bs-offset="0,10">
                                    列表分頁
                                </button>
                                <ul class="dropdown-menu animate__animated animate__fadeIn animate__faster">
                                    <?php for ($i = 1; $i <= $pageCount; $i++) : ?>
                                        <li><a class="dropdown-item" href="organizer-list.php?page=<?= $i ?>&order=<?= $order ?>"><?= $i ?></a></li>
                                    <?php endfor ?>
                                </ul>
                            </div>
                            <div class="text-gray-600">
                                目前在第<?= $page ?>頁
                            </div>
                        <?php else : ?>
                            <a href="organizer-list.php" class="btn btn-main-color py-1 mx-3"><i class="bi bi-arrow-left me-1"></i>回全部列表</a>
                        <?php endif ?>
                        <div class="ms-auto">
                            <form action="">
                                <div class="input-group rounded">
                                    <?php if (!isset($_GET["search"])) : ?>
                                        <input type="search" class="form-control rounded" placeholder="Search" aria-label="Search" aria-describedby="search-addon" name="search" />
                                    <?php else : ?>
                                        <input type="search" class="form-control rounded" value="<?= $_GET["search"] ?>" aria-label="Search" aria-describedby="search-addon" name="search" />
                                    <?php endif ?>
                                    <button class="input-group-text rounded border-0 ms-2" id="search-addon" type="submit">
                                        <i class="fas fa-search"></i>
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                    <!-- Content Row -->

                    <div>
                        <table class="table table-hover table-light mx-3 animate__animated animate__fadeIn animate__faster">
                            <?php if (!isset($_GET["search"])) : ?>
                                <thead>
                                    <tr class="text-nowrap">
                                        <th scope="col">
                                            主辦單位名稱
                                            <?php if ($order != 2) : ?>
                                                <a href="organizer-list.php?page=<?= $page ?>&order=2" class=""><i class="bi bi-caret-down-square-fill"></i></a>
                                            <?php else : ?>
                                                <a href="organizer-list.php?page=<?= $page ?>&order=3" class=""><i class="bi bi-caret-up-square-fill"></i></a>
                                            <?php endif ?>
                                        </th>
                                        <th scope="col">
                                            身分
                                            <?php if ($order != 4) : ?>
                                                <a href="organizer-list.php?page=<?= $page ?>&order=4" class=""><i class="bi bi-caret-down-square-fill"></i></a>
                                            <?php else : ?>
                                                <a href="organizer-list.php?page=<?= $page ?>&order=5" class=""><i class="bi bi-caret-up-square-fill"></i></a>
                                            <?php endif ?>
                                        </th>
                                        <th scope="col">
                                            關聯會員名稱
                                            <?php if ($order != 6) : ?>
                                                <a href="organizer-list.php?page=<?= $page ?>&order=6" class=""><i class="bi bi-caret-down-square-fill"></i></a>
                                            <?php else : ?>
                                                <a href="organizer-list.php?page=<?= $page ?>&order=7" class=""><i class="bi bi-caret-up-square-fill"></i></a>
                                            <?php endif ?>
                                        </th>
                                        <th scope="col">email</th>
                                        <th scope="col">
                                            註冊時間
                                            <?php if ($order != 8) : ?>
                                                <a href="organizer-list.php?page=<?= $page ?>&order=8" class=""><i class="bi bi-caret-down-square-fill"></i></a>
                                            <?php else : ?>
                                                <a href="organizer-list.php?page=<?= $page ?>&order=9" class=""><i class="bi bi-caret-up-square-fill"></i></a>
                                            <?php endif ?>
                                        </th>
                                        <th scope="col">操作</th>
                                    </tr>
                                </thead>
                            <?php else : ?>
                                <thead>
                                    <tr class="text-nowrap">
                                        <th scope="col">主辦單位名稱</th>
                                        <th scope="col">身分</th>
                                        <th scope="col">關聯會員名稱</th>
                                        <th scope="col">email</th>
                                        <th scope="col">註冊時間</th>
                                        <th scope="col">操作</th>
                                    </tr>
                                </thead>
                            <?php endif ?>
                            <tbody>
                                <?php foreach ($rows as $row) : ?>
                                    <tr class="text-nowrap">
                                        <td><?= $row["name"] ?></td>
                                        <?php if ($row["organizer_type"] == 1) : ?>
                                            <td>公司<i class="bi bi-record-fill mx-1" style="color: #6dbbb3"></i></td>
                                        <?php else : ?>
                                            <td>個人<i class="bi bi-record-fill mx-1" style="color: #f9d781"></i></td>
                                        <?php endif ?>
                                        <td><?= $row["user_name"] ?></td>
                                        <td><?= $row["user_email"] ?></td>
                                        <td><?= $row["created_at"] ?></td>
                                        <td>
                                            <a href="organizer-profile.php?id=<?= $row["id"] ?>" class="btn btn-main-color p-0 px-2"><span class="small"><i class="bi bi-eye-fill"></i></span></a>
                                            <a href="organizer-edit.php?id=<?= $row["id"] ?>" class="btn btn-main-color p-0 px-2"><span class="small"><i class="bi bi-pencil-square"></i></span></a>
                                            <!-- <a href="organizer-edit.php?id=<?= $row["id"] ?>" class="btn btn-danger p-0 px-2"><span class="small"><i class="bi bi-trash-fill"></i></span></a> -->
                                        </td>
                                    </tr>
                                <?php endforeach ?>
                            </tbody>
                        </table>
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

</body>

</html>