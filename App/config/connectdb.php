<?php


// define('__ROOT__1', dirname(dirname(__FILE__)));
// require_once(__ROOT__1.'./config.inc.php');
// require_once('./config.inc.php');
include_once $_SERVER['DOCUMENT_ROOT'] . "/App/config/config.inc.php";
class DB
{
    private static $link = null;
    private static function getLink()
    {
        if (self::$link) {
            return self::$link;
        }
        self::$link = new PDO("mysql:host=" . DB_HOST . ";dbname=" . DB_NAME . ";charset=utf8", DB_USERNAME, DB_PASSWORD);
        self::$link->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return self::$link;
    }

    public static function __callStatic($name, $args)
    {
        $callback = array(self::getLink(), $name);
        return call_user_func_array($callback, $args);
    }



    public static function Con_delete()
    {
        self::getLink() == null;
    }
}


function uploadeImageBase64($data): stdClass
{
    $result = new stdClass();
    $result->nameImge = generateRandomStringIM(2) . date("Y_m_d_H_i_s") . generateRandomStringIM(3) . generateRandomStringIM(3) . ".png";
    try {

        if (file_put_contents($data->path . $result->nameImge, base64_decode($data->base64_code))) {
            $result->msg =  "success";
            $result->msg_text = 'บันทึกรูปภาพสำเร็จ';
        } else {
            $result->msg =  "error";
            $result->msg_text = 'กรุณาลองใหม่อีกครั้ง';
        }
    } catch (Exception $e) {
        $result->msg =  "error";
        $result->msg_text = $e->getMessage();
    }

    return $result;
}


function getOutputJson($result)
{
    echo json_encode($result);
}


function generateRandomString($length = 10)
{
    $characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}
function generateRandomStringIM($length = 10)
{
    $characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdfghijklmnopqrstuvwxyz0123456789';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}


function updateJSON(): stdClass
{
    $result = new stdClass();

    $sql_search = "SELECT * FROM `reservation`  as rt  INNER JOIN diningtable as st ON st.id_din = rt.id_din WHERE rt.status_res = '1' or rt.status_res = '2'";
    $resultArray = array();
    $json_txt = "";

    if ($show_tebelig = DB::query($sql_search, PDO::FETCH_OBJ)) {
        foreach ($show_tebelig  as $row) {
            $title = 'โต๊ะ ' . $row->name_din;

            $dateStart = $row->date_res;
            $timeStart = $row->time_res;
            $timeEnd = $row->timeEnd_res;

            $new_row = [
                "title" => $title,
                "start" => $dateStart . 'T' . $timeStart . '+07:00',
                "end" => $dateStart . 'T' . $timeEnd . '+07:00',
            ];

            array_push($resultArray, $new_row);
        }
        $json_txt =  json_encode($resultArray);
    } else {
        $json_txt =  json_encode($resultArray);
    }

    $Afile = "events.json";
    $myfile = fopen($_SERVER['DOCUMENT_ROOT'] . "/assets/json/" . $Afile, "w") or die("error");
    if (fwrite($myfile, $json_txt)) {
        $result->msg = 'success';
        $result->msg_text = 'อัพเดตข้อมูลสำเร็จ';
    }
    fclose($myfile);

    return $result;
}
