<?php

namespace App\Http\Controllers;

use App\Models\Trucking;
use App\Models\TruckingContainer;
use Illuminate\Http\Request;
use App\Models\PlanLoad;
use App\Models\Stripping;
use App\Models\ShippingCompany;
use App\Models\Pelabuhan;
use App\Models\Pengirim;
use App\Models\Penerima;
use App\Models\OrderJobPlanload;
use App\Models\Container;
use App\Models\TypeContainer;
use App\Http\Requests\StorePlanLoadRequest;
use App\Http\Requests\UpdatePlanLoadRequest;
use Illuminate\Support\Str;
use App\Models\AlihKapal;
use App\Models\BatalMuat;
use App\Models\Seal;
use App\Models\Depo;
use App\Models\BiayaLaintrucking;

class TruckingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $truckings = Trucking::orderBy('id', 'DESC')->where('status', 'Plan')->get();
        $containers = TruckingContainer::all();
        $select_company =  Trucking::all()->unique('pelayaran');
        $vessel =  Trucking::all()->unique('vessel');
        $containers_group = TruckingContainer::select('job_id', 'size', 'type', 'cargo', 'jumlah_kontainer' )->groupBy('job_id', 'size', 'type', 'cargo', 'jumlah_kontainer')->get();

        return view('plan.trucking.trucking-plan', [
            'title' => 'Trucking-Plan',
            'active' => 'Trucking',
            'truckings' => $truckings,
            'vessel' => $vessel,
            'select_company' => $select_company,
            'containers' => $containers_group,

        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $activity = Stripping::all();
        $shipping_company = ShippingCompany::all();

        $pengirim = Pengirim::all();
        $penerima = Penerima::all();
        $kontainer = Container::all();
        $sizes = Container::all();
        $types = TypeContainer::all();

        return view('plan.trucking.plantrucking-create',[
            'title' => 'Plan-Trucking',
            'activities' => $activity,
            'active' => 'Trucking',
            'shippingcompany' => $shipping_company,

            'pengirim' => $pengirim,
            'penerima' => $penerima,
            'kontainer' => $kontainer,
            'sizes' => $sizes,
            'types' => $types,
            
            ]);
    }



    /**
     * Store a newly created resource in storage.
     */
   public function create_job_Trucking(Request $request)
    {
        // dd($request);
        $random = Str::random(15);

        $company = $request->select_company;
        $company = str_replace('.', '_', $company);
        $company = str_replace('/','-', $company);
        $company = str_replace(' ','-', $company);

        $vessel = $request->vessel;
        $vessel = str_replace('.', '_', $vessel);
        $vessel = str_replace('/','-', $vessel);
        $vessel = str_replace(' ','-', $vessel);

        $slug = $company.'-'.$vessel.'-'.$request->vessel_code.'-'.$random;

        $orderJob = [
            'tanggal' => $request->tanggal,
            'vessel' => $request->vessel,
            'vessel_code' => $request->vessel_code,
            'select_company' => $request->select_company,
            'pengirim' => $request->pengirim,
            'penerima' => $request->penerima,
            'activity' => $request->activity,
            'emkl' => $request->emkl,
            'slug' => $slug,
            'status' => "Plan",
        ];

        Trucking::create($orderJob);

        // $id = Trucking::where('slug', $slug)->value('id');

        // $job_id = [];

        // $tambah = $request->tambah;

        // $jumlah_kontainer = [];
        // $size = [];
        // $type = [];
        // $cargo = [];

        // for ($j = 0; $j < $tambah; $j++) {
        //     $job_id[$j] = $id;
        //     $jumlah_kontainer[$j] = (int)$request->jumlah_kontainer[$j];
        //     $size[$j] = [];
        //     $type[$j] = [];
        //     $cargo[$j] = [];
        //     // $tambah2[$j] = [];
        //     for ($i = 0; $i < $jumlah_kontainer[$j]; $i++) {

        //         $container = [
        //             'job_id' => $job_id[$j],
        //             'jumlah_kontainer' => $jumlah_kontainer[$j],
        //             'size' => $request->size[$j][$i],
        //             'type' => $request->type[$j][$i],
        //             'cargo' => $request->cargo[$j][$i],
        //         ];
        //         TruckingContainer::create($container);
        //     }
        // }

        return response()->json([
            'success' => true, 
            'slug' => $slug
        ]);

    }

    public function edit(Request $request, $slug)
    {
        $id = Trucking::where('slug', $slug)->value('id');

        $activity = Stripping::where('jenis_kegiatan', 'Stripping')->get();
        $shipping_company = ShippingCompany::all();
        $pol = Pelabuhan::all();
        $pot = Pelabuhan::all();
        $pod = Pelabuhan::all();
        $pengirim = Pengirim::all();
        $penerima = Penerima::all();
        $size = Container::all();
        $type = TypeContainer::all();
        // dd($activity);
        return view('plan.trucking.plantrucking-edit', [
            'title' => 'Plan-Trucking',
            'active' => 'Plan',
            'activities' => $activity,
            'shippingcompany' => $shipping_company,
            'pol' => $pol,
            'pot' => $pot,
            'pod' => $pod,
            'pengirim' => $pengirim,
            'penerima' => $penerima,
            'sizes' => $size,
            'types' => $type,
            'planload' => Trucking::find($id),
            'containers' => TruckingContainer::where('job_id', $id)->get()
        ]);

    }

    public function input($id)
    {
        $container = TruckingContainer::find($id);
        
        return response()->json([
            'result' => $container,
        ]);
    }

    public function input_tambah(Request $request)
    {
        // dd($request);

        $planload = Trucking::findOrFail($request->job_id);

        $status = [
            "status" => "Process",
        ];

        $planload->update($status);


        $data = [
            'job_id' => $request->job_id,
            'size' => $request->size,
            'type' => $request->type,
            'order_dari' => $request->order_dari,
            'activity' => $request->activity,
            "status" => "Process",

        ];

        $id = TruckingContainer::create($data);

      

        return response()->json(['success' => true]);
    }

    public function update(Request $request)
    {
        // dd($request);

        $old_slug = $request->old_slug;

        $old_id = Trucking::where('slug', $old_slug)->value('id');

        $random = Str::random(15);

        $company = $request->select_company;
        $company = str_replace('.', '_', $company);
        $company = str_replace('/','-', $company);
        $company = str_replace(' ','-', $company);

        $vessel = $request->vessel;
        $vessel = str_replace('.', '_', $vessel);
        $vessel = str_replace('/','-', $vessel);
        $vessel = str_replace(' ','-', $vessel);

        $slug = $company.'-'.$vessel.'-'.$request->vessel_code.'-'.$random;

        $Trucking = Trucking::findOrFail($old_id);


        $orderJob = [
            'tanggal' => $request->tanggal,
            'vessel' => $request->vessel,
            'vessel_code' => $request->vessel_code,
            'select_company' => $request->select_company,
            'pengirim' => $request->pengirim,
            'penerima' => $request->penerima,
            'activity' => $request->activity,
            'emkl' => $request->emkl,
            'slug' => $slug,
            'status' => "Plan-Trucking",
        ];

        $Trucking->update($orderJob);

        TruckingContainer::where('job_id', $old_id)->delete();
        $job_id = [];

        $tambah = $request->urutan;

        $jumlah_kontainer = [];
        $size = [];
        $type = [];
        $cargo = [];

        for ($j = 0; $j < $tambah; $j++) {
            $job_id[$j] = $old_id;
            $jumlah_kontainer[$j] = (int)$request->jumlah_kontainer[$j];
            $size[$j] = [];
            $type[$j] = [];
            $cargo[$j] = [];
            for ($i = 0; $i < $jumlah_kontainer[$j]; $i++) {

                $container = [
                    'job_id' => $job_id[$j],
                    'jumlah_kontainer' => $jumlah_kontainer[$j],
                    'size' => $request->size[$j][$i],
                    'type' => $request->type[$j][$i],
                    'cargo' => $request->cargo[$j][$i],
                ];
                TruckingContainer::create($container);
            }
        }

        return response()->json(['success' => true]);

    }



    public function process()
    {
        $truckings = Trucking::orderBy('id', 'DESC')->get();
        $containers = TruckingContainer::all();
        $containers_group = TruckingContainer::select('job_id', 'size', 'type', 'cargo', 'jumlah_kontainer' )->groupBy('job_id', 'size', 'type', 'cargo', 'jumlah_kontainer')->get();
        $select_company =  Trucking::all()->unique('select_company');
        $vessel =  Trucking::all()->unique('vessel');

        $biayas= BiayaLaintrucking::all();
        $alihkapal= AlihKapal::all();
        $batalmuat= BatalMuat::all();
        return view('process.trucking.process',[
            'title' => 'Trucking-Process',
            'active' => 'Trucking',
            'truckings' => $truckings,
            'containers' => $containers,
            'containers_group' => $containers_group,
            'select_company' => $select_company,
            'vessel' => $vessel,
            'biayas' => $biayas,
            'alihkapal' => $alihkapal,
            'batalmuat' => $batalmuat,

        ]);
    }

    public function create_process(Request $request)
    {
        $id = Trucking::where('slug', $request->slug)->value('id');

        $shipping_company = ShippingCompany::all();
        $pol = Pelabuhan::all();
        $pot = Pelabuhan::all();
        $pod = Pelabuhan::all();
        $activity = Stripping::where('jenis_kegiatan', 'Stripping')->get();

        $pengirim = Pengirim::all();
        $penerima = Penerima::all();
        $kontainer = Container::all();
        $lokasis = Depo::all();
        $seals = Seal::all();
        return view('process.trucking.process-create',[
            'title' => 'Trucking-Process',
            'active' => 'Trucking',
            'shippingcompany' => $shipping_company,
            'pol' => $pol,
            'pot' => $pot,
            'pod' => $pod,
            'pengirim' => $pengirim,
            'activity' => $activity,

            'penerima' => $penerima,
            'kontainers' => $kontainer,
            'lokasis' => $lokasis,
            'seals' => $seals,
            'planload' => Trucking::find($id),
            'containers' => TruckingContainer::where('job_id', $id)->get(),

        ]);
    }

    public function store_process(Request $request)
    {

        // dd($request);


        $old_slug = $request->old_slug;

        $old_id = Trucking::where('slug', $old_slug)->value('id');

        $Trucking = Trucking::findOrFail($old_id);

        $orderjob = [
            'status' => 'Process-Trucking',

        ];

        $Trucking->update($orderjob);



        $all_id = TruckingContainer::where('job_id', $old_id)->get('id');

        $processload_update = [];

        for($i = 0; $i < count($all_id); $i++) {
            $processload_update[$i] =   $all_id[$i]->id;
        }

        $urutan = (int)$request->urutan;

        $status = "Process-Trucking";

        for ($k = 0; $k < $urutan; $k++) {
            $container = [
                'nomor_kontainer' => $request->nomor_kontainer[$k],
                'seal' => $request->seal[$k],
                'cargo' => $request->cargo[$k],
                'date_activity' => $request->date_activity[$k],
                'lokasi_pickup' => $request->lokasi_pickup[$k],
                'lokasi_tujuan' => $request->lokasi_tujuan[$k],
                'mty_to' => $request->mty_to[$k],
                'driver' => $request->driver[$k],
                'nomor_polisi' => $request->nomor_polisi[$k],
                'ongkos_supir' => str_replace(".", "", $request->ongkos_supir[$k]),
                'remark' => $request->remark[$k],
                'jenis_mobil' => $request->jenis_mobil[$k],
                'detail_barang' => $request->detail_barang[$k],
                'status' => $status,
            ];
            TruckingContainer::where('id',$processload_update[$k])->update($container);
        }
        // $update_id->update($container);

        $job_id = [];


        for ($i=0; $i <$request->tambah ; $i++) {
            $job_id[$i] = $old_id;
            $biayas =[
                'job_id' => $job_id[$i],
                'kontainer_biaya' => $request->kontainer_biaya[$i],
                'harga_biaya' => str_replace(".", "", $request->harga_biaya[$i]),
                'keterangan' => $request->keterangan[$i],
            ];

            BiayaLainTrucking::create($biayas);
        }



        return response()->json(['success' => true]);
    }

    public function realisasi()
    {
        $truckings = Trucking::orderBy('id', 'DESC')->where("status", "Process-Trucking")->orWhere('status', 'Realisasi')->get();
        $containers = TruckingContainer::all();
        $containers_group = TruckingContainer::select('job_id', 'size', 'type', 'cargo', 'jumlah_kontainer' )->groupBy('job_id', 'size', 'type', 'cargo', 'jumlah_kontainer')->get();
        $select_company =  Trucking::all()->unique('select_company');
        $vessel =  Trucking::all()->unique('vessel');


        $biayas= BiayaLaintrucking::all();

        return view('realisasi.trucking.realisasi',[
            'title' => 'Trucking-Realisasi',
            'active' => 'Realisasi',
            'truckings' => $truckings,
            'containers' => $containers,
            'containers_group' => $containers_group,
            'select_company' => $select_company,
            'vessel' => $vessel,
            'biayas' => $biayas,




        ]);
    }

    public function realisasi_create(Request $request)
    {
        $id = Trucking::where('slug', $request->slug)->value('id');

        $shipping_company = ShippingCompany::all();
        $pol = Pelabuhan::all();
        $pot = Pelabuhan::all();
        $pod = Pelabuhan::all();
        $pengirim = Pengirim::all();
        $penerima = Penerima::all();
        $kontainer = Container::all();
        $lokasis = Depo::all();
        $seals = Seal::all();
        //
        return view('realisasi.trucking.realisasi-create',[
            'title' => 'Buat trucking-Realisasi',
            'active' => 'Realisasi',
            'shippingcompany' => $shipping_company,
            'pol' => $pol,
            'pot' => $pot,
            'pod' => $pod,
            'pengirim' => $pengirim,
            'penerima' => $penerima,
            'kontainers' => $kontainer,
            'lokasis' => $lokasis,
            'seals' => $seals,
            'planload' => Trucking::find($id),
            'containers' => TruckingContainer::where('job_id', $id)->get(),
            'biayas' => BiayaLaintrucking::where('job_id', $id)->get(),

        ]);
    }

  


}
