

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
            let tanggal_planload = document.getElementById("tanggal_planload").value;
            let tempDate = new Date(tanggal_planload);
            let formattedDate = [tempDate.getFullYear(), tempDate.getMonth() + 1, tempDate.getDate()].join('-');
            let activity = document.getElementById("activity").value;
            let select_company = document.getElementById("select_company").value;
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

            var table_container = document.getElementById("processload-create");
            var urutan = table_container.tBodies[0].rows.length;

            for (let i = 0; i < urutan; i++) {
                kontainer[i] = document.getElementById(
                    "kontainer[" + (i + 1) + "]"
                ).value;
                fd.append("kontainer[]", kontainer[i]);
                size[i] = document.getElementById("size[" + (i + 1) + "]").innerHTML;
                fd.append("size[]", size[i]);
                type[i] = document.getElementById("type[" + (i + 1) + "]").innerHTML;
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
                                showConfirmButton: false

                            });
                            window.location.href = "../planload";
                        },
                    });
                } else {
                    swal.fire({
                        title: "Data Belum Dibuat",
                        text: "Silakan Cek Kembali Data Anda",
                        icon: "warning",
                        timer: 10e3,
                        showConfirmButton: false
                    });
                }
            });
        }
    });
}

function UpdateteJobProcessload() {
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
            let tanggal_planload = document.getElementById("tanggal_planload").value;
            let tempDate = new Date(tanggal_planload);
            let formattedDate = [tempDate.getFullYear(), tempDate.getMonth() + 1, tempDate.getDate()].join('-');
            let activity = document.getElementById("activity").value;
            let select_company = document.getElementById("select_company").value;
            let vessel = document.getElementById("vessel").value;
            let pol = document.getElementById("POL_1").value;
            let pot = document.getElementById("POT_1").value;
            let pod = document.getElementById("POD_1").value;
            let pengirim = document.getElementById("Pengirim_1").value;
            let penerima = document.getElementById("Penerima_1").value;
            let nama_barang = document.getElementById("nama_barang").value;
            let old_slug = document.getElementById("old_slug").value;
            var table_container = document.getElementById("processload-create");
            var urutan = table_container.tBodies[0].rows.length;

            var kontainer = [];
            var size = [];
            var type = [];
            var seals = [];
            var date_activity = [];
            var cargo = [];
            var lokasi = [];
            var driver = [];
            var nomor_polisi = [];
            var remark = [];
            var biaya_stuffing = [];
            var biaya_trucking = [];
            var ongkos_supir = [];
            var biaya_thc = [];

            var fd = new FormData();

            for (let i = 0; i < urutan; i++) {
                kontainer[i] = document.getElementById(
                    "kontainer[" + (i + 1) + "]"
                ).value;
                fd.append("kontainer[]", kontainer[i]);
                size[i] = document.getElementById("size[" + (i + 1) + "]").innerHTML;
                fd.append("size[]", size[i]);
                type[i] = document.getElementById("type[" + (i + 1) + "]").innerHTML;
                fd.append("type[]", type[i]);
                seals[i] = document.getElementById("seals[" + (i + 1) + "]").value;
                fd.append("seals[]", seals[i]);
                date_activity[i] = document.getElementById("date_activity[" + (i + 1) + "]").value;
                fd.append("date_activity[]", date_activity[i]);
                cargo[i] = document.getElementById("cargo[" + (i + 1) + "]").value;
                fd.append("cargo[]", cargo[i]);
                lokasi[i] = document.getElementById("lokasi[" + (i + 1) + "]").value;
                fd.append("lokasi[]", lokasi[i]);
                driver[i] = document.getElementById("driver[" + (i + 1) + "]").value;
                fd.append("driver[]", driver[i]);
                nomor_polisi[i] = document.getElementById("nomor_polisi[" + (i + 1) + "]").value;
                fd.append("nomor_polisi[]", nomor_polisi[i]);
                remark[i] = document.getElementById("remark[" + (i + 1) + "]").value;
                fd.append("remark[]", remark[i]);
                biaya_stuffing[i] = document.getElementById("biaya_stuffing[" + (i + 1) + "]").value;
                fd.append("biaya_stuffing[]", biaya_stuffing[i]);
                biaya_trucking[i] = document.getElementById("biaya_trucking[" + (i + 1) + "]").value;
                fd.append("biaya_trucking[]", biaya_trucking[i]);
                ongkos_supir[i] = document.getElementById("ongkos_supir[" + (i + 1) + "]").value;
                fd.append("ongkos_supir[]", ongkos_supir[i]);
                biaya_thc[i] = document.getElementById("biaya_thc[" + (i + 1) + "]").value;
                fd.append("biaya_thc[]", biaya_thc[i]);
            }



            fd.append("_token", token);
            fd.append("urutan", urutan);
            fd.append("old_slug", old_slug);

            swal.fire({
                title: "Apakah anda yakin?",
                text: "Ingin MemProses Job Ini",
                icon: "warning",
                showCancelButton: true,
                confirmButtonText: "Iya",
                cancelButtonText: "Tidak",
            }).then((willCreate) => {
                if (willCreate.isConfirmed) {
                    $.ajax({
                        type: "POST",
                        url: "/create-job-processload",
                        data: fd,
                        contentType: false,
                        processData: false,
                        dataType: "json",
                        success: function (response) {
                            swal.fire({
                                title: "JOB processload Dibuat",
                                text: "JOB processload Telah Berhasil Dibuat",
                                icon: "success",
                                timer: 9e3,
                                showConfirmButton: false
                            });
                            window.location.href = "../processload";
                        },
                    });
                } else {
                    swal.fire({
                        title: "Data Tidak Dibuat",
                        text: "Silakan Cek Kembali Data Anda",
                        icon: "warning",
                        timer: 10e3,
                        showConfirmButton: false
                    });
                }
            });
        }
    });


}


var tambah = 0;

function tambah_biaya() {
    var table = document.getElementById("tbody_biaya");
    tambah++;

    var div1 = document.createElement("div");
    div1.setAttribute("class", "validation-container");
    var select = document.createElement("select");
    select.innerHTML = '<option selected disabled>Pilih Kontainer</option><option>...</option>';
    select.setAttribute("id", "kontainer[" + tambah + "]");
    select.setAttribute("name", "kontainer[" + tambah + "]");
    select.setAttribute("class", "form-select");
    div1.append(select);
    var div2 = document.createElement("div");
    div2.setAttribute("class", "validation-container");
    var input = document.createElement("input");
    input.setAttribute("class", "form-select");
    input.setAttribute("type", "text");
    input.setAttribute("placeholder", "Harga");
    input.setAttribute("id", "harga[" + tambah + "]");
    input.setAttribute("name", "harga[" + tambah + "]");
    div2.append(input);
    var div3 = document.createElement("div");
    div3.setAttribute("class", "validation-container");
    var textarea = document.createElement("textarea");
    textarea.setAttribute("class", "form-control");
    textarea.setAttribute("id", "keterangan[" + tambah + "]");
    textarea.setAttribute("name", "keterangan[" + tambah + "]");
    div3.append(textarea);
    var button = document.createElement("button");
    button.setAttribute("id", "deleterow" + tambah);
    button.setAttribute("class", "btn btn-label-danger btn-icon btn-circle btn-sm");
    button.setAttribute("type", "button");
    button.setAttribute("onclick", "delete_biaya(this)");
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
    cell2.appendChild(div1);
    cell3.appendChild(div2);
    cell4.appendChild(div3);
    cell5.appendChild(button);

    reindex_biaya();
}

function reindex_biaya() {
    const ids = document.querySelectorAll("#table_biaya tr > td:nth-child(1)");
    ids.forEach((e, i) => {
        e.innerHTML = i + 1 + "."
        nomor_tabel_lokasi = i + 1;
    });
}

function delete_biaya(r) {
    var table = r.parentNode.parentNode.rowIndex;
    document.getElementById("table_biaya").deleteRow(table);
    tambah--;

    var select = document.querySelectorAll("#table_biaya tr td:nth-child(2) select");
    for (var i = 0; i < select.length; i++) {
        select[i].id = "pekerjaan" + (i + 1);
    }

    var label = document.querySelectorAll("#table_biaya tr td:nth-child(3) label");
    for (var i = 0; i < label.length; i++) {
        label[i].id = "harga" + (i + 1);
    }

    var button = document.querySelectorAll("#table_biaya tr td:nth-child(4) button");
    for (var i = 0; i < button.length; i++) {
        button[i].id = "deleterow" + (i + 1);
    }

    reindex_biaya();
}
