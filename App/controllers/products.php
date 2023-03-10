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
if ($key !== null && $key === 'form-addProducts') {
    $rowChack = null;
    $values = $_POST['data'];
    $name = $values['name'];
    $img    = $values['img'];
    $price  = $values['price'];
    $details = $values['details'];

    $dataImage = new stdClass();
    $dataImage->path = $_SERVER['DOCUMENT_ROOT'] . "/assets/images/products/";
    $dataImage->base64_code = $img;
    $dataImage = uploadeImageBase64($dataImage);
    if ($dataImage->msg === 'success') {
        $img = $dataImage->nameImge;
        try {
            $sqlText = "INSERT INTO `products` (`id`, `name`, `img`, `price`, `details`, `status`)
            VALUES (NULL, '$name', '$img', '$price', '$details', '1');";
            if (DB::query($sqlText)) {
                $result->msg = 'success';
                $result->msg_text = 'เพิ่มอาหารสำเร็จ......';
            } else {
                $result->msg = 'error';
                $result->msg_text = 'เกิดข้อผิดพลาดเกี่ยวกับข้อมูล';
                return getOutputJson($result);
            }
        } catch (Exception $e) {
            $result->msg = 'error';
            $result->msg_text = 'เกิดข้อผิดพลาดเกี่ยวกับข้อมูล';

            return getOutputJson($result);
        }
    }


}

if ($key !== null && $key === 'form-editProducts') {
    $rowChack = null;
    $values = $_POST['data'];

    $id = $values['id'];
    $name = $values['name'];
    // $img    = $values['img'];
    $price  = $values['price'];
    $details = $values['details'];

    $dataImage = new stdClass();
    $dataImage->path = $_SERVER['DOCUMENT_ROOT'] . "/assets/images/products/";


    $resultPro = DB::query("SELECT * FROM `products` WHERE id ='$id'", PDO::FETCH_OBJ)->fetch(PDO::FETCH_OBJ);

    if (strlen($values['img']) > 80) { //base64_code
        // if (strlen($resultPro->img) < 40) {
        @unlink($dataImage->path  . $resultPro->img);
        // }

        $dataImage->base64_code = $values['img'];
        $img = uploadeImageBase64($dataImage)->nameImge;
    } else if ($values['img'] <= 80) {
        $img = $values['img'];
    } else {
        $img = $values['img'];
    }

    // if ($img->msg === 'error') {
    //     $result->msg = 'error';
    //     $result->msg_text = 'เกิดข้อผิดพลาดเกี่ยวกับข้อมูล';
    //     return getOutputJson($result);
    // }



    $sqlUpdareProduct = "UPDATE `products` SET `name` = '$name', `img` = '$img', `price` = '$price', `details` = '$details' WHERE `products`.`id` = $id;";
    $qu = DB::prepare($sqlUpdareProduct);
    if ($qu->execute()) {
        $result->msg = 'success';
        $result->msg_text = 'แก้ไขอาหารสำเร็จ......';
        return getOutputJson($result);
    } else {
        $result->msg = 'error';
        $result->msg_text = 'เกิดข้อผิดพลาดเกี่ยวกับข้อมูล';
        return getOutputJson($result);
    }
}


// deleteProducts

if ($key !== null && $key === 'deleteProducts') {
    $rowChack = null;
    $id = $_POST['productID'];



    $sqlUpdareProduct = "UPDATE `products` SET `status` = '0' WHERE `products`.`id` = $id;";
    $qu = DB::prepare($sqlUpdareProduct);
    if ($qu->execute()) {
        $result->msg = 'success';
        $result->msg_text = 'ลบอาหารสำเร็จ......';
    } else {
        $result->msg = 'error';
        $result->msg_text = 'เกิดข้อผิดพลาดเกี่ยวกับข้อมูล';
        return getOutputJson($result);
    }
}

return getOutputJson($result);
