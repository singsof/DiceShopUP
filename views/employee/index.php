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
    <title>หน้าหลัก - DICE SHOP</title>

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
                        <h3 class="section-sub-title">จัดการคิวลูกค้า</h3>
                    </div>
                </div>

                <div class="row">

                    <div class="col-lg-12 col-md-12 ">
                        <div class="ts-service-box">
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
                                                        WHERE (rt.status_res != 0 AND rt.status_res != 3);";
                            $i_r = 1;
                            ?>
                            <table id="table_reserve" class="table  table-borderless table-neme ">
                                <thead>
                                    <tr>
                                        <th class="text-center">ลำดับ</th>
                                        <th class="text-center">ชื่อลูกค้า</th>
                                        <th class="text-center">โต๊ะ</th>
                                        <th class="text-center">จำนวนคน</th>
                                        <th class="text-center">เบอร์โทรศัพท์</th>
                                        <th>เวลาจองเข้าร้าน</th>
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
                                            <td class="text-center"><?php echo  $row->name ?></td>
                                            <td class="text-center"><?php echo  $row->name_din ?></td>
                                            <td class="text-center"><?php echo  $row->people_sum_res ?></td>
                                            <td class="text-center"><?php echo  $row->phone ?></td>
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

                                                <?php
                                                if ($row->status_res == '1') {
                                                    echo "<a href=\"javascript:reserveUpdate('$row->id_res','2')\" class='badge badge-success'>ยืนยัน</a>";
                                                } else {
                                                    echo "<a href=\"javascript:reserveUpdate('$row->id_res','3')\" class='badge badge-primary'>สำเร็จ</a>";
                                                }
                                                ?>
                                                &nbsp;&nbsp;
                                                <a href="javascript:reserveUpdate('<?php echo $row->id_res ?>','0')" class="badge badge-danger">ยกเลิก</a>
                                            </td>

                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>

                        </div>
                        <!-- Service1 end -->
                    </div>

                </div><!--/ Content row end -->
            </div><!--/ Container end -->
        </section><!--/ Team end -->


        <section id="ts-features" class="ts-features pb-2 ">
            <div class="container">
                <div class="row text-left">
                    <div class="col-lg-12">
                        <h3 class="section-sub-title">ตารางจองคิวลูกค้า</h3>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12 col-md-12 ">
                        <div class="ts-service-box">
                            <div id='script-warning'>
                                <code>php/get-events.php</code> must be running.
                            </div>

                            <div id='loading'>loading...</div>

                            <div id='calendar'></div>
                        </div>
                        <!-- Service1 end -->
                    </div>
                    <!-- Col 1 end -->


                </div>
                <!-- Content row end -->
            </div>
            <!-- Container end -->
        </section>











        <?php include_once('../inc/script.php') ?>

    </div><!-- Body inner end -->
</body>

</html>
