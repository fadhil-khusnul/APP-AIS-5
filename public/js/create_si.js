function pdf_si() {
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

            var table_container = document.getElementById("realisasiload-create");
            var urutan = table_container.tBodies[0].rows.length;

            var nomor_kontainer = [""];



            for (let i = 0; i < urutan; i++) {
                value_kontainer = document.getElementById('nomor_kontainer[' + (i + 1) + ']').innerHTML
                nomor_kontainer += '\n' + value_kontainer +",";

            }

        }

    });


    swal.fire({
        title: "Ingin Buat SI : "+nomor_kontainer+"",
        text: "Ingin Membuat SI Dengan Nomor Kontainer (" + nomor_kontainer +") ?",
        icon: "question",
        showCancelButton: true,
        confirmButtonText: "Iya",
        cancelButtonText: "Tidak",
    })

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

    var table_container = document.getElementById("processload-create");
    var urutan = table_container.tBodies[0].rows.length;
    var ifkontainer = [];

    for (let i = 0; i < urutan; i++) {
        ifkontainer[i] = document.getElementById("nomor_kontainer["+ (i+1) +"]").value;
    }
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


}

//BATAL-MUAT
var clickbatal = 0;
function tambah_batal_muat() {

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

    var table = document.getElementById("tbody_batal_muat");
    clickbatal++;

    var table_container = document.getElementById("processload-create");
    var urutan = table_container.tBodies[0].rows.length;
    var ifkontainer = [];
    for (let i = 0; i < urutan; i++) {
        ifkontainer[i] = document.getElementById("nomor_kontainer["+ (i+1) +"]").value;
    }

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
    }



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
    if(document.getElementById("tbody_batal_muat").innerHTML != "") {
        if(ini.value == "") {
            document.getElementById("tbody_batal_muat").innerHTML = "";
            clickbatal = 0;
        }
    }
    if(document.getElementById("tbody_biaya").innerHTML != "") {
        if(ini.value == "") {
            document.getElementById("tbody_biaya").innerHTML = "";
            tambah = 0;
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
