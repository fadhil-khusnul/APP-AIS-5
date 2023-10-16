<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\PPN;
use App\Models\Spk;
use App\Models\Depo;
use App\Models\Seal;
use App\Models\Penerima;
use App\Models\Pengirim;
use App\Models\PlanLoad;
use App\Models\Stuffing;
use App\Models\AlihKapal;
use App\Models\BatalMuat;
use App\Models\Container;
use App\Models\Pelabuhan;
use App\Models\OngkoSupir;
use App\Models\ProcessLoad;
use App\Models\VendorMobil;
use Illuminate\Support\Str;
use App\Models\BiayaLainnya;
use App\Models\RekeningBank;
use Illuminate\Http\Request;
use App\Models\PlanDischarge;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\SealContainer;
use App\Models\TypeContainer;
use App\Models\ShippingCompany;
use App\Models\InvoiceDischarge;
use App\Models\TanggalBayarDischarge;
use App\Models\PlanDischargeContainer;
use Illuminate\Support\Facades\Storage;
use Webklex\PDFMerger\Facades\PDFMergerFacade as PDFMerger;

class ReportDischargeController extends Controller
{
    public function report_load(Request $request){

        $loads = PlanDischarge::orderBy('id', 'DESC')->where('status', 'Process-Discharge')->orWhere('status', 'Realisasi')->get();
        $containers_group = PlanDischargeContainer::select('job_id', 'size', 'type', 'cargo', 'jumlah_kontainer' )->groupBy('job_id', 'size', 'type', 'cargo', 'jumlah_kontainer')->get();
        $containers = PlanDischargeContainer::all();

        return view('report.discharge.summary-report-load', [

            'title'=> 'Summary Report Discharge',
            'active' => 'load',
            'loads' => $loads,
            'containers_group' => $containers_group,
            'containers' => $containers,


        ]);
    }
    public function download_sload(Request $request)
    {
        // dd($request->slug);

        $report = "DISCHARGE";


        $old_slug = $request->slug;
        $old_id = PlanDischarge::where('slug', $old_slug)->value('id');
        $loads = PlanDischarge::where('id', $old_id)->get();
        $dt = Carbon::now()->isoFormat('YYYY-MMMM-DDDD-dddd-HH-mm-ss');


        $path1 = 'storage/report/Summary-Report.pdf';
        // dd($path1);

        $containers = PlanDischargeContainer::where('job_id', $old_id)->get();
        $date = PlanDischargeContainer::select('date_activity')->where('job_id', $old_id)->get()->toArray();

        $min_date = min($date);
        $min_date = implode('', $min_date);

        $max_date = max($date);
        $max_date = implode('', $max_date);



        $pdf = Pdf::loadview('pdf.discharge.pdf-summary-load',[

            "loads" => $loads,
            "containers" => $containers,
            "report" => $report,
            "min_date" => $min_date,
            "max_date" => $max_date,

        ]);
        $pdf->setPaper('A4', 'landscape');

        $pdf->save($path1);

        return response()->download($path1);

    }

    public function report_cload(Request $request){

        $loads = PlanDischarge::orderBy('id', 'DESC')->where('status', 'Process-Discharge')->orWhere('status', 'Realisasi')->get();
        $containers_group = PlanDischargeContainer::select('job_id', 'size', 'type', 'cargo', 'jumlah_kontainer' )->groupBy('job_id', 'size', 'type', 'cargo', 'jumlah_kontainer')->get();
        $containers = PlanDischargeContainer::all();

        return view('report.discharge.cost-report-load', [

            'title'=> 'Cost Report Discharge',
            'active' => 'DISCHARGE',
            'loads' => $loads,
            'containers_group' => $containers_group,
            'containers' => $containers,


        ]);
    }

    public function download_cload(Request $request)
    {
        // dd($request->slug);

        $report = "DISCHARGE";


        $old_slug = $request->slug;
        $old_id = PlanDischarge::where('slug', $old_slug)->value('id');
        $loads = PlanDischarge::where('id', $old_id)->get();
        $dt = Carbon::now()->isoFormat('YYYY-MMMM-DDDD-dddd-HH-mm-ss');


        $path1 = 'storage/report/Cost-Report.pdf';
        // dd($path1);

        $containers = PlanDischargeContainer::where('job_id', $old_id)->get();
        $date = PlanDischargeContainer::select('date_activity')->where('job_id', $old_id)->get()->toArray();

        $min_date = min($date);
        $min_date = implode('', $min_date);

        $max_date = max($date);
        $max_date = implode('', $max_date);



        $pdf = Pdf::loadview('pdf.discharge.pdf-cost-report',[

            "loads" => $loads,
            "containers" => $containers,
            "report" => $report,
            "min_date" => $min_date,
            "max_date" => $max_date,

        ]);
        $pdf->setPaper('A4', 'landscape');

        $pdf->save($path1);

        return response()->download($path1);

    }

    public function report_coload(Request $request){

        $report = 'DISCHARGE';
        $loads = PlanDischarge::orderBy('id', 'DESC')->where('status', 'Process-Discharge')->orWhere('status', 'Realisasi')->get();
        $containers = PlanDischargeContainer::orderBy('id', 'DESC')->where('status', 'Process-Discharge')->orWhere('status', 'Realisasi')->get();

        return view('report.discharge.container-report-load', [

            'title'=> 'Container Report Discharge',
            'active' => 'load',
            'loads' => $loads,
            'report' => $report,
            'containers' => $containers,


        ]);
    }

    public function download_coload(Request $request)
    {
        // dd($request->id);

        $report = "DISCHARGE";


        $old_slug = $request->id;


        $loads = PlanDischarge::where('status', 'Process-Discharge')->orWhere('status', 'Realisasi')->get();
        $containers = PlanDischargeContainer::where('id', $old_slug )->get();



        $path1 = 'storage/report/Container-Report.pdf';
        $pdf = Pdf::loadview('pdf.discharge.container',[

            'title'=> 'Container Report Discharge',
            'active' => 'LOAD',
            'loads' => $loads,
            'report' => $report,
            'containers' => $containers,

        ]);

        $pdf->save($path1);

        return response()->download($path1);

    }

    public function invoice(Request $request){

        $report = 'DISCHARGE';
        $loads = PlanDischarge::orderBy('id', 'DESC')->Where('status', 'Realisasi')->get();
        $containers_group = PlanDischargeContainer::select('job_id', 'size', 'type', 'cargo', 'jumlah_kontainer' )->groupBy('job_id', 'size', 'type', 'cargo', 'jumlah_kontainer')->get();
        $containers = PlanDischargeContainer::orderBy('id', 'DESC')->where('status', 'Realisasi')->get();

        return view('invoice.pages.discharge', [

            'title'=> 'Invoice-Discharge',
            'active' => 'Discharge',
            'loads' => $loads,
            'containers' => $containers,
            'report' => $report,
            'containers_group' => $containers_group,


        ]);
    }

    public function invoice_create(Request $request)
    {
        // dd($request);
        // dd($slug);
        $id = PlanDischarge::where('slug', $request->slug)->value('id');

        $activity = Stuffing::all();
        $shipping_company = ShippingCompany::all();
        $pol = Pelabuhan::all();
        $pot = Pelabuhan::all();
        $pod = Pelabuhan::all();
        $pengirim = Pengirim::all();
        $penerima = Penerima::all();
        $kontainer = Container::all();
        $lokasis = Depo::all();
        $seals = Seal::all();
        $sizes = Container::all();
        $types = TypeContainer::all();
        $danas = OngkoSupir::all();


     
        $containers = PlanDischargeContainer::where('job_id', $id)->whereNotNull("tanggal_mty")->get();
        // dd($container_si);

        $sealsc = SealContainer::where('job_id_discharge', $id)->get();

        // dd($containers);

        $vendors = VendorMobil::orderBy('id', 'DESC')->get();

        $select_company = PlanDischarge::where('slug', $request->slug)->value('select_company');
        $pelayaran_id = ShippingCompany::where('nama_company', $select_company)->value('id');
        $spks = Spk::where('pelayaran_id', $pelayaran_id)->get();


        $reports = TanggalBayarDischarge::orderBy('slug')->where("job_id", $id)->get()->groupBy('slug')->toArray();

        $newArray = [];
        foreach ($reports as $res) {
            $newArray[] = array_values($res);
        }

        // dd($newArray);

        $reports_array = [];
        for ($i=0; $i <count($newArray) ; $i++) { 
            $reports_array[$i] = [];
            for ($j=0; $j <count($newArray[$i]) ; $j++) { 
                $reports_array[$i][$j] = new TanggalBayarDischarge([
                    'id' => $newArray[$i][$j]['id'],
                    'tanggal_bayar' => $newArray[$i][$j]['tanggal_bayar'],
                    'job_id' => $newArray[$i][$j]['job_id'],
                    'invoice_id' => $newArray[$i][$j]['invoice_id'],
                    'slug' => $newArray[$i][$j]['slug'],
                    'pembayaran' => $newArray[$i][$j]['pembayaran'],
                ]);
            }
        }
    

        return view('invoice.pages.discharge-create',[
            'title' => 'Invoice-Discharge',
            'active' => 'invoice',
            'activity' => $activity,
            'shippingcompany' => $shipping_company,
            'pol' => $pol,
            'pot' => $pot,
            'pod' => $pod,
            'pengirims' => $pengirim,
            'penerimas' => $penerima,
            'kontainers' => $kontainer,
            'lokasis' => $lokasis,
            'seals' => $seals,
            // 'modals' => $modals,
            'sizes' => $sizes,
            'types' => $types,
            'danas' => $danas,
            'sealsc' => $sealsc,
            'reports' => $reports_array,
            'vendors' => $vendors,
            'spks' => $spks,
            'planload' => PlanDischarge::find($id),
            'containers' => $containers,
            'biayas' => BiayaLainnya::where('job_id', $id)->get(),
            'alihs' => AlihKapal::where('job_id', $id)->whereHas('container_planloads',function($q) {
                $q->whereNotNull('demurrage');
            })->get(),
            'pdfs' => InvoiceDischarge::where('job_id', $id)->whereNotNull("path")->get(),
            'batals' => BatalMuat::where('job_id', $id)->get(),

        ]);
    }

    public function masukkan_invoice(Request $request)
    {
        // dd($request);

        $Container = PlanDischargeContainer::findOrFail($request->id);
        // $random = Str::random(15);

        $data = [

            "price_invoice" => $request->price_invoice,
            "kondisi_invoice" => $request->kondisi_invoice,
            "keterangan_invoice" => $request->keterangan_invoice,
            // 'status_invoice' => $random.time(),


        ];

        $Container->update($data);

        return response()->json(['success' => true]);

    }
    public function getPod(Request $request){
        $pod = [];
        $nomor_invoice = [];

        $job_id = PlanDischargeContainer::where("id", $request->pod[0])->value("job_id");

        for($i = 0; $i < count($request->pod); $i++) {
            $pod[$i] = PlanDischarge::where('id', $job_id)->value('pod');
            $nomor_invoice[$i] = PlanDischargeContainer::where('id', $request->pod[$i])->value('status_invoice');
        }

        return response()->json([
            "pod" => $pod,
            "nomor_invoice" => $nomor_invoice
        ]);
    }

    public function getInvoice(Request $request){
        // dd($request);
        $old_slug = $request->old_slug;

        $invoice_tahun = InvoiceDischarge::where('tahun_invoice', $request->tahun)->get();

        $sum_invoice_tahun = count($invoice_tahun) + 1;

        $order_job = PlanDischarge::where('slug', $old_slug)->get();

        $pol_area_code = Pelabuhan::where('nama_pelabuhan', $order_job[0]->pol)->value('area_code');
        $vessel = $order_job[0]->vessel;
        $vessel_code = $order_job[0]->vessel_code;
        $pod_area_code = Pelabuhan::where('nama_pelabuhan', $request->pod)->value('area_code');

        return response()->json([
            'pol' => $pol_area_code,
            'vessel' => $vessel,
            'vessel_code' => $vessel_code,
            'pod' => $pod_area_code,
            'jumlah' => $sum_invoice_tahun
        ]);

    }

    public function pdf_invoice(Request $request)
    {
        // dd($request);
        $random = Str::random(15).time();
        $old_slug = $request->old_slug;
        $nomor_invoice = $request->nomor_invoice;
        $old_id = PlanDischarge::where('slug', $old_slug)->value('id');
        // dd($old_id);
        $loads = PlanDischarge::find($old_id);

        $no_incvoice = [];
        for($i = 0; $i < count($request->check_container); $i++) {
            $no_incvoice[$i] = PlanDischargeContainer::where('id', $request->check_container[$i])->value('status_invoice');
        }
        $no_invoice_unique = array_unique($no_incvoice);
        
        $no_invoice_2 = InvoiceDischarge::where('nomor_invoice', $no_invoice_unique[0])->value('id');
        // dd($no_invoice_unique);

        if($no_invoice_2 == null) {
            $si_pdf =[
                'yth' => $request->yth,
                'km' => $request->km,
                'status' => $request->status,
                'nomor_invoice' => $nomor_invoice,
                'tahun_invoice' => $request->tahun,
                'tanggal_invoice' => $request->tanggal,
                'job_id' => $old_id,
                'container_id' => $random,
                'path' => 'Invoice-Discharge-'.$old_slug.'-'.$random,
            ];
            
            $sis = InvoiceDischarge::create($si_pdf);
        } else {
            $si_pdf = [
                'yth' => $request->yth,
                'km' => $request->km,
                'status' => $request->status,
                'nomor_invoice' => $no_invoice_unique[0],
                'tahun_invoice' => $request->tahun,
                'tanggal_invoice' => $request->tanggal,
                'job_id' => $old_id,
                'container_id' => $random,
                'path' => 'Invoice-Discharge-'.$old_slug.'-'.$random,
            ];

            $sis = InvoiceDischarge::where('id', $no_invoice_2)->update($si_pdf);
            // $sis = InvoiceDischarge::where('id', $no_invoice_2)->get();
        }
        // dd($no_invoice_2);




        for ($i=0; $i < count($request->check_container) ; $i++) {
            if($no_incvoice[$i] == null) {
                $container = [
                    'status' => "Realisasi",
                ];
                $container2 = [
                    'invoice' => $sis->id,
                    'status' => $request->status,
                    'status_invoice' => $nomor_invoice,
                    'slug' => $random,
                ];
    
                PlanDischarge::where('id', $old_id)->update($container);
                PlanDischargeContainer::where('id',$request->check_container[$i])->update($container2);
            } else {
                $container = [
                    'status' => "Realisasi",
                ];
                $container2 = [
                    'invoice' => $no_invoice_2,
                    'status' => $request->status,
                    'status_invoice' => $no_incvoice[$i],
                    'slug' => $random,

                ];
    
                PlanDischarge::where('id', $old_id)->update($container);
                PlanDischargeContainer::where('id',$request->check_container[$i])->update($container2);
            }
        }

        $checked = [];
        $containers = [];
        $get_container = [];


        for($i = 0; $i < count($request->check_container); $i++) {
            $checked[$i] =   $request->check_container[$i];
        }
        // dd($checked);

         for($j = 0; $j < count($checked); $j++) {
            $containers[$j] = [];
            $get_container[$j] = PlanDischargeContainer::where('id', $checked[$j])->get();
            // dd($get_container);
            for ($k=0; $k < count($get_container[$j]) ; $k++) {
                $containers[$j][$k] = PlanDischargeContainer::where('id',$get_container[$j][$k]->id)->get();
            }
        }



        $new_container = [];

        // dd($request->ppn);

        if((int)$request->ppn == 0) {
            $ppn = 0;
        } else {
            $ppn = PPN::first()->value('ppn');
        }

        // dd($ppn);

        if((int)$request->materai == 0) {
            $materai = 0;
        } else {
            $materai = $request->value_materai;
        }

        $total = 0;
        for($i = 0; $i < count($containers); $i++) {
            $total += (Float)$containers[$i][0][0]->price_invoice;
            $new_container[$i] = [
                'id' => $containers[$i][0][0]->id,
                'job_id' => $containers[$i][0][0]->job_id,
                'penerima' => $containers[$i][0][0]->penerima,
                'lokasi_kembali' => $containers[$i][0][0]->lokasi_kembali,
                'nomor_kontainer' => $containers[$i][0][0]->nomor_kontainer,
                'size' => $containers[$i][0][0]->size,
                'type' => $containers[$i][0][0]->type,
                'kondisi_invoice' => $containers[$i][0][0]->kondisi_invoice,
                'keterangan_invoice' => $containers[$i][0][0]->keterangan_invoice,
                'price_invoice' => $containers[$i][0][0]->price_invoice,
            ];
        }

        $total_with_ppn_materai = $total + round($total * ((Float)$ppn / (Float)100)) + (Float)$materai;
        // dd($new_container);

        $total_invoice = [
            "total" => $total_with_ppn_materai,
        ];
        if($no_invoice_2 == null) {
            InvoiceDischarge::find($sis->id)->update($total_invoice);
        } else {
            InvoiceDischarge::find($no_invoice_2)->update($total_invoice);
        }



        $rekenings = RekeningBank::orderBy('id', 'DESC')->get();


        $seal_container = [];
        $dt = Carbon::now()->isoFormat('YYYY-MMMM-DDDD-dddd-HH-mm-ss');

        $save1 = 'storage/discharge-invoice/Invoice-Discharge-'.$old_slug.'-'.$random.'.pdf';


        if($no_invoice_2 == null) {
            $pdf1 = Pdf::loadview('invoice.pdf.invoice-discharge',[
                "load" => $loads,
                "containers" => $new_container,
                "yth" => $request->yth,
                "nomor_invoice" => $nomor_invoice,
                "km" => $request->km,
                "report" => "MUATAN",
                "status" => $request->status,
                'rekenings' => $rekenings,
                'ppn' => round($total * ((Float)$ppn / (Float)100)),
                'persen_ppn' => $ppn,
                'materai' => $materai,
                'total' => $total_with_ppn_materai,
            ]);
    
            $pdf1->save($save1);
            return response()->download($save1);
        } else {
            $pdf1 = Pdf::loadview('invoice.pdf.invoice-discharge',[
                "load" => $loads,
                "containers" => $new_container,
                "yth" => $request->yth,
                "nomor_invoice" => $no_invoice_unique[0],
                "km" => $request->km,
                "report" => "MUATAN",
                "status" => $request->status,
                'rekenings' => $rekenings,
                'ppn' => round($total * ((Float)$ppn / (Float)100)),
                'persen_ppn' => $ppn,
                'materai' => $materai,
                'total' => $total_with_ppn_materai,
            ]);
    
            $pdf1->save($save1);
            return response()->download($save1);
        }
    }

    public function preview_invoice(Request $request)

    {
        $id = InvoiceDischarge::where('path', $request->path)->value('id');
        $job_id = InvoiceDischarge::where('path', $request->path)->value('job_id');
        $pdf= InvoiceDischarge::findOrFail($id);

        return view('invoice.pdf.preview-invoice-discharge', [
            'title' => 'Preview Invoice Discharge',
            'active' => 'Invoice',
            'pdf' => $pdf,
            'planload' => PlanDischarge::find($job_id),


        ]);
    }

    public function delete_invoice(Request $request)
    {

        $job_id = InvoiceDischarge::where('id',$request->id)->value('job_id');
        $nomor_invoice = InvoiceDischarge::where('id',$request->id)->value('nomor_invoice');
        $pdf = InvoiceDischarge::findOrFail($request->id);
        $path = InvoiceDischarge::where('id',$request->id)->value('path');

      
        
        $status1 = [
            "status"=> "Process",
        ];
        
        Storage::delete('public/discharge-invoice/'.$path.'.pdf');

        $container = PlanDischargeContainer::where('status_invoice', $nomor_invoice)->update($status1);


        $invoice = [
            // "job_id"=> null,
            // "container_id"=> null,
            // "tanggal_invoice"=> null,
            "path"=> null,
            // "yth"=> null,
            // "km"=> null,
            "status"=> null,

        ];
        $pdf->update($invoice);

        return response()->json([
            'success'   => true
        ]);

    }

    public function delete_history(Request $request)
    {
        // dd($request);
        $slug = $request->slug;
        $report_vendor = TanggalBayarDischarge::where('slug', $slug)->get();

        $total_bayar = [];
        for($i = 0; $i < count($report_vendor); $i++) {
            $total_bayar[$i] = (int) $report_vendor[$i]->rincian;
        }
      
        for($i = 0; $i < count($report_vendor); $i++) {
            $dibayar = (int)InvoiceDischarge::where('id', $report_vendor[$i]->invoice_id)->value('terbayar');

            $total_bayar_2 = $dibayar - $total_bayar[$i];
            $berbayar = [
                "pembayaran" => $total_bayar_2
            ];
            $report_vendor[$i]->update($berbayar);

            if($total_bayar_2 == 0) {
                $berbayar_container = [
                    "terbayar" => 0
                ];
                InvoiceDischarge::where('id', $report_vendor[$i]->invoice_id)->update($berbayar_container);
            } else {
                $berbayar_container = [
                    "terbayar" => $total_bayar_2
                ];
                InvoiceDischarge::where('id', $report_vendor[$i]->invoice_id)->update($berbayar_container);
            }
        }

        TanggalBayarDischarge::where("slug", $slug)->delete();

        // Storage::delete('public/report/'.$path.'.pdf');

        return response()->json([
            'success'   => true
        ]);



    }



  
}
