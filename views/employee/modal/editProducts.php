<?php
date_default_timezone_set('Asia/Bangkok');
require_once $_SERVER['DOCUMENT_ROOT'] . "/App/config/connectdb.php";

$key = $_POST["key"] !== "" ? $_POST["key"] : null;
$productID = $_POST["productID"] !== "" ? $_POST["productID"] : null;
if ($key === null && $key !== 'editProducts' || $productID === null) {
    exit;
}

$rowProduct = DB::Query("SELECT * FROM `products` WHERE id = '$productID'", PDO::FETCH_OBJ)->fetch(PDO::FETCH_OBJ);

?>

<form id="form-editProducts" action="javascript:void(0)" method="post" >
    <input type="hidden" name="id" value="<?php echo $productID ?>">
    <div class="modal-header">
        <h5 class="modal-title" id="">แก้ไขอาหาร</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    <div class="modal-body">

        <div class="form-group">
            <div class="row">
                <div class="col">
                    <input id="img-edit" type="hidden" name="img" value="<?php echo $rowProduct->img ?>" required>
                    <label for="">กรุณาเลือกภาพอาหาร</label>
                    <input id="input_image-edit" type="file" accept="image/*" class="form-control-file" >
                </div>
                <div class="col">
                    <label>รูปที่เลือก</label>
                    <img id="img_show-edit" src="/assets/images/products/<?php echo $rowProduct->img ?>" width="100%" height="180px">
                </div>
            </div>

        </div>
        <div class="form-group">
            <label for="">กรุณากรอกชื่ออาหาร </label>
            <input type="text" name="name" class="form-control" value="<?php echo $rowProduct->name ?>" required>
        </div>
        <div class="form-group">
            <label for="">ตั้งราคาอาหาร</label>
            <input type="number" name="price" class="form-control" value="<?php echo $rowProduct->price ?>" required>
        </div>
        <div class="form-group">
            <label for="">รายละเอียดอาหาร</label>
            <textarea rows="4" name="details" class="form-control" cols=""><?php echo $rowProduct->details ?></textarea>
        </div>
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">ยกเลิก</button>
        <button type="submit" class="btn btn-primary">บันทึก</button>
    </div>
</form>
<script>
    $("#input_image-edit").change(function(e) {
        // get a reference to the file
        const file = e.target.files[0];
        let base64StringImg_show = null;

        const reader = new FileReader();
        reader.onloadend = (e) => {
            let img = document.createElement("img");
            img.onload = function(event) {
                // Dynamically create a canvas element
                let canvas = document.createElement("canvas");
                canvas.width = 600;
                canvas.height = 600;
                // var canvas = document.getElementById("canvas");
                let ctx = canvas.getContext("2d");
                // Actual resizing
                ctx.drawImage(img, 0, 0, canvas.width, canvas.height);

                // Show resized image in preview element
                let dataurl = canvas.toDataURL(file.type);

                $("#img_show-edit").attr("src", dataurl);
                // console.log(dataurl.replace(/^data:image\/(png|jpg);base64,/, ""));
                const base64String_ = dataurl
                    .replace("data:", "")
                    .replace(/^.+,/, "");
                base64StringImg_show = base64String_;

                $("#img-edit").val(base64StringImg_show);
                // console.log(base64StringImg_show);
            };
            img.src = e.target.result;
        };
        reader.readAsDataURL(file);
    });
    $("#form-editProducts").submit(() => {
        var inputs = $("#form-editProducts :input");
        var values = {};
        inputs.each(function() {
            values[this.name] = $(this).val();
        });
        // values['img'] = base64StringImg_show;
        console.log(values);
        $.ajax({
            url: "/App/controllers/products.php",
            type: "POST",
            data: {
                key: "form-editProducts",
                data: values,
            },
            success: function(results, statusText, jqXHR) {
                console.log(results);
                const obj = JSON.parse(results);

                if (obj.msg === "success") {
                    Swal.fire({
                        position: "center",
                        icon: "success",
                        title: obj.msg_text,
                        showConfirmButton: false,
                        timer: 1000,
                    }).then((result) => {
                        // location.assign("/views/auth/login.php");
                        // alert("kjkkk");
                        location.reload();
                    });
                } else {
                    Swal.fire({
                        position: "center",
                        icon: "error",
                        title: obj.msg_text,
                        showConfirmButton: false,
                        timer: 2000,
                    }).then((result) => {
                        // location.reload();
                    });
                }
            },
            error: function(jqXHR, statusText, errorTh) {
                Swal.fire({
                    position: "center",
                    icon: "error",
                    title: obj.msg_text,
                    showConfirmButton: false,
                    timer: 1000,
                }).then((result) => {
                    // location.assign('/views/users/')
                    location.reload();
                });
            },
        });
    });
</script>
