<?php

namespace App\Http\Controllers;

use App\Models\Spk;
use App\Models\Depo;
use App\Models\Seal;
use App\Models\Penerima;
use App\Models\Pengirim;
use App\Models\Stuffing;
use App\Models\AlihKapal;
use App\Models\BatalMuat;
use App\Models\Container;
use App\Models\Pelabuhan;
use App\Models\OngkoSupir;
use App\Models\InvoiceLoad;
use App\Models\VendorMobil;
use Illuminate\Support\Str;
use App\Models\BiayaLainnya;
use App\Models\RekeningBank;
use Illuminate\Http\Request;
use App\Models\SealContainer;
use App\Models\TypeContainer;
use App\Models\SiPdfContainer;
use Illuminate\Support\Carbon;
use App\Models\ShippingCompany;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\DetailBarangLoad;
use App\Models\OrderJobPlanload;
use App\Models\ContainerPlanload;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class InvoiceLoadController extends Controller
{

    public function invoice(Request $request){

        $planloads = OrderJobPlanload::orderby('created_at', 'desc')->where('status', 'Process-Load')->orWhere('status', 'Realisasi')->get();
        $containers = ContainerPlanload::all();
        $containers_group = ContainerPlanload::select('job_id', 'size', 'type', 'cargo', 'jumlah_kontainer' )->groupBy('job_id', 'size', 'type', 'cargo', 'jumlah_kontainer')->get();
        $select_company =  OrderJobPlanload::all()->unique('select_company');
        $vessel =  OrderJobPlanload::all()->unique('vessel');


        $biayas= BiayaLainnya::all();
        $alihkapal= AlihKapal::all();
        $batalmuat= BatalMuat::all();

        return view('invoice.pages.load', [

            'title'=> 'INVOICE LOAD',
            'active' => 'load',
            'loads' => $planloads,
            'containers' => $containers,
            'containers_group' => $containers_group,
            'select_company' => $select_company,
            'vessel' => $vessel,
            'biayas' => $biayas,
            'alihkapal' => $alihkapal,
            'batalmuat' => $batalmuat,


        ]);
    }

    public function create_invoice(Request $request)
    {
        $id = OrderJobPlanload::where('slug', $request->slug)->value('id');

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


        $containers = ContainerPlanload::where('job_id', $id)->where(function($query) {
            $query->where('status', '!=', 'Batal-Muat')
            ->where('status', '!=', 'Alih-Kapal')
            ->where('status', '!=', 'Realisasi-Alih');
        })->get();

        $sealsc = SealContainer::where('job_id', $id)->get();

        // dd($containers);

        $vendors = VendorMobil::orderBy('id', 'DESC')->get();

        $select_company = OrderJobPlanload::where('slug', $request->slug)->value('select_company');
        $pelayaran_id = ShippingCompany::where('nama_company', $select_company)->value('id');
        $spks = Spk::where('pelayaran_id', $pelayaran_id)->get();


        //
        return view('invoice.pages.load-create',[
            'title' => 'Invoice LOAD',
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
            'sizes' => $sizes,
            'types' => $types,
            'danas' => $danas,
            'sealsc' => $sealsc,
            'vendors' => $vendors,
            'spks' => $spks,
            'planload' => OrderJobPlanload::find($id),
            'containers' => $containers,
            'biayas' => BiayaLainnya::where('job_id', $id)->get(),
            'alihs' => AlihKapal::where('job_id', $id)->get(),
            'pdfs' => InvoiceLoad::where('job_id', $id)->get(),
            'batals' => BatalMuat::where('job_id', $id)->get(),
            'details' => DetailBarangLoad::where('job_id', $id)->get(),

        ]);
    }

    public function masukkan_invoice(Request $request)
    {

        $Container = ContainerPlanload::findOrFail($request->id);

        $data = [

            "price_invoice" => $request->price_invoice,
            "kondisi_invoice" => $request->kondisi_invoice,
            "keterangan_invoice" => $request->keterangan_invoice,
            "status_invoice" => "ready",


        ];

        $Container->update($data);

        return response()->json(['success' => true]);

    }

    public function pdf_invoice(Request $request)
    {
        $random = Str::random(15);
        $old_slug = $request->old_slug;
        $old_id = OrderJobPlanload::where('slug', $old_slug)->value('id');
        $loads = OrderJobPlanload::where('id', $old_id)->get();


        $si_pdf =[
            'yth' => $request->yth,
            'km' => $request->km,
            'status' => $request->status,
            'job_id' => $old_id,
            'container_id' => $random.time(),
            'path' => 'Invoice-'.$old_slug.'-'.$random.time(),

        ];

        $sis = InvoiceLoad::create($si_pdf);

        for ($i=0; $i < count($request->check_container) ; $i++) {
            $container = [
                'status' => "Realisasi",
            ];
            $container2 = [
                'invoice' => $sis->id,
                'status' => "Realisasi",
                'status_invoice' => "done",
                // 'slug' => $random.time(),
            ];

            OrderJobPlanload::where('id', $old_id)->update($container);
            ContainerPlanload::where('id',$request->check_container[$i])->update($container2);
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
            $get_container[$j] = ContainerPlanload::where('id', $checked[$j])->get();
            // dd($get_container);
            for ($k=0; $k < count($get_container[$j]) ; $k++) {
                $containers[$j][$k] = ContainerPlanload::where('id',$get_container[$j][$k]->id)->get();
            }
        }



        $new_container = [];

        for($i = 0; $i < count($containers); $i++) {
            $new_container[$i] = [
                'id' => $containers[$i][0][0]->id,
                'job_id' => $containers[$i][0][0]->job_id,
                'pengirim' => $containers[$i][0][0]->pengirim,
                'pod_container' => $containers[$i][0][0]->pod_container,
                'nomor_kontainer' => $containers[$i][0][0]->nomor_kontainer,
                'size' => $containers[$i][0][0]->size,
                'kondisi_invoice' => $containers[$i][0][0]->kondisi_invoice,
                'keterangan_invoice' => $containers[$i][0][0]->keterangan_invoice,
                'price_invoice' => $containers[$i][0][0]->price_invoice,

            ];


        }
        // dd($new_container[0]['price_invoice']);

        $total = 100000;

        $rekenings = RekeningBank::orderBy('id', 'DESC')->get();


        $seal_container = [];
        $dt = Carbon::now()->isoFormat('YYYY-MMMM-DDDD-dddd-HH-mm-ss');

        $save1 = 'storage/load-invoice/Invoice-'.$old_slug.'-'.$random.time().'.pdf';

        $pdf1 = Pdf::loadview('invoice.pdf.invoice-load',[
            "loads" => $loads,
            "containers" => $new_container,
            "yth" => $request->yth,
            "km" => $request->km,
            "report" => "MUATAN",
            "status" => $request->status,
            'rekenings' => $rekenings,
            'total' => $total,




        ]);

        $pdf1->save($save1);
        return response()->download($save1);
    }
    public function preview_invoice(Request $request)

    {
        $id = InvoiceLoad::where('path', $request->path)->value('id');
        $job_id = InvoiceLoad::where('path', $request->path)->value('job_id');
        $pdf= InvoiceLoad::findOrFail($id);

        return view('invoice.pdf.preview-invoice-load', [
            'title' => 'Preview Invoice LOAD',
            'active' => 'Realisasi',
            'pdf' => $pdf,
            'planload' => OrderJobPlanload::find($job_id),


        ]);
    }

    public function delete_invoice(Request $request)
    {

        $job_id = InvoiceLoad::where('id',$request->id)->value('job_id');
        $container_id = InvoiceLoad::where('id',$request->id)->value('container_id');
        $pdf = InvoiceLoad::findOrFail($request->id);
        $path = InvoiceLoad::where('id',$request->id)->value('path');



        Storage::delete('public/load-invoice/'.$path.'.pdf');


        // $job = OrderJobPlanload::where('id', $job_id)->update($status);
        // $container = ContainerPlanload::where('slug', $container_id)->update($status);

        $pdf->delete();





        return response()->json([
            'success'   => true
        ]);

    }
}