const queryString = window.location.search;

function convert(str) {
    var date = new Date(str),
        mnth = ("0" + (date.getMonth() + 1)).slice(-2),
        day = ("0" + date.getDate()).slice(-2);
    return [date.getFullYear(), mnth, day].join("-");
}

Date.prototype.addHours = function (h) {
    this.setTime(this.getTime() + h * 60 * 60 * 1000);
    return this;
};

// Auth Controllers
jQuery(function ($) {
    "use strict";
    $("#form-login").submit(function () {
        var inputs = $("#form-login :input");
        var values = {};
        inputs.each(function () {
            values[this.name] = $(this).val();
        });
        console.log(values);

        $.ajax({
            url: "/App/controllers/auth.php",
            type: "POST",
            data: {
                key: "form-login",
                data: values,
            },
            success: function (results, statusText, jqXHR) {
                console.log(results);
                // console.log(result);
                const obj = JSON.parse(results);
                if (obj.msg === "success-em") {
                    Swal.fire({
                        position: "center",
                        icon: "success",
                        title: obj.msg_text,
                        showConfirmButton: false,
                        timer: 1000,
                    }).then((result) => {
                        location.assign("/views/employee/");
                    });
                } else if (obj.msg === "success-cm") {
                    Swal.fire({
                        position: "center",
                        icon: "success",
                        title: obj.msg_text,
                        showConfirmButton: false,
                        timer: 1000,
                    }).then((result) => {
                        location.assign("/views/users/");
                    });
                } else {
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
                }
            },
            error: function (jqXHR, statusText, errorTh) {
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

    $("#form-register").submit(function () {
        var inputs = $("#form-register :input");
        var values = {};
        inputs.each(function () {
            values[this.name] = $(this).val();
        });
        console.log(values);
        $.ajax({
            url: "/App/controllers/auth.php",
            type: "POST",
            data: {
                key: "form-register",
                data: values,
            },
            success: function (results, statusText, jqXHR) {
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
                        location.assign("/views/auth/login.php");
                    });
                } else {
                    Swal.fire({
                        position: "center",
                        icon: "error",
                        title: obj.msg_text,
                        showConfirmButton: false,
                        timer: 2000,
                    }).then((result) => {
                        location.reload();
                    });
                }
            },
            error: function (jqXHR, statusText, errorTh) {
                Swal.fire({
                    position: "center",
                    icon: "error",
                    title: obj.msg_text,
                    showConfirmButton: false,
                    timer: 2000,
                }).then((result) => {
                    location.reload();
                });
            },
        });
    });

    $("#form-edit-account").submit(function () {
        var inputs = $("#form-edit-account :input");
        var values = {};
        inputs.each(function () {
            values[this.name] = $(this).val();
        });
        console.log(values);
        $.ajax({
            url: "/App/controllers/auth.php",
            type: "POST",
            data: {
                key: "form-edit-account",
                data: values,
            },
            success: function (results, statusText, jqXHR) {
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
                        location.reload();
                    });
                }
            },
            error: function (jqXHR, statusText, errorTh) {
                Swal.fire({
                    position: "center",
                    icon: "error",
                    title: obj.msg_text,
                    showConfirmButton: false,
                    timer: 2000,
                }).then((result) => {
                    location.reload();
                });
            },
        });
    });
});

// Controllers Production
jQuery(($) => {
    "use strict";
    $("#input_image").change(function (e) {
        // get a reference to the file
        const file = e.target.files[0];
        let base64StringImg_show = null;

        const reader = new FileReader();
        reader.onloadend = (e) => {
            let img = document.createElement("img");
            img.onload = function (event) {
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

                $("#img_show").attr("src", dataurl);
                // console.log(dataurl.replace(/^data:image\/(png|jpg);base64,/, ""));
                const base64String_ = dataurl
                    .replace("data:", "")
                    .replace(/^.+,/, "");
                base64StringImg_show = base64String_;

                $("#img").val(base64StringImg_show);
                // console.log(base64StringImg_show);
            };
            img.src = e.target.result;
        };
        reader.readAsDataURL(file);
    });

    $("#form-addProducts").submit(function () {
        var inputs = $("#form-addProducts :input");
        var values = {};
        inputs.each(function () {
            values[this.name] = $(this).val();
        });
        // values['img'] = base64StringImg_show;
        console.log(values);

        $.ajax({
            url: "/App/controllers/products.php",
            type: "POST",
            data: {
                key: "form-addProducts",
                data: values,
            },
            success: function (results, statusText, jqXHR) {
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
                        location.reload();
                    });
                }
            },
            error: function (jqXHR, statusText, errorTh) {
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
});

// Controllers Table
jQuery(($) => {
    "use strict";

    $("#form-addTables").submit(function () {
        var inputs = $("#form-addTables :input");
        var values = {};
        inputs.each(function () {
            values[this.name] = $(this).val();
        });
        // values['img'] = base64StringImg_show;
        console.log(values);

        $.ajax({
            url: "/App/controllers/managetable.php",
            type: "POST",
            data: {
                key: "form-addTables",
                data: values,
            },
            success: function (results, statusText, jqXHR) {
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
                        location.reload();
                    });
                }
            },
            error: function (jqXHR, statusText, errorTh) {
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
});

// reserve
jQuery(($) => {
    $("#form-reserve").submit(function () {
        var inputs = $("#form-reserve :input");
        var values = {};
        inputs.each(function () {
            values[this.name] = $(this).val();
        });

        console.log(values);

        Swal.fire({
            title: "ยืนยันการจอง",
            text: "คุณต้องการจองโต๊ะตามเวลาที่เลือกใช้หรือไม่?",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "คุณแน่ใจใช่หรือไม่!",
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: "/App/controllers/reserve.php",
                    type: "POST",
                    data: {
                        key: "form-reserve",
                        data: values,
                    },
                    success: function (result, statusText, jqXHR) {
                        console.log(result);
                        const obj = JSON.parse(result);

                        if (obj.msg === "success") {
                            Swal.fire({
                                position: "center",
                                icon: "success",
                                title: obj.msg_text,
                                showConfirmButton: false,
                                timer: 2000,
                            }).then((result) => {
                                // location.assign("/views/auth/login.php");
                                location.reload();
                            });
                        } else if (obj.msg === "warning") {
                            Swal.fire({
                                position: "center",
                                icon: "warning",
                                title: obj.msg_text,
                                showConfirmButton: false,
                                timer: 2000,
                            });
                        } else {
                            Swal.fire({
                                position: "center",
                                icon: "error",
                                title: obj.msg_text,
                                showConfirmButton: false,
                                timer: 2000,
                            }).then((result) => {
                                location.reload();
                            });
                        }
                    },
                    error: function (jqXHR, statusText) {},
                });
            }
        });

        // if (confirm("กรุณาตรวจสอบข้อมูลอีกครั้ง ก่อนกดยืนยัน")) {
        //
        // }
    });

    $("#timeStart").change(function () {
        var timeStart = $(this).val();
        var dateTimeStart = new Date($("#dataStarts").val() + " " + timeStart);
        var gHS = dateTimeStart.getHours();
        var gMS = dateTimeStart.getMinutes();

        var timeEnd_add = new Date(dateTimeStart);
        timeEnd_add.setMinutes(dateTimeStart.getMinutes() + 120);

        var s = "" + gMS;
        var sNew = s.length == 1 ? "0" + s : s;

        var sd = "" + timeEnd_add.getMinutes();
        var sNews = sd.length == 1 ? "0" + sd : sd;
        if (gHS >= 10 && gHS <= 20) {
            $("#timeEnd").val(timeEnd_add.getHours() + ":" + sNews);
        } else if (gHS == 21) {
            $("#timeEnd").val("22:59");
        } else {
            Swal.fire("ร้านเปิด 10.00 น. - 21.30");
            $(this).val("10:00");
            $("#timeEnd").val("11:00");
        }
    });
});

$(document).ready(function () {
    $(".table-neme").DataTable({
        dom: "IBfrtip",
        lengthMenu: [
            [10, 25, 50, 60, -1],
            [10, 25, 50, 60, "All"],
        ],
        language: {
            sProcessing: "กำลังดำเนินการ...",
            sLengthMenu: "แสดง  _MENU_  แถว",
            sZeroRecords: "ไม่พบข้อมูล",
            sInfo: "แสดง _START_ ถึง _END_ จาก _TOTAL_ แถว",
            sInfoEmpty: "แสดง 0 ถึง 0 จาก 0 แถว",
            sInfoFiltered: "(กรองข้อมูล _MAX_ ทุกแถว)",
            sInfoPostFix: "",
            sSearch: "ค้นหา: ",
            sUrl: "",
            oPaginate: {
                sFirst: "เริ่มต้น",
                sPrevious: "ก่อนหน้า",
                sNext: "ถัดไป",
                sLast: "สุดท้าย",
            },
        }, // sInfoEmpty: "แสดง 0 ถึง 0 ของ 0 เร็คคอร์ด",
        processing: true, // แสดงข้อความกำลังดำเนินการ กรณีข้อมูลมีมากๆ จะสังเกตเห็นง่าย
        //serverSide: true, // ใช้งานในโหมด Server-side processing
        // กำหนดให้ไม่ต้องการส่งการเรียงข้อมูลค่าเริ่มต้น จะใช้ค่าเริ่มต้นตามค่าที่กำหนดในไฟล์ php
        retrieve: true,
        buttons: ["excel"],
    });
});

// exports.editProduct = editProduct;
const editProducts = (productID) => {
    // jQuery(($) => {
    // alert("Product ");
    $.ajax({
        url: "/views/employee/modal/editProducts.php",
        type: "POST",
        data: {
            key: "editProducts",
            productID: productID,
        },
        success: function (results, statusText, jqXHR) {
            $(".editProducts-model").html(results);
            $("#editProducts").modal("show");
        },
        error: function (jqXHR, textStatus, errorThrown) {},
    });
};

const deleteProducts = (productID) => {
    Swal.fire({
        title: "ต้องการลบ",
        text: "คุณต้องการลบข้อมูลใช้หรือไม่?",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "คุณแน่ใจใช่หรือไม่!",
    }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                url: "/App/controllers/products.php",
                type: "POST",
                data: {
                    key: "deleteProducts",
                    productID: productID,
                },
                success: function (results, statusText, jqXHR) {
                    console.log(results);
                    const obj = JSON.parse(results);
                    Swal.fire({
                        position: "center",
                        icon: "success",
                        title: obj.msg_text,
                        showConfirmButton: false,
                        timer: 1000,
                    }).then((result) => {
                        location.reload();
                    });
                },
            });
        }
    });
};

// exports.editProduct = editProduct;
const editTables = (id_din) => {
    // jQuery(($) => {
    // alert("Product ");
    $.ajax({
        url: "/views/employee/modal/editTables.php",
        type: "POST",
        data: {
            key: "editTables",
            id_din: id_din,
        },
        success: function (results, statusText, jqXHR) {
            $(".editTables-model").html(results);
            $("#editTables").modal("show");
        },
        error: function (jqXHR, textStatus, errorThrown) {},
    });
};

const deleteTables = (id_din) => {
    Swal.fire({
        title: "ต้องการลบ",
        text: "คุณต้องการลบข้อมูลใช้หรือไม่?",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "คุณแน่ใจใช่หรือไม่!",
    }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                url: "/App/controllers/managetable.php",
                type: "POST",
                data: {
                    key: "deleteTables",
                    id_din: id_din,
                },
                success: function (results, statusText, jqXHR) {
                    console.log(results);
                    const obj = JSON.parse(results);
                    Swal.fire({
                        position: "center",
                        icon: "success",
                        title: obj.msg_text,
                        showConfirmButton: false,
                        timer: 1000,
                    }).then((result) => {
                        location.reload();
                    });
                },
            });
        }
    });
};

document.addEventListener("DOMContentLoaded", function () {
    var calendarEl = document.getElementById("calendar");

    const calendar = new FullCalendar.Calendar(calendarEl, {
        timeZone: "Asia/Bangkok",
        firstDay: 0,
        dateClick: function (info) {
            // alert('Date: ' + info.dateStr);
            // alert('Resource ID: ' + info.resource.id);
            // $("#date-input").val(info.dateStr);
        },
        headerToolbar: {
            left: "title",
            center: "dayGridMonth,listWeek",
            right: "today prev,next",
        },
        locale: "th",
        initialDate: new Date(),
        editable: false,
        eventLimit: true,
        navLinks: false, // can click day/week names to navigate views
        selectable: true,
        selectMirror: true,
        select: function (arg) {
            $("#reserve_table").modal("show");
            $("#dataStarts").val(convert(arg.start));

            calendar.unselect();
        },
        dayMaxEvents: true, // allow "more" link when too many events
        events: {
            url: "/assets/json/events.json",
            failure: function () {
                document.getElementById("script-warning").style.display =
                    "block";
            },
        },
        loading: function (bool) {
            document.getElementById("loading").style.display = bool
                ? "block"
                : "none";
        },
        eventTimeFormat: {
            // รูปแบบการแสดงของเวลา เช่น '14:30'
            hour: "2-digit",
            minute: "2-digit",
            meridiem: false,
        },
    });

    calendar.render();
    calendar.setOption("themeSystem", "lux");
});

const reserveUpdate = (id, statusr) => {
    let title = "";
    let text = "";

    var dateTimeStart = new Date();
    var gHS = dateTimeStart.getHours();
    var gMS = dateTimeStart.getMinutes();

    var timeEnd_add = new Date(dateTimeStart);
    timeEnd_add.setMinutes(dateTimeStart.getMinutes() + 100);

    var sde = "" + gMS;
    var sNewse = sde.length == 1 ? "0" + sde : sde;

    var sd = "" + timeEnd_add.getMinutes();
    var sNews = sd.length == 1 ? "0" + sd : sd;

    var timeNo = gHS + ":" + sNewse;
    var timeEn = timeEnd_add.getHours() + ":" + sNews;

    if (statusr == 0) {
        title = "ยกเลิกการจอง";
        text = "คุณต้องการยกเลิกการจองใช้หรือไม่";
    } else if (statusr == 2) {
        title = "ยืนยันการจอง";
        text = "คุณต้องการยืนยันการจองข้อมูลใช้หรือไม่";
    } else if (statusr == 3) {
        title = "ยืนยันการชำระเงิน";
        text = "คุณต้องการยืนยันการชำระเงินใช้หรือไม่";
    }

    Swal.fire({
        title: title,
        text: text,
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "คุณแน่ใจใช่หรือไม่!",
    }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                url: "/App/controllers/reserve.php",
                type: "POST",
                data: {
                    key: "reserveUpdate",
                    id: id,
                    status: statusr,
                    timeNow: timeNo,
                    timeEn: timeEn,
                },
                success: function (results, statusText, jqXHR) {
                    console.log(results);
                    const obj = JSON.parse(results);
                    if (obj.msg === "success") {
                        Swal.fire({
                            position: "center",
                            icon: "success",
                            title: obj.msg_text,
                            showConfirmButton: false,
                            timer: 2000,
                        }).then((result) => {
                            // location.assign("/views/auth/login.php");
                            location.reload();
                        });
                    } else if (obj.msg === "error") {
                        Swal.fire({
                            position: "center",
                            icon: "error",
                            title: obj.msg_text,
                            showConfirmButton: false,
                            timer: 2000,
                        }).then((result) => {
                            location.reload();
                        });
                    } else {
                        Swal.fire({
                            position: "center",
                            icon: "error",
                            title: "ระบบตรวจพบข้อผิดพลาดบางอย่าง!!!",
                            showConfirmButton: false,
                            timer: 2000,
                        }).then((result) => {
                            location.reload();
                        });
                    }
                },
                error: () => {
                    Swal.fire({
                        position: "center",
                        icon: "error",
                        title: "ระบบตรวจพบข้อผิดพลาดบางอย่าง!!!",
                        showConfirmButton: false,
                        timer: 2000,
                    }).then((result) => {
                        location.reload();
                    });
                },
            });
        }
    });
};

const search_name = (object) => {
    let search = $("#" + object).val();

    // alert(search)

    if (queryString.includes("?")) {
        location.assign(window.location.href + "&search=" + search);
    } else {
        location.assign(window.location.href + "?search=" + search);
    }
};
