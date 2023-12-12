<?php
require_once("../connect_server.php");

$sqlMember = "SELECT member_list.id, member_list.name, member_list.username AS user_id FROM member_list
WHERE id NOT IN(SELECT user_id FROM organizer) AND valid = 1
ORDER BY member_list.id ASC
";
$resultMember = $conn->query($sqlMember);
$rows = $resultMember->fetch_all(MYSQLI_ASSOC);

if (isset($_GET["id"])) {
    $id = $_GET["id"];
    $sql = "SELECT * FROM member_list WHERE id = $id";
    // $sql = "SELECT organizer.*, member_list.name AS user_name, member_list.email AS user_email, member_list.phone AS user_phone FROM organizer
    // JOIN member_list ON organizer.user_id = member_list.id WHERE organizer.id = $id";
    $result = $conn->query($sql);
    $userRow = $result->fetch_assoc();
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
                    <form action="organizer-doAdd.php" method="post" enctype="multipart/form-data">
                        <div class="d-sm-flex align-items-center justify-content-between pt-3 mb-4 mx-4">
                            <div class="d-sm-flex align-items-center">
                                <h1 class="h3 mb-0 text-gray-800 font-weight-bolder">手動新增（主辦單位）</h1>
                                <div class="dropdown ms-1">
                                    <button class="btn btn-main-color dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false" data-bs-offset="0,10">
                                        可新增會員列表
                                    </button>
                                    <ul class="dropdown-menu animate__animated animate__fadeIn animate__faster" style="max-height: 500px; overflow-y:auto;">
                                        <?php foreach ($rows as $row) : ?>
                                            <li>
                                                <a class="dropdown-item" href="?id=<?= $row["id"] ?>">
                                                    <div class="row" style="width: 450px">
                                                        <div class="col-4">會員名：<?= $row["name"] ?></div>
                                                        <div class="col">帳號：<?= $row["user_id"] ?></div>
                                                    </div>
                                                </a>
                                            </li>
                                            <hr class="m-1">
                                        <?php endforeach ?>
                                    </ul>
                                </div>
                            </div>
                            <div>
                                <?php if (isset($_GET["id"])) : ?>
                                    <input class="d-none" type="text" name="userId" value="<?= $_GET["id"] ?>">
                                    <input class="btn btn-main-color" type="submit" name="submit" value="送出"></input>
                                <?php endif ?>
                            </div>
                        </div>
                        <?php if (isset($_GET["id"])) : ?>
                            <div class="m-4 animate__animated animate__fadeIn animate__faster">
                                <div class="row">
                                    <div class="col-4 pe-4">
                                        <h4>會員資料</h4>
                                        <hr>
                                        <div class="row g-3">
                                            <div class="col-md-8">
                                                <label for="inputEmail4" class="form-label">會員姓名</label>
                                                <span class="form-control bg-body-secondary"><?= $userRow["name"] ?></span>
                                            </div>
                                            <div class="col-md-4">
                                                <label for="inputEmail4" class="form-label">性別</label>
                                                <span class="form-control bg-body-secondary">
                                                    <?php if ($userRow["gender"] == 1) : ?>
                                                        男性
                                                    <?php else : ?>
                                                        女性
                                                    <?php endif ?>
                                                </span>
                                            </div>
                                            <div class="col-md-12">
                                                <label for="inputPassword4" class="form-label">出生年月日</label>
                                                <span class="form-control bg-body-secondary"><?= $userRow["born_date"] ?></span>
                                            </div>
                                            <div class="col-md-12">
                                                <label for="inputEmail4" class="form-label">帳號</label>
                                                <span class="form-control bg-body-secondary"><?= $userRow["username"] ?></span>
                                            </div>
                                            <div class="col-md-12">
                                                <label for="inputPassword4" class="form-label">手機</label>
                                                <span class="form-control bg-body-secondary"><?= $userRow["phone"] ?></span>
                                            </div>
                                        </div>

                                    </div>
                                    <div class="ps-4 col-8 animate__animated animate__fadeIn animate__faster">
                                        <h4>新增主辦單位資料</h4>
                                        <hr>
                                        <div class="row g-3">
                                            <div class="col-9">
                                                <div class="row g-3">
                                                    <div class="col-12">
                                                        <div class="row">
                                                            <div class="form-check col-3 ms-3">
                                                                <label class="form-check-label" for="flexRadioDefault1">
                                                                    <input class="form-check-input" type="radio" name="organizerType" value="0" checked>
                                                                    個人
                                                                </label>
                                                            </div>
                                                            <div class="form-check col">
                                                                <label class="form-check-label" for="flexRadioDefault2">
                                                                    <input class="form-check-input" type="radio" name="organizerType" value="1">
                                                                    商家
                                                                </label>
                                                            </div>
                                                            <script>
                                                                let organizerType = document.getElementsByName("organizerType");

                                                                organizerType[0].onclick = function() {
                                                                    let companyForms = document.querySelectorAll("#company_form")
                                                                    companyForms.forEach((form) => form.className = "d-none");
                                                                }
                                                                organizerType[1].onclick = function() {
                                                                    let companyForms = document.querySelectorAll("#company_form")
                                                                    companyForms.forEach((form) => form.className = "col-6 animate__animated animate__fadeIn");
                                                                }
                                                            </script>
                                                        </div>
                                                    </div>
                                                    <div class="col-12">
                                                        <label for="inputPassword4" class="form-label">前台顯示名稱</label>
                                                        <input class="form-control bg-light-subtle" type="text" name="name">
                                                    </div>
                                                    <div class="d-none" id="company_form">
                                                        <label for="inputPassword4" class="form-label">公司抬頭</label>
                                                        <input class="form-control bg-light-subtle" type="text" name="businessName">
                                                    </div>
                                                    <div class="d-none" id="company_form">
                                                        <label for="inputPassword4" class="form-label">統一編號</label>
                                                        <input class="form-control bg-light-subtle" type="text" name="businessInvoice">
                                                    </div>
                                                    <div class="col-6">
                                                        <label for="inputPassword4" class="form-label">銀行戶名</label>
                                                        <input class="form-control bg-light-subtle" type="text" name="bankName">
                                                    </div>
                                                    <div class="col-6">
                                                        <label for="inputPassword4" class="form-label">銀行代碼</label>
                                                        <input class="form-control bg-light-subtle" type="text" name="bankCode">
                                                    </div>
                                                    <div class="col-6">
                                                        <label for="inputPassword4" class="form-label">分行</label>
                                                        <input class="form-control bg-light-subtle" type="text" name="bankBranch">
                                                    </div>
                                                    <div class="col-6">
                                                        <label for="inputPassword4" class="form-label">銀行帳號</label>
                                                        <input class="form-control bg-light-subtle" type="text" name="amountNumber">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-3 g-2">
                                                <div class="row g-2">
                                                    <div class="col-12 mt-4">
                                                        <label for="inputPassword4" class="form-label">上傳大頭貼</label>
                                                        <img class="img-fluid mt-2" src="organizer_avatar/default.png" alt="">
                                                    </div>
                                                    <div class="col-12" style="margin-top: 10px;">
                                                        <label class="btn btn-secondary mt-2 me-1">
                                                            <div>上傳</div>
                                                            <input class="d-none" type="file" name="avatar" id="upload-avater" accept="image/gif,image/jpeg,image/png,.svg">
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>
                                            <script>
                                                let input = document.getElementById("upload-avater");
                                                // let previewImg = document.getElementsById("preview");
                                                var previewImg = document.getElementsByTagName('img')[2];

                                                function upload(e) {
                                                    let uploadImg = e.target.files || e.dataTransfer.files;
                                                    console.log(uploadImg);
                                                    previewImg.src = window.URL.createObjectURL(uploadImg[0]);
                                                }

                                                input.addEventListener('change', upload);
                                            </script>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php endif ?>
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