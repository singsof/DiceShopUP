<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <title>เข้าสู่ระบบ - DICE SHOP</title>

    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content="Construction Html5 Template">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=5.0">


    <?php include_once('../inc/stylesheet.php') ?>


</head>

<body>
    <div class="body-inner">

        <?php include_once("./header.php") ?>


        <section id="main-container" class="main-container pb-0">
            <div class="container">
            </div>
        </section>


        <section id="main-container" class="main-container pb-0">
            <div class="container">
            </div>
        </section><!-- Main container end -->

        <style>
            .divider:after,
            .divider:before {
                content: "";
                flex: 1;
                height: 1px;
                background: #eee;
            }

            .h-custom {
                height: calc(100% - 73px);
            }

            @media (max-width: 450px) {
                .h-custom {
                    height: 100%;
                }
            }
        </style>

        <section class="container  h-custom p-0 mb-5">
            <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="col-md-9 col-lg-6 col-xl-5">
                    <img src="/assets/images/login.jpg" class="img-fluid" alt="Sample image">
                </div>
                <div class="col-md-8 col-lg-6 col-xl-4 offset-xl-1">
                    <form id="form-login" method="post" action="javascript:void(0)">
                        <div class="d-flex flex-row align-items-center justify-content-center justify-content-lg-start mb-4">
                            <p class="lead fw-normal mb-0 me-3">เข้าสู่ระบบ</p>
                        </div>

                        <!-- Email input -->
                        <div class="form-outline mb-2">
                            <label class="form-label" for="">ชื่อผู้ใช้</label>

                            <input type="text" id="" class="form-control form-control-lg" placeholder="ชื่อผู้ใช้" name="username" required />
                        </div>

                        <!-- Password input -->
                        <div class="form-outline mb-2">
                            <label class="form-label" for="">รหัสผ่าน</label>
                            <input type="password" id="" class="form-control form-control-lg" placeholder="ป้อนรหัสผ่าน" name="pass" required />
                        </div>

                        <div class="d-flex justify-content-between align-items-center">
                            <!-- Checkbox -->
                            <div class="form-check mb-0">
                                <!-- <input class="form-check-input me-2" type="checkbox" value="" id="form2Example3" />
                                <label class="form-check-label" for="form2Example3">
                                    จดจำรหัสผ่าน
                                </label> -->
                            </div>

                        </div>

                        <div class="text-center text-lg-start mt-4 pt-2">
                            <button type="submit" class="btn btn-primary btn-lg" style="padding-left: 2.5rem; padding-right: 2.5rem;">เข้าสู่ระบบ</button>
                            <p class="small fw-bold mt-2 pt-1 mb-0">ฉันยังไม่สมัครสมาชิก <a href="./register.php" class="link-danger">สมัครสมาชิก</a></p>
                        </div>

                    </form>
                </div>
            </div>
        </section>




        <?php include_once('../inc/script.php') ?>

    </div><!-- Body inner end -->
</body>

</html>
