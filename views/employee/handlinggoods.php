<?php
session_start();
if ((!isset($_SESSION["key"]) || empty($_SESSION["key"])) || $_SESSION["key"] != 'em') {
    echo "<script>window.location.assign('/App/controllers/authLogout.php')</script>";

}
?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <title>จัดการอาหาร - DICE SHOP</title>

    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content="Construction Html5 Template">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=5.0">



    <?php include_once('../inc/stylesheet.php') ?>


</head>

<body>
    <div class="body-inner">

        <?php include_once("./header.php") ?>


        <section id="ts-team" class="ts-team">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <h3 class="section-sub-title">จัดการอาหาร</h3>
                    </div>
                </div>

                <div class="row">

                    <div class="col-lg-12 col-md-12 ">
                        <div class="ts-service-box">

                            <table id="table_reserve" class="table  table-borderless table-neme">
                                <thead>
                                    <tr>
                                        <th class="text-center">ลำดับ</th>
                                        <th class="text-center">ชื่ออาหาร</th>
                                        <th class="text-center">ราคา</th>
                                        <th class="text-center">ภาพอาหาร</th>
                                        <th><a href="#" class="btn btn-sm  badge-primary" data-toggle="modal" data-target="#addProducts">เพิ่ม</a></th>
                                    </tr>
                                </thead>
                                <tbody>

                                    <?php
                                    $i = 1;
                                    $productList = DB::query("SELECT * FROM `products` WHERE status != 0 ", PDO::FETCH_OBJ);
                                    foreach ($productList as $productList) :
                                    ?>
                                        <tr>
                                            <td class="text-center"><?php echo $i++ ?></td>
                                            <td class="text-center"><?php echo $productList->name ?></td>
                                            <td class="text-center"><?php echo $productList->price ?>฿</td>
                                            <!-- <td class="text-center">รายละเอียด</td> -->
                                            <td class="text-center"><img width="50px" height="50px" src="/assets/images/products/<?php echo  $productList->img ?>" alt=""></td>
                                            <td>
                                                <a href="javascript:editProducts(<?php echo $productList->id ?>)" class='badge badge-success'>แก้ไข</a>
                                                <a href="javascript:deleteProducts(<?php echo $productList->id ?>)" class="badge badge-danger">ลบ</a>
                                            </td>

                                        </tr>

                                    <?php endforeach; ?>

                                </tbody>
                            </table>
                            <script>

                            </script>

                        </div>
                        <!-- Service1 end -->
                    </div>

                </div><!--/ Content row end -->
            </div><!--/ Container end -->
        </section><!--/ Team end -->

        <div class="modal fade" id="addProducts" tabindex="-1" role="dialog" aria-labelledby="" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <form id="form-addProducts" action="javascript:void(0)" method="post" enctype="multipart/form-data">
                        <div class="modal-header">
                            <h5 class="modal-title" id="">เพิ่มอาหาร</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">

                            <div class="form-group">
                                <div class="row">
                                    <div class="col">
                                        <input id="img" type="hidden" name="img" value="" required>
                                        <label for="">กรุณาเลือกภาพอาหาร</label>
                                        <input id="input_image" type="file" accept="image/*" class="form-control-file" required>
                                    </div>
                                    <div class="col">
                                        <label>รูปที่เลือก</label>
                                        <img id="img_show" src="https://img.wongnai.com/p/1968x0/2020/05/26/33bf230ade804611809baacd4c35294d.jpg" width="100%" height="180px">
                                    </div>
                                </div>

                            </div>
                            <div class="form-group">
                                <label for="">กรุณากรอกชื่ออาหาร</label>
                                <input type="text" name="name" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label for="">ตั้งราคาอาหาร</label>
                                <input type="text" name="price" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label for="">รายละเอียดอาหาร</label>
                                <textarea rows="4" name="details" class="form-control" cols="" required></textarea>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">ยกเลิก</button>
                            <button type="submit" class="btn btn-primary">บันทึก</button>
                        </div>
                    </form>

                </div>
            </div>
        </div>


        <div class="modal fade" id="editProducts" tabindex="-1" role="dialog" aria-labelledby="" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content editProducts-model">
                </div>
            </div>
        </div>




        <?php include_once('../inc/script.php') ?>

    </div><!-- Body inner end -->
</body>

</html>
