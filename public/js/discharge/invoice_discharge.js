
var table_invoice = $("#table_invoice").DataTable({
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
var tabel_list_invoice = $("#tabel_list_invoice").DataTable({
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


$("#value_materai").attr("disabled", "disabled");

$("#add_total").attr("disabled", "disabled");
tabel_list_invoice.$(".check-container2", { page: "all" },).click(function () {
    if ($(this).is(":checked")) {
        $("#add_total").removeAttr("disabled");
    } else {
        $("#add_total").attr("disabled", "disabled");
    }
});
$("#submit_batal").attr("disabled", "disabled");
table_invoice.$(".check_kontainer_batal", { page: "all" },).click(function () {
    if ($(this).is(":checked")) {
        $("#submit_batal").removeAttr("disabled");
    } else {
        $("#submit_batal").attr("disabled", "disabled");
    }
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
                url: "/detail-kontainer-discharge/" + id + "/input",
                type: "GET",
                success: function (response) {
                    let new_id = id;
                    console.log(new_id);
                    console.log(response.result.biaya_thc);
                    $("#modal_invoice").modal("show");

                    $("#id_container").val(response.result.id);
                    $("#nomor_kontainer_modal").html(
                        response.result.nomor_kontainer
                    );
                    var total_biaya_kontainer =
                        parseFloat(response.result.biaya_cleaning) +
                        parseFloat(response.result.biaya_retribusi) +
                        parseFloat(response.result.biaya_thc) +
                        parseFloat(response.result.biaya_trucking) +
                        parseFloat(response.result.ongkos_supir) +
                        parseFloat(response.result.biaya_seal) +
                        parseFloat(response.result.jaminan_kontainer) +
                        parseFloat(response.result.total_biaya_lain);
                    
                        console.log(total_biaya_kontainer);
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
                                url: "/masukkan-invoice-discharge",
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
        url: "/detail-kontainer-discharge/" + id + "/input",
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
            parseFloat(response.result.biaya_cleaning) +
            parseFloat(response.result.biaya_retribusi) +
            parseFloat(response.result.biaya_thc) +
            parseFloat(response.result.biaya_trucking) +
            parseFloat(response.result.ongkos_supir) +
            parseFloat(response.result.biaya_seal) +
            parseFloat(response.result.jaminan_kontainer) +
            parseFloat(response.result.total_biaya_lain);
            $("#total_biaya_kontainer_edit").val(total_biaya_kontainer);
            $("#selisih_price_edit").val(response.result.price_invoice - total_biaya_kontainer);


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
                        url: "/masukkan-invoice-discharge",
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
            var check_container = table_invoice.$(".check_kontainer_batal:checked", { "page": "all" })
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
                url: "/getPod-Discharge",
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
                                            url: "/getInvoice-Discharge",
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
                                                    status: "Realisasi",
                                                };

                                                $.ajax({
                                                    type: "POST",
                                                    url: "/create-pdf-invoice-discharge",
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

function blur_selisih(ini) {
    var unit_price = ini.value.replace(/\./g, "");
    unit_price = parseFloat(unit_price);
    var total_biaya_kontainer = $("#total_biaya_kontainer").val().replace(/\./g, "");
    total_biaya_kontainer = parseFloat(total_biaya_kontainer);
    var selisih = unit_price - total_biaya_kontainer;
    $("#selisih_price").val(selisih);
}

function countCheck() {
    var ids = []

    var rowcollection =  table_invoice.$('.check_kontainer_batal:checked', {"page": "all"});
    rowcollection.each(function (index, elem) {
        ids.push($(elem).val());
    });
    document.getElementById("nomor").innerHTML = ids.length;
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
                url: "/delete-invoice-discharge/" + deleteid,
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
        title: "Apakah anda yakin ingin Membatalkan History Pembayaran ini ?",
        text:"Dengan mengklik OK maka Dana DITERIMA INVOICE ini Akan dikembalikan/dibatalkan.",
        icon: "warning",
        showCancelButton: true,
        confirmButtonText: "Ok",
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
                        title: "HISTORY BERHASIL DIBATALKAN",
                        icon: "success",
                        timer: 9e3,
                        showConfirmButton: false,
                    });
                    window.location.reload();
                },
            });
        } else {
            swal.fire({
                title: "HISTORY TIDAK DIBATALKAN",
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
                            // document.getElementById("btn_history").setAttribute("disabled", true);

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