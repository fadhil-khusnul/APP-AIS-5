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


                var data = {
                    "_token": token,
                    "pj": pj,
                    "nominal": nominal,
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

    $('#valid_rekening').validate({
            rules: {

                no_rekening: {
                    required: true
                },
                atas_nama: {
                    required: true
                },
                nama_bank: {
                    required: true
                },
            },
            messages: {

                nama_bank: {
                    required: "Silakan Isi Nama Bank"
                },
                no_rekening: {
                    required: "Silakan Isi No. Rekening"
                },

                atas_nama: {
                    required: "Silakan Isi Nama Pemilik Rekening"
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

                var nama_bank = $("#nama_bank").val();
                var no_rekening = $("#no_rekening").val();
                var atas_nama = $("#atas_nama").val();
                var token = $('#csrf').val();


                var data = {
                    "_token": token,
                    "nama_bank": nama_bank,
                    "no_rekening": no_rekening,
                    "atas_nama": atas_nama,
                }

                $.ajax({
                    type: 'POST',
                    url: 'add-rekening',
                    data: data,
                    success: function (response) {
                        swal.fire({
                            icon: "success",
                            title: "Data Rekening Bank Berhasil Ditambah",
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

            $('#pj_edit').val(response.result.pj);
            $('#nominal_edit').val(response.result.nominal);

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

                    $.ajax({
                        url: 'ongkos-supir/' + id,
                        type: 'PUT',
                        data: {
                            "_token": token,
                            pj: $('#pj_edit').val(),
                            nominal: $('#nominal_edit').val(),
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

function editrekening(e) {
    var id = e.value;
    console.log(id);


    $.ajax({
        url: 'rekening-bank/' + id + '/edit',
        type: 'GET',
        success: function (response) {
            $('#modal-dana-edit').modal('show');

            $('#nama_bank_edit').val(response.result.nama_bank);
            $('#no_rekening_edit').val(response.result.no_rekening);
            $('#atas_nama_edit').val(response.result.atas_nama);

            $('#valid_rekening_edit').validate({
                rules: {

                    nama_bank_edit: {
                        required: true
                    },
                    atas_nama_edit: {
                        required: true
                    },
                    no_rekening_edit: {
                        required: true
                    },

                },
                messages: {

                    nama_bank_edit: {
                        required: "Silakan Isi Nama Bank"
                    },
                    no_rekening_edit: {
                        required: "Silakan Isi No. Rekening"
                    },
                    atas_nama_edit: {
                        required: "Silakan Isi Nama Rekening"
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

                    $.ajax({
                        url: 'rekening-bank/' + id,
                        type: 'PUT',
                        data: {
                            "_token": token,
                            nama_bank: $('#nama_bank_edit').val(),
                            no_rekening: $('#no_rekening_edit').val(),
                            atas_nama: $('#atas_nama_edit').val(),
                        },
                        success: function (response) {
                            swal.fire({
                                icon: "success",
                                title: "Data Rekening Bank Berhasil Diedit",
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

function deleterekening(id) {
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
                    url: 'rekening-bank/' + deleteid,
                    data: data,
                    success: function (response) {
                        swal.fire({
                            title: "Data Rekening Bank Dihapus",
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
