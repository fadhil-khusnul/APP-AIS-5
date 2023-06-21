function detail(e) {
    let id = e.value;
    // console.log(id);
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

            var seals = [""];
            var spk = response.spks;

            for (let i = 0; i < response.seal_containers.length; i++) {
                seals[i] = response.seal_containers[i].seal_kontainer;
            }
            // for (let i = 0; i < response.spks.length; i++) {
            //     spk[i] = response.spks[i].spk_kontainer;
            // }
            // console.log(seals);
            $("#modal-job").modal("show");

            $("#size").val(response.result.size);
            $("#type").val(response.result.type);
            $("#nomor_kontainer").val(response.result.nomor_kontainer);
            $("#cargo").val(response.result.cargo);
            $("#detail_barang").val(response.result.detail_barang);
            $("#seal")
                .val(seals)
                .select2({
                    dropdownAutoWidth: true,
                    // tags: true,
                    placeholder: "Silahkan Pilih Seal",
                    // allowClear:true,
                    maximumSelectionLength: 4,
                    dropdownParent: $("#modal-job"),
                })
                .on("select2:select", function (e) {
                    var selected_element = $(e.currentTarget);
                    var select_val = selected_element.val();

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
                            var seal = $("#seal").val();
                            // console.log(seal, response);
                            var last_seal = seal[seal.length - 1];
                            // console.log(seal, last_seal);
                            var count_seal = response.length;
                            var seal_already = [];
                            for (var i = 0; i < count_seal; i++) {
                                seal_already[i] = response[i].seal_kontainer;
                            }

                            if (seal_already.includes(last_seal)) {
                                swal.fire({
                                    title: "Seal Kontainer Sudah Dipakai",
                                    icon: "error",
                                    timer: 10e3,
                                    showConfirmButton: true,
                                }).then(() => {
                                    var wanted_option = $(
                                        '#seal option[value="' +
                                            last_seal +
                                            '"]'
                                    );
                                    wanted_option.prop("selected", false);
                                    $("#seal").trigger("change.select2");
                                });
                            } else {
                                $.ajax({
                                    url: "/getSealKontainer",
                                    type: "post",
                                    data: {
                                        _token: token,
                                        seal: last_seal,
                                    },
                                    success: function (response) {
                                        var harga_seal = document
                                            .getElementById("biaya_seal")
                                            .value.replace(/\./g, "");
                                        harga_seal = parseFloat(harga_seal);

                                        if (isNaN(harga_seal)) {
                                            harga_seal = 0;
                                        }

                                        var harga_seal_now =
                                            harga_seal + response;
                                        $("#biaya_seal").val(harga_seal_now);
                                    },
                                });
                            }
                        },
                    });
                });
            $("#seal")
                .val(seals)
                .select2({
                    dropdownAutoWidth: true,
                    // tags: true,
                    placeholder: "Silahkan Pilih Seal",
                    // allowClear:true,
                    maximumSelectionLength: 4,
                    dropdownParent: $("#modal-job"),
                })
                .on("select2:unselect", function (e) {
                    // var seal = $("#seal").val();
                    // console.log(seal);
                    // var last_seal = seal[seal.length - 1];

                    var selected_element = $(e.currentTarget);
                    var select_val = selected_element.val();

                    var element = e.params.data.element;
                    var $element = $(element);

                    let token = $("#csrf").val();

                    $element.detach();
                    $(this).append($element);
                    $(this).trigger("change");

                    $.ajax({
                        url: "/getSealKontainer",
                        type: "post",
                        data: {
                            _token: token,
                            seal: element.value,
                        },
                        success: function (response) {
                            var harga_seal = document
                                .getElementById("biaya_seal")
                                .value.replace(/\./g, "");
                            harga_seal = parseFloat(harga_seal);

                            if (isNaN(harga_seal)) {
                                harga_seal = 0;
                            }

                            var harga_seal_now = harga_seal - response;
                            $("#biaya_seal").val(harga_seal_now);
                        },
                    });
                });
            $("#spk")
                .val(spk)
                .select2({
                    dropdownAutoWidth: true,
                    placeholder: "Silahkan Pilih",
                    // allowClear:true,
                    maximumSelectionLength: 4,
                    dropdownParent: $("#modal-job"),
                })
                .change(function () {
                    var select_val = $(this).val();
                    console.log(select_val);
                    let token = $("#csrf").val();
                    $.ajax({
                        url: "/getSpkKontainer",
                        type: "post",
                        data: {
                            _token: token,
                            spk: select_val,
                        },
                        success: function (response) {
                            $("#biaya_stuffing").val(response);
                        },
                    });
                });

            $("#date_activity").val(response.result.date_activity);
            $("#lokasi")
                .val(response.result.lokasi_depo)
                .select2({
                    dropdownAutoWidth: true,
                    placeholder: "Silahkan Pilih Lokasi Pickup",
                    allowClear: true,
                    dropdownParent: $("#modal-job"),
                });
            $("#pengirim")
                .val(response.result.pengirim)
                .select2({
                    dropdownAutoWidth: true,
                    placeholder: "Silahkan Pilih Pengirim",
                    allowClear: true,
                    dropdownParent: $("#modal-job"),
                });
            $("#penerima")
                .val(response.result.penerima)
                .select2({
                    dropdownAutoWidth: true,
                    placeholder: "Silahkan Pilih penerima",
                    allowClear: true,
                    dropdownParent: $("#modal-job"),
                });
            $("#pod_container")
                .val(response.result.pod_container)
                .select2({
                    dropdownAutoWidth: true,
                    placeholder: "Silahkan Pilih POD",
                    allowClear: true,
                    dropdownParent: $("#modal-job"),
                });

            $("#driver")
                .val(response.result.driver)
                .select2({
                    dropdownAutoWidth: true,
                    placeholder: "Silahkan Pilih Supir",
                    allowClear: true,
                    dropdownParent: $("#modal-job"),
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
                            $("#nomor_polisi")
                                .select2({
                                    dropdownAutoWidth: true,
                                    // placeholder: "Silahkan Pilih Supir",
                                    allowClear: true,
                                    dropdownParent: $("#modal-job"),
                                })
                                .html(result);
                        },
                    });
                });

            $("#new_id").val(response.result.id);
            $("#nomor_polisi").val(response.result.nomor_polisi);
            $("#remark").val(response.result.remark);
            $("#biaya_stuffing").val(response.result.biaya_stuffing);
            $("#biaya_trucking").val(response.result.biaya_trucking);
            $("#biaya_thc").val(response.result.biaya_thc);
            $("#jenis_mobil").val(response.result.jenis_mobil);
            $("#dana")
                .val(response.result.dana)
                .select2({
                    dropdownAutoWidth: true,
                    placeholder: "Silahkan Pilih Deposit Trucking",
                    allowClear: true,
                    dropdownParent: $("#modal-job"),
                });

            // var ongkos_supir = document.getElementById("ongkos_supir").value;
            // var biaya_trucking = document.getElementById("biaya_trucking").value;

            // console.log(ongkos_supir, biaya_trucking);

            // var biaya_trucking = document.getElementById("biaya_trucking").value.replace(/\./g, "");

            // $.validator.addMethod(
            //     "biggerThen",
            //     function (value, element, arg) {
            //         var biaya_trucking = document.getElementById("biaya_trucking").value.replace(/\./g, "");
            //     },
            //     "Value must not equal arg."
            // );
            $("#valid_job").validate({
                ignore: "select[type=hidden]",

                rules: {
                    size: {
                        required: true,
                    },
                    // ongkos_supir: {
                    //     remote: {
                    //         url: "/checkOngkosSupir",
                    //         type: "post",
                    //         // async: false,
                    //         data: {
                    //             _token: $("#csrf").val(),
                    //             // 'ongkos_supir': $("#ongkos_supir").val().replace(/\./g, ""),
                    //             biaya_trucking: $("#biaya_trucking")
                    //                 .val()
                    //                 .replace(/\./g, ""),
                    //         },
                    //     },
                    // },
                },
                messages: {
                    size: {
                        required: "Silakan Pilih Size",
                    },
                    // ongkos_supir: {
                    //     remote: "Ongkos Supir Harus Lebih Kecil Dari Biaya Trucking",
                    // },
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
                    var new_id = document.getElementById("new_id").value;
                    // console.log(new_id);
                    var token = $("#csrf").val();

                    let date_activity =
                        document.getElementById("date_activity").value;
                    var tempDate;
                    var formattedDate;

                    tempDate = new Date(date_activity);
                    formattedDate = [
                        tempDate.getFullYear(),
                        tempDate.getMonth() + 1,
                        tempDate.getDate(),
                    ].join("-");

                    $.ajax({
                        url: "/detail-kontainer-update/" + new_id,
                        type: "PUT",
                        data: {
                            _token: token,
                            job_id: $("#job_id").val(),
                            size: $("#size").val(),
                            type: $("#type").val(),
                            nomor_kontainer: $("#nomor_kontainer").val(),
                            cargo: $("#cargo").val(),
                            detail_barang: $("#detail_barang").val(),
                            seal: $("#seal").val(),
                            date_activity: formattedDate,
                            lokasi: $("#lokasi").val(),
                            pod_container: $("#pod_container").val(),
                            pot_container: $("#pot_container").val(),
                            vessel_pot: $("#vessel_pot").val(),
                            kode_vessel_pot: $("#kode_vessel_pot").val(),
                            penerima: $("#penerima").val(),
                            pengirim: $("#pengirim").val(),
                            driver: $("#driver").val(),
                            nomor_polisi: $("#nomor_polisi").val(),
                            remark: $("#remark").val(),
                            biaya_stuffing: $("#biaya_stuffing")
                                .val()
                                .replace(/\./g, ""),
                            biaya_trucking: $("#biaya_trucking")
                                .val()
                                .replace(/\./g, ""),
                            ongkos_supir: $("#ongkos_supir")
                                .val()
                                .replace(/\./g, ""),
                            biaya_thc: $("#biaya_thc").val().replace(/\./g, ""),
                            biaya_seal: $("#biaya_seal")
                                .val()
                                .replace(/\./g, ""),
                            freight: $("#freight").val().replace(/\./g, ""),
                            lss: $("#lss").val().replace(/\./g, ""),
                            jenis_mobil: $("#jenis_mobil").val(),
                            dana: $("#dana").val(),
                            spk: $("#spk").val(),
                        },
                        success: function (response) {
                            swal.fire({
                                icon: "success",
                                title: "Detail Kontainer Berhasil Diinput",
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

function delete_kontainerDB(r) {
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
        title: "Apakah anda yakin Ingin Menghapus CONTAINER INI ?",
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
                old_slug: old_slug,
            };
            $.ajax({
                type: "DELETE",
                url: "/container-delete/" + deleteid,
                data: data,
                // contentType: false,
                // processData: false,
                // dataType: "json",
                success: function (response) {
                    swal.fire({
                        title: "Container BERHASIL DIHAPUS",
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

function detail_tambah() {
    $("#modal-job-tambah").modal("show");
    var swal = Swal.mixin({
        customClass: {
            confirmButton: "btn btn-success btn-wide mx-1",
            denyButton: "btn btn-secondary btn-wide mx-1",
            cancelButton: "btn btn-danger btn-wide mx-1",
        },
        buttonsStyling: false,
    });

    $("#lokasi_tambah").select2({
        dropdownAutoWidth: true,
        placeholder: "Silahkan Pilih Lokasi",
        allowClear: true,
        dropdownParent: $("#modal-job-tambah"),
    });
    $("#pengirim_tambah").select2({
        dropdownAutoWidth: true,
        placeholder: "Silahkan Pilih Pengirim",
        allowClear: true,
        dropdownParent: $("#modal-job-tambah"),
    });
    $("#penerima_tambah").select2({
        dropdownAutoWidth: true,
        placeholder: "Silahkan Pilih Penerima",
        allowClear: true,
        dropdownParent: $("#modal-job-tambah"),
    });
    $("#pod_container_tambah").select2({
        dropdownAutoWidth: true,
        placeholder: "Silahkan Pilih POD",
        allowClear: true,
        dropdownParent: $("#modal-job-tambah"),
    });
    $("#spk_tambah")
        .select2({
            dropdownAutoWidth: true,
            placeholder: "Silahkan Pilih",
            // allowClear:true,
            maximumSelectionLength: 4,
            dropdownParent: $("#modal-job-tambah"),
        })
        .change(function () {
            var select_val = $(this).val();

            console.log(select_val);

            let token = $("#csrf").val();

            $.ajax({
                url: "/getSpkKontainer",
                type: "post",
                data: {
                    _token: token,
                    spk: select_val,
                },
                success: function (response) {
                    console.log(response);
                    $("#biaya_stuffing_tambah").val(response);
                },
            });
        });

    $("#seal_tambah")
        .select2({
            dropdownAutoWidth: true,
            // tags: true,
            placeholder: "Silahkan Pilih",
            // allowClear:true,
            maximumSelectionLength: 4,
            dropdownParent: $("#modal-job-tambah"),
        })
        .on("select2:select", function (e) {
            var selected_element = $(e.currentTarget);
            var select_val = selected_element.val();
            // console.log(select_val);

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
                    var seal = $("#seal_tambah").val();
                    var last_seal = seal[seal.length - 1];
                    // console.log(seal, last_seal);
                    var count_seal = response.length;
                    var seal_already = [];
                    for (var i = 0; i < count_seal; i++) {
                        seal_already[i] = response[i].seal_kontainer;
                    }

                    if (seal_already.includes(last_seal)) {
                        swal.fire({
                            title: "Seal Kontainer Sudah Ada",
                            text: "Silakan Masukkan Seal yang Lain",
                            icon: "error",
                            timer: 10e3,
                            showConfirmButton: true,
                        }).then(() => {
                            var wanted_option = $(
                                '#seal_tambah option[value="' + last_seal + '"]'
                            );

                            wanted_option.prop("selected", false);
                            $("#seal_tambah").trigger("change.select2");
                        });
                    } else {
                        $.ajax({
                            url: "/getSealKontainer",
                            type: "post",
                            data: {
                                _token: token,
                                seal: last_seal,
                            },
                            success: function (response) {
                                var harga_seal = document
                                    .getElementById("biaya_seal_tambah")
                                    .value.replace(/\./g, "");
                                harga_seal = parseFloat(harga_seal);

                                if (isNaN(harga_seal)) {
                                    harga_seal = 0;
                                }

                                var harga_seal_now = harga_seal + response;
                                $("#biaya_seal_tambah").val(harga_seal_now);
                            },
                        });
                    }
                },
            });
        });
    $("#seal_tambah")
        .select2({
            dropdownAutoWidth: true,
            // tags: true,
            placeholder: "Silahkan Pilih Seal",
            // allowClear:true,
            maximumSelectionLength: 4,
            dropdownParent: $("#modal-job-tambah"),
        })
        .on("select2:unselect", function (e) {
            // var seal = $("#seal").val();
            // console.log(seal);
            // var last_seal = seal[seal.length - 1];

            var selected_element = $(e.currentTarget);
            var select_val = selected_element.val();

            var element = e.params.data.element;
            var $element = $(element);

            let token = $("#csrf").val();

            $element.detach();
            $(this).append($element);
            $(this).trigger("change");

            $.ajax({
                url: "/getSealKontainer",
                type: "post",
                data: {
                    _token: token,
                    seal: element.value,
                },
                success: function (response) {
                    var harga_seal = document
                        .getElementById("biaya_seal_tambah")
                        .value.replace(/\./g, "");
                    harga_seal = parseFloat(harga_seal);

                    if (isNaN(harga_seal)) {
                        harga_seal = 0;
                    }

                    var harga_seal_now = harga_seal - response;
                    $("#biaya_seal_tambah").val(harga_seal_now);
                },
            });
        });

    $("#dana_tambah").select2({
        dropdownAutoWidth: true,
        placeholder: "Silahkan Pilih",
        allowClear: true,
        dropdownParent: $("#modal-job-tambah"),
    });

    $("#driver_tambah")
        .select2({
            dropdownAutoWidth: true,
            placeholder: "Silahkan Pilih Vendor",
            allowClear: true,
            dropdownParent: $("#modal-job-tambah"),
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
                    $("#nomor_polisi_tambah")
                        .select2({
                            dropdownAutoWidth: true,
                            placeholder: "Silahkan Pilih Supir",
                            allowClear: true,
                            dropdownParent: $("#modal-job-tambah"),
                        })
                        .html(result);
                },
            });
        });

    $("#valid_job_tambah").validate({
        ignore: "select[type=hidden]",

        rules: {
            size: {
                required: true,
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
            var token = $("#csrf").val();

            let date_activity = document.getElementById(
                "date_activity_tambah"
            ).value;
            var tempDate;
            var formattedDate;

            tempDate = new Date(date_activity);
            formattedDate = [
                tempDate.getFullYear(),
                tempDate.getMonth() + 1,
                tempDate.getDate(),
            ].join("-");

            var data = {
                _token: token,
                job_id: $("#job_id").val(),
                pengirim: $("#pengirim_tambah").val(),
                penerima: $("#penerima_tambah").val(),
                size: $("#size_tambah").val(),
                type: $("#type_tambah").val(),
                nomor_kontainer: $("#nomor_kontainer_tambah").val(),
                cargo: $("#cargo_tambah").val(),
                detail_barang: $("#detail_barang_tambah").val(),
                seal: $("#seal_tambah").val(),
                spk: $("#spk_tambah").val(),
                date_activity: formattedDate,
                lokasi: $("#lokasi_tambah").val(),
                pod_container: $("#pod_container_tambah").val(),
                pot_container: $("#pot_container_tambah").val(),
                kode_vessel_pot: $("#kode_vessel_pot_tambah").val(),
                vessel_pot: $("#vessel_pot_tambah").val(),
                driver: $("#driver_tambah").val(),
                nomor_polisi: $("#nomor_polisi_tambah").val(),
                remark: $("#remark_tambah").val(),
                biaya_stuffing: $("#biaya_stuffing_tambah")
                    .val()
                    .replace(/\./g, ""),
                biaya_trucking: $("#biaya_trucking_tambah")
                    .val()
                    .replace(/\./g, ""),
                ongkos_supir: $("#ongkos_supir_tambah")
                    .val()
                    .replace(/\./g, ""),
                biaya_thc: $("#biaya_thc_tambah").val().replace(/\./g, ""),
                biaya_seal: $("#biaya_seal_tambah").val().replace(/\./g, ""),
                freight: $("#freight_tambah").val().replace(/\./g, ""),
                lss: $("#lss_tambah").val().replace(/\./g, ""),
                jenis_mobil: $("#jenis_mobil_tambah").val(),
                dana: $("#dana_tambah").val(),
            };

            $.ajax({
                url: "/detail-kontainer-tambah",
                type: "POST",
                data: data,
                success: function (response) {
                    swal.fire({
                        icon: "success",
                        title: "Detail Kontainer Berhasil Ditambah",
                        showConfirmButton: false,
                        timer: 2e3,
                    }).then((result) => {
                        location.reload();
                    });
                },
            });
        },
    });
}

function detail_update(e) {
    let id = e.value;
    // console.log(id);
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
            // console.log(new_id);

            console.log(response);

            var seals = [""];
            var spk = response.spks;

            console.log(spk);
            var supir = [""];

            for (let i = 0; i < response.seal_containers.length; i++) {
                seals[i] = response.seal_containers[i].seal_kontainer;
            }
            // for (let i = 0; i < response.spks.length; i++) {
            //     spk[i] = response.spks[i].spk_kontainer;
            // }
            // for (let i = 0; i < response.supirs.length; i++) {
            //     supir +=
            //         "<option value='" +
            //         response.supirs[i].id +
            //         "'>" +
            //         response.supirs[i].nama_vendor +
            //         "</option>";
            // }
            $("#modal-job-update").modal("show");

            $("#size_update").val(response.result.size);
            $("#kode_vessel_pot_update").val(response.result.kode_vessel_pot);
            $("#vessel_pot_update").val(response.result.vessel_pot);
            $("#pod_container_update")
                .val(response.result.pod_container)
                .select2({
                    dropdownAutoWidth: true,
                    placeholder: "Silahkan Pilih",
                    allowClear: true,
                    dropdownParent: $("#modal-job-update"),
                });
            $("#pot_container_update")
                .val(response.result.pot_container)
                .select2({
                    dropdownAutoWidth: true,
                    placeholder: "Silahkan Pilih",
                    allowClear: true,
                    dropdownParent: $("#modal-job-update"),
                });
            $("#type_update").val(response.result.type);
            $("#nomor_kontainer_update").val(response.result.nomor_kontainer);
            $("#no_container_edit").val(response.result.nomor_kontainer);
            $("#cargo_update").val(response.result.cargo);
            $("#old_ongkos_supir").val(response.result.ongkos_supir);
            $("#old_dana").val(response.result.dana);
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
                                        wanted_option.prop("selected", false);
                                        // $(this).trigger("change.select2");
                                        $("#seal_update").trigger(
                                            "change.select2"
                                        );
                                    });
                                } else {
                                    $.ajax({
                                        url: "/getSealKontainer",
                                        type: "post",
                                        data: {
                                            _token: token,
                                            seal: last_seal,
                                        },
                                        success: function (response) {
                                            var harga_seal = document
                                                .getElementById(
                                                    "biaya_seal_update"
                                                )
                                                .value.replace(/\./g, "");
                                            harga_seal = parseFloat(harga_seal);

                                            if (isNaN(harga_seal)) {
                                                harga_seal = 0;
                                            }

                                            var harga_seal_now =
                                                harga_seal + response;
                                            $("#biaya_seal_update").val(
                                                harga_seal_now
                                            );
                                        },
                                    });
                                }
                            }
                        },
                    });
                });
            $("#seal_update")
                .val(seals)
                .select2({
                    dropdownAutoWidth: true,
                    // tags: true,
                    placeholder: "Silahkan Pilih Seal",
                    // allowClear:true,
                    maximumSelectionLength: 4,
                    dropdownParent: $("#modal-job-update"),
                })
                .on("select2:unselect", function (e) {
                    // var seal = $("#seal").val();
                    // console.log(seal);
                    // var last_seal = seal[seal.length - 1];

                    var selected_element = $(e.currentTarget);
                    var select_val = selected_element.val();

                    var element = e.params.data.element;
                    var $element = $(element);

                    let token = $("#csrf").val();

                    $element.detach();
                    $(this).append($element);
                    $(this).trigger("change");

                    $.ajax({
                        url: "/getSealKontainer",
                        type: "post",
                        data: {
                            _token: token,
                            seal: element.value,
                        },
                        success: function (response) {
                            var harga_seal = document
                                .getElementById("biaya_seal_update")
                                .value.replace(/\./g, "");
                            harga_seal = parseFloat(harga_seal);

                            if (isNaN(harga_seal)) {
                                harga_seal = 0;
                            }

                            var harga_seal_now = harga_seal - response;
                            $("#biaya_seal_update").val(harga_seal_now);
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
                    var select_val = $(this).val();

                    let token = $("#csrf").val();
                    $.ajax({
                        url: "/getSpkProcess",
                        async: false,
                        type: "post",
                        data: {
                            _token: token,
                            spk: select_val,
                        },
                        success: function (response) {
                            if (response == "Container" && select_val != spk) {
                                swal.fire({
                                    title: "SPK Kontainer Sudah Dipakai",
                                    icon: "error",
                                    timer: 10e3,
                                    showConfirmButton: true,
                                }).then(() => {
                                    $("#spk_update")
                                        .val(null)
                                        .trigger("change");
                                    $("#biaya_stuffing_update").val(null);
                                });
                            } else {
                                $.ajax({
                                    url: "/getSpkKontainer",
                                    type: "post",
                                    data: {
                                        _token: token,
                                        spk: select_val,
                                    },
                                    success: function (response) {
                                        $("#biaya_stuffing_update").val(
                                            response
                                        );
                                    },
                                });
                            }
                        },
                    });
                });

            var old_tanggal_result = moment(
                response.result.date_activity,
                "YYYY-MM-DD"
            ).format("dddd, DD MMMM YYYY");
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
                .val(response.result.nomor_polisi)
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
                    // console.log(new_id);
                    // console.log(id);
                    var token = $("#csrf").val();

                    let date_activity = document.getElementById(
                        "date_activity_update"
                    ).value;
                    var tempDate;
                    var formattedDate;

                    console.log(date_activity);

                    tempDate = new Date(date_activity);
                    console.log(tempDate);
                    formattedDate = [
                        tempDate.getFullYear(),
                        tempDate.getMonth() + 1,
                        tempDate.getDate(),
                    ].join("-");

                    console.log(formattedDate);

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
                            pod_container: $("#pod_container_update").val(),
                            pot_container: $("#pot_container_update").val(),
                            vessel_pot: $("#vessel_pot_update").val(),
                            kode_vessel_pot: $("#kode_vessel_pot_update").val(),
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
                            old_ongkos_supir: $("#old_ongkos_supir").val(),
                            old_dana: $("#old_dana").val(),
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
function detail_disabled(e) {
    let id = e.value;
    // console.log(id);
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
            // console.log(new_id);

            var seals = [""];
            var spk = response.spks;
            var supir = [""];

            for (let i = 0; i < response.seal_containers.length; i++) {
                seals[i] = response.seal_containers[i].seal_kontainer;
            }
            // for (let i = 0; i < response.spks.length; i++) {
            //     spk[i] = response.spks[i].spk_kontainer;
            // }
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
            // console.log(seals);
            $("#modal-job-disabled").modal("show");

            $("#size_disabled").val(response.result.size);
            $("#type_disabled").val(response.result.type);
            $("#nomor_kontainer_disabled").val(response.result.nomor_kontainer);
            $("#no_container_edit").val(response.result.nomor_kontainer);
            $("#cargo_disabled").val(response.result.cargo);
            $("#detail_barang_disabled").val(response.result.detail_barang);
            $("#seal_old").val(seals);

            $("#seal_disabled")
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
                            var seal = $("#seal_disabled").val();
                            var last_seal = seal[seal.length - 1];
                            // console.log(seal, last_seal);
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
                                            '#seal_disabled option[value="' +
                                                last_seal +
                                                '"]'
                                        );
                                        // console.log(wanted_option);

                                        wanted_option.prop("selected", false);
                                        // $(this).trigger("change.select2");
                                        $("#seal_disabled").trigger(
                                            "change.select2"
                                        );
                                    });
                                }
                            }
                        },
                    });
                });
            $("#spk_disabled")
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
                            var seal = $("#spk_disabled").val();
                            var last_seal = seal[seal.length - 1];
                            // console.log(seal, last_seal);
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
                                            '#spk_disabled option[value="' +
                                                last_seal +
                                                '"]'
                                        );
                                        // console.log(wanted_option);

                                        wanted_option.prop("selected", false);
                                        // $(this).trigger("change.select2");
                                        $("#spk_disabled").trigger(
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
            $("#date_activity_disabled").val(old_tanggal_result);
            $("#lokasi_disabled")
                .val(response.result.lokasi_depo)
                .select2({
                    dropdownAutoWidth: true,
                    placeholder: "Silahkan Pilih",
                    allowClear: true,
                    dropdownParent: $("#modal-job-update"),
                });
            $("#pengirim_disabled")
                .val(response.result.pengirim)
                .select2({
                    dropdownAutoWidth: true,
                    placeholder: "Silahkan Pilih Pengirim",
                    allowClear: true,
                    dropdownParent: $("#modal-job-update"),
                });
            $("#penerima_disabled")
                .val(response.result.penerima)
                .select2({
                    dropdownAutoWidth: true,
                    placeholder: "Silahkan Pilih penerima",
                    allowClear: true,
                    dropdownParent: $("#modal-job-update"),
                });

            $("#new_id_disabled").val(response.result.id);
            $("#nomor_polisi_disabled")
                .html(supir)
                .select2({
                    dropdownAutoWidth: true,
                    placeholder: "Silahkan Pilih Supir",
                    allowClear: true,
                    dropdownParent: $("#modal-job-update"),
                });
            $("#driver_disabled")
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
                            $("#nomor_polisi_disabled")
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
            $("#remark_disabled").val(response.result.remark);
            $("#biaya_stuffing_disabled").val(response.result.biaya_stuffing);
            $("#biaya_trucking_disabled").val(response.result.biaya_trucking);
            $("#biaya_thc_disabled").val(response.result.biaya_thc);
            $("#ongkos_supir_disabled").val(response.result.ongkos_supir);
            $("#biaya_seal_disabled").val(response.result.biaya_seal);
            $("#freight_disabled").val(response.result.freight);
            $("#lss_disabled").val(response.result.lss);
            $("#jenis_mobil_disabled").val(response.result.jenis_mobil);
            $("#dana_disabled")
                .val(response.result.dana)
                .select2({
                    dropdownAutoWidth: true,
                    placeholder: "Silahkan Pilih Deposit Trucking",
                    allowClear: true,
                    dropdownParent: $("#modal-job-update"),
                });
        },
    });
}

function realisasi_page(slug) {
    var slugs = slug.value;

    // console.log(slugs);

    var swal = Swal.mixin({
        customClass: {
            confirmButton: "btn btn-label-success btn-wide mx-1",
            denyButton: "btn btn-label-secondary btn-wide mx-1",
            cancelButton: "btn btn-label-danger btn-wide mx-1",
        },
        buttonsStyling: false,
    });

    swal.fire({
        title: "Apakah anda yakin Ingin Beralih Ke Halaman Realisasi Untuk JOB ini ?",
        icon: "warning",
        showCancelButton: true,
        confirmButtonText: "Iya",
        cancelButtonText: "Tidak",
    }).then((willCreate) => {
        if (willCreate.isConfirmed) {
            window.location.href = "/realisasi-load-create/" + slugs;

            swal.fire({
                title: "BERALIH BERHASIL",
                icon: "success",
                timer: 9e3,
                showConfirmButton: true,
            });
        } else {
            swal.fire({
                title: "Batal Beralih Halaman",
                icon: "error",
                timer: 10e3,
                showConfirmButton: true,
            });
        }
    });
}

function detail_biaya_lain() {
    $("#modal_biaya_lainnya").modal("show");

    $("#valid_biaya_lainnya").validate({
        ignore: "select[type=hidden]",

        rules: {
            size: {
                required: true,
            },
        },
        messages: {},
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
            var token = $("#csrf").val();

            var data = {
                _token: token,
                job_id: $("#job_id").val(),
                kontainer_biaya: $("#kontainer_biaya").val(),
                harga_biaya: $("#harga_biaya").val().replace(/\./g, ""),
                keterangan: $("#keterangan").val(),
            };

            $.ajax({
                url: "/biayalain-kontainer",
                type: "POST",
                data: data,
                success: function (response) {
                    swal.fire({
                        icon: "success",
                        title: "Biaya Lain Berhasil Dimasukkan",
                        showConfirmButton: false,
                        timer: 2e3,
                    }).then((result) => {
                        location.reload();
                    });
                },
            });
        },
    });
}
function detail_biaya_lain_edit(e) {
    let id = e.value;
    // console.log(id);

    $.ajax({
        url: "/biayalainnya-edit/" + id,
        type: "GET",
        success: function (response) {
            $("#modal_biaya_lainnya_edit").modal("show");

            $("#id_lama_biaya").val(response.result.id);
            $("#old_id_container_biaya").val(response.result.kontainer_id);
            $("#kontainer_biaya_edit")
                .val(response.result.kontainer_id)
                .is(":selected");
            $("#harga_biaya_edit").val(response.result.harga_biaya);
            $("#keterangan_edit").val(response.result.keterangan);

            $("#valid_biaya_lainnya_edit").validate({
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
                    var old_id_container_biaya = document.getElementById(
                        "old_id_container_biaya"
                    ).value;
                    var id_lama_biaya =
                        document.getElementById("id_lama_biaya").value;
                    // console.log(id_lama_biaya);
                    var token = $("#csrf").val();

                    var data = {
                        _token: token,
                        job_id: $("#job_id").val(),
                        kontainer_biaya: $("#kontainer_biaya_edit").val(),
                        old_id_container_biaya: old_id_container_biaya,
                        harga_biaya: $("#harga_biaya_edit")
                            .val()
                            .replace(/\./g, ""),
                        keterangan: $("#keterangan_edit").val(),
                    };

                    $.ajax({
                        url: "/biayalainnya-update/" + id_lama_biaya,
                        type: "PUT",
                        data: data,
                        success: function (response) {
                            swal.fire({
                                icon: "success",
                                title: "Biaya Lainnya Berhasil Diupdate",
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

function delete_laiannyaDB(r) {
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
        title: "Apakah anda yakin Ingin Menghapus Biaya Lain Kontainer INI ?",
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
                old_slug: old_slug,
            };
            $.ajax({
                type: "DELETE",
                url: "/biayalainnya-delete/" + deleteid,
                data: data,
                // contentType: false,
                // processData: false,
                // dataType: "json",
                success: function (response) {
                    swal.fire({
                        title: "Biaya Lainnya Berhasil DIHAPUS",
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
                showConfirmButton: false,
            });
        }
    });
}

function detail_barang() {
    $("#modal_detail_barang").modal("show");

    $("#valid_detail_barang").validate({
        ignore: "select[type=hidden]",

        rules: {
            size: {
                required: true,
            },
        },
        messages: {},
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
            var token = $("#csrf").val();
            console.log(urutan_detail);

            var detail_barang = [];

            for (let i = 0; i < urutan_detail; i++) {
                detail_barang[i] = document.getElementById(
                    "detail_barang[" + (i + 1) + "]"
                ).value;
            }

            var data = {
                _token: token,
                job_id: $("#job_id").val(),
                kontainer_id: $("#kontainer_detail").val(),
                detail_barang: detail_barang,
            };

            $.ajax({
                url: "/detailbarang-kontainer",
                type: "POST",
                data: data,
                success: function (response) {
                    swal.fire({
                        icon: "success",
                        title: "Detail Barang Berhasil Dimasukkan",
                        showConfirmButton: false,
                        timer: 2e3,
                    }).then((result) => {
                        location.reload();
                    });
                },
            });
        },
    });
}
var edit_urutan_detail = 0;

function detail_barang_edit(e) {
    let id = e.value;
    // console.log(id);

    $.ajax({
        url: "/detailbarang-edit/" + id,
        type: "GET",
        success: function (response) {
            $("#modal_detail_barang_edit").modal("show");
            document.getElementById("edit_div_detail").innerHTML = "";
            console.log(response);
            $("#old_id_container_detail").val(response.result[0].kontainer_id);
            $("#kontainer_detail_edit")
                .val(response.result[0].kontainer_id)
                .is(":selected");
            console.log(response.result[0].kontainer_id, id);

            edit_urutan_detail = response.result.length;
            console.log(edit_urutan_detail);

            var div1 = document.getElementById("edit_div_detail");


            for (var i = 0; i < edit_urutan_detail; i++) {
                var div2 = document.createElement("div");
                div2.setAttribute("class", "row row-cols g-3");
                div2.setAttribute("id", "edit_body_detail[" + (i + 1) + "]");

                var label = document.createElement("label");
                label.setAttribute("class", "col-sm-4 col-form-label");
                label.setAttribute("id", "edit_label_detail");
                label.setAttribute("name", "edit_label_detail");

                var div3 = document.createElement("div");
                div3.setAttribute(
                    "class",
                    "col-sm-6 validation-container d-grid gap-3"
                );
                div3.setAttribute("id", "edit_div_textarea");
                div3.setAttribute("name", "edit_div_textarea");
                var textarea = document.createElement("textarea");
                textarea.setAttribute("data-bs-toggle", "tooltip");
                textarea.setAttribute("class", "form-control");
                textarea.setAttribute(
                    "id",
                    "edit_detail_barang[" + (i + 1) + "]"
                );
                textarea.setAttribute("name", "edit_detail_barang");
                textarea.setAttribute("style", "margin-left: 10px");
                textarea.setAttribute("required", true);
                div3.append(textarea);

                var div4 = document.createElement("div");
                div4.setAttribute("class", "col-sm-2 py-4");
                div4.setAttribute("id", "edit_div_button");
                div4.setAttribute("name", "edit_div_button");
                var button = document.createElement("a");
                button.setAttribute(
                    "class",
                    "btn btn-sm btn-label-danger btn-icon"
                );
                button.setAttribute(
                    "id",
                    "edit_delete_detail[" + (i + 1) + "]"
                );
                button.setAttribute("name", "edit_delete_detail");
                button.setAttribute("style", "margin-left: 10px;");
                button.setAttribute("onclick", "edit_delete_detail(this)");
                icon = document.createElement("i");
                icon.setAttribute("class", "fa fa-trash");
                button.append(icon);
                div4.append(button);

                div2.append(label);
                div2.append(div3);
                div2.append(div4);

                div1.appendChild(div2);

                reindex_edit_detail();
            }

            for(var i = 0; i < edit_urutan_detail; i++) {
                document.getElementById("edit_detail_barang[" + (i + 1) + "]").value = response.result[i].detail_barang;
            }


            // reindex_detail();

            // var div2 = document.createElement("div");
            // $("#detail_barang_edit").val(response.result.detail_barang);

            $("#valid_detail_barang_edit").validate({
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
                    var old_id_container_detail = document.getElementById(
                        "old_id_container_detail"
                    ).value;

                    var detail_barang = [];

                    for (let i = 0; i < edit_urutan_detail; i++) {
                        detail_barang[i] = document.getElementById(
                            "edit_detail_barang[" + (i + 1) + "]"
                        ).value;
                    }

                    // console.log(id_lama_detail);
                    var token = $("#csrf").val();

                    var data = {
                        _token: token,
                        job_id: $("#job_id").val(),
                        kontainer_id: $("#kontainer_detail_edit").val(),
                        old_id_container_detail: old_id_container_detail,
                        detail_barang: detail_barang,
                    };

                    $.ajax({
                        url: "/detailbarang-update/" + old_id_container_detail,
                        type: "PUT",
                        data: data,
                        success: function (response) {
                            swal.fire({
                                icon: "success",
                                title: "Detail Barang Berhasil Diupdate",
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

function delete_detailbarangDB(r) {
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
        title: "Apakah anda yakin Ingin Menghapus Detail Barang Kontainer INI ?",
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
                old_slug: old_slug,
            };
            $.ajax({
                type: "DELETE",
                url: "/detailbarang-delete/" + deleteid,
                data: data,
                // contentType: false,
                // processData: false,
                // dataType: "json",
                success: function (response) {
                    swal.fire({
                        title: "DETAIL BARANG Berhasil DIHAPUS",
                        icon: "success",
                        timer: 9e3,
                        showConfirmButton: false,
                    });
                    window.location.reload();
                },
            });
        } else {
            swal.fire({
                title: "Detail Barang Kontainer Tidak Dihapus",
                icon: "error",
                timer: 3e3,
                showConfirmButton: false,
            });
        }
    });
}

function detail_batal_muat() {
    $("#modal_batal_muat").modal("show");

    $("#valid_batal_muat").validate({
        ignore: "select[type=hidden]",

        rules: {
            size: {
                required: true,
            },
        },
        messages: {},
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
            var token = $("#csrf").val();

            var data = {
                _token: token,
                job_id: $("#job_id").val(),
                kontainer_batal: $("#kontainer_batal").val(),
                harga_batal: $("#harga_batal").val().replace(/\./g, ""),
                keterangan_batal: $("#keterangan_batal").val(),
            };

            $.ajax({
                url: "/batalmuat-kontainer",
                type: "POST",
                data: data,
                success: function (response) {
                    swal.fire({
                        icon: "success",
                        title: "Kontainer Berhasil BATAL MUATAN",
                        showConfirmButton: false,
                        timer: 2e3,
                    }).then((result) => {
                        location.reload();
                    });
                },
            });
        },
    });
}

function detail_batal_muat_edit(e) {
    let id = e.value;
    // console.log(id);

    $.ajax({
        url: "/batalmuat-edit/" + id,
        type: "GET",
        success: function (response) {
            $("#modal_batal_muat_edit").modal("show");

            $("#id_lama_batal").val(response.result.id);
            $("#kontainer_batal_edit").val(response.result.id).is(":selected");
            $("#harga_batal_edit").val(response.result.harga_batal);
            $("#keterangan_batal_edit").val(response.result.keterangan_batal);

            $("#valid_batal_muat_edit").validate({
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
                    var id_lama_batal =
                        document.getElementById("id_lama_batal").value;
                    // console.log(id_lama_biaya);
                    var token = $("#csrf").val();

                    var data = {
                        _token: token,
                        job_id: $("#job_id").val(),
                        id_lama_batal: $("#id_lama_batal").val(),
                        kontainer_batal: $("#kontainer_batal_edit").val(),
                        harga_batal: $("#harga_batal_edit")
                            .val()
                            .replace(/\./g, ""),
                        keterangan_batal: $("#keterangan_batal_edit").val(),
                    };

                    $.ajax({
                        url: "/batalmuat-update/" + id_lama_batal,
                        type: "PUT",
                        data: data,
                        success: function (response) {
                            swal.fire({
                                icon: "success",
                                title: "Isi Batal Muat Berhasil Diupdate",
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

function delete_batalDB(r) {
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
        title: "Apakah anda yakin Ingin Mengembalikan Kontainer ini ?",
        icon: "warning",
        showCancelButton: true,
        confirmButtonText: "Iya",
        cancelButtonText: "Tidak",
    }).then((willCreate) => {
        if (willCreate.isConfirmed) {
            var data = {
                _token: $("input[name=_token]").val(),
                id: deleteid,
                // 'old_slug': old_slug,
            };
            $.ajax({
                type: "DELETE",
                url: "/batalmuat-delete/" + deleteid,
                data: data,
                // contentType: false,
                // processData: false,
                // dataType: "json",
                success: function (response) {
                    swal.fire({
                        title: "Kontainer Berhasil DIKEMBALIKAN",
                        icon: "success",
                        timer: 9e3,
                        showConfirmButton: false,
                    });
                    window.location.reload();
                },
            });
        } else {
            swal.fire({
                title: "Container TIDAK DIKEMBALIKAN",
                icon: "error",
                timer: 10e3,
                showConfirmButton: false,
            });
        }
    });
}

function detail_alih_kapal() {
    $("#modal_alih_kapal").modal("show");

    $("#select_company_alih").select2({
        dropdownAutoWidth: true,
        placeholder: "Silahkan Pilih Pelayaran",
        allowClear: true,
        dropdownParent: $("#modal_alih_kapal"),
    });
    $("#pot_alih").select2({
        dropdownAutoWidth: true,
        placeholder: "Silahkan Pilih POT",
        allowClear: true,
        dropdownParent: $("#modal_alih_kapal"),
    });
    $("#pod_alih").select2({
        dropdownAutoWidth: true,
        placeholder: "Silahkan Pilih POD",
        allowClear: true,
        dropdownParent: $("#modal_alih_kapal"),
    });

    $("#valid_alih_kapal").validate({
        ignore: "select[type=hidden]",

        rules: {
            size: {
                required: true,
            },
        },
        messages: {},
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
            var token = $("#csrf").val();

            var data = {
                _token: token,
                job_id: $("#job_id").val(),
                kontainer_alih: $("#kontainer_alih").val(),
                pelayaran_alih: $("#select_company_alih").val(),
                pot_alih: $("#pot_alih").val(),
                pod_alih: $("#pod_alih").val(),
                vessel_alih: $("#vessel_alih").val(),
                code_vesseL_alih: $("#vessel_code_alih").val(),
                harga_alih_kapal: $("#harga_alih").val().replace(/\./g, ""),
                keterangan_alih_kapal: $("#keterangan_alih").val(),
            };

            $.ajax({
                url: "/alihkapal-kontainer",
                type: "POST",
                data: data,
                success: function (response) {
                    swal.fire({
                        icon: "success",
                        title: "Kontainer Berhasil DIALIHKAPALKAN",
                        showConfirmButton: false,
                        timer: 2e3,
                    }).then((result) => {
                        location.reload();
                    });
                },
            });
        },
    });
}

function detail_alih_kapal_edit(e) {
    let id = e.value;
    // console.log(id);

    $.ajax({
        url: "/alihkapal-edit/" + id,
        type: "GET",
        success: function (response) {
            $("#modal_alih_kapal_edit").modal("show");

            $("#id_lama_alih").val(response.result.id);
            // console.log(response.result.kontainer_alih);
            $("#kontainer_alih_edit")
                .val(response.result.kontainer_alih)
                .is(":selected");
            $("#select_company_alih_edit")
                .val(response.result.pelayaran_alih)
                .select2({
                    dropdownAutoWidth: true,
                    placeholder: "Silahkan Pilih Pelayaran",
                    allowClear: true,
                    dropdownParent: $("#modal_alih_kapal_edit"),
                });
            $("#pot_alih_edit")
                .val(response.result.pot_alih)
                .select2({
                    dropdownAutoWidth: true,
                    placeholder: "Silahkan Pilih POT",
                    allowClear: true,
                    dropdownParent: $("#modal_alih_kapal_edit"),
                });
            $("#pod_alih_edit")
                .val(response.result.pod_alih)
                .select2({
                    dropdownAutoWidth: true,
                    placeholder: "Silahkan Pilih POD",
                    allowClear: true,
                    dropdownParent: $("#modal_alih_kapal_edit"),
                });
            $("#vessel_alih_edit").val(response.result.vesseL_alih);
            $("#vessel_code_alih_edit").val(response.result.code_vesseL_alih);
            $("#harga_alih_edit").val(response.result.harga_alih_kapal);
            $("#keterangan_alih_edit").val(
                response.result.keterangan_alih_kapal
            );

            $("#valid_alih_kapal_edit").validate({
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
                    var id_lama_alih =
                        document.getElementById("id_lama_alih").value;
                    // console.log(id_lama_biaya);
                    var token = $("#csrf").val();

                    var data = {
                        _token: token,
                        job_id: $("#job_id").val(),
                        kontainer_alih: $("#kontainer_alih_edit").val(),
                        pelayaran_alih: $("#select_company_alih_edit").val(),
                        pot_alih: $("#pot_alih_edit").val(),
                        pod_alih: $("#pod_alih_edit").val(),
                        vessel_alih: $("#vessel_alih_edit").val(),
                        code_vesseL_alih: $("#vessel_code_alih_edit").val(),
                        harga_alih_kapal: $("#harga_alih_edit")
                            .val()
                            .replace(/\./g, ""),
                        keterangan_alih_kapal: $("#keterangan_alih_edit").val(),
                    };

                    $.ajax({
                        url: "/alihkapal-update/" + id_lama_alih,
                        type: "PUT",
                        data: data,
                        success: function (response) {
                            swal.fire({
                                icon: "success",
                                title: "Isi Alih Kapal Berhasil Diupdate",
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

function delete_alihDB(r) {
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
        title: "Apakah anda yakin Ingin Mengembalikan Kontainer ini ?",
        icon: "warning",
        showCancelButton: true,
        confirmButtonText: "Iya",
        cancelButtonText: "Tidak",
    }).then((willCreate) => {
        if (willCreate.isConfirmed) {
            var data = {
                _token: $("input[name=_token]").val(),
                id: deleteid,
                // 'old_slug': old_slug,
            };
            $.ajax({
                type: "DELETE",
                url: "/alihkapal-delete/" + deleteid,
                data: data,
                // contentType: false,
                // processData: false,
                // dataType: "json",
                success: function (response) {
                    swal.fire({
                        title: "Kontainer Berhasil DIKEMBALIKAN",
                        icon: "success",
                        timer: 9e3,
                        showConfirmButton: false,
                    });
                    window.location.reload();
                },
            });
        } else {
            swal.fire({
                title: "Container TIDAK Dikambalikan",
                icon: "error",
                timer: 10e3,
                showConfirmButton: false,
            });
        }
    });
}

function edit_planloaad_job(e) {
    var id = e.value;
    var swal = Swal.mixin({
        customClass: {
            confirmButton: "btn btn-label-success btn-wide mx-1",
            denyButton: "btn btn-label-secondary btn-wide mx-1",
            cancelButton: "btn btn-label-danger btn-wide mx-1",
        },
        buttonsStyling: false,
    });

    $("#modal_edit_jobplanload").modal("show");

    $("#valid_job_edit_load").validate({
        rules: {
            activity: {
                required: true,
            },
            select_company: {
                required: true,
            },
            vessel: {
                required: true,
            },
            vessel_code: {
                required: true,
            },
            POL_1: {
                required: true,
            },

            // POD_1: {
            //     required: true,
            // },
            // Penerima_1: {
            //     required: true,
            // },
            // Pengirim_1: {
            //     required: true,
            // },
        },
        messages: {
            tanggal_planload: {
                required: "Silakan Isi Tanggal",
            },
            activity: {
                required: "Silakan Pilih Activity",
            },
            select_company: {
                required: "Silakan Pilih Nama Kompany",
            },
            vessel: {
                required: "Silakan Isi Vessel/Voyage",
            },
            vessel_code: {
                required: "Silakan Masukkan Vessel Code",
            },
            POL_1: {
                required: "Silakan Pilih POL",
            },

            // Penerima_1: {
            //     required: "Silakan Pilih Penerima",
            // },
            // Pengirim_1: {
            //     required: "Silakan Pilih Pengirim",
            // },
            nama_barang: {
                required: "Silakan Isi Nama Barang",
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
            let token = $("#csrf").val();
            let activity = document.getElementById("activity").value;
            let select_company =
                document.getElementById("select_company").value;
            let vessel = document.getElementById("vessel").value;
            let vessel_code = document.getElementById("vessel_code").value;
            let pol = document.getElementById("POL_1").value;
            let pot = document.getElementById("POT_1").value;
            // let pengirim = document.getElementById("Pengirim_1").value;
            // let penerima = document.getElementById("Penerima_1").value;

            // console.log(id);

            var tempDate;
            var formattedDate;

            tempDate = new Date();
            formattedDate = [
                tempDate.getFullYear(),
                tempDate.getMonth() + 1,
                tempDate.getDate(),
            ].join("-");

            var data = {
                _token: token,
                activity: activity,
                select_company: select_company,
                vessel: vessel,
                vessel_code: vessel_code,
                pol: pol,
                pot: pot,
                // pengirim: pengirim,
                // penerima: penerima,
                tanggal: formattedDate,
            };

            swal.fire({
                title: "Apakah anda yakin?",
                text: "Ingin MENGUPDATE Job Ini",
                icon: "warning",
                showCancelButton: true,
                confirmButtonText: "Iya",
                cancelButtonText: "Tidak",
            }).then((willCreate) => {
                if (willCreate.isConfirmed) {
                    $.ajax({
                        url: "/plan-kapal-detail-update/" + id,
                        type: "PUT",
                        data: data,

                        success: function (response) {
                            swal.fire({
                                title: "DETAIL KAPAL DIUPDATE",
                                icon: "success",
                                timer: 9e3,
                                showConfirmButton: false,
                            });
                            window.location.reload();
                        },
                    });
                } else {
                    swal.fire({
                        title: "Data Tidak Diupdate",
                        text: "Silakan Cek Kembali Data Anda",
                        icon: "error",
                        timer: 10e3,
                        showConfirmButton: false,
                    });
                }
            });
        },
    });
}

function blur_no_container(ini) {
    var swal = Swal.mixin({
        customClass: {
            confirmButton: "btn btn-success btn-wide mx-1",
            denyButton: "btn btn-secondary btn-wide mx-1",
            cancelButton: "btn btn-danger btn-wide mx-1",
        },
        buttonsStyling: false,
    });
    let token = $("#csrf").val();

    var no_kontainer = ini.value;
    var job_id = document.getElementById("job_id").value;

    $.ajax({
        url: "/getNoContainer",
        type: "post",
        data: {
            _token: token,
            no_kontainer: no_kontainer,
            job_id: job_id,
        },
        success: function (response) {
            var check_no_container = [];
            for (var i = 0; i < response.length; i++) {
                check_no_container[i] = response[i];
            }

            if (check_no_container.includes(ini.value)) {
                swal.fire({
                    title: "Nomor Kontainer Sudah Ada",
                    text: "Silakan Masukkan Nomor Kontainer yang Lain",
                    icon: "error",
                    timer: 10e3,
                    showConfirmButton: true,
                }).then(() => {
                    ini.value = "";
                });
            }
            // console.log(response[0]);
        },
    });
}

function blur_no_container_edit(ini) {
    let token = $("#csrf").val();
    var old_no_kontainer = document.getElementById("no_container_edit").value;
    var no_kontainer = ini.value;
    var job_id = document.getElementById("job_id").value;

    $.ajax({
        url: "/getNoContainer",
        type: "post",
        data: {
            _token: token,
            no_kontainer: no_kontainer,
            job_id: job_id,
        },
        success: function (response) {
            var check_no_container = [];
            for (var i = 0; i < response.length; i++) {
                check_no_container[i] = response[i];
            }

            if (ini.value != old_no_kontainer) {
                if (check_no_container.includes(ini.value)) {
                    swal.fire({
                        title: "Nomor Kontainer Sudah Ada",
                        text: "Silakan Masukkan Nomor Kontainer yang Lain",
                        icon: "error",
                        timer: 10e3,
                        showConfirmButton: true,
                    }).then(() => {
                        ini.value = "";
                    });
                }
            }
            // console.log(response[0]);
        },
    });
}

function change_container() {
    // var element = evt.params.data.element;
    // var $element = $(element);

    // $element.detach();
    // $(this).append($element);
    // $(this).trigger("change");
    // console.log(seal);
    // console.log(ini.val);
    // $('#seal').on("select2:select", function (evt) {
    //     var element = evt.params.data.element;
    //     var $element = $(element);

    //     $element.detach();
    //     $(this).append($element);
    //     $(this).trigger("change");
    // });
    let token = $("#csrf").val();

    $.ajax({
        url: "/getSealProcessLoad",
        type: "post",
        async: false,
        data: {
            _token: token,
        },
        success: function (response) {
            var seal = $("#seal").val();
            var last_seal = seal[seal.length - 1];
            // console.log(seal, last_seal);
            var count_seal = response.length;
            var seal_already = [];
            for (var i = 0; i < count_seal; i++) {
                seal_already[i] = response[i].seal_kontainer;
            }

            if (seal_already.includes(last_seal)) {
                swal.fire({
                    title: "Seal Kontainer Sudah Ada",
                    text: "Silakan Masukkan Seal yang Lain",
                    icon: "error",
                    timer: 10e3,
                    showConfirmButton: true,
                }).then(() => {
                    var wanted_option = $(
                        '#seal option[value="' + last_seal + '"]'
                    );
                    // console.log(wanted_option);

                    wanted_option.prop("selected", false);
                    $("#seal").trigger("change.select2");
                });
            }
            // console.log(seal_already);
            // console.log(response);
            // var baris = ini.parentNode.parentNode.parentNode.rowIndex;
            // var table = document.getElementById("processload_create");
            // var count_row = table.tBodies[0].rows.length;

            // for (var i = 1; i <= count_row; i++) {
            //     if (i != baris) {
            //         if (ini.value != "") {
            //             if (
            //                 ini.value ==
            //                     document.getElementById("seal[" + i + "]")
            //                         .value ||
            //                 response.includes(ini.value)
            //             ) {
            //                 swal.fire({
            //                     title: "Seal Sudah Terpakai",
            //                     text: "Silakan Pilih Seal yang Lain",
            //                     icon: "error",
            //                     timer: 10e3,
            //                     showConfirmButton: true,
            //                 }).then(() => {
            //                     document.getElementById(
            //                         "select2-seal" + baris + "-container"
            //                     ).title = "Pilih Seal";
            //                     document.getElementById(
            //                         "select2-seal" + baris + "-container"
            //                     ).innerHTML = "Pilih Seal";
            //                     ini.value = "";
            //                 });
            //             }
            //         }
            //     }
            // }
        },
    });
}

function uppercase(ini) {
    ini.value = ini.value.toUpperCase();
}

function char(ini, evt) {
    var theEvent = evt || window.event;
    var key = theEvent.keyCode || theEvent.which;
    key = String.fromCharCode(key);

    var regex = /[A-Z]/;
    var regex2 = /[a-z]/;
    var regex3 = /[0-9]/;

    if (
        (!regex.test(key) && !regex2.test(key) && ini.value.length <= 3) ||
        (!regex3.test(key) && ini.value.length >= 4) ||
        ini.value.length == 11
    ) {
        theEvent.returnValue = false;
    }
}

function validate_ongkos_supir(ini) {
    var ongkos_supir = ini.value.replace(/\./g, "");
    ongkos_supir = parseFloat(ongkos_supir);
    var biaya_trucking = document
        .getElementById("biaya_trucking")
        .value.replace(/\./g, "");
    biaya_trucking = parseFloat(biaya_trucking);
    if (isNaN(biaya_trucking)) biaya_trucking = 0;

    if (biaya_trucking > 0) {
        if (ongkos_supir > biaya_trucking) {
            swal.fire({
                title: "Ongkos Supir Harus Lebih Kecil Daripada Biaya Trucking",
                icon: "error",
                timer: 2e3,
                showConfirmButton: false,
            }).then((result) => {
                ini.value = "";
            });
        }
    }
    // console.log(biaya_trucking);
}
function validate_ongkos_supir_update(ini) {
    var ongkos_supir = ini.value.replace(/\./g, "");
    ongkos_supir = parseFloat(ongkos_supir);
    var biaya_trucking = document
        .getElementById("biaya_trucking_update")
        .value.replace(/\./g, "");
    biaya_trucking = parseFloat(biaya_trucking);
    if (isNaN(biaya_trucking)) biaya_trucking = 0;

    if (biaya_trucking > 0) {
        if (ongkos_supir > biaya_trucking) {
            swal.fire({
                title: "Ongkos Supir Harus Lebih Kecil Daripada Biaya Trucking",
                icon: "error",
                timer: 2e3,
                showConfirmButton: false,
            }).then((result) => {
                ini.value = "";
            });
        }
    }
    // console.log(biaya_trucking);
}
function validate_ongkos_supir_tambah(ini) {
    var ongkos_supir = ini.value.replace(/\./g, "");
    ongkos_supir = parseFloat(ongkos_supir);
    var biaya_trucking = document
        .getElementById("biaya_trucking_tambah")
        .value.replace(/\./g, "");
    biaya_trucking = parseFloat(biaya_trucking);
    if (isNaN(biaya_trucking)) biaya_trucking = 0;

    if (biaya_trucking > 0) {
        if (ongkos_supir > biaya_trucking) {
            swal.fire({
                title: "Ongkos Supir Harus Lebih Kecil Daripada Biaya Trucking",
                icon: "error",
                timer: 2e3,
                showConfirmButton: false,
            }).then((result) => {
                ini.value = "";
            });
        }
    }
    // console.log(biaya_trucking);
}

function validate_biaya_trucking(ini) {
    var biaya_trucking = ini.value.replace(/\./g, "");
    biaya_trucking = parseFloat(biaya_trucking);
    var ongkos_supir = document
        .getElementById("ongkos_supir")
        .value.replace(/\./g, "");
    ongkos_supir = parseFloat(ongkos_supir);
    if (isNaN(ongkos_supir)) ongkos_supir = 0;

    if (ongkos_supir > 0) {
        if (ongkos_supir > biaya_trucking) {
            swal.fire({
                title: "Biaya Trucking Harus Lebih Besar Daripada Ongkos Supir",
                icon: "error",
                timer: 2e3,
                showConfirmButton: false,
            }).then((result) => {
                ini.value = "";
            });
        }
    }
}
function validate_biaya_trucking_update(ini) {
    var biaya_trucking = ini.value.replace(/\./g, "");
    biaya_trucking = parseFloat(biaya_trucking);
    var ongkos_supir = document
        .getElementById("ongkos_supir_update")
        .value.replace(/\./g, "");
    ongkos_supir = parseFloat(ongkos_supir);
    if (isNaN(ongkos_supir)) ongkos_supir = 0;

    if (ongkos_supir > 0) {
        if (ongkos_supir > biaya_trucking) {
            swal.fire({
                title: "Biaya Trucking Harus Lebih Besar Daripada Ongkos Supir",
                icon: "error",
                timer: 2e3,
                showConfirmButton: false,
            }).then((result) => {
                ini.value = "";
            });
        }
    }
}
function validate_biaya_trucking_tambah(ini) {
    var biaya_trucking = ini.value.replace(/\./g, "");
    biaya_trucking = parseFloat(biaya_trucking);
    var ongkos_supir = document
        .getElementById("ongkos_supir_tambah")
        .value.replace(/\./g, "");
    ongkos_supir = parseFloat(ongkos_supir);
    if (isNaN(ongkos_supir)) ongkos_supir = 0;

    if (ongkos_supir > 0) {
        if (ongkos_supir > biaya_trucking) {
            swal.fire({
                title: "Biaya Trucking Harus Lebih Besar Daripada Ongkos Supir",
                icon: "error",
                timer: 2e3,
                showConfirmButton: false,
            }).then((result) => {
                ini.value = "";
            });
        }
    }
}

function cetak_packing() {
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

    var table_biaya2 = $("#table_biaya2 >tbody >tr").length;

    // console.log(table_biaya2);

    swal.fire({
        title: " Ingin Mencetak Packing List?",
        text: "Silahkan Periksa Semua Data yang ada Sebelum Mencetak.",
        icon: "question",
        showCancelButton: true,
        confirmButtonText: "Iya",
        cancelButtonText: "Tidak",
    }).then((willCreate) => {
        if (table_biaya2 > 0) {
            if (willCreate.isConfirmed) {
                var token = $("#csrf").val();
                var old_slug = $("#old_slug").val();

                var data = {
                    _token: token,
                    old_slug: old_slug,
                };

                $.ajax({
                    type: "POST",
                    url: "/cetak-packing-list-load",
                    data: data,
                    xhrFields: {
                        responseType: "blob",
                    },
                    success: function (response) {
                        // console.log(response);
                        toast.fire({
                            icon: "success",
                            title: "Packing List Didownload",
                        });
                        var blob = new Blob([response]);
                        var link = document.createElement("a");
                        link.href = window.URL.createObjectURL(blob);
                        link.download = "" + old_slug + ".pdf";
                        link.click();

                        // setTimeout(function () {
                        //     window.location.reload();
                        // }, 10);
                    },
                });
            }
        } else {
            swal.fire({
                title: "LIST Tidak Dicetak",
                // text: "Data Batal Dihapus",
                icon: "error",
                timer: 2e3,
                showConfirmButton: false,
            });
        }
    });
}

var urutan_detail = 1;

function tambah_barang() {
    urutan_detail++;

    var div1 = document.getElementById("div_detail");

    var div2 = document.createElement("div");
    div2.setAttribute("class", "row row-cols g-3");
    div2.setAttribute("id", "body_detail[" + urutan_detail + "]");

    var label = document.createElement("label");
    label.setAttribute("class", "col-sm-4 col-form-label");
    label.setAttribute("id", "label_detail");
    label.setAttribute("name", "label_detail");

    var div3 = document.createElement("div");
    div3.setAttribute("class", "col-sm-6 validation-container d-grid gap-3");
    div3.setAttribute("id", "div_textarea");
    div3.setAttribute("name", "div_textarea");
    var textarea = document.createElement("textarea");
    textarea.setAttribute("data-bs-toggle", "tooltip");
    textarea.setAttribute("class", "form-control");
    textarea.setAttribute("id", "detail_barang[" + urutan_detail + "]");
    textarea.setAttribute("name", "detail_barang");
    textarea.setAttribute("style", "margin-left: 10px");
    textarea.setAttribute("required", true);
    div3.append(textarea);

    var div4 = document.createElement("div");
    div4.setAttribute("class", "col-sm-2 py-4");
    div4.setAttribute("id", "div_button");
    div4.setAttribute("name", "div_button");
    var button = document.createElement("a");
    button.setAttribute("class", "btn btn-sm btn-label-danger btn-icon");
    button.setAttribute("id", "delete_detail[" + urutan_detail + "]");
    button.setAttribute("name", "delete_detail");
    button.setAttribute("style", "margin-left: 10px;");
    button.setAttribute("onclick", "delete_detail(this)");
    icon = document.createElement("i");
    icon.setAttribute("class", "fa fa-trash");
    button.append(icon);
    div4.append(button);

    div2.append(label);
    div2.append(div3);
    div2.append(div4);

    div1.appendChild(div2);

    reindex_detail();
}

function edit_tambah_barang() {
    console.log(edit_urutan_detail);
    edit_urutan_detail++;

    var div1 = document.getElementById("edit_div_detail");

    var div2 = document.createElement("div");
    div2.setAttribute("class", "row row-cols g-3");
    div2.setAttribute("id", "edit_body_detail[" + edit_urutan_detail + "]");

    var label = document.createElement("label");
    label.setAttribute("class", "col-sm-4 col-form-label");
    label.setAttribute("id", "edit_label_detail");
    label.setAttribute("name", "edit_label_detail");

    var div3 = document.createElement("div");
    div3.setAttribute("class", "col-sm-6 validation-container d-grid gap-3");
    div3.setAttribute("id", "edit_div_textarea");
    div3.setAttribute("name", "edit_div_textarea");
    var textarea = document.createElement("textarea");
    textarea.setAttribute("data-bs-toggle", "tooltip");
    textarea.setAttribute("class", "form-control");
    textarea.setAttribute("id", "edit_detail_barang[" + edit_urutan_detail + "]");
    textarea.setAttribute("name", "edit_detail_barang");
    textarea.setAttribute("style", "margin-left: 10px");
    textarea.setAttribute("required", true);
    div3.append(textarea);

    var div4 = document.createElement("div");
    div4.setAttribute("class", "col-sm-2 py-4");
    div4.setAttribute("id", "edit_div_button");
    div4.setAttribute("name", "edit_div_button");
    var button = document.createElement("a");
    button.setAttribute("class", "btn btn-sm btn-label-danger btn-icon");
    button.setAttribute("id", "edit_delete_detail[" + edit_urutan_detail + "]");
    button.setAttribute("name", "edit_delete_detail");
    button.setAttribute("style", "margin-left: 10px;");
    button.setAttribute("onclick", "edit_delete_detail(this)");
    icon = document.createElement("i");
    icon.setAttribute("class", "fa fa-trash");
    button.append(icon);
    div4.append(button);

    div2.append(label);
    div2.append(div3);
    div2.append(div4);

    div1.appendChild(div2);

    reindex_edit_detail();
}

function reindex_detail() {
    const ids = document.querySelectorAll("#label_detail");
    ids.forEach((e, i) => {
        e.innerHTML =
            "Detail Barang Ke-" +
            (i + 1) +
            " :<span class='text-danger'>*</span>";
    });
}

function reindex_edit_detail() {
    const ids = document.querySelectorAll("#edit_label_detail");
    ids.forEach((e, i) => {
        e.innerHTML =
            "Detail Barang Ke-" +
            (i + 1) +
            " :<span class='text-danger'>*</span>";
    });
}

function delete_detail(ini) {
    var urutan_delete = ini.parentNode.parentNode;
    urutan_delete.remove();
    urutan_detail--;

    var label = document.querySelectorAll("#label_detail");

    for (var i = 0; i < label.length; i++) {
        label[i].innerHTML = "Detail Barang Ke-" + urutan_detail + " :";
    }

    var div1 = document.querySelectorAll("#div_textarea textarea");

    for (var i = 0; i < div1.length; i++) {
        div1[i].id = "detail_barang[" + (i + 1) + "]";
    }

    var div2 = document.querySelectorAll("#div_button button");

    for (var i = 0; i < div2.length; i++) {
        div2[i].id = "delete_detail[" + (i + 1) + "]";
    }

    if (urutan_detail == 0) {
        tambah_barang();
    }

    reindex_detail();
}

function edit_delete_detail(ini) {
    var urutan_delete = ini.parentNode.parentNode;
    urutan_delete.remove();
    edit_urutan_detail--;

    var label = document.querySelectorAll("#edit_label_detail");

    for (var i = 0; i < label.length; i++) {
        label[i].innerHTML = "Detail Barang Ke-" + urutan_detail + " :";
    }

    var div1 = document.querySelectorAll("#edit_div_textarea textarea");

    for (var i = 0; i < div1.length; i++) {
        div1[i].id = "edit_detail_barang[" + (i + 1) + "]";
    }

    var div2 = document.querySelectorAll("#edit_div_button button");

    for (var i = 0; i < div2.length; i++) {
        div2[i].id = "edit_delete_detail[" + (i + 1) + "]";
    }

    if (edit_urutan_detail == 0) {
        edit_tambah_barang();
    }

    reindex_edit_detail();
}

var urutan_biaya = 1;

function tambah_keterangan_biaya() {
    urutan_biaya++;

    var div1 = document.getElementById("div_biaya");

    var div2 = document.createElement("div");
    div2.setAttribute("class", "row row-cols g-3");
    div2.setAttribute("id", "body_biaya[" + urutan_biaya + "]");

    var label = document.createElement("label");
    label.setAttribute("class", "col-sm-4 col-form-label");
    label.setAttribute("id", "label_biaya");
    label.setAttribute("name", "label_biaya");

    var div3 = document.createElement("div");
    div3.setAttribute("class", "col-sm-6 validation-container d-grid gap-3");
    div3.setAttribute("id", "div_textarea_biaya");
    div3.setAttribute("name", "div_textarea_biaya");
    var textarea = document.createElement("textarea");
    textarea.setAttribute("data-bs-toggle", "tooltip");
    textarea.setAttribute("class", "form-control");
    textarea.setAttribute("id", "keterangan_biaya[" + urutan_biaya + "]");
    textarea.setAttribute("name", "keterangan_biaya");
    textarea.setAttribute("placeholder", "ex. (Rp. 10.000 untuk kebutuhan kontainer)");
    textarea.setAttribute("style", "margin-left: 10px");
    textarea.setAttribute("required", true);
    div3.append(textarea);

    var div4 = document.createElement("div");
    div4.setAttribute("class", "col-sm-2 py-4");
    div4.setAttribute("id", "div_button_biaya");
    div4.setAttribute("name", "div_button_biaya");
    var button = document.createElement("a");
    button.setAttribute("class", "btn btn-sm btn-label-danger btn-icon");
    button.setAttribute("id", "hapus_biaya[" + urutan_biaya + "]");
    button.setAttribute("name", "hapus_biaya");
    button.setAttribute("style", "margin-left: 10px;");
    button.setAttribute("onclick", "hapus_biaya(this)");
    icon = document.createElement("i");
    icon.setAttribute("class", "fa fa-trash");
    button.append(icon);
    div4.append(button);

    div2.append(label);
    div2.append(div3);
    div2.append(div4);

    div1.appendChild(div2);

    reindex_biaya();
}

function reindex_biaya() {
    const ids = document.querySelectorAll("#label_biaya");
    ids.forEach((e, i) => {
        e.innerHTML =
            "Keterangan Biaya Ke-" +
            (i + 1) +
            " :<span class='text-danger'>*</span>";
    });
}

function hapus_biaya(ini) {
    var urutan_delete_biaya = ini.parentNode.parentNode;
    urutan_delete_biaya.remove();
    urutan_biaya--;

    var label = document.querySelectorAll("#label_biaya");

    for (var i = 0; i < label.length; i++) {
        label[i].innerHTML = "Keterangan Biaya Ke-" + urutan_biaya + " :";
    }

    var div1 = document.querySelectorAll("#div_textarea_biaya textarea");

    for (var i = 0; i < div1.length; i++) {
        div1[i].id = "keterangan_biaya[" + (i + 1) + "]";
    }

    var div2 = document.querySelectorAll("#div_button_biaya button");

    for (var i = 0; i < div2.length; i++) {
        div2[i].id = "hapus_biaya[" + (i + 1) + "]";
    }

    if (urutan_biaya == 0) {
        tambah_keterangan_biaya();
    }

    reindex_biaya();
}
