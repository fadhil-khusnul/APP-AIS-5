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
            var size = [""];
            var type = [""];
            var seals = [""];
            for (var i = 0; i < response.size.length; i++) {
                size +=
                    "<option value='" +
                    response.size[i].size_container +
                    "'>" +
                    response.size[i].size_container +
                    "</option>";
            }
            for (var i = 0; i < response.type.length; i++) {
                type +=
                    "<option value='" +
                    response.type[i].type_container +
                    "'>" +
                    response.type[i].type_container +
                    "</option>";
            }
            for (var i = 0; i < response.seals.length; i++) {
                seals +=
                    "<option value='" +
                    response.seals[i].kode_seal +
                    "'>" +
                    response.seals[i].kode_seal +
                    "</option>";
            }

            var div2 = document.createElement("div");
            div2.setAttribute("class", "validation-container");
            var select1 = document.createElement("select");
            select1.innerHTML =
                "<option selected disabled>Pilih Size</option>" + size;
            select1.setAttribute("id", "size[" + tambah + "]");
            select1.setAttribute("class", "form-select");
            select1.setAttribute("name", "size[" + tambah + "]");
            select1.setAttribute("required", true);
            div2.append(select1);
            var div3 = document.createElement("div");
            div3.setAttribute("class", "validation-container");
            var select2 = document.createElement("select");
            select2.innerHTML =
                "<option selected disabled>Pilih Type</option>" + type;
            select2.setAttribute("id", "type[" + tambah + "]");
            select2.setAttribute("class", "form-select");
            select2.setAttribute("name", "type[" + tambah + "]");
            select2.setAttribute("required", true);
            div3.append(select2);

            var div1 = document.createElement("div");
            div1.setAttribute("class", "validation-container");
            var input1 = document.createElement("input");
            input1.setAttribute("class", "form-control");
            input1.setAttribute("id", "nomor-container[" + tambah + "]");
            input1.setAttribute("name", "nomor-container[" + tambah + "]");
            input1.setAttribute("required", true);
            input1.setAttribute("type", "text");
            div1.append(input1);

            var div5 = document.createElement("div");
            div5.setAttribute("class", "validation-container");
            var select3 = document.createElement("select");
            select3.innerHTML = "<option></option>" + seals;
            select3.setAttribute("id", "seal[" + tambah + "]");
            select3.setAttribute("class", "form-select");
            select3.setAttribute("name", "seal[" + tambah + "]");
            select3.setAttribute("required", true);
            select3.setAttribute("data-bs-toggle", "tooltip");
            select3.setAttribute("multiple", "multiple");
            select3.setAttribute("onchange", "select_seal(this)");
            div5.append(select3);

            var div4 = document.createElement("div");
            div4.setAttribute("class", "validation-container");
            var textarea1 = document.createElement("textarea");
            textarea1.setAttribute("id", "cargo[" + tambah + "]");
            textarea1.setAttribute("name", "cargo[" + tambah + "]");
            textarea1.setAttribute("class", "form-control");
            textarea1.setAttribute("required", true);
            div4.append(textarea1);
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
            var cell6 = row.insertCell(5);
            var cell7 = row.insertCell(6);

            cell1.innerHTML = "1.";
            cell2.appendChild(div2);
            cell3.appendChild(div3);
            cell4.appendChild(div1);
            cell5.appendChild(div5);
            cell6.appendChild(div4);
            cell7.appendChild(button);

            reindex_container();
        },
    });
}

function select_seal(ini) {
    var seal = ini.selectedOptions;
    seal = Array.from(seal).map(({ value }) => value);
    console.log(seal);

    // $("#seal_update")
    //     .val(seals)
    //     .select2({
    //         dropdownAutoWidth: true,
    //         // tags: true,
    //         placeholder: "Silahkan Pilih",
    //         // allowClear:true,
    //         maximumSelectionLength: 4,
    //         dropdownParent: $("#modal-job-update"),
    //     })
    //     .off("select2:select")
    //     .on("select2:select", function (e) {
    //         var selected_element = $(e.currentTarget);
    //         var select_val = selected_element.val();
    //         // console.log(select_val);

    //         // console.log(seals);

    //         var element = e.params.data.element;
    //         var $element = $(element);

    //         $element.detach();
    //         $(this).append($element);
    //         $(this).trigger("change");

    //         let token = $("#csrf").val();

    //         $.ajax({
    //             url: "/getSealProcessLoad",
    //             type: "post",
    //             async: false,
    //             data: {
    //                 _token: token,
    //             },
    //             success: function (response) {
    //                 // console.log(seals);
    //                 var seal = $("#seal_update").val();
    //                 var last_seal = seal[seal.length - 1];
    //                 var count_seal = response.length;
    //                 var seal_already = [];
    //                 for (var i = 0; i < count_seal; i++) {
    //                     seal_already[i] = response[i].seal_kontainer;
    //                 }

    //                 if (seals.includes(last_seal) == false) {
    //                     if (seal_already.includes(last_seal)) {
    //                         swal.fire({
    //                             title: "Seal Kontainer Sudah Dipakai",
    //                             icon: "error",
    //                             timer: 10e3,
    //                             async: false,
    //                             showConfirmButton: true,
    //                         }).then(() => {
    //                             var wanted_option = $(
    //                                 '#seal_update option[value="' +
    //                                     last_seal +
    //                                     '"]'
    //                             );
    //                             wanted_option.prop("selected", false);
    //                             // $(this).trigger("change.select2");
    //                             $("#seal_update").trigger("change.select2");
    //                         });
    //                     } else {
    //                         $.ajax({
    //                             url: "/getSealKontainer",
    //                             type: "post",
    //                             data: {
    //                                 _token: token,
    //                                 seal: last_seal,
    //                             },
    //                             success: function (response) {
    //                                 var harga_seal = document
    //                                     .getElementById("biaya_seal_update")
    //                                     .value.replace(/\./g, "");
    //                                 harga_seal = parseFloat(harga_seal);

    //                                 if (isNaN(harga_seal)) {
    //                                     harga_seal = 0;
    //                                 }

    //                                 var harga_seal_now = harga_seal + response;
    //                                 $("#biaya_seal_update").val(harga_seal_now);
    //                             },
    //                         });
    //                     }
    //                 }
    //             },
    //         });
    //     });
    // $("#seal_update")
    //     .val(seals)
    //     .select2({
    //         dropdownAutoWidth: true,
    //         // tags: true,
    //         placeholder: "Silahkan Pilih Seal",
    //         // allowClear:true,
    //         maximumSelectionLength: 4,
    //         dropdownParent: $("#modal-job-update"),
    //     })
    //     .off("select2:unselect")
    //     .on("select2:unselect", function (e) {
    //         // var seal = $("#seal").val();
    //         // console.log(seal);
    //         // var last_seal = seal[seal.length - 1];

    //         var selected_element = $(e.currentTarget);
    //         var select_val = selected_element.val();

    //         var element = e.params.data.element;
    //         var $element = $(element);

    //         let token = $("#csrf").val();

    //         $element.detach();
    //         $(this).append($element);
    //         $(this).trigger("change");

    //         $.ajax({
    //             url: "/getSealKontainer",
    //             type: "post",
    //             data: {
    //                 _token: token,
    //                 seal: element.value,
    //             },
    //             success: function (response) {
    //                 var harga_seal = document
    //                     .getElementById("biaya_seal_update")
    //                     .value.replace(/\./g, "");
    //                 harga_seal = parseFloat(harga_seal);

    //                 if (isNaN(harga_seal)) {
    //                     harga_seal = 0;
    //                 }

    //                 var harga_seal_now = harga_seal - response;
    //                 $("#biaya_seal_update").val(harga_seal_now);
    //             },
    //         });
    //     });
    // console.log(ini.value);
    // var size = [];
    // var type = [];
    // var nomor_container = [];
    // var seal = [];
    // var cargo = [];

    // for (var i = 0; i < tambah; i++) {
    //     size[i] = document.getElementById("size[" + (i + 1) + "]").value;
    //     type[i] = document.getElementById("type[" + (i + 1) + "]").value;
    //     nomor_container[i] = document.getElementById(
    //         "nomor-container[" + (i + 1) + "]"
    //     ).value;
    //     seal[i] = document.getElementById(
    //         "seal[" + (i + 1) + "]"
    //     ).selectedOptions;
    //     seal[i] = Array.from(seal[i]).map(({ value }) => value);
    //     cargo[i] = document.getElementById("cargo[" + (i + 1) + "]").value;

    //     fd.append("size[]", size[i]);
    //     fd.append("type[]", type[i]);
    //     fd.append("nomor_container[]", nomor_container[i]);
    //     fd.append("cargo[]", cargo[i]);

    //     for (var j = 0; j < seal[i].length; j++) {
    //         fd.append("seal[" + i + "][]", seal[i][j]);
    //     }
    // }
}

function reindex_container() {
    var nomor_tabel_lokasi;

    const ids = document.querySelectorAll(
        "#table_container tr > td:nth-child(1)"
    );
    ids.forEach((e, i) => {
        e.innerHTML = i + 1 + ".";
        nomor_tabel_lokasi = i + 1;
    });

    $("#table_container tr > td:nth-child(5) select")
        .select2({
            dropdownAutoWidth: true,
            placeholder: "Silahkan Pilih Seal",
            maximumSelectionLength: 4,
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

        });
    $("#table_container tr > td:nth-child(4) input").inputmask({
        mask: "AAAA9999999",
        placeholder: "",
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
        select1[i].id = "size[" + (i + 1) + "]";
        select1[i].name = "size[" + (i + 1) + "]";
    }

    var select2 = document.querySelectorAll(
        "#table_container tr td:nth-child(3) select"
    );
    for (var i = 0; i < select2.length; i++) {
        select2[i].id = "type[" + (i + 1) + "]";
        select2[i].name = "type[" + (i + 1) + "]";
    }

    var input1 = document.querySelectorAll(
        "#table_container tr td:nth-child(4) input"
    );
    for (var i = 0; i < input1.length; i++) {
        input1[i].id = "nomor-container[" + (i + 1) + "]";
        input1[i].name = "nomor-container[" + (i + 1) + "]";
    }

    var select3 = document.querySelectorAll(
        "#table_container tr td:nth-child(5) select"
    );
    for (var i = 0; i < select3.length; i++) {
        select3[i].id = "seal[" + (i + 1) + "]";
        select3[i].name = "seal[" + (i + 1) + "]";
    }

    var textarea1 = document.querySelectorAll(
        "#table_container tr td:nth-child(6) textarea"
    );
    for (var i = 0; i < textarea1.length; i++) {
        textarea1[i].id = "cargo[" + (i + 1) + "]";
        textarea1[i].name = "cargo[" + (i + 1) + "]";
    }

    var button = document.querySelectorAll(
        "#table_container tr td:nth-child(7) button"
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
            var size = [""];
            var type = [""];
            for (var i = 0; i < response.size.length; i++) {
                size +=
                    "<option value='" +
                    response.size[i].size_container +
                    "'>" +
                    response.size[i].size_container +
                    "</option>";
            }
            for (var i = 0; i < response.type.length; i++) {
                type +=
                    "<option value='" +
                    response.type[i].type_container +
                    "'>" +
                    response.type[i].type_container +
                    "</option>";
            }
            var div1 = document.createElement("div");
            div1.setAttribute("class", "validation-container");
            var input1 = document.createElement("input");
            input1.setAttribute("class", "form-control jumlah-container");
            input1.setAttribute("id", "jumlah-container[" + urutan + "]");
            input1.setAttribute("name", "jumlah-container[" + urutan + "]");
            input1.setAttribute("required", true);
            input1.setAttribute("type", "text");
            input1.setAttribute("value", 0);
            div1.append(input1);

            var label1 = document.createElement("div");
            var labelx = document.createElement("label");
            labelx.innerHTML = "X";
            label1.append(labelx);

            var div2 = document.createElement("div");
            div2.setAttribute("class", "validation-container");
            var select1 = document.createElement("select");
            select1.innerHTML =
                "<option selected disabled>Pilih Size Kontainer</option>" +
                size;
            select1.setAttribute("id", "size[" + urutan + "]");
            select1.setAttribute("class", "form-select");
            select1.setAttribute("name", "size[" + urutan + "]");
            select1.setAttribute("required", true);
            div2.append(select1);
            var div3 = document.createElement("div");
            div3.setAttribute("class", "validation-container");
            var select2 = document.createElement("select");
            select2.innerHTML =
                "<option selected disabled>Pilih Type Kontainer</option>" +
                type;
            select2.setAttribute("id", "type[" + urutan + "]");
            select2.setAttribute("class", "form-select");
            select2.setAttribute("name", "type[" + urutan + "]");
            select2.setAttribute("required", true);
            div3.append(select2);
            var div4 = document.createElement("div");
            div4.setAttribute("class", "validation-container");
            var textarea1 = document.createElement("textarea");
            textarea1.setAttribute("id", "cargo[" + urutan + "]");
            textarea1.setAttribute("name", "cargo[" + urutan + "]");
            textarea1.setAttribute("class", "form-control");
            textarea1.setAttribute("required", true);
            div4.append(textarea1);
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
            var cell6 = row.insertCell(5);
            var cell7 = row.insertCell(6);

            cell1.innerHTML = "1.";
            cell2.appendChild(div1);
            cell3.appendChild(label1);
            cell4.appendChild(div2);
            cell5.appendChild(div3);
            cell6.appendChild(div4);
            cell7.appendChild(button);

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