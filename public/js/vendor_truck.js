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
    dom: 'Bfrltip',
    buttons:[
    {
        extend:"excel",
        title: "Report Vendor" ,
        className:"btn btn-flat-success",
        exportOptions: {
            columns: [0,2,3,4,5,6,7,8,9,10,11],
        }

    },
    {
            extend: 'pdf',
            orientation: 'landscape',
            className:"btn btn-flat-success",
            className:"btn btn-flat-success",
            pageSize : 'LEGAL',
            title: "Report Vendor" ,
            // customize : function(doc){
            //     doc.defaultStyle.alignment = 'center';
            //     doc.styles.tableHeader.alignment = 'center';
            //     doc.styles.tableHeader.fillColor = '#00ad4c';
            //     doc.content[1].table.widths = [15,50,50,50,50,50,50,50,50,70,50,50,50,50,50,50];;
            // },
            exportOptions: {
                columns: [0,2,3,4,5,6,7,8,9,10,11],
            }
        },
    ],

    // scroller: true,
});



$("#pilih_vessel").select2
({
    dropdownAutoWidth:true,
    allowClear:true,
    placeholder:"Pilih vessel",
    stateSave: true,



})
$("#pilih_status").select2
({
    dropdownAutoWidth:true,
    allowClear:true,
    placeholder:"Pilih status",
})

var check = tabelvendor.$(".check-container1", { page: "all" });

$("#add_biaya").attr("disabled", "disabled");
check.click(function() {
    if ($(this).is(":checked")) {
        $("#add_biaya").removeAttr("disabled");
    } else {
        $("#add_biaya").attr("disabled", "disabled");
    }
});

function filter_date() {
    var date_min = new Date($("#min").val());
    var seconds_min = Math.round(date_min.getTime() / 1000);
    var date_max = new Date($("#max").val());
    console.log(date_max, date_min);
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
function filter_vessel(val) {
    var vessel = [];

    vessel = $("#pilih_vessel").val();
    // regex = '^' + vessel ;
    console.log(vessel);

    if (vessel == null) {
        tabelvendor.columns(4).search("").draw();
    } else {
        tabelvendor
            .columns(4)
            .search(vessel.join("|"), true, false, true)
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

                    $("#tanggal_bayar").datepicker({
                        format: "DD, dd-MM-yyyy",
                        changeMonth: true,
                        changeYear: false,
                        todayBtn: "linked",
                        clearBtn: true,
                        weekStart: 1,
                        todayHighlight: true,
                    });
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

                            let tanggal_bayar = document.getElementById(
                                "tanggal_bayar"
                            ).value;
                            tanggal_bayar = moment(
                                tanggal_bayar,
                                "dddd, DD-MMMM-YYYY"
                            ).format("YYYY-MM-DD");
                            console.log(tanggal_bayar);

                            var dibayarkan_ke = $("#dibayarkan_ke").val();
                            var cara_bayar = $("#cara_bayar").val();
                            var keterangan_transfer = $("#keterangan_transfer").val();
                            

                            var data = {
                                _token: csrf,
                                selisih: dibayar,
                                id: id_container,
                                cara_bayar: cara_bayar,
                                tanggal_bayar: tanggal_bayar,
                                dibayarkan_ke: dibayarkan_ke,
                                keterangan_transfer: keterangan_transfer,
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
