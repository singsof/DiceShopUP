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
    <title>จัดการพนักงาน  - DICE SHOP </title>

    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content="Construction Html5 Template">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=5.0">



    <?php include_once('../inc/stylesheet.php') ?>

</head>

<body>
    <div class="body-inner">

        <?php include_once("./header.php") ?>


        <section id="ts-team" class="ts-team">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <h3 class="section-sub-title">จัดการพนักงาน</h3>
                    </div>
                </div>

                <div class="row">

                    <div class="col-lg-12 col-md-12 ">
                        <div class="ts-service-box">

                            <table id="" class="table  table-borderless table-neme " name="">
                                <thead>
                                    <tr>
                                        <th class="text-center">ลำดับ</th>
                                        <th class="text-center">ชื่อโต๊ะ - เลขโต๊ะ</th>
                                        <th>สถานะ</th>
                                        <th><a href="javascript:void(0)" class="btn btn-sm  badge-primary" data-toggle="modal" data-target="#addTable">เพิ่ม</a></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $i = 1;
                                    $tableList = DB::query("SELECT * FROM `diningtable` WHERE status_din != 0 ", PDO::FETCH_OBJ);
                                    foreach ($tableList as $tableList) :
                                    ?>
                                        <tr>
                                            <td class="text-center"><?php echo $i++ ?></td>
                                            <td class="text-center"><?php echo $tableList->name_din ?></td>
                                            <td>
                                                <span class="badge badge-success">พร้อมใช้งาน</span>
                                            </td>
                                            <td>
                                                <a href="javascript:editTables(<?php echo $tableList->id_din ?>)" class='badge badge-success'>แก้ไข</a>
                                                <a href="javascript:deleteTables(<?php echo $tableList->id_din ?>)" class="badge badge-danger">ลบ</a>
                                            </td>

                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                            <script>

                            </script>

                        </div>
                        <!-- Service1 end -->
                    </div>

                </div><!--/ Content row end -->
            </div><!--/ Container end -->
        </section><!--/ Team end -->



        <div class="modal fade" id="addTable" tabindex="-1" role="dialog" aria-labelledby="" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <form id="form-addTables" action="javascript:void(0)" method="post" enctype="multipart/form-data">
                        <div class="modal-header">
                            <h5 class="modal-title" id="">เพิ่มโต๊ะนั่ง</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">

                            <div class="form-group">
                                <label for="">กรุณากรอกชื่อโต๊ะนั่ง</label>
                                <input type="text" name="name_din" class="form-control" required>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">ยกเลิก</button>
                            <button type="submit" class="btn btn-primary">บันทึก</button>
                        </div>
                    </form>

                </div>
            </div>
        </div>


        <div class="modal fade" id="editTables" tabindex="-1" role="dialog" aria-labelledby="" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content editTables-model">
                </div>
            </div>
        </div>









        <?php include_once('../inc/script.php') ?>

    </div><!-- Body inner end -->
</body>

</html>
