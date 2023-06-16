"use strict";$(function(){var offset=$(window).width()>=1025?$("#sticky-header-desktop").height():$("#sticky-header-mobile").height();






$("#shipping").DataTable({
    responsive:true,
    fixedHeader:
    {
        header:true,
        headerOffset:
        offset
    },

    dom: 'Bfrltip',
    buttons:[
    {
        extend:"excel",
        title: 'Data Tabel Pelayaran',
        className:"btn btn-flat-primary",
        exportOptions: {
            columns: [0,1],
        }

    },
    {
            extend:"pdf",
            className:"btn btn-flat-primary",
            title: 'Data Tabel Pelayaran',
            className:"btn btn-flat-primary",
            exportOptions: {
                columns: [0,1],
    }},
    ],
});
$("#data_vendor").DataTable({
    responsive:true,
    fixedHeader:
    {
        header:true,
        headerOffset:
        offset
    },

    dom: 'Bfrltip',
    buttons:[
    {
        extend:"excel",
        title: 'Data Tabel VENDOR MOBIL',
        className:"btn btn-flat-primary",
        exportOptions: {
            columns: [0,1],
        }

    },
    {
            extend:"pdf",
            className:"btn btn-flat-primary",
            title: 'Data VENDOR MOBIL',
            className:"btn btn-flat-primary",
            exportOptions: {
                columns: [0,1],
    }},
    ],
});



$("#depo").DataTable({
    responsive:true,
    fixedHeader:
    {
        header:true,
        headerOffset:
        offset
    },
    dom: 'Bfrltip',
    buttons:[
    {
        extend:"excel",
        title: 'Data Tabel Depo',
        className:"btn btn-flat-primary",
        exportOptions: {
            columns: [0,1],
        }

    },
    {
            extend:"pdf",
            className:"btn btn-flat-primary",
            title: 'Data Tabel Depo',
            className:"btn btn-flat-primary",
            exportOptions: {
                columns: [0,1],
    }},
    ],

});

$("#pol").DataTable({
    responsive:true,
    fixedHeader:
    {
        header:true,
        headerOffset:
        offset
    },

    dom: 'Bfrltip',
    buttons:[
    {
        extend:"excel",
        title: 'Data Tabel Pelabuhan',
        className:"btn btn-flat-primary",
        exportOptions: {
            columns: [0,1,2],
        }

    },
    {
            extend:"pdf",
            className:"btn btn-flat-primary",
            title: 'Data Tabel Pelabuhan',
            className:"btn btn-flat-primary",
            exportOptions: {
                columns: [0,1, 2],
    }},
    ],
});
$("#pengirim_tabel").DataTable({
    responsive:true,
    fixedHeader:
    {
        header:true,
        headerOffset:
        offset
    },

    dom: 'Bfrltip',
    buttons:[
    {
        extend:"excel",
        title: 'Data Tabel Pengirim',
        className:"btn btn-flat-primary",
        exportOptions: {
            columns: [0,1,2,3,4,5,6],
        }

    },
    {
            extend:"pdf",
            className:"btn btn-flat-primary",
            title: 'Data Tabel Pengirim',
            className:"btn btn-flat-primary",
            exportOptions: {
                columns: [0,1,2,3,4,5,6],
            }},
    ],

});
$("#penerima_tabel").DataTable({
    responsive:true,
    fixedHeader:
    {
        header:true,
        headerOffset:
        offset
    },

    dom: 'Bfrltip',
    buttons:[
    {
        extend:"excel",
        title: 'Data Tabel Penerima',
        className:"btn btn-flat-primary",
        exportOptions: {
            columns: [0,1,2,3,4,5,6],
        }

    },
    {
            extend:"pdf",
            className:"btn btn-flat-primary",
            title: 'Data Tabel Penerima',
            className:"btn btn-flat-primary",
            exportOptions: {
                columns: [0,1,2,3,4,5,6],
            }},
    ],


});
$("#biaya").DataTable({
    responsive:true,
    fixedHeader:
    {
        header:true,
        headerOffset:
        offset
    },

    dom: 'Bfrltip',
    buttons:[
    {
        extend:"excel",
        title: 'Data Tabel Biaya',
        className:"btn btn-flat-primary",
        exportOptions: {
            columns: [0,1,2],
        }

    },
    {
            extend:"pdf",
            className:"btn btn-flat-primary",
            title: 'Data Tabel Biaya',
            className:"btn btn-flat-primary",
            exportOptions: {
                columns: [0,1,2],
            }},
    ],


});
$("#realisasi-create").DataTable({
    responsive:true,
    search:false,
    paging:false,
    fixedHeader:
    {
        header:true,
        headerOffset:
        offset
    }
});
// $("#table_alih_kapal").DataTable({
//     responsive:true,
//     search:false,
//     paging:false,
//     fixedHeader:
//     {
//         header:true,
//         headerOffset:
//         offset
//     }
// });


$("#trucking").DataTable({
    responsive:true,
    fixedHeader:
    {
        header:true,
        headerOffset:
        offset
    },

    dom: 'Bfrltip',
    buttons:[
    {
        extend:"excel",
        title: 'Data Tabel Type Container',
        className:"btn btn-flat-primary",
        exportOptions: {
            columns: [0,1],
        }

    },
    {
            extend:"pdf",
            className:"btn btn-flat-primary",
            title: 'Data Tabel Type Container',
            className:"btn btn-flat-primary",
            exportOptions: {
                columns: [0,1],
            }},
    ],
});
$("#table-container").DataTable({
    responsive:true,
    fixedHeader:
    {
        header:true,
        headerOffset:
        offset
    },

    dom: 'Bfrltip',
    buttons:[
    {
        extend:"excel",
        title: 'Data Tabel size Container',
        className:"btn btn-flat-primary",
        exportOptions: {
            columns: [0,1],
        }

    },
    {
            extend:"pdf",
            className:"btn btn-flat-primary",
            title: 'Data Tabel Size Container',
            className:"btn btn-flat-primary",
            exportOptions: {
                columns: [0,1],
            }},
    ],
});
$("#kegiatan-stuffing").DataTable({
    responsive:true,
    fixedHeader:
    {
        header:true,
        headerOffset:
        offset
    }
});
$("#kegiatan-stripping").DataTable({
    responsive:true,
    fixedHeader:
    {
        header:true,
        headerOffset:
        offset
    },

    dom: 'Bfrltip',
    buttons:[
    {
        extend:"excel",
        title: 'Data Tabel Kegiatan',
        className:"btn btn-flat-primary",
        exportOptions: {
            columns: [0,1,2],
        }

    },
    {
            extend:"pdf",
            className:"btn btn-flat-primary",
            title: 'Data Tabel Kegiatan',
            className:"btn btn-flat-primary",
            exportOptions: {
                columns: [0,1,2],
            }},
    ],
});



$('#filter_company').on("change", function(event) {
    var status = $('#filter_company').val();
    planload.columns(3).search(status).draw();
});
$('#filter_vessel').on("change", function(event) {
    var status = $('#filter_vessel').val();
    planload.columns(4).search(status).draw();
});


// $("#processload_create").DataTable({
//     // responsive : true,
//     "paging": false,
//     "info": false,
//     "searching": false,
//     fixedHeader: {
//         header:true,
//         headerOffset:
//         offset
//     },
//     scrollY:300,
//     scrollX:true,
//     scrollCollapse:true,
//     fixedColumns:{
//         leftColumns:3
//     }
// });

// $("#realisasiload_create").DataTable({
//     responsive:true,
//     pageLength : 2,
//     lengthMenu: [[5, 10, 20, -1], [5, 10, 20, "All"]],
//     fixedHeader: {
//         header:true,
//         headerOffset:
//         offset
//     },

// });
$("#table_alih_kapal_realisasi").DataTable({
    responsive:true,
    "paging": false,
    "info": false,
    "searching": false,
    fixedHeader: {
        header:true,
        headerOffset:
        offset
    },

});
// $("#planload").DataTable({
//     responsive:true,
//     dom:"\n <'row'<'col-12'P>>\n <'row'<'col-sm-12 col-md-6'l> <'col-sm-12 col-md-6'f>>\n <'row'<'col-12'tr>>\n <'row'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7'p>>\n ",
//     searchPanes: {
//         cascadePanes:true,
//         viewTotal:true},
//     language:{
//         searchPanes:{
//             count:"{total} found",
//             countFiltered:"{shown} / {total}"
//     }}
// });

var spk = $("#input-seal").DataTable({
    responsive:true,
    fixedHeader:
    {
        header:true,
        headerOffset:
        offset
    }
});


$('#filter_pelayaran').on("change", function(event) {
    var pelayaran = $('#filter_pelayaran').val();
    console.log(pelayaran);
    if (pelayaran == null) {

        spk.columns(1).search('').draw();
    }
    else{

        spk.columns(1).search(pelayaran).draw();
    }

});

$("#datatable-2").DataTable({
    responsive:true,
    fixedHeader:
    {
        header:true,
        footer:true,
        headerOffset:offset
    }
})
});
