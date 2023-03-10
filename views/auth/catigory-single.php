<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <title>รายการอาหาร  - DICE SHOP</title>

    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content="Construction Html5 Template">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=5.0">



    <?php include_once('../inc/stylesheet.php') ?>

    <?php $id_pro = isset($_GET["id"]) ? $_GET["id"] : null;


    $row = DB::Query("SELECT * FROM `products` WHERE id=$id_pro")->fetch(PDO::FETCH_OBJ);

    ?>


</head>



<body>
    <div class="body-inner">

        <?php include_once("./header.php") ?>
        <div id="banner-area" class="banner-area" style="background-image:url(/assets/images/banner/banner1.jpg)">
            <div class="banner-text">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="banner-heading">
                                <h1 class="banner-title">รายการอาหาร</h1>
                                <nav aria-label="breadcrumb">
                                    <ol class="breadcrumb justify-content-center">
                                        <li class="breadcrumb-item"><a href="#">หน้าหลัก</a></li>
                                        <li class="breadcrumb-item"><a href="#">อาหาร</a></li>
                                        <li class="breadcrumb-item active" aria-current="page"><?php echo  $row->name ?></li>
                                    </ol>
                                </nav>
                            </div>
                        </div><!-- Col end -->
                    </div><!-- Row end -->
                </div><!-- Container end -->
            </div><!-- Banner text end -->
        </div><!-- Banner area end -->

        <section id="main-container" class="main-container">
            <div class="container">

                <div class="row">
                    <div class="col-lg-8">
                        <div id="page-slider" class="page-slider small-bg">
                            <div class="item">
                                <img loading="lazy" class="img-fluid" src="/assets/images/products/<?php echo  $row->img ?>" alt="project-image" />
                            </div>


                        </div><!-- Page slider end -->
                    </div><!-- Slider col end -->

                    <div class="col-lg-4 mt-5 mt-lg-0">

                        <h3 class="column-title mrt-0"><?php echo  $row->name ?></h3>
                        <p><?php echo  $row->details ?></p>

                        <ul class="project-info list-unstyled">

                            <li>
                                <p class="project-link">
                                    <a class="btn btn-primary" href="javascript:void(0)"><?php echo $row->price ?> บาท</a>
                                </p>
                            </li>
                        </ul>

                    </div><!-- Content col end -->

                </div><!-- Row end -->

            </div><!-- Conatiner end -->
        </section><!-- Main container end -->



        <?php include_once('../inc/script.php') ?>

    </div><!-- Body inner end -->
</body>

</html>
