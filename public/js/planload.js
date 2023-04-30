var tambah = 0;

function CreateJobPlanload() {
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
            tanggal_planload: {
                required: true,
            },
            activity: {
                required: true,
            },
            select_company: {
                required: true,
            },
            vessel: {
                required: true,
            },
            POL_1: {
                required: true,
            },
            POT_1: {
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
            nama_barang: {
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
            POL_1: {
                required: "Silakan Pilih POL",
            },
            POT_1: {
                required: "Silakan Pilih POT",
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
            let tanggal_planload =
                document.getElementById("tanggal_planload").value;
            let tempDate = new Date(tanggal_planload);
            let formattedDate = [
                tempDate.getFullYear(),
                tempDate.getMonth() + 1,
                tempDate.getDate(),
            ].join("-");
            let activity = document.getElementById("activity").value;
            let select_company =
                document.getElementById("select_company").value;
            let vessel = document.getElementById("vessel").value;
            let pol = document.getElementById("POL_1").value;
            let pot = document.getElementById("POT_1").value;
            let pod = document.getElementById("POD_1").value;
            let pengirim = document.getElementById("Pengirim_1").value;
            let penerima = document.getElementById("Penerima_1").value;
            let nama_barang = document.getElementById("nama_barang").value;

            var kontainer = [];
            var size = [];
            var type = [];
            var fd = new FormData();

            for (let i = 0; i < tambah; i++) {
                kontainer[i] = document.getElementById(
                    "kontainer[" + (i + 1) + "]"
                ).value;
                fd.append("kontainer[]", kontainer[i]);
                size[i] = document.getElementById(
                    "size[" + (i + 1) + "]"
                ).innerHTML;
                fd.append("size[]", size[i]);
                type[i] = document.getElementById(
                    "type[" + (i + 1) + "]"
                ).innerHTML;
                fd.append("type[]", type[i]);
            }

            fd.append("tanggal_planload", formattedDate);
            fd.append("activity", activity);
            fd.append("select_company", select_company);
            fd.append("vessel", vessel);
            fd.append("pol", pol);
            fd.append("pot", pot);
            fd.append("pod", pod);
            fd.append("pengirim", pengirim);
            fd.append("penerima", penerima);
            fd.append("nama_barang", nama_barang);
            fd.append("_token", token);
            fd.append("tambah", tambah);

            swal.fire({
                title: "Apakah anda yakin?",
                text: "Ingin Membuat Job Ini",
                icon: "warning",
                showCancelButton: true,
                confirmButtonText: "Iya",
                cancelButtonText: "Tidak",
            }).then((willCreate) => {
                if (willCreate.isConfirmed) {
                    $.ajax({
                        type: "POST",
                        url: "/create-job-planload",
                        data: fd,
                        contentType: false,
                        processData: false,
                        dataType: "json",
                        success: function (response) {
                            swal.fire({
                                title: "JOB Planload Dibuat",
                                text: "JOB Planload Telah Berhasil Dibuat",
                                icon: "success",
                                timer: 2e3,
                                showConfirmButton: false,
                            });
                            window.location.href = "../planload";
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

function UpdateteJobPlanload() {
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
            tanggal_planload: {
                required: true,
            },
            activity: {
                required: true,
            },
            select_company: {
                required: true,
            },
            vessel: {
                required: true,
            },
            POL_1: {
                required: true,
            },
            POT_1: {
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
            nama_barang: {
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
            POL_1: {
                required: "Silakan Pilih POL",
            },
            POT_1: {
                required: "Silakan Pilih POT",
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
            let tanggal_planload =
                document.getElementById("tanggal_planload").value;
            let tempDate = new Date(tanggal_planload);
            let formattedDate = [
                tempDate.getFullYear(),
                tempDate.getMonth() + 1,
                tempDate.getDate(),
            ].join("-");
            let activity = document.getElementById("activity").value;
            let select_company =
                document.getElementById("select_company").value;
            let vessel = document.getElementById("vessel").value;
            let pol = document.getElementById("POL_1").value;
            let pot = document.getElementById("POT_1").value;
            let pod = document.getElementById("POD_1").value;
            let pengirim = document.getElementById("Pengirim_1").value;
            let penerima = document.getElementById("Penerima_1").value;
            let nama_barang = document.getElementById("nama_barang").value;
            let old_slug = document.getElementById("old_slug").value;
            var table_container = document.getElementById("table_container");
            var urutan = table_container.tBodies[0].rows.length;

            var kontainer = [];
            var size = [];
            var type = [];
            var fd = new FormData();

            for (let i = 0; i < urutan; i++) {
                kontainer[i] = document.getElementById(
                    "kontainer[" + (i + 1) + "]"
                ).value;
                fd.append("kontainer[]", kontainer[i]);
                size[i] = document.getElementById(
                    "size[" + (i + 1) + "]"
                ).innerHTML;
                fd.append("size[]", size[i]);
                type[i] = document.getElementById(
                    "type[" + (i + 1) + "]"
                ).innerHTML;
                fd.append("type[]", type[i]);
            }

            fd.append("tanggal_planload", formattedDate);
            fd.append("activity", activity);
            fd.append("select_company", select_company);
            fd.append("vessel", vessel);
            fd.append("pol", pol);
            fd.append("pot", pot);
            fd.append("pod", pod);
            fd.append("pengirim", pengirim);
            fd.append("penerima", penerima);
            fd.append("nama_barang", nama_barang);
            fd.append("_token", token);
            fd.append("urutan", urutan);
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
                        url: "/update-job-planload",
                        data: fd,
                        contentType: false,
                        processData: false,
                        dataType: "json",
                        success: function (response) {
                            swal.fire({
                                title: "JOB Planload DIUPDATE",
                                text: "JOB Planload Telah Berhasil DIUPDATE",
                                icon: "success",
                                timer: 9e3,
                                showConfirmButton: false,
                            });
                            window.location.href = "../planload";
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

function tambah_kontener() {
    let token = $("#csrf").val();

    var table = document.getElementById("tbody_container");
    tambah++;

    $.ajax({
        url: "/getJenisKontainer",
        type: "post",
        data: {
            _token: token,
        },
        success: function (response) {
            var jenis_kontainer = [""];
            for (i = 0; i < response.length; i++) {
                jenis_kontainer +=
                    "<option value='" +
                    response[i].id +
                    "'>" +
                    response[i].jenis_container +
                    "</option>";
            }
            var div = document.createElement("div");
            div.setAttribute("class", "validation-container");
            var select1 = document.createElement("select");
            select1.innerHTML =
                "<option selected disabled>Pilih Kontainer</option>" +
                jenis_kontainer;
            select1.setAttribute("id", "kontainer[" + tambah + "]");
            select1.setAttribute("class", "form-select");
            select1.setAttribute("name", "kontainer[" + tambah + "]");
            select1.setAttribute("required", true);
            select1.setAttribute("onchange", "change_container(this)");
            div.append(select1);
            var label1 = document.createElement("label");
            label1.innerHTML = "Size";
            label1.setAttribute("id", "size[" + tambah + "]");
            var label2 = document.createElement("label");
            label2.innerHTML = "Type";
            label2.setAttribute("id", "type[" + tambah + "]");
            var button = document.createElement("button");
            button.setAttribute("id", "deleterow" + tambah);
            button.setAttribute(
                "class",
                "btn btn-label-danger btn-icon btn-circle btn-sm"
            );
            button.setAttribute("type", "button");
            button.setAttribute("onclick", "delete_container(this)");
            var icon = document.createElement("i");
            icon.setAttribute("class", "fa fa-trash");
            button.append(icon);

            var row = table.insertRow(-1);
            var cell1 = row.insertCell(0);
            var cell2 = row.insertCell(1);
            var cell3 = row.insertCell(2);
            var cell4 = row.insertCell(3);
            var cell5 = row.insertCell(4);

            cell1.innerHTML = "1.";
            cell2.appendChild(div);
            cell3.appendChild(label1);
            cell4.appendChild(label2);
            cell5.appendChild(button);

            reindex_container();
        },
    });
}

function reindex_container() {
    const ids = document.querySelectorAll(
        "#table_container tr > td:nth-child(1)"
    );
    ids.forEach((e, i) => {
        e.innerHTML = i + 1 + ".";
        nomor_tabel_lokasi = i + 1;
    });
}

function delete_container(r) {
    var table = r.parentNode.parentNode.rowIndex;
    document.getElementById("table_container").deleteRow(table);
    tambah--;

    var select1 = document.querySelectorAll(
        "#table_container tr td:nth-child(2) select"
    );
    for (var i = 0; i < select1.length; i++) {
        select1[i].id = "kontainer[" + (i + 1) + "]";
        select1[i].name = "kontainer[" + (i + 1) + "]";
    }

    var label1 = document.querySelectorAll(
        "#table_container tr td:nth-child(3) label"
    );
    for (var i = 0; i < label1.length; i++) {
        label1[i].id = "size[" + (i + 1) + "]";
    }

    var label2 = document.querySelectorAll(
        "#table_container tr td:nth-child(4) label"
    );
    for (var i = 0; i < label2.length; i++) {
        label2[i].id = "type[" + (i + 1) + "]";
    }

    var button = document.querySelectorAll(
        "#table_container tr td:nth-child(5) button"
    );
    for (var i = 0; i < button.length; i++) {
        button[i].id = "deleterow" + (i + 1);
    }

    reindex_container();
}

function edit_kontener() {
    var table_container = document.getElementById("table_container");
    var urutan = table_container.tBodies[0].rows.length;

    let token = $("#csrf").val();

    var table = document.getElementById("tbody_container");
    urutan++;

    $.ajax({
        url: "/getJenisKontainer",
        type: "post",
        data: {
            _token: token,
        },
        success: function (response) {
            var jenis_kontainer = [""];
            for (i = 0; i < response.length; i++) {
                jenis_kontainer +=
                    "<option value='" +
                    response[i].id +
                    "'>" +
                    response[i].jenis_container +
                    "</option>";
            }
            var div = document.createElement("div");
            div.setAttribute("class", "validation-container");
            var select1 = document.createElement("select");
            select1.innerHTML =
                "<option selected disabled>Pilih Kontainer</option>" +
                jenis_kontainer;
            select1.setAttribute("id", "kontainer[" + urutan + "]");
            select1.setAttribute("class", "form-select");
            select1.setAttribute("name", "kontainer[" + urutan + "]");
            select1.setAttribute("required", true);
            select1.setAttribute("onchange", "change_container(this)");
            div.append(select1);
            var label1 = document.createElement("label");
            label1.innerHTML = "Size";
            label1.setAttribute("id", "size[" + urutan + "]");
            var label2 = document.createElement("label");
            label2.innerHTML = "Type";
            label2.setAttribute("id", "type[" + urutan + "]");
            var button = document.createElement("button");
            button.setAttribute("id", "deleterow" + urutan);
            button.setAttribute(
                "class",
                "btn btn-label-danger btn-icon btn-circle btn-sm"
            );
            button.setAttribute("type", "button");
            button.setAttribute("onclick", "delete_container(this)");
            var icon = document.createElement("i");
            icon.setAttribute("class", "fa fa-trash");
            button.append(icon);

            var row = table.insertRow(-1);
            var cell1 = row.insertCell(0);
            var cell2 = row.insertCell(1);
            var cell3 = row.insertCell(2);
            var cell4 = row.insertCell(3);
            var cell5 = row.insertCell(4);

            cell1.innerHTML = "1.";
            cell2.appendChild(div);
            cell3.appendChild(label1);
            cell4.appendChild(label2);
            cell5.appendChild(button);

            reindex_container();
        },
    });
}

function change_container(ini) {
    let token = $("#csrf").val();
    var urutan = ini.parentNode.parentNode.parentNode.rowIndex;
    var id_container = ini.value;

    $.ajax({
        url: "/getSizeTypeContainer",
        type: "post",
        data: {
            id_container: id_container,
            _token: token,
        },
        success: function (response) {
            document.getElementById("size[" + urutan + "]").innerHTML =
                response[0].size_container;
            document.getElementById("type[" + urutan + "]").innerHTML =
                response[0].type_container;
        },
    });
}
