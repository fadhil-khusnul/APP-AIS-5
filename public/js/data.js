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


    $('#valid_company').validate({
        rules: {

            nama_company: {
                required: true
            }
        },
        messages: {

            nama_company: {
                required: "Silakan Isi Nama Kompany"
            }
        },
        submitHandler: function (form) {

            var nama_company = $("#nama_company").val();
            var token = $('#csrf').val();


            var data = {
                "_token": token,
                "nama_company": nama_company
            }

            $.ajax({
                type: 'POST',
                url: 'shipping-company',
                data: data,
                success: function (response) {
                    swal.fire({
                        icon: "success",
                        title: "Data Company Berhasil Ditambah",
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

    $('#valid_depo').validate({
        rules: {

            nama_depo: {
                required: true
            }
        },
        messages: {

            nama_depo: {
                required: "Silakan Isi Nama Kompany"
            }
        },
        submitHandler: function (form) {

            var nama_depo = $("#nama_depo").val();
            var token = $('#csrf').val();


            var data = {
                "_token": token,
                "nama_depo": nama_depo
            }

            $.ajax({
                type: 'POST',
                url: 'add-depo',
                data: data,
                success: function (response) {
                    swal.fire({
                        icon: "success",
                        title: "Data Depo Berhasil Ditambah",
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

    $('#valid_pelabuhan').validate({
        rules: {

            area_code: {
                required: true
            },
            nama_pelabuhan: {
                required: true
            }
        },
        messages: {

            area_code: {
                required: "Silakan Isi Area Code"
            },
            nama_pelabuhan: {
                required: "Silakan Isi Nama Pelabuhan"
            }
        },
        submitHandler: function (form) {

            var area_code = $("#area_code").val();
            var nama_pelabuhan = $("#nama_pelabuhan").val();
            var token = $('#csrf').val();


            var data = {
                "_token": token,
                "area_code": area_code,
                "nama_pelabuhan": nama_pelabuhan
            }

            $.ajax({
                type: 'POST',
                url: 'add-pelabuhan',
                data: data,
                success: function (response) {
                    swal.fire({
                        icon: "success",
                        title: "Data Pelabuhan Berhasil Ditambah",
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

    $('#valid_pengirim').validate({
        rules: {

            alamat: {
                required: true
            },
            nama_costumer: {
                required: true
            },
            email: {
                required: true
            },
            no_telp: {
                required: true
            },
            rekening: {
                required: true
            },
        },
        messages: {

            alamat: {
                required: "Silakan Isi Alamat"
            },
            nama_costumer: {
                required: "Silakan Isi Nama costumer"
            },
            email: {
                required: "Silakan Isi email"
            },
            no_telp: {
                required: "Silakan Isi no. telp"
            },
            rekening: {
                required: "Silakan Isi rekening"
            },
        },
        submitHandler: function (form) {

            var alamat = $("#alamat").val();
            var nama_costumer = $("#nama_costumer").val();
            var email = $("#email").val();
            var no_telp = $("#no_telp").val();
            var rekening = $("#rekening").val();
            var token = $('#csrf').val();


            var data = {
                "_token": token,
                "alamat": alamat,
                "nama_costumer": nama_costumer,
                "email": email,
                "no_telp": no_telp,
                "rekening": rekening,
            }

            $.ajax({
                type: 'POST',
                url: 'add-pengirim',
                data: data,
                success: function (response) {
                    swal.fire({
                        icon: "success",
                        title: "Data pengirim Berhasil Ditambah",
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

    $('#valid_penerima').validate({
        rules: {

            alamat_penerima: {
                required: true
            },
            nama_penerima: {
                required: true
            },
            email_penerima: {
                required: true
            },
            no_telp_penerima: {
                required: true
            },
            rekening_penerima: {
                required: true
            },
        },
        messages: {

            alamat_penerima: {
                required: "Silakan Isi Alamat"
            },
            nama_penerima: {
                required: "Silakan Isi Nama costumer"
            },
            email_penerima: {
                required: "Silakan Isi email"
            },
            no_telp_penerima: {
                required: "Silakan Isi no. telp"
            },
            rekening_penerima: {
                required: "Silakan Isi Rekening"
            },
        },
        submitHandler: function (form) {

            var alamat_penerima = $("#alamat_penerima").val();
            var nama_penerima = $("#nama_penerima").val();
            var email_penerima = $("#email_penerima").val();
            var no_telp_penerima = $("#no_telp_penerima").val();
            var rekening_penerima = $("#rekening_penerima").val();
            var token = $('#csrf').val();


            var data = {
                "_token": token,
                "alamat_penerima": alamat_penerima,
                "nama_penerima": nama_penerima,
                "email_penerima": email_penerima,
                "no_telp_penerima": no_telp_penerima,
                "rekening_penerima": rekening_penerima,
            }

            $.ajax({
                type: 'POST',
                url: 'add-penerima',
                data: data,
                success: function (response) {
                    swal.fire({
                        icon: "success",
                        title: "Data penerima Berhasil Ditambah",
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

    $('#valid_biaya').validate({
        rules: {

            pekerjaan_biaya: {
                required: true
            },
            biaya_cost: {
                required: true
            }
        },
        messages: {

            pekerjaan_biaya: {
                required: "Silakan Isi Pekerjaan"
            },
            biaya_cost: {
                required: "Silakan Isi Biaya"
            }
        },
        submitHandler: function (form) {

            var pekerjaan_biaya = $("#pekerjaan_biaya").val();
            var biaya_cost = $("#biaya_cost").val();
            var token = $('#csrf').val();


            var data = {
                "_token": token,
                "pekerjaan_biaya": pekerjaan_biaya,
                "biaya_cost": biaya_cost
            }

            $.ajax({
                type: 'POST',
                url: 'add-biaya',
                data: data,
                success: function (response) {
                    swal.fire({
                        icon: "success",
                        title: "Data Biaya Berhasil Ditambah",
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

    $('#valid_type').validate({
        rules: {

            type_container: {
                required: true
            },

        },
        messages: {

            type_container: {
                required: "Silakan Masukkan Type Container"
            },

        },
        submitHandler: function (form) {

            var type_container = $("#type_container").val();
            var token = $('#csrf').val();


            var data = {
                "_token": token,
                "type_container": type_container,
            }

            $.ajax({
                type: 'POST',
                url: 'add-type',
                data: data,
                success: function (response) {
                    swal.fire({
                        icon: "success",
                        title: "Data Type Berhasil Ditambah",
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

    $('#valid_container').validate({
        rules: {


            size_container: {
                required: true
            },

        },
        messages: {


            size_container: {
                required: "Silakan Isi Size"
            },

        },
        submitHandler: function (form) {

            // var jenis_container = $("#jenis_container").val();
            var size_container = $("#size_container").val();
            // var type_container = $("#type_container").val();
            var token = $('#csrf').val();


            var data = {
                "_token": token,
                // "jenis_container": jenis_container,
                "size_container": size_container,
                // "type_container": type_container,
            }

            $.ajax({
                type: 'POST',
                url: 'add-container',
                data: data,
                success: function (response) {
                    swal.fire({
                        icon: "success",
                        title: "Data Container Berhasil Ditambah",
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

    $('#valid_stuffing').validate({
        rules: {

            kegiatan_stuffing: {
                required: true
            },

        },
        messages: {

            kegiatan_stuffing: {
                required: "Silakan Isi Kegiatan"
            },

        },
        submitHandler: function (form) {

            var kegiatan_stuffing = $("#kegiatan_stuffing").val();
            var token = $('#csrf').val();



            var data = {
                "_token": token,
                "kegiatan_stuffing": kegiatan_stuffing,
            }

            $.ajax({
                type: 'POST',
                url: 'add-stuffing',
                data: data,
                success: function (response) {
                    swal.fire({
                        icon: "success",
                        title: "Data Stuffing Berhasil Ditambah",
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

    $('#valid_stripping').validate({
        rules: {

            kegiatan_stripping: {
                required: true
            },

        },
        messages: {

            kegiatan_stripping: {
                required: "Silakan Isi Kegiatan"
            },

        },
        submitHandler: function (form) {

            var kegiatan_stripping = $("#kegiatan_stripping").val();
            var token = $('#csrf').val();



            var data = {
                "_token": token,
                "kegiatan_stripping": kegiatan_stripping,
            }

            $.ajax({
                type: 'POST',
                url: 'add-stripping',
                data: data,
                success: function (response) {
                    swal.fire({
                        icon: "success",
                        title: "Data stripping Berhasil Ditambah",
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

function editDepo(e) {
    var id = e.value;
    console.log(id);


    $.ajax({
        url: 'depo/' + id + '/edit',
        type: 'GET',
        success: function (response) {
            $('#modal-depo-edit').modal('show');

            $('#nama_depo_edit').val(response.result.nama_depo);

            $('#valid_depo_edit').validate({
                rules: {

                    nama_depo_edit: {
                        required: true
                    },

                },
                messages: {

                    nama_depo_edit: {
                        required: "Silakan Isi Nama Depo"
                    },

                },

                // console.log();
                submitHandler: function (form) {
                    var token = $('#csrf').val();

                    $.ajax({
                        url: 'depo/' + id,
                        type: 'PUT',
                        data: {
                            "_token": token,
                            nama_depo: $('#nama_depo_edit').val(),
                        },
                        success: function (response) {
                            swal.fire({
                                icon: "success",
                                title: "Data Depo Berhasil Diedit",
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

function editpelabuhan(e) {
    var id = e.value;
    console.log(id);


    $.ajax({
        url: 'pelabuhan/' + id + '/edit',
        type: 'GET',
        success: function (response) {
            $('#modal-pelabuhan-edit').modal('show');

            $('#area_code_edit').val(response.result.area_code);
            $('#nama_pelabuhan_edit').val(response.result.nama_pelabuhan);

            $('#valid_pelabuhan_edit').validate({
                rules: {

                    area_code_edit: {
                        required: true
                    },
                    nama_pelabuhan_edit: {
                        required: true
                    },

                },
                messages: {

                    area_code_edit: {
                        required: "Silakan Isi Area Code"
                    },
                    nama_pelabuhan_edit: {
                        required: "Silakan Isi Nama Depo"
                    },

                },

                // console.log();
                submitHandler: function (form) {
                    var token = $('#csrf').val();

                    $.ajax({
                        url: 'pelabuhan/' + id,
                        type: 'PUT',
                        data: {
                            "_token": token,
                            area_code: $('#area_code_edit').val(),
                            nama_pelabuhan: $('#nama_pelabuhan_edit').val(),
                        },
                        success: function (response) {
                            swal.fire({
                                icon: "success",
                                title: "Data Pelabuhan Berhasil Diedit",
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

function editpengirim(e) {
    var id = e.value;
    console.log(id);


    $.ajax({
        url: 'pengirim/' + id + '/edit',
        type: 'GET',
        success: function (response) {
            $('#modal-pengirim-edit').modal('show');

            $('#nama_costumer_edit').val(response.result.nama_costumer);
            $('#alamat_edit').val(response.result.alamat);
            $('#email_edit').val(response.result.email);
            $('#no_telp_edit').val(response.result.no_telp);
            $('#rekening_edit').val(response.result.rekening);

            $('#valid_pengirim_edit').validate({
                rules: {

                    nama_costumer_edit: {
                        required: true
                    },
                    alamat_edit: {
                        required: true
                    },
                    email_edit: {
                        required: true
                    },
                    no_telp_edit: {
                        required: true
                    },
                    rekening_edit: {
                        required: true
                    },

                },
                messages: {

                    nama_costumer_edit: {
                        required: "Silakan Isi Nama Costumer"
                    },
                    alamat_edit: {
                        required: "Silakan Isi Alamat"
                    },
                    email_edit: {
                        required: "Silakan Isi Email"
                    },
                    no_telp_edit: {
                        required: "Silakan Isi No. Telp"
                    },
                    rekening_edit: {
                        required: "Silakan Isi No. Rekening"
                    },

                },

                // console.log();
                submitHandler: function (form) {
                    var token = $('#csrf').val();

                    $.ajax({
                        url: 'pengirim/' + id,
                        type: 'PUT',
                        data: {
                            "_token": token,
                            nama_costumer: $('#nama_costumer_edit').val(),
                            alamat: $('#alamat_edit').val(),
                            email: $('#email_edit').val(),
                            no_telp: $('#no_telp_edit').val(),
                            rekening: $('#rekening_edit').val(),
                        },
                        success: function (response) {
                            swal.fire({
                                icon: "success",
                                title: "Data Pengirim Berhasil Diedit",
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

function editpenerima(e) {
    var id = e.value;
    console.log(id);


    $.ajax({
        url: 'penerima/' + id + '/edit',
        type: 'GET',
        success: function (response) {
            $('#modal-penerima-edit').modal('show');

            $('#nama_penerima_edit').val(response.result.nama_penerima);
            $('#alamat_penerima_edit').val(response.result.alamat_penerima);
            $('#email_penerima_edit').val(response.result.email_penerima);
            $('#no_telp_penerima_edit').val(response.result.no_telp_penerima);
            $('#rekening_penerima_edit').val(response.result.rekening_penerima);

            $('#valid_penerima_edit').validate({
                rules: {

                    nama_penerima_edit: {
                        required: true
                    },
                    alamat_penerima_edit: {
                        required: true
                    },
                    email_penerima_edit: {
                        required: true
                    },
                    no_telp_penerima_edit: {
                        required: true
                    },
                    rekening_penerima_edit: {
                        required: true
                    },

                },
                messages: {

                    nama_penerima_edit: {
                        required: "Silakan Isi Nama Costumer"
                    },
                    alamat_penerima_edit: {
                        required: "Silakan Isi Alamat"
                    },
                    email_penerima_edit: {
                        required: "Silakan Isi Email"
                    },
                    no_telp_penerima_edit: {
                        required: "Silakan Isi No. Telp"
                    },
                    rekening_penerima_edit: {
                        required: "Silakan Isi No. Rekening"
                    },

                },

                // console.log();
                submitHandler: function (form) {
                    var token = $('#csrf').val();

                    $.ajax({
                        url: 'penerima/' + id,
                        type: 'PUT',
                        data: {
                            "_token": token,
                            nama_penerima: $('#nama_penerima_edit').val(),
                            alamat_penerima: $('#alamat_penerima_edit').val(),
                            email_penerima: $('#email_penerima_edit').val(),
                            no_telp_penerima: $('#no_telp_penerima_edit').val(),
                            rekening_penerima: $('#rekening_penerima_edit').val(),
                        },
                        success: function (response) {
                            swal.fire({
                                icon: "success",
                                title: "Data Penerima Berhasil Diedit",
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

function editbiaya(e) {
    var id = e.value;
    console.log(id);


    $.ajax({
        url: 'biaya/' + id + '/edit',
        type: 'GET',
        success: function (response) {
            $('#modal-biaya-edit').modal('show');

            $('#pekerjaan_biaya_edit').val(response.result.pekerjaan_biaya);
            $('#biaya_cost_edit').val(response.result.biaya_cost);

            $('#valid_biaya_edit').validate({
                rules: {

                    pekerjaan_biaya_edit: {
                        required: true
                    },
                    biaya_cost_edit: {
                        required: true
                    },

                },
                messages: {

                    pekerjaan_biaya_edit: {
                        required: "Silakan Isi Pekerjaan"
                    },
                    biaya_cost_edit: {
                        required: "Silakan Isi Biaya"
                    },

                },

                // console.log();
                submitHandler: function (form) {
                    var token = $('#csrf').val();

                    $.ajax({
                        url: 'biaya/' + id,
                        type: 'PUT',
                        data: {
                            "_token": token,
                            pekerjaan_biaya: $('#pekerjaan_biaya_edit').val(),
                            biaya_cost: $('#biaya_cost_edit').val(),
                        },
                        success: function (response) {
                            swal.fire({
                                icon: "success",
                                title: "Data Biaya Berhasil Diedit",
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

function edittype(e) {
    var id = e.value;
    console.log(id);


    $.ajax({
        url: 'type/' + id + '/edit',
        type: 'GET',
        success: function (response) {
            $('#modal-type-edit').modal('show');

            $('#type_container_edit').val(response.result.type_container);

            $('#valid_type_edit').validate({
                rules: {

                    type_container_edit: {
                        required: true
                    },


                },
                messages: {

                    type_container_edit: {
                        required: "Silakan Isi Type Container"
                    },


                },

                // console.log();
                submitHandler: function (form) {
                    var token = $('#csrf').val();

                    $.ajax({
                        url: 'type/' + id,
                        type: 'PUT',
                        data: {
                            "_token": token,
                            type_container: $('#type_container_edit').val(),
                        },
                        success: function (response) {
                            swal.fire({
                                icon: "success",
                                title: "Data Type Container Berhasil Diedit",
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

function editstuff(e) {
    var id = e.value;
    console.log(id);


    $.ajax({
        url: 'stuffing/' + id + '/edit',
        type: 'GET',
        success: function (response) {
            $('#modal-load-edit').modal('show');

            $('#kegiatan_stuffing_edit').val(response.result.kegiatan_stuffing);

            $('#valid_stuffing_edit').validate({
                rules: {

                    kegiatan_stuffing_edit: {
                        required: true
                    },

                },
                messages: {

                    kegiatan_stuffing_edit: {
                        required: "Silakan Isi Nama Kegiatan"
                    },

                },

                // console.log();
                submitHandler: function (form) {
                    var token = $('#csrf').val();

                    $.ajax({
                        url: 'stuffing/' + id,
                        type: 'PUT',
                        data: {
                            "_token": token,
                            kegiatan_stuffing: $('#kegiatan_stuffing_edit').val(),
                        },
                        success: function (response) {
                            swal.fire({
                                icon: "success",
                                title: "Data Stuffing Berhasil Diedit",
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

function editstripp(e) {
    var id = e.value;
    console.log(id);


    $.ajax({
        url: 'stripping/' + id + '/edit',
        type: 'GET',
        success: function (response) {
            $('#modal-discharge-edit').modal('show');

            $('#kegiatan_stripping_edit').val(response.result.kegiatan_stripping);

            $('#valid_stripping_edit').validate({
                rules: {

                    kegiatan_stripping_edit: {
                        required: true
                    },

                },
                messages: {

                    kegiatan_stripping_edit: {
                        required: "Silakan Isi Nama Kegiatan"
                    },

                },

                // console.log();
                submitHandler: function (form) {
                    var token = $('#csrf').val();

                    $.ajax({
                        url: 'stripping/' + id,
                        type: 'PUT',
                        data: {
                            "_token": token,
                            kegiatan_stripping: $('#kegiatan_stripping_edit').val(),
                        },
                        success: function (response) {
                            swal.fire({
                                icon: "success",
                                title: "Data stripping Berhasil Diedit",
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

function editcontainer(e) {
    var id = e.value;
    console.log(id);


    $.ajax({
        url: 'container/' + id + '/edit',
        type: 'GET',
        success: function (response) {
            $('#modal-container-edit').modal('show');

            // $('#jenis_container_edit').val(response.result.jenis_container);
            $('#size_container_edit').val(response.result.size_container);
            // $('#type_container_edit').val(response.result.type_container);

            $('#valid_container_edit').validate({
                rules: {

                    // jenis_container_edit: {
                    //     required: true
                    // },
                    size_container_edit: {
                        required: true
                    },
                    // type_container_edit: {
                    //     required: true
                    // },

                },
                messages: {

                    // jenis_container_edit: {
                    //     required: "Silakan Isi Container"
                    // },
                    size_container_edit: {
                        required: "Silakan Isi Size Container"
                    },
                    // type_container_edit: {
                    //     required: "Silakan Isi Type"
                    // },

                },

                // console.log();
                submitHandler: function (form) {
                    var token = $('#csrf').val();

                    $.ajax({
                        url: 'container/' + id,
                        type: 'PUT',
                        data: {
                            "_token": token,
                            // jenis_container: $('#jenis_container_edit').val(),
                            size_container: $('#size_container_edit').val(),
                            // type_container: $('#type_container_edit').val(),
                        },
                        success: function (response) {
                            swal.fire({
                                icon: "success",
                                title: "Data Size Container Berhasil Diedit",
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

function deleteDepo(id) {
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
                    url: 'depo/' + deleteid,
                    data: data,
                    success: function (response) {
                        swal.fire({
                            title: "Data Depo Dihapus",
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

function deletepelabuhan(id) {
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
                    url: 'pelabuhan/' + deleteid,
                    data: data,
                    success: function (response) {
                        swal.fire({
                            title: "Data Pelabuhan Dihapus",
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


function deletepengirim(id) {
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
                    url: 'pengirim/' + deleteid,
                    data: data,
                    success: function (response) {
                        swal.fire({
                            title: "Data Pengirim Dihapus",
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

function deletepenerima(id) {
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
                    url: 'penerima/' + deleteid,
                    data: data,
                    success: function (response) {
                        swal.fire({
                            title: "Data Penerima Dihapus",
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

function deletebiaya(id) {
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
                    url: 'biaya/' + deleteid,
                    data: data,
                    success: function (response) {
                        swal.fire({
                            title: "Data Biaya Dihapus",
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
function deletetype(id) {
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
                    url: 'type/' + deleteid,
                    data: data,
                    success: function (response) {
                        swal.fire({
                            title: "Data Type Container Dihapus",
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

function deletecontainer(id) {
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
                    url: 'container/' + deleteid,
                    data: data,
                    success: function (response) {
                        swal.fire({
                            title: "Data Container Dihapus",
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

function deletestuff(id) {
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
                    url: 'stuffing/' + deleteid,
                    data: data,
                    success: function (response) {
                        swal.fire({
                            title: "Data Stuffing Dihapus",
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

function deletestripp(id) {
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
                    url: 'stripping/' + deleteid,
                    data: data,
                    success: function (response) {
                        swal.fire({
                            title: "Data Stripping Dihapus",
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
