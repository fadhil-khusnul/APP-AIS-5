<?php

namespace App\Http\Controllers;

use Cookie;
use Session;
use Tracker;
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
use App\Models\Stripping;
use App\Models\OngkoSupir;
use App\Models\SupirMobil;
use App\Models\ProcessLoad;
use App\Models\VendorMobil;
use Illuminate\Support\Str;
use App\Models\BiayaLainnya;
use App\Models\SpkContainer;
use Illuminate\Http\Request;
use App\Models\SealContainer;
use App\Models\TypeContainer;
use App\Models\ShippingCompany;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\DetailBarangLoad;

use App\Models\OrderJobPlanload;
use App\Models\ContainerPlanload;
use App\Http\Requests\StoreProcessLoadRequest;
use App\Http\Requests\UpdateProcessLoadRequest;

class ProcessLoadController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $planloads = OrderJobPlanload::orderBy('id', 'DESC')->where('status', 'Process-Load')->orWhere('status', 'Plan-Load')->orWhere('status', 'Realisasi')->get();
        $containers = ContainerPlanload::orderBy('id', 'DESC')->get();
        $sizez = ContainerPlanload::orderBy('id', 'DESC')->get('size');
        $containers_group = ContainerPlanload::select('job_id', 'size', 'type', 'cargo', 'jumlah_kontainer' )->groupBy('job_id', 'size', 'type', 'cargo', 'jumlah_kontainer')->get();



        // dd($containers_group);
        $select_company =  OrderJobPlanload::all()->unique('select_company');
        $vessel =  OrderJobPlanload::all()->unique('vessel');

        $biayas= BiayaLainnya::all();
        $details= DetailBarangLoad::all();
        $sealcontainers= SealContainer::all();
        $alihkapal= AlihKapal::all();
        $batalmuat= BatalMuat::all();
        return view('process.load.processload',[
            'title' => 'Process (Load)',
            'active' => 'Load',
            'planloads' => $planloads,
            'containers' => $containers,
            'containers_group' => $containers_group,
            'select_company' => $select_company,
            'vessel' => $vessel,
            'biayas' => $biayas,
            'alihkapal' => $alihkapal,
            'details' => $details,
            'batalmuat' => $batalmuat,
            'sealcontainers' => $sealcontainers,

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
        $pods = Pelabuhan::all();
        $pelabuhans = Pelabuhan::all();
        $pengirim = Pengirim::all();
        $penerima = Penerima::all();
        $kontainer = Container::all();
        $lokasis = Depo::where('pelayaran_id', $pelayaran_id)->get();
        $danas = OngkoSupir::all();
        $sizes = Container::all();
        $types = TypeContainer::all();
        $seals = Seal::where('status', 'input')->get();
        $seals_edit = Seal::where('status', 'input')->orWhere('status', 'Container')->get();
        $spks = Spk::where('pelayaran_id', $pelayaran_id)->where('status', 'input')->get();
        $spks_edit = Spk::where('pelayaran_id', $pelayaran_id)->where('status', 'input')->orWhere('status', 'Container')->get();
        $sealscontainer = SealContainer::where('job_id', $id)->select('job_id')->groupby('job_id')->get();

        $containers = ContainerPlanload::where('job_id', $id)->whereNull('harga_alih')->where(function($query) {
            $query
            ->Where('status', '=', 'Process-Load')
                ->orWhereNull('status');
        })->get();

        $containers_info = ContainerPlanload::where('job_id', $id)->whereNull('slug')->get();



        $container_batal = ContainerPlanload::where('job_id', $id)->where(function($query) {
            $query->where('status', 'Batal-Muat');
            // ->whereNull('slug');
                ;
        })->get();

        $select_batal_edit = ContainerPlanload::where('job_id', $id)->whereNotNull('status')->whereNull('slug')->get();
        $select_biaya = ContainerPlanload::where('job_id', $id)->where('total_biaya_lain', 0)->whereNotNull('status')->whereNull('slug')->get();
        $select_barang = ContainerPlanload::where('job_id', $id)->whereNull('status_barang')->whereNotNull('status')->whereNull('slug')->get();
        // dd($containers);

        $containers_alih = ContainerPlanload::where('job_id', $id)->whereNull('harga_alih')->where(function($query) {
            $query->where('status', '!=', 'Batal-Muat')
            ->where('status', '!=', 'Alih-Kapal')
            ->where('status', '!=', 'Realisasi-Alih')
            ->where('status', '!=', 'Realisasi')
                ->whereNotNull('status');
        })->whereNull('slug')->get();


        $alihs = AlihKapal::where('job_id', $id)->get();
        $vendors = SupirMobil::orderBy('id', 'DESC')->get();
        $vendors2 = VendorMobil::orderBy('id', 'DESC')->get();
        $supirs = SupirMobil::orderBy('id', 'DESC')->get();
        $sealsc = SealContainer::where('job_id', $id)->get();

        $kontainer_id = DetailBarangLoad::where("job_id", $id)->distinct()->get('kontainer_id');

        $containers_barang = [];
        $new_container = [];
        if ($kontainer_id != null) {
            for ($i=0; $i <count($kontainer_id) ; $i++) {
                $containers_barang[$i] = ContainerPlanload::where('id', $kontainer_id[$i]->kontainer_id)->get();
            }


            for($i = 0; $i < count($containers_barang); $i++) {
                $new_container[$i] = [
                    'id' => $containers_barang[$i][0]->id,
                    'job_id' => $containers_barang[$i][0]->job_id,
                    'size' => $containers_barang[$i][0]->size,
                    'type' => $containers_barang[$i][0]->type,
                    'nomor_kontainer' => $containers_barang[$i][0]->nomor_kontainer,
                    'pengirim' => $containers_barang[$i][0]->pengirim,
                    'pod_container' => $containers_barang[$i][0]->pod_container,
                    'slug' => $containers_barang[$i][0]->slug,

                ];

            }
        }
        $id_biaya = BiayaLainnya::where("job_id", $id)->distinct()->get('kontainer_id');

        // dd($id_biaya);
        $containers_biaya = [];
        $new_container_biaya = [];
        if ($id_biaya != null) {
            for ($i=0; $i <count($id_biaya) ; $i++) {
                $containers_biaya[$i] = ContainerPlanload::where('id', $id_biaya[$i]->kontainer_id)->get();
            }


            for($i = 0; $i < count($containers_biaya); $i++) {
                $new_container_biaya[$i] = [
                    'id' => $containers_biaya[$i][0]->id,
                    'job_id' => $containers_biaya[$i][0]->job_id,
                    'size' => $containers_biaya[$i][0]->size,
                    'type' => $containers_biaya[$i][0]->type,
                    'nomor_kontainer' => $containers_biaya[$i][0]->nomor_kontainer,
                    'total_biaya_lain' => $containers_biaya[$i][0]->total_biaya_lain,
                    'pengirim' => $containers_biaya[$i][0]->pengirim,
                    'pod_container' => $containers_biaya[$i][0]->pod_container,
                    'slug' => $containers_biaya[$i][0]->slug

                ];

            }
        }
        $id_alih = AlihKapal::where("job_id", $id)->distinct()->get('kontainer_alih');

        // dd($id_alih);
        $containers_alih_list = [];
        $new_container_alih = [];
        if ($id_alih != null) {
            for ($i=0; $i <count($id_alih) ; $i++) {
                $containers_alih_list[$i] = ContainerPlanload::where('id', $id_alih[$i]->kontainer_alih)->get();
            }

            // dd($containers_alih_list);




            for($i = 0; $i < count($containers_alih_list); $i++) {
                $new_container_alih[$i] = new ContainerPlanload([
                    'id' => $containers_alih_list[$i][0]->id,
                    'job_id' => $containers_alih_list[$i][0]->job_id,
                    'size' => $containers_alih_list[$i][0]->size,
                    'type' => $containers_alih_list[$i][0]->type,
                    'harga_alih' => (int)$containers_alih_list[$i][0]->harga_alih,
                    'nomor_kontainer' => $containers_alih_list[$i][0]->nomor_kontainer,
                    'pengirim' => $containers_alih_list[$i][0]->pengirim,
                    'penerima' => $containers_alih_list[$i][0]->penerima,
                    'slug' => $containers_alih_list[$i][0]->slug

                ]);

            }
        }


        $new_container = collect($new_container)->whereNull('slug');
        $new_container_biaya = collect($new_container_biaya)->whereNull('slug');
        $new_container_alih = collect($new_container_alih)->whereNull('slug')->whereNotNull('harga_alih');


        //
        return view('process.load.processload-create',[
            'title' => 'Process (Load)',
            'active' => 'Process',
            'activity' => $activity,
            'alihs' => $alihs,
            'spks' => $spks,
            'spks_edit' => $spks_edit,
            'sealsc' => $sealsc,
            'select_barang' => $select_barang,
            'select_biaya' => $select_biaya,
            'seals_edit' => $seals_edit,
            'shippingcompany' => $shipping_company,
            'shipping_companys' => $shipping_companys,
            'containers_barang' => $new_container,
            'new_container_biaya' => $new_container_biaya,
            'new_container_alih' => $new_container_alih,
            'pol' => $pol,
            'pot' => $pot,
            'pod' => $pod,
            'pods' => $pods,
            'pelabuhans' => $pelabuhans,
            'pengirims' => $pengirim,
            'penerimas' => $penerima,
            'kontainers' => $kontainer,
            'lokasis' => $lokasis,
            'vendors' => $vendors,
            'vendors2' => $vendors2,
            'supirs' => $supirs,
            'seals' => $seals,
            'sealscontainer' => $sealscontainer,
            'sizes' => $sizes,
            'types' => $types,
            'danas' => $danas,
            'containers_info' => $containers_info,
            'containers' => $containers,
            'container_batal' => $container_batal,
            'containers_alih' => $containers_alih,
            'select_batal_edit' => $select_batal_edit,
            'planload' => OrderJobPlanload::find($id),
            'biayas' => BiayaLainnya::where('job_id', $id)->get(),
            'details' => DetailBarangLoad::where('job_id', $id)->get(),
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
        $spks = ContainerPlanload::where("id", $id)->value('spk');
        $driver = ContainerPlanload::where('id', $id)->value('nomor_polisi');
        $supirs = VendorMobil::where("id", $driver)->get();

        // dd($supirs[0]->nama_vendor);
        return response()->json([
            'result' => $container,
            'seal_containers' => $seal_containers,
            'spks' => $spks,
            'supirs' => $supirs,
        ]);
    }



    public function detail_alihkapal($id)
    {

        $alih = AlihKapal::where('kontainer_alih', $id)->get();
        $container = ContainerPlanload::where('id', $id)->value('job_id');
        $kapal = OrderJobPlanload::where('id', $container)->get();

        // $kapal = implode('', $kapal);

        // dd($kapal);

        return response()->json([
            'alih' => $alih,
            'kapal' => $kapal,
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
            'pengirim' => $request->pengirim,
            'penerima' => $request->penerima,
            'size' => $request->size,
            'type' => $request->type,
            'nomor_kontainer' => $request->nomor_kontainer,
            'cargo' => $request->cargo,
            'date_activity' => $request->date_activity,
            'lokasi_depo' => $request->lokasi,
            'driver' => $request->driver,
            'pod_container' => $request->pod_container,
            'pot_container' => $request->pot_container,
            'vessel_pot' => $request->vessel_pot,
            'kode_vessel_pot' => $request->kode_vessel_pot,
            'nomor_polisi' => $request->nomor_polisi,
            'remark' => $request->remark,
            'biaya_stuffing' =>$request->biaya_stuffing,
            'biaya_trucking' =>$request->biaya_trucking,
            'ongkos_supir' =>$request->ongkos_supir,
            'biaya_thc' =>$request->biaya_thc,
            'biaya_seal' =>$request->biaya_seal,
            'freight' =>$request->freight,
            'lss' =>$request->lss,
            'nomor_surat' => $request->no_surat,
            'jenis_mobil' => $request->jenis_mobil,
            'detail_barang' => $request->detail_barang,
            'tahun' => (int)$request->tahun,
            'dana' => $request->dana,
            'spk' => $request->spk,
            'status' => $status,
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

        $dana = OngkoSupir::where('id', $request->dana)->value('nominal');

        $update_dana = [
            "nominal" => (int)$dana - (int)$request->ongkos_supir
        ];

        OngkoSupir::where("id", $request->dana)->update($update_dana);

        if ($request->spk != null){
            $data2 = [
                "status" => "Container",

            ];
            Spk::where("kode_spk", $request->spk)->update($data2);
        }

        return response()->json(['success' => true]);
    }
    public function input_edit(Request $request, $id)
    {
        // dd($request);



        $container = ContainerPlanload::findOrFail($id);
        $planload = OrderJobPlanload::findOrFail($request->job_id);


        $status = "Process-Load";

        $load = [
            'status' => $status,
        ];

        $data = [
            'pengirim' => $request->pengirim,
            'penerima' => $request->penerima,
            'size' => $request->size,
            'type' => $request->type,
            'nomor_kontainer' => $request->nomor_kontainer,
            'cargo' => $request->cargo,
            'date_activity' => $request->date_activity,
            'lokasi_depo' => $request->lokasi,
            'pod_container' => $request->pod_container,
            'pot_container' => $request->pot_container,
            'vessel_pot' => $request->vessel_pot,
            'kode_vessel_pot' => $request->kode_vessel_pot,
            'driver' => $request->driver,
            'nomor_polisi' => $request->nomor_polisi,
            'remark' => $request->remark,
            'biaya_stuffing' =>$request->biaya_stuffing,
            'biaya_trucking' =>$request->biaya_trucking,
            'ongkos_supir' =>$request->ongkos_supir,
            'biaya_thc' =>$request->biaya_thc,
            'biaya_seal' =>$request->biaya_seal,
            'freight' =>$request->freight,
            'lss' =>$request->lss,
            'nomor_surat' => $request->no_surat,
            'jenis_mobil' => $request->jenis_mobil,
            'detail_barang' => $request->detail_barang,
            'tahun' => (int)$request->tahun,
            'dana' => $request->dana,
            'spk' => $request->spk,
            'status' => $status,
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

        $old_ongkos_supir = $request->old_ongkos_supir;
        $old_dana = $request->old_dana;

        $dana_back = OngkoSupir::where('id', $old_dana)->value('nominal');

        $dana_kembali = [
            "nominal" => (int)$dana_back + (int)$old_ongkos_supir
        ];

        OngkoSupir::where('id', $old_dana)->update($dana_kembali);

        $dana = OngkoSupir::where('id', $request->dana)->value('nominal');

        $update_dana = [
            "nominal" => (int)$dana - (int)$request->ongkos_supir
        ];

        OngkoSupir::where("id", $request->dana)->update($update_dana);


        if ($request->spk != null) {
            # code...

            SpkContainer::where('kontainer_id', $id)->delete();


            $data4 = [
                "status" => "input",

            ];
            Spk::where("kode_spk", $request->spk_old)->update($data4);



            $data3 = [
                "status" => "Container",

            ];

            Spk::where("kode_spk", $request->spk)->update($data3);


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
            'pengirim' => $request->pengirim,
            'penerima' => $request->penerima,
            'size' => $request->size,
            'type' => $request->type,
            'nomor_kontainer' => $request->nomor_kontainer,
            'cargo' => $request->cargo,
            'date_activity' => $request->date_activity,
            'lokasi_depo' => $request->lokasi,
            'pod_container' => $request->pod_container,
            'pot_container' => $request->pot_container,
            'vessel_pot' => $request->vessel_pot,
            'kode_vessel_pot' => $request->kode_vessel_pot,
            'driver' => $request->driver,
            'nomor_polisi' => $request->nomor_polisi,
            'remark' => $request->remark,
            'biaya_stuffing' =>$request->biaya_stuffing,
            'biaya_trucking' =>$request->biaya_trucking,
            'ongkos_supir' =>$request->ongkos_supir,
            'biaya_thc' =>$request->biaya_thc,
            'biaya_seal' =>$request->biaya_seal,
            'freight' =>$request->freight,
            'lss' =>$request->lss,
            'nomor_surat' => $request->no_surat,
            'jenis_mobil' => $request->jenis_mobil,
            'detail_barang' => $request->detail_barang,
            'tahun' => (int)$request->tahun,
            'spk' => $request->spk,
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

                $data2 = [
                    "status" => "Container",

                ];

                Spk::where("kode_spk", $request->spk)->update($data2);

        }



        return response()->json(['success' => true]);
    }
//BIAYA-LAINNYA
    public function biayalain(Request $request)
    {
        $container = ContainerPlanload::findOrFail($request->kontainer_id);

        $update_container = [
            'total_biaya_lain' => $request->harga_biaya,
        ];

        $container->update($update_container);

        for($i = 0; $i < count($request->keterangan_biaya); $i++) {
            $data = [
                'job_id' => $request->job_id,
                'harga_biaya' => 0,
                'kontainer_id' => $request->kontainer_id,
                'keterangan' => $request->keterangan_biaya[$i],
            ];
            BiayaLainnya::create($data);
        }

        return response()->json(['success' => true]);
    }

    public function biayalain_edit($id)
    {

        $biaya = BiayaLainnya::where('kontainer_id',$id)->get();
        // dd($biaya)


        $total_biaya = ContainerPlanload::where('id', $id)->value('total_biaya_lain');
        return response()->json([
            'result' => $biaya,
            'total_biaya' => $total_biaya,
        ]);
    }

    public function biayalain_update(Request $request, $id)
    {
        $container = [
            "total_biaya_lain"=> $request->harga_biaya,
        ];

        ContainerPlanload::where('id', $id)->update($container);

        BiayaLainnya::where('kontainer_id', $id)->delete();

        for($i = 0; $i < count($request->keterangan); $i++) {
            $data = [
                'job_id' => $request->job_id,
                'kontainer_id' => $id,
                'harga_biaya' => 0,
                'keterangan' => $request->keterangan[$i],
            ];
            BiayaLainnya::create($data);
        }
        // dd($data);

        return response()->json(['success' => true]);


    }
    public function destroy_biaya(Request $request)
    {

        // dd($request);


        $container = ContainerPlanload::find($request->id);

        $data = [
            "status" => "Process-Load",
            "total_biaya_lain" => 0,
        ];

        $container->update($data);

        BiayaLainnya::where('kontainer_id', $request->id)->delete();


        return response()->json([
            'success'   => true
        ]);

    }

//DETAIL BARANG
    public function detailbarang(Request $request)
    {
        $container = ContainerPlanload::findOrFail($request->kontainer_id);

        $update_container = [
            'status_barang' => "done",
        ];

        $container->update($update_container);

        for($i = 0; $i < count($request->detail_barang); $i++) {
            $data = [
                'job_id' => $request->job_id,
                'kontainer_id' => $request->kontainer_id,
                'detail_barang' => $request->detail_barang[$i],
            ];
            DetailBarangLoad::create($data);
        }

        return response()->json(['success' => true]);
    }

    public function detailbarang_edit($id)
    {

        $detail = DetailBarangLoad::where('kontainer_id', $id)->get();
        // dd($detail);

        return response()->json([
            'result' => $detail,
        ]);
    }

    public function detailbarang_update(Request $request, $id)
    {
        DetailBarangLoad::where('kontainer_id', $id)->delete();

        for($i = 0; $i < count($request->detail_barang); $i++) {
            $data = [
                'job_id' => $request->job_id,
                'kontainer_id' => $id,
                'detail_barang' => $request->detail_barang[$i],
            ];
            DetailBarangLoad::create($data);
        }
        // dd($data);

        return response()->json(['success' => true]);
    }
    public function destroy_detailbarang(Request $request)
    {
        DetailBarangLoad::where('kontainer_id', $request->id)->delete();


        return response()->json([
            'success'   => true
        ]);

    }

    public function cetak_detail(Request $request){


        $old_slug = $request->old_slug;
        $old_id = OrderJobPlanload::where('slug', $old_slug)->value('id');
        $loads = OrderJobPlanload::where('id', $old_id)->get();

        $kontainer_id = DetailBarangLoad::where("job_id", $old_id)->distinct()->get('kontainer_id');



        for ($i=0; $i <count($kontainer_id) ; $i++) {
            $containers[$i] = ContainerPlanload::where('id', $kontainer_id[$i]->kontainer_id)->get();
        }
        $new_container = [];


        for($i = 0; $i < count($containers); $i++) {
            $new_container[$i] = [
                'id' => $containers[$i][0]->id,
                'job_id' => $containers[$i][0]->job_id,
                'size' => $containers[$i][0]->size,
                'type' => $containers[$i][0]->type,
                'nomor_kontainer' => $containers[$i][0]->nomor_kontainer,
                'pengirim' => $containers[$i][0]->pengirim,
                'pod_container' => $containers[$i][0]->pod_container,

            ];

        }
        // dd($containers[1][0]->nomor_kontainer);

        $details = DetailBarangLoad::where("job_id", $old_id)->get();

        // dd($request);


        $save = 'storage/detail-load.pdf';

        $pdf1 = Pdf::loadview('pdf.detail.detail_barang_load',[
            "loads" => $loads,
            "report" => "MUATAN",
            "details" => $details,
            "containers" => $new_container,




        ]);
        // $pdf1->setPaper('A4', 'landscape');
        $pdf1->save($save);






        return response()->download($save);


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

        ];

        $OrderJobPlanload->update($orderJob);

        return response()->json(['success' => true]);
    }





    /**
     * Store a newly created resource in storage.
     */

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


        // dd($seals);

        $seals = SealContainer::where('kontainer_id', $request->id)->get('seal_kontainer');



        for ($i = 0; $i < count($seals) ; $i++) {
            $input = [
                "status" => 'input',
            ];
            Seal::where('kode_seal', $seals[$i]->seal_kontainer)->update($input);
        }
        $spks = SpkContainer::where('kontainer_id', $request->id)->get();

        for ($i = 0; $i < count($spks) ; $i++) {
            $input = [
                "status" => 'input',
            ];
            Spk::where('kode_spk', $spks[$i]->spk_kontainer)->update($input);
        }

        $old_ongkos_supir = ContainerPlanLoad::where('id', $request->id)->value('ongkos_supir');
        $id_dana = ContainerPlanLoad::where('id', $request->id)->value('dana');
        $dana_back = OngkoSupir::where('id', $id_dana)->value('nominal');

        $dana_kembali = [
            "nominal" => (int)$dana_back + (int)$old_ongkos_supir
        ];

        OngkoSupir::where('id', $id_dana)->update($dana_kembali);

        SealContainer::where('kontainer_id', $request->id)->delete();
        SpkContainer::where('kontainer_id', $request->id)->delete();
        DetailBarangLoad::where('kontainer_id', $request->id)->delete();
        BiayaLainnya::where('kontainer_id', $request->id)->delete();

        $container = ContainerPlanload::find($request->id);
        $container->delete();


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

    public function getVendor(Request $request) {
        $id = $request->post('vendor_id');
        $vendor_id = SupirMobil::where('id',$id)->value('vendor_id');

        $vendors= VendorMobil::where('id', $vendor_id)->get();

        // dd($vendors->id);

        $html ='<option value="'.$vendors[0]->id.'">'.$vendors[0]->nama_vendor.'</option>';

        // dd($html);

        echo $html;
    }



    public function getSealProcessLoad(Request $request) {
        // dd($request);
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

    public function getSealKontainer(Request $request) {
        $seal = $request->seal;

        $harga_seal = Seal::where('kode_seal', $seal)->value('harga_seal');

        // dd($harga_seal);

        return response()->json($harga_seal);
    }
    public function getSpkKontainer(Request $request) {
        $spk = $request->spk;

        $harga_spk = Spk::where('kode_spk', $spk)->value('harga_spk');

        return response()->json($harga_spk);
    }

    public function getSpkProcess(Request $request) {
        $spk = $request->spk;

        $check_spk = Spk::where('kode_spk', $spk)->value('status');

        return response()->json($check_spk);
    }

}
