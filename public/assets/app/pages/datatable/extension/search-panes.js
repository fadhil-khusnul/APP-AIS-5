"use strict";$(function(){
    $("#planload").DataTable({
        responsive:true,
        // dom: "Bfrtip",
        dom:"\n<'row'<'col-12'P>>\n<'row'<'col-sm-12 col-md-6'l><'col-sm-12 col-md-6'f>>\n<'row'<'col-12'tr>>\n<'row'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7'p>>\n    ",        pageLength: 20,
        // dom : '<"dtsp-verticalContainer"<"dtsp-verticalPanes"P><"dtsp-dataTable"Bfrtip>>',
        // dom: 'BPQlfrtip',
        // "pageLength": 10,
        searchPanes:{
            layout: 'columns-1',
            columns: [1, 3, 4, 5, 6, 7, 8, 9, 10],
            cascadePanes: false,
            viewTotal: true,

          },

        language:{
            searchPanes:{
                count:"{total} found",
                countFiltered:"{shown} / {total}"
            }
        },
        columnDefs:[{
            searchPanes:{
                show: true,
                cascadePanes: false,


            },
            targets: [1, 3, 4, 6, 7, 8],
        }],
    });
    $("#plandischarge").DataTable({
        responsive:true,
        // dom: "Bfrtip",
        dom:"\n<'row'<'col-12'P>>\n<'row'<'col-sm-12 col-md-6'l><'col-sm-12 col-md-6'f>>\n<'row'<'col-12'tr>>\n<'row'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7'p>>\n    ",        pageLength: 20,
        // dom : '<"dtsp-verticalContainer"<"dtsp-verticalPanes"P><"dtsp-dataTable"Bfrtip>>',
        // dom: 'BPQlfrtip',
        // "pageLength": 10,
        searchPanes:{
            layout: 'columns-1',
            columns: [1, 2, 3, 4, 5, 6, 7, 8, 9, 10],
            cascadePanes: false,
            viewTotal: true,

          },

        language:{
            searchPanes:{
                count:"{total} found",
                countFiltered:"{shown} / {total}"
            }
        },
        columnDefs:[{
            searchPanes:{
                show: true,
                cascadePanes: false,


            },
            targets: [1, 2, 3, 5, 6, 7],
        }],
    });
    $("#plantrucking").DataTable({
        responsive:true,
        // dom: "Bfrtip",
        dom:"\n<'row'<'col-12'P>>\n<'row'<'col-sm-12 col-md-6'l><'col-sm-12 col-md-6'f>>\n<'row'<'col-12'tr>>\n<'row'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7'p>>\n    ",        pageLength: 20,
        // dom : '<"dtsp-verticalContainer"<"dtsp-verticalPanes"P><"dtsp-dataTable"Bfrtip>>',
        // dom: 'BPQlfrtip',
        // "pageLength": 10,
        searchPanes:{
            layout: 'columns-1',
            columns: [1, 2, 3, 4, 5, 6, 7, 8, 9],
            cascadePanes: false,
            viewTotal: true,

          },

        language:{
            searchPanes:{
                count:"{total} found",
                countFiltered:"{shown} / {total}"
            }
        },
        columnDefs:[{
            searchPanes:{
                show: true,
                cascadePanes: false,


            },
            targets: [1, 2, 4, 5, 6, 7],
        }],
    });

    $("#processdischarge").DataTable({
        responsive:true,
        // dom: "Bfrtip",
        dom:"\n<'row'<'col-12'P>>\n<'row'<'col-sm-12 col-md-6'l><'col-sm-12 col-md-6'f>>\n<'row'<'col-12'tr>>\n<'row'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7'p>>\n    ",        pageLength: 20,
        // dom : '<"dtsp-verticalContainer"<"dtsp-verticalPanes"P><"dtsp-dataTable"Bfrtip>>',
        // dom: 'BPQlfrtip',
        // "pageLength": 10,
        searchPanes:{
            layout: 'columns-1',
            columns: [1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 15],
            cascadePanes: false,
            viewTotal: true,

          },

        language:{
            searchPanes:{
                count:"{total} found",
                countFiltered:"{shown} / {total}"
            }
        },
        columnDefs:[{
            searchPanes:{
                show: true,
                cascadePanes: false,


            },
            targets: [1, 2, 3, 5, 6, 7, 9, 10, 15],
        }],
    });
    $("#processtrucking").DataTable({
        responsive:true,
        // dom: "Bfrtip",
        dom:"\n<'row'<'col-12'P>>\n<'row'<'col-sm-12 col-md-6'l><'col-sm-12 col-md-6'f>>\n<'row'<'col-12'tr>>\n<'row'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7'p>>\n    ",        pageLength: 20,
        // dom : '<"dtsp-verticalContainer"<"dtsp-verticalPanes"P><"dtsp-dataTable"Bfrtip>>',
        // dom: 'BPQlfrtip',
        // "pageLength": 10,
        searchPanes:{
            layout: 'columns-1',
            columns: [1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 13],
            cascadePanes: false,
            viewTotal: true,

          },

        language:{
            searchPanes:{
                count:"{total} found",
                countFiltered:"{shown} / {total}"
            }
        },
        columnDefs:[{
            searchPanes:{
                show: true,
                cascadePanes: false,


            },
            targets: [1, 2, 4, 5, 6, 7, 8, 10, 13],
        }],
    });


    $("#processload").DataTable({
        responsive:true,
        // dom: "Bfrtip",
        dom:"\n<'row'<'col-12'P>>\n<'row'<'col-sm-12 col-md-6'l><'col-sm-12 col-md-6'f>>\n<'row'<'col-12'tr>>\n<'row'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7'p>>\n    ",        pageLength: 20,
        // dom : '<"dtsp-verticalContainer"<"dtsp-verticalPanes"P><"dtsp-dataTable"Bfrtip>>',
        // dom: 'BPQlfrtip',
        // "pageLength": 10,
        searchPanes:{
            layout: 'columns-1',
            columns: [1, 3, 4, 5, 6, 7, 8],
            cascadePanes: false,
            viewTotal: true,

          },

        language:{
            searchPanes:{
                count:"{total} found",
                countFiltered:"{shown} / {total}"
            }
        },
        columnDefs:[{
            searchPanes:{
                show: true,
                cascadePanes: false,


            },
            targets: [1, 3, 4, 5, 6, 7],
        }],
    })
    $("#realisasiload").DataTable({
        responsive:true,
        // dom: "Bfrtip",
        dom:"\n<'row'<'col-12'P>>\n<'row'<'col-sm-12 col-md-6'l><'col-sm-12 col-md-6'f>>\n<'row'<'col-12'tr>>\n<'row'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7'p>>\n    ",        pageLength: 20,
        // dom : '<"dtsp-verticalContainer"<"dtsp-verticalPanes"P><"dtsp-dataTable"Bfrtip>>',
        // dom: 'BPQlfrtip',
        // "pageLength": 10,
        searchPanes:{
            layout: 'columns-1',
            columns: [1, 3, 4, 5, 6, 7, 8],
            cascadePanes: false,
            viewTotal: true,

          },
        language:{
            searchPanes:{
                count:"{total} found",
                countFiltered:"{shown} / {total}"
            }
        },
        columnDefs:[{
            searchPanes:{
                show: true,
                cascadePanes: false,


            },
            targets: [1, 3, 4, 5, 6, 7],
        }],
    });
    $("#realisasipod").DataTable({
        responsive:true,
        // dom: "Bfrtip",
        dom:"\n<'row'<'col-12'P>>\n<'row'<'col-sm-12 col-md-6'l><'col-sm-12 col-md-6'f>>\n<'row'<'col-12'tr>>\n<'row'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7'p>>\n    ",        pageLength: 20,
        // dom : '<"dtsp-verticalContainer"<"dtsp-verticalPanes"P><"dtsp-dataTable"Bfrtip>>',
        // dom: 'BPQlfrtip',
        // "pageLength": 10,
        searchPanes:{
            layout: 'columns-1',
            columns: [1, 3, 4, 5, 6, 7, 8],
            cascadePanes: false,
            viewTotal: true,

          },
        language:{
            searchPanes:{
                count:"{total} found",
                countFiltered:"{shown} / {total}"
            }
        },
        columnDefs:[{
            searchPanes:{
                show: true,
                cascadePanes: false,


            },
            targets: [1, 3, 4, 5, 6, 7],
        }],
    });

    $("#summaryloadreport").DataTable({
        responsive:true,
        // dom: "Bfrtip",
        dom:"\n<'row'<'col-12'P>>\n<'row'<'col-sm-12 col-md-6'l><'col-sm-12 col-md-6'f>>\n<'row'<'col-12'tr>>\n<'row'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7'p>>\n    ",        pageLength: 20,
        // dom : '<"dtsp-verticalContainer"<"dtsp-verticalPanes"P><"dtsp-dataTable"Bfrtip>>',
        // dom: 'BPQlfrtip',
        // "pageLength": 10,
        searchPanes:{
            layout: 'columns-1',
            columns: [1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11],
            cascadePanes: false,
            viewTotal: true,

          },
        language:{
            searchPanes:{
                count:"{total} found",
                countFiltered:"{shown} / {total}"
            }
        },
        columnDefs:[{
            searchPanes:{
                show: true,
                cascadePanes: false,


            },
            targets: [1, 3, 5],
        }],
    });

    $("#containerloadreport").DataTable({
        responsive:true,
        // dom: "Bfrtip",
        dom:"\n<'row'<'col-12'P>>\n<'row'<'col-sm-12 col-md-6'l><'col-sm-12 col-md-6'f>>\n<'row'<'col-12'tr>>\n<'row'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7'p>>\n    ",        pageLength: 20,
        // dom : '<"dtsp-verticalContainer"<"dtsp-verticalPanes"P><"dtsp-dataTable"Bfrtip>>',
        // dom: 'BPQlfrtip',
        // "pageLength": 10,
        searchPanes:{
            layout: 'columns-1',
            columns: [1, 2, 3, 8, 9, 12],
            cascadePanes: false,
            viewTotal: true,

          },
        language:{
            searchPanes:{
                count:"{total} found",
                countFiltered:"{shown} / {total}"
            }
        },
        columnDefs:[{
            searchPanes:{
                show: true,
                cascadePanes: false,


            },
            targets: [1, 2, 3, 8, 9, 12],
        }],
    });

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
