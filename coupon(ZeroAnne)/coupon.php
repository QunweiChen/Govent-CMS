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

    <title>個別優惠券資訊</title>

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
        <?php include('../sidebar.php'); ?>

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <?php include('../topbar.php'); ?>

                <!-- Begin Page Content -->
                <div class="container-fluid">
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800">個別優惠券資訊</h1>
                        <div class="d-flex align-items-center">
                            <a href="coupon-list-edit.php" class="text-primary pe-3">回編輯列表</a>
                            <a href="coupon-list-edit.php" class=""><i class="bi bi-box-arrow-right fs-4"></i></a>
                        </div>
                    </div>
                    <div class="container">
                        <table class="table table-bordered ">
                            <tr>
                                <th>ID</th>
                                <td colspan="3"><?= $row["id"] ?></td>
                            </tr>
                            <tr>
                                <th>優惠券名稱</th>
                                <td><?= $row["coupon_name"] ?></td>
                                <th>兌換代碼</th>
                                <td><?= $row["coupon_code"] ?></td>
                            </tr>
                            <tr>
                                <th>使用狀態</th>
                                <td colspan="3"><?= $row["coupon_valid_name"] ?></td>
                            </tr>
                            <tr>
                                <th>折扣類型</th>
                                <td><?= $row["discount_type"] ?></td>
                                <th>打折/金額折價</th>
                                <td><?= $row["discount_valid"] ?></td>
                            </tr>
                            <tr>
                                <th>開始日期</th>
                                <td><?= $row["start_at"] ?></td>
                                <th>到期日期</th>
                                <td><?= $row["expires_at"] ?></td>
                            </tr>
                            <tr>
                                <th>最低消費</th>
                                <td colspan="3"><?= $row["price_min"] ?></td>
                            </tr>
                            <tr>
                                <th>剩餘張數</th>
                                <td colspan="3"><?= $row["max_usage"] ?></td>
                            </tr>
                            <tr>
                                <th>適用活動</th>
                                <td colspan="3"><?= $row["activity_name"] ?></td>
                            </tr>
                        </table>
                        <div class="py-1">
                            <a href="coupon-edit.php?id=<?= $row["id"] ?>" class="btn text-primary btn-lg" title="編輯資料"><i class="bi bi-pencil-fill"></i>編輯修改</a>
                        </div>
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