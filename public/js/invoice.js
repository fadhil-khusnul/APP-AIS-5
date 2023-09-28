var tabel_si = $("#tabel_si").DataTable({
    responsive: true,
    paging: true,
    fixedHeader: {
        header: true,
    },
    pageLength: 5,
    lengthMenu: [
        [5, 10, 20, -1],
        [5, 10, 20, "All"],
    ],

    // scroller: true,P
});
var tabel_invoice = $("#tabel_invoice").DataTable({
    responsive: true,
    paging: true,
    fixedHeader: {
        header: true,
    },
    pageLength: 5,
    lengthMenu: [
        [5, 10, 20, -1],
        [5, 10, 20, "All"],
    ],

    // scroller: true,P
});
var tabel_bayar_invoice = $("#tabel_bayar_invoice").DataTable({
    responsive: true,
    paging: true,
    fixedHeader: {
        header: true,
    },
    pageLength: 5,
    lengthMenu: [
        [5, 10, 20, -1],
        [5, 10, 20, "All"],
    ],

    // scroller: true,P
});
var realisasiload_create = $("#realisasiload_create").DataTable({
    responsive: true,
    paging: true,
    fixedHeader: {
        header: true,
    },
    pageLength: 5,
    lengthMenu: [
        [5, 10, 20, -1],
        [5, 10, 20, "All"],
    ],

    // scroller: true,P
});
var table_alih_kapal_realisasi = $("#table_alih_kapal_realisasi").DataTable({
    responsive: true,
    paging: true,
    fixedHeader: {
        header: true,
    },
    pageLength: 5,
    lengthMenu: [
        [5, 10, 20, -1],
        [5, 10, 20, "All"],
    ],

    // scroller: true,P
});
var table_batal = $("#table_batal").DataTable({
    responsive: true,
    paging: true,
    fixedHeader: {
        header: true,
    },
    pageLength: 5,
    lengthMenu: [
        [5, 10, 20, -1],
        [5, 10, 20, "All"],
    ],

    // scroller: true,P
});

$("#submit-id").attr("disabled", "disabled");
realisasiload_create.$(".check-container", { page: "all" },).click(function () {
    if ($(this).is(":checked")) {
        $("#submit-id").removeAttr("disabled");
    } else {
        $("#submit-id").attr("disabled", "disabled");
    }
});


$("#submit_alih").attr("disabled", "disabled");
table_alih_kapal_realisasi.$(".check_alih", { page: "all" },).click(function () {
    if ($(this).is(":checked")) {
        $("#submit_alih").removeAttr("disabled");
    } else {
        $("#submit_alih").attr("disabled", "disabled");
    }
});
$("#submit_batal").attr("disabled", "disabled");
table_batal.$(".check_kontainer_batal", { page: "all" },).click(function () {
    if ($(this).is(":checked")) {
        $("#submit_batal").removeAttr("disabled");
    } else {
        $("#submit_batal").attr("disabled", "disabled");
    }
});


$("#add_total").attr("disabled", "disabled");
tabel_invoice.$(".check-container2", { page: "all" },).click(function () {
    if ($(this).is(":checked")) {
        $("#add_total").removeAttr("disabled");
    } else {
        $("#add_total").attr("disabled", "disabled");
    }
});

{{  }}
// var radiom = $("#materai")
$("#value_materai").attr("disabled", "disabled");

// Event listener to the two range filtering inputs to redraw on input
$("#min, #max").change(function () {
    var min = $("#min").val();
    var max = $("#max").val();

    console.log(min, max);
    tabel_invoice.draw();
});

$.fn.dataTable.ext.search.push(function (settings, data, dataIndex) {
    var min = $("#min").val();
    var max = $("#max").val();

    console.log("inii" + max, min);
    var createdAt = data[4] || 0; // Our date column in the table

    if (
        min == "" ||
        max == "" ||
        (moment(createdAt).isSameOrAfter(min) &&
            moment(createdAt).isSameOrBefore(max))
    ) {
        return true;
    }
    return false;
});

function input_invoice(e) {
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
        title: " Masukkkan Detail Invoice untuk kontainer ini?",
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
                    console.log(response);
                    $("#modal_invoice").modal("show");

                    $("#id_container").val(response.result.id);
                    $("#nomor_kontainer_modal").html(
                        response.result.nomor_kontainer
                    );
                    var total_biaya_kontainer =
                        parseFloat(response.result.biaya_stuffing) +
                        parseFloat(response.result.biaya_trucking) +
                        parseFloat(response.result.ongkos_supir) +
                        parseFloat(response.result.total_biaya_lain) +
                        parseFloat(response.result.biaya_thc) +
                        parseFloat(response.result.biaya_seal) +
                        parseFloat(response.result.freight) +
                        parseFloat(response.result.lss);
                    $("#total_biaya_kontainer").val(total_biaya_kontainer);

                    $("#valid_invoice").validate({
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
                                .getElementById("btnFinish1")
                                .setAttribute("disabled", true);

                            var csrf = $("#csrf").val();
                            var id_container = $("#id_container").val();
                            var price_invoice = $("#price_invoice")
                                .val()
                                .replace(/\./g, "");
                            var kondisi_invoice = $("#kondisi_invoice").val();
                            var keterangan_invoice = $(
                                "#keterangan_invoice"
                            ).val();

                            var data = {
                                _token: csrf,
                                id: id_container,
                                price_invoice: price_invoice,
                                kondisi_invoice: kondisi_invoice,
                                keterangan_invoice: keterangan_invoice,
                            };

                            $.ajax({
                                type: "POST",
                                url: "/masukkan-invoice-load",
                                data: data,

                                success: function (response) {
                                    // console.log(response);
                                    toast
                                        .fire({
                                            icon: "success",
                                            title: "Detail Invoice Dimasukkan",
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
                title: "Detail Invoice tidak dimasukkan",
                icon: "error",
                timer: 2e3,
            });
        }
    });
}
function input_invoice_si(e) {
    var slug = e.value;
    console.log(slug);
    var csrf = $("#csrf").val();
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

    var d = new Date(),
        dformat = [d.getFullYear(), d.getMonth() + 1, d.getDate()].join(
            "-"
        );

    old_slug = $("#old_slug").val();

    var data = {
        old_slug: old_slug,
        tahun: d.getFullYear(),
    }

    swal.fire({
        title: "Buatkan Invoice Untuk SI ini?",
        icon: "question",
        showCancelButton: true,
        confirmButtonText: "Iya",
        cancelButtonText: "Tidak",
    }).then((willCreate) => {
        if (willCreate.isConfirmed) {
            $.ajax({
                url: "/detail-si/" + slug,
                type: "GET",
                data: data,
                daprocessData: false,
                contentType: false,
                xhrFields: {
                    withCredentials: true
                },

                success: function (response) {
                    let new_id = slug;
                    // console.log(new_id);
                    console.log(response);

                    $("#modal_invoice_si").modal("show");
                    var tbody_modal = document.getElementById("tbody_modal_container");
                    tbody_modal.innerHTML = "";

                    if(response.kontainer[0].status_invoice == null) {
                        for (var i = 0; i < response.kontainer.length; i++) {
                            var tr1 = document.createElement("tr");
    
                            var td1 = document.createElement("td");
                            td1.innerHTML = (i + 1);
    
                            var td2 = document.createElement("td");
                            td2.innerHTML = response.kontainer[i].nomor_kontainer;
    
                            var td3 = document.createElement("td");
                            td3.innerHTML = response.kontainer[i].size + "/" + response.kontainer[i].type;
                            
                            var tdbiaya = document.createElement("td");
                            tdbiaya.setAttribute("align", "right");
                            tdbiaya.innerHTML = "Rp. "+ tandaPemisahTitik(response.total_kontainer[i]);
    
                            var td4 = document.createElement("td");
    
                            var div1 = document.createElement("div");
                            div1.setAttribute("class", "validation-container");
    
                            var div2 = document.createElement("div");
                            div2.setAttribute("class", "input-group input-group-sm");
    
                            var span1 = document.createElement("span");
                            span1.setAttribute("class", "input-group-text");
                            span1.innerHTML = "Rp.";
    
                            var input1 = document.createElement("input");
                            input1.setAttribute("data-bs-toggle", "tooltip");
                            input1.setAttribute("id", "price_invoice_si[" + (i + 1) + "]");
                            input1.setAttribute("name", "price_invoice_si[" + (i + 1) + "]");
                            input1.setAttribute("class", "form-control currency-rupiah" + (i + 1));
                            input1.setAttribute("placeholder", "Unit Price...");
                            input1.setAttribute("onblur", "blur_selisih_si(this)");
                            input1.setAttribute("autofocus", true);
                            input1.setAttribute("required", true);
    
                            div2.append(span1);
                            div2.append(input1);
                            div1.append(div2);
                            td4.append(div1);
    
                            var td5 = document.createElement("td");
    
                            var div3 = document.createElement("div");
                            div3.setAttribute("class", "validation-container");
    
                            var select1 = document.createElement("select");
                            select1.setAttribute("data-bs-toggle", "tooltip");
                            select1.setAttribute("id", "kondisi_invoice_si[" + (i + 1) + "]");
                            select1.setAttribute("name", "kondisi_invoice_si[" + (i + 1) + "]");
                            select1.setAttribute("class", "form-select");
                            select1.setAttribute("required", true);
    
                            var option1 = document.createElement("option");
                            option1.setAttribute("value", 0);
                            option1.setAttribute("selected", true);
                            option1.setAttribute("disabled", true);
                            option1.innerHTML = "Pilih Kondisi";
    
                            var option2 = document.createElement("option");
                            option2.setAttribute("value", "DP");
                            option2.innerHTML = "Door to Port";
    
                            var option3 = document.createElement("option");
                            option3.setAttribute("value", "DC");
                            option3.innerHTML = "Door to Cy";
    
                            var option4 = document.createElement("option");
                            option4.setAttribute("value", "DD");
                            option4.innerHTML = "Door to Door";
    
                            select1.append(option1);
                            select1.append(option2);
                            select1.append(option3);
                            select1.append(option4);
                            div3.append(select1);
                            td5.append(div3);
    
                            var td6 = document.createElement("td");
    
                            var div4 = document.createElement("div");
                            div4.setAttribute("class", "validation-container");
    
                            var textarea1 = document.createElement("textarea");
                            textarea1.setAttribute("data-bs-toggle", "tooltip");
                            textarea1.setAttribute("class", "form-control");
                            textarea1.setAttribute("id", "keterangan_invoice_si[" + (i + 1) + "]");
                            textarea1.setAttribute("name", "keterangan_invoice_si[" + (i + 1) + "]");
                            textarea1.setAttribute("required", true);
    
                            div4.append(textarea1);
                            td6.append(div4);
    
                            tr1.append(td1);
                            tr1.append(td2);
                            tr1.append(td3);
                            tr1.append(tdbiaya);
                            tr1.append(td4);
                            tr1.append(td5);
                            tr1.append(td6);
    
                            tbody_modal.appendChild(tr1);
    
                            $(".currency-rupiah" + (i + 1)).inputmask({
                                alias: "numeric",
                                prefix: '',
                                'groupSeparator': '.',
                                'autoGroup': true,
                                'digits': 0,
                                'digitsOptional': false,
                                placeholder: '0',
    
    
                            });
                        }
                        var total_biaya_kontainer_si = 0;
                        for(var j = 0; j < response.total_kontainer.length; j++) {
                            total_biaya_kontainer_si = total_biaya_kontainer_si + response.total_kontainer[j];
                        }
                        document.getElementById("total_price_invoice_si").value = "";
                        document.getElementById("selisih_price_si").value = "";
                    } else {
                        for (var i = 0; i < response.kontainer.length; i++) {
                            var tr1 = document.createElement("tr");
    
                            var td1 = document.createElement("td");
                            td1.innerHTML = (i + 1);
    
                            var td2 = document.createElement("td");
                            td2.innerHTML = response.kontainer[i].nomor_kontainer;
    
                            var td3 = document.createElement("td");
                            td3.innerHTML = response.kontainer[i].size + "/" + response.kontainer[i].type;
    
                            var tdbiaya = document.createElement("td");
                            tdbiaya.setAttribute("align", "right");
                            tdbiaya.innerHTML = "Rp. "+ tandaPemisahTitik(response.total_kontainer[i]);
    
                            var td4 = document.createElement("td");
    
                            var div1 = document.createElement("div");
                            div1.setAttribute("class", "validation-container");
    
                            var div2 = document.createElement("div");
                            div2.setAttribute("class", "input-group input-group-sm");
    
                            var span1 = document.createElement("span");
                            span1.setAttribute("class", "input-group-text");
                            span1.innerHTML = "Rp.";
    
                            var input1 = document.createElement("input");
                            input1.setAttribute("data-bs-toggle", "tooltip");
                            input1.setAttribute("id", "price_invoice_si[" + (i + 1) + "]");
                            input1.setAttribute("name", "price_invoice_si[" + (i + 1) + "]");
                            input1.setAttribute("class", "form-control currency-rupiah" + (i + 1));
                            input1.setAttribute("placeholder", "Unit Price...");
                            input1.setAttribute("value", response.kontainer[i].price_invoice);
                            input1.setAttribute("onblur", "blur_selisih_si(this)");
                            input1.setAttribute("autofocus", true);
                            input1.setAttribute("required", true);
    
                            div2.append(span1);
                            div2.append(input1);
                            div1.append(div2);
                            td4.append(div1);
    
                            var td5 = document.createElement("td");
    
                            var div3 = document.createElement("div");
                            div3.setAttribute("class", "validation-container");
    
                            var select1 = document.createElement("select");
                            select1.setAttribute("data-bs-toggle", "tooltip");
                            select1.setAttribute("id", "kondisi_invoice_si[" + (i + 1) + "]");
                            select1.setAttribute("name", "kondisi_invoice_si[" + (i + 1) + "]");
                            select1.setAttribute("class", "form-select");
                            select1.setAttribute("required", true);
    
                            var option1 = document.createElement("option");
                            option1.setAttribute("value", 0);
                            // option1.setAttribute("selected", true);
                            option1.setAttribute("disabled", true);
                            option1.innerHTML = "Pilih Kondisi";
                            
                            if(response.kontainer[i].kondisi_invoice == "DP") {
                                var option2 = document.createElement("option");
                                option2.setAttribute("value", "DP");
                                option2.setAttribute("selected", true);
                                option2.innerHTML = "Door to Port";

                                var option3 = document.createElement("option");
                                option3.setAttribute("value", "DC");
                                option3.innerHTML = "Door to Cy";
        
                                var option4 = document.createElement("option");
                                option4.setAttribute("value", "DD");
                                option4.innerHTML = "Door to Door";
                            } else if(response.kontainer[i].kondisi_invoice == "DC") {
                                var option2 = document.createElement("option");
                                option2.setAttribute("value", "DP");
                                option2.innerHTML = "Door to Port";
                                
                                var option3 = document.createElement("option");
                                option3.setAttribute("value", "DC");
                                option3.setAttribute("selected", true);
                                option3.innerHTML = "Door to Cy";
        
                                var option4 = document.createElement("option");
                                option4.setAttribute("value", "DD");
                                option4.innerHTML = "Door to Door";
                            } else {
                                var option2 = document.createElement("option");
                                option2.setAttribute("value", "DP");
                                option2.innerHTML = "Door to Port";
                                
                                var option3 = document.createElement("option");
                                option3.setAttribute("value", "DC");
                                option3.innerHTML = "Door to Cy";
                                
                                var option4 = document.createElement("option");
                                option4.setAttribute("value", "DD");
                                option4.setAttribute("selected", true);
                                option4.innerHTML = "Door to Door";
                            }
    
                            select1.append(option1);
                            select1.append(option2);
                            select1.append(option3);
                            select1.append(option4);
                            div3.append(select1);
                            td5.append(div3);
    
                            var td6 = document.createElement("td");
    
                            var div4 = document.createElement("div");
                            div4.setAttribute("class", "validation-container");
    
                            var textarea1 = document.createElement("textarea");
                            textarea1.setAttribute("data-bs-toggle", "tooltip");
                            textarea1.setAttribute("class", "form-control");
                            textarea1.setAttribute("id", "keterangan_invoice_si[" + (i + 1) + "]");
                            textarea1.setAttribute("name", "keterangan_invoice_si[" + (i + 1) + "]");
                            textarea1.setAttribute("required", true);
                            textarea1.innerHTML = response.kontainer[i].keterangan_invoice;
    
                            div4.append(textarea1);
                            td6.append(div4);
    
                            tr1.append(td1);
                            tr1.append(td2);
                            tr1.append(td3);
                            tr1.append(tdbiaya);
                            tr1.append(td4);
                            tr1.append(td5);
                            tr1.append(td6);
    
                            tbody_modal.appendChild(tr1);
    
                            $(".currency-rupiah" + (i + 1)).inputmask({
                                alias: "numeric",
                                prefix: '',
                                'groupSeparator': '.',
                                'autoGroup': true,
                                'digits': 0,
                                'digitsOptional': false,
                                placeholder: '0',    
                            });

                        }
                        var total_biaya_kontainer_si = 0;
                        for(var j = 0; j < response.total_kontainer.length; j++) {
                            total_biaya_kontainer_si = total_biaya_kontainer_si + response.total_kontainer[j];
                        }
                        document.getElementById("total_price_invoice_si").value = response.invoice[0].total;
                        var selisih = parseFloat(response.invoice[0].total) - parseFloat(total_biaya_kontainer_si);
                        document.getElementById("selisih_price_si").value = selisih.toString();
                        document.getElementById("yth_si").value = response.invoice[0].yth;
                        document.getElementById("km_si").value = response.invoice[0].km;
                    }

                    total_biaya_kontainer_si = total_biaya_kontainer_si.toString();
                    $("#total_biaya_kontainer_si").val(total_biaya_kontainer_si);
                    $("#new_slug").val(slug);



                    $("#valid_invoice_si").validate({
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
                            var slug_2 = $("#new_slug").val();
                            $.ajax({
                                url: "/detail-si/" + slug_2,
                                type: "GET",
                                data: data,
                                // daprocessData: false,
                                // contentType: false,
                                // async: false,
                                xhrFields: {
                                    withCredentials: true
                                },

                                success: function (response) {
                                    console.log(response);

                                    // console.log(slug_2);
                                    // console.log(response);
                                    document.getElementById(
                                        "loading-wrapper"
                                    ).style.cursor = "wait";
                                    document
                                        .getElementById("btnFinish1")
                                        .setAttribute("disabled", true);


                                    var csrf = $("#csrf").val();
                                    var new_slug = $("#new_slug").val();

                                    var price_invoice = [];
                                    var kondisi_invoice = [];
                                    var keterangan_invoice = [];

                                    for (let i = 0; i < response.kontainer.length; i++) {
                                        price_invoice[i] = document.getElementById("price_invoice_si[" + (i + 1) + "]").value.replace(/\./g, "");
                                        kondisi_invoice[i] = document.getElementById("kondisi_invoice_si[" + (i + 1) + "]").value;
                                        keterangan_invoice[i] = document.getElementById("keterangan_invoice_si[" + (i + 1) + "]").value;
                                    }
                                    // console.log(price_invoice);

                                    yth = $("#yth_si").val();
                                    km = $("#km_si").val();
                                    ppn = $("#ppn_si:checked").val();
                                    materai = $("#materai_si:checked").val();
                                    value_materai = $("#value_materai_si").val().replace(/\./g, "");

                                    var d = new Date(),
                                        dformat = [d.getFullYear(), d.getMonth() + 1, d.getDate()].join(
                                            "-"
                                        );

                                    var invais = "INVAIS";
                                    var nomor_invoice =
                                        invais +
                                        d.getFullYear() +
                                        "/" +
                                        romawi(d.getMonth() + 1) +
                                        "/" +
                                        response.pol +
                                        "-" +
                                        response.pod +
                                        "-" +
                                        response.vessel_code +
                                        "/" +
                                        String(
                                            response.jumlah
                                        ).padStart(5, "0");

                                    console.log(nomor_invoice);
                                    var tahun = d.getFullYear();
                                    var tanggal = dformat;
                                    // $("#status").val(response.kontainer[0].status);
                                    var status2 = response.modals.status_si;

                                    var data = {
                                        _token: csrf,
                                        price_invoice: price_invoice,
                                        kondisi_invoice: kondisi_invoice,
                                        keterangan_invoice: keterangan_invoice,
                                        yth: yth,
                                        km: km,
                                        ppn: ppn,
                                        materai: materai,
                                        value_materai: value_materai,
                                        nomor_invoice: nomor_invoice,
                                        tahun: tahun,
                                        tanggal: tanggal,
                                        old_slug: old_slug,
                                        status: status2,
                                    };

                                    $.ajax({
                                        type: "POST",
                                        url: "/masukkan-invoice-load/" + new_slug,
                                        data: data,
                                        // async: false,
                                        xhrFields: {
                                            responseType: "blob",
                                        },

                                        success: function (response) {
                                            console.log(response);


                                            toast.fire({
                                                icon: "success",
                                                title: "Invoice Berhasil Dibuat",
                                            });
                                            var blob = new Blob([
                                                response,
                                            ]);
                                            var link =
                                                document.createElement(
                                                    "a"
                                                );
                                            link.href =
                                                window.URL.createObjectURL(
                                                    blob
                                                );
                                            link.download =
                                                "" +
                                                old_slug +
                                                dformat +
                                                ".pdf";
                                            link.click();

                                            setTimeout(function () {
                                                window.location.reload();
                                            }, 10);

                                        },
                                    });
                                },
                            })





                        },
                    });
                },
            });
        } else {
            toast.fire({
                title: "Detail Invoice tidak dimasukkan",
                icon: "error",
                timer: 2e3,
            });
        }
    });
}
function input_invoice_si_alih(e) {
    var slug = e.value;
    console.log(slug);
    var csrf = $("#csrf").val();
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

    var d = new Date(),
        dformat = [d.getFullYear(), d.getMonth() + 1, d.getDate()].join(
            "-"
        );

    old_slug = $("#old_slug").val();

    var data = {
        old_slug: old_slug,
        tahun: d.getFullYear(),
    }

    swal.fire({
        title: "Buatkan Invoice Untuk SI ini?",
        icon: "question",
        showCancelButton: true,
        confirmButtonText: "Iya",
        cancelButtonText: "Tidak",
    }).then((willCreate) => {
        if (willCreate.isConfirmed) {
            $.ajax({
                url: "/detail-si/" + slug,
                type: "GET",
                data: data,
                // daprocessData: false,
                // contentType: false,
                xhrFields: {
                    withCredentials: true
                },

                success: function (response) {
                    let new_id = slug;
                    // console.log(new_id);
                    console.log(response);

                    $("#modal_invoice_si").modal("show");
                    var tbody_modal = document.getElementById("tbody_modal_container");
                    tbody_modal.innerHTML = "";

                    var biaya_alih_kapal = 0;
                    for(var i = 0; i < response.biaya_alih_kapal.length; i++) {
                        biaya_alih_kapal = biaya_alih_kapal + response.biaya_alih_kapal[i];
                    }

                    if(response.kontainer[0].status_invoice == null) {
                        for (var i = 0; i < response.kontainer.length; i++) {
                            var tr1 = document.createElement("tr");
    
                            var td1 = document.createElement("td");
                            td1.innerHTML = (i + 1);
    
                            var td2 = document.createElement("td");
                            td2.innerHTML = response.kontainer[i].nomor_kontainer;
    
                            var td3 = document.createElement("td");
                            td3.innerHTML = response.kontainer[i].size + "/" + response.kontainer[i].type;
                            
                            var tdbiaya = document.createElement("td");
                            tdbiaya.setAttribute("align", "right");
                            tdbiaya.innerHTML = "Rp. "+ tandaPemisahTitik((response.total_kontainer[i] + response.biaya_alih_kapal[i]));
    
                            var td4 = document.createElement("td");
    
                            var div1 = document.createElement("div");
                            div1.setAttribute("class", "validation-container");
    
                            var div2 = document.createElement("div");
                            div2.setAttribute("class", "input-group input-group-sm");
    
                            var span1 = document.createElement("span");
                            span1.setAttribute("class", "input-group-text");
                            span1.innerHTML = "Rp.";
    
                            var input1 = document.createElement("input");
                            input1.setAttribute("data-bs-toggle", "tooltip");
                            input1.setAttribute("id", "price_invoice_si[" + (i + 1) + "]");
                            input1.setAttribute("name", "price_invoice_si[" + (i + 1) + "]");
                            input1.setAttribute("class", "form-control currency-rupiah" + (i + 1));
                            input1.setAttribute("placeholder", "Unit Price...");
                            input1.setAttribute("onblur", "blur_selisih_si(this)");
                            input1.setAttribute("autofocus", true);
                            input1.setAttribute("required", true);
    
                            div2.append(span1);
                            div2.append(input1);
                            div1.append(div2);
                            td4.append(div1);
    
                            var td5 = document.createElement("td");
    
                            var div3 = document.createElement("div");
                            div3.setAttribute("class", "validation-container");
    
                            var select1 = document.createElement("select");
                            select1.setAttribute("data-bs-toggle", "tooltip");
                            select1.setAttribute("id", "kondisi_invoice_si[" + (i + 1) + "]");
                            select1.setAttribute("name", "kondisi_invoice_si[" + (i + 1) + "]");
                            select1.setAttribute("class", "form-select");
                            select1.setAttribute("required", true);
    
                            var option1 = document.createElement("option");
                            option1.setAttribute("value", 0);
                            option1.setAttribute("selected", true);
                            option1.setAttribute("disabled", true);
                            option1.innerHTML = "Pilih Kondisi";
    
                            var option2 = document.createElement("option");
                            option2.setAttribute("value", "DP");
                            option2.innerHTML = "Door to Port";
    
                            var option3 = document.createElement("option");
                            option3.setAttribute("value", "DC");
                            option3.innerHTML = "Door to Cy";
    
                            var option4 = document.createElement("option");
                            option4.setAttribute("value", "DD");
                            option4.innerHTML = "Door to Door";
    
                            select1.append(option1);
                            select1.append(option2);
                            select1.append(option3);
                            select1.append(option4);
                            div3.append(select1);
                            td5.append(div3);
    
                            var td6 = document.createElement("td");
    
                            var div4 = document.createElement("div");
                            div4.setAttribute("class", "validation-container");
    
                            var textarea1 = document.createElement("textarea");
                            textarea1.setAttribute("data-bs-toggle", "tooltip");
                            textarea1.setAttribute("class", "form-control");
                            textarea1.setAttribute("id", "keterangan_invoice_si[" + (i + 1) + "]");
                            textarea1.setAttribute("name", "keterangan_invoice_si[" + (i + 1) + "]");
                            textarea1.setAttribute("required", true);
    
                            div4.append(textarea1);
                            td6.append(div4);
    
                            tr1.append(td1);
                            tr1.append(td2);
                            tr1.append(td3);
                            tr1.append(tdbiaya);
                            tr1.append(td4);
                            tr1.append(td5);
                            tr1.append(td6);
    
                            tbody_modal.appendChild(tr1);
    
                            $(".currency-rupiah" + (i + 1)).inputmask({
                                alias: "numeric",
                                prefix: '',
                                'groupSeparator': '.',
                                'autoGroup': true,
                                'digits': 0,
                                'digitsOptional': false,
                                placeholder: '0',
    
    
                            });
                        }
                        var total_biaya_kontainer_si = 0;
                        for(var j = 0; j < response.total_kontainer.length; j++) {
                            total_biaya_kontainer_si = total_biaya_kontainer_si + response.total_kontainer[j];
                        }
                        document.getElementById("total_price_invoice_si").value = "";
                        document.getElementById("selisih_price_si").value = "";
                    } else {
                        for (var i = 0; i < response.kontainer.length; i++) {
                            var tr1 = document.createElement("tr");
    
                            var td1 = document.createElement("td");
                            td1.innerHTML = (i + 1);
    
                            var td2 = document.createElement("td");
                            td2.innerHTML = response.kontainer[i].nomor_kontainer;
    
                            var td3 = document.createElement("td");
                            td3.innerHTML = response.kontainer[i].size + "/" + response.kontainer[i].type;
    
                            var tdbiaya = document.createElement("td");
                            tdbiaya.setAttribute("align", "right");
                            tdbiaya.innerHTML = "Rp. "+ tandaPemisahTitik((response.total_kontainer[i] + response.biaya_alih_kapal[i]));
    
                            var td4 = document.createElement("td");
    
                            var div1 = document.createElement("div");
                            div1.setAttribute("class", "validation-container");
    
                            var div2 = document.createElement("div");
                            div2.setAttribute("class", "input-group input-group-sm");
    
                            var span1 = document.createElement("span");
                            span1.setAttribute("class", "input-group-text");
                            span1.innerHTML = "Rp.";
    
                            var input1 = document.createElement("input");
                            input1.setAttribute("data-bs-toggle", "tooltip");
                            input1.setAttribute("id", "price_invoice_si[" + (i + 1) + "]");
                            input1.setAttribute("name", "price_invoice_si[" + (i + 1) + "]");
                            input1.setAttribute("class", "form-control currency-rupiah" + (i + 1));
                            input1.setAttribute("placeholder", "Unit Price...");
                            input1.setAttribute("value", response.kontainer[i].price_invoice);
                            input1.setAttribute("onblur", "blur_selisih_si(this)");
                            input1.setAttribute("autofocus", true);
                            input1.setAttribute("required", true);
    
                            div2.append(span1);
                            div2.append(input1);
                            div1.append(div2);
                            td4.append(div1);
    
                            var td5 = document.createElement("td");
    
                            var div3 = document.createElement("div");
                            div3.setAttribute("class", "validation-container");
    
                            var select1 = document.createElement("select");
                            select1.setAttribute("data-bs-toggle", "tooltip");
                            select1.setAttribute("id", "kondisi_invoice_si[" + (i + 1) + "]");
                            select1.setAttribute("name", "kondisi_invoice_si[" + (i + 1) + "]");
                            select1.setAttribute("class", "form-select");
                            select1.setAttribute("required", true);
    
                            var option1 = document.createElement("option");
                            option1.setAttribute("value", 0);
                            // option1.setAttribute("selected", true);
                            option1.setAttribute("disabled", true);
                            option1.innerHTML = "Pilih Kondisi";
                            
                            if(response.kontainer[i].kondisi_invoice == "DP") {
                                var option2 = document.createElement("option");
                                option2.setAttribute("value", "DP");
                                option2.setAttribute("selected", true);
                                option2.innerHTML = "Door to Port";

                                var option3 = document.createElement("option");
                                option3.setAttribute("value", "DC");
                                option3.innerHTML = "Door to Cy";
        
                                var option4 = document.createElement("option");
                                option4.setAttribute("value", "DD");
                                option4.innerHTML = "Door to Door";
                            } else if(response.kontainer[i].kondisi_invoice == "DC") {
                                var option2 = document.createElement("option");
                                option2.setAttribute("value", "DP");
                                option2.innerHTML = "Door to Port";
                                
                                var option3 = document.createElement("option");
                                option3.setAttribute("value", "DC");
                                option3.setAttribute("selected", true);
                                option3.innerHTML = "Door to Cy";
        
                                var option4 = document.createElement("option");
                                option4.setAttribute("value", "DD");
                                option4.innerHTML = "Door to Door";
                            } else {
                                var option2 = document.createElement("option");
                                option2.setAttribute("value", "DP");
                                option2.innerHTML = "Door to Port";
                                
                                var option3 = document.createElement("option");
                                option3.setAttribute("value", "DC");
                                option3.innerHTML = "Door to Cy";
                                
                                var option4 = document.createElement("option");
                                option4.setAttribute("value", "DD");
                                option4.setAttribute("selected", true);
                                option4.innerHTML = "Door to Door";
                            }
    
                            select1.append(option1);
                            select1.append(option2);
                            select1.append(option3);
                            select1.append(option4);
                            div3.append(select1);
                            td5.append(div3);
    
                            var td6 = document.createElement("td");
    
                            var div4 = document.createElement("div");
                            div4.setAttribute("class", "validation-container");
    
                            var textarea1 = document.createElement("textarea");
                            textarea1.setAttribute("data-bs-toggle", "tooltip");
                            textarea1.setAttribute("class", "form-control");
                            textarea1.setAttribute("id", "keterangan_invoice_si[" + (i + 1) + "]");
                            textarea1.setAttribute("name", "keterangan_invoice_si[" + (i + 1) + "]");
                            textarea1.setAttribute("required", true);
                            textarea1.innerHTML = response.kontainer[i].keterangan_invoice;
    
                            div4.append(textarea1);
                            td6.append(div4);
    
                            tr1.append(td1);
                            tr1.append(td2);
                            tr1.append(td3);
                            tr1.append(tdbiaya);
                            tr1.append(td4);
                            tr1.append(td5);
                            tr1.append(td6);
    
                            tbody_modal.appendChild(tr1);
    
                            $(".currency-rupiah" + (i + 1)).inputmask({
                                alias: "numeric",
                                prefix: '',
                                'groupSeparator': '.',
                                'autoGroup': true,
                                'digits': 0,
                                'digitsOptional': false,
                                placeholder: '0',    
                            });

                        }
                        var total_biaya_kontainer_si = 0;
                        for(var j = 0; j < response.total_kontainer.length; j++) {
                            total_biaya_kontainer_si = total_biaya_kontainer_si + response.total_kontainer[j];
                        }
                        // total_biaya_kontainer_si = total_biaya_kontainer_si;
                        document.getElementById("total_price_invoice_si").value = response.invoice[0].total;
                        var selisih = parseFloat(response.invoice[0].total) - parseFloat(total_biaya_kontainer_si) - parseFloat(biaya_alih_kapal);
                        document.getElementById("selisih_price_si").value = selisih.toString();
                        document.getElementById("yth_si").value = response.invoice[0].yth;
                        document.getElementById("km_si").value = response.invoice[0].km;
                    }

                    var total_biaya = parseFloat(total_biaya_kontainer_si) + parseFloat(biaya_alih_kapal);
                    total_biaya = total_biaya.toString();
                    $("#total_biaya_kontainer_si").val(total_biaya);
                    $("#new_slug").val(slug);



                    $("#valid_invoice_si").validate({
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
                            var slug_2 = $("#new_slug").val();
                            $.ajax({
                                url: "/detail-si/" + slug_2,
                                type: "GET",
                                data: data,
                                daprocessData: false,
                                contentType: false,
                                async: false,
                                xhrFields: {
                                    withCredentials: true
                                },

                                success: function (response) {
                                    console.log(response);

                                    console.log(slug_2);
                                    console.log(response);
                                    document.getElementById(
                                        "loading-wrapper"
                                    ).style.cursor = "wait";
                                    document
                                        .getElementById("btnFinish1")
                                        .setAttribute("disabled", true);


                                    var csrf = $("#csrf").val();
                                    var new_slug = $("#new_slug").val();

                                    var price_invoice = [];
                                    var kondisi_invoice = [];
                                    var keterangan_invoice = [];

                                    for (let i = 0; i < response.kontainer.length; i++) {
                                        price_invoice[i] = document.getElementById("price_invoice_si[" + (i + 1) + "]").value.replace(/\./g, "");
                                        kondisi_invoice[i] = document.getElementById("kondisi_invoice_si[" + (i + 1) + "]").value;
                                        keterangan_invoice[i] = document.getElementById("keterangan_invoice_si[" + (i + 1) + "]").value;
                                    }
                                    // console.log(price_invoice);

                                    yth = $("#yth_si").val();
                                    km = $("#km_si").val();
                                    status2 = "Alih-Kapal";
                                    ppn = $("#ppn_si:checked").val();
                                    materai = $("#materai_si:checked").val();
                                    value_materai = $("#value_materai_si").val().replace(/\./g, "");

                                    var d = new Date(),
                                        dformat = [d.getFullYear(), d.getMonth() + 1, d.getDate()].join(
                                            "-"
                                        );

                                    var invais = "INVAIS";
                                    var nomor_invoice =
                                        invais +
                                        d.getFullYear() +
                                        "/" +
                                        romawi(d.getMonth() + 1) +
                                        "/" +
                                        response.pol +
                                        "-" +
                                        response.pod_alih +
                                        "-" +
                                        response.vessel_alih +
                                        "/" +
                                        String(
                                            response.jumlah
                                        ).padStart(5, "0");

                                    console.log(nomor_invoice);
                                    var tahun = d.getFullYear();
                                    var tanggal = dformat;
                                    var status2 = response.modals.status_si
                                    // var status2 = "Alih-Kapal";

                                    var data = {
                                        _token: csrf,
                                        price_invoice: price_invoice,
                                        kondisi_invoice: kondisi_invoice,
                                        keterangan_invoice: keterangan_invoice,
                                        yth: yth,
                                        km: km,
                                        ppn: ppn,
                                        materai: materai,
                                        value_materai: value_materai,
                                        nomor_invoice: nomor_invoice,
                                        tahun: tahun,
                                        tanggal: tanggal,
                                        old_slug: old_slug,
                                        status: status2,
                                    };

                                    $.ajax({
                                        type: "POST",
                                        url: "/masukkan-invoice-load/" + new_slug,
                                        data: data,
                                        // async: false,
                                        xhrFields: {
                                            responseType: "blob",
                                        },

                                        success: function (response) {
                                            console.log(response);


                                            toast.fire({
                                                icon: "success",
                                                title: "Invoice Berhasil Dibuat",
                                            });
                                            var blob = new Blob([
                                                response,
                                            ]);
                                            var link =
                                                document.createElement(
                                                    "a"
                                                );
                                            link.href =
                                                window.URL.createObjectURL(
                                                    blob
                                                );
                                            link.download =
                                                "" +
                                                old_slug +
                                                dformat +
                                                ".pdf";
                                            link.click();

                                            setTimeout(function () {
                                                window.location.reload();
                                            }, 10);

                                        },
                                    });
                                },
                            })





                        },
                    });
                },
            });
        } else {
            toast.fire({
                title: "Detail Invoice tidak dimasukkan",
                icon: "error",
                timer: 2e3,
            });
        }
    });
}
function update_invoice(e) {
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
            let new_id = id;
            console.log(new_id);
            $("#modal_invoice_edit").modal("show");

            $("#id_container_edit").val(response.result.id);
            $("#price_invoice_edit").val(response.result.price_invoice);
            $("#kondisi_invoice_edit").val(response.result.kondisi_invoice);
            $("#nomor_kontainer_edit").html(
                response.result.nomor_kontainer
            );

            var total_biaya_kontainer =
                parseFloat(response.result.biaya_stuffing) +
                parseFloat(response.result.biaya_trucking) +
                parseFloat(response.result.ongkos_supir) +
                parseFloat(response.result.total_biaya_lain) +
                parseFloat(response.result.biaya_thc) +
                parseFloat(response.result.biaya_seal) +
                parseFloat(response.result.freight) +
                parseFloat(response.result.lss);
            $("#total_biaya_kontainer_edit").val(total_biaya_kontainer);


            $("#keterangan_invoice_edit").val(
                response.result.keterangan_invoice
            );

            $("#valid_invoice_edit").validate({
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
                    var id_container = $("#id_container_edit").val();
                    var price_invoice = $("#price_invoice_edit")
                        .val()
                        .replace(/\./g, "");
                    var kondisi_invoice = $("#kondisi_invoice_edit").val();
                    var keterangan_invoice = $(
                        "#keterangan_invoice_edit"
                    ).val();

                    var data = {
                        _token: csrf,
                        id: id_container,
                        price_invoice: price_invoice,
                        kondisi_invoice: kondisi_invoice,
                        keterangan_invoice: keterangan_invoice,
                    };

                    $.ajax({
                        type: "POST",
                        url: "/masukkan-invoice-load",
                        data: data,

                        success: function (response) {
                            // console.log(response);
                            toast
                                .fire({
                                    icon: "success",
                                    title: "Detail Invoice Diupdate",
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
}

function pdf_invoice() {
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
            if (element.attr("name") == "letter") {
                error.appendTo("#checkboxerror");
            } else {
                error.insertAfter(element);
            }
        },
        submitHandler: function (form) {
            let token = $("#csrf").val();
            var check_container = realisasiload_create.$(".check-container:checked", { "page": "all" })
                .map(function () {
                    return this.value;
                })
                .get();
            console.log(check_container);

            var old_slug = $("#old_slug").val();

            var d = new Date(),
                dformat = [d.getFullYear(), d.getMonth() + 1, d.getDate()].join(
                    "-"
                );

            console.log(check_container);

            $.ajax({
                url: "/getPod",
                type: "post",
                data: {
                    _token: token,
                    pod: check_container,
                },
                success: function (response) {
                    console.log(response.pod);
                    var pod_1 = [...new Set(response.pod)];
                    var nomor_invoice = [...new Set(response.nomor_invoice)];
                    if (pod_1.length == 1 && nomor_invoice.length == 1) {
                        var pod = response.pod;
                        console.log(pod);
                        swal.fire({
                            title: " Buat Invoice Untuk Container ini?",
                            text: "Silahkan Periksa Semua Data yang ada Sebelum invoice.",
                            icon: "question",
                            showCancelButton: true,
                            confirmButtonText: "Iya",
                            cancelButtonText: "Tidak",
                        }).then((willCreate) => {
                            if (willCreate.isConfirmed) {
                                $("#modal_pdf_invoice").modal("show");

                                $("#valid_pdf_invoice").validate({
                                    rules: {
                                        yth: {
                                            required: true,
                                        },
                                        km: {
                                            required: true,
                                        },
                                    },
                                    messages: {
                                        yth: {
                                            required: "Silakan Isi Tujuan",
                                        },
                                        km: {
                                            required: "Silakan Isi KM",
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
                                        document.getElementById("loading-wrapper").style.cursor = "wait";
                                        document.getElementById("btnFinish3").setAttribute("disabled", true);
                                        console.log(pod);
                                        $.ajax({
                                            url: "/getInvoice",
                                            type: "post",
                                            data: {
                                                _token: token,
                                                old_slug: old_slug,
                                                pod: pod,
                                                tahun: d.getFullYear(),
                                            },
                                            success: function (response) {
                                                console.log(response);

                                                var yth = $("#yth").val();
                                                var km = $("#km").val();
                                                var status1 = "Realisasi";              

                                                var invais = "INVAIS";
                                                var nomor_invoice =
                                                    invais +
                                                    d.getFullYear() +
                                                    "/" +
                                                    romawi(d.getMonth() + 1) +
                                                    "/" +
                                                    response.pol +
                                                    "-" +
                                                    response.pod +
                                                    "-" +
                                                    response.vessel_code +
                                                    "/" +
                                                    String(
                                                        response.jumlah
                                                    ).padStart(5, "0");
                                                var tahun = d.getFullYear();
                                                var tanggal = dformat;

                                                var data = {
                                                    _token: token,
                                                    check_container:
                                                        check_container,
                                                    old_slug: old_slug,
                                                    nomor_invoice:
                                                        nomor_invoice,
                                                    tahun: tahun,
                                                    tanggal: tanggal,
                                                    ppn: $(
                                                        "#ppn:checked"
                                                    ).val(),
                                                    materai:
                                                        $(
                                                            "#materai:checked"
                                                        ).val(),
                                                    value_materai: $(
                                                        "#value_materai"
                                                    )
                                                        .val()
                                                        .replace(/\./g, ""),
                                                    yth: yth,
                                                    km: km,
                                                    status: status1,
                                                };

                                                $.ajax({
                                                    type: "POST",
                                                    url: "/create-pdf-invoice-load",
                                                    data: data,
                                                    xhrFields: {
                                                        responseType: "blob",
                                                    },
                                                    success: function (
                                                        response
                                                    ) {
                                                        // console.log(response);
                                                        toast.fire({
                                                            icon: "success",
                                                            title: "Invoice Berhasil Dibuat",
                                                        });
                                                        var blob = new Blob([
                                                            response,
                                                        ]);
                                                        var link =
                                                            document.createElement(
                                                                "a"
                                                            );
                                                        link.href =
                                                            window.URL.createObjectURL(
                                                                blob
                                                            );
                                                        link.download =
                                                            "" +
                                                            old_slug +
                                                            dformat +
                                                            ".pdf";
                                                        link.click();

                                                        setTimeout(function () {
                                                            window.location.reload();
                                                        }, 10);
                                                    },
                                                });
                                            },
                                        });
                                    },
                                });
                            } else {
                                swal.fire({
                                    titlxe: "Invoice Tidak Dibuat",
                                    icon: "error",
                                    timer: 2e3,
                                    showConfirmButton: false,
                                });
                            }
                        });
                    } else {
                        swal.fire({
                            title: "POD atau Nomor Invoice Harus Sama",
                            text: "SIlakan Pilih Container yang POD-nya Sama",
                            icon: "error",
                            timer: 2e3,
                            showConfirmButton: false,
                        });
                    }
                },
            });
        },
    });
}
function pdf_invoice_batal() {
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
            if (element.attr("name") == "letter") {
                error.appendTo("#checkboxerror");
            } else {
                error.insertAfter(element);
            }
        },
        submitHandler: function (form) {
            let token = $("#csrf").val();
            var check_container = table_batal.$(".check_kontainer_batal:checked", { "page": "all" })
                .map(function () {
                    return this.value;
                })
                .get();
            console.log(check_container);

            var old_slug = $("#old_slug").val();

            var d = new Date(),
                dformat = [d.getFullYear(), d.getMonth() + 1, d.getDate()].join(
                    "-"
                );

            console.log(check_container);

            $.ajax({
                url: "/getPod",
                type: "post",
                data: {
                    _token: token,
                    pod: check_container,
                },
                success: function (response) {
                    console.log(response.pod);
                    var pod_1 = [...new Set(response.pod)];
                    var nomor_invoice = [...new Set(response.nomor_invoice)];
                    if (pod_1.length == 1 && nomor_invoice.length == 1) {
                        var pod = response.pod;
                        console.log(pod);
                        swal.fire({
                            title: " Buat Invoice Untuk Container ini?",
                            text: "Silahkan Periksa Semua Data yang ada Sebelum invoice.",
                            icon: "question",
                            showCancelButton: true,
                            confirmButtonText: "Iya",
                            cancelButtonText: "Tidak",
                        }).then((willCreate) => {
                            if (willCreate.isConfirmed) {
                                $("#modal_pdf_invoice").modal("show");

                                $("#valid_pdf_invoice").validate({
                                    rules: {
                                        yth: {
                                            required: true,
                                        },
                                        km: {
                                            required: true,
                                        },
                                    },
                                    messages: {
                                        yth: {
                                            required: "Silakan Isi Tujuan",
                                        },
                                        km: {
                                            required: "Silakan Isi KM",
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
                                        document.getElementById("loading-wrapper").style.cursor = "wait";
                                        document.getElementById("btnFinish3").setAttribute("disabled", true);
                                        console.log(pod);
                                        $.ajax({
                                            url: "/getInvoice",
                                            type: "post",
                                            data: {
                                                _token: token,
                                                old_slug: old_slug,
                                                pod: pod,
                                                tahun: d.getFullYear(),
                                            },
                                            success: function (response) {
                                                console.log(response);

                                                var yth = $("#yth").val();
                                                var km = $("#km").val();

                                                var invais = "INVAIS";
                                                var nomor_invoice =
                                                    invais +
                                                    d.getFullYear() +
                                                    "/" +
                                                    romawi(d.getMonth() + 1) +
                                                    "/" +
                                                    response.pol +
                                                    "-" +
                                                    response.pod +
                                                    "-" +
                                                    response.vessel_code +
                                                    "/" +
                                                    String(
                                                        response.jumlah
                                                    ).padStart(5, "0");
                                                var tahun = d.getFullYear();
                                                var tanggal = dformat;

                                                var data = {
                                                    _token: token,
                                                    check_container:
                                                        check_container,
                                                    old_slug: old_slug,
                                                    nomor_invoice:
                                                        nomor_invoice,
                                                    tahun: tahun,
                                                    tanggal: tanggal,
                                                    ppn: $(
                                                        "#ppn:checked"
                                                    ).val(),
                                                    materai:
                                                        $(
                                                            "#materai:checked"
                                                        ).val(),
                                                    value_materai: $(
                                                        "#value_materai"
                                                    )
                                                        .val()
                                                        .replace(/\./g, ""),
                                                    yth: yth,
                                                    km: km,
                                                    status: "Batal-Muat",
                                                };

                                                $.ajax({
                                                    type: "POST",
                                                    url: "/create-pdf-invoice-load",
                                                    data: data,
                                                    xhrFields: {
                                                        responseType: "blob",
                                                    },
                                                    success: function (
                                                        response
                                                    ) {
                                                        // console.log(response);
                                                        toast.fire({
                                                            icon: "success",
                                                            title: "Invoice Berhasil Dibuat",
                                                        });
                                                        var blob = new Blob([
                                                            response,
                                                        ]);
                                                        var link =
                                                            document.createElement(
                                                                "a"
                                                            );
                                                        link.href =
                                                            window.URL.createObjectURL(
                                                                blob
                                                            );
                                                        link.download =
                                                            "" +
                                                            old_slug +
                                                            dformat +
                                                            ".pdf";
                                                        link.click();

                                                        setTimeout(function () {
                                                            window.location.reload();
                                                        }, 10);
                                                    },
                                                });
                                            },
                                        });
                                    },
                                });
                            } else {
                                swal.fire({
                                    titlxe: "Invoice Tidak Dibuat",
                                    icon: "error",
                                    timer: 2e3,
                                    showConfirmButton: false,
                                });
                            }
                        });
                    } else {
                        swal.fire({
                            title: "POD atau Nomor Invoice Harus Sama",
                            text: "SIlakan Pilih Container yang POD-nya Sama",
                            icon: "error",
                            timer: 2e3,
                            showConfirmButton: false,
                        });
                    }
                },
            });
        },
    });
}


function romawi(nomor) {
    var desimal = [1000, 900, 500, 400, 100, 90, 50, 40, 10, 9, 5, 4, 1];
    var romawi = [
        "M",
        "CM",
        "D",
        "CD",
        "C",
        "XC",
        "L",
        "XL",
        "X",
        "IX",
        "V",
        "IV",
        "I",
    ];

    var hasil = "";

    for (var index = 0; index < desimal.length; index++) {
        while (desimal[index] <= nomor) {
            hasil += romawi[index];
            nomor -= desimal[index];
        }
    }
    return hasil;
}

function delete_invoice(r) {
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
        title: "Apakah anda yakin Ingin Menghapus Dokumen INVOICE INI ?",
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
                url: "/delete-invoice/" + deleteid,
                data: data,

                success: function (response) {
                    swal.fire({
                        title: "INVOICE BERHASIL DIHAPUS",
                        icon: "success",
                        timer: 9e3,
                        showConfirmButton: false,
                    });
                    window.location.reload();
                },
            });
        } else {
            swal.fire({
                title: "INVOICE TIDAK DIHAPUS",
                icon: "error",
                timer: 10e3,
                showConfirmButton: false,
            });
        }
    });
}

function delete_history(r) {
    var slug = r.value;

    var swal = Swal.mixin({
        customClass: {
            confirmButton: "btn btn-label-success btn-wide mx-1",
            denyButton: "btn btn-label-secondary btn-wide mx-1",
            cancelButton: "btn btn-label-danger btn-wide mx-1",
        },
        buttonsStyling: false,
    });

    swal.fire({
        title: "Apakah anda yakin Ingin Menghapus HISTORY INI ?",
        icon: "warning",
        showCancelButton: true,
        confirmButtonText: "Iya",
        cancelButtonText: "Tidak",
    }).then((willCreate) => {
        if (willCreate.isConfirmed) {
            var old_slug = document.getElementById("old_slug").value;

            var data = {
                _token: $("input[name=_token]").val(),
                slug: slug,
            };
            $.ajax({
                type: "DELETE",
                url: "/delete-history-invoice/" + slug,
                data: data,

                success: function (response) {
                    swal.fire({
                        title: "HISTORY BERHASIL DIHAPUS",
                        icon: "success",
                        timer: 9e3,
                        showConfirmButton: false,
                    });
                    window.location.reload();
                },
            });
        } else {
            swal.fire({
                title: "HISTORY TIDAK DIHAPUS",
                icon: "error",
                timer: 10e3,
                showConfirmButton: false,
            });
        }
    });
}

function bayar() {
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
        title: " Ingin Membayar Selisih Untuk kontainer ini?",
        icon: "question",
        showCancelButton: true,
        confirmButtonText: "Iya",
        cancelButtonText: "Tidak",
    }).then((willCreate) => {
        // var search = "";

        // tabelvendor.search(search).draw();
        if (willCreate.isConfirmed) {
            var ids = [];

            var rowcollection = tabel_invoice.$(".check-container2:checked", {
                page: "all",
            });
            rowcollection.each(function (index, elem) {
                ids.push($(elem).val());
            });

            var id_container = $(".check-container2:checked")
                .map(function () {
                    return this.value;
                })
                .get();

            var csrf = $("#csrf").val();

            $.ajax({
                url: "/get-total-invoice-load",
                type: "POST",
                data: {
                    _token: csrf,
                    id: ids,
                },
                success: function (response) {
                    // let new_id = id;
                    // $("#modal_biaya_do").modal("show");

                    // $("#id_container").val(response.result.id);
                    // $("#old_terbayar").val(response.result.dibayar);
                    // var biaya_trucking = response.result.biaya_trucking;
                    // var ongkos_supir = response.result.ongkos_supir;
                    // var dibayar = response.result.dibayar;

                    var Selisih = response;

                    $("#old_selisih").val(Selisih);
                    Selisih = tandaPemisahTitik(Selisih);

                    $("#selisih").html("Rp. " + Selisih);

                    // console.log(id_container);
                    // console.log(response);
                    $("#modal_total").modal("show");
                    $("#valid_total").validate({
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
                            document.getElementById("loading-wrapper").style.cursor = "wait";
                            document.getElementById("btn_history").setAttribute("disabled", true);

                            var dibayar = $("#terbayar")
                                .val()
                                .replace(/\./g, "");
                            var tanggal_bayar = $("#tanggal_bayar").val();
                            tanggal_bayar = moment(
                                tanggal_bayar,
                                "dddd, DD-MMMM-YYYY"
                            ).format("YYYY-MM-DD");

                            var old_slug = $("#old_slug").val();

                            var data = {
                                _token: csrf,
                                selisih: dibayar,
                                tanggal_bayar: tanggal_bayar,
                                id: id_container,
                                old_slug: old_slug,
                            };

                            $.ajax({
                                type: "POST",
                                url: "/kontainer-dibayar-ii",
                                data: data,

                                success: function (response) {
                                    // console.log(response);
                                    toast
                                        .fire({
                                            icon: "success",
                                            title: "Behasil Dibayar",
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
                title: "Belum dibayar",
                icon: "error",
                timer: 2e3,
            });
        }
    });
}

function blur_terbayar(ini) {
    var terbayar = ini.value.replace(/\./g, "");
    terbayar = parseFloat(terbayar);
    var selisih = document
        .getElementById("old_selisih")
        .value.replace(/\./g, "");
    selisih = parseFloat(selisih);

    if (terbayar > selisih) {
        swal.fire({
            title: "Nominal Melebihi Selisih",
            icon: "error",
            timer: 2e3,
            showConfirmButton: false,
        }).then((result) => {
            ini.value = "";
        });
    }
}

function blur_selisih(ini) {
    var unit_price = ini.value.replace(/\./g, "");
    unit_price = parseFloat(unit_price);
    var total_biaya_kontainer = $("#total_biaya_kontainer").val().replace(/\./g, "");
    total_biaya_kontainer = parseFloat(total_biaya_kontainer);
    var selisih = unit_price - total_biaya_kontainer;
    $("#selisih_price").val(selisih);
}
function blur_selisih_si(ini) {
    var row_table = $("#table_modal_container >tbody >tr").length;

    var total_unit_price = 0;
    var total_biaya_kontainer = document.getElementById("total_biaya_kontainer_si").value.replace(/\./g, "");
    total_biaya_kontainer = parseFloat(total_biaya_kontainer);

    for (var i = 0; i < row_table; i++) {
        if (document.getElementById("price_invoice_si[" + (i + 1) + "]").value != "") {
            var unit_price = document.getElementById("price_invoice_si[" + (i + 1) + "]").value.replace(/\./g, "");
            total_unit_price = total_unit_price + parseFloat(unit_price);
            var selisih = total_unit_price - total_biaya_kontainer;
            document.getElementById("total_price_invoice_si").value = total_unit_price.toString();
            document.getElementById("selisih_price_si").value = selisih.toString();
        }
    }

    // log
    // console.log(parseInt(ini.value));
    // var unit_price = ini.value.replace(/\./g, "");
    // unit_price = parseFloat(unit_price);
    // var total_biaya_kontainer = $("#total_biaya_kontainer_si").val().replace(/\./g, "");
    // total_biaya_kontainer = parseFloat(total_biaya_kontainer);
    // var selisih = unit_price - total_biaya_kontainer;
    // $("#selisih_price_si").val(selisih);
}
function blur_selisih_edit(ini) {
    var unit_price = ini.value.replace(/\./g, "");
    unit_price = parseFloat(unit_price);
    var total_biaya_kontainer = $("#total_biaya_kontainer_edit").val().replace(/\./g, "");
    total_biaya_kontainer = parseFloat(total_biaya_kontainer);
    var selisih = unit_price - total_biaya_kontainer;
    $("#selisih_price_edit").val(selisih);
}

function click_check(ini) {
    var csrf = $("#csrf").val();
    var data = {
        _token: csrf,
        id: ini.value
    }

    $.ajax({
        type: 'post',
        url: '/getNomorInvoice',
        data: data,
        async: false,
        success: function (response) {
            var count = response.length;
            count = count ?? 0;
            if (count != 0) {
                realisasiload_create.$('input[name="' + response + '"]', { "page": "all" }).prop('checked', ini.checked);
            }
            // var html_nomor_invoice = document.getElementsByClassName(response);
            // var nomor_invoice = [];

            // for(var i = 0; i < html_nomor_invoice.length; i++) {
            //     nomor_invoice[i] = html_nomor_invoice[i].value;
            // }

            // nomor_invoice = [...new Set(nomor_invoice)];

            // $('input[name"'+ nomor_invoice +'"]:checkbox').prop('checked', ini.checked)
            // console.log(nomor_invoice.length);
            // if (ini.checked) {
            //     for(var i = 0; i < nomor_invoice.length; i++) {
            //         nomor_invoice[i].nextElementSibling.prop("checked", $(this).prop("checked"));
            //     }
            //     console.log("tercek");
            // } else {
            //     for(var i = 0; i < nomor_invoice.length; i++) {
            //         nomor_invoice[i].nextElementSibling.removeAttribute('checked');
            //     }
            //     console.log("tidak");
            // } 

            // if(ini.prop('checked') == true) {
            //     for(var i = 0; i < nomor_invoice.length; i++) {
            //         nomor_invoice[i].nextElementSibling.setAttribute('checked', true);
            //     }
            // } else {

            // }
            // console.log(response);
            // var nomor_invoice = document.querySelectorAll("td").textContent
        }
    })
    // console.log(ini.parentNode.parentNode.nextElementSibling.innerHTML);
    // console.log(ini.parentNode.parentNode.nextElementSibling);
    // nomor_invoice = ini.parentNode.parentNode.nextElementSibling.innerHTML
    // console.log(ini);
    // ini.parentNodes
}
