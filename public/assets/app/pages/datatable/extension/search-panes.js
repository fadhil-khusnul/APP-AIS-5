"use strict";$(function(){
    $("#planload").DataTable({responsive:true,dom:"\n      <'row'<'col-12'P>>\n      <'row'<'col-sm-12 col-md-6'l><'col-sm-12 col-md-6'f>>\n      <'row'<'col-12'tr>>\n      <'row'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7'p>>\n    ",searchPanes:{cascadePanes:true,viewTotal:true},language:{searchPanes:{count:"{total} found",countFiltered:"{shown} / {total}"}}})

    // $("#planload").DataTable({
    //     responsive:true,
    //     dom:"\n      <'row'<'col-12'P>>\n      <'row'<'col-sm-12 col-md-6'l><'col-sm-12 col-md-6'f>>\n      <'row'<'col-12'tr>>\n      <'row'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7'p>>\n    ",
    //     searchPanes: {cascadePanes:true,viewTotal:true},
    //     language:{searchPanes:{
    //         count:"{total} found",
    //         countFiltered:"{shown} / {total}"
    //     }}
    // });
});
