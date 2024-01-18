$(document).ready(function () {
    $("#kode_otp").inputmask({
        mask: "999-999",
    });

    var swal = Swal.mixin({
        customClass: {
            confirmButton: "btn btn-label-success btn-wide mx-1",
            denyButton: "btn btn-label-secondary btn-wide mx-1",
            cancelButton: "btn btn-label-danger btn-wide mx-1",
        },
        buttonsStyling: false,
    });
    
    
    var getresponse = sessionStorage.getItem("responseemail");
    var getemail = sessionStorage.getItem("responseemail_2");
    console.log(getemail);
    // var responsecode = sessionStorage.getItem("responsecode");
    $("#text-email").text("Kode OTP dikirim ke " + getresponse + ".")
    $("#text-konfirmasi").text("Silahkan Password baru untuk email : " + getresponse + ".")
    document.getElementById("email").value = getresponse;
    var email = getresponse;

    var token = document.getElementById("csrf").value;


    $('#valid_otp').validate({
        rules: {
            kode_otp: {
                required: true,
                remote: {
                    url: "/check-OTP",
                    type: "post",
                    data: {
                        _token: token,
                        'email': email,
                    }
                }
            }
        },
        messages: {
            kode_otp: {
                required: "Silakan Isi Kode OTP yang Benar",
                remote: "Silakan Isi Kode OTP yang Benar",
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
            error.addClass("invalid-feedback");{{  }}
            element.closest(".validation-container").append(error);{{  }}
        },
        submitHandler: function (form) {

            var time = document.getElementById("time").innerText;

            if(time == "00:00") {
                swal.fire({
                    title: "Kode OTP Telah Expired",
                    text: "Silakan Resend Code OTP Anda",
                    icon: "error",
                    timer: 2e3,
                    showConfirmButton: false,
                });
            } else {

                var token = $('#csrf').val();
    
    
                var data = {
                    "_token": token,
                    "email": email
                }
    
                $.ajax({
                    url: "/konfirmasi-password",
                    type: 'GET',
                    data: data,
                    success: function(response) {
                        swal.fire({
                            title: "Kode OTP Telah Diverifikasi",
                            text: "Silakan Buat Password Baru",
                            icon: "success",
                            timer: 2e3,
                            showConfirmButton: false,
                        });

                        // sessionStorage.setItem("responseemail_2", response)
                        // console.log(response);
                        // setCookie("code", )
                        // console.log(response);
                        location.href = "/konfirmasi-password"
                        
    
                    }
                   
                   
                });



            }
        }
    });

    
    $('#valid_email').validate({
        rules: {
            email: {
                required: true,
                email: true,
                remote: {
                    url: "/checkEmail",
                    type: "post",
                    data: {
                        _token: token,
                    }
                }

            }
        },
        messages: {
            email: {
                required: "Silakan Isi Email",
                email: "Masukkan Valid Email",
                remote: "Email yang dimasukkan belum terdaftar"
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
            error.addClass("invalid-feedback");
            element.closest(".validation-container").append(error);
        },
        submitHandler: function (form) {
            document.getElementById("loading").style.cursor = "wait";
            document.getElementById("btnnext").setAttribute("disabled", true)


            var email = $("#email").val();
            var token = $('#csrf').val();


            var data = {
                "_token": token,
                "email": email
            }

            $.ajax({
                url: "/verifikasi-otp",
                type: 'POST',
                data: data,
                success: function(response) {
                    

                    sessionStorage.setItem("responseemail", response.email)
                    sessionStorage.setItem("responsecode", response.code)
                    // setCookie("code", )
                    // console.log(response);
                    location.href = "/code-verification"
                    

                }
               
               
            });
        }
    });
        

});

var seconds = 0;
var minutes = 3;
function timer()
{
    var time = document.getElementById("time").innerText;
    if(time == "00:00") {
        seconds = 0;
        minutes = 3;
        var timer = setInterval(() => {
    
            if(minutes < 0){
                $('#time').text('00:00');
                clearInterval(timer);
            }
            else{
                let tempMinutes = minutes.toString().length > 1? minutes:'0'+minutes;
                let tempSeconds = seconds.toString().length > 1? seconds:'0'+seconds;
    
                $('#time').text(tempMinutes+':'+tempSeconds);
            }
    
            if(seconds <= 0){
                minutes--;
                seconds = 59;
            }
    
            seconds--;
    
        }, 1000);
    } else {
        var timer = setInterval(() => {
    
            if(minutes < 0){
                $('#time').text('00:00');
                clearInterval(timer);
            }
            else{
                let tempMinutes = minutes.toString().length > 1? minutes:'0'+minutes;
                let tempSeconds = seconds.toString().length > 1? seconds:'0'+seconds;
    
                $('#time').text(tempMinutes+':'+tempSeconds);
            }
    
            if(seconds <= 0){
                minutes--;
                seconds = 59;
            }
    
            seconds--;
    
        }, 1000);
    }

}

timer();

function resend_code() {
    var swal = Swal.mixin({
        customClass: {
            confirmButton: "btn btn-label-success btn-wide mx-1",
            denyButton: "btn btn-label-secondary btn-wide mx-1",
            cancelButton: "btn btn-label-danger btn-wide mx-1",
        },
        buttonsStyling: false,
    });

    document.getElementById("loading").style.cursor = "wait";
    document.getElementById("link_resend").style.pointerEvents = "none";
    document.getElementById("btnnext").setAttribute("disabled", true)


    var email = document.getElementById("email").value;
    var token = document.getElementById("csrf").value;

    $.ajax({
        url: "/verifikasi-ulang-otp",
        type: "post",
        data: {
            email: email,
            _token: token,
        },
        success: function(response) {

            // console.log(response);
            document.getElementById("email").value = response.email;
            var time = document.getElementById("time").innerText;

            document.getElementById("loading").style.removeProperty("cursor");
            document.getElementById("link_resend").style.removeProperty("pointer-events");
            document.getElementById("btnnext").removeAttribute("disabled")


            if(time == "00:00") {
                timer();
            } else {
                minutes = 3;
                seconds = 0;
            }
            swal.fire({
                title: "Kode OTP Telah Dikirim Ulang ke " + response.email,
                text: "Silakan Cek Email Anda",
                icon: "success",
                timer: 2e3,
                showConfirmButton: false,
            });           
        }
    })
}

