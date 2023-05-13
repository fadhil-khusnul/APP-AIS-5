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
        $truckings = Trucking::orderBy('id', 'DESC')->get();
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
        $activity = Stripping::all()
        ;
        $shipping_company = ShippingCompany::all();

        $pengirim = Pengirim::all();
        $penerima = Penerima::all();
        $kontainer = Container::all();

        return view('plan.trucking.trucking-plan-create',[
            'title' => 'Buat Trucking-Plan',
            'activity' => $activity,
            'active' => 'Trucking',
            'shippingcompany' => $shipping_company,

            'pengirim' => $pengirim,
            'penerima' => $penerima,
            'kontainer' => $kontainer,

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
            'activity' => $request->activity,
            'select_company' => $request->select_company,
            'vessel' => $request->vessel,
            'vessel_code' => $request->vessel_code,
            'pelayaran' => $request->pelayaran,
            'emkl' => $request->emkl,
            'slug' => $slug,
            'status' => "Plan-Trucking",
        ];

        Trucking::create($orderJob);

        $id = Trucking::where('slug', $slug)->value('id');

        $job_id = [];

        $tambah = $request->tambah;

        $jumlah_kontainer = [];
        $size = [];
        $type = [];
        $cargo = [];

        for ($j = 0; $j < $tambah; $j++) {
            $job_id[$j] = $id;
            $jumlah_kontainer[$j] = (int)$request->jumlah_kontainer[$j];
            $size[$j] = [];
            $type[$j] = [];
            $cargo[$j] = [];
            // $tambah2[$j] = [];
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
    public function getNoSurat_trucking(Request $request) {
        $tahun = $request->tahun;
        $no_surat = TruckingContainer::where('tahun', $tahun)->get();
        $count_no_surat = count($no_surat);

        return response()->json($count_no_surat);
    }

    public function getSealProcessLoad(Request $request) {
        $seal = TruckingContainer::all();
        $seal_process_load = [];
        for($i = 0; $i < count($seal); $i++) {
            $seal_process_load[$i] = $seal[$i]->seal;
        }
        $seal_process_load_without_null = array_merge(array_diff($seal_process_load, array(null)));
        return response()->json($seal_process_load_without_null);
    }

    public function getNoContainer() {
        $no_container = TruckingContainer::all();
        $no_container_process_load = [];
        for($i = 0; $i < count($no_container); $i++) {
            $no_container_process_load[$i] = $no_container[$i]->nomor_kontainer;
        }
        $no_container_process_load_without_null = array_merge(array_diff($no_container_process_load, array(null)));
        return response()->json($no_container_process_load_without_null);
    }

    public function getBiayaLain(Request $request)
    {
        $slug = $request->slug;
        $get_id = Trucking::where('slug', $slug)->value('id');
        $get_container = TruckingContainer::select('kontainer')->where('job_id', $get_id)->get();
        $count_container = count($get_container);
        $get_job_container = [];
        for($i = 0; $i < $count_container; $i++) {
            $int_container = (int)$get_container[$i]->kontainer;
            $get_job_container[$i] = [
                'id' => (int)$get_container[$i]->kontainer,
                'kontainer' => Container::where('id', $int_container)->value('jenis_container')
            ];
        }

        return response()->json($get_job_container);
    }

    /**
     * Show the form for editing the specified resource.
     */

    public function process()
    {
        $planloads = Trucking::orderBy('id', 'DESC')->get();
        $containers = TruckingContainer::all();
        $containers_group = TruckingContainer::select('job_id', 'size', 'type', 'cargo', 'jumlah_kontainer' )->groupBy('job_id', 'size', 'type', 'cargo', 'jumlah_kontainer')->get();
        $select_company =  Trucking::all()->unique('select_company');
        $vessel =  Trucking::all()->unique('vessel');

        $biayas= BiayaLaintrucking::all();
        $alihkapal= AlihKapal::all();
        $batalmuat= BatalMuat::all();
        return view('process.trucking.processtrucking',[
            'title' => 'Trucking-Process',
            'active' => 'Trucking',
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

    public function create_process(Request $request)
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
        return view('process.trucking.processtrucking-create',[
            'title' => 'trucking-Process',
            'active' => 'trucking',
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
                'tanggal_kembali' => $request->tanggal_kembali[$k],
                'lokasi_depo' => $request->lokasi[$k],
                'lokasi_kembali' => $request->lokasi_kembali[$k],
                'driver' => $request->driver[$k],
                'nomor_polisi' => $request->nomor_polisi[$k],
                'remark' => $request->remark[$k],
                'jaminan_kontainer' => str_replace(".", "", $request->jaminan_kontainer[$k]),
                'biaya_demurrage' => str_replace(".", "", $request->biaya_demurrage[$k]),
                'biaya_trucking' => str_replace(".", "", $request->biaya_trucking[$k]),
                'ongkos_supir' => str_replace(".", "", $request->ongkos_supir[$k]),
                'biaya_thc' => str_replace(".", "", $request->biaya_thc[$k]),
                'nomor_surat' => $request->no_surat[$k],
                'tahun' => (int)$request->tahun[$k],
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

            BiayaLaintrucking::create($biayas);
        }



        return response()->json(['success' => true]);
    }

    public function realisasi()
    {
        $planloads = Trucking::orderBy('id', 'DESC')->where("status", "Process-Trucking")->get();
        $containers = TruckingContainer::all();
        $containers_group = TruckingContainer::select('job_id', 'size', 'type', 'cargo', 'jumlah_kontainer' )->groupBy('job_id', 'size', 'type', 'cargo', 'jumlah_kontainer')->get();
        $select_company =  Trucking::all()->unique('select_company');
        $vessel =  Trucking::all()->unique('vessel');


        $biayas= BiayaLaintrucking::all();

        return view('realisasi.trucking.realisasi',[
            'title' => 'Trucking-Realisasi',
            'active' => 'Realisasi',
            'planloads' => $planloads,
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


    /**
     * Display the specified resource.
     */
    public function show(Trucking $trucking)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        //

        $Trucking = Trucking::find($id);

        return response()->json([
            'result' => $Trucking,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        //

        $request->validate([

            'nomor_polisi' => 'required',
            'nama_driver' => 'required',

        ]);

        $trucking = Trucking::findOrFail($id);

        $data = [
            "nomor_polisi" =>$request->nomor_polisi,
            "nama_driver" =>$request->nama_driver,
        ];
        $trucking->update($data);
        return response()->json(['success' => true]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        //

        $Trucking = Trucking::find($id);
        $Trucking->delete();
        return response()->json([
            'success'   => true
        ]);
    }
}
