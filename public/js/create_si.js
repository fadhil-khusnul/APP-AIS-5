function pdf_si() {
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

    $("#valid_realisasi").validate({
        ignore: "select[type=hidden]",
        rules: {
            letter: {
                required: true,
            },
        },
        messages: {
            letter: {
                required: "Silakan Pilih Minimal 1 Container",
            },
        },

        highlight: function highlight(element, errorClass, validClass) {
            $(element).addClass("is-invalid");
            $(element).removeClass("is-valid");
        },
        unhighlight: function unhighlight(element, errorClass, validClass) {
            $(element).removeClass("is-invalid");
        },
        errorPlacement: function errorPlacement(error, element) {
            error.addClass("invalid-feedback");
            element.closest(".validation-container").append(error);
            if (element.attr("name") == "letter") {
                error.appendTo("#checkboxerror");
            } else {
                error.insertAfter(element);
            }
        },
        submitHandler: function (form) {
            let token = $("#csrf").val();
            var chek_container = $(".check-container:checked")
                .map(function () {
                    return this.value;
                })
                .get();

            var old_slug = $("#old_slug").val();

            var d = new Date(),
                dformat = [
                    d.getFullYear(),
                    d.getMonth() + 1,
                    d.getDate(),
                    d.getHours(),
                    d.getMinutes(),
                    d.getSeconds(),
                ].join("-");

            console.log(chek_container);

            swal.fire({
                title: " Buat SI Untuk Job Load ini?",
                text: "Silahkan Periksa Semua Data yang ada Sebelum Membuat Shipping Container (SI).",
                icon: "question",
                showCancelButton: true,
                confirmButtonText: "Iya",
                cancelButtonText: "Tidak",
            }).then((willCreate) => {
                if (willCreate.isConfirmed) {
                    $("#modal-si").modal("show");

                    $("#valid_si").validate({
                        rules: {
                            shipper: {
                                required: true,
                            },
                            consigne: {
                                required: true,
                            },
                        },
                        messages: {
                            shipper: {
                                required: "Silakan Isi SHIPPER",
                            },
                            consigne: {
                                required: "Silakan Isi CONSIGNE",
                            },
                        },
                        highlight: function highlight(
                            element,
                            errorClass,
                            validClass
                        ) {
                            $(element).addClass("is-invalid");
                            $(element).removeClass("is-valid");
                        },
                        unhighlight: function unhighlight(
                            element,
                            errorClass,
                            validClass
                        ) {
                            $(element).removeClass("is-invalid");
                        },
                        errorPlacement: function errorPlacement(
                            error,
                            element
                        ) {
                            error.addClass("invalid-feedback");
                            element
                                .closest(".validation-container")
                                .append(error);
                        },
                        submitHandler: function (form) {
                            // document.getElementById('loading-wrapper').style.cursor = "wait";
                            // document.getElementById('btnFinish').setAttribute('disabled', true);
                            var shipper = $("#shipper").val();
                            var consigne = $("#consigne").val();
                            // var slug_container = $('#slug_container').val();

                            var size = [];
                            var type = [];
                            var nomor_kontainer = [];
                            var cargo = [];
                            var seal = [];
                            for (var i = 0; i < chek_container.length; i++) {
                                size[i] = document.getElementById(
                                    "size[" + chek_container[i] + "]"
                                ).innerText;
                                type[i] = document.getElementById(
                                    "type[" + chek_container[i] + "]"
                                ).innerText;
                                nomor_kontainer[i] = document.getElementById(
                                    "nomor_kontainer[" + chek_container[i] + "]"
                                ).innerText;
                                cargo[i] = document.getElementById(
                                    "cargo[" + chek_container[i] + "]"
                                ).innerText;
                                seal[i] = document.getElementById(
                                    "seal[" + chek_container[i] + "]"
                                ).innerText;
                            }
                            var data = {
                                _token: token,
                                chek_container: chek_container,
                                old_slug: old_slug,
                                shipper: shipper,
                                consigne: consigne,
                                type: type,
                                size: size,
                                nomor_kontainer: nomor_kontainer,
                                cargo: cargo,
                                seal: seal,
                                status_si: "Default",
                            };
                            // console.log(data);

                            $.ajax({
                                type: "POST",
                                url: "/create-si-container",
                                data: data,
                                xhrFields: {
                                    responseType: "blob",
                                },
                                success: function (response) {
                                    // console.log(response);
                                    toast.fire({
                                        icon: "success",
                                        title: "SI Berhasil Dibuat",
                                    });
                                    var blob = new Blob([response]);
                                    var link = document.createElement("a");
                                    link.href =
                                        window.URL.createObjectURL(blob);
                                    link.download =
                                        "" + old_slug + dformat + ".pdf";
                                    link.click();

                                    setTimeout(function () {
                                        window.location.reload();
                                    }, 10);
                                },
                            });
                        },
                    });
                } else {
                    swal.fire({
                        title: "SI Tidak Dibuat",
                        // text: "Data Batal Dihapus",
                        icon: "error",
                        timer: 2e3,
                        showConfirmButton: false,
                    });
                }
            });

            // for (let i = 0; i < chek_container.length; i++) {
            //     volume[i] = document.getElementById("volume[" + item_id[i] + "]").value;

            // }
        },
    });
}

function pdf_si_alih() {
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

    $("#valid_realisasi").validate({
        ignore: "select[type=hidden]",
        rules: {
            letter: {
                required: true,
            },
        },
        messages: {
            letter: {
                required: "Silakan Pilih Minimal 1 Container",
            },
        },

        highlight: function highlight(element, errorClass, validClass) {
            $(element).addClass("is-invalid");
            $(element).removeClass("is-valid");
        },
        unhighlight: function unhighlight(element, errorClass, validClass) {
            $(element).removeClass("is-invalid");
        },
        errorPlacement: function errorPlacement(error, element) {
            error.addClass("invalid-feedback");
            element.closest(".validation-container").append(error);
            if (element.attr("name") == "letter") {
                error.appendTo("#checkboxerror");
            } else {
                error.insertAfter(element);
            }
        },
        submitHandler: function (form) {
            let token = $("#csrf").val();
            var chek_container = $(".check-container1:checked")
                .map(function () {
                    return this.value;
                })
                .get();

            $.ajax({
                type: "post",
                url: "/getAlihKapal",
                data: {
                    _token: token,
                    kontainer_alih: chek_container,
                },
                success: function (response) {
                    var unique_alih_kapal = [...new Set(response)];

                    if (unique_alih_kapal.length != 1) {
                        swal.fire({
                            title: "Vessel/Voyage Alih Kapal Tidak Sama",
                            text: "Silahkan Perhatikan Detail Alih-Kapalnya",
                            icon: "error",
                            timer: 2e3,
                            showConfirmButton: false,
                        });
                    } else {
                        var old_slug = $('#old_slug').val();
                        var d = new Date(),
                        dformat = [
                            d.getFullYear(),
                            d.getMonth()+1,
                            d.getDate(),
                            d.getHours(),
                            d.getMinutes(),
                            d.getSeconds(),
                        ].join('-');
                        console.log(chek_container);
                        swal.fire({
                            title: " Buat SI Untuk Job Load ini?",
                            text: "Silahkan Periksa Semua Data yang ada Sebelum Membuat Shipping Container (SI).",
                            icon: "question",
                            showCancelButton: true,
                            confirmButtonText: "Iya",
                            cancelButtonText: "Tidak",
                        }).then((willCreate) => {
                            if (willCreate.isConfirmed) {
                                $('#modal-si').modal('show');
                                $('#valid_si').validate({
                                    rules: {
                                        shipper: {
                                            required: true
                                        },
                                        consigne: {
                                            required: true
                                        },
                                    },
                                    messages: {
                                        shipper: {
                                            required: "Silakan Isi SHIPPER"
                                        },
                                        consigne: {
                                            required: "Silakan Isi CONSIGNE"
                                        },
                                    },
                                    highlight: function highlight(element, errorClass, validClass) {
                                        $(element).addClass("is-invalid");
                                        $(element).removeClass("is-valid");
                                    },
                                    unhighlight: function unhighlight(element, errorClass, validClass) {
                                        $(element).removeClass("is-invalid");
                                    },
                                    errorPlacement: function errorPlacement(error, element) {
                                        error.addClass("invalid-feedback");
                                        element.closest(".validation-container").append(error);
                                    },
                                    submitHandler: function (form) {
                                        // document.getElementById('loading-wrapper').style.cursor = "wait";
                                        // document.getElementById('btnFinish').setAttribute('disabled', true);
                                        var shipper = $('#shipper').val();
                                        var consigne = $('#consigne').val();
                                        var old_slug = $('#old_slug').val();
                                        // var slug_container = $('#slug_container').val();
                                        console.log(chek_container);
                                        var data = {
                                            "_token": token,
                                            'chek_container': chek_container,
                                            'shipper': shipper,
                                            'consigne': consigne,
                                            'old_slug': old_slug,
                                            'status_si': "Alih-Kapal",
                                        };
                                        // console.log(data);
                                        $.ajax({
                                            type: "POST",
                                            url: '/create-si-alih',
                                            data: data,
                                            xhrFields: {
                                                responseType: 'blob'
                                            },
                                            success: function (response) {
                                                // console.log(response);
                                                toast.fire({
                                                    icon: "success",
                                                    title: "SI Berhasil Dibuat"
                                                })
                                                var blob = new Blob([response]);
                                                var link = document.createElement('a');
                                                link.href = window.URL.createObjectURL(blob);
                                                link.download = ""+old_slug+dformat+".pdf";
                                                link.click();
                                                setTimeout(function(){
                                                    window.location.reload();
                                                }, 10);
                                            }
                                        });
                                    }
                                });
                            } else {
                                swal.fire({
                                    title: "SI Tidak Dibuat",
                                    // text: "Data Batal Dihapus",
                                    icon: "error",
                                    timer: 2e3,
                                    showConfirmButton: false
                                });
                            }
                        });
                        for (let i = 0; i < chek_container.length; i++) {
                            volume[i] = document.getElementById("volume[" + item_id[i] + "]").value;
                        }
                    }
                },
            });
        },
    });
}
function input_bl(e) {
    var id = e.value;
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

    swal.fire({
        title: " Masukkkan Nomor BL untuk SI ini?",
        icon: "question",
        showCancelButton: true,
        confirmButtonText: "Iya",
        cancelButtonText: "Tidak",
    }).then((willCreate) => {
        if (willCreate.isConfirmed) {
            $("#modal-bl").modal("show");

            $("#valid_bl").validate({
                rules: {
                    nomor_bl: {
                        required: true,
                    },
                    tanggal_bl: {
                        required: true,
                    },
                },
                messages: {
                    nomor_bl: {
                        required: "Silakan Isi Nomor BL",
                    },
                    tanggal_bl: {
                        required: "Silakan Isi Tanggal BL",
                    },
                },
                highlight: function highlight(element, errorClass, validClass) {
                    $(element).addClass("is-invalid");
                    $(element).removeClass("is-valid");
                },
                unhighlight: function unhighlight(
                    element,
                    errorClass,
                    validClass
                ) {
                    $(element).removeClass("is-invalid");
                },
                errorPlacement: function errorPlacement(error, element) {
                    error.addClass("invalid-feedback");
                    element.closest(".validation-container").append(error);
                },
                submitHandler: function (form) {
                    document.getElementById("loading-wrapper").style.cursor =
                        "wait";
                    document
                        .getElementById("btnFinish1")
                        .setAttribute("disabled", true);

                    var csrf = $("#csrf").val();
                    var nomor_bl = $("#nomor_bl").val();
                    var tanggal_bl = $("#tanggal_bl").val();

                    tempDate = new Date(tanggal_bl);
                    formattedDate = [
                        tempDate.getFullYear(),
                        tempDate.getMonth() + 1,
                        tempDate.getDate(),
                    ].join("-");

                    var data = {
                        _token: csrf,
                        id: id,
                        nomor_bl: nomor_bl,
                        tanggal_bl: formattedDate,
                    };
                    // console.log(data);

                    $.ajax({
                        type: "POST",
                        url: "/masukkan-bl",
                        data: data,

                        success: function (response) {
                            // console.log(response);
                            toast
                                .fire({
                                    icon: "success",
                                    title: "Nomor Berhasil Dimasukkan",
                                    timer: 2e3,
                                })
                                .then((result) => {
                                    location.reload();
                                });
                        },
                    });
                },
            });
        } else {
            toast.fire({
                title: "Nomor BL Tidak dimasukkan",
                icon: "error",
                timer: 2e3,
            });
        }
    });

    // for (let i = 0; i < chek_container.length; i++) {
    //     volume[i] = document.getElementById("volume[" + item_id[i] + "]").value;

    // }
}
function update_bl(e) {
    var id = e.value;
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

    $.ajax({
        url: "/detail-pdf/" + id + "/input",
        type: "GET",
        success: function (response) {
            let new_id = id;
            console.log(new_id);




            $("#modal-bl-edit").modal("show");

            $("#id_container").val(response.result.id);
            $("#nomor_bl_edit").val(response.result.nomor_bl);

            var old_tanggal_result = moment(
                response.result.tanggal_bl,
                "YYYY-MM-DD"
            ).format("dddd, DD-MM-YYYY");
            $("#tanggal_bl_edit").val(old_tanggal_result);

            // $("#tanggal_bl").val(response.result.tanggal_bl);

            $("#valid_bl_edit").validate({

                highlight: function highlight(element, errorClass, validClass) {
                    $(element).addClass("is-invalid");
                    $(element).removeClass("is-valid");
                },
                unhighlight: function unhighlight(
                    element,
                    errorClass,
                    validClass
                ) {
                    $(element).removeClass("is-invalid");
                },
                errorPlacement: function errorPlacement(error, element) {
                    error.addClass("invalid-feedback");
                    element.closest(".validation-container").append(error);
                },
                submitHandler: function (form) {
                    document.getElementById("loading-wrapper").style.cursor =
                        "wait";
                    document
                        .getElementById("btnFinish2")
                        .setAttribute("disabled", true);

                    var csrf = $("#csrf").val();
                    var nomor_bl = $("#nomor_bl_edit").val();
                    var id_container = $("#id_container").val();
                    var tanggal_bl = $("#tanggal_bl_edit").val();

                    tempDate = new Date(tanggal_bl);
                    formattedDate = [
                        tempDate.getFullYear(),
                        tempDate.getMonth() + 1,
                        tempDate.getDate(),
                    ].join("-");

                    var data = {
                        _token: csrf,
                        id: id_container,
                        nomor_bl: nomor_bl,
                        tanggal_bl: formattedDate,
                    };
                    // console.log(data);

                    $.ajax({
                        type: "POST",
                        url: "/masukkan-bl",
                        data: data,

                        success: function (response) {
                            // console.log(response);
                            toast
                                .fire({
                                    icon: "success",
                                    title: "Nomor Berhasil Dimasukkan",
                                    timer: 2e3,
                                })
                                .then((result) => {
                                    location.reload();
                                });
                        },
                    });
                },
            });

        },
    });


    // for (let i = 0; i < chek_container.length; i++) {
    //     volume[i] = document.getElementById("volume[" + item_id[i] + "]").value;

    // }
}

function approve_si(ini) {
    var swal = Swal.mixin({
        customClass: {
            confirmButton: "btn btn-label-success btn-wide mx-1",
            denyButton: "btn btn-label-secondary btn-wide mx-1",
            cancelButton: "btn btn-label-danger btn-wide mx-1",
        },
        buttonsStyling: false,
    });

    var terima = "Disetujui";
    let token = $("#csrf").val();

    var container_id = ini.value;
    var data = {
        _token: token,
        terima: terima,
        container_id: container_id,
    };

    if (terima == "Disetujui") {
        swal.fire({
            title: "Apakah anda yakin Ingin APPROVE SI ini?",
            text: "Setelah SI disetujui, Anda tidak dapat menolak SI ini lagi!",
            icon: "question",
            showCancelButton: true,
            confirmButtonText: "Iya",
            cancelButtonText: "Tidak",
        }).then((willCreate) => {
            if (willCreate.isConfirmed) {
                $.ajax({
                    type: "POST",
                    url: "/konfirmasi-si",
                    data: data,
                    success: function (response) {
                        swal.fire({
                            title: "SI Diapprove",
                            text: "SI Telah Diapprove",
                            icon: "success",
                            timer: 2e3,
                            showConfirmButton: false,
                        }).then((result) => {
                            window.location.reload();
                        });
                    },
                });
            } else {
                swal.fire({
                    title: "SI Belum Diapprove",
                    text: "Silakan Perhatikan SI Lagi Sebelum Diapprove",
                    icon: "warning",
                    timer: 2e3,
                    showConfirmButton: false,
                });
            }
        });
    }
}
function tolak_si(ini) {
    var swal = Swal.mixin({
        customClass: {
            confirmButton: "btn btn-label-success btn-wide mx-1",
            denyButton: "btn btn-label-secondary btn-wide mx-1",
            cancelButton: "btn btn-label-danger btn-wide mx-1",
        },
        buttonsStyling: false,
    });

    var terima = "Ditolak";
    let token = $("#csrf").val();

    var container_id = ini.value;
    var data = {
        _token: token,
        terima: terima,
        container_id: container_id,
    };

    if (terima == "Ditolak") {
        swal.fire({
            title: "Apakah anda yakin ingin MENOLAK SI ini?",
            text: "Setelah SI ditolak, Anda tidak dapat menyetujui SI ini lagi!",
            icon: "question",
            showCancelButton: true,
            confirmButtonText: "Iya",
            cancelButtonText: "Tidak",
        }).then((willCreate) => {
            if (willCreate.isConfirmed) {
                $.ajax({
                    type: "POST",
                    url: "/konfirmasi-si",
                    data: data,
                    success: function (response) {
                        swal.fire({
                            title: "SI Ditolak",
                            text: "SI Telah Ditolak",
                            icon: "error",
                            timer: 2e3,
                            showConfirmButton: false,
                        }).then((result) => {
                            window.location.reload();
                        });
                    },
                });
            } else {
                swal.fire({
                    title: "SI Belum Ditolak",
                    text: "Silakan Perhatikan SI Lagi Sebelum Ditolak",
                    icon: "warning",
                    timer: 2e3,
                    showConfirmButton: false,
                });
            }
        });
    }
}

function detail_update(e) {
    let id = e.value;
    console.log(id);
    var swal = Swal.mixin({
        customClass: {
            confirmButton: "btn btn-success btn-wide mx-1",
            denyButton: "btn btn-secondary btn-wide mx-1",
            cancelButton: "btn btn-danger btn-wide mx-1",
        },
        buttonsStyling: false,
    });

    $.ajax({
        url: "/detail-kontainer/" + id + "/input",
        type: "GET",
        success: function (response) {
            let new_id = id;
            console.log(new_id);

            var seals = [""];
            var spk = [""];
            var supir = [""];

            for (let i = 0; i < response.seal_containers.length; i++) {
                seals[i] = response.seal_containers[i].seal_kontainer;
            }
            for (let i = 0; i < response.spks.length; i++) {
                spk[i] = response.spks[i].spk_kontainer;
            }
            for (let i = 0; i < response.supirs.length; i++) {
                supir +=
                    "<option value='" +
                    response.supirs[i].id +
                    "'>" +
                    response.supirs[i].nama_supir +
                    "/" +
                    response.supirs[i].nomor_polisi +
                    "</option>";
            }
            console.log(seals);
            $("#modal-job-update").modal("show");

            $("#size_update").val(response.result.size);
            $("#type_update").val(response.result.type);
            $("#nomor_kontainer_update").val(response.result.nomor_kontainer);
            $("#no_container_edit").val(response.result.nomor_kontainer);
            $("#cargo_update").val(response.result.cargo);
            $("#detail_barang_update").val(response.result.detail_barang);
            $("#seal_old").val(seals);

            $("#seal_update")
                .val(seals)
                .select2({
                    dropdownAutoWidth: true,
                    // tags: true,
                    placeholder: "Silahkan Pilih",
                    // allowClear:true,
                    maximumSelectionLength: 4,
                    dropdownParent: $("#modal-job-update"),
                })
                .on("select2:select", function (e) {
                    var selected_element = $(e.currentTarget);
                    var select_val = selected_element.val();
                    // console.log(select_val);

                    // console.log(seals);

                    var element = e.params.data.element;
                    var $element = $(element);

                    $element.detach();
                    $(this).append($element);
                    $(this).trigger("change");

                    let token = $("#csrf").val();

                    $.ajax({
                        url: "/getSealProcessLoad",
                        type: "post",
                        async: false,
                        data: {
                            _token: token,
                        },
                        success: function (response) {
                            // console.log(seals);
                            var seal = $("#seal_update").val();
                            var last_seal = seal[seal.length - 1];
                            console.log(seal, last_seal);
                            var count_seal = response.length;
                            var seal_already = [];
                            for (var i = 0; i < count_seal; i++) {
                                seal_already[i] = response[i].seal_kontainer;
                            }

                            if (seals.includes(last_seal) == false) {
                                if (seal_already.includes(last_seal)) {
                                    swal.fire({
                                        title: "Seal Kontainer Sudah Dipakai",
                                        icon: "error",
                                        timer: 10e3,
                                        async: false,
                                        showConfirmButton: true,
                                    }).then(() => {
                                        var wanted_option = $(
                                            '#seal_update option[value="' +
                                                last_seal +
                                                '"]'
                                        );
                                        console.log(wanted_option);

                                        wanted_option.prop("selected", false);
                                        // $(this).trigger("change.select2");
                                        $("#seal_update").trigger(
                                            "change.select2"
                                        );
                                    });
                                }
                            }
                        },
                    });
                });
            $("#spk_update")
                .val(spk)
                .select2({
                    dropdownAutoWidth: true,
                    placeholder: "Silahkan Pilih",
                    // allowClear:true,
                    maximumSelectionLength: 4,
                    dropdownParent: $("#modal-job-update"),
                })
                .on("select2:select", function (e) {
                    var selected_element = $(e.currentTarget);
                    var select_val = selected_element.val();
                    // console.log(select_val);

                    // console.log(seals);

                    var element = e.params.data.element;
                    var $element = $(element);

                    $element.detach();
                    $(this).append($element);
                    $(this).trigger("change");

                    let token = $("#csrf").val();

                    $.ajax({
                        url: "/getSpkProcessLoad",
                        type: "post",
                        async: false,
                        data: {
                            _token: token,
                        },
                        success: function (response) {
                            // console.log(seals);
                            var seal = $("#spk_update").val();
                            var last_seal = seal[seal.length - 1];
                            console.log(seal, last_seal);
                            var count_seal = response.length;
                            var seal_already = [];
                            for (var i = 0; i < count_seal; i++) {
                                seal_already[i] = response[i].spk_kontainer;
                            }

                            if (spk.includes(last_seal) == false) {
                                if (seal_already.includes(last_seal)) {
                                    swal.fire({
                                        title: "SPK Kontainer Sudah Dipakai",
                                        icon: "error",
                                        timer: 10e3,
                                        async: false,
                                        showConfirmButton: true,
                                    }).then(() => {
                                        var wanted_option = $(
                                            '#spk_update option[value="' +
                                                last_seal +
                                                '"]'
                                        );
                                        console.log(wanted_option);

                                        wanted_option.prop("selected", false);
                                        // $(this).trigger("change.select2");
                                        $("#spk_update").trigger(
                                            "change.select2"
                                        );
                                    });
                                }
                            }
                        },
                    });
                });

            var old_tanggal_result = moment(
                response.result.date_activity,
                "YYYY-MM-DD"
            ).format("dddd, DD-MM-YYYY");
            $("#date_activity_update").val(old_tanggal_result);
            $("#lokasi_update")
                .val(response.result.lokasi_depo)
                .select2({
                    dropdownAutoWidth: true,
                    placeholder: "Silahkan Pilih",
                    allowClear: true,
                    dropdownParent: $("#modal-job-update"),
                });
            $("#pengirim_update")
                .val(response.result.pengirim)
                .select2({
                    dropdownAutoWidth: true,
                    placeholder: "Silahkan Pilih Pengirim",
                    allowClear: true,
                    dropdownParent: $("#modal-job-update"),
                });
            $("#penerima_update")
                .val(response.result.penerima)
                .select2({
                    dropdownAutoWidth: true,
                    placeholder: "Silahkan Pilih penerima",
                    allowClear: true,
                    dropdownParent: $("#modal-job-update"),
                });

            $("#new_id_update").val(response.result.id);
            $("#nomor_polisi_update")
                .html(supir)
                .select2({
                    dropdownAutoWidth: true,
                    placeholder: "Silahkan Pilih Supir",
                    allowClear: true,
                    dropdownParent: $("#modal-job-update"),
                });
            $("#driver_update")
                .val(response.result.driver)
                .select2({
                    dropdownAutoWidth: true,
                    placeholder: "Silahkan Pilih Vendor",
                    allowClear: true,
                    dropdownParent: $("#modal-job-update"),
                })
                .change(function () {
                    let vendor_id = $(this).val();
                    let token = $("#csrf").val();
                    $.ajax({
                        url: "/getVendor",
                        type: "POST",
                        data: {
                            vendor_id: vendor_id,
                            _token: token,
                        },
                        success: function (result) {
                            $("#nomor_polisi_update")
                                .select2({
                                    dropdownAutoWidth: true,
                                    placeholder: "Silahkan Pilih Supir",
                                    allowClear: true,
                                    dropdownParent: $("#modal-job-update"),
                                })
                                .html(result);
                        },
                    });
                });
            $("#remark_update").val(response.result.remark);
            $("#biaya_stuffing_update").val(response.result.biaya_stuffing);
            $("#biaya_trucking_update").val(response.result.biaya_trucking);
            $("#biaya_thc_update").val(response.result.biaya_thc);
            $("#ongkos_supir_update").val(response.result.ongkos_supir);
            $("#biaya_seal_update").val(response.result.biaya_seal);
            $("#freight_update").val(response.result.freight);
            $("#lss_update").val(response.result.lss);
            $("#jenis_mobil_update").val(response.result.jenis_mobil);
            $("#dana_update")
                .val(response.result.dana)
                .select2({
                    dropdownAutoWidth: true,
                    placeholder: "Silahkan Pilih Deposit Trucking",
                    allowClear: true,
                    dropdownParent: $("#modal-job-update"),
                });

            $("#valid_job_update").validate({
                ignore: "select[type=hidden]",

                rules: {
                    size: {
                        required: true,
                    },
                },
                messages: {
                    size: {
                        required: "Silakan Pilih Size",
                    },
                },
                highlight: function highlight(element, errorClass, validClass) {
                    $(element).addClass("is-invalid");
                    $(element).removeClass("is-valid");
                },
                unhighlight: function unhighlight(
                    element,
                    errorClass,
                    validClass
                ) {
                    $(element).removeClass("is-invalid");
                    $(element).addClass("is-valid");
                },
                errorPlacement: function errorPlacement(error, element) {
                    error.addClass("invalid-feedback");
                    element.closest(".validation-container").append(error);
                },

                // console.log();
                submitHandler: function (form) {
                    var new_id = document.getElementById("new_id_update").value;
                    console.log(new_id);
                    console.log(id);
                    var token = $("#csrf").val();

                    let date_activity = document.getElementById(
                        "date_activity_update"
                    ).value;
                    var tempDate;
                    var formattedDate;

                    tempDate = new Date(date_activity);
                    console.log(tempDate);
                    formattedDate = [
                        tempDate.getFullYear(),
                        tempDate.getMonth() + 1,
                        tempDate.getDate(),
                    ].join("-");

                    $.ajax({
                        url: "/detail-kontainer-edit/" + new_id,
                        type: "PUT",
                        data: {
                            _token: token,
                            job_id: $("#job_id").val(),
                            size: $("#size_update").val(),
                            type: $("#type_update").val(),
                            nomor_kontainer: $("#nomor_kontainer_update").val(),
                            cargo: $("#cargo_update").val(),
                            detail_barang: $("#detail_barang_update").val(),
                            seal: $("#seal_update").val(),
                            seal_old: seals,
                            spk_old: spk,
                            date_activity: formattedDate,
                            lokasi: $("#lokasi_update").val(),
                            penerima: $("#penerima_update").val(),
                            pengirim: $("#pengirim_update").val(),
                            driver: $("#driver_update").val(),
                            nomor_polisi: $("#nomor_polisi_update").val(),
                            remark: $("#remark_update").val(),
                            biaya_stuffing: $("#biaya_stuffing_update")
                                .val()
                                .replace(/\./g, ""),
                            biaya_trucking: $("#biaya_trucking_update")
                                .val()
                                .replace(/\./g, ""),
                            ongkos_supir: $("#ongkos_supir_update")
                                .val()
                                .replace(/\./g, ""),
                            biaya_thc: $("#biaya_thc_update")
                                .val()
                                .replace(/\./g, ""),
                            biaya_seal: $("#biaya_seal_update")
                                .val()
                                .replace(/\./g, ""),
                            freight: $("#freight_update")
                                .val()
                                .replace(/\./g, ""),
                            lss: $("#lss_update").val().replace(/\./g, ""),
                            jenis_mobil: $("#jenis_mobil_update").val(),
                            dana: $("#dana_update").val(),
                            spk: $("#spk_update").val(),
                        },
                        success: function (response) {
                            swal.fire({
                                icon: "success",
                                title: "Detail Kontainer Berhasil DIUPDATE",
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


function delete_SI(r) {
    var deleteid = r.value;

    var swal = Swal.mixin({
        customClass: {
            confirmButton: "btn btn-label-success btn-wide mx-1",
            denyButton: "btn btn-label-secondary btn-wide mx-1",
            cancelButton: "btn btn-label-danger btn-wide mx-1",
        },
        buttonsStyling: false,
    });

    swal.fire({
        title: "Apakah anda yakin Ingin Menghapus Dokumen SI INI ?",
        icon: "warning",
        showCancelButton: true,
        confirmButtonText: "Iya",
        cancelButtonText: "Tidak",
    }).then((willCreate) => {
        if (willCreate.isConfirmed) {
            var old_slug = document.getElementById("old_slug").value;

            var data = {
                _token: $("input[name=_token]").val(),
                id: deleteid,
            };
            $.ajax({
                type: "DELETE",
                url: "/delete-si/" + deleteid,
                data: data,

                success: function (response) {
                    swal.fire({
                        title: "SI BERHASIL DIHAPUS",
                        icon: "success",
                        timer: 9e3,
                        showConfirmButton: false,
                    });
                    window.location.reload();
                },
            });
        } else {
            swal.fire({
                title: "Container TIDAK DIHAPUS",
                icon: "error",
                timer: 10e3,
                showConfirmButton: true,
            });
        }
    });
}
