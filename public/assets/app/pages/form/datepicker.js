"use strict";
$(function(){
    var isRtl=$("html").attr("dir")==="rtl";
    var direction=isRtl?"right":"left";
    $("#datepicker-1").datepicker({orientation:direction,autoclose:true});
    $("#datepicker-2").datepicker({orientation:direction,todayHighlight:true});
    $("#datepicker-3").datepicker({orientation:direction,todayBtn:"linked",clearBtn:true,todayHighlight:true});
    $("#tanggal_planload").datepicker({orientation:direction,todayBtn:"linked",clearBtn:true,todayHighlight:true});

    var table_container = document.getElementById("processload-create");
    var urutan = table_container.tBodies[0].rows.length;
    $(".date_activity").datepicker({orientation:direction,todayBtn:"linked",clearBtn:true,todayHighlight:true});
    // for (let i = 0; i < urutan; i++) {
    // }

    $("#datepicker-4").datepicker({orientation:direction,multidate:true,multidateSeparator:", ",todayHighlight:true});$("#datepicker-5").datepicker({orientation:direction,daysOfWeekDisabled:"0",daysOfWeekHighlighted:"3,4",todayHighlight:true});$("#datepicker-6").datepicker({orientation:direction,calendarWeeks:true});$(".input-daterange").datepicker({orientation:direction,todayHighlight:true});$("#datepicker-7").datepicker({orientation:direction,language:"ru"});$("#datepicker-8").datepicker({orientation:direction,todayHighlight:true})});
