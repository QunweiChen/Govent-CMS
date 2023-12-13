<?php

require_once("../ticket(Angus Lin)/ticket_db_connect.php");

$sqlTicketCategory = "SELECT * FROM ticket_category";

$sqlTotal = "SELECT * FROM ticket_type WHERE valid=2";
$perPage = 8;
$resultPage = $conn->query($sqlTotal);
$pageTotalCount = $resultPage->num_rows;
$pageCount = ceil($pageTotalCount / $perPage);
// var_dump($pageCount);

if (isset($_GET["category"])) {
    $category = $_GET["category"];
    $page = isset($_GET["page"]) ? $_GET["page"] : 1;
    // This line of code uses the ternary operator, which is a shorthand for an if-else statement. The ternary operator is written as condition ? exprIfTrue : exprIfFalse.
    // If the Condition is True ($_GET["page"]):
    // If the page parameter is present in the URL, its value is retrieved using $_GET["page"].
    //If the Condition is False (1):
    // If the page parameter is not present in the URL, the expression after the colon (:) is used, which in this case is 1.
    // This means that if no specific page is requested, the script defaults to using page number 1.
    $startTicket = ($page - 1) * $perPage;
    $sqlTicketType = "SELECT * FROM ticket_type WHERE category_id = $category AND valid = '2' LIMIT $startTicket, $perPage";
} else {
    $page = isset($_GET["page"]) ? $_GET["page"] : 1;
    $startTicket = ($page - 1) * $perPage;
    $sqlTicketType = "SELECT * FROM ticket_type WHERE valid = '2' LIMIT $startTicket, $perPage";
}



// if (isset($_GET["category"])){
//     $category = $_GET["category"];
//     $sqlTicketType = "SELECT * FROM ticket_type WHERE category_id = $category";

// }else if(isset($_GET["page"])){
//     $page = $_GET["page"];
//     $startTicket = ($page - 1) * $perPage;
//     // var_dump($startTicket, $perPage, $pageCount);
//     $sqlTicketType = "SELECT * FROM ticket_type Limit $startTicket, $perPage";
// }else{
//     $page = 1;
//     $sqlTicketType = "SELECT * FROM ticket_type Limit 0, $perPage";    
// }

$result = $conn->query($sqlTicketCategory);
$rowsTicketCategory = $result->fetch_all(MYSQLI_ASSOC);
// var_dump($rows);

$resultTicketType = $conn->query($sqlTicketType);
$rowsTicketType = $resultTicketType->fetch_all(MYSQLI_ASSOC);

$TicketTypeCount = $resultTicketType->num_rows;
// var_dump($rowsTicketType);
?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>ticket-list</title>

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

    <!-- main:color #fd7e14 -->

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
                        <a class="collapse-item" href="ticket-list.php">票卷管理</a>
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
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800">票卷種類管理</h1>
                    </div>
                    <ul class="nav nav-pills">
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="ticket-list.php" style="color:#fd7e14; background-color:#ccc">全部票卷種類</a>
                        </li>
                        <?php foreach ($rowsTicketCategory as $ticketCategory) : ?>
                            <li class="nav-item">
                                <a class="nav-link <?php if (isset($_GET["category"]) && $_GET["category"] == $ticketCategory["id"]) echo "active"; ?>" href="ticket-list.php?category=<?= $ticketCategory["id"] ?>">
                                    <?= $ticketCategory["name"] ?>
                                </a>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                    <!-- total count and add-ticket-type button -->
                    <div class="d-flex justify-content-between align-items-center mb-2">
                        <div>
                            共 <?= $TicketTypeCount ?> 種票
                        </div>
                        <div>
                            <a type="button" class="btn btn-outline-warning btn-sm" href="../ticket(Angus Lin)/add-ticket-type.php"><i class="bi bi-plus-lg"></i> 新增票卷種類</a>
                        </div>
                    </div>
                    <!-- ticket-type table -->
                    <div>
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>編號</th>
                                    <th>有無選擇座位</th>
                                    <th>活動編號</th>
                                    <th>票卷名稱</th>
                                    <th>票卷價格</th>
                                    <th>票卷總數</th>
                                    <th>剩餘票卷數</th>
                                    <th>刪除</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($rowsTicketType as $ticketType) : ?>

                                    <?php $category = isset($_GET["category"]) ? ($_GET["category"]) : ""; ?>

                                    <!-- delete pup-up window -->
                                    <div class="modal" id="alertModal<?= $ticketType["id"] ?><?= $_GET["page"] ?><?= $_GET["category"] ?>" tabindex="-1" aria-labelledby="" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">警告</h5>
                                                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    <span aria-hidden="true">&times;</span>
                                                </div>
                                                <div class="modal-body">
                                                    確認刪除?
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">取消</button>
                                                    <a href="doDeleteTicketType.php?id=<?= $ticketType["id"] ?>
                                                    <?= isset($_GET["page"]) ? '&page=' .($_GET["page"]) : '' ?>
                                                    <?= isset($_GET["category"]) ? '&category=' .($_GET["category"]) : '' ?>" class="btn btn-danger" class="btn btn-danger">確認</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <tr>
                                        <td>
                                            <?= $ticketType["id"] ?>
                                        </td>
                                        <td>
                                            <?= $ticketType["ticket_type_id"] ?>
                                        </td>
                                        <td>
                                            <?= $ticketType["event_id"] ?>
                                        </td>
                                        <td class="text-truncate" style="max-width: 25vw">
                                            <a class="p-1" href="ticket-type.php?id=<?= $ticketType["id"] ?>" title="詳細資料">
                                                <i class="bi bi-database-fill-add"></i>
                                            </a>
                                            <span>
                                                <?= $ticketType["name"] ?>
                                            </span>
                                        </td>
                                        <td>
                                            <?= $ticketType["price"] ?>
                                        </td>
                                        <td>
                                            <?= $ticketType["max_quantity"] ?>
                                        </td>
                                        <td>
                                            <?= $ticketType["remaining_quantity"] ?>
                                        </td>
                                        <td>
                                            <button type="button" data-toggle="modal" data-target="#alertModal<?= $ticketType["id"] ?><?= $_GET["page"] ?><?= $_GET["category"] ?>" class="btn btn-danger">
                                                <i class="bi bi-trash-fill"></i>
                                            </button>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                    <!-- page nav -->
                    <nav aria-label="Page navigation example" class="d-flex justify-content-center">
                        <ul class="pagination">
                            <li class="page-item">
                                <?php if ($page == 1 || $page == 0) : ?>
                                    <a class="page-link" href="ticket-list.php?page=1<?php if (isset($category) && $category != '') echo "&category=$category" ?>" aria-label="Previous">
                                        <span aria-hidden="true">&laquo;</span>
                                    </a>
                                <?php else : ?>
                                    <a class="page-link" href="ticket-list.php?page=<?= $page - 1 ?><?php if (isset($category) && $category != '') echo "&category=$category" ?>" aria-label="Previous">
                                        <span aria-hidden="true">&laquo;</span>
                                    </a>
                                <?php endif; ?>
                            </li>
                            <?php for ($i = 1; $i <= $pageCount; $i++) : ?>

                                <li class="page-item"><a class="page-link <?php if ($page == $i) echo "active" ?>" href="ticket-list.php?page=<?= $i ?><?php if (isset($category) && $category != '') echo "&category=$category" ?>" style="color:#fd7e14"><?= $i ?></a></li>

                                <!-- isset($_GET["category"]) ? &category=$category : ""; -->
                            <?php endfor; ?>
                            <li class="page-item">
                                <?php if ($page == $pageCount) : ?>
                                    <!-- If on the last page, the link will lead to the current (last) page itself -->
                                    <a class="page-link" href="ticket-list.php?page=<?= $page ?><?php if (isset($category) && $category != '') echo "&category=$category" ?>" aria-label="Next">
                                        <span aria-hidden="true">&raquo;</span>
                                    </a>
                                <?php else : ?>
                                    <!-- If not on the last page, the link will lead to the next page -->
                                    <a class="page-link" href="ticket-list.php?page=<?= $page + 1 ?><?php if (isset($category) && $category != '') echo "&category=$category" ?>" aria-label="Next">
                                        <span aria-hidden="true">&raquo;</span>
                                    </a>
                                <?php endif; ?>
                            </li>
                        </ul>
                    </nav>
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