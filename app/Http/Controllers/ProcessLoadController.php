<?php

namespace App\Http\Controllers;

use App\Models\ProcessLoad;
use App\Models\OrderJobPlanload;
use App\Models\ContainerPlanload;
use App\Http\Requests\StoreProcessLoadRequest;
use App\Http\Requests\UpdateProcessLoadRequest;
use App\Models\PlanLoad;
use App\Models\AlihKapal;
use App\Models\BatalMuat;
use Illuminate\Http\Request;
use App\Models\Stuffing;
use App\Models\Stripping;
use App\Models\ShippingCompany;
use App\Models\Pelabuhan;
use App\Models\Pengirim;
use App\Models\Penerima;
use App\Models\Container;
use App\Models\TypeContainer;
use App\Models\Depo;
use App\Models\Seal;
use App\Models\BiayaLainnya;
use Illuminate\Support\Str;

class ProcessLoadController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $planloads = OrderJobPlanload::orderBy('id', 'DESC')->where('status', 'Process-Load')->orWhere('status', 'Plan-Load')->get();
        $containers = ContainerPlanload::all();
        $containers_group = ContainerPlanload::select('job_id', 'size', 'type', 'cargo', 'jumlah_kontainer' )->groupBy('job_id', 'size', 'type', 'cargo', 'jumlah_kontainer')->get();
        $select_company =  OrderJobPlanload::all()->unique('select_company');
        $vessel =  OrderJobPlanload::all()->unique('vessel');

        $biayas= BiayaLainnya::all();
        $alihkapal= AlihKapal::all();
        $batalmuat= BatalMuat::all();
        return view('process.load.processload',[
            'title' => 'Load-Process',
            'active' => 'Load',
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

        $activity = Stripping::where('jenis_kegiatan', 'Stripping')->get();
        $shipping_company = ShippingCompany::all();
        $pol = Pelabuhan::all();
        $pot = Pelabuhan::all();
        $pod = Pelabuhan::all();
        $pengirim = Pengirim::all();
        $penerima = Penerima::all();
        $kontainer = Container::all();
        $lokasis = Depo::all();
        $seals = Seal::where('status', 'input')->get();
        //
        return view('process.load.processload-create',[
            'title' => 'Buat Load-Process',
            'active' => 'Process',
            'activity' => $activity,
            'shippingcompany' => $shipping_company,
            'pol' => $pol,
            'pot' => $pot,
            'pod' => $pod,
            'pengirim' => $pengirim,
            'penerima' => $penerima,
            'kontainers' => $kontainer,
            'lokasis' => $lokasis,
            'seals' => $seals,
            'planload' => OrderJobPlanload::find($id),
            'containers' => ContainerPlanload::where('job_id', $id)->get(),
        ]);
    }

    public function edit(Request $request)
    {
        $id = OrderJobPlanload::where('slug', $request->slug)->value('id');

        $activity = Stripping::where('jenis_kegiatan', 'Stripping')->get();
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
        //
        return view('process.load.processload-edit',[
            'title' => 'EDIT Load-Process',
            'active' => 'Process',
            'activity' => $activity,
            'shippingcompany' => $shipping_company,
            'pol' => $pol,
            'pot' => $pot,
            'pod' => $pod,
            'pengirim' => $pengirim,
            'penerima' => $penerima,
            'kontainers' => $kontainer,
            'lokasis' => $lokasis,
            'seals' => $seals,
            'sizes' => $sizes,
            'types' => $types,
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

        $OrderJobPlanload = OrderJobPlanload::findOrFail($old_id);

        $orderjob = [
            'status' => 'Process-Load',

        ];

        $OrderJobPlanload->update($orderjob);



        $all_id = ContainerPlanload::where('job_id', $old_id)->get('id');

        $processload_update = [];

        for($i = 0; $i < count($all_id); $i++) {
            $processload_update[$i] =   $all_id[$i]->id;
        }

        $urutan = (int)$request->urutan;

        $status = "Process-Load";



        for ($k = 0; $k < $urutan; $k++) {
            $container = [
                'nomor_kontainer' => $request->nomor_kontainer[$k],
                'seal' => $request->seal[$k],
                'cargo' => $request->cargo[$k],
                'date_activity' => $request->date_activity[$k],
                'lokasi_depo' => $request->lokasi[$k],
                'driver' => $request->driver[$k],
                'nomor_polisi' => $request->nomor_polisi[$k],
                'remark' => $request->remark[$k],
                'biaya_stuffing' => str_replace(".", "", $request->biaya_stuffing[$k]),
                'biaya_trucking' => str_replace(".", "", $request->biaya_trucking[$k]),
                'ongkos_supir' => str_replace(".", "", $request->ongkos_supir[$k]),
                'biaya_thc' => str_replace(".", "", $request->biaya_thc[$k]),
                'nomor_surat' => $request->no_surat[$k],
                'jenis_mobil' => $request->jenis_mobil[$k],
                'detail_barang' => $request->detail_barang[$k],
                'tahun' => (int)$request->tahun[$k],
                'status' => $status,
            ];
            ContainerPlanload::where('id',$processload_update[$k])->update($container);
        }
        // $update_id->update($container);

        $all_seal =[];

        for ($i=0; $i <$urutan ; $i++) {
            $all_seal[$i] =
            [
                "id" => $request->seal[$i],
            ];

        }


        $seal_update = [];

        for($i = 0; $i < count($all_seal); $i++) {
            $seal_update[$i] = Seal::where('kode_seal', $all_seal[$i]["id"])->value('id');
        }



        for ($i=0; $i < $urutan ; $i++) {

            $seal = [
                "status" => "Container",

            ];
            Seal::where('id', $seal_update[$i])->update($seal);
        }

        // dd($seal_update);


        $job_id = [];


        for ($i=0; $i <$request->tambah ; $i++) {
            $job_id[$i] = $old_id;
            $biayas =[
                'job_id' => $job_id[$i],
                'kontainer_biaya' => $request->kontainer_biaya[$i],
                'harga_biaya' => str_replace(".", "", $request->harga_biaya[$i]),
                'keterangan' => $request->keterangan[$i],
            ];

            BiayaLainnya::create($biayas);
        }

        for ($i=0; $i <$request->clickalih ; $i++) {
            $job_id[$i] = $old_id;
            $alihs =[
                'job_id' => $job_id[$i],
                'kontainer_alih' => $request->kontainer_alih[$i],
                'harga_alih_kapal' => str_replace(".", "", $request->harga_alih_kapal[$i]),
                'keterangan_alih_kapal' => $request->keterangan_alih_kapal[$i],
                'pelayaran_alih' => $request->pelayaran_alih[$i],
                'pot_alih' => $request->pot_alih[$i],
                'pod_alih' => $request->pod_alih[$i],
                'vesseL_alih' => $request->vesseL_alih[$i],
                'code_vesseL_alih' => $request->code_vesseL_alih[$i],
            ];

            AlihKapal::create($alihs);
        }

        for ($i=0; $i <$request->clickbatal ; $i++) {
            $job_id[$i] = $old_id;
            $batals =[
                'job_id' => $job_id[$i],
                'kontainer_batal' => $request->kontainer_batal[$i],
                'harga_batal_muat' => str_replace(".", "", $request->harga_batal_muat[$i]),
                'keterangan_batal_muat' => $request->keterangan_batal_muat[$i],
            ];

            BatalMuat::create($batals);
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
        $tahun = $request->tahun;
        $no_surat = ContainerPlanload::where('tahun', $tahun)->get();
        $count_no_surat = count($no_surat);

        return response()->json($count_no_surat);
    }



    public function getSealProcessLoad(Request $request) {
        $seal = ContainerPlanload::all();
        $seal_process_load = [];
        for($i = 0; $i < count($seal); $i++) {
            $seal_process_load[$i] = $seal[$i]->seal;
        }
        $seal_process_load_without_null = array_merge(array_diff($seal_process_load, array(null)));
        return response()->json($seal_process_load_without_null);
    }

    public function getNoContainer() {
        $no_container = ContainerPlanload::all();
        $no_container_process_load = [];
        for($i = 0; $i < count($no_container); $i++) {
            $no_container_process_load[$i] = $no_container[$i]->nomor_kontainer;
        }
        $no_container_process_load_without_null = array_merge(array_diff($no_container_process_load, array(null)));
        return response()->json($no_container_process_load_without_null);
    }

    public function getpelayaran()
    {
        $pelayaran = ShippingCompany::all();
        $pelabuhan = Pelabuhan::all();
        $alih = [
            'pelayaran' => $pelayaran,
            'pelabuhan' => $pelabuhan
        ];
        return response()->json($alih);
    }
    public function get_detail_container()
    {
        $seal = Seal::all();
        $lokasi = Depo::all();
        $size = Container::all();
        $type = TypeContainer::all();
        $alih = [
            'seal' => $seal,
            'lokasi' => $lokasi,
            'size' => $size,
            'type' => $type,
        ];
        return response()->json($alih);
    }
}
