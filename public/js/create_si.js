
function pdf_si() {
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
        position: "top-end", showConfirmButton: false,
        timer: 3e3,
        timerProgressBar: true,
        didOpen: function didOpen(toast) {
            toast.addEventListener("mouseenter", Swal.stopTimer); toast.addEventListener("mouseleave", Swal.resumeTimer)
        }
    });

    $("#valid_realisasi").validate({
        ignore: "select[type=hidden]",
        rules: {
            letter: {
                required: true
            },
        },
        messages: {

            letter: {
                required: "Silakan Pilih Minimal 1 Container"
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
            var chek_container = $('.check-container:checked').map(function() {
                return this.value;
            }).get();

            var old_slug = $('#old_slug').val();

            var d = new Date(),
            dformat = [
                d.getFullYear(),
                d.getMonth()+1,
                d.getDate(),
                d.getHours(),
                d.getMinutes(),
                d.getSeconds(),
            ].join('-');

            console.log(chek_container);

            swal.fire({
                title: " Buat SI Untuk Job Load ini?",
                text: "Silahkan Periksa Semua Data yang ada Sebelum Membuat Shipping Container (SI).",
                icon: "question",
                showCancelButton: true,
                confirmButtonText: "Iya",
                cancelButtonText: "Tidak",
            }).then((willCreate) => {
                if (willCreate.isConfirmed) {
                    $('#modal-si').modal('show');


                    $('#valid_si').validate({
                        rules: {

                            shipper: {
                                required: true
                            },
                            consigne: {
                                required: true
                            },

                        },
                        messages: {

                            shipper: {
                                required: "Silakan Isi SHIPPER"
                            },
                            consigne: {
                                required: "Silakan Isi CONSIGNE"
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

                        },
                        submitHandler: function (form) {

                            document.getElementById('loading-wrapper').style.cursor = "wait";
                            document.getElementById('btnFinish').setAttribute('disabled', true);
                            var shipper = $('#shipper').val();
                            var consigne = $('#consigne').val();
                            // var slug_container = $('#slug_container').val();

                            var size = [];
                            var type = []
                            var nomor_kontainer = []
                            var cargo = []
                            var seal = []
                            for (var i = 0; i < chek_container.length; i++) {
                                size[i] = document.getElementById("size[" + chek_container[i] + "]").innerText;
                                type[i] = document.getElementById("type[" + chek_container[i] + "]").innerText;
                                nomor_kontainer[i] = document.getElementById("nomor_kontainer[" + chek_container[i] + "]").innerText;
                                cargo[i] = document.getElementById("cargo[" + chek_container[i] + "]").innerText;
                                seal[i] = document.getElementById("seal[" + chek_container[i] + "]").innerText;
                            }
                            var data = {
                                "_token": token,
                                'chek_container': chek_container,
                                'old_slug': old_slug,
                                'shipper': shipper,
                                'consigne': consigne,
                                'type': type,
                                'size': size,
                                'nomor_kontainer': nomor_kontainer,
                                'cargo': cargo,
                                'seal': seal,
                            };
                            // console.log(data);

                            $.ajax({
                                type: "POST",
                                url: '/create-si-container',
                                data: data,
                                xhrFields: {
                                    responseType: 'blob'
                                },
                                success: function (response) {
                                    // console.log(response);
                                    toast.fire({
                                        icon: "success",
                                        title: "SI Berhasil Dibuat"
                                    })
                                    var blob = new Blob([response]);
                                    var link = document.createElement('a');
                                    link.href = window.URL.createObjectURL(blob);
                                    link.download = ""+old_slug+dformat+".pdf";
                                    link.click();

                                    setTimeout(function(){
                                        window.location.reload();
                                    }, 10);


                                }
                            });

                        }


                    });

                } else {
                    swal.fire({
                        title: "SI Tidak Dibuat",
                        // text: "Data Batal Dihapus",
                        icon: "error",
                        timer: 2e3,
                        showConfirmButton: false
                    });
                }
            });



            // for (let i = 0; i < chek_container.length; i++) {
            //     volume[i] = document.getElementById("volume[" + item_id[i] + "]").value;


            // }
        }

    });



}


function approve_si(ini) {

    var swal = Swal.mixin({
        customClass: {
            confirmButton: "btn btn-label-success btn-wide mx-1",
            denyButton: "btn btn-label-secondary btn-wide mx-1",
            cancelButton: "btn btn-label-danger btn-wide mx-1",
        },
        buttonsStyling: false,
    });

    var terima = "Disetujui";
    let token = $("#csrf").val();

    var container_id = ini.value;
    var data = {
        "_token": token,
        'terima': terima,
        'container_id': container_id
    };

    if (terima == "Disetujui") {
        swal.fire({
                title: "Apakah anda yakin Ingin APPROVE SI ini?",
                text: "Setelah SI disetujui, Anda tidak dapat menolak SI ini lagi!",
                icon: "question",
                showCancelButton: true,
                confirmButtonText: "Iya",
                cancelButtonText: "Tidak",
            })
            .then((willCreate) => {
                if (willCreate.isConfirmed) {
                    $.ajax({
                        type: 'POST',
                        url: '/konfirmasi-si',
                        data: data,
                        success: function(response) {
                            swal.fire({
                                    title: "SI Diapprove",
                                    text: "SI Telah Diapprove",
                                    icon: "success",
                                    timer: 2e3,
                                    showConfirmButton: false
                                })
                                .then((result) => {
                                    window.location.reload();
                                });
                        }
                    });
                } else {
                    swal.fire({
                        title: "SI Belum Diapprove",
                        text: "Silakan Perhatikan SI Lagi Sebelum Diapprove",
                        icon: "warning",
                        timer: 2e3,
                        showConfirmButton: false
                    });
                }
            });
    }






}
function tolak_si(ini) {

    var swal = Swal.mixin({
        customClass: {
            confirmButton: "btn btn-label-success btn-wide mx-1",
            denyButton: "btn btn-label-secondary btn-wide mx-1",
            cancelButton: "btn btn-label-danger btn-wide mx-1",
        },
        buttonsStyling: false,
    });

    var terima = "Ditolak";
    let token = $("#csrf").val();

    var container_id = ini.value;
    var data = {
        "_token": token,
        'terima': terima,
        'container_id': container_id
    };

    if (terima == "Ditolak") {
        swal.fire({
                title: "Apakah anda yakin ingin MENOLAK SI ini?",
                text: "Setelah SI ditolak, Anda tidak dapat menyetujui SI ini lagi!",
                icon: "question",
                showCancelButton: true,
                confirmButtonText: "Iya",
                cancelButtonText: "Tidak",
            })
            .then((willCreate) => {
                if (willCreate.isConfirmed) {
                    $.ajax({
                        type: 'POST',
                        url: '/konfirmasi-si',
                        data: data,
                        success: function(response) {
                            swal.fire({
                                    title: "SI Ditolak",
                                    text: "SI Telah Ditolak",
                                    icon: "error",
                                    timer: 2e3,
                                    showConfirmButton: false
                                })
                                .then((result) => {
                                    window.location.reload();
                                });
                        }
                    });
                } else {
                    swal.fire({
                        title: "SI Belum Ditolak",
                        text: "Silakan Perhatikan SI Lagi Sebelum Ditolak",
                        icon: "warning",
                        timer: 2e3,
                        showConfirmButton: false
                    });
                }
            });
    }






}

function detail(e) {
    let id = e.value;
    console.log(id);

    $.ajax({
        url: '/detail-kontainer/' + id + '/input',
        type: 'GET',
        success: function (response) {

            let new_id = id;
            console.log(new_id);


            var seals = [""];

            for (let i = 0; i < response.seal_containers.length; i++) {
                seals[i] = response.seal_containers[i].seal_kontainer;

            }
            console.log(seals);
            $('#modal-job').modal('show');

            $('#size').val(response.result.size);
            $('#type').val(response.result.type);
            $('#nomor_kontainer').val(response.result.nomor_kontainer);
            $('#cargo').val(response.result.cargo);
            $('#detail_barang').val(response.result.detail_barang);
            $('#seal').val(seals).select2({
                dropdownAutoWidth:true,
                placeholder:"Silahkan Seal",
                // allowClear:true,
                maximumSelectionLength: 4,
                dropdownParent: $('#modal-job')

            }).on("select2:select", function (e) {
                var selected_element = $(e.currentTarget);
                var select_val = selected_element.val();
            });
            $('#date_activity').val(response.result.date_activity);
            $('#lokasi').val(response.result.lokasi_depo).select2({
                dropdownAutoWidth:true,
                placeholder:"Silahkan Pilih",
                allowClear:true,
                dropdownParent: $('#modal-job')

            });
            // .on("select2:select", function (e) {
            //     var selected_element = $(e.currentTarget);
            //     var select_val = selected_element.val();
            // });
            $('#driver').val(response.result.driver);
            $('#new_id').val(response.result.id);
            $('#nomor_polisi').val(response.result.nomor_polisi);
            $('#remark').val(response.result.remark);
            $('#biaya_stuffing').val(response.result.biaya_stuffing);
            $('#biaya_trucking').val(response.result.biaya_trucking);
            $('#biaya_thc').val(response.result.biaya_thc);
            $('#jenis_mobil').val(response.result.jenis_mobil);
            $('#dana').val(response.result.dana).select2({
                dropdownAutoWidth:true,
                placeholder:"Silahkan Pilih Deposit Trucking",
                allowClear:true,
                dropdownParent: $('#modal-job')

            });;

            $('#valid_job').validate({
                ignore: "select[type=hidden]",

                rules: {

                    size: {
                        required: true
                    },

                },
                messages: {

                    size: {
                        required: "Silakan Pilih Size"
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

                    var new_id = document.getElementById("new_id").value;
                    console.log(new_id);;
                    var token = $('#csrf').val();

                    let date_activity = document.getElementById("date_activity").value;
                    var tempDate;
                    var formattedDate;

                    tempDate = new Date(date_activity);
                    formattedDate = [
                        tempDate.getFullYear(),
                        tempDate.getMonth() + 1,
                        tempDate.getDate(),
                    ].join("-");

                    $.ajax({
                        url: '/detail-kontainer-update/' + new_id,
                        type: 'PUT',
                        data: {
                            "_token": token,
                            job_id: $('#job_id').val(),
                            size: $('#size').val(),
                            type: $('#type').val(),
                            nomor_kontainer: $('#nomor_kontainer').val(),
                            cargo: $('#cargo').val(),
                            detail_barang: $('#detail_barang').val(),
                            seal: $('#seal').val(),
                            date_activity: formattedDate,
                            lokasi: $('#lokasi').val(),
                            driver: $('#driver').val(),
                            nomor_polisi: $('#nomor_polisi').val(),
                            remark: $('#remark').val(),
                            biaya_stuffing: $('#biaya_stuffing').val().replace(/\./g, ""),
                            biaya_trucking: $('#biaya_trucking').val().replace(/\./g, ""),
                            ongkos_supir: $('#ongkos_supir').val().replace(/\./g, ""),
                            biaya_thc: $('#biaya_thc').val().replace(/\./g, ""),
                            jenis_mobil: $('#jenis_mobil').val(),
                            dana: $('#dana').val(),
                        },
                        success: function (response) {
                            swal.fire({
                                icon: "success",
                                title: "Detail Kontainer Berhasil Diinput",
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

