function biaya_do(e) {
    var id = e.value;
    console.log(id);
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
        title: " Masukkkan Biaya POD untuk kontainer ini?",
        icon: "question",
        showCancelButton: true,
        confirmButtonText: "Iya",
        cancelButtonText: "Tidak",
    }).then((willCreate) => {
        if (willCreate.isConfirmed) {
        $.ajax({
            url: "/detail-kontainer/" + id + "/input",
            type: "GET",
            success: function (response) {
                let new_id = id;
                console.log(new_id);
            $("#modal_biaya_do").modal("show");

            $("#id_container").val(response.result.id);




            $("#valid_pod").validate({


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


                    var csrf = $("#csrf").val();
                    var id_container = $("#id_container").val();
                    var thc_pod = $("#thc_pod").val().replace(/\./g, "");
                    var lolo = $("#lolo").val().replace(/\./g, "");
                    var dooring = $("#dooring").val().replace(/\./g, "");
                    var demurrage = $("#demurrage").val().replace(/\./g, "");



                    var data = {
                        _token: csrf,
                        id: id_container,
                        thc_pod: thc_pod,
                        lolo: lolo,
                        dooring: dooring,
                        demurrage: demurrage,
                    };

                    $.ajax({
                        type: "POST",
                        url: "/masukkan-biaya-pod",
                        data: data,

                        success: function (response) {
                            // console.log(response);
                            toast
                                .fire({
                                    icon: "success",
                                    title: "Biaya POD Dimasukkan",
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

function edit_biaya_do(e) {
    var id = e.value;
    console.log(id);
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
            url: "/detail-kontainer/" + id + "/input",
            type: "GET",
            success: function (response) {
                let new_id = id;
                console.log(new_id);
            $("#modal_biaya_do_edit").modal("show");

            $("#id_container_edit").val(response.result.id);
            $("#thc_pod_edit").val(response.result.thc_pod);
            $("#lolo_edit").val(response.result.lolo);
            $("#dooring_edit").val(response.result.dooring);
            $("#demurrage_edit").val(response.result.demurrage);




            $("#valid_pod_edit").validate({


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


                    var csrf = $("#csrf").val();
                    var id_container = $("#id_container_edit").val();
                    var thc_pod = $("#thc_pod_edit").val().replace(/\./g, "");
                    var lolo = $("#lolo_edit").val().replace(/\./g, "");
                    var dooring = $("#dooring_edit").val().replace(/\./g, "");
                    var demurrage = $("#demurrage_edit").val().replace(/\./g, "");



                    var data = {
                        _token: csrf,
                        id: id_container,
                        thc_pod: thc_pod,
                        lolo: lolo,
                        dooring: dooring,
                        demurrage: demurrage,
                    };

                    $.ajax({
                        type: "POST",
                        url: "/masukkan-biaya-pod",
                        data: data,

                        success: function (response) {
                            // console.log(response);
                            toast
                                .fire({
                                    icon: "success",
                                    title: "Biaya POD Dimasukkan",
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

function detail_kontainer(e) {
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
