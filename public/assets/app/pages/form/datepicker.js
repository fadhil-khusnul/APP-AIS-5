"use strict";
$(function () {
    var isRtl = $("html").attr("dir") === "rtl";
    var direction = isRtl ? "right" : "left";
    $("#datepicker-1").datepicker({ orientation: direction, autoclose: true });
    $("#datepicker-2").datepicker({
        orientation: direction,
        todayHighlight: true,
    });
    $("#datepicker-3").datepicker({
        orientation: direction,
        todayBtn: "linked",
        clearBtn: true,
        todayHighlight: true,
    });
    $("#tanggal_planload").datepicker({
        orientation: direction,
        todayBtn: "linked",
        clearBtn: true,
        todayHighlight: true,
        maxDate: new Date()
    });

    var today = new Date();
    var tahun = today.getFullYear();

    var options = {
         format: "DD, dd-MM-yyyy",
         oldFormat: "DD, dd-MM-yyyy",
         todayBtn: "linked",
         clearBtn: true,
         todayHighlight: true,
         changeYear : false,
        //  startDate: tahun,
         endDate : today,
        //  startDate : tahun,
         weekStart: 1,
         "language" : "indonesian",
         locale : "id",
         dateformat: "DD, dd-MM-yyyy",


    };
    $(".date_activity").datepicker(options);


        // language: "id",
        // locale: "id",
        // days: ["Senin", "Selasa", "Rabu", "Kamis", "Jumat", "Sabtu", "Minggu"],
        // daysShort: ["Sen", "Sel", "Rab", "Kam", "Jum", "Sab", "Ming"],
        // daysMin: ["Sen", "Sel", "Rab", "Kam", "Jum", "Sab", "Ming"],
        // months : ["Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember" ],
    // });
    $("#bulan_seal").datepicker({
        format: "DD, dd-MM-yyyy",
        changeMonth: true,
        changeYear: false,
        todayBtn: "linked",
        clearBtn: true,
        weekStart: 1,
        todayHighlight: true,
        // minViewMode: "months",
    });
    $("#tanggal_tiba").datepicker({
        format: "DD, dd-MM-yyyy",
        changeMonth: true,
        changeYear: false,
        todayBtn: "linked",
        clearBtn: true,
        weekStart: 1,
        todayHighlight: true,
    });

    $("#datepicker-4").datepicker({
        orientation: direction,
        multidate: true,
        multidateSeparator: ", ",
        todayHighlight: true,
    });
    $("#datepicker-5").datepicker({
        orientation: direction,
        daysOfWeekDisabled: "0",
        daysOfWeekHighlighted: "3,4",
        todayHighlight: true,
    });
    $("#datepicker-6").datepicker({
        orientation: direction,
        calendarWeeks: true,
    });
    $(".input-daterange").datepicker({
        orientation: direction,
        todayHighlight: true,
    });
    $("#datepicker-7").datepicker({
        orientation: direction,
        language: "ru"
    });
    $("#datepicker-8").datepicker({
        orientation: direction,
        todayHighlight: true,
    });

    $("#datepicker-5").datepicker({
        orientation: direction,
        daysOfWeekDisabled: "0",
        daysOfWeekHighlighted: "3,4",
        todayHighlight: true,
    });
    $("#datepicker-6").datepicker({
        orientation: direction,
        calendarWeeks: true,
    });
    $(".input-daterange").datepicker({
        orientation: direction,
        todayHighlight: true,
    });
    $("#datepicker-7").datepicker({ orientation: direction, language: "ru" });
    $("#datepicker-8").datepicker({
        orientation: direction,
        todayHighlight: true,
    });
});
