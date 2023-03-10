<?php
date_default_timezone_set('Asia/Bangkok');
require_once $_SERVER['DOCUMENT_ROOT'] . "/App/config/connectdb.php";

$key = $_POST["key"] !== "" ? $_POST["key"] : null;
$id_din = $_POST["id_din"] !== "" ? $_POST["id_din"] : null;
if ($key === null && $key !== 'editTables' || $id_din === null) {
    exit;
}

$rowTable = DB::Query("SELECT * FROM `diningtable` WHERE id_din = '$id_din'", PDO::FETCH_OBJ)->fetch(PDO::FETCH_OBJ);

?>

<form id="form-editTables" action="javascript:void(0)" method="post">
    <input type="hidden" name="id_din" value="<?php echo $id_din ?>">
    <div class="modal-header">
        <h5 class="modal-title" id="">แก้ไขโต๊ะ</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    <div class="modal-body">

        <div class="form-group">
            <label for="">กรุณากรอกชื่อโต๊ะนั่ง</label>
            <input type="text" name="name_din" class="form-control" value="<?php echo $rowTable->name_din?>" required>
        </div>
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">ยกเลิก</button>
        <button type="submit" class="btn btn-primary">บันทึก</button>
    </div>
</form>
<script>

    $("#form-editTables").submit(() => {
        var inputs = $("#form-editTables :input");
        var values = {};
        inputs.each(function() {
            values[this.name] = $(this).val();
        });
        // values['img'] = base64StringImg_show;
        console.log(values);
        $.ajax({
            url: "/App/controllers/managetable.php",
            type: "POST",
            data: {
                key: "form-editTables",
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
