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
    <title>จองโต๊ะ  - DICE SHOP</title>

    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content="Construction Html5 Template">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=5.0">



    <?php include_once('../inc/stylesheet.php') ?>

    <style>
        #script-warning {
            display: none;
            background: #eee;
            border-bottom: 1px solid #ddd;
            padding: 0 10px;
            line-height: 40px;
            text-align: center;
            font-weight: bold;
            font-size: 12px;
            color: red;
        }

        #loading {
            display: none;
            position: absolute;
            top: 10px;
            right: 10px;
        }

        #calendar {
            max-width: 1100px;
            margin: 40px auto;
            padding: 0 10px;
        }
    </style>


</head>

<body>
    <div class="body-inner">

        <?php include_once("./header.php") ?>


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


        <div class="modal fade" id="reserve_table" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <form id="form-reserve" action="javascript:void(0)" method="POST">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLongTitle">จองโต๊ะใหม่</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <input type="hidden" name="id_user" value="<?php echo $USER->id; ?>" required>
                            <div class="form-group">
                                <label class="form-control-label">เลือกโต๊ะที่จะนั่ง</label>
                                <select class="form-control" name="id_din" required>
                                    <option value="">กรุณาเลือกโต๊ะ</option>
                                    <?php foreach (DB::query("SELECT * FROM `diningtable` WHERE status_din !='0' ORDER BY name_din ASC", PDO::FETCH_OBJ) as $row) : ?>
                                        <option value="<?php echo $row->id_din; ?>"><?php echo $row->name_din ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label class="form-control-label">จำนวนคนทั้งหมด</label>
                                <select class="form-control" name="people_sum_res" required>
                                    <option value="">กรุณาจำนวนคน</option>
                                    <?php for ($i = 1; $i <= 9; $i++) : ?>
                                        <option value="<?php echo $i ?>"><?php echo $i; ?> คน</option>
                                    <?php endfor; ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label class="form-control-label">เลือกวันที่จอง</label>
                                <input id="dataStarts" type="date" name="date_res" value="" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label class="form-control-label">เลือกเวลาที่เข้าร้าน</label>
                                <input id="timeStart" type="time" name="time_res" value="" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <!-- <label class="form-control-label">เวลาที่ร้านกำหนด (ประมาณ) </label> -->
                                <input id="timeEnd" disabled type="hidden" name="timeEnd_res" value="18:00" class="form-control" required>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">ปิด</button>
                            <button type="submit" class="btn btn-primary">จองโต๊ะ</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>








        <?php include_once('../inc/script.php') ?>

    </div><!-- Body inner end -->
</body>

</html>
