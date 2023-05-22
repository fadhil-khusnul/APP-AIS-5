<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use PDF;
use App\Models\PlanLoad;
use App\Models\AlihKapal;
use App\Models\BatalMuat;
use App\Models\Stuffing;
use App\Models\ShippingCompany;
use App\Models\Pelabuhan;
use App\Models\Pengirim;
use App\Models\Penerima;
use App\Models\Container;
use App\Models\Depo;
use App\Models\Seal;
use App\Models\BiayaLainnya;
use Illuminate\Support\Str;
use App\Models\ProcessLoad;
use App\Models\Trucking;
use App\Models\RekeningBank;

use App\Models\TruckingContainer;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;

use Webklex\PDFMerger\Facades\PDFMergerFacade as PDFMerger;

class ReportTruckingController extends Controller
{
    //
    public function report_load(Request $request){

        $loads = Trucking::orderBy('id', 'DESC')->where('status', 'Process-Trucking')->orWhere('status', 'Realisasi')->get();
        $containers_group = TruckingContainer::select('job_id', 'size', 'type', 'cargo', 'jumlah_kontainer' )->groupBy('job_id', 'size', 'type', 'cargo', 'jumlah_kontainer')->get();
        $containers = TruckingContainer::all();

        return view('report.trucking.summary-report-load', [

            'title'=> 'Summary Report Trucking',
            'active' => 'load',
            'loads' => $loads,
            'containers_group' => $containers_group,
            'containers' => $containers,


        ]);
    }
    public function download_sload(Request $request)
    {
        // dd($request->slug);

        $report = "TRUCKING";


        $old_slug = $request->slug;
        $old_id = Trucking::where('slug', $old_slug)->value('id');
        $loads = Trucking::where('id', $old_id)->get();
        $dt = Carbon::now()->isoFormat('YYYY-MMMM-DDDD-dddd-HH-mm-ss');


        $path1 = 'storage/report/Summary-Report.pdf';
        // dd($path1);

        $containers = TruckingContainer::where('job_id', $old_id)->get();
        $date = TruckingContainer::select('date_activity')->where('job_id', $old_id)->get()->toArray();

        // dd($date);
        $min_date = min($date);
        $min_date = implode('', $min_date);

        $max_date = max($date);
        $max_date = implode('', $max_date);



        $pdf = Pdf::loadview('pdf.trucking.pdf-summary-load',[

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

        $loads = Trucking::orderBy('id', 'DESC')->where('status', 'Process-Trucking')->orWhere('status', 'Realisasi')->get();
        $containers_group = TruckingContainer::select('job_id', 'size', 'type', 'cargo', 'jumlah_kontainer' )->groupBy('job_id', 'size', 'type', 'cargo', 'jumlah_kontainer')->get();
        $containers = TruckingContainer::all();

        return view('report.trucking.cost-report-load', [

            'title'=> 'Cost Report Trucking',
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
        $old_id = Trucking::where('slug', $old_slug)->value('id');
        $loads = Trucking::where('id', $old_id)->get();
        $dt = Carbon::now()->isoFormat('YYYY-MMMM-DDDD-dddd-HH-mm-ss');


        $path1 = 'storage/report/Cost-Report.pdf';
        // dd($path1);

        $containers = TruckingContainer::where('job_id', $old_id)->get();
        $date = TruckingContainer::select('date_activity')->where('job_id', $old_id)->get()->toArray();

        $min_date = min($date);
        $min_date = implode('', $min_date);

        $max_date = max($date);
        $max_date = implode('', $max_date);



        $pdf = Pdf::loadview('pdf.trucking.pdf-cost-report',[

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

        $report = 'TRUCKING';
        $loads = Trucking::orderBy('id', 'DESC')->where('status', 'Process-Trucking')->orWhere('status', 'Realisasi')->get();
        $containers = TruckingContainer::orderBy('id', 'DESC')->where('status', 'Process-Trucking')->orWhere('status', 'Realisasi')->get();

        return view('report.trucking.container-report-load', [

            'title'=> 'Container Report Trucking',
            'active' => 'load',
            'loads' => $loads,
            'report' => $report,
            'containers' => $containers,


        ]);
    }

    public function download_coload(Request $request)
    {
        // dd($request->id);

        $report = "TRUCKING";


        $old_slug = $request->id;


        $loads = Trucking::where('status', 'Process-Trucking')->orWhere('status', 'Realisasi')->get();
        $containers = TruckingContainer::where('id', $old_slug )->get();



        $path1 = 'storage/report/Container-Report.pdf';
        $pdf = Pdf::loadview('pdf.trucking.container',[

            'title'=> 'Container Report Trucking',
            'active' => 'LOAD',
            'loads' => $loads,
            'report' => $report,
            'containers' => $containers,

        ]);

        $pdf->save($path1);

        return response()->download($path1);

    }

    public function invoice(Request $request){

        $report = 'TRUCKING';
        $loads = Trucking::orderBy('id', 'DESC')->Where('status', 'Realisasi')->get();
        $containers_group = TruckingContainer::select('job_id', 'size', 'type', 'cargo', 'jumlah_kontainer' )->groupBy('job_id', 'size', 'type', 'cargo', 'jumlah_kontainer')->get();
        $containers = TruckingContainer::orderBy('id', 'DESC')->where('status', 'Realisasi')->get();

        return view('invoice.pages.trucking', [

            'title'=> 'INVOICE TRUCKING',
            'active' => 'TRUCKING',
            'loads' => $loads,
            'containers' => $containers,
            'report' => $report,
            'containers_group' => $containers_group,


        ]);
    }


    public function invoice_download(Request $request)
    {
        // dd($request->id);

        $report = "TRUCKING";
        $rekenings = RekeningBank::orderBy('id', 'DESC')->get();


        $old_slug = $request->slug;
        $old_id = Trucking::where('slug', $old_slug)->value('id');

        $loads = Trucking::where('id', $old_id)->get();

        $containers = TruckingContainer::where('job_id', $old_id)->get();


        $total ="1000000";

        $path1 = 'storage/report/Invoice.pdf';
        $pdf = Pdf::loadview('invoice.pdf.invoice-trucking',[

            'title'=> 'INVOICE TRUCKING',
            'active' => 'TRUCKING',
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
