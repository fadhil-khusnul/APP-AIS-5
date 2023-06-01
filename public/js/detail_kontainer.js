function detail(e) {
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


            for (let i = 0; i < response.seal_containers.length; i++) {
                seals[i] = response.seal_containers[i].seal_kontainer;
            }
            for (let i = 0; i < response.spks.length; i++) {
                spk[i] = response.spks[i].spk_kontainer;
            }
            console.log(seals);
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
                        async :false,
                        data: {
                            _token: token,
                        },
                        success: function (response) {
                            var seal = $("#seal").val();
                            var last_seal = seal[seal.length - 1];
                            console.log(seal, last_seal);
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
                                    console.log(wanted_option);

                                    wanted_option.prop("selected", false);
                                    $("#seal").trigger("change.select2");
                                });
                            }
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
                        url: "/getSpkProcessLoad",
                        type: "post",
                        async :false,
                        data: {
                            _token: token,
                        },
                        success: function (response) {
                            var seal = $("#spk").val();
                            var last_seal = seal[seal.length - 1];
                            console.log(seal, last_seal);
                            var count_seal = response.length;
                            var seal_already = [];
                            for (var i = 0; i < count_seal; i++) {
                                seal_already[i] = response[i].spk_kontainer;
                            }

                            if (seal_already.includes(last_seal)) {
                                swal.fire({
                                    title: "SPK Kontainer Sudah Dipakai",
                                    icon: "error",
                                    timer: 10e3,
                                    showConfirmButton: true,
                                }).then(() => {
                                    var wanted_option = $(
                                        '#spk option[value="' +
                                            last_seal +
                                            '"]'
                                    );
                                    console.log(wanted_option);

                                    wanted_option.prop("selected", false);
                                    $("#spk").trigger("change.select2");
                                });
                            }
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

            $("#driver").val(response.result.driver).select2({
                dropdownAutoWidth: true,
                placeholder: "Silahkan Pilih Vendor",
                allowClear: true,
                dropdownParent: $("#modal-job"),
            }).change(function() {
                let vendor_id = $(this).val();
                let token = $('#csrf').val();;
                $.ajax({
                    url: '/getVendor',
                    type: 'POST',
                    data: {

                        'vendor_id' : vendor_id,
                        '_token' : token,
                    },
                    success: function(result) {
                        $('#nomor_polisi').select2({
                            dropdownAutoWidth: true,
                            placeholder: "Silahkan Pilih Supir",
                            allowClear: true,
                            dropdownParent: $("#modal-job"),
                        }).html(result)
                    }
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

            $("#valid_job").validate({
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
                    var new_id = document.getElementById("new_id").value;
                    console.log(new_id);
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
                            biaya_seal: $("#biaya_seal").val().replace(/\./g, ""),
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
    $("#spk_tambah")
    .select2({
                    dropdownAutoWidth: true,
                    placeholder: "Silahkan Pilih",
                    // allowClear:true,
                    maximumSelectionLength: 4,
                    dropdownParent: $("#modal-job-tambah"),
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
                        url: "/getSpkProcessLoad",
                        type: "post",
                        async :false,
                        data: {
                            _token: token,
                        },
                        success: function (response) {
                            var seal = $("#spk_tambah").val();
                            var last_seal = seal[seal.length - 1];
                            console.log(seal, last_seal);
                            var count_seal = response.length;
                            var seal_already = [];
                            for (var i = 0; i < count_seal; i++) {
                                seal_already[i] = response[i].spk_kontainer;
                            }

                            if (seal_already.includes(last_seal)) {
                                swal.fire({
                                    title: "SPK Kontainer Sudah Dipakai",
                                    icon: "error",
                                    timer: 10e3,
                                    showConfirmButton: true,
                                }).then(() => {
                                    var wanted_option = $(
                                        '#spk_tambah option[value="' +
                                            last_seal +
                                            '"]'
                                    );
                                    console.log(wanted_option);

                                    wanted_option.prop("selected", false);
                                    $("#spk_tambah").trigger("change.select2");
                                });
                            }
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
                console.log(seal, last_seal);
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
                            '#seal_tambah option[value="' +
                                last_seal +
                                '"]'
                        );
                        console.log(wanted_option);

                        wanted_option.prop("selected", false);
                        $("#seal_tambah").trigger("change.select2");
                    });
                }
            },
        });
    });

    $("#dana_tambah").select2({
        dropdownAutoWidth: true,
        placeholder: "Silahkan Pilih",
        allowClear: true,
        dropdownParent: $("#modal-job-tambah"),
    });

    $("#driver_tambah").select2({
        dropdownAutoWidth: true,
        placeholder: "Silahkan Pilih Vendor",
        allowClear: true,
        dropdownParent: $("#modal-job-tambah"),
    }).change(function() {
        let vendor_id = $(this).val();
        let token = $('#csrf').val();;
        $.ajax({
            url: '/getVendor',
            type: 'POST',
            data: {

                'vendor_id' : vendor_id,
                '_token' : token,
            },
            success: function(result) {
                $('#nomor_polisi_tambah').select2({
                    dropdownAutoWidth: true,
                    placeholder: "Silahkan Pilih Supir",
                    allowClear: true,
                    dropdownParent: $("#modal-job-tambah"),
                }).html(result)
            }
        });
    })

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
                supir +=   "<option value='" +
                response.supirs[i].id +
                "'>" +
                response.supirs[i].nama_supir + "/" + response.supirs[i].nomor_polisi+
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
                                        async:false,
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
                                        $("#seal_update").trigger("change.select2");
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
                                        async:false,
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
                                        $("#spk_update").trigger("change.select2");
                                    });
                                }
                            }
                        },
                    });
                });

            var old_tanggal_result = moment(response.result.date_activity, 'YYYY-MM-DD').format('dddd, DD-MM-YYYY');
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
            $('#nomor_polisi_update').html(supir).select2({
                dropdownAutoWidth: true,
                placeholder: "Silahkan Pilih Supir",
                allowClear: true,
                dropdownParent: $("#modal-job-update"),
            })
            $("#driver_update").val(response.result.driver).select2({
                dropdownAutoWidth: true,
                placeholder: "Silahkan Pilih Vendor",
                allowClear: true,
                dropdownParent: $("#modal-job-update"),
            }).change(function() {
                let vendor_id = $(this).val();
                let token = $('#csrf').val();;
                $.ajax({
                    url: '/getVendor',
                    type: 'POST',
                    data: {

                        'vendor_id' : vendor_id,
                        '_token' : token,
                    },
                    success: function(result) {
                        $('#nomor_polisi_update').select2({
                            dropdownAutoWidth: true,
                            placeholder: "Silahkan Pilih Supir",
                            allowClear: true,
                            dropdownParent: $("#modal-job-update"),
                        }).html(result)
                    }
                });
            })
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

                    let date_activity =
                        document.getElementById("date_activity_update").value;
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
                            biaya_thc: $("#biaya_thc_update").val().replace(/\./g, ""),
                            biaya_seal: $("#biaya_seal_update").val().replace(/\./g, ""),
                            freight: $("#freight_update").val().replace(/\./g, ""),
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

function realisasi_page(slug) {
    var slugs = slug.value;

    console.log(slugs);

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
    console.log(id);

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
                    console.log(id_lama_biaya);
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

            var data = {
                _token: token,
                job_id: $("#job_id").val(),
                kontainer_id: $("#kontainer_detail").val(),
                detail_barang: $("#detail_barang").val(),
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

function detail_barang_edit(e) {
    let id = e.value;
    console.log(id);

    $.ajax({
        url: "/detailbarang-edit/" + id,
        type: "GET",
        success: function (response) {
            $("#modal_detail_barang_edit").modal("show");

            $("#id_lama_detail").val(response.result.id);
            $("#old_id_container_detail").val(response.result.kontainer_id);
            $("#kontainer_detail_edit")
                .val(response.result.kontainer_id)
                .is(":selected");
            $("#detail_barang_edit").val(response.result.detail_barang);

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
                    var id_lama_detail =
                        document.getElementById("id_lama_detail").value;
                    console.log(id_lama_detail);
                    var token = $("#csrf").val();

                    var data = {
                        _token: token,
                        job_id: $("#job_id").val(),
                        kontainer_id: $("#kontainer_detail_edit").val(),
                        old_id_container_detail: old_id_container_detail,
                        detail_barang: $("#detail_barang_edit").val(),
                    };

                    $.ajax({
                        url: "/detailbarang-update/" + id_lama_detail,
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
                        showConfirmButton: true,
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
    console.log(id);

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
                    console.log(id_lama_biaya);
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
                                showConfirmButton: true,
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
                        showConfirmButton: true,
                    });
                    window.location.reload();
                },
            });
        } else {
            swal.fire({
                title: "Container TIDAK DIBATALKAN",
                icon: "error",
                timer: 10e3,
                showConfirmButton: true,
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
                        showConfirmButton: true,
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
    console.log(id);

    $.ajax({
        url: "/alihkapal-edit/" + id,
        type: "GET",
        success: function (response) {
            $("#modal_alih_kapal_edit").modal("show");

            $("#id_lama_alih").val(response.result.id);
            console.log(response.result.kontainer_alih);
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
                    console.log(id_lama_biaya);
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
                                showConfirmButton: true,
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
                        showConfirmButton: true,
                    });
                    window.location.reload();
                },
            });
        } else {
            swal.fire({
                title: "Container TIDAK DIALIHKAN",
                icon: "error",
                timer: 10e3,
                showConfirmButton: true,
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

            POD_1: {
                required: true,
            },
            Penerima_1: {
                required: true,
            },
            Pengirim_1: {
                required: true,
            },
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

            POD_1: {
                required: "Silakan Pilih POD",
            },
            Penerima_1: {
                required: "Silakan Pilih Penerima",
            },
            Pengirim_1: {
                required: "Silakan Pilih Pengirim",
            },
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
            let pod = document.getElementById("POD_1").value;
            let pengirim = document.getElementById("Pengirim_1").value;
            let penerima = document.getElementById("Penerima_1").value;

            console.log(id);

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
                pod: pod,
                pengirim: pengirim,
                penerima: penerima,
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
                                showConfirmButton: true,
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
                        showConfirmButton: true,
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

            if(ini.value != old_no_kontainer) {
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

$("#seal").on("select2:select", function (evt) {
    var element = evt.params.data.element;
    var $element = $(element);

    $element.detach();
    $(this).append($element);
    $(this).trigger("change");

    let token = $("#csrf").val();

    $.ajax({
        url: "/getSealProcessLoad",
        async:false,
        type: "post",
        data: {
            _token: token,
        },
        success: function (response) {
            var seal = $("#seal").val();
            var last_seal = seal[seal.length - 1];
            console.log(seal, last_seal);
            var count_seal = response.length;
            var seal_already = [];
            for (var i = 0; i < count_seal; i++) {
                seal_already[i] = response[i].seal_kontainer;
            }

            if (seal_already.includes(last_seal)) {
                swal.fire({
                    title: "Seal Kontainer Sudah Dipakai",
                    text: "Silakan Masukkan Seal yang Lain",
                    icon: "error",
                    timer: 10e3,
                    showConfirmButton: true,
                }).then(() => {
                    var wanted_option = $(
                        '#seal option[value="' + last_seal + '"]'
                    );
                    console.log(wanted_option);

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
});

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
        async:false,
        data: {
            _token: token,
        },
        success: function (response) {
            var seal = $("#seal").val();
            var last_seal = seal[seal.length - 1];
            console.log(seal, last_seal);
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
                    console.log(wanted_option);

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
