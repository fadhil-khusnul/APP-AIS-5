var tabelvendor = $("#vendor_bayar_Load").DataTable({
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

    // scroller: true,
});

// var start_date;
// var end_date;
// var DateFilterFunction = function (oSettings, aData, iDataIndex) {
//     console.log("starr4", start_date, aData, end_date);
//     var dateStart = parseDateValue(start_date);
//     var dateEnd = parseDateValue(end_date);

//     var evalDate = parseDateValue(aData[3]);

//     console.log("evaldate", evalDate, dateEnd, dateStart);
//     if (
//         (isNaN(dateStart) && isNaN(dateEnd)) ||
//         (isNaN(dateStart) && evalDate <= dateEnd) ||
//         (dateStart <= evalDate && isNaN(dateEnd)) ||
//         (dateStart <= evalDate && evalDate <= dateEnd)
//     ) {
//         return true;
//     }
//     return false;
// };

// // fungsi untuk converting format tanggal dd/mm/yyyy menjadi format tanggal javascript menggunakan zona aktubrowser
// function parseDateValue(rawDate) {
//     console.log("rawdate", rawDate);
//     var dateArray = rawDate.split("/");
//     console.log(dateArray);
//     var parsedDate = new Date(
//         dateArray[2],
//         parseInt(dateArray[1]) - 1,
//         dateArray[0]
//     ); // -1 because months are from 0 to 11
//     return parsedDate;
// }

// $("#filter_date")
//     .daterangepicker({
//         locale: {
//             format: "dddd, DD MMMM YYYY",
//             applyLabel: "Apply",
//             cancelLabel: "Cancel",
//             fromLabel: "from",
//             toLabel: "to",
//             weekLabel: "M",
//             autoUpdateInput: false,
//             daysOfWeek: ["Min", "Sen", "Sel", "Rab", "Kam", "Jum", "Sab"],
//             monthNames: [
//                 "Jan",
//                 "Feb",
//                 "Маret",
//                 "Аpril",
//                 "Мei",
//                 "Juni",
//                 "Juli",
//                 "Agu",
//                 "Sep",
//                 "Okt",
//                 "Nov",
//                 "Des",
//             ],
//             weekStart: 1,
//             autoUpdateInput: false,
//         },
//     })
//     .on("apply.daterangepicker", function (ev, picker) {
//         $(this).val(
//             picker.startDate.format("dddd, DD MMMM YYYY") +
//                 " - " +
//                 picker.endDate.format("dddd, DD MMMM YYYY")
//         );
//         start_date = picker.startDate.format("dddd, DD MMMM YYYY");
//         end_date = picker.endDate.format("dddd, DD MMMM YYYY");
//         console.log("start_date, end_date", start_date, end_date);
//         console.log("datee", DateFilterFunction);
//         $.fn.dataTableExt.afnFiltering.push(DateFilterFunction);
//         tabelvendor.draw();
//     });

// $("#filter_date").on("cancel.daterangepicker", function (ev, picker) {
//     $(this).val("");
//     start_date = "";
//     end_date = "";
//     $.fn.dataTable.ext.search.splice(
//         $.fn.dataTable.ext.search.indexOf(DateFilterFunction, 1)
//     );
//     tabelvendor.draw();
// });

// var minDate, maxDate;

// // Custom filtering function which will search data in column four between two values
// $.fn.dataTable.ext.search.push(function (settings, data, dataIndex) {
//     var min = minDate.val();
//     var max = maxDate.val();
//     var date = new Date(data[4]);

//     if (
//         (min === null && max === null) ||
//         (min === null && date <= max) ||
//         (min <= date && max === null) ||
//         (min <= date && date <= max)
//     ) {
//         return true;
//     }
//     return false;
// });

//     // Create date inputs
//     minDate = new DateTime($("#min"), {
//         format: "dddd, DD MMMM YYYY",
//     });
//     maxDate = new DateTime($("#max"), {
//         format: "dddd, DD MMMM YYYY",
//     });

//     // DataTables initialisation
//     // var table = $("#example").DataTable();

//     // Refilter the table
//     $("#min, #max").on("change", function () {
//         tabelvendor.draw();
//     });

function filter_date() {
    var date_min = new Date($("#min").val());
    var seconds_min = Math.round(date_min.getTime() / 1000);
    var date_max = new Date($("#max").val());
    var seconds_max = Math.round(date_max.getTime() / 1000);

    var tanggal = tabelvendor.$("input[name='date']", { page: "all" });

    var date = [];
    var seconds = [];

    for (var i = 0; i < tanggal.length; i++) {
        date[i] = new Date(tanggal[i].value);
        seconds[i] = Math.round(date[i].getTime() / 1000);
    }

    var search = [];
    for (var i = 0; i < seconds.length; i++) {
        if (seconds[i] < seconds_min || seconds[i] > seconds_max) {
            search[i] = 0;
        } else {
            search[i] = 1;
        }
    }

    var tanggal_date = [];
    for (var i = 0; i < search.length; i++) {
        if (search[i] == 1) {
            tanggal_date[i] = tanggal[i].value;
        }
    }
    tanggal_date = tanggal_date.filter(function (el) {
        return el != null;
    });

    if (tanggal_date.length == 0) {
        tabelvendor.columns(3).search(null).draw();
    } else {
        tabelvendor
            .columns(3)
            .search(tanggal_date.join("|"), true, false, true)
            .draw();
    }
}

function filter_vendor(val) {
    var vendor = [];

    vendor = $("#pilih_vendor").val();
    // regex = '^' + vendor ;
    console.log(vendor);

    if (vendor == null) {
        tabelvendor.columns(6).search("").draw();
    } else {
        tabelvendor
            .columns(6)
            .search(vendor.join("|"), true, false, true)
            .draw();
    }
}
function filter_status(val) {
    var status = val.value;
    console.log(status);
    if (status == null) {
        tabelvendor.columns(2).search("").draw();
    } else {
        tabelvendor.columns(2).search(status).draw();
    }
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

            var rowcollection = tabelvendor.$(".check-container1:checked", {
                page: "all",
            });
            rowcollection.each(function (index, elem) {
                ids.push($(elem).val());
            });

            var id_container = $(".check-container1:checked")
                .map(function () {
                    return this.value;
                })
                .get();

            var csrf = $("#csrf").val();

            $.ajax({
                url: "/get-selisih-load",
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

                    console.log(id_container);
                    $("#modal_biaya_do").modal("show");
                    $("#valid_pod").validate({
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
                            // var id_container = $("#id_container").val();
                            var dibayar = $("#dibayar")
                                .val()
                                .replace(/\./g, "");
                            // var old_terbayar = $("#old_terbayar")
                            //     .val()
                            //     .replace(/\./g, "");
                            // var old_selisih = $("#old_selisih")
                            //     .val()
                            //     .replace(/\./g, "");

                            var data = {
                                _token: csrf,
                                selisih: dibayar,
                                id: id_container,
                            };

                            $.ajax({
                                type: "POST",
                                url: "/kontainer-dibayar",
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

    // for (let i = 0; i < chek_container.length; i++) {
    //     volume[i] = document.getElementById("volume[" + item_id[i] + "]").value;

    // }
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
