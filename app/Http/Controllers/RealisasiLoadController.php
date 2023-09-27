<?php

namespace App\Http\Controllers;

use App\Models\RealisasiLoad;
use App\Models\ProcessLoad;
use App\Models\OrderJobPlanload;
use App\Models\ContainerPlanload;
use App\Http\Requests\StoreProcessLoadRequest;
use App\Http\Requests\UpdateProcessLoadRequest;
use App\Models\PlanLoad;
use App\Models\Stuffing;
use App\Models\ShippingCompany;
use App\Models\Pelabuhan;
use App\Models\Pengirim;
use App\Models\Penerima;
use App\Models\Container;
use App\Models\Depo;
use App\Models\Seal;
use App\Models\BiayaLainnya;
use App\Models\OngkoSupir;
use App\Models\TypeContainer;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\AlihKapal;
use App\Models\BatalMuat;
use App\Models\SealContainer;
use App\Models\SiPdfContainer;
use App\Models\DetailBarangLoad;
use App\Models\VendorMobil;
use App\Models\Spk;

class RealisasiLoadController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //

        $planloads = OrderJobPlanload::orderby('created_at', 'desc')->where('status', 'Process-Load')->orWhere('status', 'Realisasi')->get();
        $containers = ContainerPlanload::all();
        $containers_group = ContainerPlanload::select('job_id', 'size', 'type', 'cargo', 'jumlah_kontainer' )->groupBy('job_id', 'size', 'type', 'cargo', 'jumlah_kontainer')->get();
        $select_company =  OrderJobPlanload::all()->unique('select_company');
        $vessel =  OrderJobPlanload::all()->unique('vessel');


        $biayas= BiayaLainnya::all();
        $alihkapal= AlihKapal::all();
        $batalmuat= BatalMuat::all();
        return view('realisasi.load.realisasi',[
            'title' => 'Realisasi (Load)',
            'active' => 'Realisasi',
            'planloads' => $planloads,
            'containers' => $containers,
            'containers_group' => $containers_group,
            'select_company' => $select_company,
            'vessel' => $vessel,
            'biayas' => $biayas,
            'alihkapal' => $alihkapal,
            'batalmuat' => $batalmuat,



        ]);
    }
    public function index_pod()
    {
        //

        $planloads = OrderJobPlanload::orderby('created_at', 'desc')->where('status', 'Process-Load')->orWhere('status', 'Realisasi')->get();
        $containers = ContainerPlanload::all();
        $containers_group = ContainerPlanload::select('job_id', 'size', 'type', 'cargo', 'jumlah_kontainer' )->groupBy('job_id', 'size', 'type', 'cargo', 'jumlah_kontainer')->get();
        $select_company =  OrderJobPlanload::all()->unique('select_company');
        $vessel =  OrderJobPlanload::all()->unique('vessel');


        $biayas= BiayaLainnya::all();
        $alihkapal= AlihKapal::all();
        $batalmuat= BatalMuat::all();
        return view('realisasi.load.realisasi-pod',[
            'title' => 'LOAD (Realisasi-POD)',
            'active' => 'Realisasi POD',
            'planloads' => $planloads,
            'containers' => $containers,
            'containers_group' => $containers_group,
            'select_company' => $select_company,
            'vessel' => $vessel,
            'biayas' => $biayas,
            'alihkapal' => $alihkapal,
            'batalmuat' => $batalmuat,



        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        $id = OrderJobPlanload::where('slug', $request->slug)->value('id');

        $activity = Stuffing::all();
        $shipping_company = ShippingCompany::all();
        $pol = Pelabuhan::all();
        $pot = Pelabuhan::all();
        $pelabuhans = Pelabuhan::all();
        $pengirim = Pengirim::all();
        $penerima = Penerima::all();
        $kontainer = Container::all();
        $lokasis = Depo::all();
        $seals = Seal::all();
        $sizes = Container::all();
        $types = TypeContainer::all();
        $danas = OngkoSupir::all();


        $containers = ContainerPlanload::where('job_id', $id)->whereNull('harga_alih')->where(function($query) {
            $query->where('status', '!=', 'Batal-Muat')
            ->where('status', '!=', 'Alih-Kapal')
            ->where('status', '!=', 'Realisasi-Alih');
        })->get();
        $containers_info = ContainerPlanload::where('job_id', $id)->whereNull('slug')->get();


        $sealsc = SealContainer::where('job_id', $id)->get();

        // dd($containers);

        $vendors = VendorMobil::orderBy('id', 'DESC')->get();

        $select_company = OrderJobPlanload::where('slug', $request->slug)->value('select_company');
        $pelayaran_id = ShippingCompany::where('nama_company', $select_company)->value('id');
        $spks = Spk::where('pelayaran_id', $pelayaran_id)->get();


        //
        return view('realisasi.load.realisasi-create',[
            'title' => 'Realisasi-POL (Load)',
            'active' => 'Realisasi POL',
            'activity' => $activity,
            'shippingcompany' => $shipping_company,
            'pol' => $pol,
            'pot' => $pot,
            'pelabuhans' => $pelabuhans,
            'containers_info' => $containers_info,
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
            'pdfs' => SiPdfContainer::where('job_id', $id)->get(),
            'batals' => BatalMuat::where('job_id', $id)->get(),
            'details' => DetailBarangLoad::where('job_id', $id)->get(),

        ]);
    }
    public function create_pod(Request $request)
    {
        $id = OrderJobPlanload::where('slug', $request->slug)->value('id');

        $activity = Stuffing::all();
        $shipping_company = ShippingCompany::all();
        $pol = Pelabuhan::all();
        $pot = Pelabuhan::all();
        $pod = Pelabuhan::all();
        $pelabuhans = Pelabuhan::all();
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
            ->where('status', '!=', 'Realisasi-Alih')
            ->whereNotNull('slug');
        })->get();
        $pdfs = SiPdfContainer::where('job_id', $id)->where(function($query) {
            $query->where('status', 'BL')
            ->orWhere('status','POD');
        })->get();

        // dd($pdfs);
        $nomor_container = [];
        for($i = 0; $i < count($pdfs); $i++) {
            $nomor_container[$i] = ContainerPlanload::where('slug', $pdfs[$i]->container_id)->get();
        }
        $sum = [];
        for($i = 0; $i < count($nomor_container); $i++) {
            $sum[$i] = 0;
            for($j = 0; $j < count($nomor_container[$i]); $j++) {
                if($nomor_container[$i][$j]->demurrage == null) {
                    $sum[$i] = null;
                    break;
                } else {
                    $sum[$i] = $sum[$i] + $nomor_container[$i][$j]->demurrage;
                }
            }
        }
        // dd($sum);


        $sealsc = SealContainer::where('job_id', $id)->get();

        // dd($containers);

        $vendors = VendorMobil::orderBy('id', 'DESC')->get();

        $select_company = OrderJobPlanload::where('slug', $request->slug)->value('select_company');
        $pelayaran_id = ShippingCompany::where('nama_company', $select_company)->value('id');
        $spks = Spk::where('pelayaran_id', $pelayaran_id)->get();


        //
        return view('realisasi.load.realisasi-pod-create',[
            'title' => 'Realisasi POD (Load)',
            'active' => 'Realisasi POD',
            'activity' => $activity,
            'shippingcompany' => $shipping_company,
            'pol' => $pol,
            'pot' => $pot,
            'pod' => $pod,
            'pelabuhans' => $pelabuhans,
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
            'sums' => $sum, 


            'planload' => OrderJobPlanload::find($id),
            'containers' => $containers,
            'biayas' => BiayaLainnya::where('job_id', $id)->get(),
            'alihs' => AlihKapal::where('job_id', $id)->whereHas('container_planloads',function($q) {
                $q->whereNotNull('slug');
            })->get(),
            'pdfs' => $pdfs,
            'batals' => BatalMuat::where('job_id', $id)->get(),
            'details' => DetailBarangLoad::where('job_id', $id)->get(),

        ]);
    }

    public function masukkan_biaya_pod(Request $request)
    {
        // dd($request);
        $Container = ContainerPlanload::findOrFail($request->id);

        $data = [

            "thc_pod" => $request->thc_pod,
            "lolo" => $request->lolo,
            "dooring" => $request->dooring,
            "demurrage" => $request->demurrage,
            "status_container" => "POD",


        ];

        $Container->update($data);

        return response()->json(['success' => true]);



    }
    public function masukkan_do_fee(Request $request)
    {
        // dd($request);
        $pdf = SiPdfContainer::findOrFail($request->id);

        $data = [

            "biaya_do_pod" => $request->biaya_do_pod,
            "tanggal_do_pod" => $request->tanggal_do_pod,
            "status" => "POD",



        ];

        $pdf->update($data);

        return response()->json(['success' => true]);



    }
    public function detail_pdf($id)
    {
        # code...

        $pdf =SiPdfContainer::find($id);

        return response()->json([
            'result' => $pdf
        ]);


    }
    public function ok_load(Request $request)
    {
        # code...

        // dd($request);

        for ($i=0; $i <count($request->check_job) ; $i++) { 
            
            $data = [
    
                "ok" => 1,
            ];
            ContainerPlanload::where("id", $request->check_job[$i])->update($data);
        }



        return response()->json(['success' => true]);


    }
    public function remove_ok_load(Request $request, $id)
    {
        # code...

        // dd($id);

            
        $data = [

            "ok" => 0,
        ];
        ContainerPlanload::where("id", $id)->update($data);
        



        return response()->json(['success' => true]);


    }

}
