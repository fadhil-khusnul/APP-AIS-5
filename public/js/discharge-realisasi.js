


function CreateRealisasi() {
    var swal = Swal.mixin({
        customClass: {
            confirmButton: "btn btn-label-success btn-wide mx-1",
            denyButton: "btn btn-label-secondary btn-wide mx-1",
            cancelButton: "btn btn-label-danger btn-wide mx-1",
        },
        buttonsStyling: false,
    });

    $("#valid_realisasi").validate({
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
            let token = $("#csrf").val();

            // Event.preventDefault();

            let old_slug = document.getElementById("old_slug").value;
            var table_container = document.getElementById("processload_create");
            var urutan = table_container.tBodies[0].rows.length;

            var biaya_trucking = [];
            var biaya_thc = [];
            var lokasi_kembali = [];
            var tanggal_kembali = [];
            var tempDate = [];
            var formattedDate = [];
            var biaya_demurrage = [];



            var fd = new FormData();

            for (let i = 0; i < urutan; i++) {
                biaya_trucking[i] = document.getElementById(
                    "biaya_trucking[" + (i + 1) + "]"
                ).value;
                fd.append("biaya_trucking[]", biaya_trucking[i]);

                biaya_thc[i] = document.getElementById(
                    "biaya_thc[" + (i + 1) + "]"
                ).value;
                fd.append("biaya_thc[]", biaya_thc[i]);

                lokasi_kembali[i] = document.getElementById(
                    "lokasi_kembali[" + (i + 1) + "]"
                ).value;
                fd.append("lokasi_kembali[]", lokasi_kembali[i]);

                tanggal_kembali[i] = document.getElementById(
                    "tanggal_kembali[" + (i + 1) + "]"
                ).value;

                tempDate[i] = new Date(tanggal_kembali[i]);
                formattedDate[i] = [
                    tempDate[i].getFullYear(),
                    tempDate[i].getMonth() + 1,
                    tempDate[i].getDate(),
                ].join("-");
                fd.append("tanggal_kembali[]", formattedDate[i]);


                biaya_demurrage[i] = document.getElementById(
                    "biaya_demurrage[" + (i + 1) + "]"
                ).value;
                fd.append("biaya_demurrage[]", biaya_demurrage[i]);


            }



            //BIAYALAINNYA
            var kontainer_biaya = [];
            var harga_biaya = [];
            var keterangan = [];

            for (let i = 0; i < tambah; i++) {
                kontainer_biaya[i] = document.getElementById(
                    "kontainer_biaya[" + (i + 1) + "]"
                ).value;
                fd.append("kontainer_biaya[]", kontainer_biaya[i]);

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
                icon: "question",
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
                        $.ajax({
                            type: "POST",
                            url: "/create-job-realisasidischarge",
                            data: fd,
                            contentType: false,
                            processData: false,
                            dataType: "json",
                            success: function (response) {
                                swal.fire({
                                    title: "Discharge-Realisasi Dibuat",
                                    text: "Discharge-Realisasi Telah Berhasil Dibuat",
                                    icon: "success",
                                    timer: 9e3,
                                    showConfirmButton: false,
                                });
                                window.location.href = "../realisasi-discharge";
                            },
                        });
                    } else {
                        swal.fire({
                            title: "Job Tidak Diproess",
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

function change_container_discharge(ini) {
    let token = $("#csrf").val();

    $.ajax({
        url: "/getSealProcessDischarge",
        type: "post",
        data: {
            _token: token,
        },
        success: function (response) {
            var baris = ini.parentNode.parentNode.parentNode.rowIndex;
            var table = document.getElementById("processload_create");
            var count_row = table.tBodies[0].rows.length;

            for (var i = 1; i <= count_row; i++) {
                if (i != baris) {
                    if (ini.value != "") {
                        if (
                            ini.value ==
                                document.getElementById("seal[" + i + "]")
                                    .value ||
                            response.includes(ini.value)
                        ) {
                            swal.fire({
                                title: "Seal Sudah Terpakai",
                                text: "Silakan Pilih Seal yang Lain",
                                icon: "error",
                                timer: 10e3,
                                showConfirmButton: false,
                            }).then(() => {
                                document.getElementById(
                                    "select2-seal" + baris + "-container"
                                ).title = "Pilih Seal";
                                document.getElementById(
                                    "select2-seal" + baris + "-container"
                                ).innerHTML = "Pilih Seal";
                                ini.value = "";
                            });
                        }
                    }
                }
            }
        },
    });
}

function seal_discharge(ini) {
    let token = $("#csrf").val();

    $.ajax({
        url: "/getSealProcessDischarge",
        type: "post",
        data: {
            _token: token,
        },
        success: function (response) {
            var baris =
                ini.parentNode.parentNode.parentNode.parentNode.rowIndex;
            var table = document.getElementById("processload_create");
            var count_row = table.tBodies[0].rows.length;

            for (var i = 1; i <= count_row; i++) {
                if (i != baris) {
                    if (ini.value != "") {
                        if (
                            ini.value ==
                                document.getElementById("seals[" + i + "]")
                                    .value ||
                            response.includes(ini.value)
                        ) {
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
        },
    });
}


function blur_no_container(ini) {
    let token = $("#csrf").val();

    $.ajax({
        url: "/getNoContainer-discharge",
        type: "post",
        data: {
            _token: token,
        },
        success: function (response) {
            var baris = ini.parentNode.parentNode.parentNode.rowIndex;
            var table = document.getElementById("processload_create");
            var count_row = table.tBodies[0].rows.length;

            for (var i = 1; i <= count_row; i++) {
                if (i != baris) {
                    if (ini.value != "") {
                        if (
                            ini.value ==
                                document.getElementById(
                                    "nomor_kontainer[" + i + "]"
                                ).value ||
                            response.includes(ini.value)
                        ) {
                            swal.fire({
                                title: "Nomor Kontainer Sudah Ada",
                                text: "Silakan Masukkan Nomor Kontainer yang Lain",
                                icon: "error",
                                timer: 10e3,
                                showConfirmButton: false,
                            }).then(() => {
                                ini.value = "";

                                if (
                                    document.getElementById("tbody_biaya")
                                        .innerHTML != ""
                                ) {
                                    if (ini.value == "") {
                                        document.getElementById(
                                            "tbody_biaya"
                                        ).innerHTML = "";
                                        tambah = 0;
                                    }
                                }
                            });
                        }
                    }
                }
            }
        },
    });


    if (document.getElementById("tbody_biaya").innerHTML != "") {
        if (ini.value == "") {
            document.getElementById("tbody_biaya").innerHTML = "";
            tambah = 0;
        }
    }
}

var tambah = 0;

function tambah_biaya() {
    let token = $("#csrf").val();
    let slug = $("#old_slug").val();

    var swal = Swal.mixin({
        customClass: {
            confirmButton: "btn btn-label-success btn-wide mx-1",
            denyButton: "btn btn-label-secondary btn-wide mx-1",
            cancelButton: "btn btn-label-danger btn-wide mx-1",
        },
        buttonsStyling: false,
    });

    var table = document.getElementById("tbody_biaya");
    tambah++;

    var table_container = document.getElementById("processload_create");
    var urutan = table_container.tBodies[0].rows.length;
    var ifkontainer = [];

    for (let i = 0; i < urutan; i++) {
        ifkontainer[i] = document.getElementById(
            "nomor_kontainer[" + (i + 1) + "]"
        ).innerText;
    }
    if (ifkontainer.includes("")) {
        swal.fire({
            title: "Silahkan Masukkan Nomor Kontainer Terlebih Dahulu",
            icon: "error",
            timer: 10e3,
            showConfirmButton: false,
        }).then(() => {
            tambah = tambah - 1;
        });
    } else {
        var nomor_kontainer = [""];

        var table_container = document.getElementById("processload_create");
        var urutan = table_container.tBodies[0].rows.length;
        for (var i = 0; i < urutan; i++) {
            value_kontainer = document.getElementById(
                "nomor_kontainer[" + (i + 1) + "]"
            ).innerText;
            nomor_kontainer +=
                "<option value='" +
                value_kontainer +
                "'>" +
                value_kontainer +
                "</option>";
        }

        var div1 = document.createElement("div");
        div1.setAttribute("class", "validation-container");
        var select = document.createElement("select");
        select.innerHTML =
            "<option selected disabled>Pilih Nomor Kontainer</option>" +
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
    }
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

function no_paste(event) {
    if (
        event.ctrlKey == true &&
        (event.which == "118" || event.which == "86")
    ) {
        event.preventDefault();
    }
}

function uppercase(ini) {
    ini.value = ini.value.toUpperCase();
}
