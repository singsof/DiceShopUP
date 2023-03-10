<?php
define("_ROOT_URL_", $_SERVER['DOCUMENT_ROOT']);
require_once _ROOT_URL_. "/App/config/connectdb.php";
// session_start();

$USERID = isset($_SESSION["data"]) ? $_SESSION["data"]->id : null;

$USER = DB::query("SELECT * FROM `users` WHERE id= '$USERID'",PDO::FETCH_OBJ)->fetch(PDO::FETCH_OBJ);


?>

<link rel="icon" type="image/png" href="/assets/images/favicon.png">

<link rel="stylesheet" href="/assets/plugins/fontawesome/css/all.min.css">
<!-- Animation -->
<link rel="stylesheet" href="/assets/plugins/animate-css/animate.css">
<!-- slick Carousel -->
<link rel="stylesheet" href="/assets/plugins/slick/slick.css">
<link rel="stylesheet" href="/assets/plugins/slick/slick-theme.css">
<!-- Colorbox -->
<link rel="stylesheet" href="/assets/plugins/colorbox/colorbox.css">
<!-- Template styles-->
<!-- <link rel="stylesheet" href="/assets/plugins/bootstrap/bootstrap.min.css"> -->
<link rel="stylesheet" href="/assets/css/style.css">

<script src="/assets/plugins/jQuery/jquery.min.js"></script>
<!-- <script src="/assets/js/jquery.simplePagination.js"></script> -->
<!-- <script src="/assets/css/simplePagination.css"></script> -->
<link href='/assets/plugins/fullcalendar/main.css' rel='stylesheet' />
<script src='/assets/plugins/fullcalendar/main.js'></script>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="/assets/js/function.js"></script>



<link rel="stylesheet" href="/assets/plugins/dataTable/datatables.min.css">
<script type="text/javascript" charset="utf8" src="/assets/plugins/dataTable/pdfmake.min.js"></script>
<script type="text/javascript" charset="utf8" src="/assets/plugins/dataTable/vfs_fonts.js"></script>
<script type="text/javascript" charset="utf8" src="/assets/plugins/dataTable/datatables.min.js"></script>


<!-- <script src="/assets/js/sweetalert2@11.js"></script> -->
<!-- <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script> -->
