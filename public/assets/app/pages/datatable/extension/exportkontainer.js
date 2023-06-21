"use strict";
$(function(){
var offset=$(window).width()>=1025?
$("#sticky-header-desktop").height()
:$("#sticky-header-mobile").height();

var vessel = $("#nama_kapal").html()
var vessel_code = $("#kode_kapal").html()
console.log(vessel);
    $("#table_informasi1").DataTable({
        responsive:true,
        stateSave: true,

        fixedHeader:
        {
            header:true,
            headerOffset:offset
        },
        pageLength : 5,
        lengthMenu: [[5, 10, 20, -1], [5, 10, 20, "All"]],
        dom: 'Bfrltip',
        buttons:[
        {
            extend:"excel",
            title: "Informasi Kontainer "+vessel+"/"+vessel_code ,
            className:"btn btn-flat-primary",
            exportOptions: {
                columns: [0,1,2,3,4,5,6,7,8,9,10,11,12,13,14,15],
            }

        },
        {
                extend: 'pdf',
                orientation: 'landscape',
                className:"btn btn-flat-primary",
                className:"btn btn-flat-primary",
                pageSize : 'LEGAL',
                title: "Informasi Kontainer "+vessel+"/"+vessel_code ,
                customize : function(doc){
                    doc.defaultStyle.alignment = 'center';
                    doc.styles.tableHeader.alignment = 'center';
                    doc.styles.tableHeader.fillColor = '#00ad4c';
                    doc.content[1].table.widths = [15,50,50,50,50,50,50,50,50,70,50,50,50,50,50,50];;
                },
                exportOptions: {
                    columns: [0,1,2,3,4,5,6,7,8,9,10,11,12,13,14,15],
                }
            },
        ],


    });
    $("#table_informasi2").DataTable({
        responsive:true,
        stateSave: true,

        fixedHeader:
        {
            header:true,
            headerOffset:offset
        },
        pageLength : 5,
        lengthMenu: [[5, 10, 20, -1], [5, 10, 20, "All"]],
        dom: 'Bfrltip',
        buttons:[
        {
            extend:"excel",
            title: "Informasi Kontainer "+vessel+"/"+vessel_code ,
            className:"btn btn-flat-primary",
            exportOptions: {
                columns: [0,1,2,3,4,5,6,7,8,9,10,11,12,13,14,15],
            }

        },
        {
                extend: 'pdf',
                orientation: 'landscape',
                className:"btn btn-flat-primary",
                className:"btn btn-flat-primary",
                pageSize : 'LEGAL',
                title: "Informasi Kontainer "+vessel+"/"+vessel_code ,
                customize : function(doc){
                    doc.defaultStyle.alignment = 'center';
                    doc.styles.tableHeader.alignment = 'center';
                    doc.styles.tableHeader.fillColor = '#00ad4c';
                    doc.content[1].table.widths = [15,50,50,50,50,50,50,50,50,70,50,50,50,50,50,50];;
                },
                exportOptions: {
                    columns: [0,1,2,3,4,5,6,7,8,9,10,11,12,13,14,15],
                }
            },
        ],


    });

    $("#table_biaya1").DataTable({
        responsive:true,
        stateSave: true,

        pageLength : 5,
        lengthMenu: [[5, 10, 20, -1], [5, 10, 20, "All"]],


    });
    $("#table_biaya2").DataTable({
        responsive:true,
        stateSave: true,


        pageLength : 5,
        lengthMenu: [[5, 10, 20, -1], [5, 10, 20, "All"]],


    });
    $("#table_biaya3").DataTable({
        responsive:true,
        stateSave: true,


        pageLength : 5,
        lengthMenu: [[5, 10, 20, -1], [5, 10, 20, "All"]],


    });
    $("#table_batal_muat").DataTable({
        responsive:true,
        stateSave: true,


        pageLength : 5,
        lengthMenu: [[5, 10, 20, -1], [5, 10, 20, "All"]],


    });
    $("#table_alih_kapal").DataTable({
        responsive:true,
        stateSave: true,


        pageLength : 5,
        lengthMenu: [[5, 10, 20, -1], [5, 10, 20, "All"]],


    });

});
