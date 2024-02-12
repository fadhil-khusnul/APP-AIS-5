var tabel_container = $("#realisasiload_create").DataTable({
    responsive: true,
    pageLength: 5,
    lengthMenu: [[5, 10, 20, -1], [5, 10, 20, "All"]],
    fixedHeader: {
        header: true,
    },
    // scroller: true,

});
var table_alih_kapal_realisasi = $("#table_alih_kapal_realisasi").DataTable({
    responsive: true,
    pageLength: 5,
    lengthMenu: [[5, 10, 20, -1], [5, 10, 20, "All"]],
    fixedHeader: {
        header: true,
    },
    // scroller: true,

});
var tabel_si = $("#tabel_si").DataTable({
    responsive: true,
    pageLength: 5,
    lengthMenu: [[5, 10, 20, -1], [5, 10, 20, "All"]],
    fixedHeader: {
        header: true,
    },
    columnDefs: [{ targets: [10], visible: false }],
    columnDefs: [
        {
            targets: [10], // Target the 11th column
            className: 'collapsed dtr-inline sorting dtr-hidden', // Apply the dtr-inline collapsed class
        }
    ]
    // scroller: true,

});

$("#submit-id").attr("disabled", "disabled");
tabel_container.$(".check-container", { page: "all" },).click(function () {
    if ($(this).is(":checked")) {
        $("#submit-id").removeAttr("disabled");
    } else {
        $("#submit-id").attr("disabled", "disabled");
    }
});
$("#submit_ok").attr("disabled", "disabled");
tabel_container.$(".check_job", { page: "all" },).click(function () {
    if ($(this).is(":checked")) {
        $("#submit_ok").removeAttr("disabled");
    } else {
        $("#submit_ok").attr("disabled", "disabled");
    }
});




$("#submit-id1").attr("disabled", "disabled");
table_alih_kapal_realisasi.$(".check-container1", { page: "all" },).click(function () {
    if ($(this).is(":checked")) {
        $("#submit-id1").removeAttr("disabled");
    } else {
        $("#submit-id1").attr("disabled", "disabled");
    }
});


function biaya_do(e) {
    var id = e.value;
    console.log(id);
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

    swal.fire({
        title: " Masukkkan Biaya POL untuk kontainer ini?",
        icon: "question",
        showCancelButton: true,
        confirmButtonText: "Iya",
        cancelButtonText: "Tidak",
    }).then((willCreate) => {
        if (willCreate.isConfirmed) {
            $.ajax({
                url: "/detail-kontainer/" + id + "/input",
                type: "GET",
                success: function (response) {
                    let new_id = id;
                    console.log(new_id);
                    $("#modal_biaya_pol").modal("show");

                    $("#id_container").val(response.result.id);
                    $("#nomor_kontainer").html(response.result.nomor_kontainer);

                    $("#valid_pol").submit(function (e) {
                        e.preventDefault();
                    }).validate({
                        highlight: function highlight(
                            element,
                            errorClass,
                            validClass
                        ) {
                            $(element).addClass("is-invalid");
                            $(element).removeClass("is-valid");
                        },
                        unhighlight: function unhighlight(
                            element,
                            errorClass,
                            validClass
                        ) {
                            $(element).removeClass("is-invalid");
                        },
                        errorPlacement: function errorPlacement(
                            error,
                            element
                        ) {
                            error.addClass("invalid-feedback");
                            element
                                .closest(".validation-container")
                                .append(error);
                        },
                        submitHandler: function (form) {
                            document.getElementById(
                                "loading-wrapper"
                            ).style.cursor = "wait";
                            document
                                .getElementById("btn_pol")
                                .setAttribute("disabled", true);

                            var csrf = $("#csrf").val();
                            var id_container = $("#id_container").val();
                            var biaya_trucking = $("#biaya_trucking")
                                .val()
                                .replace(/\./g, "");
                            var freight = $("#freight")
                                .val()
                                .replace(/\./g, "");
                            var lss = $("#lss")
                                .val()
                                .replace(/\./g, "");
                            var input_total_biaya_lain = document.querySelector("#input_total_biaya_lain");

                            var keterangan_biaya = [];
                            if (input_total_biaya_lain !== null) {
                                // input_total_biaya_lain element exists
                                var input_total_biaya_lain = $("#input_total_biaya_lain").val().replace(/\./g, "");

                                // Further processing here

                                for (let i = 0; i < urutan_keterangan; i++) {
                                    keterangan_biaya[i] = document.getElementById("keterangan_biaya[" + (i + 1) + "]").value;
                                }
                            } else {
                                input_total_biaya_lain = 0
                            }
                            var data = {
                                _token: csrf,
                                id: id_container,
                                biaya_trucking: biaya_trucking,
                                freight: freight,
                                lss: lss,
                                input_total_biaya_lain: input_total_biaya_lain,
                                keterangan_biaya: keterangan_biaya,
                            };

                            $.ajax({
                                type: "POST",
                                url: "/masukkan-biaya-pol",
                                data: data,

                                success: function (response) {
                                    // console.log(response);
                                    toast
                                        .fire({
                                            icon: "success",
                                            title: "Biaya POL Dimasukkan",
                                            timer: 2e3,
                                        })
                                        .then((result) => {
                                            location.reload();
                                        });
                                },
                            });
                        },
                    });
                },
            });
        } else {
            toast.fire({
                title: "Nomor BL Tidak dimasukkan",
                icon: "error",
                timer: 2e3,
            });
        }
    });

    // for (let i = 0; i < chek_container.length; i++) {
    //     volume[i] = document.getElementById("volume[" + item_id[i] + "]").value;

    // }
}
function edit_biaya_do(e) {
    var id = e.value;
    console.log(id);
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

    $.ajax({
        url: "/detail-kontainer/" + id + "/input",
        type: "GET",
        success: function (response) {
            console.log(response);
            let new_id = id;
            $("#modal_biaya_pol_edit").modal("show");

            document.getElementById("div_button_biaya").innerHTML = "";
            document.getElementById("div_total_biaya_edit").innerHTML = "";
            document.getElementById("div_keterangan_biaya_edit").innerHTML = "";
            if (response.biayalain_pol.length == 0) {
                $("#id_container_edit").val(response.result.id);
                $("#nomor_kontainer_edit").html(response.result.nomor_kontainer);

                $("#biaya_trucking_edit").val(response.result.biaya_trucking);
                $("#freight_edit").val(response.result.freight);
                $("#lss_edit").val(response.result.lss);
                var button_biaya_lain = document.getElementById("div_button_biaya");

                var label1 = document.createElement("label");
                label1.setAttribute("id", "label_biaya");
                label1.setAttribute("name", "label_biaya");
                label1.setAttribute("class", "col-sm-4 col-form-label");

                var button1 = document.createElement("button");
                button1.setAttribute("type", "button");
                button1.setAttribute("id", "edit_button_biaya_lain");
                button1.setAttribute("name", "edit_button_biaya_lain");
                button1.setAttribute("value", 0);
                button1.setAttribute("class", "btn btn-sm btn-label-success btn-sm text-nowrap");
                button1.setAttribute("onclick", "edit_total_biaya_lain(this)");
                button1.innerHTML = "Biaya Lain <i class='fa fa-plus'></i>";

                label1.append(button1);
                button_biaya_lain.appendChild(label1);
                edit_urutan_keterangan = 1;

                $("#valid_pol_edit").submit(function (e) { e.preventDefault(); }).validate({
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
                    },
                    errorPlacement: function errorPlacement(error, element) {
                        error.addClass("invalid-feedback");
                        element.closest(".validation-container").append(error);
                    },
                    submitHandler: function (form) {
                        document.getElementById("loading-wrapper").style.cursor =
                            "wait";
                        document
                            .getElementById("btn_pol_edit")
                            .setAttribute("disabled", true);

                        var csrf = $("#csrf").val();
                        var id_container = $("#id_container_edit").val();
                        var biaya_trucking = $("#biaya_trucking_edit").val().replace(/\./g, "");
                        var freight = $("#freight_edit").val().replace(/\./g, "");
                        var lss = $("#lss_edit")
                            .val()
                            .replace(/\./g, "");

                        var input_total_biaya_lain = document.querySelector("#input_total_biaya_lain_edit")

                        var keterangan_biaya = [];
                        if (input_total_biaya_lain !== null) {
                            // input_total_biaya_lain element exists
                            input_total_biaya_lain = $("#input_total_biaya_lain_edit").val().replace(/\./g, "");

                            // Further processing here

                            for (let i = 0; i < edit_urutan_keterangan; i++) {
                                keterangan_biaya[i] = document.getElementById("keterangan_biaya[" + (i + 1) + "]").value;
                            }
                        } else {
                            input_total_biaya_lain = 0
                        }

                        var data = {
                            _token: csrf,
                            id: id_container,
                            biaya_trucking: biaya_trucking,
                            freight: freight,
                            lss: lss,
                            input_total_biaya_lain: input_total_biaya_lain,
                            keterangan_biaya: keterangan_biaya,
                        };

                        $.ajax({
                            type: "POST",
                            url: "/masukkan-biaya-pol",
                            data: data,

                            success: function (response) {
                                // console.log(response);
                                toast
                                    .fire({
                                        icon: "success",
                                        title: "Biaya POL Dimasukkan",
                                        timer: 2e3,
                                    })
                                    .then((result) => {
                                        location.reload();
                                    });
                            },
                        });
                    },
                });


            } else {
                $("#id_container_edit").val(response.result.id);
                $("#nomor_kontainer_edit").html(response.result.nomor_kontainer);

                $("#biaya_trucking_edit").val(response.result.biaya_trucking);
                $("#freight_edit").val(response.result.freight);
                $("#lss_edit").val(response.result.lss);
                var button_biaya_lain = document.getElementById("div_button_biaya");

                var label1 = document.createElement("label");
                label1.setAttribute("id", "label_biaya");
                label1.setAttribute("name", "label_biaya");
                label1.setAttribute("class", "col-sm-4 col-form-label");

                var button1 = document.createElement("button");
                button1.setAttribute("type", "button");
                button1.setAttribute("id", "edit_button_biaya_lain");
                button1.setAttribute("name", "edit_button_biaya_lain");
                button1.setAttribute("value", 1);
                button1.setAttribute("class", "btn btn-sm btn-label-danger btn-sm text-nowrap");
                button1.setAttribute("onclick", "edit_total_biaya_lain(this)");
                button1.innerHTML = "Hapus Biaya Lain <i class='fa fa-minus'></i>";

                label1.append(button1);
                button_biaya_lain.appendChild(label1);

                var div_total_biaya_lain = document.getElementById("div_total_biaya_edit");

                var label2 = document.createElement("label");
                label2.setAttribute("class", "col-sm-4 col-form-label");
                label2.innerHTML = "Total Biaya Lain : ";

                var div1 = document.createElement("div");
                div1.setAttribute("class", "col-sm-8 validation-container");

                var div2 = document.createElement("div");
                div2.setAttribute("class", "input-group input-group-sm");

                var span1 = document.createElement("span");
                span1.setAttribute("class", "input-group-text");
                span1.innerHTML = "Rp.";

                var input1 = document.createElement("input");
                input1.setAttribute("data-bs-toggle", "tooltip");
                input1.setAttribute("type", "text");
                input1.setAttribute("class", "form-control currency-rupiah");
                input1.setAttribute("id", "input_total_biaya_lain_edit");
                input1.setAttribute("name", "input_total_biaya_lain_edit");
                input1.setAttribute("placeholder", "Total Biaya Lain...");
                input1.setAttribute("value", response.result.total_biaya_lain_pol.toString());

                div2.append(span1);
                div2.append(input1);
                div1.append(div2);

                div_total_biaya_lain.appendChild(label2);
                div_total_biaya_lain.appendChild(div1);

                $("#input_total_biaya_lain_edit").inputmask({
                    alias: "numeric",
                    prefix: "",
                    groupSeparator: ".",
                    autoGroup: true,
                    digits: 0,
                    digitsOptional: false,
                    placeholder: "0",
                });

                var div_keterangan_biaya_lain = document.getElementById("div_keterangan_biaya_edit");
                edit_urutan_keterangan = response.biayalain_pol.length;

                for (var i = 0; i < response.biayalain_pol.length; i++) {
                    if (i == 0) {
                        var div3 = document.createElement("div");
                        div3.setAttribute("id", "body_biaya[" + (i + 1) + "]");
                        div3.setAttribute("class", "row row-cols");

                        var label3 = document.createElement("label");
                        label3.setAttribute("id", "label_biaya");
                        label3.setAttribute("name", "label_biaya");
                        label3.setAttribute("class", "col-sm-4 col-form-label");

                        var a1 = document.createElement("a");
                        a1.setAttribute("id", "tambah_keterangan");
                        a1.setAttribute("name", "tambah_keterangan");
                        a1.setAttribute("class", "btn btn-sm btn-label-success btn-sm text-nowrap");
                        a1.setAttribute("onclick", "edit_tambah_keterangan()");
                        a1.innerHTML = "Keterangan Biaya Lain <i class='fa fa-plus'></i>";

                        label3.append(a1);

                        var div4 = document.createElement("div");
                        div4.setAttribute("id", "div_textarea_biaya");
                        div4.setAttribute("name", "div_textarea_biaya");
                        div4.setAttribute("class", "col-sm-6 validation-container d-grid gap-3");

                        var textarea1 = document.createElement("textarea");
                        textarea1.setAttribute("style", "margin-left: 10px");
                        textarea1.setAttribute("data-bs-toggle", "tooltip");
                        textarea1.setAttribute("class", "form-control");
                        textarea1.setAttribute("id", "keterangan_biaya[" + (i + 1) + "]");
                        textarea1.setAttribute("name", "keterangan_biaya[" + (i + 1) + "]");
                        textarea1.setAttribute("placeholder", "ex. (Rp. 10.000 untuk kebutuhan kontainer)");
                        textarea1.setAttribute("required", true);
                        textarea1.innerHTML = response.biayalain_pol[i].keterangan;

                        div4.append(textarea1);

                        var div5 = document.createElement("div");
                        div5.setAttribute("id", "div_button_biaya");
                        div5.setAttribute("name", "div_button_biaya");
                        div5.setAttribute("class", "col-sm-2 py-4");

                        div3.append(label3);
                        div3.append(div4);
                        div3.append(div5);

                        div_keterangan_biaya_lain.appendChild(div3);
                    } else {
                        var div6 = document.createElement("div");
                        div6.setAttribute("id", "body_biaya[" + (i + 1) + "]");
                        div6.setAttribute("class", "row row-cols");

                        var label4 = document.createElement("label");
                        label4.setAttribute("id", "label_biaya");
                        label4.setAttribute("name", "label_biaya");
                        label4.setAttribute("class", "col-sm-4 col-form-label");

                        var div7 = document.createElement("div");
                        div7.setAttribute("id", "div_textarea_biaya");
                        div7.setAttribute("name", "div_textarea_biaya");
                        div7.setAttribute("class", "col-sm-6 validation-container d-grid gap-3");

                        var textarea2 = document.createElement("textarea");
                        textarea2.setAttribute("style", "margin-left: 10px");
                        textarea2.setAttribute("data-bs-toggle", "tooltip");
                        textarea2.setAttribute("class", "form-control");
                        textarea2.setAttribute("id", "keterangan_biaya[" + (i + 1) + "]");
                        textarea2.setAttribute("name", "keterangan_biaya[" + (i + 1) + "]");
                        textarea2.setAttribute("placeholder", "ex. (Rp. 10.000 untuk kebutuhan kontainer)");
                        textarea2.setAttribute("required", true);
                        textarea2.innerHTML = response.biayalain_pol[i].keterangan;

                        div7.append(textarea2);

                        var div8 = document.createElement("div");
                        div8.setAttribute("id", "div_button_biaya");
                        div8.setAttribute("name", "div_button_biaya");
                        div8.setAttribute("class", "col-sm-2 py-4");

                        var a2 = document.createElement("a");
                        a2.setAttribute("style", "margin-left: 10px");
                        a2.setAttribute("id", "hapus_biaya[" + (i + 1) + "]");
                        a2.setAttribute("name", "hapus_biaya[" + (i + 1) + "]");
                        a2.setAttribute("class", "btn btn-sm btn-label-danger btn-icon");
                        a2.setAttribute("onclick", "edit_hapus_biaya(this)");

                        var i1 = document.createElement("i");
                        i1.setAttribute("class", "fa fa-trash");

                        a2.append(i1);
                        div8.append(a2);

                        div6.append(label4);
                        div6.append(div7);
                        div6.append(div8);

                        div_keterangan_biaya_lain.appendChild(div6);
                    }
                }



                $("#valid_pol_edit").submit(function (e) { e.preventDefault(); }).validate({
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
                    },
                    errorPlacement: function errorPlacement(error, element) {
                        error.addClass("invalid-feedback");
                        element.closest(".validation-container").append(error);
                    },
                    submitHandler: function (form) {
                        document.getElementById("loading-wrapper").style.cursor =
                            "wait";
                        document
                            .getElementById("btn_pol_edit")
                            .setAttribute("disabled", true);

                        var csrf = $("#csrf").val();
                        var id_container = $("#id_container_edit").val();
                        var biaya_trucking = $("#biaya_trucking_edit").val().replace(/\./g, "");
                        var freight = $("#freight_edit").val().replace(/\./g, "");
                        var lss = $("#lss_edit").val().replace(/\./g, "");

                        var input_total_biaya_lain = document.querySelector("#input_total_biaya_lain_edit")

                        var keterangan_biaya = [];
                        if (input_total_biaya_lain != null) {
                            input_total_biaya_lain = $("#input_total_biaya_lain_edit").val().replace(/\./g, "");

                            for (let i = 0; i < edit_urutan_keterangan; i++) {
                                keterangan_biaya[i] = document.getElementById(
                                    "keterangan_biaya[" + (i + 1) + "]"
                                ).value;
                            }
                        } else {
                            input_total_biaya_lain = 0
                            keterangan_biaya = []
                        }




                        var data = {
                            _token: csrf,
                            id: id_container,
                            biaya_trucking: biaya_trucking,
                            freight: freight,
                            lss: lss,
                            input_total_biaya_lain: input_total_biaya_lain,
                            keterangan_biaya: keterangan_biaya,
                        };

                        $.ajax({
                            type: "POST",
                            url: "/masukkan-biaya-pol",
                            data: data,

                            success: function (response) {
                                // console.log(response);
                                toast
                                    .fire({
                                        icon: "success",
                                        title: "Biaya POL Dimasukkan",
                                        timer: 2e3,
                                    })
                                    .then((result) => {
                                        location.reload();
                                    });
                            },
                        });
                    },
                });
            }
        },
    });
}

function validate_biaya_trucking(ini) {

    var biaya_trucking = ini.value.replace(/\./g, "");
    biaya_trucking = parseFloat(biaya_trucking);
    var id = document.getElementById("id_container").value;

    $.ajax({
        url: "/detail-kontainer/" + id + "/input",
        type: "GET",
        success: function (response) {

            var ongkos_supir = response.result.ongkos_supir

            console.log(ongkos_supir);

            if (isNaN(ongkos_supir)) ongkos_supir = 0;

            if (ongkos_supir > 0) {
                if (ongkos_supir >= biaya_trucking) {
                    swal.fire({
                        title: "Biaya Trucking Harus Lebih Besar Daripada Ongkos Supir",
                        icon: "error",
                        timer: 2e3,
                        showConfirmButton: false,
                    }).then((result) => {
                        ini.value = "";
                    });
                }
            }
        },
    });



    // console.log(biaya_trucking);
}

var urutan_keterangan = 1;

function total_biaya_lain(e) {
    var value = e.value;
    console.log(value);

    var div_total_biaya = document.getElementById("div_total_biaya");
    var div_keterangan_biaya = document.getElementById("div_keterangan_biaya");

    if (value == 0) {
        var label1 = document.createElement("label");
        label1.setAttribute("class", "col-sm-4 col-form-label");
        label1.innerHTML = "Total Biaya Lain : ";

        var div1 = document.createElement("div");
        div1.setAttribute("class", "col-sm-8 validation-container");

        var div2 = document.createElement("div");
        div2.setAttribute("class", "input-group input-group-sm");

        var span1 = document.createElement("span");
        span1.setAttribute("class", "input-group-text");
        span1.innerHTML = "Rp.";

        var input1 = document.createElement("input");
        input1.setAttribute("data-bs-toggle", "tooltip");
        input1.setAttribute("type", "text");
        input1.setAttribute("class", "form-control currency-rupiah");
        input1.setAttribute("id", "input_total_biaya_lain");
        input1.setAttribute("name", "input_total_biaya_lain");
        input1.setAttribute("required", true);
        input1.setAttribute("placeholder", "Total Biaya Lain...");

        div2.append(span1);
        div2.append(input1);
        div1.append(div2);

        div_total_biaya.appendChild(label1);
        div_total_biaya.appendChild(div1);

        var div3 = document.createElement("div");
        div3.setAttribute("id", "body_biaya[1]");
        div3.setAttribute("class", "row row-cols");

        var label2 = document.createElement("label");
        label2.setAttribute("id", "label_biaya");
        label2.setAttribute("name", "label_biaya");
        label2.setAttribute("class", "col-sm-4 col-form-label");

        var a1 = document.createElement("a");
        // a1.setAttribute("type", "button");
        a1.setAttribute("id", "tambah_keterangan");
        a1.setAttribute("name", "tambah_keterangan");
        a1.setAttribute(
            "class",
            "btn btn-sm btn-label-success btn-sm text-nowrap"
        );
        a1.setAttribute("onclick", "tambah_keterangan()");
        a1.innerHTML = "Keterangan Biaya Lain <i class='fa fa-plus'></i>";

        label2.append(a1);

        var div4 = document.createElement("div");
        div4.setAttribute("id", "div_textarea_biaya");
        div4.setAttribute("name", "div_textarea_biaya");
        div4.setAttribute(
            "class",
            "col-sm-6 validation-container d-grid gap-3"
        );

        var textarea1 = document.createElement("textarea");
        textarea1.setAttribute("style", "margin-left: 10px");
        textarea1.setAttribute("data-bs-toggle", "tooltip");
        textarea1.setAttribute("class", "form-control");
        textarea1.setAttribute("id", "keterangan_biaya[1]");
        textarea1.setAttribute("name", "keterangan_biaya[1]");
        textarea1.setAttribute(
            "placeholder",
            "ex. (Rp.10.000 untuk kebutuhan kontainer)"
        );
        textarea1.setAttribute("required", true);

        div4.append(textarea1);

        div3.append(label2);
        div3.append(div4);

        div_keterangan_biaya.appendChild(div3);

        $("#input_total_biaya_lain").inputmask({
            alias: "numeric",
            prefix: "",
            groupSeparator: ".",
            autoGroup: true,
            digits: 0,
            digitsOptional: false,
            placeholder: "0",
        });

        document.getElementById("button_biaya_lain").value = 1;

        document
            .getElementById("button_biaya_lain")
            .setAttribute(
                "class",
                "btn btn-sm btn-label-danger btn-sm text-nowrap"
            );
        document.getElementById("button_biaya_lain").innerHTML =
            "Hapus Biaya Lain <i class='fa fa-minus'></i>";
    } else {
        div_total_biaya.innerHTML = "";
        div_keterangan_biaya.innerHTML = "";

        urutan_keterangan = 1;

        document.getElementById("button_biaya_lain").value = 0;

        document
            .getElementById("button_biaya_lain")
            .setAttribute(
                "class",
                "btn btn-sm btn-label-success btn-sm text-nowrap"
            );
        document.getElementById("button_biaya_lain").innerHTML =
            "Biaya Lain <i class='fa fa-plus'></i>";
    }
}

var edit_urutan_keterangan = 1;

function edit_total_biaya_lain(e) {
    var value = e.value;
    console.log(value);

    var div_total_biaya = document.getElementById("div_total_biaya_edit");
    var div_keterangan_biaya = document.getElementById("div_keterangan_biaya_edit");

    if (value == 0) {
        var label1 = document.createElement("label");
        label1.setAttribute("class", "col-sm-4 col-form-label");
        label1.innerHTML = "Total Biaya Lain : ";

        var div1 = document.createElement("div");
        div1.setAttribute("class", "col-sm-8 validation-container");

        var div2 = document.createElement("div");
        div2.setAttribute("class", "input-group input-group-sm");

        var span1 = document.createElement("span");
        span1.setAttribute("class", "input-group-text");
        span1.innerHTML = "Rp.";

        var input1 = document.createElement("input");
        input1.setAttribute("data-bs-toggle", "tooltip");
        input1.setAttribute("type", "text");
        input1.setAttribute("class", "form-control currency-rupiah");
        input1.setAttribute("id", "input_total_biaya_lain_edit");
        input1.setAttribute("name", "input_total_biaya_lain_edit");
        input1.setAttribute("required", true);
        input1.setAttribute("placeholder", "Total Biaya Lain...");

        div2.append(span1);
        div2.append(input1);
        div1.append(div2);

        div_total_biaya.appendChild(label1);
        div_total_biaya.appendChild(div1);

        var div3 = document.createElement("div");
        div3.setAttribute("id", "body_biaya[1]");
        div3.setAttribute("class", "row row-cols");

        var label2 = document.createElement("label");
        label2.setAttribute("id", "label_biaya");
        label2.setAttribute("name", "label_biaya");
        label2.setAttribute("class", "col-sm-4 col-form-label");

        var a1 = document.createElement("a");
        // a1.setAttribute("type", "button");
        a1.setAttribute("id", "tambah_keterangan");
        a1.setAttribute("name", "tambah_keterangan");
        a1.setAttribute(
            "class",
            "btn btn-sm btn-label-success btn-sm text-nowrap"
        );
        a1.setAttribute("onclick", "edit_tambah_keterangan()");
        a1.innerHTML = "Keterangan Biaya Lain <i class='fa fa-plus'></i>";

        label2.append(a1);

        var div4 = document.createElement("div");
        div4.setAttribute("id", "div_textarea_biaya");
        div4.setAttribute("name", "div_textarea_biaya");
        div4.setAttribute(
            "class",
            "col-sm-6 validation-container d-grid gap-3"
        );

        var textarea1 = document.createElement("textarea");
        textarea1.setAttribute("style", "margin-left: 10px");
        textarea1.setAttribute("data-bs-toggle", "tooltip");
        textarea1.setAttribute("class", "form-control");
        textarea1.setAttribute("id", "keterangan_biaya[1]");
        textarea1.setAttribute("name", "keterangan_biaya[1]");
        textarea1.setAttribute(
            "placeholder",
            "ex. (Rp. 10.000 untuk kebutuhan kontainer)"
        );
        textarea1.setAttribute("required", true);

        div4.append(textarea1);

        div3.append(label2);
        div3.append(div4);

        div_keterangan_biaya.appendChild(div3);

        $("#input_total_biaya_lain_edit").inputmask({
            alias: "numeric",
            prefix: "",
            groupSeparator: ".",
            autoGroup: true,
            digits: 0,
            digitsOptional: false,
            placeholder: "0",
        });

        document.getElementById("edit_button_biaya_lain").value = 1;

        document
            .getElementById("edit_button_biaya_lain")
            .setAttribute(
                "class",
                "btn btn-sm btn-label-danger btn-sm text-nowrap"
            );
        document.getElementById("edit_button_biaya_lain").innerHTML =
            "Hapus Biaya Lain <i class='fa fa-minus'></i>";
    } else {
        div_total_biaya.innerHTML = "";
        div_keterangan_biaya.innerHTML = "";

        edit_urutan_keterangan = 1;

        document.getElementById("edit_button_biaya_lain").value = 0;

        document
            .getElementById("edit_button_biaya_lain")
            .setAttribute(
                "class",
                "btn btn-sm btn-label-success btn-sm text-nowrap"
            );
        document.getElementById("edit_button_biaya_lain").innerHTML =
            "Biaya Lain <i class='fa fa-plus'></i>";
    }
}
function tambah_keterangan() {
    urutan_keterangan++;

    var div1 = document.getElementById("div_keterangan_biaya");

    var div2 = document.createElement("div");
    div2.setAttribute("id", "body_biaya[" + urutan_keterangan + "]");
    div2.setAttribute("class", "row row-cols");

    var label1 = document.createElement("label");
    label1.setAttribute("id", "label_biaya");
    label1.setAttribute("name", "label_biaya");
    label1.setAttribute("class", "col-sm-4 col-form-label");

    var div3 = document.createElement("div");
    div3.setAttribute("id", "div_textarea_biaya");
    div3.setAttribute("name", "div_textarea_biaya");
    div3.setAttribute("class", "col-sm-6 validation-container d-grid gap-3");

    var textarea1 = document.createElement("textarea");
    textarea1.setAttribute("style", "margin-left: 10px; margin-top:10px;");
    textarea1.setAttribute("data-bs-toggle", "tooltip");
    textarea1.setAttribute("class", "form-control");
    textarea1.setAttribute("id", "keterangan_biaya[" + urutan_keterangan + "]");
    textarea1.setAttribute(
        "name",
        "keterangan_biaya[" + urutan_keterangan + "]"
    );
    textarea1.setAttribute(
        "placeholder",
        "ex. (Rp. 10.000 untuk kebutuhan kontainer)"
    );
    textarea1.setAttribute("required", true);

    div3.append(textarea1);

    var div4 = document.createElement("div");
    div4.setAttribute("id", "div_button_biaya");
    div4.setAttribute("name", "div_button_biaya");
    div4.setAttribute("class", "col-sm-2 py-4");

    var a1 = document.createElement("a");
    a1.setAttribute("style", "margin-left: 10px");
    a1.setAttribute("id", "hapus_biaya[" + urutan_keterangan + "]");
    a1.setAttribute("name", "hapus_biaya[" + urutan_keterangan + "]");
    a1.setAttribute("class", "btn btn-sm btn-label-danger btn-icon");
    a1.setAttribute("onclick", "button_hapus_biaya(this)");

    var icon1 = document.createElement("i");
    icon1.setAttribute("class", "fa fa-trash");

    a1.append(icon1);
    div4.append(a1);

    div2.append(label1);
    div2.append(div3);
    div2.append(div4);

    div1.appendChild(div2);
}
function edit_tambah_keterangan() {
    edit_urutan_keterangan++

    var div1 = document.getElementById("div_keterangan_biaya_edit");

    var div2 = document.createElement("div");
    div2.setAttribute("id", "body_biaya[" + edit_urutan_keterangan + "]");
    div2.setAttribute("class", "row row-cols");

    var label1 = document.createElement("label");
    label1.setAttribute("id", "label_biaya");
    label1.setAttribute("name", "label_biaya");
    label1.setAttribute("class", "col-sm-4 col-form-label");

    var div3 = document.createElement("div");
    div3.setAttribute("id", "div_textarea_biaya");
    div3.setAttribute("name", "div_textarea_biaya");
    div3.setAttribute("class", "col-sm-6 validation-container d-grid gap-3");

    var textarea1 = document.createElement("textarea");
    textarea1.setAttribute("style", "margin-left: 10px; margin-top:10px;");
    textarea1.setAttribute("data-bs-toggle", "tooltip");
    textarea1.setAttribute("class", "form-control");
    textarea1.setAttribute("id", "keterangan_biaya[" + edit_urutan_keterangan + "]");
    textarea1.setAttribute(
        "name",
        "keterangan_biaya[" + edit_urutan_keterangan + "]"
    );
    textarea1.setAttribute(
        "placeholder",
        "ex. (Rp. 10.000 untuk kebutuhan kontainer)"
    );
    textarea1.setAttribute("required", true);

    div3.append(textarea1);

    var div4 = document.createElement("div");
    div4.setAttribute("id", "div_button_biaya");
    div4.setAttribute("name", "div_button_biaya");
    div4.setAttribute("class", "col-sm-2 py-4");

    var a1 = document.createElement("a");
    a1.setAttribute("style", "margin-left: 10px");
    a1.setAttribute("id", "hapus_biaya[" + edit_urutan_keterangan + "]");
    a1.setAttribute("name", "hapus_biaya[" + edit_urutan_keterangan + "]");
    a1.setAttribute("class", "btn btn-sm btn-label-danger btn-icon");
    a1.setAttribute("onclick", "edit_hapus_biaya(this)");

    var icon1 = document.createElement("i");
    icon1.setAttribute("class", "fa fa-trash");

    a1.append(icon1);
    div4.append(a1);

    div2.append(label1);
    div2.append(div3);
    div2.append(div4);

    div1.appendChild(div2);
}

function button_hapus_biaya(e) {
    var urutan_delete = e.parentNode.parentNode;
    urutan_delete.remove();
    urutan_keterangan--;

    var div1 = document.querySelectorAll("#div_textarea_biaya textarea");

    for (var i = 0; i < div1.length; i++) {
        div1[i].id = "keterangan_biaya[" + (i + 1) + "]";
        div1[i].name = "keterangan_biaya[" + (i + 1) + "]";
        div1[i].placeholder =
            "ex. (Rp. 10.000 untuk kebutuhan kontainer)";
    }

    var div2 = document.querySelectorAll("#div_button_biaya a");

    for (var i = 0; i < div2.length; i++) {
        div2[i].id = "hapus_biaya[" + (i + 1) + "]";
        div2[i].name = "hapus_biaya[" + (i + 1) + "]";
    }
}

function edit_hapus_biaya(e) {
    var urutan_delete = e.parentNode.parentNode;
    urutan_delete.remove();
    edit_urutan_keterangan--;

    var div1 = document.querySelectorAll("#div_textarea_biaya textarea");

    for (var i = 0; i < div1.length; i++) {
        div1[i].id = "keterangan_biaya[" + (i + 1) + "]";
        div1[i].name = "keterangan_biaya[" + (i + 1) + "]";
        div1[i].placeholder =
            "ex. (Rp. 10.000 untuk kebutuhan kontainer)";
    }

    var div2 = document.querySelectorAll("#div_button_biaya a");

    for (var i = 0; i < div2.length; i++) {
        div2[i].id = "hapus_biaya[" + (i + 1) + "]";
        div2[i].name = "hapus_biaya[" + (i + 1) + "]";
    }
}


function pilih_pod_input_fun(val) {
    var filter = [];
    filter = $("#pilih_pod_input").val();
    console.log(filter);

    if (filter == null) {
        tabel_container.columns(4).search("").draw();
    } else {
        tabel_container
            .columns(4)
            .search(filter.join("|"), true, false, true)
            .draw();
    }
}
function pilih_pot_input_fun(val) {
    var filter = [];
    filter = $("#pilih_pot_input").val();
    console.log(filter);

    if (filter == null) {
        tabel_container.columns(5).search("").draw();
    } else {
        tabel_container
            .columns(5)
            .search(filter.join("|"), true, false, true)
            .draw();
    }
}
function pilih_size_input_fun(val) {
    var filter = [];
    filter = $("#pilih_size_input").val();
    console.log(filter);

    if (filter == null) {
        tabel_container.columns(7).search("").draw();
    } else {
        tabel_container
            .columns(7)
            .search(filter.join("|"), true, false, true)
            .draw();
    }
}
function pilih_type_input_fun(val) {
    var filter = [];
    filter = $("#pilih_type_input").val();
    console.log(filter);

    if (filter == null) {
        tabel_container.columns(8).search("").draw();
    } else {
        tabel_container
            .columns(8)
            .search(filter.join("|"), true, false, true)
            .draw();
    }
}
function pilih_ok_input_fun(val) {

    // console.log(val);
    var filter = [];
    filter = $("#pilih_ok_input").val();
    console.log(filter);

    if (filter == null) {
        tabel_container.columns(2).search("").draw();
    } else {
        tabel_container
            .columns(2)
            .search(filter)
            .draw();
    }
}
function pdf_si() {
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

    $("#valid_realisasi").validate({
        ignore: "select[type=hidden]",
        rules: {
            letter: {
                required: true,
            },
        },
        messages: {
            letter: {
                required: "Silakan Pilih Minimal 1 Container",
            },
        },

        highlight: function highlight(element, errorClass, validClass) {
            $(element).addClass("is-invalid");
            $(element).removeClass("is-valid");
        },
        unhighlight: function unhighlight(element, errorClass, validClass) {
            $(element).removeClass("is-invalid");
        },
        errorPlacement: function errorPlacement(error, element) {
            error.addClass("invalid-feedback");
            element.closest(".validation-container").append(error);
            if (element.attr("name") == "letter") {
                error.appendTo("#checkboxerror");
            } else {
                error.insertAfter(element);
            }
        },
        submitHandler: function (form) {
            let token = $("#csrf").val();
            // var chek_container = $(".check-container:checked")
            //     .map(function () {
            //         return this.value;
            //     })
            //     .get();

            var chek_container = []

            var rowcollection = tabel_container.$(".check-container:checked", { "page": "all" });
            rowcollection.each(function (index, elem) {
                chek_container.push($(elem).val());
            });


            $.ajax({
                type: "post",
                url: "/getPodLoad",
                data: {
                    _token: token,
                    chek_container: chek_container,
                },
                success: function (response) {
                    console.log(response);
                    var pod_sama = [...new Set(response.pod_container)];
                    var pot_sama = [...new Set(response.pot_container)];
                    console.log(pot_sama, pod_sama);

                    if (pod_sama.length != 1) {
                        swal.fire({
                            title: "POD/POT Container Tidak Sama",
                            text: "Silahkan Perhatikan Detail Informasi Containernya",
                            icon: "error",
                            timer: 2e3,
                            showConfirmButton: false,
                        });
                    }
                    else {
                        var old_slug = $("#old_slug").val();

                        var d = new Date(),
                            dformat = [
                                d.getFullYear(),
                                d.getMonth() + 1,
                                d.getDate(),
                                d.getHours(),
                                d.getMinutes(),
                                d.getSeconds(),
                            ].join("-");

                        swal.fire({
                            title: " Buat SI Untuk Job Load ini?",
                            text: "Silahkan Periksa Semua Data yang ada Sebelum Membuat Shipping Container (SI).",
                            icon: "question",
                            showCancelButton: true,
                            confirmButtonText: "Iya",
                            cancelButtonText: "Tidak",
                        }).then((willCreate) => {
                            if (willCreate.isConfirmed) {
                                $("#modal-si").modal("show");

                                $("#valid_si").validate({
                                    rules: {
                                        shipper: {
                                            required: true,
                                        },
                                        consigne: {
                                            required: true,
                                        },
                                    },
                                    messages: {
                                        shipper: {
                                            required: "Silakan Isi SHIPPER",
                                        },
                                        consigne: {
                                            required: "Silakan Isi CONSIGNE",
                                        },
                                    },
                                    highlight: function highlight(
                                        element,
                                        errorClass,
                                        validClass
                                    ) {
                                        $(element).addClass("is-invalid");
                                        $(element).removeClass("is-valid");
                                    },
                                    unhighlight: function unhighlight(
                                        element,
                                        errorClass,
                                        validClass
                                    ) {
                                        $(element).removeClass("is-invalid");
                                    },
                                    errorPlacement: function errorPlacement(
                                        error,
                                        element
                                    ) {
                                        error.addClass("invalid-feedback");
                                        element
                                            .closest(".validation-container")
                                            .append(error);
                                    },
                                    submitHandler: function (form) {
                                        document.getElementById('loading-wrapper').style.cursor = "wait";
                                        document.getElementById('btnFinish').setAttribute('disabled', true);
                                        var shipper = $("#shipper").val();
                                        var consigne = $("#consigne").val();

                                        var data = {
                                            _token: token,
                                            chek_container: chek_container,
                                            old_slug: old_slug,
                                            shipper: shipper,
                                            consigne: consigne,

                                            status_si: "Default",
                                        };

                                        $.ajax({
                                            type: "POST",
                                            url: "/create-si-container",
                                            data: data,
                                            xhrFields: {
                                                responseType: "blob",
                                            },
                                            success: function (response) {
                                                toast.fire({
                                                    icon: "success",
                                                    title: "SI Berhasil Dibuat",
                                                });
                                                var blob = new Blob([response]);
                                                var link = document.createElement("a");
                                                link.href =
                                                    window.URL.createObjectURL(blob);
                                                link.download =
                                                    "" + old_slug + dformat + ".pdf";
                                                link.click();

                                                setTimeout(function () {
                                                    window.location.reload();
                                                }, 10);
                                            },
                                        });
                                    },
                                });
                            } else {
                                swal.fire({
                                    title: "SI Tidak Dibuat",
                                    // text: "Data Batal Dihapus",
                                    icon: "error",
                                    timer: 2e3,
                                    showConfirmButton: false,
                                });
                            }
                        });

                    }
                },
            });
        },
    });
}

function pdf_si_alih() {
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

    $("#valid_realisasi").validate({
        ignore: "select[type=hidden]",
        highlight: function highlight(element, errorClass, validClass) {
            $(element).addClass("is-invalid");
            $(element).removeClass("is-valid");
        },
        unhighlight: function unhighlight(element, errorClass, validClass) {
            $(element).removeClass("is-invalid");
        },
        errorPlacement: function errorPlacement(error, element) {
            error.addClass("invalid-feedback");
            element.closest(".validation-container").append(error);
            if (element.attr("name") == "letter1") {
                error.appendTo("#checkboxerror");
            } else {
                error.insertAfter(element);
            }
        },
        submitHandler: function (form) {
            let token = $("#csrf").val();
            //
            var chek_container = []

            var rowcollection = table_alih_kapal_realisasi.$(".check-container1:checked", { "page": "all" });
            rowcollection.each(function (index, elem) {
                chek_container.push($(elem).val());
            });
            console.log(chek_container);

            $.ajax({
                type: "post",
                url: "/getAlihKapal",
                data: {
                    _token: token,
                    kontainer_alih: chek_container,
                },
                success: function (response) {
                    var unique_alih_kapal = [...new Set(response)];

                    if (unique_alih_kapal.length != 1) {
                        swal.fire({
                            title: "Vessel/Voyage Alih Kapal Tidak Sama",
                            text: "Silahkan Perhatikan Detail Alih-Kapalnya",
                            icon: "error",
                            timer: 2e3,
                            showConfirmButton: false,
                        });
                    } else {
                        var old_slug = $('#old_slug').val();
                        var d = new Date(),
                            dformat = [
                                d.getFullYear(),
                                d.getMonth() + 1,
                                d.getDate(),
                                d.getHours(),
                                d.getMinutes(),
                                d.getSeconds(),
                            ].join('-');
                        swal.fire({
                            title: " Buat SI Untuk Job Load ini?",
                            text: "Silahkan Periksa Semua Data yang ada Sebelum Membuat Shipping Container (SI).",
                            icon: "question",
                            showCancelButton: true,
                            confirmButtonText: "Iya",
                            cancelButtonText: "Tidak",
                        }).then((willCreate) => {
                            if (willCreate.isConfirmed) {
                                $('#modal-si').modal('show');
                                $('#valid_si').validate({
                                    rules: {
                                        shipper: {
                                            required: true
                                        },
                                        consigne: {
                                            required: true
                                        },
                                    },
                                    messages: {
                                        shipper: {
                                            required: "Silakan Isi SHIPPER"
                                        },
                                        consigne: {
                                            required: "Silakan Isi CONSIGNE"
                                        },
                                    },
                                    highlight: function highlight(element, errorClass, validClass) {
                                        $(element).addClass("is-invalid");
                                        $(element).removeClass("is-valid");
                                    },
                                    unhighlight: function unhighlight(element, errorClass, validClass) {
                                        $(element).removeClass("is-invalid");
                                    },
                                    errorPlacement: function errorPlacement(error, element) {
                                        error.addClass("invalid-feedback");
                                        element.closest(".validation-container").append(error);
                                    },
                                    submitHandler: function (form) {
                                        document.getElementById('loading-wrapper').style.cursor = "wait";
                                        document.getElementById('btnFinish').setAttribute('disabled', true);
                                        var shipper = $('#shipper').val();
                                        var consigne = $('#consigne').val();
                                        var old_slug = $('#old_slug').val();
                                        // var slug_container = $('#slug_container').val();
                                        var data = {
                                            "_token": token,
                                            'chek_container': chek_container,
                                            'shipper': shipper,
                                            'consigne': consigne,
                                            'old_slug': old_slug,
                                            'status_si': "Alih-Kapal",
                                        };
                                        $.ajax({
                                            type: "POST",
                                            url: '/create-si-alih',
                                            data: data,
                                            xhrFields: {
                                                responseType: 'blob'
                                            },
                                            success: function (response) {
                                                toast.fire({
                                                    icon: "success",
                                                    title: "SI Berhasil Dibuat"
                                                })
                                                var blob = new Blob([response]);
                                                var link = document.createElement('a');
                                                link.href = window.URL.createObjectURL(blob);
                                                link.download = "" + old_slug + dformat + ".pdf";
                                                link.click();
                                                setTimeout(function () {
                                                    window.location.reload();
                                                }, 10);
                                            }
                                        });
                                    }
                                });
                            } else {
                                swal.fire({
                                    title: "SI Tidak Dibuat",
                                    // text: "Data Batal Dihapus",
                                    icon: "error",
                                    timer: 2e3,
                                    showConfirmButton: false
                                });
                            }
                        });

                    }
                },
            });
        },
    });
}

function input_bl(e) {
    var id = e.value;
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

    swal.fire({
        title: " Masukkkan Nomor BL untuk SI ini?",
        icon: "question",
        showCancelButton: true,
        confirmButtonText: "Iya",
        cancelButtonText: "Tidak",
    }).then((willCreate) => {
        if (willCreate.isConfirmed) {
            $("#modal-bl").modal("show");

            $("#valid_bl").validate({
                rules: {
                    nomor_bl: {
                        required: true,
                    },
                    tanggal_bl: {
                        required: true,
                    },
                },
                messages: {
                    nomor_bl: {
                        required: "Silakan Isi Nomor BL",
                    },
                    tanggal_bl: {
                        required: "Silakan Isi Tanggal BL",
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
                },
                errorPlacement: function errorPlacement(error, element) {
                    error.addClass("invalid-feedback");
                    element.closest(".validation-container").append(error);
                },
                submitHandler: function (form) {
                    document.getElementById("loading-wrapper").style.cursor =
                        "wait";
                    document
                        .getElementById("btnFinish1")
                        .setAttribute("disabled", true);

                    var csrf = $("#csrf").val();
                    var nomor_bl = $("#nomor_bl").val();
                    var tanggal_bl = $("#tanggal_bl").val();
                    tanggal_bl = moment(tanggal_bl, "dddd, DD-MMMM-YYYY").format("YYYY-MM-DD")

                    // var tanggal_do_pol = $("#tanggal_do_pol").val();
                    // tanggal_do_pol = moment(tanggal_do_pol, "dddd, DD-MMMM-YYYY").format("YYYY-MM-DD")
                    var biaya_do_pol = $("#biaya_do_pol").val().replace(/\./g, "");


                    var data = {
                        _token: csrf,
                        id: id,
                        nomor_bl: nomor_bl,
                        tanggal_bl: tanggal_bl,
                        // tanggal_do_pol: tanggal_do_pol,
                        biaya_do_pol: biaya_do_pol,
                    };

                    $.ajax({
                        type: "POST",
                        url: "/masukkan-bl",
                        data: data,

                        success: function (response) {
                            toast
                                .fire({
                                    icon: "success",
                                    title: "Nomor Berhasil Dimasukkan",
                                    timer: 2e3,
                                })
                                .then((result) => {
                                    location.reload();
                                });
                        },
                    });
                },
            });
        } else {
            toast.fire({
                title: "Nomor BL Tidak dimasukkan",
                icon: "error",
                timer: 2e3,
            });
        }
    });

    // for (let i = 0; i < chek_container.length; i++) {
    //     volume[i] = document.getElementById("volume[" + item_id[i] + "]").value;

    // }
}
function update_bl(e) {
    var id = e.value;
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

    $.ajax({
        url: "/detail-pdf/" + id + "/input",
        type: "GET",
        success: function (response) {
            let new_id = id;
            $("#modal-bl-edit").modal("show");

            $("#id_container").val(response.result.id);
            $("#nomor_bl_edit").val(response.result.nomor_bl);

            var old_tanggal_result = moment(
                response.result.tanggal_bl,
                "YYYY-MM-DD"
            ).format("dddd, DD-MM-YYYY");
            $("#tanggal_bl_edit").val(old_tanggal_result);


            $("#biaya_do_pol_edit").val(response.result.biaya_do_pol);

            $("#valid_bl_edit").validate({

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
                },
                errorPlacement: function errorPlacement(error, element) {
                    error.addClass("invalid-feedback");
                    element.closest(".validation-container").append(error);
                },
                submitHandler: function (form) {
                    document.getElementById("loading-wrapper").style.cursor =
                        "wait";
                    document
                        .getElementById("btnFinish2")
                        .setAttribute("disabled", true);

                    var csrf = $("#csrf").val();
                    var nomor_bl = $("#nomor_bl_edit").val();
                    var id_container = $("#id_container").val();
                    var tanggal_bl = $("#tanggal_bl_edit").val();
                    tanggal_bl = moment(tanggal_bl, "dddd, DD-MMMM-YYYY").format("YYYY-MM-DD")

                    // var tanggal_do_pol = $("#tanggal_do_pol_edit").val();
                    // tanggal_do_pol = moment(tanggal_do_pol, "dddd, DD-MMMM-YYYY").format("YYYY-MM-DD")
                    // console.log(tanggal_do_pol);

                    var biaya_do_pol = $("#biaya_do_pol_edit").val().replace(/\./g, "");



                    var data = {
                        _token: csrf,
                        id: id_container,
                        nomor_bl: nomor_bl,
                        biaya_do_pol: biaya_do_pol,
                        tanggal_bl: tanggal_bl,
                        // tanggal_do_pol: tanggal_do_pol,
                    };

                    $.ajax({
                        type: "POST",
                        url: "/masukkan-bl",
                        data: data,

                        success: function (response) {
                            toast
                                .fire({
                                    icon: "success",
                                    title: "Nomor Berhasil Dimasukkan",
                                    timer: 2e3,
                                })
                                .then((result) => {
                                    location.reload();
                                });
                        },
                    });
                },
            });

        },
    });


    // for (let i = 0; i < chek_container.length; i++) {
    //     volume[i] = document.getElementById("volume[" + item_id[i] + "]").value;

    // }
}

function approve_si(ini) {
    var swal = Swal.mixin({
        customClass: {
            confirmButton: "btn btn-label-success btn-wide mx-1",
            denyButton: "btn btn-label-secondary btn-wide mx-1",
            cancelButton: "btn btn-label-danger btn-wide mx-1",
        },
        buttonsStyling: false,
    });

    var terima = "Disetujui";
    let token = $("#csrf").val();

    var container_id = ini.value;
    var data = {
        _token: token,
        terima: terima,
        container_id: container_id,
    };

    if (terima == "Disetujui") {
        swal.fire({
            title: "Apakah anda yakin Ingin APPROVE SI ini?",
            text: "Setelah SI disetujui, Anda tidak dapat menolak SI ini lagi!",
            icon: "question",
            showCancelButton: true,
            confirmButtonText: "Iya",
            cancelButtonText: "Tidak",
        }).then((willCreate) => {
            if (willCreate.isConfirmed) {
                $.ajax({
                    type: "POST",
                    url: "/konfirmasi-si",
                    data: data,
                    success: function (response) {
                        swal.fire({
                            title: "SI Diapprove",
                            text: "SI Telah Diapprove",
                            icon: "success",
                            timer: 2e3,
                            showConfirmButton: false,
                        }).then((result) => {
                            window.location.reload();
                        });
                    },
                });
            } else {
                swal.fire({
                    title: "SI Belum Diapprove",
                    text: "Silakan Perhatikan SI Lagi Sebelum Diapprove",
                    icon: "warning",
                    timer: 2e3,
                    showConfirmButton: false,
                });
            }
        });
    }
}
function tolak_si(ini) {
    var swal = Swal.mixin({
        customClass: {
            confirmButton: "btn btn-label-success btn-wide mx-1",
            denyButton: "btn btn-label-secondary btn-wide mx-1",
            cancelButton: "btn btn-label-danger btn-wide mx-1",
        },
        buttonsStyling: false,
    });

    var terima = "Ditolak";
    let token = $("#csrf").val();

    var container_id = ini.value;
    var data = {
        _token: token,
        terima: terima,
        container_id: container_id,
    };

    if (terima == "Ditolak") {
        swal.fire({
            title: "Apakah anda yakin ingin MENOLAK SI ini?",
            text: "Setelah SI ditolak, Anda tidak dapat menyetujui SI ini lagi!",
            icon: "question",
            showCancelButton: true,
            confirmButtonText: "Iya",
            cancelButtonText: "Tidak",
        }).then((willCreate) => {
            if (willCreate.isConfirmed) {
                $.ajax({
                    type: "POST",
                    url: "/konfirmasi-si",
                    data: data,
                    success: function (response) {
                        swal.fire({
                            title: "SI Ditolak",
                            text: "SI Telah Ditolak",
                            icon: "error",
                            timer: 2e3,
                            showConfirmButton: false,
                        }).then((result) => {
                            window.location.reload();
                        });
                    },
                });
            } else {
                swal.fire({
                    title: "SI Belum Ditolak",
                    text: "Silakan Perhatikan SI Lagi Sebelum Ditolak",
                    icon: "warning",
                    timer: 2e3,
                    showConfirmButton: false,
                });
            }
        });
    }
}

function detail_update(e) {
    let id = e.value;
    var swal = Swal.mixin({
        customClass: {
            confirmButton: "btn btn-success btn-wide mx-1",
            denyButton: "btn btn-secondary btn-wide mx-1",
            cancelButton: "btn btn-danger btn-wide mx-1",
        },
        buttonsStyling: false,
    });

    $.ajax({
        url: "/detail-kontainer/" + id + "/input",
        type: "GET",
        success: function (response) {
            let new_id = id;

            var seals = [""];
            var spk = [""];
            var supir = [""];

            for (let i = 0; i < response.seal_containers.length; i++) {
                seals[i] = response.seal_containers[i].seal_kontainer;
            }
            for (let i = 0; i < response.spks.length; i++) {
                spk[i] = response.spks[i].spk_kontainer;
            }
            for (let i = 0; i < response.supirs.length; i++) {
                supir +=
                    "<option value='" +
                    response.supirs[i].id +
                    "'>" +
                    response.supirs[i].nama_supir +
                    "/" +
                    response.supirs[i].nomor_polisi +
                    "</option>";
            }
            $("#modal-job-update").modal("show");

            $("#size_update").val(response.result.size);
            $("#type_update").val(response.result.type);
            $("#nomor_kontainer_update").val(response.result.nomor_kontainer);
            $("#no_container_edit").val(response.result.nomor_kontainer);
            $("#cargo_update").val(response.result.cargo);
            $("#detail_barang_update").val(response.result.detail_barang);
            $("#seal_old").val(seals);

            $("#seal_update")
                .val(seals)
                .select2({
                    dropdownAutoWidth: true,
                    // tags: true,
                    placeholder: "Silahkan Pilih",
                    // allowClear:true,
                    maximumSelectionLength: 4,
                    dropdownParent: $("#modal-job-update"),
                })
                .on("select2:select", function (e) {
                    var selected_element = $(e.currentTarget);
                    var select_val = selected_element.val();

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
                            var seal = $("#seal_update").val();
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
                                            '#seal_update option[value="' +
                                            last_seal +
                                            '"]'
                                        );

                                        wanted_option.prop("selected", false);
                                        // $(this).trigger("change.select2");
                                        $("#seal_update").trigger(
                                            "change.select2"
                                        );
                                    });
                                }
                            }
                        },
                    });
                });
            $("#spk_update")
                .val(spk)
                .select2({
                    dropdownAutoWidth: true,
                    placeholder: "Silahkan Pilih",
                    // allowClear:true,
                    maximumSelectionLength: 4,
                    dropdownParent: $("#modal-job-update"),
                })
                .on("select2:select", function (e) {
                    var selected_element = $(e.currentTarget);
                    var select_val = selected_element.val();

                    var element = e.params.data.element;
                    var $element = $(element);

                    $element.detach();
                    $(this).append($element);
                    $(this).trigger("change");

                    let token = $("#csrf").val();

                    $.ajax({
                        url: "/getSpkProcessLoad",
                        type: "post",
                        async: false,
                        data: {
                            _token: token,
                        },
                        success: function (response) {
                            var seal = $("#spk_update").val();
                            var last_seal = seal[seal.length - 1];
                            var count_seal = response.length;
                            var seal_already = [];
                            for (var i = 0; i < count_seal; i++) {
                                seal_already[i] = response[i].spk_kontainer;
                            }

                            if (spk.includes(last_seal) == false) {
                                if (seal_already.includes(last_seal)) {
                                    swal.fire({
                                        title: "SPK Kontainer Sudah Dipakai",
                                        icon: "error",
                                        timer: 10e3,
                                        async: false,
                                        showConfirmButton: true,
                                    }).then(() => {
                                        var wanted_option = $(
                                            '#spk_update option[value="' +
                                            last_seal +
                                            '"]'
                                        );

                                        wanted_option.prop("selected", false);
                                        // $(this).trigger("change.select2");
                                        $("#spk_update").trigger(
                                            "change.select2"
                                        );
                                    });
                                }
                            }
                        },
                    });
                });

            var old_tanggal_result = moment(
                response.result.date_activity,
                "YYYY-MM-DD"
            ).format("dddd, DD-MM-YYYY");
            $("#date_activity_update").val(old_tanggal_result);
            $("#lokasi_update")
                .val(response.result.lokasi_depo)
                .select2({
                    dropdownAutoWidth: true,
                    placeholder: "Silahkan Pilih",
                    allowClear: true,
                    dropdownParent: $("#modal-job-update"),
                });
            $("#pengirim_update")
                .val(response.result.pengirim)
                .select2({
                    dropdownAutoWidth: true,
                    placeholder: "Silahkan Pilih Pengirim",
                    allowClear: true,
                    dropdownParent: $("#modal-job-update"),
                });
            $("#penerima_update")
                .val(response.result.penerima)
                .select2({
                    dropdownAutoWidth: true,
                    placeholder: "Silahkan Pilih penerima",
                    allowClear: true,
                    dropdownParent: $("#modal-job-update"),
                });

            $("#new_id_update").val(response.result.id);
            $("#nomor_polisi_update")
                .html(supir)
                .select2({
                    dropdownAutoWidth: true,
                    placeholder: "Silahkan Pilih Supir",
                    allowClear: true,
                    dropdownParent: $("#modal-job-update"),
                });
            $("#driver_update")
                .val(response.result.driver)
                .select2({
                    dropdownAutoWidth: true,
                    placeholder: "Silahkan Pilih Vendor",
                    allowClear: true,
                    dropdownParent: $("#modal-job-update"),
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
                            $("#nomor_polisi_update")
                                .select2({
                                    dropdownAutoWidth: true,
                                    placeholder: "Silahkan Pilih Supir",
                                    allowClear: true,
                                    dropdownParent: $("#modal-job-update"),
                                })
                                .html(result);
                        },
                    });
                });
            $("#remark_update").val(response.result.remark);
            $("#biaya_stuffing_update").val(response.result.biaya_stuffing);
            $("#biaya_trucking_update").val(response.result.biaya_trucking);
            $("#biaya_thc_update").val(response.result.biaya_thc);
            $("#ongkos_supir_update").val(response.result.ongkos_supir);
            $("#biaya_seal_update").val(response.result.biaya_seal);
            $("#freight_update").val(response.result.freight);
            $("#lss_update").val(response.result.lss);
            $("#jenis_mobil_update").val(response.result.jenis_mobil);
            $("#dana_update")
                .val(response.result.dana)
                .select2({
                    dropdownAutoWidth: true,
                    placeholder: "Silahkan Pilih Deposit Trucking",
                    allowClear: true,
                    dropdownParent: $("#modal-job-update"),
                });

            $("#valid_job_update").validate({
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

                submitHandler: function (form) {
                    var new_id = document.getElementById("new_id_update").value;
                    var token = $("#csrf").val();

                    let date_activity = document.getElementById(
                        "date_activity_update"
                    ).value;
                    var tempDate;
                    var formattedDate;

                    tempDate = new Date(date_activity);
                    formattedDate = [
                        tempDate.getFullYear(),
                        tempDate.getMonth() + 1,
                        tempDate.getDate(),
                    ].join("-");

                    $.ajax({
                        url: "/detail-kontainer-edit/" + new_id,
                        type: "PUT",
                        data: {
                            _token: token,
                            job_id: $("#job_id").val(),
                            size: $("#size_update").val(),
                            type: $("#type_update").val(),
                            nomor_kontainer: $("#nomor_kontainer_update").val(),
                            cargo: $("#cargo_update").val(),
                            detail_barang: $("#detail_barang_update").val(),
                            seal: $("#seal_update").val(),
                            seal_old: seals,
                            spk_old: spk,
                            date_activity: formattedDate,
                            lokasi: $("#lokasi_update").val(),
                            penerima: $("#penerima_update").val(),
                            pengirim: $("#pengirim_update").val(),
                            driver: $("#driver_update").val(),
                            nomor_polisi: $("#nomor_polisi_update").val(),
                            remark: $("#remark_update").val(),
                            biaya_stuffing: $("#biaya_stuffing_update")
                                .val()
                                .replace(/\./g, ""),
                            biaya_trucking: $("#biaya_trucking_update")
                                .val()
                                .replace(/\./g, ""),
                            ongkos_supir: $("#ongkos_supir_update")
                                .val()
                                .replace(/\./g, ""),
                            biaya_thc: $("#biaya_thc_update")
                                .val()
                                .replace(/\./g, ""),
                            biaya_seal: $("#biaya_seal_update")
                                .val()
                                .replace(/\./g, ""),
                            freight: $("#freight_update")
                                .val()
                                .replace(/\./g, ""),
                            lss: $("#lss_update").val().replace(/\./g, ""),
                            jenis_mobil: $("#jenis_mobil_update").val(),
                            dana: $("#dana_update").val(),
                            spk: $("#spk_update").val(),
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


function delete_SI(r) {
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
        title: "Apakah anda yakin Ingin Menghapus Dokumen SI INI ?",
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
            };
            $.ajax({
                type: "DELETE",
                url: "/delete-si/" + deleteid,
                data: data,

                success: function (response) {
                    swal.fire({
                        title: "SI BERHASIL DIHAPUS",
                        icon: "success",
                        timer: 9e3,
                        showConfirmButton: false,
                    });
                    window.location.reload();
                },
            });
        } else {
            swal.fire({
                title: "SI TIDAK DIHAPUS",
                icon: "error",
                timer: 10e3,
                showConfirmButton: false,
            });
        }
    });
}

function countCheck() {
    // var search = "";

    // tabel_container.search(search).draw();
    // var count = $('input[name="letter"]:checked').length;

    var ids = []

    var rowcollection = tabel_container.$('input[name="letter"]:checked', { "page": "all" });
    rowcollection.each(function (index, elem) {
        ids.push($(elem).val());
    });
    document.getElementById("nomor").innerHTML = ids.length;
}
function countCheck1() {
    // var search = "";

    // tabel_container.search(search).draw();
    // var count = $('input[name="letter"]:checked').length;

    var ids = []

    var rowcollection = tabel_container.$('input[name="letter1"]:checked', { "page": "all" });
    rowcollection.each(function (index, elem) {
        ids.push($(elem).val());
    });
    document.getElementById("nomor1").innerHTML = ids.length;
}
function countCheck_delivery() {
    // var search = "";

    // tabel_container.search(search).draw();
    // var count = $('input[name="letter"]:checked').length;

    var ids = []

    var rowcollection = tabel_container.$('input[name="delivery"]:checked', { "page": "all" });
    rowcollection.each(function (index, elem) {
        ids.push($(elem).val());
    });
    document.getElementById("nomor_delivery").innerHTML = ids.length;
}

function ok_load(ini) {
    var swal = Swal.mixin({
        customClass: {
            confirmButton: "btn btn-label-success btn-wide mx-1",
            denyButton: "btn btn-label-secondary btn-wide mx-1",
            cancelButton: "btn btn-label-danger btn-wide mx-1",
        },
        buttonsStyling: false,
    });

    let token = $("#csrf").val();

    var check_job = []

    var rowcollection = tabel_container.$(".check_job:checked", { "page": "all" });
    rowcollection.each(function (index, elem) {
        check_job.push($(elem).val());
    });

    var data = {
        _token: token,
        check_job: check_job,
    };

    swal.fire({
        title: "Apakah anda yakin Ingin Delivery Container ini?",
        icon: "question",
        showCancelButton: true,
        confirmButtonText: "Iya",
        cancelButtonText: "Tidak",
    }).then((willCreate) => {
        if (willCreate.isConfirmed) {
            $.ajax({
                type: "POST",
                url: "/ok-load",
                data: data,
                success: function (response) {
                    swal.fire({
                        title: "Container Delivery OK",
                        icon: "success",
                        timer: 2e3,
                        showConfirmButton: false,
                    }).then((result) => {
                        window.location.reload();
                    });
                },
            });
        } else {
            swal.fire({
                title: "Container Belum Delivery",
                icon: "warning",
                timer: 2e3,
                showConfirmButton: false,
            });
        }
    });

}
function remove_ok_load(ini) {
    var swal = Swal.mixin({
        customClass: {
            confirmButton: "btn btn-label-success btn-wide mx-1",
            denyButton: "btn btn-label-secondary btn-wide mx-1",
            cancelButton: "btn btn-label-danger btn-wide mx-1",
        },
        buttonsStyling: false,
    });

    id = ini.value;

    let token = $("#csrf").val();


    var data = {
        _token: token,
        id: id,
    };

    swal.fire({
        title: "Apakah anda yakin Ingin Batalkan Job Container ini?",
        icon: "question",
        showCancelButton: true,
        confirmButtonText: "Iya",
        cancelButtonText: "Tidak",
    }).then((willCreate) => {
        if (willCreate.isConfirmed) {
            $.ajax({
                type: "PUT",
                url: "/remove-ok-load/" + id,
                data: data,
                success: function (response) {
                    swal.fire({
                        title: "Job Container dibatalkan",
                        icon: "success",
                        timer: 2e3,
                        showConfirmButton: false,
                    }).then((result) => {
                        window.location.reload();
                    });
                },
            });
        } else {
            swal.fire({
                title: "Job Kontainer Tidak Dibatalkan",
                icon: "warning",
                timer: 2e3,
                showConfirmButton: false,
            });
        }
    });

}
