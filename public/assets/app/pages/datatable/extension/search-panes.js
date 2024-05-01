"use strict";
$(function() {
    $("#planload").DataTable({
        responsive: true,
        // dom: "Bfrtip",
        dom: "\n<'row'<'col-12'P>>\n<'row'<'col-sm-12 col-md-6'l><'col-sm-12 col-md-6'f>>\n<'row'<'col-12'tr>>\n<'row'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7'p>>\n    ",
        pageLength: 20,
        // dom : '<"dtsp-verticalContainer"<"dtsp-verticalPanes"P><"dtsp-dataTable"Bfrtip>>',
        // dom: 'BPQlfrtip',
        // "pageLength": 10,
        searchPanes: {
            layout: 'columns-1',
            columns: [1, 3, 4, 5, 6, 7],
            cascadePanes: false,
            viewTotal: true,

        },

        language: {
            searchPanes: {
                count: "{total} found",
                countFiltered: "{shown} / {total}"
            }
        },
        columnDefs: [{
            searchPanes: {
                show: true,
                cascadePanes: false,


            },
            targets: [1, 3, 4, 6, 7],
        }],
    });
    $("#plandischarge").DataTable({
        responsive: true,
        // dom: "Bfrtip",
        dom: "\n<'row'<'col-12'P>>\n<'row'<'col-sm-12 col-md-6'l><'col-sm-12 col-md-6'f>>\n<'row'<'col-12'tr>>\n<'row'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7'p>>\n    ",
        pageLength: 20,
        // dom : '<"dtsp-verticalContainer"<"dtsp-verticalPanes"P><"dtsp-dataTable"Bfrtip>>',
        // dom: 'BPQlfrtip',
        // "pageLength": 10,
        searchPanes: {
            layout: 'columns-1',
            columns: [1, 2, 3, 4, 5, 6, 7, 8, 9, 10],
            cascadePanes: false,
            viewTotal: true,

        },

        language: {
            searchPanes: {
                count: "{total} found",
                countFiltered: "{shown} / {total}"
            }
        },
        columnDefs: [{
            searchPanes: {
                show: true,
                cascadePanes: false,


            },
            targets: [3, 5, 6, 7],
        }],
    });
    $("#plantrucking").DataTable({
        responsive: true,
        // dom: "Bfrtip",
        dom: "\n<'row'<'col-12'P>>\n<'row'<'col-sm-12 col-md-6'l><'col-sm-12 col-md-6'f>>\n<'row'<'col-12'tr>>\n<'row'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7'p>>\n    ",
        pageLength: 20,
        // dom : '<"dtsp-verticalContainer"<"dtsp-verticalPanes"P><"dtsp-dataTable"Bfrtip>>',
        // dom: 'BPQlfrtip',
        // "pageLength": 10,
        searchPanes: {
            layout: 'columns-1',
            columns: [1, 2, 3, 4, 5, 6, 7, 8, 9],
            cascadePanes: false,
            viewTotal: true,

        },

        language: {
            searchPanes: {
                count: "{total} found",
                countFiltered: "{shown} / {total}"
            }
        },
        columnDefs: [{
            searchPanes: {
                show: true,
                cascadePanes: false,


            },
            targets: [1, 2, 4, 5, 6, 7],
        }],
    });

    $("#processdischarge").DataTable({
        responsive: true,
        // dom: "Bfrtip",
        dom: "\n<'row'<'col-12'P>>\n<'row'<'col-sm-12 col-md-6'l><'col-sm-12 col-md-6'f>>\n<'row'<'col-12'tr>>\n<'row'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7'p>>\n    ",
        pageLength: 20,
        // dom : '<"dtsp-verticalContainer"<"dtsp-verticalPanes"P><"dtsp-dataTable"Bfrtip>>',
        // dom: 'BPQlfrtip',
        // "pageLength": 10,
        searchPanes: {
            layout: 'columns-1',
            columns: [1, 2, 3, 4, 5, 6, 7, 8, 9, 10],
            cascadePanes: false,
            viewTotal: true,

        },

        language: {
            searchPanes: {
                count: "{total} found",
                countFiltered: "{shown} / {total}"
            }
        },
        columnDefs: [{
            searchPanes: {
                show: true,
                cascadePanes: false,


            },
            targets: [3, 5, 6, 7, 8, 9, 10],
        }],
    });
    $("#processtrucking").DataTable({
        responsive: true,
        // dom: "Bfrtip",
        dom: "\n<'row'<'col-12'P>>\n<'row'<'col-sm-12 col-md-6'l><'col-sm-12 col-md-6'f>>\n<'row'<'col-12'tr>>\n<'row'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7'p>>\n    ",
        pageLength: 20,
        // dom : '<"dtsp-verticalContainer"<"dtsp-verticalPanes"P><"dtsp-dataTable"Bfrtip>>',
        // dom: 'BPQlfrtip',
        // "pageLength": 10,
        searchPanes: {
            layout: 'columns-1',
            columns: [1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 13],
            cascadePanes: false,
            viewTotal: true,

        },

        language: {
            searchPanes: {
                count: "{total} found",
                countFiltered: "{shown} / {total}"
            }
        },
        columnDefs: [{
            searchPanes: {
                show: true,
                cascadePanes: false,


            },
            targets: [1, 2, 4, 5, 6, 7, 8, 10, 13],
        }],
    });

    let processload = $("#processload").DataTable({
        responsive: true,
        dom: `
      <'row'<'col-12'P>>
      <'row'<'col-sm-12 col-md-6'l><'col-sm-12 col-md-6'f>>
      <'row'<'col-12'tr>>
      <'row'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7'p>>
    `,
        pageLength: 10, // Set initial page length to 100
        searchPanes: {
            layout: 'columns-1',
            columns: [1, 3, 4, 5, 6, 7],
            cascadePanes: false,
            viewTotal: true,
        },
        language: {
            searchPanes: {
                count: "{total} found",
                countFiltered: "{shown} / {total}"
            }
        },
        columnDefs: [{
            searchPanes: {
                show: true,
                cascadePanes: false,
            },
            targets: [1, 3, 4, 5, 6, 7],
        }],

        // serverSide: false, 
        // ajax: function(requestData, callback, settings) {
        //     console.log(requestData);
        //     let hasInput = false;
        //     for (let i = 0; i < requestData.columns.length; i++) {
        //         if ([1, 3, 4, 5, 6, 7].includes(i) && columns[i] && columns[i].searchPanes !== '') {
        //             hasInput = true;
        //             break;
        //         }
        //     }

        //     if (hasInput) {
        //         processload.settings()[0].oFeatures.bServerSide = true;
        //         data.draw = 1; // Reset the draw counter to start from the first page
        //     } else {
        //         processload.settings()[0].oFeatures.bServerSide = false;
        //     }

        //     $.ajax({
        //         url: '/search-processload',
        //         type: 'GET',
        //         data: requestData,
        //         success: callback,
        //         error: function(xhr, error, thrown) {
        //             // Handle errors if needed
        //         }
        //     });
        // }
    });





    // Update page length to -1 (show all rows) when searching



    $("#realisasiload").DataTable({
        responsive: true,
        // dom: "Bfrtip",
        dom: "\n<'row'<'col-12'P>>\n<'row'<'col-sm-12 col-md-6'l><'col-sm-12 col-md-6'f>>\n<'row'<'col-12'tr>>\n<'row'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7'p>>\n    ",
        pageLength: 20,
        // dom : '<"dtsp-verticalContainer"<"dtsp-verticalPanes"P><"dtsp-dataTable"Bfrtip>>',
        // dom: 'BPQlfrtip',
        // "pageLength": 10,
        searchPanes: {
            layout: 'columns-1',
            columns: [1, 3, 4, 5, 6, 7, 8],
            cascadePanes: false,
            viewTotal: true,

        },
        language: {
            searchPanes: {
                count: "{total} found",
                countFiltered: "{shown} / {total}"
            }
        },
        columnDefs: [{
            searchPanes: {
                show: true,
                cascadePanes: false,


            },
            targets: [1, 3, 4, 5, 6, 7],
        }],
    });
    $("#realisasipod").DataTable({
        responsive: true,
        // dom: "Bfrtip",
        dom: "\n<'row'<'col-12'P>>\n<'row'<'col-sm-12 col-md-6'l><'col-sm-12 col-md-6'f>>\n<'row'<'col-12'tr>>\n<'row'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7'p>>\n    ",
        pageLength: 20,
        // dom : '<"dtsp-verticalContainer"<"dtsp-verticalPanes"P><"dtsp-dataTable"Bfrtip>>',
        // dom: 'BPQlfrtip',
        // "pageLength": 10,
        searchPanes: {
            layout: 'columns-1',
            columns: [1, 3, 4, 5, 6, 7, 8],
            cascadePanes: false,
            viewTotal: true,

        },
        language: {
            searchPanes: {
                count: "{total} found",
                countFiltered: "{shown} / {total}"
            }
        },
        columnDefs: [{
            searchPanes: {
                show: true,
                cascadePanes: false,


            },
            targets: [1, 3, 4, 5, 6, 7],
        }],
    });

    $("#summaryloadreport").DataTable({
        responsive: true,
        // dom: "Bfrtip",
        dom: "\n<'row'<'col-12'P>>\n<'row'<'col-sm-12 col-md-6'l><'col-sm-12 col-md-6'f>>\n<'row'<'col-12'tr>>\n<'row'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7'p>>\n    ",
        pageLength: 20,
        // dom : '<"dtsp-verticalContainer"<"dtsp-verticalPanes"P><"dtsp-dataTable"Bfrtip>>',
        // dom: 'BPQlfrtip',
        // "pageLength": 10,
        searchPanes: {
            layout: 'columns-1',
            columns: [1, 2, 3, 4, 5, 6, 7],
            cascadePanes: false,
            viewTotal: true,

        },
        language: {
            searchPanes: {
                count: "{total} found",
                countFiltered: "{shown} / {total}"
            }
        },
        columnDefs: [{
            searchPanes: {
                show: true,
                cascadePanes: false,


            },
            targets: [3, 4, 5, 7],
        }],
    });
    $("#invoicedischarge").DataTable({
        responsive: true,
        // dom: "Bfrtip",
        dom: "\n<'row'<'col-12'P>>\n<'row'<'col-sm-12 col-md-6'l><'col-sm-12 col-md-6'f>>\n<'row'<'col-12'tr>>\n<'row'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7'p>>\n    ",
        pageLength: 20,
        // dom : '<"dtsp-verticalContainer"<"dtsp-verticalPanes"P><"dtsp-dataTable"Bfrtip>>',
        // dom: 'BPQlfrtip',
        // "pageLength": 10,
        searchPanes: {
            layout: 'columns-1',
            columns: [1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11],
            cascadePanes: false,
            viewTotal: true,

        },
        language: {
            searchPanes: {
                count: "{total} found",
                countFiltered: "{shown} / {total}"
            }
        },
        columnDefs: [{
            searchPanes: {
                show: true,
                cascadePanes: false,


            },
            targets: [3, 4, 5, 6, 7, 8, 9],
        }],
    });
    $("#tabelinvoice").DataTable({
        responsive: true,
        // dom: "Bfrtip",
        dom: "\n<'row'<'col-12'P>>\n<'row'<'col-sm-12 col-md-6'l><'col-sm-12 col-md-6'f>>\n<'row'<'col-12'tr>>\n<'row'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7'p>>\n    ",
        pageLength: 20,
        // dom : '<"dtsp-verticalContainer"<"dtsp-verticalPanes"P><"dtsp-dataTable"Bfrtip>>',
        // dom: 'BPQlfrtip',
        // "pageLength": 10,
        searchPanes: {
            layout: 'columns-1',
            columns: [1, 2, 3, 4, 5, 6, 7, 8],
            cascadePanes: false,
            viewTotal: true,

        },
        language: {
            searchPanes: {
                count: "{total} found",
                countFiltered: "{shown} / {total}"
            }
        },
        columnDefs: [{
            searchPanes: {
                show: true,
                cascadePanes: false,


            },
            targets: [2, 3, 4, 5],
        }],
    });

    $("#containerloadreport").DataTable({
        responsive: true,
        dom: '<"dtsp-verticalContainer"<"dtsp-verticalPanes"P><"dtsp-dataTable"Bfrtip>>',
        searchPanes: {
            columns: [3, 4, 6, 7, 8, 9, 10, 11, 12, 13, 14],
            layout: 'columns-1',
            cascadePanes: false,
            viewTotal: true,
        },
        language: {
            searchPanes: {
                count: "{total} found",
                countFiltered: "{shown} / {total}"
            }
        },

        columnDefs: [{

                targets: [3, 4, 6, 7, 8, 9, 10, 11, 12],
                searchPanes: {
                    show: true,
                    cascadePanes: false,
                },


            },
            {


                targets: 15,
                visible: false

            }
        ],
        createdRow: function(row, data, dataIndex) {
            // Set the content of the first column to the row index + 1
            $('td:eq(0)', row).html(dataIndex + 1);
        },
        buttons: [{
                extend: "excel",
                className: "btn btn-flat-success",
                customize: function(xlsx) {
                    var sheet = xlsx.xl.worksheets['sheet1.xml'];
                    $('row', sheet).each(function() {
                        // Iterate over each row
                        var cell = $('c[r^="N"]', this); // Targeting column N (index 14)
                        cell.each(function() {
                            // Iterate over each cell in column N
                            var currentCell = $(this);
                            var value = currentCell.text(); // Get the cell value
                            if (!isNaN(value)) { // Check if the value is a number
                                // Remove currency symbol and convert to number
                                var numberValue = value.replace(/\./g, '');
                                var formattedValue = parseInt(numberValue); // Format the value using accounting.js
                                currentCell.text(formattedValue); // Update the cell value with the formatted value
                            }
                        });
                    });
                },

                exportOptions: {
                    columns: [0, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 15],
                }
            },
            {
                extend: 'pdf',
                orientation: 'landscape',
                className: "btn btn-flat-success",
                pageSize: 'LEGAL',
                customize: function(doc) {
                    doc.defaultStyle.alignment = 'center';
                    doc.styles.tableHeader.alignment = 'center';
                    doc.styles.tableHeader.fillColor = '#00ad4c';
                    doc.content[1].table.widths = [15, 70, 50, 70, 50, 50, 80, 50, 50, 70, 50, 50, 70, 70];;
                },
                exportOptions: {
                    columns: [0, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14],
                }
            },
        ],
    });


    // $("#containerloadreport").DataTable({
    //   responsive: true,
    //   // dom: "Bfrtip",
    //   // dom:"\n<'row'<'col-12'P>>\n<'row'<'col-sm-12 col-md-6'l><'col-sm-12 col-md-6'f>>\n<'row'<'col-12'tr>>\n<'row'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7'p>>\n    ",        pageLength: 20,
    //   dom: '<"dtsp-verticalContainer"<"dtsp-verticalPanes"P><"dtsp-dataTable"Bfrtip>>',
    //   // dom: 'BPQlfrtip',
    //   // "pageLength": 10,
    //   searchPanes: {
    //     layout: 'columns-1',
    //     columns: [1, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12],
    //     cascadePanes: false,
    //     viewTotal: true,

    //   },
    //   language: {
    //     searchPanes: {
    //       count: "{total} found",
    //       countFiltered: "{shown} / {total}"
    //     }
    //   },
    //   columnDefs: [{
    //     searchPanes: {
    //       show: true,
    //       cascadePanes: false,


    //     },
    //     targets: [3, 4, 6, 7, 8, 9, 10, 11, 12],
    //   },
    //   {
    //     targets: 14, // Assuming 14 is the 15th column
    //     render: function(data, type, row, meta) {
    //       // Use accounting.js library for accounting format
    //       return accounting.formatMoney(data, "$", 0); // You can customize the format here
    //     }
    //   }
    // ],

    //   createdRow: function (row, data, dataIndex) {
    //     // Set the content of the first column to the row index + 1
    //     $('td:eq(0)', row).html(dataIndex + 1);
    //   },
    //   buttons: [
    //     {
    //       extend: "excel",
    //       className: "btn btn-flat-success",
    //       exportOptions: {
    //         columns: [0, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14],
    //       }

    //     },

    //     {
    //       extend: 'pdf',
    //       orientation: 'landscape',
    //       className: "btn btn-flat-success",
    //       className: "btn btn-flat-success",
    //       pageSize: 'LEGAL',
    //       customize: function (doc) {
    //         doc.defaultStyle.alignment = 'center';
    //         doc.styles.tableHeader.alignment = 'center';
    //         doc.styles.tableHeader.fillColor = '#00ad4c';
    //         doc.content[1].table.widths = [15, 70, 50, 70, 50, 50, 80, 50, 50, 70, 50, 50, 70, 70];;
    //       },
    //       exportOptions: {
    //         columns: [0, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14],
    //       }
    //     },
    //   ],
    // });




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