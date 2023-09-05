"use strict";


function CreateJobPlanDischarge() {
    var swal = Swal.mixin({
        customClass: {
            confirmButton: "btn btn-label-success btn-wide mx-1",
            denyButton: "btn btn-label-secondary btn-wide mx-1",
            cancelButton: "btn btn-label-danger btn-wide mx-1",
        },
        buttonsStyling: false,
    });

    $("#valid_planload").validate({
        // ignore: [],
        ignore: "input[type=hidden]",
        rules: {
            // tanggal_planload: {
            //     required: true,
            // },
            activity: {
                required: true,
            },
            nomor_do: {
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
            penerima_1: {
                required: true,
            },
            Pengirim_1: {
                required: true,
            },
            tanggal_tiba: {
                required: true,
            },
        },
        messages: {
            // tanggal_planload: {
            //     required: "Silakan Isi Tanggal",
            // },
            nomor_do: {
                required: "Silakan Masukkan Nomor DO",
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
                required: "Silakan Isi Vessel Code",
            },
            POL_1: {
                required: "Silakan Pilih POL",
            },
            POD_1: {
                required: "Silakan Pilih POD",
            },
            penerima_1: {
                required: "Silakan Pilih Penerima",
            },
            Pengirim_1: {
                required: "Silakan Pilih Pengirim",
            },
            tanggal_tiba: {
                required: "Silakan Isi Tanggal Tiba",
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
            let penerima = document.getElementById("penerima_1").value;
            let nomor_do = document.getElementById("nomor_do").value;

            let tanggal_tiba = document.getElementById("tanggal_tiba").value;

            tanggal_tiba = moment(tanggal_tiba, "dddd, DD-MMMM-YYYY").format(
                "YYYY-MM-DD"
            );


            var fd = new FormData();
            fd.append("_token", token);
            fd.append("tanggal_tiba", tanggal_tiba);
            fd.append("activity", activity);
            fd.append("select_company", select_company);
            fd.append("vessel_code", vessel_code);
            fd.append("vessel", vessel);
            fd.append("pol", pol);
            fd.append("pod", pod);
            fd.append("pengirim", pengirim);
            fd.append("penerima", penerima);
            fd.append("nomor_do", nomor_do);


            // for (var i = 0; i < tambah; i++) {
            //     size[i] = document.getElementById(
            //         "size[" + (i + 1) + "]"
            //     ).value;
            //     type[i] = document.getElementById(
            //         "type[" + (i + 1) + "]"
            //     ).value;
            //     nomor_container[i] = document.getElementById(
            //         "nomor-container[" + (i + 1) + "]"
            //     ).value;
            //     seal[i] = document.getElementById(
            //         "seal[" + (i + 1) + "]"
            //     ).selectedOptions;
            //     seal[i] = Array.from(seal[i]).map(({ value }) => value);
            //     cargo[i] = document.getElementById(
            //         "cargo[" + (i + 1) + "]"
            //     ).value;

            //     fd.append("size[]", size[i]);
            //     fd.append("type[]", type[i]);
            //     fd.append("nomor_container[]", nomor_container[i]);
            //     fd.append("cargo[]", cargo[i]);

            //     for (var j = 0; j < seal[i].length; j++) {
            //         fd.append("seal[" + i + "][]", seal[i][j]);
            //     }
            // }
            // console.log(seal);

            // console.log(size, type, nomor_container, seal, cargo);

            swal.fire({
                title: "Apakah anda yakin?",
                text: "Ingin Membuat Plan Discharge Ini",
                icon: "question",
                showCancelButton: true,
                confirmButtonText: "Iya",
                cancelButtonText: "Tidak",
            }).then((willCreate) => {
                if (willCreate.isConfirmed) {
                    $.ajax({
                        type: "POST",
                        url: "/create-job-plandischarge",
                        data: fd,
                        contentType: false,
                        processData: false,
                        dataType: "json",
                        success: function (response) {
                            swal.fire({
                                title: "Plan Discharge Dibuat",
                                text: "Plan cDischarge Telah Berhasil Dibuat",
                                icon: "success",
                                timer: 2e3,
                                showConfirmButton: false,
                            });
                            window.location.href = "/plandischarge/"+ response.slug;
                        },
                    });
                } else {
                    swal.fire({
                        title: "Data Belum Dibuat",
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


function UpdateteJobPlanDischarge() {
    var swal = Swal.mixin({
        customClass: {
            confirmButton: "btn btn-label-success btn-wide mx-1",
            denyButton: "btn btn-label-secondary btn-wide mx-1",
            cancelButton: "btn btn-label-danger btn-wide mx-1",
        },
        buttonsStyling: false,
    });

    $("#valid_planload").validate({
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

            let tanggal_tiba = document.getElementById("tanggal_tiba").value;
            tanggal_tiba = moment(tanggal_tiba, "dddd, DD-MMMM-YYYY").format(
                "YYYY-MM-DD"
            );

            // let biaya_do = 0;

           

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
            // fd.append("biaya_do", biaya_do);

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
                            window.location.href = "/plandischarge/"+response.slug;
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



function modal_tambah() {
    $("#modal_tambah").modal("show");
    var swal = Swal.mixin({
        customClass: {
            confirmButton: "btn btn-success btn-wide mx-1",
            denyButton: "btn btn-secondary btn-wide mx-1",
            cancelButton: "btn btn-danger btn-wide mx-1",
        },
        buttonsStyling: false,
    });

    

    $("#seal_tambah")
        .select2({
            dropdownAutoWidth: true,
            // tags: true,
            placeholder: "Silahkan Pilih",
            // allowClear:true,
            maximumSelectionLength: 4,
            dropdownParent: $("#modal_tambah"),
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
            dropdownParent: $("#modal_tambah"),
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

            var data = {
                _token: token,
                job_id: $("#job_id").val(),
                size: $("#size_tambah").val(),
                type: $("#type_tambah").val(),
                nomor_kontainer: $("#nomor_kontainer_tambah").val(),
                cargo: $("#cargo_tambah").val(),
                seal: $("#seal_tambah").val(),
                biaya_seal: $("#biaya_seal_tambah").val().replace(/\./g, ""),

            };

            $.ajax({
                url: "/tambah-kontainer-plandischarge",
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

function modal_edit(e) {
   
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
    let token = $("#csrf").val();


    $.ajax({
        url: "/detail-kontainer-discharge/" + id + "/input",
        data: {
            _token: token,
        },
        type: "GET",
        async:false,
        cache: false,
        processData: false,
        contentType: false,
        success: function (response) {
            console.log(response);
            let new_id = id;
            var seals = [""];
            

            for (let i = 0; i < response.seal_discharge.length; i++) {
                seals[i] = response.seal_discharge[i].seal_kontainer;
            }
            
            $("#seal_old").val(response.result.size);
           
            $("#modal_edit").modal("show");

            $("#size_edit").val(response.result.size);
           
            $("#type_edit").val(response.result.type);
            $("#nomor_kontainer_edit").val(response.result.nomor_kontainer);
            $("#no_container_edit").val(response.result.nomor_kontainer);
            $("#cargo_edit").val(response.result.cargo);
            $("#biaya_seal_edit").val(response.result.biaya_seal);
            $("#seal_old").val(seals);

            $("#seal_edit")
                .val(seals)
                .select2({
                    dropdownAutoWidth: true,
                    // tags: true,
                    placeholder: "Silahkan Pilih",
                    // allowClear:true,
                    maximumSelectionLength: 4,
                    dropdownParent: $("#modal_edit"),
                })
                .off("select2:select").on("select2:select", function (e) {
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
                            var seal = $("#seal_edit").val();
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
                                            '#seal_edit option[value="' +
                                                last_seal +
                                                '"]'
                                        );
                                        wanted_option.prop("selected", false);
                                        // $(this).trigger("change.select2");
                                        $("#seal_edit").trigger(
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
                                                    "biaya_seal_edit"
                                                )
                                                .value.replace(/\./g, "");
                                            harga_seal = parseFloat(harga_seal);

                                            if (isNaN(harga_seal)) {
                                                harga_seal = 0;
                                            }

                                            var harga_seal_now =
                                                harga_seal + response;
                                            $("#biaya_seal_edit").val(
                                                harga_seal_now
                                            );
                                        },
                                    });
                                }
                            }
                        },
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
                    dropdownParent: $("#modal_edit"),
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
            $("#seal_old")
                .val(seals)
                .select2({
                    dropdownAutoWidth: true,
                    // tags: true,
                    placeholder: "Silahkan Pilih",
                    // allowClear:true,
                    maximumSelectionLength: 4,
                    dropdownParent: $("#modal_edit"),
                })
                .off("select2:select").on("select2:select", function (e) {
                    var selected_element = $(e.currentTarget);
                    var select_val = selected_element.val();
                    // console.log(select_val);

                    // console.log(seals);

                    var element = e.params.data.element;
                    var $element = $(element);

                    $element.detach();
                    $(this).append($element);
                    $(this).trigger("change");

                });
            $("#seal_old")
                .val(seals)
                .select2({
                    dropdownAutoWidth: true,
                    // tags: true,
                    placeholder: "Silahkan Pilih Seal",
                    // allowClear:true,
                    maximumSelectionLength: 4,
                    dropdownParent: $("#modal_edit"),
                })
                .off("select2:unselect").on("select2:unselect", function (e) {

                    var selected_element = $(e.currentTarget);
                    var select_val = selected_element.val();

                    var element = e.params.data.element;
                    var $element = $(element);

                    let token = $("#csrf").val();

                    $element.detach();
                    $(this).append($element);
                    $(this).trigger("change");

                    
                });
          

            $("#new_id_edit").val(response.result.id);
            $("#valid_job_edit").validate({
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
                    var new_id = document.getElementById("new_id_edit").value;
                    console.log(seals);

                    // var seal_old = document.getElementById("seal_old").value;
                    var token = $("#csrf").val();

                    $.ajax({
                        url: "/plandischarge-kontainer/" + new_id,
                        type: "PUT",
                        data: {
                            _token: token,
                            job_id: $("#job_id").val(),
                            size: $("#size_edit").val(),
                            type: $("#type_edit").val(),
                            nomor_kontainer: $("#nomor_kontainer_edit").val(),
                            cargo: $("#cargo_edit").val(),
                            seal: $("#seal_edit").val(),
                            biaya_seal: $("#biaya_seal_edit").val().replace(/\./g, ""),
                            seal_old: seals,
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

function process_page(slug) {
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
        title: "Apakah anda yakin Ingin Beralih Ke Halaman Process Untuk JOB ini ?",
        icon: "warning",
        showCancelButton: true,
        confirmButtonText: "Iya",
        cancelButtonText: "Tidak",
    }).then((willCreate) => {
        if (willCreate.isConfirmed) {
            window.location.href = "/processdischarge-create/" + slugs;

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
