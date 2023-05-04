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

    $(".date_activity").datepicker({
        // orientation: direction,
        format: "DD-MM-yyyy",
        todayBtn: "linked",
        clearBtn: true,
        todayHighlight: true,
        endDate : new Date(),
        weekStart: 1,
        language: "id",
        // language: "id",
        // locale: "id",
        // days: ["Senin", "Selasa", "Rabu", "Kamis", "Jumat", "Sabtu", "Minggu"],
        // daysShort: ["Sen", "Sel", "Rab", "Kam", "Jum", "Sab", "Ming"],
        // daysMin: ["Sen", "Sel", "Rab", "Kam", "Jum", "Sab", "Ming"],
        // months : ["Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember" ],
    });
    $("#bulan_seal").datepicker({
        format: "mm-dd",
        changeMonth: true,
        changeYear: false,
        startView: "months",
        todayBtn: "linked",
        clearBtn: true,
        todayHighlight: true,
        // minViewMode: "months",
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
