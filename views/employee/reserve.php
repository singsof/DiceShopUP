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
    <title>จัดการจองคิว - DICE SHOP</title>

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
                        <h3 class="section-sub-title">ประวัติจองคิว</h3>
                    </div>
                </div>

                <div class="row">

                    <div class="col-lg-12 col-md-12 ">
                        <div class="ts-service-box">
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
                                                        WHERE (rt.status_res = 3);";
                            $i_r = 1;
                            ?>
                            <table id="" class="table  table-borderless table-neme " name="">
                                <thead>
                                    <tr>
                                        <th class="text-center">ลำดับ</th>
                                        <th class="text-center">ชื่อ - นามสกุล</th>
                                        <th class="text-center">เบอร์</th>
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
                                            <td class="text-center"><?php echo  $row->name ?></td>
                                            <td class="text-center"><?php echo  $row->phone ?></td>
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
        </section>



        <?php include_once('../inc/script.php') ?>

    </div><!-- Body inner end -->
</body>

</html>
