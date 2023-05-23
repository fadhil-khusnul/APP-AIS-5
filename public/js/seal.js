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


function damage_seal() {
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
        ignore: "select[type=hidden]",
        rules: {
            seal: {
                required: true,
            },
            keterangan_damage: {
                required: true,
            },

        },
        messages: {
            seal: {
                required: "Silahkan Pilih Seal",
            },
            keterangan_damage: {
                required: "Silakan Masukkan Keterangan Seal",
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
            var seal = document.getElementById("seal").value;
            var keterangan_damage = document.getElementById("keterangan_damage").value;
            var token = $("#csrf").val();

            let fd = new FormData();

            fd.append("seal", seal);
            fd.append("keterangan_damage", keterangan_damage);
            fd.append("_token", token);




                swal.fire({
                    title:
                        "Apakah anda yakin? Ingin Mengkategorikan Seal ini : " +
                        seal +
                        " Kedalam Damage Seal (Rusak)",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonText: "Iya",
                    cancelButtonText: "Tidak",
                }).then((willCreate) => {
                    if (willCreate.isConfirmed) {
                        $.ajax({
                            type: "POST",
                            url: "/tambah-damage-seal",
                            data: fd,
                            contentType: false,
                            processData: false,
                            dataType: "json",
                            success: function () {
                                swal.fire({
                                    icon: "success",
                                    title:
                                        "Seal " +
                                        seal +
                                        " Ini Berhasil Dikategorikan Rusak",
                                    showConfirmButton: false,
                                    timer: 2e3,
                                }).then((result) => {
                                    location.reload();
                                });
                            },
                        });
                    } else {
                        swal.fire({
                            title: "Seal Batal dikategorikan",
                            icon: "error",
                            timer: 2e3,
                            showConfirmButton: false,
                        });
                    }
                });

        },
    });
}

function editseal(e) {
    var id = e.value;
    console.log(id);


    $.ajax({
        url: 'seal/' + id + '/edit',
        type: 'GET',
        success: function (response) {
            $('#modal-seal-edit').modal('show');

            $('#kode_seal_edit').val(response.result.kode_seal);

            $('#valid_pelabuhan_edit').validate({
                rules: {

                    kode_seal_edit: {
                        required: true
                    },

                },
                messages: {

                    kode_seal_edit: {
                        required: "Silakan Isi Kode Seal"
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

                // console.log();
                submitHandler: function (form) {
                    var token = $('#csrf').val();

                    $.ajax({
                        url: 'seal-update/' + id,
                        type: 'PUT',
                        data: {
                            "_token": token,
                            kode_seal: $('#kode_seal_edit').val(),
                        },
                        success: function (response) {
                            swal.fire({
                                icon: "success",
                                title: "Data Seal Berhasil Diedit",
                                showConfirmButton: false,
                                timer: 2e3,

                            })
                                .then((result) => {
                                    location.reload();
                                });
                        }
                    })
                }
            });

        }
    });
}



function deleteseal(id) {
    var deleteid = id.value;

    var swal = Swal.mixin({
        customClass: {
            confirmButton: "btn btn-label-success btn-wide mx-1",
            denyButton: "btn btn-label-secondary btn-wide mx-1",
            cancelButton: "btn btn-label-danger btn-wide mx-1" },
            buttonsStyling: false
    });

    swal.fire({
        title: "Apakah anda yakin?",
        text: "Setelah dihapus, Anda tidak dapat memulihkan Data ini lagi!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonText: "Iya",
        cancelButtonText: "Tidak",
    })
        .then((willDelete) => {
            if (willDelete.isConfirmed) {

                var data = {
                    "_token": $('input[name=_token]').val(),
                    'id': deleteid,
                };
                $.ajax({
                    type: "DELETE",
                    url: 'seal/' + deleteid,
                    data: data,
                    success: function (response) {
                        swal.fire({
                            title: "Data Seal Dihapus",
                            text: "Data Berhasil Dihapus",
                            icon: "success",
                            timer: 2e3,
                            showConfirmButton: false
                        })
                            .then((result) => {
                                location.reload();
                            });
                    }
                });
            } else {
                swal.fire({
                    title: "Data Tidak Dihapus",
                    text: "Data Batal Dihapus",
                    icon: "error",
                    timer: 2e3,
                    showConfirmButton: false
                });
            }
        });
}


