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
        url: "/detail-kontainer-discharge/" + id + "/input",
        type: "GET",
        async: false,
        success: function (response) {
            let new_id = id;
            console.log(response.seal_discharge);

            $("#modal-job").modal("show");
            $("#seal_html").html("");
            var id_seal_html = document.getElementById("seal_html")
            let seals = [""];
            for (let i = 0; i < response.seal_discharge.length; i++) {

                seals += ("<li>" + response.seal_discharge[i].seal_kontainer +"</li>");
            }
            let ol_seal = document.createElement("ol");
            console.log(seals);
            ol_seal.setAttribute("type", "1.")
            ol_seal.setAttribute("style", "padding-left: 7px;")
            ol_seal.innerHTML = seals
            id_seal_html.appendChild(ol_seal)


            $("#size_type").html(response.result.size+"/"+response.result.type);
            $("#type").val(response.result.type);
            $("#nomor_kontainer").val(response.result.nomor_kontainer);
            $("#cargo").html(response.result.cargo);
            // $("#seal_html").append(html_seals)
            $("#tanggal_kembali").val(response.result.tanggal_kembali);
            $("#lokasi_kembali")
                .val(response.result.lokasi_kembali)
                .select2({
                    dropdownAutoWidth: true,
                    placeholder: "Silahkan Pilih Lokasi Pickup",
                    allowClear: true,
                    dropdownParent: $("#modal-job"),
                });

            $("#penerima_barang")
                .val(response.result.penerima_barang)
                .select2({
                    dropdownAutoWidth: true,
                    placeholder: "Silahkan Pilih penerima",
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
            $("#biaya_seal").val(response.result.biaya_seal);
            $("#jaminan_kontainer").val(response.result.jaminan_kontainer);
            $("#biaya_cleaning").val(response.result.biaya_cleaning);
            $("#biaya_retribusi").val(response.result.biaya_retribusi);
            $("#biaya_thc").val(response.result.biaya_thc);
            $("#biaya_trucking").val(response.result.biaya_trucking);
            $("#ongkos_supir").val(response.result.ongkos_supir);
            $("#return_to")
                .val(response.result.dana)
                .select2({
                    dropdownAutoWidth: true,
                    placeholder: "Silahkan Pilih Lokasi Empty Return",
                    allowClear: true,
                    dropdownParent: $("#modal-job"),
                });

            $("#remark").val(response.result.remark);

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

                    $.ajax({
                        url: "/detail-kontainer-discharge/" + new_id + "/input",
                        type: "GET",
                        async: false,
                        success: function (response) {
                            var seal_old = [];

                            for (let i = 0; i < response.seal_discharge.length; i++) {
                                seal_old[i] = response.seal_discharge[i].seal_kontainer;
                            }
                            // console.log(new_id);
                            var token = $("#csrf").val();
        
                            let tanggal_kembali =
                                document.getElementById("tanggal_kembali").value;
                            tanggal_kembali = moment(
                                tanggal_kembali,
                                "dddd, DD-MMMM-YYYY"
                            ).format("YYYY-MM-DD");
                            console.log(tanggal_kembali);
        
                            $.ajax({
                                url: "/detaildischarge-kontainer-update/" + new_id,
                                type: "PUT",
                                data: {
                                    _token: token,
                                    job_id: $("#job_id").val(),
                                    size: $("#size").val(),
                                    type: $("#type").val(),
                                    nomor_kontainer: $("#nomor_kontainer").val(),
                                    cargo: $("#cargo").val(),
                                    seal: $("#seal").val(),
                                    seal_old: seal_old,
                                    tanggal_kembali: tanggal_kembali,
                                    lokasi_kembali: $("#lokasi_kembali").val(),
                                    penerima: $("#penerima").val(),
                                    alamat_pengantaran: $("#alamat_pengantaran").val(),
                                    driver: $("#driver").val(),
                                    nomor_polisi: $("#nomor_polisi").val(),
                                    remark: $("#remark").val(),
                                    jaminan_kontainer: $("#jaminan_kontainer").val().replace(/\./g, ""),
                                    biaya_cleaning: $("#biaya_cleaning")
                                        .val()
                                        .replace(/\./g, ""),
                                    biaya_retribusi: $("#biaya_retribusi")
                                        .val()
                                        .replace(/\./g, ""),
                                    biaya_retribusi: $("#biaya_retribusi")
                                        .val()
                                        .replace(/\./g, ""),
                                    biaya_thc: $("#biaya_thc").val().replace(/\./g, ""),
                                    biaya_trucking: $("#biaya_trucking")
                                        .val()
                                        .replace(/\./g, ""),
                                    ongkos_supir: $("#ongkos_supir")
                                        .val()
                                        .replace(/\./g, ""),
                                    biaya_seal: $("#biaya_seal")
                                        .val()
                                        .replace(/\./g, ""),
        
                                    return_to: $("#return_to").val(),
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
        },
    });
}
function detail_edit(e) {
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
        url: "/detail-kontainer-discharge/" + id + "/input",
        type: "GET",
        async: false,
        cache: false,
        processData: false,
        contentType: false,
        success: function (response) {
            let new_id = id;

            $("#modal-job-edit").modal("show");
            $("#seal_html_edit").html("");


            var id_seal_html_edit = document.getElementById("seal_html_edit")
            let seals = [""];
            for (let i = 0; i < response.seal_discharge.length; i++) {

                seals += ("<li>" + response.seal_discharge[i].seal_kontainer +"</li>");
            }
            let ol_seal = document.createElement("ol");
            console.log(seals);
            ol_seal.setAttribute("type", "1.")
            ol_seal.setAttribute("style", "padding-left: 7px;")
            ol_seal.innerHTML = seals
            id_seal_html_edit.appendChild(ol_seal)


            $("#size_type_edit").html(response.result.size +"/"+ response.result.type);
            $("#nomor_kontainer_edit").html(response.result.nomor_kontainer);
            $("#cargo_edit").html(response.result.cargo);
            $("#biaya_seal_edit").val("");
           
            var old_tanggal_result = moment(
                response.result.tanggal_kembali,
                "YYYY-MM-DD"
            ).format("dddd, DD-MMMM-YYYY");
            $("#tanggal_kembali_edit").val(old_tanggal_result);
            $("#lokasi_kembali_edit")
                .val(response.result.lokasi_kembali)
                .select2({
                    dropdownAutoWidth: true,
                    placeholder: "Silahkan Pilih Lokasi Pickup",
                    allowClear: true,
                    dropdownParent: $("#modal-job-edit"),
                });

            $("#penerima_edit")
                .val(response.result.penerima)
                .select2({
                    dropdownAutoWidth: true,
                    placeholder: "Silahkan Pilih penerima",
                    allowClear: true,
                    dropdownParent: $("#modal-job-edit"),
                });

            $("#nomor_polisi_edit")
                .val(response.result.nomor_polisi)
                .select2({
                    dropdownAutoWidth: true,
                    placeholder: "Silahkan Pilih Supir",
                    allowClear: true,
                    dropdownParent: $("#modal-job-edit"),
                });

            $("#driver_edit")
                .val(response.result.driver)
                .select2({
                    dropdownAutoWidth: true,
                    placeholder: "Silahkan Pilih Supir",
                    allowClear: true,
                    dropdownParent: $("#modal-job-edit"),
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
                            $("#nomor_polisi_edit")
                                .select2({
                                    dropdownAutoWidth: true,
                                    // placeholder: "Silahkan Pilih Supir",
                                    allowClear: true,
                                    dropdownParent: $("#modal-job-edit"),
                                })
                                .html(result);
                        },
                    });
                });

            $("#new_id_edit").val(response.result.id);
            $("#alamat_pengantaran_edit").val(
                response.result.alamat_pengantaran
            );
            $("#biaya_seal_edit").val(response.result.biaya_seal);
            $("#biaya_cleaning_edit").val(response.result.biaya_cleaning);
            $("#jaminan_kontainer_edit").val(response.result.jaminan_kontainer);
            $("#biaya_retribusi_edit").val(response.result.biaya_retribusi);
            $("#biaya_thc_edit").val(response.result.biaya_thc);
            $("#biaya_trucking_edit").val(response.result.biaya_trucking);
            $("#ongkos_supir_edit").val(response.result.ongkos_supir);
            $("#return_to_edit")
                .val(response.result.return_to)
                .select2({
                    dropdownAutoWidth: true,
                    placeholder: "Silahkan Pilih Lokasi Empty Return",
                    allowClear: true,
                    dropdownParent: $("#modal-job-edit"),
                });

            $("#remark_edit").val(response.result.remark);

            $("#valid_job_edit").validate({
                ignore: "select[type=hidden]",

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
                    var new_id = document.getElementById("new_id_edit").value;

                    $.ajax({
                        url: "/detail-kontainer-discharge/" + new_id + "/input",
                        type: "GET",
                        async: false,
                        cache: false,
                        processData: false,
                        contentType: false,
                        success: function (response) {
                            var seal_old = [];

                            for (
                                let i = 0;
                                i < response.seal_discharge.length;
                                i++
                            ) {
                                seal_old[i] =
                                    response.seal_discharge[i].seal_kontainer;
                            }

                            // console.log(new_id);
                            var token = $("#csrf").val();

                            let tanggal_kembali = document.getElementById(
                                "tanggal_kembali_edit"
                            ).value;
                            tanggal_kembali = moment(
                                tanggal_kembali,
                                "dddd, DD-MMMM-YYYY"
                            ).format("YYYY-MM-DD");
                            // console.log(tanggal_kembali);

                            $.ajax({
                                url:
                                    "/detaildischarge-kontainer-edit/" + new_id,
                                type: "PUT",
                                data: {
                                    _token: token,
                                    job_id: $("#job_id").val(),
                                    size: $("#size_edit").val(),
                                    type: $("#type_edit").val(),
                                    nomor_kontainer: $(
                                        "#nomor_kontainer_edit"
                                    ).val(),
                                    cargo: $("#cargo_edit").val(),
                                    seal: $("#seal_edit").val(),
                                    seal_old: seal_old,
                                    tanggal_kembali: tanggal_kembali,
                                    lokasi_kembali: $(
                                        "#lokasi_kembali_edit"
                                    ).val(),
                                    penerima: $("#penerima_edit").val(),
                                    alamat_pengantaran: $(
                                        "#alamat_pengantaran_edit"
                                    ).val(),
                                    driver: $("#driver_edit").val(),
                                    nomor_polisi: $("#nomor_polisi_edit").val(),
                                    remark: $("#remark_edit").val(),
                                    biaya_cleaning: $("#biaya_cleaning_edit")
                                        .val()
                                        .replace(/\./g, ""),
                                    biaya_retribusi: $("#biaya_retribusi_edit")
                                        .val()
                                        .replace(/\./g, ""),
                                    biaya_retribusi: $("#biaya_retribusi_edit")
                                        .val()
                                        .replace(/\./g, ""),
                                    biaya_thc: $("#biaya_thc_edit")
                                        .val()
                                        .replace(/\./g, ""),
                                    biaya_trucking: $("#biaya_trucking_edit")
                                        .val()
                                        .replace(/\./g, ""),
                                    ongkos_supir: $("#ongkos_supir_edit")
                                        .val()
                                        .replace(/\./g, ""),
                                    jaminan_kontainer: $("#jaminan_kontainer_edit")
                                        .val()
                                        .replace(/\./g, ""),
                                    biaya_seal: $("#biaya_seal_edit")
                                        .val()
                                        .replace(/\./g, ""),

                                    return_to: $("#return_to_edit").val(),
                                },
                                success: function (response) {
                                    swal.fire({
                                        icon: "success",
                                        title: "Detail Kontainer Berhasil Diupdate",
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
        },
    });
}
function detail_tambah() {
    var swal = Swal.mixin({
        customClass: {
            confirmButton: "btn btn-success btn-wide mx-1",
            denyButton: "btn btn-secondary btn-wide mx-1",
            cancelButton: "btn btn-danger btn-wide mx-1",
        },
        buttonsStyling: false,
    });

    $("#modal-job-tambah").modal("show");

    $("#seal_tambah")
        .select2({
            dropdownAutoWidth: true,
            // tags: true,
            placeholder: "Silahkan Pilih",
            // allowClear:true,
            maximumSelectionLength: 4,
            dropdownParent: $("#modal-job-tambah"),
        })
        .off("select2:select")
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
        .off("select2:unselect")
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

    $("#lokasi_kembali_tambah").select2({
        dropdownAutoWidth: true,
        placeholder: "Silahkan Pilih Lokasi Pickup",
        allowClear: true,
        dropdownParent: $("#modal-job-tambah"),
    });

    $("#penerima_tambah").select2({
        dropdownAutoWidth: true,
        placeholder: "Silahkan Pilih penerima",
        allowClear: true,
        dropdownParent: $("#modal-job-tambah"),
    });

    $("#nomor_polisi_tambah").select2({
        dropdownAutoWidth: true,
        placeholder: "Silahkan Pilih Supir",
        allowClear: true,
        dropdownParent: $("#modal-job-tambah"),
    });

    $("#driver_tambah")
        .select2({
            dropdownAutoWidth: true,
            placeholder: "Silahkan Pilih Supir",
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
                            // placeholder: "Silahkan Pilih Supir",
                            allowClear: true,
                            dropdownParent: $("#modal-job-tambah"),
                        })
                        .html(result);
                },
            });
        });

    $("#return_to_tambah").select2({
        dropdownAutoWidth: true,
        placeholder: "Silahkan Pilih Lokasi Empty Return",
        allowClear: true,
        dropdownParent: $("#modal-job-tambah"),
    });

    $("#valid_job_tambah")
        .submit(function (e) {
            e.preventDefault();
        })
        .validate({
            ignore: "select[type=hidden]",

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
                // console.log(new_id);
                var token = $("#csrf").val();

                let tanggal_kembali = document.getElementById(
                    "tanggal_kembali_tambah"
                ).value;
                tanggal_kembali = moment(
                    tanggal_kembali,
                    "dddd, DD-MMMM-YYYY"
                ).format("YYYY-MM-DD");
                console.log(tanggal_kembali);

                $.ajax({
                    url: "/detaildischarge-kontainer-tambah",
                    type: "POST",
                    data: {
                        _token: token,
                        job_id: $("#job_id").val(),
                        size: $("#size_tambah").val(),
                        type: $("#type_tambah").val(),
                        nomor_kontainer: $("#nomor_kontainer_tambah").val(),
                        cargo: $("#cargo_tambah").val(),
                        seal: $("#seal_tambah").val(),
                        tanggal_kembali: tanggal_kembali,
                        lokasi_kembali: $("#lokasi_kembali_tambah").val(),
                        penerima: $("#penerima_tambah").val(),
                        alamat_pengantaran: $(
                            "#alamat_pengantaran_tambah"
                        ).val(),
                        driver: $("#driver_tambah").val(),
                        nomor_polisi: $("#nomor_polisi_tambah").val(),
                        remark: $("#remark_tambah").val(),
                        biaya_cleaning: $("#biaya_cleaning_tambah")
                            .val()
                            .replace(/\./g, ""),
                        biaya_retribusi: $("#biaya_retribusi_tambah")
                            .val()
                            .replace(/\./g, ""),
                        biaya_retribusi: $("#biaya_retribusi_tambah")
                            .val()
                            .replace(/\./g, ""),
                        biaya_thc: $("#biaya_thc_tambah")
                            .val()
                            .replace(/\./g, ""),
                        biaya_trucking: $("#biaya_trucking_tambah")
                            .val()
                            .replace(/\./g, ""),
                        ongkos_supir: $("#ongkos_supir_tambah")
                            .val()
                            .replace(/\./g, ""),
                        biaya_seal: $("#biaya_seal_tambah")
                            .val()
                            .replace(/\./g, ""),

                        return_to: $("#return_to_tambah").val(),
                    },
                    success: function (response) {
                        swal.fire({
                            icon: "success",
                            title: "Kontainer Berhasil Ditambah",
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
            var data = {
                _token: $("input[name=_token]").val(),
                id: deleteid,
            };
            $.ajax({
                type: "DELETE",
                url: "/discharge-container-delete/" + deleteid,
                data: data,
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
            window.location.href = "/realisasidischarge-create/" + slugs;

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

function edit_planloaad_job() {
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
            nomor_do: {
                required: true,
            },
            tanggal_tiba: {
                required: true,
            },
        },
        messages: {
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
            nomor_do: {
                required: "Silakan Isi Masukkan Nomor DO",
            },
            tanggal_tiba: {
                required: "Silakan Isi Masukkan Tanggal Tiba",
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
            let pod = document.getElementById("POD_1").value;
            let pengirim = document.getElementById("Pengirim_1").value;
            let penerima = document.getElementById("Penerima_1").value;
            let old_slug = document.getElementById("old_slug").value;
            let nomor_do = document.getElementById("nomor_do").value;
            let biaya_do = $("#biaya_do").val().replace(/\./g, "");

            let tanggal_tiba = document.getElementById("tanggal_tiba").value;
            tanggal_tiba = moment(tanggal_tiba, "dddd, DD-MMMM-YYYY").format(
                "YYYY-MM-DD"
            );

            var fd = new FormData();

            fd.append("_token", token);
            fd.append("activity", activity);
            fd.append("select_company", select_company);
            fd.append("vessel", vessel);
            fd.append("vessel_code", vessel_code);
            fd.append("pol", pol);
            fd.append("pod", pod);
            fd.append("pengirim", pengirim);
            fd.append("penerima", penerima);
            fd.append("tanggal_tiba", tanggal_tiba);
            fd.append("nomor_do", nomor_do);
            fd.append("biaya_do", biaya_do);
            fd.append("old_slug", old_slug);

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
                        type: "POST",
                        url: "/update-job-plandischarge",
                        data: fd,
                        contentType: false,
                        processData: false,
                        dataType: "json",
                        success: function (response) {
                            console.log(response);

                            swal.fire({
                                title: "JOB DIUPDATE",
                                text: "JOB Telah Berhasil DIUPDATE",
                                icon: "success",
                                timer: 9e3,
                                showConfirmButton: false,
                            });
                            window.location.href =
                                "/processdischarge-create/" + response.slug;
                        },
                        error: function (response) {
                            console.log(response);

                            swal.fire({
                                title: "Ada yang Salah, Silahkan Cek Kembali Data Anda !!!",
                                text: response.error,
                                icon: "error",
                                timer: 10e3,
                                showConfirmButton: false,
                            });
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
                url: "/detailbarang-kontainer-discharge",
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
            $("#old_id_container_detail").val(
                response.detail_discharge[0].kontainer_id_discharge
            );
            $("#kontainer_detail_edit")
                .val(response.detail_discharge[0].kontainer_id_discharge)
                .is(":selected");
            console.log(
                response.detail_discharge[0].kontainer_id_discharge,
                id
            );

            edit_urutan_detail = response.detail_discharge.length;
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
                textarea.setAttribute("name", "edit_detail_barang[" + (i + 1) + "]");
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
                var icon = document.createElement("i");
                icon.setAttribute("class", "fa fa-trash");
                button.append(icon);
                div4.append(button);

                div2.append(label);
                div2.append(div3);
                div2.append(div4);

                div1.appendChild(div2);

                reindex_edit_detail();
            }

            for (var i = 0; i < edit_urutan_detail; i++) {
                document.getElementById(
                    "edit_detail_barang[" + (i + 1) + "]"
                ).value = response.detail_discharge[i].detail_barang;
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
                        url:
                            "/detailbarang-update-discharge/" +
                            old_id_container_detail,
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
                url: "/detailbarang-delete-discharge/" + deleteid,
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
    textarea.setAttribute("name", "detail_barang[" + urutan_detail + "]");
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
    textarea.setAttribute(
        "id",
        "edit_detail_barang[" + edit_urutan_detail + "]"
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
                    url: "/cetak-packing-list-discharge",
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
            // console.log(urutan_detail);

            var keterangan_biaya = [];

            for (let i = 0; i < urutan_biaya; i++) {
                keterangan_biaya[i] = document.getElementById(
                    "keterangan_biaya[" + (i + 1) + "]"
                ).value;
            }

            var data = {
                _token: token,
                job_id: $("#job_id").val(),
                harga_biaya: $("#harga_biaya").val().replace(/\./g, ""),
                kontainer_id: $("#kontainer_biaya").val(),
                keterangan_biaya: keterangan_biaya,
            };

            $.ajax({
                url: "/biayalain-kontainer-discharge",
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

var edit_urutan_biaya = 0;

function detail_biaya_lain_edit(e) {
    let id = e.value;
    // console.log(id);

    $.ajax({
        url: "/biayalainnya-edit-discharge/" + id,
        type: "GET",
        success: function (response) {
            console.log(response);
            $("#modal_biaya_lainnya_edit").modal("show");
            document.getElementById("edit_div_biaya").innerHTML = "";

            $("#old_id_container_biaya").val(
                response.result[0].kontainer_id_discharge
            );
            $("#kontainer_biaya_edit")
                .val(response.result[0].kontainer_id_discharge)
                .is(":selected");
            $("#harga_biaya_edit").val(response.total_biaya);

            edit_urutan_biaya = response.result.length;

            var div1 = document.getElementById("edit_div_biaya");

            for (var i = 0; i < edit_urutan_biaya; i++) {
                var div2 = document.createElement("div");
                div2.setAttribute("class", "row row-cols g-3");
                div2.setAttribute("id", "edit_body_biaya[" + (i + 1) + "]");

                var label = document.createElement("label");
                label.setAttribute("class", "col-sm-4 col-form-label");
                label.setAttribute("id", "edit_label_biaya");
                label.setAttribute("name", "edit_label_biaya");

                var div3 = document.createElement("div");
                div3.setAttribute(
                    "class",
                    "col-sm-6 validation-container d-grid gap-3"
                );
                div3.setAttribute("id", "edit_div_textarea_biaya");
                div3.setAttribute("name", "edit_div_textarea_biaya");
                var textarea = document.createElement("textarea");
                textarea.setAttribute("data-bs-toggle", "tooltip");
                textarea.setAttribute("class", "form-control");
                textarea.setAttribute(
                    "id",
                    "edit_keterangan_biaya[" + (i + 1) + "]"
                );
                textarea.setAttribute("name", "edit_keterangan_biaya");
                textarea.setAttribute("style", "margin-left: 10px");
                textarea.setAttribute(
                    "placeholder",
                    "ex. (Rp. 10.000 untuk kebutuhan kontainer)"
                );
                textarea.setAttribute("required", true);
                div3.append(textarea);

                var div4 = document.createElement("div");
                div4.setAttribute("class", "col-sm-2 py-4");
                div4.setAttribute("id", "edit_div_button_biaya");
                div4.setAttribute("name", "edit_div_button_biaya");
                var button = document.createElement("a");
                button.setAttribute(
                    "class",
                    "btn btn-sm btn-label-danger btn-icon"
                );
                button.setAttribute("id", "edit_hapus_biaya[" + (i + 1) + "]");
                button.setAttribute("name", "edit_hapus_biaya");
                button.setAttribute("style", "margin-left: 10px;");
                button.setAttribute("onclick", "edit_hapus_biaya(this)");
                icon = document.createElement("i");
                icon.setAttribute("class", "fa fa-trash");
                button.append(icon);
                div4.append(button);

                div2.append(label);
                div2.append(div3);
                div2.append(div4);

                div1.appendChild(div2);

                reindex_edit_keterangan_biaya();
            }

            for (var i = 0; i < edit_urutan_biaya; i++) {
                document.getElementById(
                    "edit_keterangan_biaya[" + (i + 1) + "]"
                ).value = response.result[i].keterangan;
            }

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

                    var keterangan_biaya = [];

                    console.log(edit_urutan_biaya);
                    for (let i = 0; i < edit_urutan_biaya; i++) {
                        keterangan_biaya[i] = document.getElementById(
                            "edit_keterangan_biaya[" + (i + 1) + "]"
                        ).value;
                    }
                    console.log(keterangan_biaya);
                    var token = $("#csrf").val();

                    var data = {
                        _token: token,
                        job_id: $("#job_id").val(),
                        kontainer_biaya: $("#kontainer_biaya_edit").val(),
                        old_id_container_biaya: old_id_container_biaya,
                        harga_biaya: $("#harga_biaya_edit")
                            .val()
                            .replace(/\./g, ""),
                        keterangan: keterangan_biaya,
                    };

                    $.ajax({
                        url:
                            "/biayalainnya-update-discharge/" +
                            old_id_container_biaya,
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
                url: "/biayalainnya-delete-discharge/" + deleteid,
                data: data,

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
                title: "Biaya Lain Container TIDAK DIHAPUS",
                icon: "error",
                timer: 10e3,
                showConfirmButton: false,
            });
        }
    });
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
    textarea.setAttribute(
        "placeholder",
        "ex. (Rp. 10.000 untuk kebutuhan kontainer)"
    );
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

function edit_tambah_biaya() {
    edit_urutan_biaya++;

    var div1 = document.getElementById("edit_div_biaya");

    var div2 = document.createElement("div");
    div2.setAttribute("class", "row row-cols g-3");
    div2.setAttribute("id", "edit_body_biaya[" + edit_urutan_biaya + "]");

    var label = document.createElement("label");
    label.setAttribute("class", "col-sm-4 col-form-label");
    label.setAttribute("id", "edit_label_biaya");
    label.setAttribute("name", "edit_label_biaya");

    var div3 = document.createElement("div");
    div3.setAttribute("class", "col-sm-6 validation-container d-grid gap-3");
    div3.setAttribute("id", "edit_div_textarea_biaya");
    div3.setAttribute("name", "edit_div_textarea_biaya");
    var textarea = document.createElement("textarea");
    textarea.setAttribute("data-bs-toggle", "tooltip");
    textarea.setAttribute("class", "form-control");
    textarea.setAttribute(
        "id",
        "edit_keterangan_biaya[" + edit_urutan_biaya + "]"
    );
    textarea.setAttribute("name", "edit_keterangan_biaya");
    textarea.setAttribute(
        "placeholder",
        "ex. (Rp. 10.000 untuk kebutuhan kontainer)"
    );
    textarea.setAttribute("style", "margin-left: 10px");
    textarea.setAttribute("required", true);
    div3.append(textarea);

    var div4 = document.createElement("div");
    div4.setAttribute("class", "col-sm-2 py-4");
    div4.setAttribute("id", "edit_div_button_biaya");
    div4.setAttribute("name", "edit_div_button_biaya");
    var button = document.createElement("a");
    button.setAttribute("class", "btn btn-sm btn-label-danger btn-icon");
    button.setAttribute("id", "edit_hapus_biaya[" + edit_urutan_biaya + "]");
    button.setAttribute("name", "edit_hapus_biaya");
    button.setAttribute("style", "margin-left: 10px;");
    button.setAttribute("onclick", "edit_hapus_biaya(this)");
    icon = document.createElement("i");
    icon.setAttribute("class", "fa fa-trash");
    button.append(icon);
    div4.append(button);

    div2.append(label);
    div2.append(div3);
    div2.append(div4);

    div1.appendChild(div2);

    reindex_edit_keterangan_biaya();
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

function reindex_edit_keterangan_biaya() {
    const ids = document.querySelectorAll("#edit_label_biaya");
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

function edit_hapus_biaya(ini) {
    var edit_urutan_delete_biaya = ini.parentNode.parentNode;
    edit_urutan_delete_biaya.remove();
    edit_urutan_biaya--;

    var label = document.querySelectorAll("#edit_label_biaya");

    for (var i = 0; i < label.length; i++) {
        label[i].innerHTML = "Keterangan Biaya Ke-" + edit_urutan_biaya + " :";
    }

    var div1 = document.querySelectorAll("#edit_div_textarea_biaya textarea");

    for (var i = 0; i < div1.length; i++) {
        div1[i].id = "edit_keterangan_biaya[" + (i + 1) + "]";
    }

    var div2 = document.querySelectorAll("#edit_div_button_biaya button");

    for (var i = 0; i < div2.length; i++) {
        div2[i].id = "edit_hapus_biaya[" + (i + 1) + "]";
    }

    if (edit_urutan_biaya == 0) {
        edit_tambah_biaya();
    }

    reindex_edit_keterangan_biaya();
}
