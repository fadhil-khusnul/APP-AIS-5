
"use strict";




$(document).ready(function() {


    FilePond.registerPlugin(
    
        FilePondPluginFileValidateType,
        FilePondPluginImageExifOrientation,
        FilePondPluginImagePreview,
        FilePondPluginImageCrop,
        FilePondPluginImageResize,
        FilePondPluginImageTransform,
        FilePondPluginImageEdit,
        FilePondPluginFileValidateSize,

    );

    const url = "{{ asset('/storage/Image-Profile/'.$users->img.'') }}";
    let token = $('#csrf').val();
    let username = $('#username').val();

    const inputElement = document.querySelector('input[id="img"]');
    // const inputElement = document.querySelector('fieldset');
    // Create a FilePond instance

    FilePond.setOptions({
        server: {

            load: (source, load, error, progress, abort, headers) => {

                // now load it using XMLHttpRequest as a blob then load it.
                let request = new XMLHttpRequest();
                request.open('GET', source);
                request.responseType = "blob";
                request.onreadystatechange = () => request.readyState === 4 && load(request
                    .response);
                request.send();
            },
        }
    });


    // const inputElement = document.querySelector('fieldset');
    // Create a FilePond instance
    const pond = FilePond.create(inputElement, {

        stylePanelLayout: 'compact circle',
        labelIdle: `Drag & Drop your picture or <span class="filepond--label-action">Browse</span><span class="merah"> (Max. 2MB)</spam>`,
        imagePreviewHeight: 170,
        imageCropAspectRatio: '1:1',
        imageResizeTargetWidth: 200,
        imageResizeTargetHeight: 200,
        styleLoadIndicatorPosition: 'center bottom',
        styleRetryItemProcessingPosition: 'center center',
        styleProgressIndicatorPosition: 'center bottom',
        styleButtonRemoveItemPosition: 'center bottom',
        imageCropAspectRatio: 1,

        files: [{
            source: url,
            options: {
                type: 'local'

            },
        }],



    });

    $.validator.addMethod("uppercaseCheck",
    function(value, element, param) {
        return this.optional(element) || (value.match(/[A-Z]/));
    }, "Silakan Masukkan Minimal 1 Karakter Uppercase"
    )
    $.validator.addMethod("nomorCheck",
        function(value, element, param) {
            return this.optional(element) || (value.match(/[0-9]/));
        }, "Silakan Masukkan Minimal 1 Karakter Numerik"
    )
    $.validator.addMethod("spesialcharCheck",
        function(value, element, param) {
            return this.optional(element) || (value.match(/[●!"#$%&'()*+,\-./:;<=>?@[\\\]^_`{|}~]/));
        }, "Silakan Masukkan Minimal 1 Spesial Karakter"
    )
   
    

    $('#valid_profil').submit(function (e) { 
        e.preventDefault();}).validate({
            rules: {

                username: {
                    required: true,
                    // remote: {
                    //     url: "/checkUsername",
                    //     type: "post"
                    // },
                },
                name: {
                    required: true
                },
                no_telp: {
                    required: true
                },
                email: {
                    required: true
                },
                password: {
                    required: true,
                    minlength: 5,
                    uppercaseCheck: true,
                    nomorCheck: true,
                    spesialcharCheck: true,
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

                var fd = new FormData();

                const pondFiles = pond.getFiles();
                    for (var i = 0; i < pondFiles.length; i++) {
                        fd.append('file', pondFiles[i].file);
                }

                var name = $("#name").val();
                var username = $("#username").val();
                var email = $("#email").val();
                var no_telp = $("#no_telp").val();
                var password = $("#password").val();
                var role = $("#role").val();
                var token = $('#csrf').val();

                fd.append("_token", token);
                fd.append("name", name);
                fd.append("username", username);
                fd.append("email", email);
                fd.append("no_telp", no_telp);
                fd.append("password", password);
                fd.append("role", role);

                $.ajax({
                    type: 'POST',
                    url: '/user-create',
                    data: fd,
                    contentType: false,
                    processData: false,
                    dataType: 'json',
                    success: function (response) {
                        swal.fire({
                            icon: "success",
                            title: "User Berhasil Dibuat",
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
    $('#valid_profil_edit').submit(function (e) { 
        e.preventDefault();}).validate({
            rules: {

                username: {
                    required: true,
                    // remote: {
                    //     url: "/checkUsername",
                    //     type: "post"
                    // },
                },
                name: {
                    required: true
                },
                no_telp: {
                    required: true
                },
                email: {
                    required: true
                },
                password: {
                    required: true,
                    minlength: 5,
                    uppercaseCheck: true,
                    nomorCheck: true,
                    spesialcharCheck: true,
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

                var fd = new FormData();

                const pondFiles = pond.getFiles();
                    for (var i = 0; i < pondFiles.length; i++) {
                        fd.append('file', pondFiles[i].file);
                }

                var name = $("#name").val();
                var username = $("#username").val();
                var email = $("#email").val();
                var no_telp = $("#no_telp").val();
                var role = $("#role").val();
                var remember_token = $("#remember_token").val();
                var token = $('#csrf').val();

                fd.append("_token", token);
                fd.append("name", name);
                fd.append("username", username);
                fd.append("email", email);
                fd.append("no_telp", no_telp);
                fd.append("role", role);

                $.ajax({
                    url: '/user/'+remember_token,
                    type: 'POST',
                    data: fd,
                    contentType: false,
                    processData: false,
                    dataType: 'json',
                    success: function (response) {
                        swal.fire({
                            icon: "success",
                            title: "User Berhasil Diupdate",
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


function editpassword(e) {
    var id = e.value;
    console.log(id);


    $.ajax({
        url: '/user/' + id + '/edit',
        type: 'GET',
        success: function (response) {
            $('#modal-password-edit').modal('show');

            $('#new_id').val(response.result.id);
            $('#username_title').html(response.result.username);
            $('#nama_user_edit').val(response.result.name);
            $('#role_edit').val(response.result.role);

            $.validator.addMethod("uppercaseCheck",
            function(value, element, param) {
                return this.optional(element) || (value.match(/[A-Z]/));
            }, "Silakan Masukkan Minimal 1 Karakter Uppercase"
            )
            $.validator.addMethod("nomorCheck",
                function(value, element, param) {
                    return this.optional(element) || (value.match(/[0-9]/));
                }, "Silakan Masukkan Minimal 1 Karakter Numerik"
            )
            $.validator.addMethod("spesialcharCheck",
                function(value, element, param) {
                    return this.optional(element) || (value.match(/[●!"#$%&'()*+,\-./:;<=>?@[\\\]^_`{|}~]/));
                }, "Silakan Masukkan Minimal 1 Spesial Karakter"
            )
           
            $('#valid_password_edit').validate({
                rules: {

                    password_edit: {
                        required: true,
                        minlength: 5,
                        uppercaseCheck: true,
                        nomorCheck: true,
                        spesialcharCheck: true,
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

                   

                    $.ajax({
                        url: 'user/' + new_id,
                        type: 'PUT',
                        data: {
                            "_token": token,
                            role: $('#role_edit').val(),
                            password: $('#password_edit').val(),
                        },
                        success: function (response) {
                            swal.fire({
                                icon: "success",
                                title: "Password User Berhasil Direset",
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


function deleteuser(id) {
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
        text: "Setelah dihapus, Anda tidak dapat memulihkan User ini lagi!",
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
                    url: 'user/' + deleteid,
                    data: data,
                    success: function (response) {
                        swal.fire({
                            title: "User Terhapus",
                            text: "User Berhasil Dihapus",
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


