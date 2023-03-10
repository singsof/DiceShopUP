<?php
session_start();
unset($_SESSION['key']);
unset($_SESSION['data']);
session_unset();
if(session_destroy()){
    header('Location: /');
}


?>
