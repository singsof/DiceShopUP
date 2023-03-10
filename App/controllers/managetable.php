<?php
date_default_timezone_set('Asia/Bangkok');

require_once $_SERVER['DOCUMENT_ROOT'] . "/App/config/connectdb.php";
if ($_SERVER["REQUEST_METHOD"] != "POST") {
    return false;
}

session_start();
$result = new stdClass();
$key = $_POST["key"] !== "" ? $_POST["key"] : null;


// form-register
if ($key !== null && $key === 'form-addTables') {
    $rowChack = null;
    $values = $_POST['data'];
    $name = $values['name_din'];

    $sqlText = "INSERT INTO `diningtable` (`id_din`, `name_din`, `date_din`, `status_din`)
                                            VALUES (NULL, '$name', current_timestamp(), '1');)";
    if (DB::query($sqlText)) {
        $result->msg = 'success';
        $result->msg_text = 'เพิ่มโต๊ะสำเร็จ......';
    } else {
        $result->msg = 'error';
        $result->msg_text = 'เกิดข้อผิดพลาดเกี่ยวกับข้อมูล';
        return getOutputJson($result);
    }

}

if ($key !== null && $key === 'form-editTables') {
    $rowChack = null;
    $values = $_POST['data'];

    $id_din = $values['id_din'];
    $name_din = $values['name_din'];

    $sql_chack = "SELECT * FROM `diningtable` WHERE name_din = '$name_din'  AND id_din != '$id_din'";
    $rowChack = DB::query($sql_chack, PDO::FETCH_OBJ)->fetch(PDO::FETCH_OBJ);
    if ($rowChack != null) {
        $result->msg = "error";
        $result->msg_text = "ระบบตรวจพบข้อมูลเดิมในฐานข้อมูลกรุณาตรวจสอบ!!";
        return getOutputJson($result);
    }
    $sqlUpdareTable = "UPDATE `diningtable` SET `name_din` = '$name_din'
                         WHERE `diningtable`.`id_din` = $id_din;";

    $DB = DB::prepare($sqlUpdareTable);
    if ($DB->execute()) {
        $result->msg = 'success';
        $result->msg_text = 'แก้ไขอาหารสำเร็จ......';
        return getOutputJson($result);
    } else {
        $result->msg = 'error';
        $result->msg_text = 'เกิดข้อผิดพลาดเกี่ยวกับข้อมูล';
        return getOutputJson($result);
    }
}


// deleteTables

if ($key !== null && $key === 'deleteTables') {
    $rowChack = null;
    $id_din = $_POST['id_din'];


    $sqlUpdareProduct = "UPDATE `diningtable` SET `status_din` = '0' WHERE `diningtable`.`id_din` = $id_din;";
    $qu = DB::prepare($sqlUpdareProduct);
    if ($qu->execute()) {
        $result->msg = 'success';
        $result->msg_text = 'ลบโต๊ะสำเร็จ......';
        return getOutputJson($result);
    } else {
        $result->msg = 'error';
        $result->msg_text = 'เกิดข้อผิดพลาดเกี่ยวกับข้อมูล';
        return getOutputJson($result);
    }
}

return getOutputJson($result);
