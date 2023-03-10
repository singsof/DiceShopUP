<?php
session_start();
if ((!isset($_SESSION["key"]) || empty($_SESSION["key"])) || $_SESSION["key"] != 'cm') {
    echo "<script>window.location.assign('/App/controllers/authLogout.php')</script>";

}
?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <title>ข้อมูลทั่วไป  - DICE SHOP</title>

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
                                    <li><a href="javascript:show_div('reserve_mg')">จัดการจอง</a></li>
                                    <li><a href="javascript:show_div('reserve_hi')">ประวัติการจอง</a></li>

                                </ul>
                            </div>
                        </div>
                    </div>
                    <script>
                        function show_div(id) {
                            if (id == 'reserve_hi') {
                                $("#info_show").css("display", "none");
                                $("#reserve_mg").css("display", "none");
                                $("#reserve_hi").css("display", "block");


                            } else if (id == 'info_show') {
                                $("#info_show").css("display", "block");
                                $("#reserve_hi").css("display", "none");
                                $("#reserve_mg").css("display", "none");

                            } else if (id == 'reserve_mg') {
                                $("#reserve_mg").css("display", "block");
                                $("#reserve_hi").css("display", "none");
                                $("#info_show").css("display", "none");
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
                    <div id="reserve_mg" style="display: none;" class="col-lg-10 mb-5 mb-lg-0 order-0 order-lg-1">
                        <div class="post">
                            <div class="post-body">
                                <div class="entry-header">
                                    <h2 class="entry-title">
                                        <a href="javascript:void(0)">จัดการการจอง</a>
                                    </h2>
                                </div><!-- header end -->

                                <div class="entry-content">
                                    <?php
                                    $thaiweek = array("วันอาทิตย์", "วันจันทร์", "วันอังคาร", "วันพุธ", "วันพฤหัส", "วันศุกร์", "วันเสาร์");
                                    $thaimonth = ["มกราคม", "กุมภาพันธ์", "มีนาคม", "เมษายน", "พฤษภาคม", "มิถุนายน", "กรกฎาคม", "สิงหาคม", "กันยายน", "ตุลาคม", "พฤศจิกายน", "ธันวาคม"];

                                    $sql_search = "SELECT *,DATE_FORMAT(rt.date_res, '%d') as Dd ,
                                                            DATE_FORMAT(rt.date_res, '%c') as month ,
                                                            DATE_FORMAT(rt.date_res, '%Y') as year,
                                                            DATE_FORMAT(rt.time_res, '%H : %i ') as timeStart_n ,
                                                            DATE_FORMAT(rt.timeEnd_res, '%H : %i ') as timeEnd_n
                                                    FROM `reservation` as rt
                                                            INNER JOIN diningtable as st ON st.id_din   = rt.id_din
                                                            INNER JOIN users as cm ON cm.id  = rt.id_user
                                                        WHERE (rt.status_res != 0 AND rt.status_res != 3) AND cm.id = '$USERID';";
                                    $i_r = 1;
                                    ?>
                                    <table id="table_reserve" class="table  table-borderless table-neme ">
                                        <thead>
                                            <tr>
                                                <th class="text-center">ลำดับ</th>

                                                <th class="text-center">โต๊ะ</th>
                                                <th class="text-center">จำนวนคน</th>

                                                <th>เข้าร้าน</th>
                                                <th>สถานะ</th>
                                                <th>จัดการ</th>
                                            </tr>
                                        </thead>
                                        <tbody>

                                            <?php

                                            foreach (DB::query($sql_search, PDO::FETCH_OBJ) as $row) :
                                                // $date = 'วันที่ '.$row->Dd.' เดือน'.$thaimonth[$row->month-1].' พ.ศ.'.$row->year+543;
                                                $date = '' . $row->Dd . ' ' . $thaimonth[$row->month - 1] . ' ' . (543 + intval($row->year));;
                                                $timeStart_re = $date . "</br> " . $row->timeStart_n . ' น.';
                                                $timeEnd_re = $date . "</br> " . $row->timeEnd_n . ' น.';


                                            ?>
                                                <tr>
                                                    <td class="text-center"><?php echo $i_r++ ?></td>

                                                    <td class="text-center"><?php echo  $row->name_din ?></td>
                                                    <td class="text-center"><?php echo  $row->people_sum_res ?></td>

                                                    <td><?php echo $timeStart_re; ?></td>
                                                    <td>
                                                        <?php
                                                        if ($row->status_res == '1') {
                                                            echo '<span class="badge badge-warning">รอยืนยัน</span>';
                                                        } else {
                                                            echo '<span class="badge badge-success">ยืนยันแล้ว</span>';
                                                        }
                                                        ?>
                                                    </td>
                                                    <td>


                                                        <a href="javascript:reserveUpdate('<?php echo $row->id_res ?>','0')" class="badge badge-danger">ยกเลิก</a>
                                                    </td>

                                                </tr>
                                            <?php endforeach; ?>
                                        </tbody>
                                    </table>


                                </div>
                            </div>
                        </div>


                    </div>
                    <div id="reserve_hi" style="display: none;" class="col-lg-10 mb-5 mb-lg-0 order-0 order-lg-1">
                        <div class="post">
                            <div class="post-body">
                                <div class="entry-header">
                                    <h2 class="entry-title">
                                        <a href="javascript:void(0)">ประวัติการจอง</a>
                                    </h2>
                                </div><!-- header end -->

                                <div class="entry-content">

                                    <?php
                                    $thaiweek = array("วันอาทิตย์", "วันจันทร์", "วันอังคาร", "วันพุธ", "วันพฤหัส", "วันศุกร์", "วันเสาร์");
                                    $thaimonth = ["มกราคม", "กุมภาพันธ์", "มีนาคม", "เมษายน", "พฤษภาคม", "มิถุนายน", "กรกฎาคม", "สิงหาคม", "กันยายน", "ตุลาคม", "พฤศจิกายน", "ธันวาคม"];

                                    $sql_search = "SELECT *,
                                                            DATE_FORMAT(rt.date_res, '%d') as Dd ,
                                                            DATE_FORMAT(rt.date_res, '%c') as month ,
                                                            DATE_FORMAT(rt.date_res, '%Y') as year,
                                                            DATE_FORMAT(rt.time_res, '%H : %i ') as timeStart_n ,
                                                            DATE_FORMAT(rt.timeEnd_res, '%H : %i ') as timeEnd_n,

                                                            DATE_FORMAT(rt.create_timeout_res, '%d') as Dd_out ,
                                                            DATE_FORMAT(rt.create_timeout_res, '%c') as month_out ,
                                                            DATE_FORMAT(rt.create_timeout_res, '%Y') as year_out,
                                                            DATE_FORMAT(rt.create_timeout_res, '%H : %i ') as time_out

                                                    FROM `reservation` as rt
                                                            INNER JOIN diningtable as st ON st.id_din   = rt.id_din
                                                            INNER JOIN users as cm ON cm.id  = rt.id_user
                                                        WHERE (rt.status_res = 3) AND cm.id = '$USERID';";
                                    $i_r = 1;
                                    ?>
                                    <table id="" class="table  table-borderless table-neme " name="">
                                        <thead>
                                            <tr>
                                                <th class="text-center">ลำดับ</th>


                                                <th class="text-center">นั่งโต๊ะ</th>
                                                <th class="text-center">จำนวนคน</th>
                                                <th>วันที่จอง</th>
                                                <th>เวลาจอง</th>
                                                <th>เวลาออก</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php

                                            foreach (DB::query($sql_search, PDO::FETCH_OBJ) as $row) :
                                                // $date = 'วันที่ '.$row->Dd.' เดือน'.$thaimonth[$row->month-1].' พ.ศ.'.$row->year+543;
                                                $date = '' . $row->Dd . ' ' . $thaimonth[$row->month - 1] . ' ' . (543 + intval($row->year));;
                                                $timeStart_re =  $row->timeStart_n . ' น.';
                                                $timeEnd_re =  $row->timeEnd_n . ' น.';
                                                $time_out =  $row->time_out . ' น.';
                                            ?>
                                                <tr>
                                                    <td class="text-center"><?php echo $i_r++ ?></td>


                                                    <td class="text-center"><?php echo  $row->name_din ?></td>
                                                    <td class="text-center"><?php echo  $row->people_sum_res ?></td>
                                                    <td class=""><?php echo  $date ?></ะ>
                                                    <td><?php echo $timeStart_re; ?></td>
                                                    <td><?php echo $time_out; ?></td>
                                                </tr>
                                            <?php endforeach; ?>
                                        </tbody>
                                    </table>
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
