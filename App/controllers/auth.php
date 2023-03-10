<?php
date_default_timezone_set('Asia/Bangkok');

require_once $_SERVER['DOCUMENT_ROOT'] . "/App/config/connectdb.php";


session_start();
$result = new stdClass();
$key = $_POST["key"] !== "" ? $_POST["key"] : null;
if ($key !== null && $key === 'form-login') {
    $rowData = null;
    $values = $_POST['data'];

    $username = $values['username'];
    $pass = $values['pass'];

    $sql_login = "SELECT * FROM `users` WHERE username = '$username' AND pass ='$pass'";
    $rowData = DB::query($sql_login, PDO::FETCH_OBJ)->fetch(PDO::FETCH_OBJ);

    // print_r($rowData);
    if ($rowData != null) {
        if ($username == $rowData->username && $pass == $rowData->pass) {

            switch ($rowData->rold) {
                case '2':
                    $_SESSION['key'] = 'em';

                    $result->msg = "success-em";
                    $result->msg_text = "เข้าสู่ระบบสำเร็จ";
                    break;
                case '0':
                    $_SESSION['key'] = 'em';
                    $result->msg = "success-em";
                    $result->msg_text = "เข้าสู่ระบบสำเร็จ";
                    break;
                default:
                    $_SESSION['key'] = 'cm';

                    $result->msg = "success-cm";
                    $result->msg_text = "เข้าสู่ระบบสำเร็จ";
                    break;
            }

            $_SESSION['data'] = $rowData;
        } else {
            $result->msg = "error";
            $result->msg_text = "กรุณาตรวจข้อมูลให้ถูกต้อง";
            return getOutputJson($result);
        }
    } else {
        $result->msg = "error";
        $result->msg_text = "กรุณาตรวจข้อมูลให้ถูกต้อง";
        return getOutputJson($result);
    }
}
// form-register
if ($key !== null && $key === 'form-register') {
    $rowChack = null;
    $values = $_POST['data'];

    $codeID = $values['codeID'];
    $name = $values['name'];

    $phone = $values['phone'];
    $email = $values['email'];
    $username = $values['username'];
    $pass = $values['pass'];

    $sql_chack = "SELECT * FROM `users` WHERE codeID = '$codeID' OR username ='$username' OR phone = '$phone' ";
    $rowChack = DB::query($sql_chack, PDO::FETCH_OBJ)->fetch(PDO::FETCH_OBJ);
    if ($rowChack != null) {
        $result->msg = "error";
        $result->msg_text = "ระบบตรวจพบข้อมูลเดิมในฐานข้อมูลกรุณาตรวจสอบ!!";
        return getOutputJson($result);
    }

    $sql_register = "INSERT INTO `users` (`id`, `codeID`, `name`, `phone`, `email`, `username`, `pass`, `rold`, `status`, `dateTime`)
                        VALUES (NULL, '$codeID', '$name', '$phone', '$email', '$username', '$pass', '1', '1', current_timestamp());";
    if (DB::query($sql_register)) {
        $result->msg = "success";
        $result->msg_text = "สมัครสมาชิกสำเร็จ";
    } else {
        $result->msg = "error";
        $result->msg_text = "ไม่สามารถสมัครสมาชิกได้!!";
        return getOutputJson($result);
    }
}


// form-edit-account
if ($key !== null && $key === 'form-edit-account') {
    $rowChack = null;
    $values = $_POST['data'];

    $id = $values['id'];
    $codeID = $values['codeID'];
    $name = $values['name'];
    $phone = $values['phone'];
    $email = $values['email'];
    $username = $values['username'];
    $pass = $values['pass'];


    $sql_chack = "SELECT * FROM `users` WHERE codeID = '$codeID'  AND id != '$id'";
    $rowChack = DB::query($sql_chack, PDO::FETCH_OBJ)->fetch(PDO::FETCH_OBJ);
    if ($rowChack != null) {
        $result->msg = "error";
        $result->msg_text = "ระบบตรวจพบข้อมูลเดิมในฐานข้อมูลกรุณาตรวจสอบ!!";
        return getOutputJson($result);
    }

    $sql_update = "UPDATE `users` SET `codeID` = '$codeID',
                                        `name` = '$name',
                                        `phone` = '$phone',
                                        `email` = '$email',
                                        `username` = '$username',
                                        `pass` = '$pass'
                                        WHERE `users`.`id` = $id;";


    $updateDB = DB::prepare($sql_update);
    if ($updateDB->execute()) {
        $result->msg = 'success';
        $result->msg_text = 'แก้ไขข้อมูลสำเร็จ......';
        return getOutputJson($result);
    } else {
        $result->msg = 'error';
        $result->msg_text = 'เกิดข้อผิดพลาดเกี่ยวกับข้อมูล';
        return getOutputJson($result);
    }
}

return getOutputJson($result);
