<?php
require_once("./db_conntect_govent.php");

$use = isset($_GET["use"]) ? $_GET["use"] : null;
$search = isset($search) ? $search : '';

if ($use !== null) {
    $use = $_GET["use"];
    $sqlTotal = "SELECT * FROM coupon WHERE coupon_valid='$use' ";
} elseif (isset(($_GET["search"]))) {
    $search = $_GET["search"];
    $sqlTotal = "SELECT * FROM coupon 
    JOIN couponvalid ON coupon.coupon_valid=couponvalid.coupon_valid_id 
    JOIN activity_category ON coupon.activity_num=activity_category.id 
    WHERE activity_name LIKE '%$search%'AND (coupon_valid=2 OR coupon_valid=1) OR coupon_name LIKE '%$search%'AND (coupon_valid=2 OR coupon_valid=1)";
} else {
    $sqlTotal = "SELECT * FROM coupon WHERE (coupon_valid=2 OR coupon_valid=1)";
}
//查詢資料//幾筆資料
$resultTotal = $conn->query($sqlTotal);
$totalUser = $resultTotal->num_rows;
$perPage = 5;
$pageCount = ceil($totalUser / $perPage);

if (isset($_GET["search"])) {
    $search = $_GET["search"];
    $sql = "SELECT coupon.* ,coupon_valid_name, activity_name 
    FROM coupon 
    JOIN couponvalid ON coupon.coupon_valid=couponvalid.coupon_valid_id 
    JOIN activity_category ON coupon.activity_num=activity_category.id 
    WHERE activity_name LIKE '%$search%'AND (coupon_valid=2 OR coupon_valid=1) OR coupon_name LIKE '%$search%'AND (coupon_valid=2 OR coupon_valid=1)";
} elseif (isset($_GET["use"]) && isset($_GET["page"]) && isset($_GET["order"])) {
    $use = $_GET["use"];
    $page = $_GET["page"];
    $order = $_GET["order"];
    switch ($order) {
        case 1:
            $orderSql = "id ASC";
            break;
        case 2:
            $orderSql = "id DESC";
            break;
        case 3:
            $orderSql = "activity_num ASC";
            break;
        case 4:
            $orderSql = "activity_num DESC";
            break;
        default:
            $orderSql = "id ASC";
    }
    // var_dump($use);
    $starItem = ($page - 1) * $perPage;
    $sql = "SELECT coupon.* ,coupon_valid_name, activity_name 
    FROM coupon 
    JOIN couponvalid ON coupon.coupon_valid=couponvalid.coupon_valid_id 
    JOIN activity_category ON coupon.activity_num=activity_category.id AND coupon_valid='$use' ORDER BY $orderSql LIMIT $starItem,$perPage";
} elseif (isset($_GET["page"]) && isset($_GET["order"])) {
    $page = $_GET["page"];
    $order = $_GET["order"];
    switch ($order) {
        case 1:
            $orderSql = "id ASC";
            break;
        case 2:
            $orderSql = "id DESC";
            break;
        case 3:
            $orderSql = "activity_num ASC";
            break;
        case 4:
            $orderSql = "activity_num DESC";
            break;
        default:
            $orderSql = "id ASC";
    }
    // var_dump($use);
    $starItem = ($page - 1) * $perPage;
    $sql = "SELECT coupon.* ,coupon_valid_name, activity_name 
    FROM coupon 
    JOIN couponvalid ON coupon.coupon_valid=couponvalid.coupon_valid_id 
    JOIN activity_category ON coupon.activity_num=activity_category.id AND (coupon_valid=2 OR coupon_valid=1) ORDER BY $orderSql LIMIT $starItem,$perPage";
} else {
    $page = 1;
    $order = 1;
    $sql = "SELECT coupon.* ,coupon_valid_name, activity_name 
    FROM coupon 
    JOIN couponvalid ON coupon.coupon_valid=couponvalid.coupon_valid_id 
    JOIN activity_category ON coupon.activity_num=activity_category.id WHERE(coupon_valid=2 OR coupon_valid=1)
    LIMIT 0,$perPage";
}
//判斷超過頁碼


$result = $conn->query($sql);
$rows = $result->fetch_all(MYSQLI_ASSOC);
// var_dump($rows);

//時間判斷
foreach ($rows as $rowtime) {
    // 假設你有一個日期時間字符串
    $dateStringexpiresAt = $rowtime["expires_at"];
    $dateStringstartAt = $rowtime["start_at"];
    // 將日期時間字符串轉換為Unix時間戳
    $timeStampexpiresAt = strtotime($dateStringexpiresAt);
    $timeStampstartAt = strtotime($dateStringstartAt);
    // 獲取當前的Unix時間戳
    $currentTimeStamp = time();

    // 進行時間比較
    if ($timeStampexpiresAt < $currentTimeStamp || $timeStampstartAt > $currentTimeStamp) {
        // echo "{$dateString} 在現在之前。";
        $updatesql = "UPDATE coupon SET coupon_valid='2' WHERE id = '$rowtime[id]'";
        // var_dump($updatesql);
        if ($conn->query($updatesql) === TRUE) {
            // echo "更新成功";
        } else {
            // echo "更新資料錯誤: " . $conn->error;
        }
    } elseif ($timeStampexpiresAt > $currentTimeStamp || $timeStampstartAt < $currentTimeStamp) {
        // echo "{$dateString} 在現在之後。";
        $updatesql = "UPDATE coupon SET coupon_valid='1' WHERE id = '$rowtime[id]'";
        // var_dump($updatesql);
        if ($conn->query($updatesql) === TRUE) {
            // echo "更新成功";
        } else {
            // echo "更新資料錯誤: " . $conn->error;
        }
    } else {
        // echo "{$dateString} 和現在是相同的時間。";
    }
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

    <title>優惠券清單</title>

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
                        <a class="collapse-item" href="add-coupon.php">新增優惠券</a>
                        <a class="collapse-item" href="coupon-list-edit.php">編輯/刪除優惠券</a>
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
                        <h1 class="h3 mb-0 text-gray-800">優惠券清單</h1>
                    </div>

                    <!-- Content Row -->
                    <div>
                        <div class="py-2">
                            <form action="">
                                <div class="input-group mb-3 ">
                                    <?php if (isset($_GET["search"])) : ?>
                                        <input type="text" class="form-control" value="<?= $_GET['search'] ?>" name="search">
                                        <button class="btn btn-primary" type="submit" id=""><i class="bi bi-search"></i></button>
                                    <?php else : ?>
                                        <input type="text" class="form-control" placeholder="Search.." name="search">
                                        <button class="btn btn-primary" type="submit" id=""><i class=" bi bi-search"></i></button>
                                    <?php endif; ?>
                                </div>
                            </form>
                        </div>
                        <div class="pb-2 d-flex justify-content-between orders align-items-center">
                            <div class="btn-group">
                                <a class="btn btn-outline-primary <?php if (!isset($_GET["use"])) echo "active"; ?>" href="coupon-list.php?page=1&order=<?= $order ?>">總票券量</a>
                                <a class="btn btn-outline-primary <?php if ($use == 1) echo "active"; ?>" href="coupon-list.php?page=1&use=1&order=<?= $order ?>">可使用</a>
                                <a class="btn btn-outline-primary <?php if ($use == 2) echo "active"; ?>" href="coupon-list.php?page=1&use=2&order=<?= $order ?>">已停用</a>
                            </div>
                            <div class="dropdown">
                                <a class="btn btn-outline-primary dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    排序方式
                                </a>
                                <ul class="dropdown-menu">
                                    <?php if (!isset($_GET["order"])) : $order = 1; ?>
                                    <?php endif; ?>
                                    <?php if (isset($_GET["use"])) : ?>
                                        <li><a class="dropdown-item <?php if ($order == 1) echo "active"; ?>" href="coupon-list.php?page=<?= $page ?>&order=1&use=<?= $use ?>">ID由小<i class="bi bi-arrow-right-short"></i>大</a></li>
                                        <li><a class="dropdown-item <?php if ($order == 2) echo "active"; ?>" href="coupon-list.php?page=<?= $page ?>&order=2&use=<?= $use ?>">ID由大<i class="bi bi-arrow-right-short"></i>小</a></li>
                                        <li><a class="dropdown-item <?php if ($order == 3) echo "active"; ?>" href="coupon-list.php?page=<?= $page ?>&order=3&use=<?= $use ?>">活動類別由小<i class="bi bi-arrow-right-short"></i>大</a></li>
                                        <li><a class="dropdown-item <?php if ($order == 4) echo "active"; ?>" href="coupon-list.php?page=<?= $page ?>&order=4&use=<?= $use ?>">活動類別由大<i class="bi bi-arrow-right-short"></i>小</a></li>
                                    <?php else : ?>
                                        <li><a class="dropdown-item <?php if ($order == 1) echo "active"; ?>" href="coupon-list.php?page=<?= $page ?>&order=1">ID由小<i class="bi bi-arrow-right-short"></i>大</a></li>
                                        <li><a class="dropdown-item <?php if ($order == 2) echo "active"; ?>" href="coupon-list.php?page=<?= $page ?>&order=2">ID由大<i class="bi bi-arrow-right-short"></i>小</a></li>
                                        <li><a class="dropdown-item <?php if ($order == 3) echo "active"; ?>" href="coupon-list.php?page=<?= $page ?>&order=3">活動類別由小<i class="bi bi-arrow-right-short"></i>大</a></li>
                                        <li><a class="dropdown-item <?php if ($order == 4) echo "active"; ?>" href="coupon-list.php?page=<?= $page ?>&order=4">活動類別由大<i class="bi bi-arrow-right-short"></i>小</a></li>
                                    <?php endif; ?>
                                </ul>
                            </div>
                        </div>
                        <?php if (!isset($_GET["search"])) : ?>
                            <div class="pb-2 text-end">
                                共 <?= $totalUser ?> 筆
                            </div>
                        <?php else : ?>
                            <div class="pb-2 text-end">
                                搜尋"<?= $_GET['search'] ?>"的結果,
                                共 <?= $totalUser ?> 筆
                            </div>
                        <?php endif; ?>
                        <table class="table text-center text-nowrap align-items-center table-hover ">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>兌換代碼</th>
                                    <th>優惠券名稱</th>
                                    <th>使用狀態</th>
                                    <th>折扣類型</th>
                                    <th>打折/金額折價</th>
                                    <th>開始日期</th>
                                    <th>到期日期</th>
                                    <th>最低消費</th>
                                    <th>剩餘張數</th>
                                    <th>適用活動</th>
                                    <th>詳細資訊</th>
                                </tr>
                            </thead>
                            <tbody class="">
                                <?php foreach ($rows as $row) : ?>
                                    <tr>
                                        <td><?= $row["id"] ?></td>
                                        <td><?= $row["coupon_code"] ?></td>
                                        <td><?= $row["coupon_name"] ?></td>
                                        <td class="<?php if ($row["coupon_valid"] == 2) echo "text-danger"; ?>"><?= $row["coupon_valid_name"] ?></td>
                                        <td><?= $row["discount_type"] ?></td>
                                        <td><?= $row["discount_valid"] ?></td>
                                        <td><?= $row["start_at"] ?></td>
                                        <td><?= $row["expires_at"] ?></td>
                                        <td><?= $row["price_min"] ?></td>
                                        <td><?= $row["max_usage"] ?></td>
                                        <td><?= $row["activity_name"] ?></td>
                                        <td>
                                            <a class="btn text-primary" href="coupon.php?id=<?= $row["id"] ?>" title="詳細資料"><i class="bi bi-ticket-perforated-fill"></i></a>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                        <?php if (!isset($_GET["search"])) : ?>
                            <?php if (isset($_GET["use"])) : ?>
                                <nav aria-label="Page navigation example d-flex justify-content-between align-items-center">
                                    <ul class="pagination">
                                        <li class="page-item">
                                            <?php if ($page == 1) : ?>
                                                <a class="page-link" href="coupon-list.php?page=<?= $page ?>&use=<?= $use ?>&order=<?= $order ?>" aria-label="Previous">
                                                    <span aria-hidden="true">&laquo;</span>
                                                </a>
                                            <?php else : ?>
                                                <a class="page-link" href="coupon-list.php?page=<?= $page - 1 ?>&use=<?= $use ?>&order=<?= $order ?>" aria-label="Previous">
                                                    <span aria-hidden="true">&laquo;</span>
                                                </a>
                                            <?php endif; ?>
                                        </li>
                                        <?php for ($i = 1; $i <= $pageCount; $i++) : ?>
                                            <li class="page-item <?php if ($page == $i) echo "active"; ?>"><a class="page-link" href="coupon-list.php?page=<?= $i ?>&use=<?= $use ?>&order=<?= $order ?>"><?= $i ?></a></li>
                                        <?php endfor; ?>
                                        <li class="page-item">
                                            <?php if ($page == $pageCount) : ?>
                                                <a class="page-link" href="coupon-list.php?page=<?= $page ?>&use=<?= $use ?>&order=<?= $order ?>" aria-label="Next">
                                                    <span aria-hidden="true">&raquo;</span>
                                                </a>
                                            <?php else : ?>
                                                <a class="page-link" href="coupon-list.php?page=<?= $page + 1 ?>&use=<?= $use ?>&order=<?= $order ?>" aria-label="Next">
                                                    <span aria-hidden="true">&raquo;</span>
                                                </a>
                                            <?php endif; ?>
                                        </li>
                                    </ul>
                                </nav>
                            <?php else : ?>
                                <nav aria-label="Page navigation example d-flex justify-content-between align-items-center">
                                    <ul class="pagination">
                                        <li class="page-item">
                                            <?php if ($page == 1) : ?>
                                                <a class="page-link" href="coupon-list.php?page=<?= $page ?>&order=<?= $order ?>" aria-label="Previous">
                                                    <span aria-hidden="true">&laquo;</span>
                                                </a>
                                            <?php else : ?>
                                                <a class="page-link" href="coupon-list.php?page=<?= $page - 1 ?>&order=<?= $order ?>" aria-label="Previous">
                                                    <span aria-hidden="true">&laquo;</span>
                                                </a>
                                            <?php endif; ?>
                                        </li>
                                        <?php for ($i = 1; $i <= $pageCount; $i++) : ?>
                                            <li class="page-item <?php if ($page == $i) echo "active"; ?>"><a class="page-link" href="coupon-list.php?page=<?= $i ?>&order=<?= $order ?>"><?= $i ?></a></li>
                                        <?php endfor; ?>
                                        <li class="page-item">
                                            <?php if ($page == $pageCount) : ?>
                                                <a class="page-link" href="coupon-list.php?page=<?= $page ?>&order=<?= $order ?>" aria-label="Next">
                                                    <span aria-hidden="true">&raquo;</span>
                                                </a>
                                            <?php else : ?>
                                                <a class="page-link" href="coupon-list.php?page=<?= $page + 1 ?>&order=<?= $order ?>" aria-label="Next">
                                                    <span aria-hidden="true">&raquo;</span>
                                                </a>
                                            <?php endif; ?>
                                        </li>
                                    </ul>
                                </nav>
                            <?php endif; ?>
                        <?php endif; ?>
                    </div>
                </div>
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
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

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