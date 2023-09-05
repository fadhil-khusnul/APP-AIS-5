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

            var seals = [""];

            for (let i = 0; i < response.seal_discharge.length; i++) {
                seals[i] = response.seal_discharge[i].seal_kontainer;
            }
            
            $("#modal-job").modal("show");

            $("#size").val(response.result.size);
            $("#type").val(response.result.type);
            $("#biaya_seal").val("");
            $("#nomor_kontainer").val(response.result.nomor_kontainer);
            // console.log($("#nomor_kontainer").val(response.result.nomor_kontainer));
            $("#cargo").val(response.result.cargo);
            $("#detail_barang").val(response.result.detail_barang);
            $("#seal")
                .val(seals)
                .select2({
                    ajax: {
                        dataType: 'json',
                        delay: 250,
                        async: false,
                        cache: false,

                    },
                    dropdownAutoWidth: true,
                    // tags: true,
                    placeholder: "Silahkan Pilih Seal",
                    // allowClear:true,
                    maximumSelectionLength: 4,
                    dropdownParent: $("#modal-job"),
                    // multiple: true,
                    // ajax: {
                    //     async: false
                    // }
                })
                .off("select2:select").on("select2:select", function (e) {
                    // console.log(e);
                    var selected_element = $(e.currentTarget);
                    var select_val = selected_element.val();

                    var element = e.params.data.element;
                    var $element = $(element);

                    $element.detach();
                    $(this).append($element);
                    $(this).trigger("change");

                    let token = $("#csrf").val();
                    // var count = 0
                    // count += 1

                    // for(var i = 0; i <= count; i++) {
                    //     if(i ===)
                    // }
                    // var ev = e;
                    // console.log(token);

                    $.ajax({
                        url: "/getSealProcessLoad",
                        type: "post",
                        async: false,
                        data: {
                            _token: token,
                        },
                        success: function (response) {
                            // console.log(ev);
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
                                        $("#seal").trigger("change.select2");
                                        console.log(last_seal);
                                        var harga_seal = $("#biaya_seal").val().replace(/\./g, "");
                                        harga_seal = parseFloat(harga_seal);

                                        // console.log(response);
                                        // console.log(seal_already);

                                        if (isNaN(harga_seal)) {
                                            harga_seal = 0;
                                        }

                                        var harga_seal_now =
                                            harga_seal + response;
                                        $("#biaya_seal").val(harga_seal_now);
                                        
                                    },
                                    async: false,
                                    cache: false,


                                });
                            }
                        },
                        async: false,
                        cache: false,


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
                .off("select2:unselect").on("select2:unselect", function (e) {
                    // var seal = $("#seal").val();
                    // console.log(seal);
                    // var last_seal = seal[seal.length - 1];

                    var selected_element = $(e.currentTarget);
                    var select_val = selected_element.val();

                    var element = e.params.data.element;
                    var $element = $(element);

                    let token = $("#csrf").val();

                    $element.detach();
                    $(this).append($element);{{  }}
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
                    // console.log(new_id);
                    var token = $("#csrf").val();

                    let tanggal_kembali =
                        document.getElementById("tanggal_kembali").value;
                    tanggal_kembali = moment(tanggal_kembali, "dddd, DD-MMMM-YYYY").format("YYYY-MM-DD")
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
                            tanggal_kembali: tanggal_kembali,
                            lokasi_kembali: $("#lokasi_kembali").val(),
                            penerima: $("#penerima").val(),
                            alamat_pengantaran: $("#alamat_pengantaran").val(),
                            driver: $("#driver").val(),
                            nomor_polisi: $("#nomor_polisi").val(),
                            remark: $("#remark").val(),
                            biaya_cleaning: $("#biaya_cleaning").val().replace(/\./g, ""),
                            biaya_retribusi: $("#biaya_retribusi").val().replace(/\./g, ""),
                            biaya_retribusi: $("#biaya_retribusi").val().replace(/\./g, ""),
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
        success: function (response) {
            let new_id = id;

            var seals = [""];

            for (let i = 0; i < response.seal_discharge.length; i++) {
                seals[i] = response.seal_discharge[i].seal_kontainer;
            }
            
            $("#modal-job-edit").modal("show");

            $("#size_edit").val(response.result.size);
            $("#type_edit").val(response.result.type);
            $("#biaya_seal_edit").val("");
            $("#nomor_kontainer_edit").val(response.result.nomor_kontainer);
            $("#cargo_edit").val(response.result.cargo);
            $("#seal_edit")
                .val(seals)
                .select2({
                    ajax: {
                        dataType: 'json',
                        delay: 250,
                        async: false,
                        cache: false,

                    },
                    dropdownAutoWidth: true,
                    // tags: true,
                    placeholder: "Silahkan Pilih Seal",
                    // allowClear:true,
                    maximumSelectionLength: 4,
                    dropdownParent: $("#modal-job-edit"),
                    // multiple: true,
                    // ajax: {
                    //     async: false
                    // }
                })
                .off("select2:select").on("select2:select", function (e) {
                    // console.log(e);
                    var selected_element = $(e.currentTarget);
                    var select_val = selected_element.val();

                    var element = e.params.data.element;
                    var $element = $(element);

                    $element.detach();
                    $(this).append($element);
                    $(this).trigger("change");

                    let token = $("#csrf").val();
                    // var count = 0
                    // count += 1

                    // for(var i = 0; i <= count; i++) {
                    //     if(i ===)
                    // }
                    // var ev = e;
                    // console.log(token);

                    $.ajax({
                        url: "/getSealProcessLoad",
                        type: "post",
                        async: false,
                        data: {
                            _token: token,
                        },
                        success: function (response) {
                            // console.log(ev);
                            var seal = $("#seal_edit").val();
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
                                        '#seal_edit option[value="' +
                                            last_seal +
                                            '"]'
                                    );
                                    wanted_option.prop("selected", false);
                                    $("#seal_edit").trigger("change.select2");
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
                                        $("#seal_edit").trigger("change.select2");
                                        console.log(last_seal);
                                        var harga_seal = $("#biaya_seal_edit").val().replace(/\./g, "");
                                        harga_seal = parseFloat(harga_seal);

                                        // console.log(response);
                                        // console.log(seal_already);

                                        if (isNaN(harga_seal)) {
                                            harga_seal = 0;
                                        }

                                        var harga_seal_now =
                                            harga_seal + response;
                                        $("#biaya_seal_edit").val(harga_seal_now);
                                        
                                    },
                                    async: false,
                                    cache: false,


                                });
                            }
                        },
                        async: false,
                        cache: false,


                    });
                });

            $("#seal_edit")
                .val(seals)
                .select2({
                    dropdownAutoWidth: true,

                    // tags: true,
                    placeholder: "Silahkan Pilih Seal",
                    // allowClear:true,
                    maximumSelectionLength: 4,
                    dropdownParent: $("#modal-job-edit"),
                })
                .off("select2:unselect").on("select2:unselect", function (e) {
                    // var seal = $("#seal").val();
                    // console.log(seal);
                    // var last_seal = seal[seal.length - 1];

                    var selected_element = $(e.currentTarget);
                    var select_val = selected_element.val();

                    var element = e.params.data.element;
                    var $element = $(element);

                    let token = $("#csrf").val();

                    $element.detach();
                    $(this).append($element);{{  }}
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
                                .getElementById("biaya_seal_edit")
                                .value.replace(/\./g, "");
                            harga_seal = parseFloat(harga_seal);

                            if (isNaN(harga_seal)) {
                                harga_seal = 0;
                            }

                            var harga_seal_now = harga_seal - response;
                            $("#biaya_seal_edit").val(harga_seal_now);
                        },
                    });
                });
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
            $("#alamat_pengantaran_edit").val(response.result.alamat_pengantaran);
            $("#biaya_seal_edit").val(response.result.biaya_seal);
            $("#biaya_cleaning_edit").val(response.result.biaya_cleaning);
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
                    // console.log(new_id);
                    var token = $("#csrf").val();

                    let tanggal_kembali =
                        document.getElementById("tanggal_kembali_edit").value;
                    tanggal_kembali = moment(tanggal_kembali, "dddd, DD-MMMM-YYYY").format("YYYY-MM-DD")
                    console.log(tanggal_kembali);

                    $.ajax({
                        url: "/detaildischarge-kontainer-edit/" + new_id,
                        type: "PUT",
                        data: {
                            _token: token,
                            job_id: $("#job_id").val(),
                            size: $("#size_edit").val(),
                            type: $("#type_edit").val(),
                            nomor_kontainer: $("#nomor_kontainer_edit").val(),
                            cargo: $("#cargo_edit").val(),
                            seal: $("#seal_edit").val(),
                            seal_old : seals,
                            tanggal_kembali: tanggal_kembali,
                            lokasi_kembali: $("#lokasi_kembali_edit").val(),
                            penerima: $("#penerima_edit").val(),
                            alamat_pengantaran: $("#alamat_pengantaran_edit").val(),
                            driver: $("#driver_edit").val(),
                            nomor_polisi: $("#nomor_polisi_edit").val(),
                            remark: $("#remark_edit").val(),
                            biaya_cleaning: $("#biaya_cleaning_edit").val().replace(/\./g, ""),
                            biaya_retribusi: $("#biaya_retribusi_edit").val().replace(/\./g, ""),
                            biaya_retribusi: $("#biaya_retribusi_edit").val().replace(/\./g, ""),
                            biaya_thc: $("#biaya_thc_edit").val().replace(/\./g, ""),
                            biaya_trucking: $("#biaya_trucking_edit")
                                .val()
                                .replace(/\./g, ""),
                            ongkos_supir: $("#ongkos_supir_edit")
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
        .off("select2:select").on("select2:select", function (e) {
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
        .off("select2:unselect").on("select2:unselect", function (e) {
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

    $("#lokasi_kembali_tambah")
        .select2({
            dropdownAutoWidth: true,
            placeholder: "Silahkan Pilih Lokasi Pickup",
            allowClear: true,
            dropdownParent: $("#modal-job-tambah"),
        });
    
    $("#penerima_tambah")
        .select2({
            dropdownAutoWidth: true,
            placeholder: "Silahkan Pilih penerima",
            allowClear: true,
            dropdownParent: $("#modal-job-tambah"),
        });

    $("#nomor_polisi_tambah")
        .select2({
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

     $("#return_to_tambah")
        .select2({
            dropdownAutoWidth: true,
            placeholder: "Silahkan Pilih Lokasi Empty Return",
            allowClear: true,
            dropdownParent: $("#modal-job-tambah"),
        });



    
    $("#valid_job_tambah").submit(function(e) {
        e.preventDefault();
    }).validate({
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
            // console.log(new_id);
            var token = $("#csrf").val();

            let tanggal_kembali =
                document.getElementById("tanggal_kembali_tambah").value;
            tanggal_kembali = moment(tanggal_kembali, "dddd, DD-MMMM-YYYY").format("YYYY-MM-DD")
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
                    alamat_pengantaran: $("#alamat_pengantaran_tambah").val(),
                    driver: $("#driver_tambah").val(),
                    nomor_polisi: $("#nomor_polisi_tambah").val(),
                    remark: $("#remark_tambah").val(),
                    biaya_cleaning: $("#biaya_cleaning_tambah").val().replace(/\./g, ""),
                    biaya_retribusi: $("#biaya_retribusi_tambah").val().replace(/\./g, ""),
                    biaya_retribusi: $("#biaya_retribusi_tambah").val().replace(/\./g, ""),
                    biaya_thc: $("#biaya_thc_tambah").val().replace(/\./g, ""),
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
                            window.location.href = "/processdischarge-create/"+response.slug;
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
                        }
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

