<?php
require_once("../connect_server.php");

?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>編輯頁面</title>

    <?php include('../public_head.php') ?>


</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- SideBar -->
        <?php include('../sidebar.php'); ?>

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <?php include('../topbar.php'); ?>

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <div class="d-sm-flex align-items-center pt-3 mb-4 mx-4">
                        <h1 class="h3 mb-0 text-gray-800 font-weight-bolder">更新活動</h1>
                    </div>

                    <div class="mx-4">
                        <div class="pb-3 my-3">
                            <a class="btn btn-primary text-white" href="event.php">回活動列表</a>
                        </div>
                        <?php

                        if (isset($_GET["id"])) {
                            $id = $_GET["id"];
                            $sql = "SELECT event.*, organizer.name AS merchant_name FROM event
                            JOIN organizer ON organizer.id = event.merchant_id
                            WHERE event.id=$id AND event.valid= 1";

                            $result = $conn->query($sql);
                            $eventCount = $result->num_rows;
                            $row = $result->fetch_assoc();
                        ?>

                            <form action="doUpdate.php" method="post" enctype="multipart/form-data" class="row">
                                <input type="hidden" name="id" value="<?= $row["id"] ?>">
                                <div class="row mb-3 col-lg-6">
                                    <label for="event_name" class="col-sm-2 col-form-label">活動名稱</label>
                                    <div class="col-sm-10">
                                        <input name="event_name" type="text" class="form-control" id="event_name" value="<?= $row["event_name"] ?>" required>
                                    </div>
                                </div>
                                <div class="row mb-3 col-lg-6">
                                    <label for="event_type_id" class="col-sm-2 col-form-label">活動種類</label>
                                    <div class="col-sm-10">
                                        <select class="form-control" type="text" name="event_type_id" aria-label="Default select example" required>
                                            <option value="">請選擇活動類型</option>
                                            <option value="1" <?php if ($row['event_type_id'] == '1') {
                                                                    echo "selected";
                                                                } ?>>演唱會</option>
                                            <option value="2" <?php if ($row['event_type_id'] == '2') {
                                                                    echo "selected";
                                                                } ?>>展覽</option>
                                            <option value="3" <?php if ($row['event_type_id'] == '3') {
                                                                    echo "selected";
                                                                } ?>>快閃限定活動</option>
                                            <option value="4" <?php if ($row['event_type_id'] == '4') {
                                                                    echo "selected";
                                                                } ?>>市集</option>
                                            <option value="5" <?php if ($row['event_type_id'] == '5') {
                                                                    echo "selected";
                                                                } ?>>粉絲見面會</option>
                                            <option value="6" <?php if ($row['event_type_id'] == '6') {
                                                                    echo "selected";
                                                                } ?>>課程講座</option>
                                            <option value="7" <?php if ($row['event_type_id'] == '7') {
                                                                    echo "selected";
                                                                } ?>>景點門票</option>
                                            <option value="8" <?php if ($row['event_type_id'] == '8') {
                                                                    echo "selected";
                                                                } ?>>體育賽事</option>

                                        </select>
                                    </div>
                                </div>
                                <div class="row mb-3 col-lg-6">
                                    <label for="start_date" class="col-sm-2 col-form-label">開始日期</label>
                                    <div class="col-sm-10">
                                        <input name="start_date" type="datetime-local" class="form-control" id="start_date" value="<?= $row["start_date"] ?>" required>
                                    </div>

                                </div>
                                <div class="row mb-3 col-lg-6">
                                    <label for="end_date" class="col-sm-2 col-form-label">結束日期</label>
                                    <div class="col-sm-10">
                                        <input name="end_date" type="datetime-local" class="form-control" id="end_date" value="<?= $row["end_date"] ?>" required>
                                    </div>
                                </div>
                                <div class="row mb-3 col-lg-6">
                                    <label for="address" class="col-sm-2 col-form-label">地點</label>
                                    <div class="col-sm-10">
                                        <input name="address" type="text" class="form-control" id="address" value="<?= $row["address"] ?>" required>
                                    </div>
                                </div>
                                <div class="row mb-3 col-lg-6">
                                    <label for="merchant_id" class="col-sm-2 col-form-label">主辦單位</label>
                                    <div class="col-sm-10">
                                        <span name="merchant_id" type="text" class="form-control bg-body-secondary" id="merchant_id"><?= $row["merchant_name"] ?> </span>
                                    </div>
                                </div>
                                <div class="row mb-3 col-lg-6">

                                    <label for="images" class="col-sm-2 col-form-label">活動圖片</label>
                                    <div class="col-sm-10">
                                        <input name="images" type="file" class="form-control" id="images" value="<?= $row["images"] ?>" required>
                                    </div>
                                    <div class="m-3 object-fit-cover ">
                                        <h5>原圖:</h5>
                                        <img src="image/<?= $row["images"] ?>" style="height: 200px;">
                                    </div>

                                </div>


                                <div class="row mb-3 col-lg-6">
                                    <label for="event_price" class="col-sm-2 col-form-label">票價</label>
                                    <div class="col-sm-10">
                                        <input name="event_price" type="text" class="form-control" id="event_price" value="<?= $row["event_price"] ?>" required>
                                    </div>
                                </div>

                                <div class="col-lg-12 text-center mb-3">
                                    <button class="btn btn-primary text-white" type="submit" name="update">儲存</button>
                                    <a class="btn btn-warning text-white" href="event.php?id=<?= $row["id"] ?>">取消</a>
                                </div>

                            </form>
                        <?php
                        }
                        ?>




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

    <?php include('../public-js.php') ?>

</body>

</html>