<?php
session_start();
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

        <div class="banner-carousel banner-carousel-2 mb-0">
            <div class="banner-carousel-item" style="background-image:url(/assets/images/banner/banner1.jpg)">
                <div class="container">
                    <div class="box-slider-content">
                        <div class="box-slider-text">
                            <h2 class="box-slide-title">ยินดีตอนรับ</h2>
                            <h3 class="box-slide-sub-title">ร้านลูกเต๋ายโสธร</h3>
                            <p class="box-slide-description">140, ถนนแจ้งสนิท, ตำบลในเมือง อำเภอเมืองยโสธร จังหวัดยโสธร, 35000</p>
                            <p>
                                <a href="javascript:alert('กรุณาล็อกอินเข้าสู่ระบบก่อน!!')" class="slider btn btn-primary">จองโต๊ะร้านอาหาร</a>
                            </p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="banner-carousel-item" style="background-image:url(/assets/images/banner/banner2.jpg)">
                <div class="slider-content text-left">
                    <div class="container">
                        <div class="box-slider-content">
                            <div class="box-slider-text">
                                <h2 class="box-slide-title">ยินดีตอนรับ</h2>
                                <h3 class="box-slide-sub-title">ร้านลูกเต๋ายโสธร</h3>
                                <p class="box-slide-description">140, ถนนแจ้งสนิท, ตำบลในเมือง อำเภอเมืองยโสธร จังหวัดยโสธร, 35000</p>
                                <p>

                                    <a href="javascript:alert('กรุณาล็อกอินเข้าสู่ระบบก่อน!!')" class="slider btn btn-primary">จองโต๊ะร้านอาหาร</a>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <section id="ts-team" class="ts-team">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <h3 class="section-sub-title">อาหารบางส่วนภายในร้าน</h3>
                    </div>
                </div>

                <div class="row">
                    <div class="col-lg-12">
                        <div id="team-slide" class="team-slide">
                            <?php
                            $i = 1;
                            $productList = DB::query("SELECT * FROM `products` WHERE status != 0 ORDER BY `products`.`id` ASC LIMIT 10 ", PDO::FETCH_OBJ);
                            foreach ($productList as $productList) :
                            ?>
                                <div class="item">
                                    <div class="ts-team-wrapper">
                                        <div class="team-img-wrapper">
                                            <img loading="lazy" class="w-100" src="/assets/images/products/<?php echo  $productList->img ?>" alt="team-img">
                                        </div>
                                        <div class="ts-team-content">
                                            <h3 class="ts-name"><?php echo $productList->name ?></h3>
                                            <p class="ts-designation"><?php echo $productList->price ?> บาท</p>
                                            <!-- <p class="ts-description">Nats Stenman began his career in construction with boots on the ground</p> -->

                                        </div>
                                    </div><!--/ Team wrapper end -->
                                </div><!-- Team 1 end -->
                            <?php endforeach; ?>
                        </div><!-- Team slide end -->
                    </div>
                </div><!--/ Content row end -->
            </div><!--/ Container end -->
        </section><!--/ Team end -->


        <!-- <section class=""> -->
        <section id="ts-team" class="ts-team no-padding">
            <div class="container">

                <div class="row text-right">
                    <div class="col-lg-12">
                        <h3 class="section-sub-title">ภาพสินค้าตัวอย่าง</h3>
                    </div>
                </div>
                <div class="row shuffle-wrapper">
                    <div class="col-1 shuffle-sizer"></div>

                    <?php
                    $i = 1;
                    $productList = DB::query("SELECT * FROM `products` WHERE status != 0 ORDER BY `products`.`id` DESC LIMIT 6", PDO::FETCH_OBJ);
                    foreach ($productList as $productList) :
                    ?>
                        <div class="col-lg-4 col-md-6 shuffle-item" data-groups="[&quot;government&quot;,&quot;healthcare&quot;]">
                            <div class="project-img-container">
                                <a class="gallery-popup" href="/assets/images/products/<?php echo  $productList->img ?>">
                                    <img class="img-fluid" src="/assets/images/products/<?php echo  $productList->img ?>" alt="">
                                    <span class="gallery-icon"><i class="fa fa-plus"></i></span>
                                </a>
                                <div class="project-item-info">
                                    <div class="project-item-info-content">
                                        <h3 class="project-item-title">
                                            <a href="javascript:void(0)"><?php echo $productList->name ?></a>
                                        </h3>
                                        <p class="project-cat"><?php echo $productList->price ?> บาท</p>
                                    </div>
                                </div>
                            </div>
                        </div><!-- shuffle item 1 end -->
                    <?php endforeach; ?>
                </div><!-- shuffle end -->
            </div>
        </section>

        <section class="subscribe no-padding ">
            <div class="container">
                <div class="row">
                    <div class="col-md-4">
                        <div class="subscribe-call-to-acton">
                            <h3>ติดสอบถามหรือจอง</h3>
                            <h4>(+66) 847-291-4353</h4>
                        </div>
                    </div>
                    <!-- Col end -->

                    <div class="col-md-8">
                        <div class="ts-newsletter row align-items-center">
                            <div class="col-md-5 newsletter-introtext">
                                <!-- <h4 class="text-white mb-0">ค้นหาอาหารภายในร้าน</h4>
                                <p class="text-white">กรุณากรอกซื้ออาหาร</p> -->
                            </div>

                            <div class="col-md-7 newsletter-form">
                                <!-- <form action="#" method="post">
                                    <div class="form-group">
                                        <label for="newsletter-email" class="content-hidden">Newsletter Email</label>
                                        <input type="email" name="email" id="newsletter-email" class="form-control form-control-lg" placeholder="กรอกชื่ออาหาร" autocomplete="off">
                                    </div>
                                </form> -->
                            </div>
                        </div>
                        <!-- Newsletter end -->
                    </div>
                    <!-- Col end -->

                </div>
                <!-- Content row end -->
            </div>
            <!--/ Container end -->
        </section>

        <!--/ Content row end -->

        <section id="ts-features" class="ts-features pb-2 ">
            <div class="container">
                <div class="row text-left">
                    <div class="col-lg-12">
                        <h3 class="section-sub-title">ตารางจอง</h3>
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
