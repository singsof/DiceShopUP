<?php
date_default_timezone_set('Asia/Bangkok');

require_once $_SERVER['DOCUMENT_ROOT'] . "/App/config/connectdb.php";
if ($_SERVER["REQUEST_METHOD"] != "POST") {
    return false;
}

session_start();
$result = new stdClass();
$key = $_POST["key"] !== "" ? $_POST["key"] : null;
$values = isset($_POST['data']) ? $_POST['data'] : null;

if ($key !== null && $key === 'form-reserve') {
    $row = null;


    $id_user = $values['id_user'];
    $id_din = $values['id_din'];
    $people_sum_res = $values['people_sum_res'];
    $date_res = $values['date_res'];
    $time_res = $values['time_res'];
    $timeEnd_res = $values['timeEnd_res'];


    $dateN = date('Y-m-d');
    $TimeNP = date('H:i', strtotime('+0 minutes'));
    $TimeEP = date('H:i', strtotime('+100 minutes'));

    if ($dateN <=  $date_res) {
        $sql_search = "SELECT * FROM reservation WHERE ((time_res BETWEEN '$time_res:00' and '$timeEnd_res') or (timeEnd_res BETWEEN '$time_res' and '$timeEnd_res:00')) AND id_din = '$id_din' AND date_res = '$date_res' AND status_res != '0'  ";
        $row = DB::query($sql_search, PDO::FETCH_OBJ)->fetch(PDO::FETCH_OBJ);
        if ($row == null) {
            // สามารถจองได้
            $sql_insert = "INSERT INTO `reservation` (`id_res`, `id_user`, `id_din`, `people_sum_res`, `status_res`, `create_time`, `date_res`, `time_res`,  `timeEnd_res`)
                                                    VALUES (NULL, '$id_user', '$id_din', '$people_sum_res', '1', current_timestamp(), '$date_res', '$time_res', '$timeEnd_res');";
            if (DB::query($sql_insert)) {


                try {
                    //code...
                    if (updateJSON()->msg === 'success') {

                        $result->msg = 'success';
                        $result->msg_text = 'จองโต๊ะสำเร็จ......';
                    }
                } catch (Exception $th) {
                    //throw $th;
                    $result->msg = 'error';
                    $result->msg_text = 'เกิดข้อผิดพลาดเกี่ยวกับข้อมูล';
                    return getOutputJson($result);
                }
            } else {
                $result->msg = 'error';
                $result->msg_text = 'เกิดข้อผิดพลาดเกี่ยวกับข้อมูล';
                return getOutputJson($result);
            }
        } else {
            // สามารถจองได้
            $result->msg = 'warning';
            $result->msg_text = 'วันเวลาที่ท่านเลือกมีคนจองแล้ว';
            return getOutputJson($result);
        }
    } else {
        $result->msg = 'warning';
        $result->msg_text = 'ไม่สามารถเลือกวันที่เป็น อดีตได้';
        return getOutputJson($result);
    }
}

// reserveUpdate
if ($key !== null && $key === 'reserveUpdate') {
    $sql_ = "";
    $id_res = $_POST['id'];
    $status = $_POST['status'];
    $msg_text = "";
    switch ($status) {
        case 0:
            # code...
            $msg_text = "ยกเลิกการจองสำเร็จ";
            break;
        case 2:
            # code...
            $sql_ = "UPDATE `reservation` SET `status_res` = '$status' WHERE `reservation`.`id_res` = '$id_res';";
            $msg_text = "ยืนยันการจองสำเร็จ";
            break;
        case 3:
            # code...
            $sql_ = "UPDATE `reservation` SET `status_res` = '$status' , `create_timeout_res` = current_timestamp() WHERE `reservation`.`id_res` = '$id_res';";
            $msg_text = "ยืนยันการชำระเงินสำเร็จ";

            break;
    }

    if ($_SESSION['key'] == 'em' || $_SESSION['key'] == 'ad') {
        if (DB::query($sql_)) {
            try {
                //code...
                if (updateJSON()->msg === 'success') {
                    $result->msg = 'success';
                    $result->msg_text = $msg_text;
                }
            } catch (Exception $th) {
                //throw $th;
                $result->msg = 'error';
                $result->msg_text = 'เกิดข้อผิดพลาดเกี่ยวกับข้อมูล';
                return getOutputJson($result);
            }
        } else {

            $result->msg = 'error';
            $result->msg_text = 'เกิดข้อผิดพลาดเกี่ยวกับข้อมูล';
            return getOutputJson($result);
        }
    } else if ($_SESSION['key'] === 'cm') {


        $date = date('Y-m-d');
        $TimeNP = date('H:i', strtotime('+0 minutes'));
        $TimeEP = date('H:i', strtotime('+100 minutes')); //ยกเลิกเก่อน 100 นาที

        // echo $newDate;

        // $sql_search = "SELECT * FROM `reservation_tb` WHERE
        // (((timeStart_re BETWEEN '$timeNow' AND '$TimeEP') OR (timeEnd_re BETWEEN '$TimeNP' AND '$TimeEP')) AND date_re  <=  '$date') AND id_re = '$id';";
        $sql_search = "SELECT * FROM `reservation` WHERE id_res = '$id_res'";
        $row_search = DB::query($sql_search, PDO::FETCH_OBJ)->fetch(PDO::FETCH_OBJ);

        if ($date <= $row_search->date_res) {
            if ($TimeEP < $row_search->time_res && $TimeEP < $row_search->timeEnd_res) {

                if (DB::query("UPDATE `reservation` SET `status_res` = '$status' WHERE `reservation`.`id_res` = '$id_res';")) {
                    try {
                        if (updateJSON()->msg === 'success') {
                            $result->msg = 'success';
                            $result->msg_text = $msg_text;
                        }
                    } catch (Exception $th) {
                        //throw $th;
                        $result->msg = 'error';
                        $result->msg_text = 'เกิดข้อผิดพลาดเกี่ยวกับข้อมูล';
                        return getOutputJson($result);
                    }
                } else {

                    $result->msg = 'error';
                    $result->msg_text = 'เกิดข้อผิดพลาดเกี่ยวกับข้อมูล';
                    return getOutputJson($result);
                }
            } else {
                $result->msg = 'error';
                $result->msg_text = 'ไม่สามารถยกเลิกได้เนื่องจากเกินเวลาที่กำหนด';
                return getOutputJson($result);
            }
        } else {
            $result->msg = 'error';
            $result->msg_text = 'ไม่สามารถยกเลิกได้เนื่องจากเกินเวลาที่กำหนด';
            return getOutputJson($result);
        }
    }
}

return getOutputJson($result);
