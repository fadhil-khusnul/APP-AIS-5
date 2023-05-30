<?php

namespace App\Http\Controllers;

use App\Models\ProcessLoad;
use App\Models\SpkContainer;
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
use App\Models\Spk;
use App\Models\SealContainer;
use App\Models\BiayaLainnya;
use App\Models\OngkoSupir;
use Illuminate\Support\Str;

use Cookie;
use Tracker;
use Session;

class ProcessLoadController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $planloads = OrderJobPlanload::orderBy('id', 'DESC')->where('status', 'Process-Load')->orWhere('status', 'Plan-Load')->orWhere('status', 'Realisasi')->get();
        $containers = ContainerPlanload::all();
        $containers_group = ContainerPlanload::select('job_id', 'size', 'type', 'cargo', 'jumlah_kontainer' )->groupBy('job_id', 'size', 'type', 'cargo', 'jumlah_kontainer')->get();

        // dd($containers_group);
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
        // dd($request->btn_detail);
        $id = OrderJobPlanload::where('slug', $request->slug)->value('id');
        $select_company = OrderJobPlanload::where('slug', $request->slug)->value('select_company');
        $pelayaran_id = ShippingCompany::where('nama_company', $select_company)->value('id');

        $activity = Stripping::where('jenis_kegiatan', 'Stuffing')->get();

        $shipping_company = ShippingCompany::all();
        $shipping_companys = ShippingCompany::all();
        $pol = Pelabuhan::all();
        $pot = Pelabuhan::all();
        $pod = Pelabuhan::all();
        $pelabuhans = Pelabuhan::all();
        $pengirim = Pengirim::all();
        $penerima = Penerima::all();
        $kontainer = Container::all();
        $lokasis = Depo::all();
        $danas = OngkoSupir::all();
        $sizes = Container::all();
        $types = TypeContainer::all();
        $seals = Seal::where('status', 'input')->orWhere('status', 'Container')->get();
        $spks = Spk::where('pelayaran_id', $pelayaran_id)->get();
        $sealscontainer = SealContainer::where('job_id', $id)->select('job_id')->groupby('job_id')->get();

        $containers = ContainerPlanload::where('job_id', $id)->where(function($query) {
            $query->where('status', '!=', 'Batal-Muat')
            ->where('status', '!=', 'Alih-Kapal')
                ->orWhereNull('status');
        })->get();



        $container_batal = ContainerPlanload::where('job_id', $id)->where(function($query) {
            $query->where('status', 'Batal-Muat')
                ->orWhere('status', 'Biaya-Lainnya');
        })->get();
        $select_batal_edit = ContainerPlanload::where('job_id', $id)->whereNotNull('status')->get();
        // dd($containers);

        $containers_alih = ContainerPlanload::where('job_id', $id)->where(function($query) {
            $query->where('status', '!=', 'Batal-Muat')
            ->where('status', '!=', 'Alih-Kapal')
                ->whereNotNull('status');
        })->get();


        $alihs = AlihKapal::where('job_id', $id)->get();

        //
        return view('process.load.processload-create',[
            'title' => 'Buat Load-Process',
            'active' => 'Process',
            'activity' => $activity,
            'alihs' => $alihs,
            'spks' => $spks,
            'shippingcompany' => $shipping_company,
            'shipping_companys' => $shipping_companys,
            'pol' => $pol,
            'pot' => $pot,
            'pod' => $pod,
            'pelabuhans' => $pelabuhans,
            'pengirim' => $pengirim,
            'penerima' => $penerima,
            'kontainers' => $kontainer,
            'lokasis' => $lokasis,
            'seals' => $seals,
            'sealscontainer' => $sealscontainer,
            'sizes' => $sizes,
            'types' => $types,
            'danas' => $danas,
            'containers' => $containers,
            'container_batal' => $container_batal,
            'containers_alih' => $containers_alih,
            'select_batal_edit' => $select_batal_edit,
            'planload' => OrderJobPlanload::find($id),
            'biayas' => BiayaLainnya::where('job_id', $id)->get(),
        ]);
    }

    public function edit(Request $request)
    {
        $id = OrderJobPlanload::where('slug', $request->slug)->value('id');

        $activity = Stripping::where('jenis_kegiatan', 'Stuffing')->get();

        $shipping_company = ShippingCompany::all();
        $pol = Pelabuhan::all();
        $pot = Pelabuhan::all();
        $pod = Pelabuhan::all();
        $pengirim = Pengirim::all();
        $penerima = Penerima::all();
        $kontainer = Container::all();
        $lokasis = Depo::all();
        $seals = Seal::where('status', 'input')->orWhere('status', 'Container')->get();
        $sizes = Container::all();
        $types = TypeContainer::all();
        $danas = OngkoSupir::all();

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
            'danas' => $danas,
            'sizes' => $sizes,
            'types' => $types,
            'planload' => OrderJobPlanload::find($id),
            'containers' => ContainerPlanload::where('job_id', $id)->get(),
        ]);
    }

    public function input($id)
    {

        $container = ContainerPlanload::find($id);
        $seal_containers = SealContainer::where("kontainer_id", $id)->get();
        $spks = SpkContainer::where("kontainer_id", $id)->get();

        // dd($seal_containers);
        return response()->json([
            'result' => $container,
            'seal_containers' => $seal_containers,
            'spks' => $spks,
        ]);
    }
    public function input_update(Request $request, $id)
    {
        // dd($request);


        $container = ContainerPlanload::findOrFail($id);
        $planload = OrderJobPlanload::findOrFail($request->job_id);


        $status = "Process-Load";

        $load = [
            'status' => $status,
        ];

        $data = [
            'size' => $request->size,
            'type' => $request->type,
            'nomor_kontainer' => $request->nomor_kontainer,
            // 'seal' => $request->seal,
            'cargo' => $request->cargo,
            'date_activity' => $request->date_activity,
            'lokasi_depo' => $request->lokasi,
            'driver' => $request->driver,
            'nomor_polisi' => $request->nomor_polisi,
            'remark' => $request->remark,
            'biaya_stuffing' =>$request->biaya_stuffing,
            'biaya_trucking' =>$request->biaya_trucking,
            'ongkos_supir' =>$request->ongkos_supir,
            'biaya_thc' =>$request->biaya_thc,
            'nomor_surat' => $request->no_surat,
            'jenis_mobil' => $request->jenis_mobil,
            'detail_barang' => $request->detail_barang,
            'tahun' => (int)$request->tahun,
            'dana' => $request->dana,
            'status' => $status,

            // 'slug' => $request->nomor_kontainer.'-'.$request->seal.'-'.time(),

        ];
        $planload->update($load);
        $container->update($data);

        SealContainer::where('kontainer_id', $id)->delete();

        for ($i=0; $i <count($request->seal) ; $i++) {

            $seal = [
                "job_id" => $request->job_id,
                "kontainer_id" => $id,
                "seal_kontainer" => $request->seal[$i],
            ];

            SealContainer::create($seal);
        }
        for ($i=0; $i <count($request->seal) ; $i++) {

            $data1 = [
                "status" => "Container",

            ];

            Seal::where("kode_seal", $request->seal[$i])->update($data1);
        }


        if ($request->spk != null){
            SpkContainer::where('kontainer_id', $id)->delete();
            for ($i=0; $i <count($request->spk) ; $i++) {

                $spk = [
                    "job_id" => $request->job_id,
                    "kontainer_id" => $id,
                    "spk_kontainer" => $request->spk[$i],
                ];

                SpkContainer::create($spk);
            }

            for ($i=0; $i <count($request->spk) ; $i++) {

                $data2 = [
                    "status" => "Container",

                ];

                Spk::where("kode_spk", $request->spk[$i])->update($data2);
            }
        }

        return response()->json(['success' => true]);
    }
    public function input_edit(Request $request, $id)
    {
        dd($request);


        $container = ContainerPlanload::findOrFail($id);
        $planload = OrderJobPlanload::findOrFail($request->job_id);


        $status = "Process-Load";

        $load = [
            'status' => $status,
        ];

        $data = [
            'size' => $request->size,
            'type' => $request->type,
            'nomor_kontainer' => $request->nomor_kontainer,
            // 'seal' => $request->seal,
            'cargo' => $request->cargo,
            'date_activity' => $request->date_activity,
            'lokasi_depo' => $request->lokasi,
            'driver' => $request->driver,
            'nomor_polisi' => $request->nomor_polisi,
            'remark' => $request->remark,
            'biaya_stuffing' =>$request->biaya_stuffing,
            'biaya_trucking' =>$request->biaya_trucking,
            'ongkos_supir' =>$request->ongkos_supir,
            'biaya_thc' =>$request->biaya_thc,
            'nomor_surat' => $request->no_surat,
            'jenis_mobil' => $request->jenis_mobil,
            'detail_barang' => $request->detail_barang,
            'tahun' => (int)$request->tahun,
            'dana' => $request->dana,
            'status' => $status,

            // 'slug' => $request->nomor_kontainer.'-'.$request->seal.'-'.time(),

        ];


        SealContainer::where('kontainer_id', $id)->delete();

        for ($i=0; $i <count($request->seal) ; $i++) {

            $seal = [
                "job_id" => $request->job_id,
                "kontainer_id" => $id,
                "seal_kontainer" => $request->seal[$i],
            ];

            SealContainer::create($seal);
        }
        for ($i=0; $i <count($request->seal_old) ; $i++) {

            $data2 = [
                "status" => "input",

            ];

            Seal::where("kode_seal", $request->seal_old[$i])->update($data2);
        }
        for ($i=0; $i <count($request->seal) ; $i++) {

            $data1 = [
                "status" => "Container",

            ];

            Seal::where("kode_seal", $request->seal[$i])->update($data1);
        }


        if ($request->spk != null) {
            # code...

            SpkContainer::where('kontainer_id', $id)->delete();

            for ($i=0; $i <count($request->spk) ; $i++) {

                $spk = [
                    "job_id" => $request->job_id,
                    "kontainer_id" => $id,
                    "spk_kontainer" => $request->spk[$i],
                ];

                SpkContainer::create($spk);
            }

            for ($i=0; $i <count($request->spk) ; $i++) {

                $data3 = [
                    "status" => "Container",

                ];

                Spk::where("kode_spk", $request->spk[$i])->update($data3);
            }

            for ($i=0; $i <count($request->spk_old) ; $i++) {

                $data4 = [
                    "status" => "input",

                ];
                Spk::where("kode_spk", $request->spk_old[$i])->update($data4);
            }
    }




        $planload->update($load);
        $container->update($data);

        return response()->json(['success' => true]);
    }
    public function input_tambah(Request $request)
    {
        // dd($request);

        $planload = OrderJobPlanload::findOrFail($request->job_id);

        $status = [
            "status" => "Process-Load",


        ];

        $planload->update($status);


        $data = [
            'job_id' => $request->job_id,
            'size' => $request->size,
            'type' => $request->type,
            'nomor_kontainer' => $request->nomor_kontainer,
            // 'seal' => $request->seal,
            'cargo' => $request->cargo,
            'date_activity' => $request->date_activity,
            'lokasi_depo' => $request->lokasi,
            'driver' => $request->driver,
            'nomor_polisi' => $request->nomor_polisi,
            'remark' => $request->remark,
            'biaya_stuffing' =>$request->biaya_stuffing,
            'biaya_trucking' =>$request->biaya_trucking,
            'ongkos_supir' =>$request->ongkos_supir,
            'biaya_thc' =>$request->biaya_thc,
            'nomor_surat' => $request->no_surat,
            'jenis_mobil' => $request->jenis_mobil,
            'detail_barang' => $request->detail_barang,
            'tahun' => (int)$request->tahun,
            'dana' => $request->dana,
            "status" => "Process-Load",
            // 'slug' => $request->nomor_kontainer.'-'.$request->seal.'-'.time(),

        ];
        // dd($data);

        $id = ContainerPlanload::create($data);

        // dd($id->id);





        // SealContainer::where('kontainer_id', $id)->delete();

        for ($i=0; $i <count($request->seal) ; $i++) {

            $seal = [
                "job_id" => $request->job_id,
                "kontainer_id" => $id->id,
                "seal_kontainer" => $request->seal[$i],
            ];

            SealContainer::create($seal);
        }
        for ($i=0; $i <count($request->seal) ; $i++) {

            $data1 = [
                "status" => "Container",

            ];

            Seal::where("kode_seal", $request->seal[$i])->update($data1);
        }
        if($request->spk != null){

            for ($i=0; $i <count($request->spk) ; $i++) {

                $spk = [
                    "job_id" => $request->job_id,
                    "kontainer_id" => $id,
                    "spk_kontainer" => $request->spk[$i],
                ];

                SpkContainer::create($spk);
            }

            for ($i=0; $i <count($request->spk) ; $i++) {

                $data2 = [
                    "status" => "Container",

                ];

                Spk::where("kode_spk", $request->spk[$i])->update($data2);
            }

        }



        return response()->json(['success' => true]);
    }
//BIAYA-LAINNYA
    public function biayalain(Request $request)
    {
        // dd($request);

        $container = ContainerPlanload::findOrFail($request->kontainer_biaya);

        $update_container = [
            'status' => "Biaya-Lainnya",
        ];

        $container->update($update_container);


        $data = [
            'job_id' => $request->job_id,
            'kontainer_id' => $request->kontainer_biaya,
            'harga_biaya' => $request->harga_biaya,
            'keterangan' => $request->keterangan,


        ];

        BiayaLainnya::create($data);

        return response()->json(['success' => true]);
    }

    public function biayalain_edit($id)
    {

        $biaya = BiayaLainnya::find($id);

        return response()->json([
            'result' => $biaya,
        ]);
    }

    public function biayalain_update(Request $request, $id)
    {
        // dd($request);

        $container_old = ContainerPlanload::findOrFail($request->old_id_container_biaya);

        $update_container_old = [
            'status' => "Process-Load",
        ];

        $container_old->update($update_container_old);


        $container = ContainerPlanload::findOrFail($request->kontainer_biaya);

        $update_container = [
            'status' => "Biaya-Lainnya",
        ];

        $container->update($update_container);



        $biayas = BiayaLainnya::findOrFail($id);
        $data = [
            'job_id' => $request->job_id,
            'kontainer_id' => $request->kontainer_biaya,
            'harga_biaya' => $request->harga_biaya,
            'keterangan' => $request->keterangan,


        ];

        $biayas->update($data);

        return response()->json(['success' => true]);
    }
    public function destroy_biaya(Request $request)
    {


        $id_container = BiayaLainnya::where('id', $request->id)->value('kontainer_id');
        $id_biaya = BiayaLainnya::find($request->id);
        $container = ContainerPlanload::find($id_container);

        $data = [
            "status" => "Process-Load",
        ];

        $container->update($data);

        $id_biaya->delete();


        return response()->json([
            'success'   => true
        ]);

    }
//BATAL-MUAT
    public function batalmuat(Request $request)
    {
        // dd($request);

        $id = $request->kontainer_batal;
        // BiayaLainnya::where('kontainer_id', $id)->delete();

        $container = ContainerPlanload::findOrFail($id);

        $update_container = [
            'status' => "Batal-Muat",
            'harga_batal' => $request->harga_batal,
            'keterangan_batal' => $request->keterangan_batal,
        ];

        $container->update($update_container);


        return response()->json(['success' => true]);
    }

    public function batalmuat_edit($id)
    {

        $container = ContainerPlanload::find($id);

        return response()->json([
            'result' => $container,
        ]);
    }

    public function batalmuat_update(Request $request, $id)
    {
        // dd($request);

        $id = $request->kontainer_batal;
        // BiayaLainnya::where('kontainer_id', $id)->delete();

        $container = ContainerPlanload::findOrFail($id);

        $update_container = [
            'status' => "Batal-Muat",
            'harga_batal' => $request->harga_batal,
            'keterangan_batal' => $request->keterangan_batal,
        ];

        $container->update($update_container);


        return response()->json(['success' => true]);
    }
    public function destroy_batal($id)
    {
        // dd($id);


        $container = ContainerPlanload::find($id);

        $data = [
            "status" => "Process-Load",
            "harga_batal" => null,
            "keterangan_batal" => null,
        ];

        $container->update($data);



        return response()->json([
            'success'   => true
        ]);

    }

//ALIH-kapal
    public function alihkapal(Request $request)
    {
        // dd($request);

        $alihkapals = [
            "job_id" => $request->job_id,
            "kontainer_alih" => $request->kontainer_alih,
            "pelayaran_alih" => $request->pelayaran_alih,
            "pot_alih" => $request->pot_alih,
            "pod_alih" => $request->pod_alih,
            "vesseL_alih" => $request->vessel_alih,
            "code_vesseL_alih" => $request->code_vesseL_alih,
            "harga_alih_kapal" => $request->harga_alih_kapal,
            "keterangan_alih_kapal" => $request->keterangan_alih_kapal,

        ];

        $id = AlihKapal::create($alihkapals);

        $update = [
            'harga_alih' => $id->id,
            'status' => 'Alih-Kapal',

        ];

        $container = ContainerPlanload::find($request->kontainer_alih);

        $container->update($update);
        return response()->json(['success' => true]);
    }

    public function alihkapal_edit($id)
    {

        $alihkapal = AlihKapal::find($id);

        return response()->json([
            'result' => $alihkapal,
        ]);
    }

    public function alihkapal_update(Request $request, $id)
    {
        // dd($id);

        $alihs = AlihKapal::findOrFail($id);

        $alihkapals = [
            "job_id" => $request->job_id,
            "kontainer_alih" => $request->kontainer_alih,
            "pelayaran_alih" => $request->pelayaran_alih,
            "pot_alih" => $request->pot_alih,
            "pod_alih" => $request->pod_alih,
            "vesseL_alih" => $request->vessel_alih,
            "code_vesseL_alih" => $request->code_vesseL_alih,
            "harga_alih_kapal" => $request->harga_alih_kapal,
            "keterangan_alih_kapal" => $request->keterangan_alih_kapal,

        ];


        $alihs->update($alihkapals);


        return response()->json(['success' => true]);
    }

    public function destroy_alihkapal($id)
    {
        // dd($id);
        AlihKapal::where('kontainer_alih', $id)->delete();


        $container = ContainerPlanload::find($id);

        $data = [
            "status" => "Process-Load",
            "harga_alih" => null,
        ];

        $container->update($data);



        return response()->json([
            'success'   => true
        ]);

    }

    public function plan_update(Request $request, $id)
    {

        $OrderJobPlanload = OrderJobPlanload::findOrFail($id);

        $orderJob = [
            'activity' => $request->activity,
            'select_company' => $request->select_company,
            'vessel' => $request->vessel,
            'vessel_code' => $request->vessel_code,
            'pol' => $request->pol,
            'pot' => $request->pot,
            'pod' => $request->pod,
            'pengirim' => $request->pengirim,
            'penerima' => $request->penerima,
        ];

        $OrderJobPlanload->update($orderJob);

        return response()->json(['success' => true]);
    }





    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        dd($request);

        $ongkos_supir = [];

        for($i = 0; $i < count($request->dana); $i++){
            $ongkos_supir[$i] = (int)OngkoSupir::where('id', (int)$request->dana[$i])->value('nominal');
        }

        // dd((int)str_replace(".", "", $request->ongkos_supir[0]));

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
                'size' => $request->size[$k],
                'type' => $request->type[$k],
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
                'dana' => $request->dana[$k],
                'slug' => $request->nomor_kontainer[$k].'-'.$request->seal[$k].'-'.time(),
                'status' => $status,
            ];
            ContainerPlanload::where('id', $processload_update[$k])->update($container);
        }

        $ongkos_supir_now = [];
        for($i = 0; $i < count($request->dana); $i++) {
            $ongkos_supir_now[$i] = $ongkos_supir[$i] - (int)str_replace(".", "", $request->ongkos_supir[$i]);
            OngkoSupir::where('id', (int)$request->dana[$i])->update(array('nominal' => (float)$ongkos_supir_now[$i]));
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
    public function save(Request $request)
    {

        dd($request->seal);

        $ongkos_supir = [];

        for($i = 0; $i < count($request->dana); $i++){
            $ongkos_supir[$i] = (int)OngkoSupir::where('id', (int)$request->dana[$i])->value('nominal');
        }

        // dd((int)str_replace(".", "", $request->ongkos_supir[0]));

        $old_slug = $request->old_slug;

        $old_id = OrderJobPlanload::where('slug', $old_slug)->value('id');

        $OrderJobPlanload = OrderJobPlanload::findOrFail($old_id);

        // $orderjob = [
        //     'status' => 'Process-Load',
        // ];

        // $OrderJobPlanload->update($orderjob);


        //CREATE-CONTAINER
        $urutan = (int)$request->urutan;


        ContainerPlanload::where('job_id', $old_id)->delete();
        for ($i = 0; $i < $urutan; $i++) {

            $container = [
                'job_id' => $old_id,
                'size' => $request->size[$i],
                'type' => $request->type[$i],
                'cargo' => $request->cargo[$i],
            ];
            ContainerPlanload::create($container);
        }
        $all_id = ContainerPlanload::where('job_id', $old_id)->get('id');

        $processload_update = [];

        for($i = 0; $i < count($all_id); $i++) {
            $processload_update[$i] =   $all_id[$i]->id;
        }

        //SEAL-CONTAINER

        // if ($request->seal != null) {

            // SealContainer::where('job_id', $old_id)->delete();

            for ($i=0; $i <count($request->seal) ; $i++) {
                $id_seal[$i] = $request->seal[$i];

                for ($j=0; $j <count($id_seal[$i]) ; $j++) {
                    $seal_container = [
                        "job_id" => $old_id,
                        "kontainer_id" => $all_id[$i]->id,
                        "seal_kontainer" => $request->seal[$i][$j],

                    ];

                    SealContainer::create($seal_container);
                }

            }
        // }

        dd($seal_container);


        //CONTAINER-UPDATE

        for ($k = 0; $k < $urutan; $k++) {
            $container = [
                'size' => $request->size[$k],
                'type' => $request->type[$k],
                'nomor_kontainer' => $request->nomor_kontainer[$k],
                'seal' => $request->seal[$k],
                'cargo' => $request->cargo[$k],
                // 'date_activity' =>  $request->date_activity[$k],
                'lokasi_depo' => $request->lokasi[$k],
                'driver' => $request->driver[$k],
                'nomor_polisi' => $request->nomor_polisi[$k],
                'remark' => $request->remark[$k],
                // 'biaya_stuffing' => str_replace(".", "", $request->biaya_stuffing[$k]),
                // 'biaya_trucking' => str_replace(".", "", $request->biaya_trucking[$k]),
                // 'ongkos_supir' => str_replace(".", "", $request->ongkos_supir[$k]),
                // 'biaya_thc' => str_replace(".", "", $request->biaya_thc[$k]),
                'nomor_surat' => $request->no_surat[$k],
                'jenis_mobil' => $request->jenis_mobil[$k],
                'detail_barang' => $request->detail_barang[$k],
                'tahun' => (int)$request->tahun[$k],
                'dana' => $request->dana[$k],
                'slug' => $request->nomor_kontainer[$k].'-'.$request->seal[$k].'-'.time(),
            ];
            ContainerPlanload::where('id', $processload_update[$k])->update($container);
        }

        $ongkos_supir_now = [];
        for($i = 0; $i < count($request->dana); $i++) {
            $ongkos_supir_now[$i] = $ongkos_supir[$i] - (int)str_replace(".", "", $request->ongkos_supir[$i]);
            OngkoSupir::where('id', (int)$request->dana[$i])->update(array('nominal' => (float)$ongkos_supir_now[$i]));
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
    public function update(Request $request)
    {

        // dd($request->old_table);

        $ongkos_supir = [];

        for($i = 0; $i < count($request->dana); $i++){
            $ongkos_supir[$i] = (int)OngkoSupir::where('id', (int)$request->dana[$i])->value('nominal');
        }
        // for($i = (int)$request->old_table; $i < count($request->dana); $i++){
        //     $ongkos_supir[$i] = (int)OngkoSupir::where('id', (int)$request->dana[$i])->value('nominal');
        // }

        // dd($ongkos_supir);


         $old_slug = $request->old_slug;

         $old_id = OrderJobPlanload::where('slug', $old_slug)->value('id');
        //  dd($old_id);

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

         ContainerPlanload::where('job_id', $old_id)->delete();

         $job_id = [];

         for ($i=0; $i < $urutan ; $i++) {
            $job_id[$i] = $old_id;
         }

         for ($k = 0; $k < $urutan; $k++) {
             $container = [
                 'job_id' => $job_id[$k],
                 'size' => $request->size[$k],
                 'type' => $request->type[$k],
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
                 'dana' => $request->dana[$k],
                 'slug' => $request->nomor_kontainer[$k].'-'.$request->seal[$k].'-'.time(),
                 'status' => $status,
             ];

             ContainerPlanload::create($container);
         }
         // $update_id->update($container);

        $ongkos_supir_now = [];
        for($i = (int)$request->old_table; $i < count($request->dana); $i++) {
            $ongkos_supir_now[$i] = $ongkos_supir[$i] - (int)str_replace(".", "", $request->ongkos_supir[$i]);
            OngkoSupir::where('id', (int)$request->dana[$i])->update(array('nominal' => (float)$ongkos_supir_now[$i]));
        }

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
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        // dd($id);

        $container = ContainerPlanload::find($request->id);
        $container->delete();

        // $update =[
        //     "jumlah_kontainer" => count($job_id),

        // ];
        // dd($job_id);
        // $container->update($update);
        return response()->json([
            'success'   => true
        ]);

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



        $seal = SealContainer::all();

        return response()->json($seal);
    }

    public function getSpkProcessLoad(Request $request) {

        $seal = SpkContainer::all();

        return response()->json($seal);
    }

    public function getNoContainer(Request $request) {
        // dd($request);
        $check_no_kontainer = ContainerPlanLoad::where('job_id', $request->job_id)->get();
        $no_kontainer_already = [];
        for($i = 0; $i < count($check_no_kontainer); $i++){
            $no_kontainer_already[$i] = $check_no_kontainer[$i]->nomor_kontainer;
        }
        return response()->json($no_kontainer_already);
        // dd($no_kontainer_already);
        // $no_container = ContainerPlanload::all();
        // $no_container_process_load = [];
        // for($i = 0; $i < count($no_container); $i++) {
        //     $no_container_process_load[$i] = $no_container[$i]->nomor_kontainer;
        // }
        // $no_container_process_load_without_null = array_merge(array_diff($no_container_process_load, array(null)));
        // return response()->json($no_container_process_load_without_null);
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
        $seal = Seal::where('status', 'input')->get();
        $lokasi = Depo::all();
        $size = Container::all();
        $type = TypeContainer::all();


        $dana = OngkoSupir::select('id', 'pj', 'nominal')->get();
        $alih = [
            'seal' => $seal,
            'dana' => $dana,
            'lokasi' => $lokasi,
            'size' => $size,
            'type' => $type,
        ];
        return response()->json($alih);
    }

}
