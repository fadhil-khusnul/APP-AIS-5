"use strict";

$(function () {
    $(".portlet.portlet-collapsed").portlet("collapse");

    $('[data-toggle="portlet"]').on("click", function (e) {
        e.preventDefault(); // Prevent the default behavior

        var target = $(this).data("target");
        var behavior = $(this).data("behavior");
        target = target === "parent" ? $(this).closest(".portlet") : $(target);
        target.portlet(behavior);
    });
});
