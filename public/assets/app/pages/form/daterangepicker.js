"use strict";
$(function () {
    var isRtl = $("html").attr("dir") === "rtl";
    var direction = isRtl ? "left" : "right";
    $("#daterangepicker-1").daterangepicker({ opens: direction });
    $("#daterangepicker-2").daterangepicker({
        opens: direction,
        timePicker: true,
    });
    $("#daterangepicker-3").daterangepicker({
        opens: direction,
        singleDatePicker: true,
        showDropdowns: true,
        timePicker: true,
    });
    $("#daterangepicker-4").daterangepicker({
        opens: direction,
        startDate: moment().subtract(29, "days"),
        endDate: moment(),
        ranges: {
            Today: [moment(), moment()],
            Yesterday: [
                moment().subtract(1, "days"),
                moment().subtract(1, "days"),
            ],
            "Last 7 Days": [moment().subtract(6, "days"), moment()],
            "Last 30 Days": [moment().subtract(29, "days"), moment()],
            "This Month": [moment().startOf("month"), moment().endOf("month")],
            "Last Month": [
                moment().subtract(1, "month").startOf("month"),
                moment().subtract(1, "month").endOf("month"),
            ],
        },
    });
    $("#daterangepicker-5").daterangepicker({
        opens: direction,
        minDate: "04/09/2020",
        maxDate: "05/15/2020",
    });
    $("#daterangepicker-6").daterangepicker({
        opens: direction,
        showWeekNumbers: true,
        timePicker: true,
        ranges: {
            Today: [moment(), moment()],
            Yesterday: [
                moment().subtract(1, "days"),
                moment().subtract(1, "days"),
            ],
            "Last 7 Days": [moment().subtract(6, "days"), moment()],
            "Last 30 Days": [moment().subtract(29, "days"), moment()],
            "This Month": [moment().startOf("month"), moment().endOf("month")],
            "Last Month": [
                moment().subtract(1, "month").startOf("month"),
                moment().subtract(1, "month").endOf("month"),
            ],
        },
    });
    $("#daterangepicker_vendor").daterangepicker({
        locale: {
            separator: " - ",
            format:"dddd, DD MMMM YYYY",
            applyLabel: "Apply",
            cancelLabel: "Cancel",
            fromLabel: "from",
            toLabel: "to",
            weekLabel: "M",
            autoUpdateInput: false,
            daysOfWeek: ["Min", "Sen", "Sel", "Rab", "Kam", "Jum", "Sab"],
            monthNames: [
                "Jan",
                "Feb",
                "Маret",
                "Аpril",
                "Мei",
                "Juni",
                "Juli",
                "Agu",
                "Sep",
                "Okt",
                "Nov",
                "Des",
            ],
            weekStart: 1,


        },
    });
});
