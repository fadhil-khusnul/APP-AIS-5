function Tambah_SPK() {
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
            start_spk: {
                required: true,
                min: 1,
            },
            kode_spk: {
                required: true,
            },
            touch_spk: {
                required: true,
                min: 1,
                max: 250,
            },
        },
        messages: {
            start_spk: {
                required: "Silahkan Masukkan Nilai Awal Spk",
                min: "Harus Lebih Besar dari 0",
            },
            kode_spk: {
                required: "Silakan Masukkan Kode Spk",
            },
            touch_spk: {
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
            var code = document.getElementById("kode_spk").value;
            var start_spk = document.getElementById("start_spk").value;
            start_spk = parseInt(start_spk);
            var touch_spk = document.getElementById("touch_spk").value;
            var select_company = document.getElementById("select_company").value;
            touch_spk = parseInt(touch_spk);
            var token = $("#csrf").val();

            var data_kode_spk = [];
            var data_code = [];
            var data_start_spk = [];
            var data_touch_spk = [];
            var data_select = [];
            let fd = new FormData();
            var result;

            $.ajax({
                url: "/getCodeSpk",
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
                    for (let i = 0; i < touch_spk; i++) {
                        data_kode_spk[i] =
                            code + String(start_spk + i).padStart(6, "0");
                        fd.append("kode_spk[]", data_kode_spk[i]);
                        data_code[i] = code;
                        fd.append("code[]", data_code[i]);
                        data_start_spk[i] = start_spk + i;
                        fd.append("start_spk[]", data_start_spk[i]);
                        data_touch_spk[i] = touch_spk;
                        fd.append("touch_spk[]", data_touch_spk[i]);
                        data_select[i] = select_company;
                        fd.append("select_company[]", data_select[i]);
                    }
                },
            });

            var database_kode_spk = [];

            for(var i = 0; i < result.length; i++) {
                database_kode_spk[i] = result[i].kode_spk;
            }

            fd.append("_token", token);

            if (database_kode_spk.some((item) => data_kode_spk.includes(item))) {
                swal.fire({
                    title: "Kode Spk yang Dimasukkan Sudah Ada",
                    text: "Silakan Masukkan Kode Baru atau Masukkan Start Spk yang Berbeda",
                    icon: "error",
                    timer: 2e3,
                    showConfirmButton: false,
                });
            } else {
                swal.fire({
                    title:
                        "Apakah anda yakin? Ingin Menambah Sebanyak " +
                        touch_spk +
                        " Spk?",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonText: "Iya",
                    cancelButtonText: "Tidak",
                }).then((willCreate) => {
                    if (willCreate.isConfirmed) {
                        $.ajax({
                            type: "POST",
                            url: "/tambah-spk",
                            data: fd,
                            contentType: false,
                            processData: false,
                            dataType: "json",
                            success: function () {
                                swal.fire({
                                    icon: "success",
                                    title:
                                        "Sebanyak " +
                                        touch_spk +
                                        "  Spk Berhasil Ditambah",
                                    showConfirmButton: false,
                                    timer: 2e3,
                                }).then((result) => {
                                    location.reload();
                                });
                            },
                        });
                    } else {
                        swal.fire({
                            title: "Spk Tidak Dibuat",
                            text: "Spk Batal Dibuat",
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



function editspk(e) {
    var id = e.value;
    console.log(id);


    $.ajax({
        url: 'spk/' + id + '/edit',
        type: 'GET',
        success: function (response) {
            $('#modal-spk-edit').modal('show');

            $('#kode_spk_edit').val(response.result.kode_spk);
            $('#select_company_edit').val(response.result.pelayaran_id);

            $('#valid_spk_edit').validate({
                rules: {

                    kode_spk_edit: {
                        required: true
                    },

                },
                messages: {

                    kode_spk_edit: {
                        required: "Silakan Isi Kode Spk"
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
                        url: 'spk-update/' + id,
                        type: 'PUT',
                        data: {
                            "_token": token,
                            kode_spk: $('#kode_spk_edit').val(),
                            select_company: $('#select_company_edit').val(),
                        },
                        success: function (response) {
                            swal.fire({
                                icon: "success",
                                title: "Data Spk Berhasil Diedit",
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



function deletespk(id) {
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
                    url: 'spk/' + deleteid,
                    data: data,
                    success: function (response) {
                        swal.fire({
                            title: "Data Spk Dihapus",
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


