function Tambah_Seal() {
    var swal = Swal.mixin({
        customClass: {
            confirmButton: "btn btn-label-success btn-wide mx-1",
            denyButton: "btn btn-label-secondary btn-wide mx-1",
            cancelButton: "btn btn-label-danger btn-wide mx-1",
        },
        buttonsStyling: false,
    });
    var toast = Swal.mixin({
        toast: true,
        position: "top-end",
        showConfirmButton: false,
        timer: 3e3,
        timerProgressBar: true,
        didOpen: function didOpen(toast) {
            toast.addEventListener("mouseenter", Swal.stopTimer);
            toast.addEventListener("mouseleave", Swal.resumeTimer);
        },
    });

    $.validator.addMethod(
        "notEqual",
        function (value, element, arg) {
            return arg !== value;
        },
        "Value must not equal arg."
    );

    $("#valid_seal").validate({
        rules: {
            start_seal: {
                required: true,
                min: 1,
            },
            kode_seal: {
                required: true,
            },
            touch_seal: {
                required: true,
                min: 1,
                max: 250,
            },
        },
        messages: {
            start_seal: {
                required: "Silahkan Masukkan Nilai Awal Seal",
                min: "Harus Lebih Besar dari 0",
            },
            kode_seal: {
                required: "Silakan Masukkan Kode Seal",
            },
            touch_seal: {
                required: "Silakan Isi Nama Kompany",
                min: "Harus Lebih Besar dari 0",
                max: "Harus Lebih Kecil dari 250",
            },
        },
        highlight: function highlight(element, errorClass, validClass) {
            $(element).addClass("is-invalid");
            $(element).removeClass("is-valid");
        },
        unhighlight: function unhighlight(element, errorClass, validClass) {
            $(element).removeClass("is-invalid");
            $(element).addClass("is-valid");
        },
        errorPlacement: function errorPlacement(error, element) {
            error.addClass("invalid-feedback");
            element.closest(".validation-container").append(error);
        },
        submitHandler: function (form) {
            var code = document.getElementById("kode_seal").value;
            var start_seal = document.getElementById("start_seal").value;
            start_seal = parseInt(start_seal);
            var touch_seal = document.getElementById("touch_seal").value;
            touch_seal = parseInt(touch_seal);
            var token = $("#csrf").val();

            var data_kode_seal = [];
            var data_code = [];
            var data_start_seal = [];
            var data_touch_seal = [];
            let fd = new FormData();
            var result;

            $.ajax({
                url: "/getCodeSeal",
                type: "post",
                datatype: "json",
                async: false,
                data: {
                    code: code,
                    _token: token,
                },
                success: function (response) {
                    result = response;
                    // if (response.length == 0) {
                    for (let i = 0; i < touch_seal; i++) {
                        data_kode_seal[i] =
                            code + String(start_seal + i).padStart(6, "0");
                        fd.append("kode_seal[]", data_kode_seal[i]);
                        data_code[i] = code;
                        fd.append("code[]", data_code[i]);
                        data_start_seal[i] = start_seal + i;
                        fd.append("start_seal[]", data_start_seal[i]);
                        data_touch_seal[i] = touch_seal;
                        fd.append("touch_seal[]", data_touch_seal[i]);
                    }
                },
            });

            var database_kode_seal = [];

            for(var i = 0; i < result.length; i++) {
                database_kode_seal[i] = result[i].kode_seal;
            }

            fd.append("_token", token);

            if (database_kode_seal.some((item) => data_kode_seal.includes(item))) {
                swal.fire({
                    title: "Kode Seal yang Dimasukkan Sudah Ada",
                    text: "Silakan Masukkan Kode Baru atau Masukkan Start Seal yang Berbeda",
                    icon: "error",
                    timer: 2e3,
                    showConfirmButton: false,
                });
            } else {
                swal.fire({
                    title:
                        "Apakah anda yakin? Ingin Menambah Sebanyak " +
                        touch_seal +
                        " Seal?",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonText: "Iya",
                    cancelButtonText: "Tidak",
                }).then((willCreate) => {
                    if (willCreate.isConfirmed) {
                        $.ajax({
                            type: "POST",
                            url: "/tambah-seal",
                            data: fd,
                            contentType: false,
                            processData: false,
                            dataType: "json",
                            success: function () {
                                swal.fire({
                                    icon: "success",
                                    title:
                                        "Sebanyak " +
                                        touch_seal +
                                        "  Seal Berhasil Ditambah",
                                    showConfirmButton: false,
                                    timer: 2e3,
                                }).then((result) => {
                                    location.reload();
                                });
                            },
                        });
                    } else {
                        swal.fire({
                            title: "Seal Tidak Dibuat",
                            text: "Seal Batal Dibuat",
                            icon: "error",
                            timer: 2e3,
                            showConfirmButton: false,
                        });
                    }
                });
            }
        },
    });
}

function editCompany(e) {
    var id = e.value;
    $.ajax({
        url: "company/" + id + "/edit",
        type: "GET",
        success: function (response) {
            $("#modal-company-edit").modal("show");

            $("#nama_company_edit").val(response.result.nama_company);

            $("#valid_company_edit").validate({
                rules: {
                    nama_company_edit: {
                        required: true,
                    },
                },
                messages: {
                    nama_company_edit: {
                        required: "Silakan Isi Nama Company",
                    },
                },

                // console.log();
                submitHandler: function (form) {
                    var token = $("#csrf").val();

                    $.ajax({
                        url: "company/" + id,
                        type: "PUT",
                        data: {
                            _token: token,
                            nama_company: $("#nama_company_edit").val(),
                        },
                        success: function (response) {
                            swal.fire({
                                icon: "success",
                                title: "Data Company Berhasil Diedit",
                                showConfirmButton: false,
                                timer: 2e3,
                            }).then((result) => {
                                location.reload();
                            });
                        },
                    });
                },
            });
        },
    });
}

function deleteCompany(id) {
    var deleteid = id.value;

    var swal = Swal.mixin({
        customClass: {
            confirmButton: "btn btn-label-success btn-wide mx-1",
            denyButton: "btn btn-label-secondary btn-wide mx-1",
            cancelButton: "btn btn-label-danger btn-wide mx-1",
        },
        buttonsStyling: false,
    });

    swal.fire({
        title: "Apakah anda yakin?",
        text: "Setelah dihapus, Anda tidak dapat memulihkan Data ini lagi!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonText: "Iya",
        cancelButtonText: "Tidak",
    }).then((willDelete) => {
        if (willDelete.isConfirmed) {
            var data = {
                _token: $("input[name=_token]").val(),
                id: deleteid,
            };
            $.ajax({
                type: "DELETE",
                url: "company/" + deleteid,
                data: data,
                success: function (response) {
                    swal.fire({
                        title: "Data Dihapus",
                        text: "Data Berhasil Dihapus",
                        icon: "success",
                        timer: 2e3,
                        showConfirmButton: false,
                    }).then((result) => {
                        location.reload();
                    });
                },
            });
        } else {
            swal.fire({
                title: "Data Tidak Dihapus",
                text: "Data Batal Dihapus",
                icon: "error",
                timer: 2e3,
                showConfirmButton: false,
            });
        }
    });
}

// function jumlah_seal() {
//     var token = $("#csrf").val();
//     var code = document.getElementById("kode_seal").value;
//     var start_seal = document.getElementById("start_seal").value;
//     start_seal = parseInt(start_seal);
//     var touch_seal = document.getElementById("touch_seal").value;
//     touch_seal = parseInt(touch_seal);
//     var total_seal = [];

//     for(var i = 0; i < touch_seal; i++) {
//         total_seal[i] = start_seal + i;
//     }

//     if(code != "" && start_seal != 0) {
//         $.ajax({
//             url: "/getKodeSeal",
//             type: "post",
//             data: {
//                 code: code,
//                 _token: token,
//             },
//             success: function(response) {
//                 console.log(response);
//             }
//         })
//     }
//     // else {
//     //     swal.fire({
//     //         title: "Kode dan Nilai Awal Belum Dimasukkan",
//     //         text: "Silakan Masukkan Kode dan Nilai Awal",
//     //         icon: "error",
//     //         timer: 2e3,
//     //         showConfirmButton: false,
//     //     });
//     // }

// }
