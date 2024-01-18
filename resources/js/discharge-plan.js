"use strict";


var table_container = $("#table_container").DataTable({
    responsive: true,
    pageLength: 5,
    lengthMenu: [
        [5, 10, 20, -1],
        [5, 10, 20, "All"],
    ],
    fixedHeader: {
        header: true,
    },
});

$("#tanggal_free").TouchSpin({
    buttondown_class: "btn btn-label-success",
    buttonup_class: "btn btn-label-success",
    step: 1,

});

function tambah_free_time(e){
    
    var hari_tiba = $("#tanggal_tiba").val();
    var hari_free_time = $("#tanggal_free").val()

    hari_tiba = moment(hari_tiba, "dddd, DD-MMMM-YYYY").format("YYYY-MM-DD");
    var someDate = new Date(hari_tiba);
    var result = someDate.setDate(someDate.getDate() + parseInt(hari_free_time));
    var hari_akhir = new Date(result);
    // console.log(result);
    hari_akhir = moment(hari_akhir, "YYYY-MM-DD").format("dddd, DD-MMMM-YYYY");

    document.getElementById("total_hari").value = hari_akhir
    
    
    // var max = moment($("#max").val(), "dddd, DD MMMM YYYY").format("YYYY-MM-DD");
    // var date_max = new Date(max);
    // console.log(date_max, date_min);
    // var seconds_max = Math.round(date_max.getTime() / 1000);

    // milis = milis.getHours();


    // console.log(milis);
}


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
            let tanggal_free = document.getElementById("tanggal_free").value;
            let total_hari = document.getElementById("total_hari").value;

            let tanggal_tiba = document.getElementById("tanggal_tiba").value;

            tanggal_tiba = moment(tanggal_tiba, "dddd, DD-MMMM-YYYY").format(
                "YYYY-MM-DD"
            );
            total_hari = moment(total_hari, "dddd, DD-MMMM-YYYY").format(
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
            fd.append("tanggal_free", tanggal_free);
            fd.append("total_hari", total_hari);

           
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
                            window.location.href =
                                "/plandischarge/" + response.slug;
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
            let tanggal_free = document.getElementById("tanggal_free").value;

            let tanggal_tiba = document.getElementById("tanggal_tiba").value;
            tanggal_tiba = moment(tanggal_tiba, "dddd, DD-MMMM-YYYY").format(
                "YYYY-MM-DD"
            );

            let total_hari = document.getElementById("total_hari").value;
            total_hari = moment(total_hari, "dddd, DD-MMMM-YYYY").format(
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
            fd.append("tanggal_free", tanggal_free);
            fd.append("total_hari", total_hari);
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
                            window.location.href =
                                "/plandischarge/" + response.slug;
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

    $("#valid_job_tambah")
        .submit(function (e) {
            e.preventDefault();
        })
        .validate({
            // ignore: "select[type=hidden]",

            rules: {
                size_tambah: {
                    required: true,
                },
                seal_tambah: {
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

            submitHandler: function (form) {
                // console.log(urutan_detail);
                var token = $("#csrf").val();

                var seal = [];

                for (let i = 0; i < urutan_detail; i++) {
                    seal[i] = document.getElementById(
                        "seal_tambah[" + (i + 1) + "]"
                    ).value;
                }

                var data = {
                    _token: token,
                    job_id: $("#job_id").val(),
                    size: $("#size_tambah").val(),
                    type: $("#type_tambah").val(),
                    nomor_kontainer: $("#nomor_kontainer_tambah").val(),
                    cargo: $("#cargo_tambah").val(),
                    seal: seal,
                    // biaya_seal: $("#biaya_seal_tambah").val().replace(/\./g, ""),
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

var edit_urutan_detail = 1;

function modal_edit(e) {
    let id = e.value;

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
        async: false,
        cache: false,
        processData: false,
        contentType: false,
        success: function (response) {
            console.log(response.seal_discharge[0].seal_kontainer);
            $("#size_edit").val(response.result.size);
            $("#type_edit").val(response.result.type);
            $("#nomor_kontainer_edit").val(response.result.nomor_kontainer);
            $("#no_container_edit").val(response.result.nomor_kontainer);
            $("#cargo_edit").val(response.result.cargo);

            $("#modal_edit").modal("show");
            document.getElementById("edit_div_detail").innerHTML = "";

            $("#new_id_edit").val(response.result.id);

            edit_urutan_detail = response.seal_discharge.length;

            var div1 = document.getElementById("edit_div_detail");

            for (var i = 0; i < edit_urutan_detail; i++) {
                if(i == 0) {
                    var div2 = document.createElement("div");
                    div2.setAttribute("class", "row row-cols");
                    div2.setAttribute("id", "edit_body_detail[" + (i + 1) + "]");
        
                    var label1 = document.createElement("label");
                    label1.setAttribute("id", "edit_id_tombol");
                    label1.setAttribute("name", "edit_id_tombol");
                    label1.setAttribute("class", "col-sm-4 col-form-label");
        
                    var a1 = document.createElement("a");
                    a1.setAttribute("id", "edit_tambah_seal");
                    a1.setAttribute("name", "edit_tambah_seal");
                    a1.setAttribute("class", "btn btn-sm btn-label-success btn-sm");
                    a1.setAttribute("onclick", "edit_tambah_seal()");
                    a1.innerHTML = "Seal <i class='fa fa-plus'></i>";
        
                    label1.append(a1);
        
                    var div3 = document.createElement("div");
                    div3.setAttribute("id", "edit_div_textarea");
                    div3.setAttribute("name", "edit_div_textarea");
                    div3.setAttribute("class", "col-sm-6 gap-3 validation-container");
                    div3.setAttribute("style", "margin-left: 6px");
        
                    var input1 = document.createElement("input");
                    input1.setAttribute("data-bs-toggle", "tooltip");
                    input1.setAttribute("type", "text");
                    input1.setAttribute("class", "form-control");
                    input1.setAttribute("id", "edit_seal_tambah[" + (i + 1) + "]");
                    input1.setAttribute("name", "edit_seal_tambah[" + (i + 1) + "]");
                    input1.setAttribute("placeholder", "Seal...");
                    input1.setAttribute("required", true);
        
                    div3.append(input1);
        
                    var div4 = document.createElement("div");
                    div4.setAttribute("id", "edit_div_button");
                    div4.setAttribute("name", "edit_div_button");
                    div4.setAttribute("class", "col-sm-1");
        
                    div2.append(label1);
                    div2.append(div3);
                    div2.append(div4);
        
                    div1.appendChild(div2);  
                } else {
                    var div2 = document.createElement("div");
                    div2.setAttribute("class", "row row-cols");
                    div2.setAttribute("id", "edit_body_detail[" + (i + 1) + "]");
        
                    var label1 = document.createElement("label");
                    label1.setAttribute("id", "edit_id_tombol");
                    label1.setAttribute("name", "edit_id_tombol");
                    label1.setAttribute("class", "col-sm-4 col-form-label");
        
        
                    var div3 = document.createElement("div");
                    div3.setAttribute("id", "edit_div_textarea");
                    div3.setAttribute("name", "edit_div_textarea");
                    div3.setAttribute("class", "col-sm-6 gap-3 validation-container");
                    div3.setAttribute("style", "margin-left: 6px");
        
                    var input1 = document.createElement("input");
                    input1.setAttribute("data-bs-toggle", "tooltip");
                    input1.setAttribute("type", "text");
                    input1.setAttribute("class", "form-control");
                    input1.setAttribute("id", "edit_seal_tambah[" + (i + 1) + "]");
                    input1.setAttribute("name", "edit_seal_tambah[" + (i + 1) + "]");
                    input1.setAttribute("placeholder", "Seal...");
                    input1.setAttribute("required", true);
        
                    div3.append(input1);
        
                    var div4 = document.createElement("div");
                    div4.setAttribute("id", "edit_div_button");
                    div4.setAttribute("name", "edit_div_button");
                    div4.setAttribute("class", "col-sm-1");

                    var a2 = document.createElement("a");
                    a2.setAttribute("class", "btn btn-sm btn-label-danger btn-icon");
                    a2.setAttribute("id", "edit_delete_seal[" + (i + 1) + "]");
                    a2.setAttribute("name", "edit_delete_seal");
                    a2.setAttribute("onclick", "edit_delete_seal(this)");

                    var i1 = document.createElement("i");
                    i1.setAttribute("class", "fa fa-trash");

                    a2.append(i1);
                    div4.append(a2);
        
                    div2.append(label1);
                    div2.append(div3);
                    div2.append(div4);
        
                    div1.appendChild(div2);  
                }
            }

            for(var i = 0; i < edit_urutan_detail; i++) {
                document.getElementById("edit_seal_tambah[" + (i + 1) + "]").value = response.seal_discharge[i].seal_kontainer;
            }

        $("#valid_job_edit")
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

            submitHandler: function (form) {
                // console.log(urutan_detail);
                var token = $("#csrf").val();
                var new_id_edit = $("#new_id_edit").val();

                var seal = [];

                for (let i = 0; i < edit_urutan_detail; i++) {
                    seal[i] = document.getElementById(
                        "edit_seal_tambah[" + (i + 1) + "]"
                    ).value;
                }

                var data = {
                    _token: token,
                    job_id: $("#job_id").val(),
                    size: $("#size_edit").val(),
                    type: $("#type_edit").val(),
                    nomor_kontainer: $("#nomor_kontainer_edit").val(),
                    cargo: $("#cargo_edit").val(),
                    seal: seal,
                };

                $.ajax({
                    url: "/plandischarge-kontainer/"+ new_id_edit,
                    type: "PUT",
                    data: data,
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

var urutan_detail = 1;

function tambah_seal() {
    urutan_detail++;

    var div1 = document.getElementById("div_detail");
    var div2 = document.createElement("div");
    div2.setAttribute("class", "row row-cols");
    div2.setAttribute("id", "body_detail[" + urutan_detail + "]");
    var label = document.createElement("label");
    label.setAttribute("class", "col-sm-4 col-form-label");
    label.setAttribute("id", "label_detail");
    label.setAttribute("name", "label_detail");
    div2.append(label);
    var div3 = document.createElement("div");
    div3.setAttribute("class", "col-sm-6 validation-container");
    div3.setAttribute("id", "div_textarea");
    div3.setAttribute("name", "div_textarea");
    div3.setAttribute("style", "margin-left: 6px");
    var input = document.createElement("input");
    input.setAttribute("data-bs-toggle", "tooltip");
    input.setAttribute("class", "form-control");
    input.setAttribute("id", "seal_tambah[" + urutan_detail + "]");
    input.setAttribute("name", "seal_tambah[" + urutan_detail + "]");
    input.setAttribute("type", "text");
    input.setAttribute("placeholder", "Seal..");
    input.setAttribute("required", true);
    input.setAttribute("data-rule-required", true);
    div3.append(input);

    var div4 = document.createElement("div");
    div4.setAttribute("class", "col-sm-1");
    div4.setAttribute("id", "div_button");
    div4.setAttribute("name", "div_button");
    var button = document.createElement("a");
    button.setAttribute("class", "btn btn-sm btn-label-danger btn-icon");
    button.setAttribute("id", "delete_seal[" + urutan_detail + "]");
    button.setAttribute("name", "delete_seal");
    button.setAttribute("onclick", "delete_seal(this)");
    var icon = document.createElement("i");
    icon.setAttribute("class", "fa fa-trash");
    button.append(icon);
    div4.append(button);

    div2.append(div3);
    div2.append(div4);

    div1.appendChild(div2);

    // reindex_detail();
}

function edit_tambah_seal() {
    edit_urutan_detail++;

    var div1 = document.getElementById("edit_div_detail");

    var div2 = document.createElement("div");
    div2.setAttribute("class", "row row-cols");
    div2.setAttribute("id", "edit_body_detail[" + edit_urutan_detail + "]");

    var label1 = document.createElement("label");
    label1.setAttribute("id", "edit_id_tombol");
    label1.setAttribute("name", "edit_id_tombol");
    label1.setAttribute("class", "col-sm-4 col-form-label");

    var div3 = document.createElement("div");
    div3.setAttribute("id", "edit_div_textarea");
    div3.setAttribute("name", "edit_div_textarea");
    div3.setAttribute("class", "col-sm-6 gap-3 validation-container");
    div3.setAttribute("style", "margin-left: 6px");

    var input1 = document.createElement("input");
    input1.setAttribute("data-bs-toggle", "tooltip");
    input1.setAttribute("type", "text");
    input1.setAttribute("class", "form-control");
    input1.setAttribute("id", "edit_seal_tambah[" + edit_urutan_detail + "]");
    input1.setAttribute("name", "edit_seal_tambah[" + edit_urutan_detail + "]");
    input1.setAttribute("placeholder", "Seal...");
    input1.setAttribute("required", true);

    div3.append(input1);

    var div4 = document.createElement("div");
    div4.setAttribute("id", "edit_div_button");
    div4.setAttribute("name", "edit_div_button");
    div4.setAttribute("class", "col-sm-1");

    var a2 = document.createElement("a");
    a2.setAttribute("class", "btn btn-sm btn-label-danger btn-icon");
    a2.setAttribute("id", "edit_delete_seal[" + edit_urutan_detail + "]");
    a2.setAttribute("name", "edit_delete_seal");
    a2.setAttribute("onclick", "edit_delete_seal(this)");

    var i1 = document.createElement("i");
    i1.setAttribute("class", "fa fa-trash");

    a2.append(i1);
    div4.append(a2);

    div2.append(label1);
    div2.append(div3);
    div2.append(div4);

    div1.appendChild(div2);
}

function reindex_detail() {
    const ids = document.querySelectorAll("#label_detail");
    ids.forEach((e, i) => {});
}

function delete_seal(ini) {
    var urutan_delete = ini.parentNode.parentNode;
    urutan_delete.remove();
    urutan_detail--;

    // var label = document.querySelectorAll("#label_detail");

    // for (var i = 0; i < label.length; i++) {
    //     label[i].innerHTML = "";
    // }

    var div1 = document.querySelectorAll("#div_textarea input");

    for (var i = 0; i < div1.length; i++) {
        div1[i].id = "seal_tambah[" + (i + 1) + "]";
        div1[i].name = "seal_tambah[" + (i + 1) + "]";
    }

    var div2 = document.querySelectorAll("#div_button button");

    for (var i = 0; i < div2.length; i++) {
        div2[i].id = "delete_seal[" + (i + 1) + "]";
        div2[i].name = "delete_seal[" + (i + 1) + "]";
    }

    // reindex_detail();
}


function edit_delete_seal(ini) {
    var edit_urutan_delete = ini.parentNode.parentNode;
    edit_urutan_delete.remove();
    edit_urutan_detail--;

    var div1 = document.querySelectorAll("#edit_div_textarea input");

    for (var i = 0; i < div1.length; i++) {
        div1[i].id = "edit_seal_tambah[" + (i + 1) + "]";
    }

    var div2 = document.querySelectorAll("#edit_div_button button");

    for (var i = 0; i < div2.length; i++) {
        div2[i].id = "edit_delete_seal[" + (i + 1) + "]";
    }


    // reindex_detail();
}

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

            for (var i = 0; i < edit_urutan_detail; i++) {
                document.getElementById(
                    "edit_detail_barang[" + (i + 1) + "]"
                ).value = response.result[i].detail_barang;
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
