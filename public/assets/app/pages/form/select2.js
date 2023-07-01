"use strict";$(function(){
    var isRtl=$("html").attr("dir")==="rtl";
    var direction=isRtl?"rtl":"ltr";
$("#seal").select2
({
    dir:direction,
    dropdownAutoWidth:true,
    placeholder:"Silahkan Pilih",
    allowClear:true



});
$("#penerima_1").select2
({
    dir:direction,
    dropdownAutoWidth:true,
    placeholder:"Silahkan Pilih Penerima",
    allowClear:true



});
$("#filter_pelayaran").select2
({
    dir:direction,
    dropdownAutoWidth:true,
    placeholder:"Silahkan Pilih Pelayaran",
    allowClear:true



});

$("#pilih_size_in").select2
({
    dropdownAutoWidth:true,
    allowClear:true,
    placeholder:"Size Container",



});
$("#pilih_type_in").select2
({
    dropdownAutoWidth:true,
    allowClear:true,
    placeholder:"Type Container",



});
$("#pilih_pod_if1").select2
({
    dropdownAutoWidth:true,
    allowClear:true,
    placeholder:"POD Container",



});
$("#pilih_pot_if1").select2
({
    dropdownAutoWidth:true,
    allowClear:true,
    placeholder:"POT Container",



});
$("#pilih_size_if1").select2
({
    dropdownAutoWidth:true,
    allowClear:true,
    placeholder:"Size Container",



});
$("#pilih_type_if1").select2
({
    dropdownAutoWidth:true,
    allowClear:true,
    placeholder:"Type Container",



});
$("#pilih_vendor").select2
({
    dir:direction,
    dropdownAutoWidth:true,
    placeholder:"Silahkan Pilih Vendor",
    allowClear:true



});

$("#pilih_size_if2").select2
({
    dropdownAutoWidth:true,
    allowClear:true,
    placeholder:"Size Container",



});
$("#pilih_status_if1").select2
({
    dropdownAutoWidth:true,
    allowClear:true,
    placeholder:"Status Container",



});
$("#pilih_type_if2").select2
({
    dropdownAutoWidth:true,
    allowClear:true,
    placeholder:"Type Container",



});


$("#select2-1, #penerima, #pengirim, .danas, #select_company, #activity, #pickup-lokasi, #select2-2, #POD_1, #POL_1, #POT_1, #Pengirim_1, #Penerima_1, #jenis-container, #penerima-process").select2
({
    dir:direction,
    dropdownAutoWidth:true,
    placeholder:"Silahkan Pilih",
    allowClear:true

});


$("#select2-3").select2({dir:direction,dropdownAutoWidth:true,placeholder:"Select multiple",allowClear:true});$("#select2-4").select2({dir:direction,dropdownAutoWidth:true,minimumResultsForSearch:Infinity});$("#select2-5").select2({dir:direction,dropdownAutoWidth:true,placeholder:"Select a state",allowClear:true});
$("#select2-6").select2({
    dir:direction,
    dropdownAutoWidth:true,
    placeholder:"Disabled element",
    allowClear:true
});
$("#select2-7").select2({
    dir:direction,
    dropdownAutoWidth:true,
    placeholder:"Disabled options",
    allowClear:true
});$("#select2-8").select2({
    dir:direction,
    dropdownAutoWidth:true,
    placeholder:"Select two or less items",
    allowClear:true,
    maximumSelectionLength:2
});
$("#select2-9").select2({dir:direction,dropdownAutoWidth:true,placeholder:"Add a tag",tags:true})});
