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

$("#planload").DataTable({
    responsive:true,
    fixedHeader:
    {
        header:true,
        headerOffset:
        offset
    }
});
$("#processload-create").DataTable({
    responsive:true,
    "paging": false,
    "info": false,
    "searching": false,
    fixedHeader: {
        header:true,
        headerOffset:
        offset
    }
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
