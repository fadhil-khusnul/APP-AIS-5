<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
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
use App\Models\SealContainer;
use App\Models\TypeContainer;

use App\Models\SiPdfContainer;
use App\Models\ShippingCompany;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\DetailBarangLoad;
use App\Models\OrderJobPlanload;
use App\Models\ContainerPlanload;
use App\Http\Controllers\Controller;
use App\Models\PlanDischargeContainer;
use Illuminate\Support\Facades\Storage;
use Webklex\PDFMerger\Facades\PDFMergerFacade as PDFMerger;

class ReportController extends Controller
{
    public function report_load(Request $request){

        $loads = OrderJobPlanload::orderBy('id', 'DESC')->where('status', 'Process-Load')->orWhere('status', 'Realisasi')->orWhere("status", "Default")->get();
        $containers_group = ContainerPlanload::select('job_id', 'size', 'type', 'cargo', 'jumlah_kontainer' )->groupBy('job_id', 'size', 'type', 'cargo', 'jumlah_kontainer')->get();
        $containers = ContainerPlanload::all();

        return view('report.load.summary-report-load', [

            'title'=> 'Summary Report Load',
            'active' => 'load',
            'loads' => $loads,
            'containers_group' => $containers_group,
            'containers' => $containers,


        ]);
    }
    public function download_sload(Request $request)
    {
        // dd($request->slug);

        $report = "LOAD";


        $old_slug = $request->slug;
        $old_id = OrderJobPlanload::where('slug', $old_slug)->value('id');
        $loads = OrderJobPlanload::where('id', $old_id)->get();
        $dt = Carbon::now()->isoFormat('YYYY-MMMM-DDDD-dddd-HH-mm-ss');


        $path1 = 'storage/report/Summary-'.$old_slug.'.pdf';
        // dd($path1);

        $containers = ContainerPlanload::where('job_id', $old_id)->get();
        $date = ContainerPlanload::select('date_activity')->where('job_id', $old_id)->get()->toArray();

        $min_date = min($date);
        $min_date = implode('', $min_date);

        $max_date = max($date);
        $max_date = implode('', $max_date);



        $pdf = Pdf::loadview('pdf.load.pdf-summary-load',[

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

        $loads = OrderJobPlanload::orderBy('id', 'DESC')->where('status', 'Process-Load')->orWhere('status', 'Realisasi')->get();
        $containers_group = ContainerPlanload::select('job_id', 'size', 'type', 'cargo', 'jumlah_kontainer' )->groupBy('job_id', 'size', 'type', 'cargo', 'jumlah_kontainer')->get();
        $containers = ContainerPlanload::all();

        return view('report.load.cost-report-load', [

            'title'=> 'Cost Report Load',
            'active' => 'load',
            'loads' => $loads,
            'containers_group' => $containers_group,
            'containers' => $containers,


        ]);
    }

    public function download_cload(Request $request)
    {
        // dd($request->slug);

        $report = "LOAD";


        $old_slug = $request->slug;
        $old_id = OrderJobPlanload::where('slug', $old_slug)->value('id');
        $loads = OrderJobPlanload::where('id', $old_id)->get();
        $dt = Carbon::now()->isoFormat('YYYY-MMMM-DDDD-dddd-HH-mm-ss');


        $path1 = 'storage/report/Cost-'.$old_slug.'.pdf';
        // dd($path1);

        $containers = ContainerPlanload::where('job_id', $old_id)->get();
        $date = ContainerPlanload::select('date_activity')->where('job_id', $old_id)->get()->toArray();

        $min_date = min($date);
        $min_date = implode('', $min_date);

        $max_date = max($date);
        $max_date = implode('', $max_date);



        $pdf = Pdf::loadview('pdf.load.pdf-cost-report',[

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

        $report = 'LOAD';
        $loads = OrderJobPlanload::orderBy('id', 'DESC')->where('status', 'Process-Load')->orWhere('status', 'Realisasi')->get();
        $containers = ContainerPlanload::orderBy('id', 'DESC')->where('status', 'Process-Load')->orWhere('status', 'Realisasi')->get();

        return view('report.load.container-report-load', [

            'title'=> 'Container Report Load',
            'active' => 'load',
            'loads' => $loads,
            'report' => $report,
            'containers' => $containers,


        ]);
    }

    public function download_coload(Request $request)
    {
        // dd($request->id);

        $report = "LOAD";


        $old_slug = $request->id;


        $loads = OrderJobPlanload::where('status', 'Process-Load')->orWhere('status', 'Realisasi')->get();
        $containers = ContainerPlanload::where('id', $old_slug )->get();



        $path1 = 'storage/report/Container-Report.pdf';
        $pdf = Pdf::loadview('pdf.load.container',[

            'title'=> 'Container Report Load',
            'active' => 'LOAD',
            'loads' => $loads,
            'report' => $report,
            'containers' => $containers,

        ]);

        $pdf->save($path1);

        return response()->download($path1);

    }

   


    public function invoice_download(Request $request)
    {
        // dd($request->id);

        $report = "LOAD";
        $rekenings = RekeningBank::orderBy('id', 'DESC')->get();


        $old_slug = $request->slug;
        $old_id = OrderJobPlanload::where('slug', $old_slug)->value('id');

        $loads = OrderJobPlanload::where('id', $old_id)->get();

        $containers = ContainerPlanload::where('job_id', $old_id)->get();


        $total ="1000000";

        $path1 = 'storage/report/Invoice.pdf';
        $pdf = Pdf::loadview('invoice.pdf.invoice-load',[

            'title'=> 'INVOICE LOAD',
            'active' => 'LOAD',
            'loads' => $loads,
            'total' => $total,
            'report' => $report,
            'rekenings' => $rekenings,
            'containers' => $containers,

        ]);

        $pdf->save($path1);

        return response()->download($path1);

    }







}
