<?php
session_start();
if ((!isset($_SESSION["key"]) || empty($_SESSION["key"])) || $_SESSION["key"] != 'em') {
    echo "<script>window.location.assign('/App/controllers/authLogout.php')</script>";

}
?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <title>ข้อมูลทั่วไป - DICE SHOP</title>

    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content="Construction Html5 Template">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=5.0">



    <?php include_once('../inc/stylesheet.php') ?>

</head>

<body>
    <div class="body-inner">

        <?php include_once("./header.php") ?>

        <section id="main-container" class="main-container">
            <div class="container">
                <div class="row">
                    <div class="col-lg-2 order-1 order-lg-0">
                        <div class="sidebar sidebar-left">
                            <div class="widget">
                                <h3 class="widget-title">ข้อมูลทั่วไป</h3>
                                <ul class="arrow nav nav-tabs">
                                    <li><a href="javascript:show_div('info_show')">ข้อมูลส่วนตัว</a></li>
                                    <!-- <li><a href="#">แก้ไขข้อมูล</a></li> -->
                                    <!-- <li><a href="javascript:show_div('hi_show')">ประวัติการจอง</a></li> -->
                                </ul>
                            </div>
                        </div>
                    </div>
                    <script>
                        function show_div(id) {
                            if (id == 'hi_show') {
                                $("#info_show").css("display", "none");
                                $("#hi_show").css("display", "block");
                                update_hiShow_table();

                            } else if (id == 'info_show') {
                                $("#info_show").css("display", "block");
                                $("#hi_show").css("display", "none");
                            }
                        }
                    </script>
                    <div id="info_show" style="display: block;" class="col-lg-10 mb-5 mb-lg-0 order-0 order-lg-1">
                        <div class="post">
                            <div class="post-body">
                                <div class="entry-header">
                                    <h2 class="entry-title">
                                        <a href="javascript:void(0)">ข้อมูลส่วนตัว</a>
                                    </h2>
                                </div><!-- header end -->

                                <div class="entry-content">
                                    <strong class="info_name">รหัสบัตรประชาชน : </strong> <?php echo $USER->codeID; ?>

                                    <br>
                                    <strong class="info_name">ชื่อ : </strong> <?php echo $USER->name ?>

                                    <br>
                                    <strong class="info_name">เบอร์ : </strong> <?php echo $USER->phone ?>
                                    <br>
                                    <strong class="info_name">อีเมล : </strong> <?php echo $USER->email ?>
                                    <br>
                                    <strong class="info_name">ชื่อผู้ใช้ : </strong> <?php echo $USER->username; ?>
                                    <div class="post-footer">
                                        <a href="javascript:$('#edit-account').modal('show');" class="btn btn-primary">แก้ไขข้อมูล</a>
                                    </div>

                                </div>
                            </div>
                        </div>


                    </div>

                </div>
        </section>

        <div class="modal fade" id="edit-account" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <form id="form-edit-account" action="javascript:void(0)" method="POST">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLongTitle">แก้ไขข้อมูลส่วนตัว</h5>
                            <p>

                            </p>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <input type="hidden" name="id" value="<?php echo $USER->id ?>">
                            <label for="" class="form-control-label">ข้อมูลทั่วไป</label>
                            <div class="form-group">
                                <input type="text" name="codeID" value="<?php echo $USER->codeID ?>" class="form-control" placeholder="รหัสบัตรประชาชน" required>
                            </div>
                            <div class="form-group">
                                <input type="text" name="name" value="<?php echo $USER->name ?>" class="form-control" placeholder="ชื่อ" required>
                            </div>
                            <div class="form-group">
                                <input type="tel" name="phone" value="<?php echo $USER->phone ?>" class="form-control" placeholder="เบอร์" required>
                            </div>
                            <div class="form-group">
                                <input type="email" name="email" value="<?php echo $USER->email ?>" class="form-control" placeholder="เบอร์" required>
                            </div>
                            <label for="" class="form-control-label">ข้อมูลล็อกอิน</label>
                            <div class="form-group">
                                <input type="text" name="username" value="<?php echo $USER->username ?>" class="form-control" placeholder="ชื่อผู้ใช้" required>
                            </div>
                            <div class="form-group">
                                <input type="password" name="pass" value="<?php echo $USER->pass ?>" class="form-control" placeholder="รหัสผ่าน" required>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">ปิด</button>
                            <button type="submit" class="btn btn-primary">แก้ไขข้อมูล</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>




        <?php include_once('../inc/script.php') ?>

    </div><!-- Body inner end -->
</body>

</html>