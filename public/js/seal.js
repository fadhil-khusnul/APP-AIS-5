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
            bulan_seal: {
                required: true,
            },
            kode_seal: {
                required: true,
            },
            touch_seal: {
                required: true,
                min: 1,
                max: 500
            },
        },
        messages: {
            bulan_seal: {
                required: "Silahkan Masukkan Bulan Dan Tanggal",
            },
            kode_seal: {
                required: "Silakan Masukkan Kode Seal",
            },
            touch_seal: {
                required: "Silakan Isi Nama Kompany",
                min: "Harus Lebih Besar dari 0",
                max: "Harus Lebih Kecil dari 500"
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
            var date_seal = document.getElementById("bulan_seal").value;
            date_seal = date_seal.replace(/\-/g, "");
            var touch_seal = document.getElementById("touch_seal").value;
            touch_seal = touch_seal.replace(/\./g, "");
            touch_seal = parseInt(touch_seal);
            var token = $("#csrf").val();

            var data_kode_seal = [];
            var data_code = [];
            var data_date_seal = [];
            var data_touch_seal = [];
            let fd = new FormData();

            $.ajax({
                url: '/getCodeSeal',
                type: 'post',
                data: {
                    code: code,
                    bulan: date_seal,
                    _token: token
                },
                success: function(response) {
                    if(response == 0) {
                        for (let i = 0; i < touch_seal; i++) {
                            data_kode_seal[i] =
                                code + date_seal + String(i + 1).padStart(3, "0");
                            fd.append("kode_seal[]", data_kode_seal[i]);
                            data_code[i] = code;
                            fd.append("code[]", data_code[i]);
                            data_date_seal[i] = date_seal;
                            fd.append("bulan_seal[]", data_date_seal[i]);
                            data_touch_seal[i] = touch_seal;
                            fd.append("touch_seal[]", data_touch_seal[i]);
                        }
                    } else {
                        for (let i = 0; i < touch_seal; i++) {
                            data_kode_seal[i] =
                                code + date_seal + String(i + response + 1).padStart(3, "0");
                            fd.append("kode_seal[]", data_kode_seal[i]);
                            data_code[i] = code;
                            fd.append("code[]", data_code[i]);
                            data_date_seal[i] = date_seal;
                            fd.append("bulan_seal[]", data_date_seal[i]);
                            data_touch_seal[i] = touch_seal;
                            fd.append("touch_seal[]", data_touch_seal[i]);
                        }
                    }
                }
            })

            fd.append("_token", token);


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
                                    "Seal Sebanyak " +
                                    touch_seal +
                                    " Berhasil Ditambah",
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
