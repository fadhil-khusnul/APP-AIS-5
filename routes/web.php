<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MainController;
use App\Http\Controllers\DataController;
use App\Http\Controllers\PlanLoadController;
use App\Http\Controllers\ShippingController;
use App\Http\Controllers\DepoController;
use App\Http\Controllers\PlanDischargeController;
use App\Http\Controllers\ProcessLoadController;
use App\Http\Controllers\SealController;
use App\Http\Controllers\SpkController;
use App\Http\Controllers\PelabuhanController;
use App\Http\Controllers\PengirimController;
use App\Http\Controllers\PenerimaController;
use App\Http\Controllers\BiayaController;
use App\Http\Controllers\TruckingController;
use App\Http\Controllers\ContainerController;
use App\Http\Controllers\StuffingController;
use App\Http\Controllers\StrippingController;
use App\Http\Controllers\AlihKapalController;
use App\Http\Controllers\InvoiceLoadController;
use App\Http\Controllers\TypeContainerController;
use App\Http\Controllers\RealisasiLoadController;
use App\Http\Controllers\PdfController;
use App\Http\Controllers\OngkoSupirController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\ReportDischargeController;
use App\Http\Controllers\ReportTruckingController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

//DATA
Route::get('/', [DataController::class, 'index']);
Route::get('/data', [DataController::class, 'index']);

Route::post('/shipping-company', [ShippingController::class, 'store']);
Route::get('/company/{id}/edit', [ShippingController::class, 'edit']);
Route::put('/company/{id}', [ShippingController::class, 'update']);
Route::delete('/company/{id}', [ShippingController::class, 'destroy']);

Route::post('/vendor-mobil', [ShippingController::class, 'store_vendor']);
Route::get('/vendor-mobil/{id}/edit', [ShippingController::class, 'edit_vendor']);
Route::put('/vendor-mobil/{id}', [ShippingController::class, 'update_vendor']);
Route::delete('/vendor-mobil/{id}', [ShippingController::class, 'destroy_vendor']);


Route::post('/add-depo', [DepoController::class, 'store']);
Route::get('/depo/{id}/edit', [DepoController::class, 'edit']);
Route::put('/depo/{id}', [DepoController::class, 'update']);
Route::delete('/depo/{id}', [DepoController::class, 'destroy']);

Route::post('/add-pelabuhan', [PelabuhanController::class, 'store']);
Route::get('/pelabuhan/{id}/edit', [PelabuhanController::class, 'edit']);
Route::put('/pelabuhan/{id}', [PelabuhanController::class, 'update']);
Route::delete('/pelabuhan/{id}', [PelabuhanController::class, 'destroy']);


Route::post('/add-pengirim', [PengirimController::class, 'store']);
Route::get('/pengirim/{id}/edit', [PengirimController::class, 'edit']);
Route::put('/pengirim/{id}', [PengirimController::class, 'update']);
Route::delete('/pengirim/{id}', [PengirimController::class, 'destroy']);

Route::post('/add-penerima', [PenerimaController::class, 'store']);
Route::post('/checkpenerima', [PenerimaController::class, 'checkpenerima']);
Route::post('/checkpengirim', [PenerimaController::class, 'checkpengirim']);
Route::get('/penerima/{id}/edit', [PenerimaController::class, 'edit']);
Route::put('/penerima/{id}', [PenerimaController::class, 'update']);
Route::delete('/penerima/{id}', [PenerimaController::class, 'destroy']);
Route::post('/getnamapenerima', [PenerimaController::class, 'getnamapenerima']);



Route::post('/add-biaya', [BiayaController::class, 'store']);
Route::get('/biaya/{id}/edit', [BiayaController::class, 'edit']);
Route::put('/biaya/{id}', [BiayaController::class, 'update']);
Route::delete('/biaya/{id}', [BiayaController::class, 'destroy']);

Route::post('/add-type', [TypeContainerController::class, 'store']);
Route::get('/type/{id}/edit', [TypeContainerController::class, 'edit']);
Route::put('/type/{id}', [TypeContainerController::class, 'update']);
Route::delete('/type/{id}', [TypeContainerController::class, 'destroy']);

Route::post('/add-container', [ContainerController::class, 'store']);
Route::get('/container/{id}/edit', [ContainerController::class, 'edit']);
Route::put('/container/{id}', [ContainerController::class, 'update']);
Route::delete('/container/{id}', [ContainerController::class, 'destroy']);

Route::post('/add-stuffing', [StuffingController::class, 'store']);
Route::get('/stuffing/{id}/edit', [StuffingController::class, 'edit']);
Route::put('/stuffing/{id}', [StuffingController::class, 'update']);
Route::delete('/stuffing/{id}', [StuffingController::class, 'destroy']);

Route::post('/add-stripping', [StrippingController::class, 'store']);
Route::get('/stripping/{id}/edit', [StrippingController::class, 'edit']);
Route::put('/stripping/{id}', [StrippingController::class, 'update']);
Route::delete('/stripping/{id}', [StrippingController::class, 'destroy']);

//ACTIVITY

//lOAD
Route::get('/planload', [PlanLoadController::class, 'index']);
Route::get('/planload/create', [PlanLoadController::class, 'create']);
Route::get('/planload-edit/{slug}', [PlanLoadController::class, 'edit']);
Route::post('/create-job-planload', [PlanLoadController::class, 'create_job_planload']);
Route::post('/update-job-planload', [PlanLoadController::class, 'update']);

Route::post('/getJenisKontainer', [PlanLoadController::class, 'getJenisKontainer']);
Route::post('/getSizeTypeContainer', [PlanLoadController::class, 'getSizeTypeContainer']);


//PROCES-LOAD
Route::get('/processload-create/{slug}', [ProcessLoadController::class, 'create']);
Route::get('/processload-edit/{slug}', [ProcessLoadController::class, 'edit']);
Route::get('/detail-kontainer/{id}/input', [ProcessLoadController::class, 'input']);
Route::get('/detail-alihkapal/{id}', [ProcessLoadController::class, 'detail_alihkapal']);
Route::put('/detail-kontainer-update/{id}', [ProcessLoadController::class, 'input_update']);
Route::put('/detail-kontainer-edit/{id}', [ProcessLoadController::class, 'input_edit']);
Route::post('/detail-kontainer-tambah', [ProcessLoadController::class, 'input_tambah']);
Route::delete('/container-delete/{id}', [ProcessLoadController::class, 'destroy']);
Route::post('/detailbarang-kontainer', [ProcessLoadController::class, 'detailbarang']);
Route::post('/biayalain-kontainer', [ProcessLoadController::class, 'biayalain']);
Route::delete('/biayalainnya-delete/{id}', [ProcessLoadController::class, 'destroy_biaya']);
Route::delete('/detailbarang-delete/{id}', [ProcessLoadController::class, 'destroy_detailbarang']);
Route::get('/biayalainnya-edit/{id}', [ProcessLoadController::class, 'biayalain_edit']);
Route::get('/detailbarang-edit/{id}', [ProcessLoadController::class, 'detailbarang_edit']);
Route::put('/biayalainnya-update/{id}', [ProcessLoadController::class, 'biayalain_update']);
Route::put('/detailbarang-update/{id}', [ProcessLoadController::class, 'detailbarang_update']);

//BATAL-MUAT
Route::post('/batalmuat-kontainer', [ProcessLoadController::class, 'batalmuat']);
Route::get('/batalmuat-edit/{id}', [ProcessLoadController::class, 'batalmuat_edit']);
Route::put('/batalmuat-update/{id}', [ProcessLoadController::class, 'batalmuat_update']);
Route::delete('/batalmuat-delete/{id}', [ProcessLoadController::class, 'destroy_batal']);

//ALIH-KAPL
Route::post('/alihkapal-kontainer', [ProcessLoadController::class, 'alihkapal']);
Route::get('/alihkapal-edit/{id}', [ProcessLoadController::class, 'alihkapal_edit']);
Route::put('/alihkapal-update/{id}', [ProcessLoadController::class, 'alihkapal_update']);
Route::delete('/alihkapal-delete/{id}', [ProcessLoadController::class, 'destroy_alihkapal']);

Route::put('/plan-kapal-detail-update/{id}', [ProcessLoadController::class, 'plan_update']);


// Route::post('/create-job-processload', [ProcessLoadController::class, 'store']);
// Route::post('/save-job-processload', [ProcessLoadController::class, 'save']);
// Route::post('/update-job-processload', [ProcessLoadController::class, 'update']);

Route::get('/processload', [ProcessLoadController::class, 'index']);
Route::post('/getBiayaLain', [ProcessLoadController::class, 'getBiayaLain']);
Route::post('/getNoSurat', [ProcessLoadController::class, 'getNoSurat']);
Route::post('/getVendor', [ProcessLoadController::class, 'getVendor']);
Route::post('/getSealProcessLoad', [ProcessLoadController::class, 'getSealProcessLoad']);
Route::post('/getSpkProcessLoad', [ProcessLoadController::class, 'getSpkProcessLoad']);
Route::post('/getNoContainer', [ProcessLoadController::class, 'getNoContainer']);
Route::post('/getpelayaran', [ProcessLoadController::class, 'getpelayaran']);
Route::post('/get-detail-container', [ProcessLoadController::class, 'get_detail_container']);
// Route::post('/checkOngkosSupir', [ProcessLoadController::class, 'checkOngkosSupir']);


Route::get('/realisasi-load', [RealisasiLoadController::class, 'index']);
Route::get('/realisasi-pod', [RealisasiLoadController::class, 'index_pod']);
Route::get('/detail-pdf/{id}/input', [RealisasiLoadController::class, 'detail_pdf']);
Route::get('/realisasi-load-create/{slug}', [RealisasiLoadController::class, 'create']);
Route::get('/realisasi-pod-create/{slug}', [RealisasiLoadController::class, 'create_pod']);
Route::post('/masukkan-biaya-pod', [RealisasiLoadController::class, 'masukkan_biaya_pod']);
Route::post('/masukkan-do-fee', [RealisasiLoadController::class, 'masukkan_do_fee']);



//DISCHARGE
Route::get('/plandischarge', [PlanDischargeController::class, 'index']);
Route::get('/plandischarge/create', [PlanDischargeController::class, 'create']);
Route::get('/plandischarge-edit/{slug}', [PlanDischargeController::class, 'edit']);
Route::post('/update-job-plandischarge', [PlanDischargeController::class, 'update']);

Route::post('/create-job-plandischarge', [PlanDischargeController::class, 'create_job_plandischarge']);
Route::get('/processdischarge', [PlanDischargeController::class, 'process']);
Route::get('/processdischarge-create/{slug}', [PlanDischargeController::class, 'create_process']);
Route::post('/create-job-processdischarge', [PlanDischargeController::class, 'store_process']);
Route::get('/realisasi-discharge', [PlanDischargeController::class, 'realisasi']);
Route::get('/realisasidischarge-create/{slug}', [PlanDischargeController::class, 'realisasi_create']);
Route::post('/create-job-realisasidischarge', [PlanDischargeController::class, 'store_realisasi']);
Route::post('/getNoSurat-discharge', [PlanDischargeController::class, 'getNoSurat_discharge']);
Route::post('/getBiayaLain-discharge', [PlanDischargeController::class, 'getBiayaLain']);
Route::post('/getSealProcessDischarge', [PlanDischargeController::class, 'getSealProcessLoad']);
Route::post('/getNoContainer-discharge', [PlanDischargeController::class, 'getNoContainer']);


Route::post('/create-si-container', [PdfController::class, 'create_si']);
Route::post('/create-si-alih', [PdfController::class, 'create_si_alih']);
Route::post('/getAlihKapal', [PdfController::class, 'getAlihKapal']);
Route::post('/masukkan-bl', [PdfController::class, 'masukkan_bl']);
Route::get('/invoice-load/{slug}', [PdfController::class, 'invoice_load']);
Route::post('/create-si-discharge', [PdfController::class, 'si_discharge']);
Route::get('/preview-si/{path}', [PdfController::class, 'preview_si']);
Route::post('/konfirmasi-si', [PdfController::class, 'konfirmasi_si']);
Route::delete('/delete-si/{id}', [PdfController::class, 'delete_si']);

//ALih Kapal
Route::get('/alih-kapal', [AlihKapalController::class, 'index']);
Route::get('/batal-muat', [AlihKapalController::class, 'index']);


//seal
Route::get('/seal', [SealController::class, 'index']);
Route::get('/seal/{id}/edit', [SealController::class, 'edit']);
Route::delete('/seal/{id}', [SealController::class, 'destroy']);
Route::put('/seal-update/{id}', [SealController::class, 'update']);
Route::get('/report-seal', [SealController::class, 'index_report']);
Route::post('/tambah-seal', [SealController::class, 'store']);
Route::post('/getSeal', [SealController::class, 'getSeal']);
Route::post('/getCodeSeal', [SealController::class, 'getCodeSeal']);
Route::post('/getKodeSeal', [SealController::class, 'getKodeSeal']);

Route::get('/damage-seal', [SealController::class, 'index_damage']);
Route::post('/tambah-damage-seal', [SealController::class, 'update_damage']);

//SPK
Route::get('/spk', [SpkController::class, 'index']);
Route::get('/spk/{id}/edit', [SpkController::class, 'edit']);
Route::delete('/spk/{id}', [SpkController::class, 'destroy']);
Route::put('/spk-update/{id}', [SpkController::class, 'update']);
Route::get('/report-spk', [SpkController::class, 'index_report']);
Route::post('/tambah-spk', [SpkController::class, 'store']);
Route::post('/getSeal', [SpkController::class, 'getSpk']);
Route::post('/getCodeSpk', [SpkController::class, 'getCodeSpk']);
Route::post('/getKodeSpk', [SpkController::class, 'getKodeSpk']);



//TRUCKING
Route::get('/truckingplan', [TruckingController::class, 'index']);
Route::get('/truckingplan/create', [TruckingController::class, 'create']);
Route::post('/create-job-truckingplan', [TruckingController::class, 'create_job_Trucking']);
Route::get('/plantrucking-edit/{slug}', [TruckingController::class, 'edit']);
Route::post('/update-job-truckinplan', [TruckingController::class, 'update']);

Route::get('/truckingprocess', [TruckingController::class, 'process']);
Route::get('/truckingprocess-create/{slug}', [TruckingController::class, 'create_process']);
Route::post('/create-job-truckingprocess', [TruckingController::class, 'store_process']);
Route::get('/realisasi-trucking', [TruckingController::class, 'realisasi']);
Route::get('/truckingrealisasi-create/{slug}', [TruckingController::class, 'realisasi_create']);
Route::post('/getNoSurat-trucking', [TruckingController::class, 'getNoSurat_discharge']);
Route::post('/getBiayaLain-trucking', [TruckingController::class, 'getBiayaLain']);
Route::post('/getSealProcessTrucking', [TruckingController::class, 'getSealProcessLoad']);
Route::post('/getNoContainer-trucking', [TruckingController::class, 'getNoContainer']);


//ONGKOS SUPIR
Route::get('/ongkos-supir', [OngkoSupirController::class, 'index']);
Route::post('/add-ongkos', [OngkoSupirController::class, 'store']);
Route::post('/kontainer-dibayar', [OngkoSupirController::class, 'dibayar']);
Route::get('/ongkos-supir/{id}/edit', [OngkoSupirController::class, 'edit']);
Route::put('/ongkos-supir/{id}', [OngkoSupirController::class, 'update']);
Route::delete('/ongkos-supir/{id}', [OngkoSupirController::class, 'destroy']);
//REKENING BANK
Route::post('/add-rekening', [OngkoSupirController::class, 'store_rekening']);
Route::get('/rekening-bank/{id}/edit', [OngkoSupirController::class, 'edit_rekening']);
Route::put('/rekening-bank/{id}', [OngkoSupirController::class, 'update_rekening']);
Route::delete('/rekening-bank/{id}', [OngkoSupirController::class, 'destroy_rekening']);

//supir
Route::get('/supir-mobil', [OngkoSupirController::class, 'index_supir']);
Route::get('/report-vendor-load', [OngkoSupirController::class, 'report_load']);
Route::get('/report-vendor-discharge', [OngkoSupirController::class, 'report_discharge']);
Route::get('/report-vendor-trucking', [OngkoSupirController::class, 'report_trucking']);

Route::post('/add-supir', [OngkoSupirController::class, 'store_supir']);
Route::get('/supir-mobil/{id}/edit', [OngkoSupirController::class, 'edit_supir']);
Route::put('/supir-mobil/{id}', [OngkoSupirController::class, 'update_supir']);
Route::delete('/supir-mobil/{id}', [OngkoSupirController::class, 'destroy_supir']);

//REPORT-LOAD
Route::get('/summary-report-load', [ReportController::class, 'report_load']);
Route::get('/downloadsload/{slug}', [ReportController::class, 'download_sload']);
Route::get('/cost-report-load', [ReportController::class, 'report_cload']);
Route::get('/downloadcload/{slug}', [ReportController::class, 'download_cload']);
Route::get('/container-report-load', [ReportController::class, 'report_coload']);
Route::get('/downloadcoload/{id}', [ReportController::class, 'download_coload']);
Route::get('/invoice-load', [ReportController::class, 'invoice']);
Route::get('/invoice-load-create/{slug}', [ReportController::class, 'create_invoice']);

Route::get('/pdfinvoice-load/{slug}', [ReportController::class, 'invoice_download']);

//REPORT-DISCHARGE
Route::get('/summary-report-discharge', [ReportDischargeController::class, 'report_load']);
Route::get('/downloadsdischarge/{slug}', [ReportDischargeController::class, 'download_sload']);
Route::get('/cost-report-discharge', [ReportDischargeController::class, 'report_cload']);
Route::get('/downloadcdischarge/{slug}', [ReportDischargeController::class, 'download_cload']);
Route::get('/container-report-discharge', [ReportDischargeController::class, 'report_coload']);
Route::get('/downloadcodischarge/{id}', [ReportDischargeController::class, 'download_coload']);
Route::get('/invoice-discharge', [ReportDischargeController::class, 'invoice']);
Route::get('/pdfinvoice-discharge/{slug}', [ReportDischargeController::class, 'invoice_download']);


//REPORT-TRUCKING
Route::get('/summary-report-trucking', [ReportTruckingController::class, 'report_load']);
Route::get('/downloadstrucking/{slug}', [ReportTruckingController::class, 'download_sload']);
Route::get('/cost-report-trucking', [ReportTruckingController::class, 'report_cload']);
Route::get('/downloadctrucking/{slug}', [ReportTruckingController::class, 'download_cload']);
Route::get('/container-report-trucking', [ReportTruckingController::class, 'report_coload']);
Route::get('/downloadcotrucking/{id}', [ReportTruckingController::class, 'download_coload']);
Route::get('/invoice-trucking', [ReportTruckingController::class, 'invoice']);
Route::get('/pdfinvoice-trucking/{slug}', [ReportTruckingController::class, 'invoice_download']);

//INVOICE

Route::get('/invoice-load', [InvoiceLoadController::class, 'invoice']);
Route::get('/invoice-load-create/{slug}', [InvoiceLoadController::class, 'create_invoice']);
Route::post('/masukkan-invoice-load', [InvoiceLoadController::class, 'masukkan_invoice']);
Route::post('/create-pdf-invoice-load', [InvoiceLoadController::class, 'pdf_invoice']);
Route::get('/preview-invoice/{path}', [InvoiceLoadController::class, 'preview_invoice']);
Route::delete('/delete-invoice/{id}', [InvoiceLoadController::class, 'delete_invoice']);








