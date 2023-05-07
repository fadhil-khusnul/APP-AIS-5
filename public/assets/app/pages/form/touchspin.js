"use strict";
$(function () {


    $(".jumlah-container").TouchSpin({
        buttondown_class: "btn btn-label-primary",
        buttonup_class: "btn btn-label-primary",
        max: 100,
        min: 1,
        step: 1,
    });


    $("#start_seal").TouchSpin({
        buttondown_class: "btn btn-label-success",
        buttonup_class: "btn btn-label-success",
        step: 1,
        max: 1000000000000000000000000000000000000000000000000000000,

    });

    $("#touchspin-8, #touch_seal, #jumlah_container, #size-20, #size-21, #size-40, #size-45, #touch-cargo, #touch-stuffing, #touch-trucking, #touch-supir"
    ).TouchSpin({
        buttondown_class: "btn btn-label-success",
        buttonup_class: "btn btn-label-success",
        // decimals: 1,

        max: 249,
        step: 1,
    });


});
