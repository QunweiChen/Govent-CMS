<?php

if (!isset($_GET["id"])) {
    header("location: member_list.php");
}

$id = $_GET["id"]; //為連結到id來源


require_once("../connect_server.php");

// $sql = "SELECT * FROM member_list WHERE id=$id AND valid=1";

$sql = "SELECT *
FROM member_list
JOIN city 
ON member_list.address = city.city_id 
JOIN member_leval 
ON member_list.member_leval = member_leval.leval_id 
WHERE member_list.valid=1 AND member_list.id = " . $id;

$result = $conn->query($sql);
// $userCount = $result->num_rows;?未知用途
$row = $result->fetch_assoc();
// var_dump($row);  //可拉出資料


// $sql = "SELECT *
// FROM member_list
// JOIN member_leval 
// ON member_list.member_leval = member_leval.leval_id 
// WHERE member_list.valid=1 AND member_list.id = " . $row["id"];


?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>member Data</title>

    <?php include('../public_head.php') ?>

</head>


<!-- <div class="modal fade" id="alertModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-sm">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">警告</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        確認刪除
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">取消</button>
        <button type="button" class="btn btn-danger">刪除</button>
      </div>
    </div>
  </div>
</div> -->


<div class="modal fade" id="alertModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                <a class="btn btn-primary" href="member_login.php">刪除</a>
            </div>
        </div>
    </div>
</div>

<body id="page-top">


    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <?php include('../sidebar.php'); ?>

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <?php include('../topbar.php'); ?>

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <div class="d-sm-flex align-items-center pt-2 mb-4 mx-4 justify-content-between">
                        <div class="d-flex align-items-center">
                            <h1 class="h3 mb-0 me-3 text-gray-800 font-weight-bolder">會員資料</h1>
                            <a class="btn btn-primary text-white" href="member_list.php"><i class="bi bi-arrow-left me-1"></i>回會員清單</a>
                        </div>
                        <div class="py-2">
                            <a class="btn btn-primary me-1" href="member_edit.php?id=<?= $row["id"] ?>" title="詳細資料">修改會員資料<i class="ms-1 bi bi-pencil-square"></i></a>
                            <!-- <a class="btn btn-info text-white" href="?id=<?= $row["id"] ?>">Cancel</a> -->
                        </div>
                    </div>

                    <!-- Content Row -->
                    <div class="mx-4 animate__animated animate__fadeIn animate__faster">
                        <form action="doUpdate.php" method="post">
                            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                <input type="hidden" name="id" value="<?= $row["id"] ?>">
                                <tr>
                                    <th>ID</th>
                                    <td>
                                        <?= $row["id"] ?>
                                    </td>
                                </tr>
                                <tr>
                                    <th>會員等級</th>
                                    <td> <?= $row["leval_name"] ?></td>
                                </tr>
                                <tr>
                                    <th>姓名</th>
                                    <td>
                                        <?= $row["name"] ?>
                                    </td>
                                </tr>
                                <tr>
                                    <th>Email</th>
                                    <td>
                                        <?= $row["email"] ?>
                                    </td>
                                </tr>
                                <tr>
                                    <th>電話</th>
                                    <td>
                                        <?= $row["phone"] ?>
                                    </td>
                                </tr>
                                <tr>
                                    <th>密碼</th>
                                    <td>
                                        <?= $row["password"] ?>
                                    </td>
                                </tr>
                                <tr>
                                    <th>身分證</th>
                                    <td>
                                        <?= $row["national_id"] ?>
                                    </td>
                                </tr>
                                <tr>
                                    <th>地址</th>
                                    <td>
                                        <?= $row["city_name"] ?><?= $row["dist_name"] ?>
                                    </td>
                                </tr>
                                <tr>
                                    <th>出生日期</th>
                                    <td>
                                        <?= $row["born_date"] ?>
                                    </td>
                                </tr>
                                <tr>
                                    <th>電子發票</th>
                                    <td>
                                        <?= $row["invoice"] ?>
                                    </td>
                                </tr>
                                <tr>
                                    <th>註冊日期</th>
                                    <td><?= $row["created_at"] ?></td>
                                </tr>

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
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                    <a class="btn btn-primary" href="member_login.php">登出</a>
                </div>
            </div>
        </div>
    </div>

    <?php include('../public-js.php') ?>

</body>

</html>