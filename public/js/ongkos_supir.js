"use strict";
$(function () {
    $('#valid_dana').validate({
            rules: {

                pj: {
                    required: true
                },
                nominal: {
                    required: true
                },
            },
            messages: {

                pj: {
                    required: "Silakan Isi Nama Penanggung Jawab"
                },
                nominal: {
                    required: "Silakan Isi Nominal"
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

                var pj = $("#pj").val();
                var nominal = $("#nominal").val();
                var token = $('#csrf').val();

                let tanggal_deposit = document.getElementById("tanggal_deposit").value;
                var tempDate;
                var formattedDate;

                tempDate = new Date(tanggal_deposit);
                formattedDate = [
                    tempDate.getFullYear(),
                    tempDate.getMonth() + 1,
                    tempDate.getDate(),
                ].join("-");


                var data = {
                    "_token": token,
                    "pj": pj,
                    "nominal": nominal,
                    "tanggal_deposit": formattedDate,
                }

                $.ajax({
                    type: 'POST',
                    url: 'add-ongkos',
                    data: data,
                    success: function (response) {
                        swal.fire({
                            icon: "success",
                            title: "Data Sumber Ongkos Supir Berhasil Ditambah",
                            showConfirmButton: false,
                            timer: 2e3,

                        })
                            .then((result) => {
                                location.reload();
                            });
                    },
                });
            }
    });
    $('#valid_supir').validate({

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

                var nama_vendor = $("#nama_vendor").val();
                var nama_supir = $("#nama_supir").val();
                var nomor_polisi = $("#nomor_polisi").val();
                var token = $('#csrf').val();


                var data = {
                    "_token": token,
                    "nama_vendor": nama_vendor,
                    "nama_supir": nama_supir,
                    "nomor_polisi": nomor_polisi,
                }

                $.ajax({
                    type: 'POST',
                    url: '/add-supir',
                    data: data,
                    success: function (response) {
                        swal.fire({
                            icon: "success",
                            title: "Data Supir Berhasil Ditambah",
                            showConfirmButton: false,
                            timer: 2e3,

                        })
                            .then((result) => {
                                location.reload();
                            });
                    },
                });
            }
    });

});

function editdana(e) {
    var id = e.value;
    console.log(id);


    $.ajax({
        url: 'ongkos-supir/' + id + '/edit',
        type: 'GET',
        success: function (response) {
            $('#modal-dana-edit').modal('show');

            var old_tanggal_result = moment(
                response.result.tanggal_deposit,
                "YYYY-MM-DD"
            ).format("dddd, DD MMMM YYYY");

            $('#new_id').val(response.result.id);
            $('#pj_edit').val(response.result.pj);
            $('#nominal_edit').val(response.result.nominal);
            $('#tanggal_deposit_update').val(old_tanggal_result);

            $('#valid_dana_edit').validate({
                rules: {

                    pj_edit: {
                        required: true
                    },
                    nominal_edit: {
                        required: true
                    },

                },
                messages: {

                    pj_edit: {
                        required: "Silakan Isi Area Code"
                    },
                    nominal_edit: {
                        required: "Silakan Isi Nama Depo"
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

                // console.log();
                submitHandler: function (form) {
                    var token = $('#csrf').val();
                    var new_id = $('#new_id').val();
                    console.log(new_id, id);

                    let tanggal_deposit = document.getElementById("tanggal_deposit_update").value;
                    var tempDate;
                    var formattedDate;

                    tempDate = new Date(tanggal_deposit);
                    formattedDate = [
                        tempDate.getFullYear(),
                        tempDate.getMonth() + 1,
                        tempDate.getDate(),
                    ].join("-");

                    $.ajax({
                        url: 'ongkos-supir/' + new_id,
                        type: 'PUT',
                        data: {
                            "_token": token,
                            pj: $('#pj_edit').val(),
                            nominal: $('#nominal_edit').val(),
                            tanggal_deposit: formattedDate,
                        },
                        success: function (response) {
                            swal.fire({
                                icon: "success",
                                title: "Data Ongkos Supir Berhasil Diedit",
                                showConfirmButton: false,
                                timer: 2e3,

                            })
                                .then((result) => {
                                    location.reload();
                                });
                        }
                    })
                }
            });

        }
    });
}
function editsupir(e) {
    var id = e.value;
    console.log(id);


    $.ajax({
        url: 'supir-mobil/' + id + '/edit',
        type: 'GET',
        success: function (response) {
            $('#modal-supir-edit').modal('show');

            $('#old_id_supir').val(response.result.id);
            $('#nama_vendor_edit').val(response.result.vendor_id);
            $('#nama_supir_edit').val(response.result.nama_supir);
            $('#nomor_polisi_edit').val(response.result.nomor_polisi);

            $('#valid_supir_edit').validate({

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

                // console.log();
                submitHandler: function (form) {
                    var token = $('#csrf').val();
                    var old = $('#old_id_supir').val();

                    $.ajax({
                        url: '/supir-mobil/' + old,
                        type: 'PUT',
                        data: {
                            "_token": token,
                            nama_vendor: $('#nama_vendor_edit').val(),
                            nama_supir: $('#nama_supir_edit').val(),
                            nomor_polisi: $('#nomor_polisi_edit').val(),
                        },
                        success: function (response) {
                            swal.fire({
                                icon: "success",
                                title: "Data Supir Berhasil Diedit",
                                showConfirmButton: false,
                                timer: 2e3,

                            })
                                .then((result) => {
                                    location.reload();
                                });
                        }
                    })
                }
            });

        }
    });
}


function deletedana(id) {
    var deleteid = id.value;

    var swal = Swal.mixin({
        customClass: {
            confirmButton: "btn btn-label-success btn-wide mx-1",
            denyButton: "btn btn-label-secondary btn-wide mx-1",
            cancelButton: "btn btn-label-danger btn-wide mx-1" },
            buttonsStyling: false
    });

    swal.fire({
        title: "Apakah anda yakin?",
        text: "Setelah dihapus, Anda tidak dapat memulihkan Data ini lagi!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonText: "Iya",
        cancelButtonText: "Tidak",
    })
        .then((willDelete) => {
            if (willDelete.isConfirmed) {

                var data = {
                    "_token": $('input[name=_token]').val(),
                    'id': deleteid,
                };
                $.ajax({
                    type: "DELETE",
                    url: 'ongkos-supir/' + deleteid,
                    data: data,
                    success: function (response) {
                        swal.fire({
                            title: "Data Ongkos Supir Dihapus",
                            text: "Data Berhasil Dihapus",
                            icon: "success",
                            timer: 2e3,
                            showConfirmButton: false
                        })
                            .then((result) => {
                                location.reload();
                            });
                    }
                });
            } else {
                swal.fire({
                    title: "Data Tidak Dihapus",
                    text: "Data Batal Dihapus",
                    icon: "error",
                    timer: 2e3,
                    showConfirmButton: false
                });
            }
        });
}
function printdana(id) {
    var id_dana = id.value;

    var swal = Swal.mixin({
        customClass: {
            confirmButton: "btn btn-label-success btn-wide mx-1",
            denyButton: "btn btn-label-secondary btn-wide mx-1",
            cancelButton: "btn btn-label-danger btn-wide mx-1" },
            buttonsStyling: false
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
        title: " Ingin Mencetak Report Deposit?",
        text: "Silahkan Periksa Semua Data yang ada Sebelum Mencetak.",
        icon: "question",
        showCancelButton: true,
        confirmButtonText: "Iya",
        cancelButtonText: "Tidak",
    })
        .then((willCreate) => {
            if (willCreate.isConfirmed) {

            var data = {
                    "_token": $('input[name=_token]').val(),
                    'id': id_dana,
                };
                $.ajax({
                    type: "POST",
                    url: "/print-dana/" + id_dana,
                    data: data,
                    xhrFields: {
                        responseType: "blob",
                    },
                    success: function (response) {
                        console.log(response);
                        toast.fire({
                            icon: "success",
                            title: "Report Deposit Didownload",
                        });
                        var blob = new Blob([response]);
                        var link = document.createElement("a");
                        link.href = window.URL.createObjectURL(blob);
                        link.download = "deposit_report.pdf";
                        link.click();

                        // setTimeout(function () {
                        //     window.location.reload();
                        // }, 10);
                    },
                });
            } else {
                toast.fire({
                    title: "Report Deposit Tidak Didownload",
                    icon: "error",
                });
            }
        });
}
function deletesupir(id) {
    var deleteid = id.value;

    var swal = Swal.mixin({
        customClass: {
            confirmButton: "btn btn-label-success btn-wide mx-1",
            denyButton: "btn btn-label-secondary btn-wide mx-1",
            cancelButton: "btn btn-label-danger btn-wide mx-1" },
            buttonsStyling: false
    });

    swal.fire({
        title: "Apakah anda yakin?",
        text: "Setelah dihapus, Anda tidak dapat memulihkan Data ini lagi!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonText: "Iya",
        cancelButtonText: "Tidak",
    })
        .then((willDelete) => {
            if (willDelete.isConfirmed) {

                var data = {
                    "_token": $('input[name=_token]').val(),
                    'id': deleteid,
                };
                $.ajax({
                    type: "DELETE",
                    url: '/supir-mobil/' + deleteid,
                    data: data,
                    success: function (response) {
                        swal.fire({
                            title: "Data Supir Dihapus",
                            text: "Data Berhasil Dihapus",
                            icon: "success",
                            timer: 2e3,
                            showConfirmButton: false
                        })
                            .then((result) => {
                                location.reload();
                            });
                    }
                });
            } else {
                swal.fire({
                    title: "Data Tidak Dihapus",
                    text: "Data Batal Dihapus",
                    icon: "error",
                    timer: 2e3,
                    showConfirmButton: false
                });
            }
        });
}


