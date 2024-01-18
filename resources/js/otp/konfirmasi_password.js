$(document).ready(function () {

    var email = sessionStorage.getItem("responseemail");

    $("#text-konfirmasi").text("Silahkan Password baru untuk email : " + email + ".")

    $.validator.addMethod("uppercaseCheck",
        function (value, element, param) {
            return this.optional(element) || (value.match(/[A-Z]/));
        }, "Silakan Masukkan Minimal 1 Karakter Uppercase"
    )
    $.validator.addMethod("nomorCheck",
        function (value, element, param) {
            return this.optional(element) || (value.match(/[0-9]/));
        }, "Silakan Masukkan Minimal 1 Karakter Numerik"
    )
    $.validator.addMethod("spesialcharCheck",
        function (value, element, param) {
            return this.optional(element) || (value.match(/[●!"#$%&'()*+,\-./:;<=>?@[\\\]^_`{|}~]/));
        }, "Silakan Masukkan Minimal 1 Spesial Karakter"
    )

    $('#valid_password').validate({
        rules: {
            password_baru: {
                required: true,
                uppercaseCheck: true,
                nomorCheck: true,
                spesialcharCheck: true,
                minlength: 6,

            },
            konfirmasi_password: {
                required: true,
                equalTo: '[name="password_baru"]',
                // uppercaseCheck: true,
                // nomorCheck: true,
                // spesialcharCheck: true,
                // minlength: 5,
            },
        },
        messages: {
            password_baru: {
                required: "Silakan Isi Password",
                minlength: "Minimal 6 Karakter"
            },
            konfirmasi_password: {
                required: "Silakan Isi Konfirmasi Password",
                equalTo: "Silakan Cocokkan Password yang Anda Masukkan",
                // minlength: "Minimal 5 Karakter"
            }
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
            error.addClass("invalid-feedback"); { { } }
            element.closest(".validation-container").append(error); { { } }
        },
        submitHandler: function (form) {


            var token = $('#csrf').val();
            var password_baru = $('#password_baru').val();
            var konfirmasi_password = $('#konfirmasi_password').val();


            var data = {
                "_token": token,
                "email": email,
                "password_baru": password_baru,
                "konfirmasi_password": konfirmasi_password
            }

            $.ajax({
                url: "/confirm-password",
                type: 'POST',
                data: data,
                success: function (response) {
                    swal.fire({
                        title: "Password Berhasil Diubah",
                        text: "Silakan Login Ulang",
                        icon: "success",
                        timer: 2e3,
                        showConfirmButton: false,
                    });

                    location.href = "/login"


                }


            });



        }
    });

});