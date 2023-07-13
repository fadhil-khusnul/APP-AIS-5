

var vessel = $("#nama_kapal").html()
var vessel_code = $("#kode_kapal").html()
var  table_informasi1 =   $("#table_informasi1").DataTable({
        responsive:true,

        fixedHeader:
        {
            header:true,

        },
        pageLength : 5,
        lengthMenu: [[5, 10, 20, -1], [5, 10, 20, "All"]],
        dom: 'Bfrltip',
        buttons:[
        {
            extend:"excel",
            title: "Informasi Kontainer "+vessel+"/"+vessel_code ,
            className:"btn btn-flat-success",
            exportOptions: {
                columns: [0,1,2,3,4,5,6,7,8,9,10,11,12,13,14,15],
            }

        },
        {
                extend: 'pdf',
                orientation: 'landscape',
                className:"btn btn-flat-success",
                className:"btn btn-flat-success",
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
var table_informasi2 = $("#table_informasi2").DataTable({
        responsive:true,

        fixedHeader:
        {
            header:true,

        },
        pageLength : 5,
        lengthMenu: [[5, 10, 20, -1], [5, 10, 20, "All"]],
        dom: 'Bfrltip',
        buttons:[
        {
            extend:"excel",
            title: "Informasi Kontainer "+vessel+"/"+vessel_code ,
            className:"btn btn-flat-success",
            exportOptions: {
                columns: [0,1,2,3,4,5,6,7,8,9,10,11,12,13,14,15],
            }

        },
        {
                extend: 'pdf',
                orientation: 'landscape',
                className:"btn btn-flat-success",
                className:"btn btn-flat-success",
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


function pilih_pod_if1_fun(val) {
    var filter = [];
    filter = $("#pilih_pod_if1").val();
    console.log(filter);

    if (filter == null) {
        table_informasi1.columns(5).search("").draw();
    } else {
        table_informasi1
            .columns(5)
            .search(filter.join("|"), true, false, true)
            .draw();
    }
}
function pilih_pot_if1_fun(val) {
    var filter = [];
    filter = $("#pilih_pot_if1").val();
    console.log(filter);

    if (filter == null) {
        table_informasi1.columns(6).search("").draw();
    } else {
        table_informasi1
            .columns(6)
            .search(filter.join("|"), true, false, true)
            .draw();
    }
}
function pilih_size_if1_fun(val) {
    var filter = [];
    filter = $("#pilih_size_if1").val();
    console.log(filter);

    if (filter == null) {
        table_informasi1.columns(8).search("").draw();
    } else {
        table_informasi1
            .columns(8)
            .search(filter.join("|"), true, false, true)
            .draw();
    }
}
function pilih_type_if1_fun(val) {
    var filter = [];
    filter = $("#pilih_type_if1").val();
    console.log(filter);

    if (filter == null) {
        table_informasi1.columns(9).search("").draw();
    } else {
        table_informasi1
            .columns(9)
            .search(filter.join("|"), true, false, true)
            .draw();
    }
}
function pilih_size_if2_fun(val) {
    var filter = [];
    filter = $("#pilih_size_if2").val();
    console.log(filter);

    if (filter == null) {
        table_informasi2.columns(2).search("").draw();
    } else {
        table_informasi2
            .columns(2)
            .search(filter.join("|"), true, false, true)
            .draw();
    }
}
function pilih_type_if2_fun(val) {
    var filter = [];
    filter = $("#pilih_type_if2").val();
    console.log(filter);

    if (filter == null) {
        table_informasi2.columns(3).search("").draw();
    } else {
        table_informasi2
            .columns(3)
            .search(filter.join("|"), true, false, true)
            .draw();
    }
}
