"use strict";$(function(){var offset=$(window).width()>=1025?$("#sticky-header-desktop").height():$("#sticky-header-mobile").height();

$("#shipping").DataTable({
    responsive:true,
    fixedHeader:
    {
        header:true,
        headerOffset:
        offset
    }
});



$("#depo").DataTable({
    responsive:true,
    fixedHeader:
    {
        header:true,
        headerOffset:
        offset
    }
});

$("#pol").DataTable({
    responsive:true,
    fixedHeader:
    {
        header:true,
        headerOffset:
        offset
    }
});
$("#pengirim").DataTable({
    responsive:true,
    fixedHeader:
    {
        header:true,
        headerOffset:
        offset
    }
});
$("#penerima").DataTable({
    responsive:true,
    fixedHeader:
    {
        header:true,
        headerOffset:
        offset
    }
});
$("#biaya").DataTable({
    responsive:true,
    fixedHeader:
    {
        header:true,
        headerOffset:
        offset
    }
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


$("#trucking").DataTable({
    responsive:true,
    fixedHeader:
    {
        header:true,
        headerOffset:
        offset
    }
});
$("#table-container").DataTable({
    responsive:true,
    fixedHeader:
    {
        header:true,
        headerOffset:
        offset
    }
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
    }
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

$("#realisasiload_create").DataTable({
    responsive:true,
    "paging": false,
    "info": false,
    "searching": false,
    "scroll" :false,
    fixedHeader: {
        header:true,
        headerOffset:
        offset
    },

});
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

$("#input-seal").DataTable({
    responsive:true,
    fixedHeader:
    {
        header:true,
        headerOffset:
        offset
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
