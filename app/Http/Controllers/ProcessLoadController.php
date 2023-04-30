<?php

namespace App\Http\Controllers;

use App\Models\ProcessLoad;
use App\Models\Pela;
use App\Models\OrderJobPlanload;
use App\Models\ContainerPlanload;
use App\Http\Requests\StoreProcessLoadRequest;
use App\Http\Requests\UpdateProcessLoadRequest;
use App\Models\PlanLoad;
use Illuminate\Http\Request;
use App\Models\Stuffing;
use App\Models\ShippingCompany;
use App\Models\Pelabuhan;
use App\Models\Pengirim;
use App\Models\Penerima;
use App\Models\Container;
use App\Models\Depo;
use App\Models\BiayaLainnya;
use Illuminate\Support\Str;

class ProcessLoadController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $planloads = OrderJobPlanload::all();
        $containers = ContainerPlanload::all();

        return view('process.processload',[
            'title' => 'Process Load',
            'planloads' => $planloads,
            'containers' => $containers,

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
        $pod = Pelabuhan::all();
        $pengirim = Pengirim::all();
        $penerima = Penerima::all();
        $kontainer = Container::all();
        $lokasis = Depo::all();
        //
        return view('process.processload-create',[
            'title' => 'Buat Job Order Process Load',
            'activity' => $activity,
            'shippingcompany' => $shipping_company,
            'pol' => $pol,
            'pot' => $pot,
            'pod' => $pod,
            'pengirim' => $pengirim,
            'penerima' => $penerima,
            'kontainers' => $kontainer,
            'lokasis' => $lokasis,
            'planload' => OrderJobPlanload::find($id),
            'containers' => ContainerPlanload::where('job_id', $id)->get(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        // dd($request);



        $old_slug = $request->old_slug;

        $old_id = OrderJobPlanload::where('slug', $old_slug)->value('id');

        $all_id = ContainerPlanload::where('job_id', $old_id)->get('id');

        $processload_update = [];
        for($i = 0; $i < count($all_id); $i++) {
            $processload_update[$i] =   $all_id[$i]->id;
        }

        $urutan = (int)$request->urutan;

        for ($k = 0; $k < $urutan; $k++) {
            $container = [
                'seal' => $request->seals[$k],
                'date_activity' => $request->date_activity[$k],
                'cargo' => $request->cargo[$k],
                'lokasi_depo' => $request->lokasi[$k],
                'driver' => $request->driver[$k],
                'nomor_polisi' => $request->nomor_polisi[$k],
                'remark' => $request->remark[$k],
                'biaya_stuffing' => str_replace(".", "", $request->biaya_stuffing[$k]),
                'biaya_trucking' => str_replace(".", "", $request->biaya_trucking[$k]),
                'ongkos_supir' => str_replace(".", "", $request->ongkos_supir[$k]),
                'biaya_thc' => str_replace(".", "", $request->biaya_thc[$k]),
                'nomor_surat' => $request->no_surat[$k],
                'bulan' => (int)$request->bulan[$k],
            ];
            ContainerPlanload::where('id',$processload_update[$k])->update($container);
        }
        // $update_id->update($container);

        $job_id = [];


        for ($i = 0; $i < $request->tambah; $i++) {
            $job_id[$i] = $old_id;
        }


        for ($i=0; $i <$request->tambah ; $i++) {
            $biayas =[
                'job_id' => $job_id[$i],
                'pilih_kontainer' => $request->kontaienr_biaya[$i],
                'harga_biaya' => str_replace(".", "", $request->harga_biaya[$i]),
                'keterangan' => $request->keterangan[$i],
            ];

            BiayaLainnya::create($biayas);
        }

        return response()->json(['success' => true]);
    }

    /**
     * Display the specified resource.
     */
    public function show(ProcessLoad $processLoad)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ProcessLoad $processLoad)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateProcessLoadRequest $request, ProcessLoad $processLoad)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ProcessLoad $processLoad)
    {
        //
    }

    public function getBiayaLain(Request $request)
    {
        $slug = $request->slug;
        $get_id = OrderJobPlanload::where('slug', $slug)->value('id');
        $get_container = ContainerPlanload::select('kontainer')->where('job_id', $get_id)->get();
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

    public function getNoSurat(Request $request) {
        $bulan = $request->bulan;
        $no_surat = ContainerPlanload::where('bulan', $bulan)->get();
        $count_no_surat = count($no_surat);

        return response()->json($count_no_surat);
    }
}
