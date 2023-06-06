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
            $("#modal_invoice").modal("show");

            $("#id_container").val(response.result.id);




            $("#valid_invoice").validate({


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
                    document.getElementById('loading-wrapper').style.cursor = "wait";
                    document.getElementById('btnFinish1').setAttribute('disabled', true);


                    var csrf = $("#csrf").val();
                    var id_container = $("#id_container").val();
                    var price_invoice = $("#price_invoice").val().replace(/\./g, "");
                    var kondisi_invoice = $("#kondisi_invoice").val();
                    var keterangan_invoice = $("#keterangan_invoice").val();



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
        $("#keterangan_invoice_edit").val(response.result.keterangan_invoice);




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
                document.getElementById('loading-wrapper').style.cursor = "wait";
                document.getElementById('btnFinish1').setAttribute('disabled', true);


                var csrf = $("#csrf").val();
                var id_container = $("#id_container_edit").val();
                var price_invoice = $("#price_invoice_edit").val().replace(/\./g, "");
                var kondisi_invoice = $("#kondisi_invoice_edit").val();
                var keterangan_invoice = $("#keterangan_invoice_edit").val();



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
            var check_container = $(".check-container:checked")
                .map(function () {
                    return this.value;
                })
                .get();

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

            console.log(check_container);

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

                            var yth = $("#yth").val();
                            var km = $("#km").val();


                            var data = {
                                _token: token,
                                check_container: check_container,
                                old_slug: old_slug,
                                yth: yth,
                                km: km,

                                status: "Default",
                            };

                            $.ajax({
                                type: "POST",
                                url: "/create-pdf-invoice-load",
                                data: data,
                                xhrFields: {
                                    responseType: "blob",
                                },
                                success: function (response) {
                                    // console.log(response);
                                    toast.fire({
                                        icon: "success",
                                        title: "Invoice Berhasil Dibuat",
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
                        title: "Invoice Tidak Dibuat",
                        icon: "error",
                        timer: 2e3,
                        showConfirmButton: false,
                    });
                }
            });

        },
    });
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
