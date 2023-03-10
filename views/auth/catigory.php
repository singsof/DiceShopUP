<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <title>อาหารทั้งหมด - DICE SHOP</title>

    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content="Construction Html5 Template">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=5.0">



    <?php include_once('../inc/stylesheet.php') ?>

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
                                        <li class="breadcrumb-item active" aria-current="page">อาหารทั้งหมด</li>
                                    </ol>
                                </nav>
                            </div>
                        </div><!-- Col end -->
                    </div><!-- Row end -->
                </div><!-- Container end -->
            </div><!-- Banner text end -->
        </div><!-- Banner area end -->

        <section id="main-container" class="main-container pb-2">
            <div class="container">
                <div class="row text-left">
                    <div class="col-lg-12">
                        <h3 class="section-sub-title">รายการอาหารทั้งหมด</h3>
                    </div>
                </div>
                <div class="row pb-3">
                    <div class="col pr-5">

                    </div>

                    <div class="col pl-5">

                        <div class="input-group input-group-sm  ">
                            <input id="search-name" type="text" class="form-control" value="<?php echo isset($_GET['search']) ? $_GET['search'] : "" ?>" placeholder="ค้นหาจากชื่ออาหาร" aria-label="ค้นหาจากชื่ออาหาร" aria-describedby="button-addon2">
                            <div class="input-group-append">
                                <button class="btn btn-sm btn-outline-primary" onclick="search_name('search-name')" type="button" id="button-addon2">ค้นหา</button>
                            </div>
                        </div>

                    </div>
                </div>
                <div class="row">
                    <?php
                    $productList = null;
                    $Getsearch = isset($_GET['search']) && $_GET['search'] != '' ? $_GET['search'] : "%%";
                    $page = isset($_GET['page']) ? $_GET['page'] : 1;
                    $limit = 10;
                    $start = ($page - 1) * $limit; // 2-1 *10
                    $i = 1;
                    $total =  DB::query("SELECT * FROM `products` WHERE name LIKE '$Getsearch' AND status != 0 ")->fetchColumn(); //sum results
                    $total_pages = ceil($total / $limit);
                    $sqlPro = "SELECT * FROM `products` WHERE name LIKE '$Getsearch' AND status != 0 ORDER BY `products`.`id` ASC LIMIT $start, $limit ";
                    $stmt = DB::query($sqlPro, PDO::FETCH_OBJ);
                    $productList = $stmt;

                    foreach ($productList as $productList) :
                    ?>
                        <div class="col-lg-4 col-md-6 mb-5">

                            <div class="ts-service-box">
                                <div class="ts-service-image-wrapper">
                                    <img loading="lazy" class="w-100" src="/assets/images/products/<?php echo  $productList->img ?>" alt="">
                                </div>

                                <div class="ts-service-info" style="margin-right: 30px;">
                                    <div class=" row">
                                        <div class="col-md-6 ">
                                            <h3 class="service-box-title"><a href="./catigory-single.php?id=<?php echo  $productList->id ?>"><?php echo $productList->name ?></a></h3>

                                        </div>
                                        <div class="col-md-6 text-right">
                                            <h3 class="service-box-title"><?php echo $productList->price ?> บาท</h3>
                                        </div>
                                    </div>
                                    <p><?php echo $productList->details ?></p>
                                    <a class="learn-more d-inline-block" href="./catigory-single.php?id=<?php echo  $productList->id ?>" aria-label="service-details"><i class="fa fa-caret-right"></i>เพิ่มเติม</a>

                                </div>

                            </div><!-- Service1 end -->
                        </div><!-- Col 1 end -->

                    <?php endforeach; ?>

                    <?php if ($total == '') : ?>

                        <h3>ไม่พบข้อมูลอาหาร</h3>

                    <?php endif; ?>

                </div><!-- Main row end -->

                <div class="row">
                    <nav class="paging" aria-label="Page navigation example">
                        <ul class="pagination">
                            <?php if ($page > 1) : ?>
                                <li class="page-item"><a class="page-link" href="./catigory.php?page=<?php echo $page - 1 ?>"><i class="fas fa-angle-double-left"></i></a></li>
                            <?php endif; ?>


                            <?php for ($i = 1; $i <= $total_pages; $i++) :
                                //if its active page add active variable
                                if ($page == $i) {
                                    $class = 'active';
                                } else {
                                    $class = '';
                                }
                            ?>
                                <li class="page-item <?php echo $class; ?>"><a class="page-link" href="./catigory.php?page=<?php echo $i ?>"><?php echo $i ?></a></li>
                            <?php endfor; ?>
                            <?php
                            if ($page <= $total_pages) :
                            ?>
                                <li class="page-item"><a class="page-link" href="./catigory.php?page=<?php echo $page + 1 ?>"><i class="fas fa-angle-double-right"></i></a></li>
                            <?php endif; ?>

                        </ul>

                    </nav>

                </div>
            </div><!-- Conatiner end -->
        </section><!-- Main container end -->






        <?php include_once('../inc/script.php') ?>

    </div><!-- Body inner end -->
</body>

</html>
