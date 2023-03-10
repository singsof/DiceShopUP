<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <title>สมัครสมาชิก  - DICE SHOP</title>

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
                    <img src="/assets/images/login.jpg"  class="img-fluid " alt="">
                </div>
                <div class="col-md-8 col-lg-6 col-xl-4 offset-xl-1">
                    <form id='form-register' method="post" action="javascript:void(0)">
                        <div class="d-flex flex-row align-items-center justify-content-center justify-content-lg-start mb-4">
                            <p class="lead fw-normal mb-0 me-3">สมัครสมาชิก</p>
                        </div>
                        <div class="form-outline mb-2">
                            <label class="form-label" for="">รหัสบัตรประชาชน</label>

                            <input type="text"  class="form-control form-control-lg" maxlength="13" placeholder="รหัสบัตรประชาชน" name="codeID" required />
                        </div>
                        <div class="form-outline mb-2">
                            <label class="form-label" for="">ชื่อ - นามสกุล</label>

                            <input type="text"  class="form-control form-control-lg" placeholder="ชื่อ - นามสกุล" minlength="5"  name="name" required />
                        </div>
                        <div class="form-outline mb-2">
                            <label class="form-label" for="">เบอร์โทรศัพท์</label>

                            <input type="text"  class="form-control form-control-lg" maxlength="10" minlength="8" placeholder="เบอร์โทรศัพท์" name="phone" />
                        </div>
                        <div class="form-outline mb-2">
                            <label class="form-label" for="">E-Mail</label>

                            <input type="email"  class="form-control form-control-lg" placeholder="E-Mail" minlength="5"  name="email" required />
                        </div>
                        <!-- Email input -->
                        <div class="form-outline mb-2">
                            <label class="form-label" for="">ชื่อผู้ใช้</label>
                            <input type="text"  class="form-control form-control-lg" placeholder="ชื่อผู้ใช้" minlength="5"  name="username" required />
                        </div>
                        <div class="form-outline mb-2">
                            <label class="form-label" for="">รหัสผ่าน</label>
                            <input type="password"  class="form-control form-control-lg"  maxlength="15" minlength="5" placeholder="รหัสผ่าน" name="pass" required />
                        </div>
                        <div class="d-flex justify-content-between align-items-center">
                            <!-- Checkbox -->
                            <div class="form-check mb-0">

                            </div>

                        </div>

                        <div class="text-center text-lg-start mt-4 pt-2">
                            <button type="submit" class="btn btn-primary btn-lg" style="padding-left: 2.5rem; padding-right: 2.5rem;">ลงทะเบียน</button>
                            <p class="small fw-bold mt-2 pt-1 mb-0">ฉันสมัรคสมาชิกแล้ว? <a href="./login.php" class="link-danger">เข้าสู่ระบบ</a></p>
                        </div>

                    </form>
                </div>
            </div>
        </section>


        <?php include_once('../inc/script.php') ?>

    </div><!-- Body inner end -->
</body>

</html>
