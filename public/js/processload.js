function UpdateteJobProcessload() {
    var swal = Swal.mixin({
        customClass: {
            confirmButton: "btn btn-label-success btn-wide mx-1",
            denyButton: "btn btn-label-secondary btn-wide mx-1",
            cancelButton: "btn btn-label-danger btn-wide mx-1",
        },
        buttonsStyling: false,
    });

    $("#valid_processload").validate({
        ignore: 'select[type=hidden]',

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

            // Event.preventDefault();

            let old_slug = document.getElementById("old_slug").value;
            var table_container = document.getElementById("processload-create");
            var urutan = table_container.tBodies[0].rows.length;

            var kontainer = [];
            var size = [];
            var type = [];
            var seals = [];
            var date_activity = [];
            var tempDate = [];
            var formattedDate = [];
            var cargo = [];
            var lokasi = [];
            var driver = [];
            var nomor_polisi = [];
            var remark = [];
            var biaya_stuffing = [];
            var biaya_trucking = [];
            var ongkos_supir = [];
            var biaya_thc = [];
            // var no_surat = [];

            var fd = new FormData();

            for (let i = 0; i < urutan; i++) {
                // kontainer[i] = document.getElementById(
                //     "kontainer[" + (i + 1) + "]"
                // ).value;
                // fd.append("kontainer[]", kontainer[i]);
                // size[i] = document.getElementById(
                //     "size[" + (i + 1) + "]"
                // ).innerHTML;
                // fd.append("size[]", size[i]);
                // type[i] = document.getElementById(
                //     "type[" + (i + 1) + "]"
                // ).innerHTML;
                // fd.append("type[]", type[i]);

                seals[i] = document.getElementById(
                    "seals[" + (i + 1) + "]"
                ).value;
                fd.append("seals[]", seals[i]);

                date_activity[i] = document.getElementById(
                    "date_activity[" + (i + 1) + "]"
                ).value;
                tempDate[i] = new Date(date_activity[i]);
                formattedDate[i] = [
                    tempDate[i].getFullYear(),
                    tempDate[i].getMonth() + 1,
                    tempDate[i].getDate(),
                ].join("-");

                fd.append("date_activity[]", formattedDate[i]);

                cargo[i] = document.getElementById(
                    "cargo[" + (i + 1) + "]"
                ).value;
                fd.append("cargo[]", cargo[i]);

                lokasi[i] = document.getElementById(
                    "lokasi[" + (i + 1) + "]"
                ).value;
                fd.append("lokasi[]", lokasi[i]);

                driver[i] = document.getElementById(
                    "driver[" + (i + 1) + "]"
                ).value;
                fd.append("driver[]", driver[i]);
                nomor_polisi[i] = document.getElementById(
                    "nomor_polisi[" + (i + 1) + "]"
                ).value;
                fd.append("nomor_polisi[]", nomor_polisi[i]);
                remark[i] = document.getElementById(
                    "remark[" + (i + 1) + "]"
                ).value;
                fd.append("remark[]", remark[i]);
                biaya_stuffing[i] = document.getElementById(
                    "biaya_stuffing[" + (i + 1) + "]"
                ).value;
                fd.append("biaya_stuffing[]", biaya_stuffing[i]);
                biaya_trucking[i] = document.getElementById(
                    "biaya_trucking[" + (i + 1) + "]"
                ).value;
                fd.append("biaya_trucking[]", biaya_trucking[i]);
                ongkos_supir[i] = document.getElementById(
                    "ongkos_supir[" + (i + 1) + "]"
                ).value;
                fd.append("ongkos_supir[]", ongkos_supir[i]);
                biaya_thc[i] = document.getElementById(
                    "biaya_thc[" + (i + 1) + "]"
                ).value;
                fd.append("biaya_thc[]", biaya_thc[i]);
            }

            var today = new Date();
            var tahun = today.getFullYear();
            var bulan = today.getMonth() + 1;
            var tanggal = today.getDate().toString().padStart(2, "0");

            $.ajax({
                url: '/getNoSurat',
                type: 'post',
                data: {
                    tahun: tahun,
                    bulan: bulan,
                    _token: token
                },
                success: function(response) {
                    var no_surat = []
                    var sjc = "SJC";
                    var ais = "AIS";
                    var m = "M";
                    var data_bulan = [];
                    var data_tahun = [];
                    if(response == 0) {
                        for(var i = 0; i < urutan; i++) {
                            data_bulan[i] = bulan;
                            data_tahun[i] = tahun;
                            no_surat[i] = sjc + tahun + ais + String(bulan).padStart(2, '0') + tanggal + String((i + 1)).padStart(5, '0') + m;
                            fd.append("no_surat[]", no_surat[i]);
                            fd.append("bulan[]", data_bulan[i]);
                            fd.append("tahun[]", data_tahun[i]);
                        }
                    } else {
                        for(var i = 0; i < urutan; i++) {
                            data_bulan[i] = bulan;
                            data_tahun[i] = tahun;
                            no_surat[i] = sjc + tahun + ais + bulan + tanggal + String((i + response + 1)).padStart(5, '0') + m;
                            fd.append("no_surat[]", no_surat[i]);
                            fd.append("bulan[]", data_bulan[i]);
                            fd.append("tahun[]", data_tahun[i]);
                        }
                    }
                }
            })

            //BIAYALAINNYA
            var kontaienr_biaya = [];
            var harga_biaya = [];
            var keterangan = [];

            for (let i = 0; i < tambah; i++) {
                kontaienr_biaya[i] = document.getElementById(
                    "kontainer_biaya[" + (i + 1) + "]"
                ).value;
                fd.append("kontaienr_biaya[]", kontaienr_biaya[i]);

                harga_biaya[i] = document.getElementById(
                    "harga[" + (i + 1) + "]"
                ).value;
                fd.append("harga_biaya[]", harga_biaya[i]);

                keterangan[i] = document.getElementById(
                    "keterangan[" + (i + 1) + "]"
                ).value;
                fd.append("keterangan[]", keterangan[i]);
            }

            fd.append("_token", token);
            fd.append("urutan", urutan);
            fd.append("tambah", tambah);
            fd.append("old_slug", old_slug);

            swal.fire({
                title: "Apakah anda yakin?",
                text: "Ingin MemProses Job Ini",
                icon: "warning",
                showCancelButton: true,
                confirmButtonText: "Iya",
                cancelButtonText: "Tidak",
            }).then(
                (
                    willCreate,
                    seals,
                    formattedDate,
                    cargo,
                    lokasi,
                    driver,
                    nomor_polisi,
                    remark,
                    biaya_stuffing,
                    biaya_thc,
                    biaya_trucking
                ) => {
                    if (willCreate.isConfirmed) {
                        // if (
                        //     seals.includes("") != true &&
                        //     formattedDate.includes("") != true &&
                        //     cargo.includes("") != true &&
                        //     lokasi.includes("") != true &&
                        //     driver.includes("") != true &&
                        //     nomor_polisi.includes("") != true &&
                        //     remark.includes("") != true &&
                        //     biaya_stuffing.includes("") != true &&
                        //     biaya_trucking.includes("") != true &&
                        //     ongkos_supir.includes("") != true &&
                        //     biaya_thc.includes("") != true
                        // ) {

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
                                    showConfirmButton: false,
                                });
                                window.location.href = "../processload";
                            },
                        });
                    }
                    //     else {
                    //         swal.fire({
                    //             title: "Data Belum Lengkap",
                    //             text: "Silakan Cek Kembali Data Anda",
                    //             icon: "error",
                    //             timer: 10e3,
                    //             showConfirmButton: false,
                    //         });
                    //     }
                    // }
                    else {
                        swal.fire({
                            title: "Load Job Tidak Diproess",
                            text: "Silakan Cek Kembali Data Anda",
                            icon: "error",
                            timer: 10e3,
                            showConfirmButton: false,
                        });
                    }
                }
            );
        },
    });
}

var tambah = 0;

function tambah_biaya() {
    let token = $("#csrf").val();
    let slug = $("#old_slug").val();

    var table = document.getElementById("tbody_biaya");
    tambah++;

    $.ajax({
        // url: "/getBiayaLain",
        // type: "post",
        // data: {
        //     slug: slug,
        //     _token: token,
        // },
        success: function (response) {
            // var jenis_container = [""];
            // for (var i = 0; i < response.length; i++) {
            //     jenis_container +=
            //         "<option value='" +
            //         response[i].id +
            //         "'>" +
            //         response[i].kontainer +
            //         "</option>";
            // }

            var nomor_kontainer = [""];

            var table_container = document.getElementById("processload-create");
            var urutan = table_container.tBodies[0].rows.length;
            for (var i = 0; i < urutan; i++) {
                value_kontainer = document.getElementById('nomor_kontainer[' + (i + 1) + ']').value
                nomor_kontainer += ("<option value='" + value_kontainer + "'>" + value_kontainer +
                    "</option>")
            }

            var div1 = document.createElement("div");
            div1.setAttribute("class", "validation-container");
            var select = document.createElement("select");
            select.innerHTML =
                "<option selected disabled>Pilih Kontainer</option>" +
                nomor_kontainer;
            select.setAttribute("id", "kontainer_biaya[" + tambah + "]");
            select.setAttribute("name", "kontainer_biaya[" + tambah + "]");
            select.setAttribute("class", "form-select");
            select.setAttribute("required", true);
            div1.append(select);
            var div2 = document.createElement("div");
            div2.setAttribute("class", "validation-container");
            var input = document.createElement("input");
            input.setAttribute("class", "form-control");
            input.setAttribute("type", "text");
            input.setAttribute("required", true);
            input.setAttribute("placeholder", "Harga");
            input.setAttribute("onkeydown", "return numbersonly(this, event);");
            input.setAttribute("onkeyup", "javascript:tandaPemisahTitik(this);");
            input.setAttribute("id", "harga[" + tambah + "]");
            input.setAttribute("name", "harga[" + tambah + "]");
            div2.append(input);
            var div3 = document.createElement("div");
            div3.setAttribute("class", "validation-container");
            var textarea = document.createElement("textarea");
            textarea.setAttribute("class", "form-control");
            textarea.setAttribute("required", true);
            textarea.setAttribute("id", "keterangan[" + tambah + "]");
            textarea.setAttribute("name", "keterangan[" + tambah + "]");
            div3.append(textarea);
            var button = document.createElement("button");
            button.setAttribute("id", "deleterow" + tambah);
            button.setAttribute(
                "class",
                "btn btn-label-danger btn-icon btn-circle btn-sm"
            );
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
        },
    });
}

//BATAL-MUAT
var clickbatal = 0;
function tambah_batal_muat() {

    let token = $("#csrf").val();
    let slug = $("#old_slug").val();

    var table = document.getElementById("tbody_batal_muat");
    clickbatal++;

    $("#valid_processload").validate(
        $.ajax({
            // url: "/getBiayaLain",
            // type: "post",
            // data: {
            //     slug: slug,
            //     _token: token,
            // },
            success: function (response) {
                // var jenis_container = [""];
                // for (var i = 0; i < response.length; i++) {
                //     jenis_container +=
                //         "<option value='" +
                //         response[i].id +
                //         "'>" +
                //         response[i].kontainer +
                //         "</option>";
                // }
                var nomor_kontainer = [""];

                var table_container = document.getElementById("processload-create");
                var urutan = table_container.tBodies[0].rows.length;
                for (var i = 0; i < urutan; i++) {
                    value_kontainer = document.getElementById('nomor_kontainer[' + (i + 1) + ']').value
                    nomor_kontainer += ("<option value='" + value_kontainer + "'>" + value_kontainer +
                        "</option>")
                }

                var div1 = document.createElement("div");
                div1.setAttribute("class", "validation-container");
                var select = document.createElement("select");
                select.innerHTML =
                    "<option selected disabled>Pilih Kontainer</option>"+ nomor_kontainer;
                select.setAttribute("id", "kontainer_batal[" + clickbatal + "]");
                select.setAttribute("name", "kontainer_batal[" + clickbatal + "]");
                select.setAttribute("class", "form-select");
                select.setAttribute("required", true);
                div1.append(select);
                var div2 = document.createElement("div");
                div2.setAttribute("class", "validation-container");
                var input = document.createElement("input");
                input.setAttribute("class", "form-control");
                input.setAttribute("type", "text");
                input.setAttribute("required", true);
                input.setAttribute("placeholder", "Harga Batal Muat");
                input.setAttribute("onkeydown", "return numbersonly(this, event);");
                input.setAttribute("onkeyup", "javascript:tandaPemisahTitik(this);");
                input.setAttribute("id", "harga_batal_muat[" + clickbatal + "]");
                input.setAttribute("name", "harga_batal_muat[" + clickbatal + "]");
                div2.append(input);
                var div3 = document.createElement("div");
                div3.setAttribute("class", "validation-container");
                var textarea = document.createElement("textarea");
                textarea.setAttribute("class", "form-control");
                textarea.setAttribute("required", true);
                textarea.setAttribute("id", "keterangan_batal_muat[" + clickbatal + "]");
                textarea.setAttribute("name", "keterangan_batal_muat[" + clickbatal + "]");
                div3.append(textarea);
                var button = document.createElement("button");
                button.setAttribute("id", "deleterow" + clickbatal);
                button.setAttribute(
                    "class",
                    "btn btn-label-danger btn-icon btn-circle btn-sm"
                );
                button.setAttribute("type", "button");
                button.setAttribute("onclick", "delete_batal(this)");
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

                reindex_batal();
            },
        })
    );

}


function reindex_batal() {
    const ids = document.querySelectorAll("#table_batal_muat tr > td:nth-child(1)");
    ids.forEach((e, i) => {
        e.innerHTML = i + 1 + ".";
        nomor_tabel_lokasi = i + 1;
    });
}
function delete_batal(r) {
    var table = r.parentNode.parentNode.rowIndex;
    document.getElementById("table_batal_muat").deleteRow(table);
    clickbatal--;

    var select = document.querySelectorAll(
        "#table_batal_muat tr td:nth-child(2) select"
    );
    for (var i = 0; i < select.length; i++) {
        select[i].id = "kontainer_batal[" + (i + 1) + "]";
        select[i].name = "kontainer_batal[" + (i + 1) + "]";
    }

    var input = document.querySelectorAll(
        "#table_batal_muat tr td:nth-child(3) input"
    );
    for (var i = 0; i < input.length; i++) {
        input[i].id = "harga_batal_muat[" + (i + 1) + "]";
        input[i].name = "harga_batal_muat[" + (i + 1) + "]";
    }

    var textarea = document.querySelectorAll(
        "#table_batal_muat tr td:nth-child(4) textarea"
    );
    for (var i = 0; i < textarea.length; i++) {
        textarea[i].id = "keterangan_batal_muat[" + (i + 1) + "]";
        textarea[i].name = "keterangan_batal_muat[" + (i + 1) + "]";
    }

    var button = document.querySelectorAll(
        "#table_batal_muat tr td:nth-child(5) button"
    );
    for (var i = 0; i < button.length; i++) {
        button[i].id = "deleterow" + (i + 1);
    }

    reindex_batal();
}

//ALIH-KAPAL
var clickalih = 0;
function tambah_alih() {

    var swal = Swal.mixin({
        customClass: {
            confirmButton: "btn btn-label-success btn-wide mx-1",
            denyButton: "btn btn-label-secondary btn-wide mx-1",
            cancelButton: "btn btn-label-danger btn-wide mx-1",
        },
        buttonsStyling: false,
    });

    let token = $("#csrf").val();
    let slug = $("#old_slug").val();

    var table = document.getElementById("tbody_alih");
    clickalih++;

    var table_container = document.getElementById("processload-create");
    var urutan = table_container.tBodies[0].rows.length;
    var ifkontainer = [];

    for (let i = 0; i < urutan; i++) {
        ifkontainer[i] = document.getElementById("nomor_kontainer["+ (i+1) +"]").value;
    }
    console.log(ifkontainer);
    if (ifkontainer.includes("")) {
        swal.fire({
            title: "Silahkan Masukkan Nomor Kontainer Terlebih Dahulu",
            icon: "error",
            timer: 10e3,
            showConfirmButton: false,
        });
    }
    else{
        $.ajax({
            // url: "/getBiayaLain",
            // type: "post",
            // data: {
            //     slug: slug,
            //     _token: token,
            // },
            success: function (response) {
                // var jenis_container = [""];
                // for (var i = 0; i < response.length; i++) {
                //     jenis_container +=
                //         "<option value='" +
                //         response[i].id +
                //         "'>" +
                //         response[i].kontainer +
                //         "</option>";
                // }
                var nomor_kontainer = [""];


                for (var i = 0; i < urutan; i++) {
                    value_kontainer = document.getElementById('nomor_kontainer[' + (i + 1) + ']').value
                    nomor_kontainer += ("<option value='" + value_kontainer + "'>" + value_kontainer +
                        "</option>")
                }

                var div1 = document.createElement("div");
                div1.setAttribute("class", "validation-container");
                var select = document.createElement("select");
                select.innerHTML =
                    "<option selected disabled>Pilih Kontainer</option>"+ nomor_kontainer;
                select.setAttribute("id", "kontainer_alih[" + clickalih + "]");
                select.setAttribute("name", "kontainer_alih[" + clickalih + "]");
                select.setAttribute("class", "form-select");
                select.setAttribute("required", true);
                div1.append(select);
                var div2 = document.createElement("div");
                div2.setAttribute("class", "validation-container");
                var input = document.createElement("input");
                input.setAttribute("class", "form-control");
                input.setAttribute("type", "text");
                input.setAttribute("required", true);
                input.setAttribute("placeholder", "Harga Alih Kapal");
                input.setAttribute("onkeydown", "return numbersonly(this, event);");
                input.setAttribute("onkeyup", "javascript:tandaPemisahTitik(this);");
                input.setAttribute("id", "harga_alih_kapal[" + clickalih + "]");
                input.setAttribute("name", "harga_alih_kapal[" + clickalih + "]");
                div2.append(input);
                var div3 = document.createElement("div");
                div3.setAttribute("class", "validation-container");
                var textarea = document.createElement("textarea");
                textarea.setAttribute("class", "form-control");
                textarea.setAttribute("required", true);
                textarea.setAttribute("id", "keterangan_alih_kapal[" + clickalih + "]");
                textarea.setAttribute("name", "keterangan_alih_kapal[" + clickalih + "]");
                div3.append(textarea);
                var button = document.createElement("button");
                button.setAttribute("id", "deleterow" + clickalih);
                button.setAttribute(
                    "class",
                    "btn btn-label-danger btn-icon btn-circle btn-sm"
                );
                button.setAttribute("type", "button");
                button.setAttribute("onclick", "delete_alih(this)");
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

                reindex_alih();
            },
        });
    }



}

function reindex_alih() {
    const ids = document.querySelectorAll("#table_alih_kapal tr > td:nth-child(1)");
    ids.forEach((e, i) => {
        e.innerHTML = i + 1 + ".";
        nomor_tabel_lokasi = i + 1;
    });
}
function delete_alih(r) {
    var table = r.parentNode.parentNode.rowIndex;
    document.getElementById("table_alih_kapal").deleteRow(table);
    clickalih--;

    var select = document.querySelectorAll(
        "#table_alih_kapal tr td:nth-child(2) select"
    );
    for (var i = 0; i < select.length; i++) {
        select[i].id = "kontainer_alih[" + (i + 1) + "]";
        select[i].name = "kontainer_alih[" + (i + 1) + "]";
    }

    var input = document.querySelectorAll(
        "#table_alih_kapal tr td:nth-child(3) input"
    );
    for (var i = 0; i < input.length; i++) {
        input[i].id = "harga_alih_kapal[" + (i + 1) + "]";
        input[i].name = "harga_alih_kapal[" + (i + 1) + "]";
    }

    var textarea = document.querySelectorAll(
        "#table_alih_kapal tr td:nth-child(4) textarea"
    );
    for (var i = 0; i < textarea.length; i++) {
        textarea[i].id = "keterangan_alih_kapal[" + (i + 1) + "]";
        textarea[i].name = "keterangan_alih_kapal[" + (i + 1) + "]";
    }

    var button = document.querySelectorAll(
        "#table_alih_kapal tr td:nth-child(5) button"
    );
    for (var i = 0; i < button.length; i++) {
        button[i].id = "deleterow" + (i + 1);
    }

    reindex_alih();
}
function blur_no_container(ini) {
    if(document.getElementById("tbody_alih").innerHTML != "") {
        if(ini.value == "") {
            document.getElementById("tbody_alih").innerHTML = "";
            clickalih = 0;
        }
    }
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

function reindex_biaya() {
    const ids = document.querySelectorAll("#table_biaya tr > td:nth-child(1)");
    ids.forEach((e, i) => {
        e.innerHTML = i + 1 + ".";
        nomor_tabel_lokasi = i + 1;
    });
}



function delete_biaya(r) {
    var table = r.parentNode.parentNode.rowIndex;
    document.getElementById("table_biaya").deleteRow(table);
    tambah--;

    var select = document.querySelectorAll(
        "#table_biaya tr td:nth-child(2) select"
    );
    for (var i = 0; i < select.length; i++) {
        select[i].id = "kontainer_biaya[" + (i + 1) + "]";
        select[i].name = "kontainer_biaya[" + (i + 1) + "]";
    }

    var input = document.querySelectorAll(
        "#table_biaya tr td:nth-child(3) input"
    );
    for (var i = 0; i < input.length; i++) {
        input[i].id = "harga[" + (i + 1) + "]";
        input[i].name = "harga[" + (i + 1) + "]";
    }

    var textarea = document.querySelectorAll(
        "#table_biaya tr td:nth-child(4) textarea"
    );
    for (var i = 0; i < textarea.length; i++) {
        textarea[i].id = "keterangan[" + (i + 1) + "]";
        textarea[i].name = "keterangan[" + (i + 1) + "]";
    }

    var button = document.querySelectorAll(
        "#table_biaya tr td:nth-child(5) button"
    );
    for (var i = 0; i < button.length; i++) {
        button[i].id = "deleterow" + (i + 1);
    }

    reindex_biaya();
}


function seal(ini) {
    let token = $("#csrf").val();

    $.ajax({
        url: '/getSealProcessLoad',
        type: 'post',
        data: {
            _token: token
        },
        success: function(response) {
            var baris = ini.parentNode.parentNode.parentNode.parentNode.rowIndex;
            var table = document.getElementById("processload-create");
            var count_row = table.tBodies[0].rows.length;

            for (var i = 1; i <= count_row; i++) {
                if (i != baris) {
                    if (ini.value != "") {
                        if (ini.value == document.getElementById("seals[" + i + "]").value || response.includes(ini.value)) {
                            swal.fire({
                                title: "Seal Sudah Terpakai",
                                text: "Silakan Pilih Seal yang Lain atau Masukkan Seal Sendiri",
                                icon: "error",
                                timer: 10e3,
                                showConfirmButton: false,
                            }).then(() => {
                                ini.value = "";
                            });
                        }
                    }
                }
            }
        }
    })

}
