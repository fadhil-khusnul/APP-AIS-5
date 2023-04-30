"use strict";
$(function () {
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
            toast.addEventListener("mouseleave", Swal.resumeTimer)
        }
    });

    $.validator.addMethod("notEqual", function (value, element, arg) { return arg !== value }, "Value must not equal arg.");


    $('#valid_seal').validate({
        rules: {

            tahun_seal: {
                required: true
            },
            kode_seal: {
                required: true
            },
            touch_seal: {
                required: true
            },
        },
        messages: {

            tahun_seal: {
                required: "Silakan Isi Nama Kompany"
            },
            kode_seal: {
                required: "Silakan Isi Nama Kompany"
            },
            touch_seal: {
                required: "Silakan Isi Nama Kompany"
            }
        },
        submitHandler: function (form) {

            var kode_seal = $("#kode_seal").val();
            var tahun_seal = $("#tahun_seal").val();
            var touch_seal = $("#touch_seal").val();
            var token = $('#csrf').val();


            var data = {
                "_token": token,
                "tahun_seal": tahun_seal,
                "kode_seal": kode_seal,
                "touch_seal": touch_seal,
            }

            swal.fire({
                title: "Apakah anda yakin ? Ingin Menambah Sebanyak "+touch_seal+" Seal" ,
                icon: "warning",
                showCancelButton: true,
                confirmButtonText: "Iya",
                cancelButtonText: "Tidak",
            })
            .then((willCreate) => {
                if (willCreate.isConfirmed) {

                    $.ajax({
                        type: 'POST',
                        url: 'tambah-seal',
                        data: data,
                        success: function (response) {
                            swal.fire({
                                icon: "success",
                                title: "Seal sebanyak"+charAt+" Berhasil Ditambah",
                                showConfirmButton: false,
                                timer: 2e3,

                            })
                                .then((result) => {
                                    location.reload();
                                });
                        },
                    });
                } else {
                    swal.fire({
                        title: "Seal Tidak Dibuat",
                        text: "Seal Batal Dibuat",
                        icon: "warning",
                        timer: 2e3,
                        showConfirmButton: false
                    });
                }
            });


        }
    });




});

function editCompany(e) {
    var id = e.value;
    console.log(id);


    $.ajax({
        url: 'company/' + id + '/edit',
        type: 'GET',
        success: function (response) {
            $('#modal-company-edit').modal('show');

            $('#nama_company_edit').val(response.result.nama_company);

            $('#valid_company_edit').validate({
                rules: {

                    nama_company_edit: {
                        required: true
                    },

                },
                messages: {

                    nama_company_edit: {
                        required: "Silakan Isi Nama Company"
                    },

                },

                // console.log();
                submitHandler: function (form) {
                    var token = $('#csrf').val();

                    $.ajax({
                        url: 'company/' + id,
                        type: 'PUT',
                        data: {
                            "_token": token,
                            nama_company: $('#nama_company_edit').val(),
                        },
                        success: function (response) {
                            swal.fire({
                                icon: "success",
                                title: "Data Company Berhasil Diedit",
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




function deleteCompany(id) {
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
                    url: 'company/' + deleteid,
                    data: data,
                    success: function (response) {
                        swal.fire({
                            title: "Data Dihapus",
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


