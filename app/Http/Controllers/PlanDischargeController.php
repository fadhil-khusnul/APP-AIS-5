<?php

namespace App\Http\Controllers;

use App\Models\PlanDischarge;
use App\Models\PlanLoad;
use Illuminate\Http\Request;
use App\Models\Stripping;
use App\Models\ShippingCompany;
use App\Models\Pelabuhan;
use App\Models\Pengirim;
use App\Models\Penerima;
use App\Models\Container;
use App\Models\PlanDischargeContainer;
use App\Models\TypeContainer;
use App\Http\Requests\StorePlanLoadRequest;
use App\Http\Requests\UpdatePlanLoadRequest;
use Illuminate\Support\Str;
use App\Models\AlihKapal;
use App\Models\BatalMuat;
use App\Models\Seal;
use App\Models\Depo;
use App\Models\BiayaLainDischarge;


class PlanDischargeController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    public function index()
    {
        $discharges = PlanDischarge::orderBy('id', 'DESC')->get();
        $containers = PlanDischargeContainer::all();
        $select_company =  PlanDischarge::all()->unique('select_company');
        $vessel =  PlanDischarge::all()->unique('vessel');
        $containers_group = PlanDischargeContainer::select('job_id', 'size', 'type', 'cargo', 'jumlah_kontainer' )->groupBy('job_id', 'size', 'type', 'cargo', 'jumlah_kontainer')->get();

        return view('plan.discharge.plandischarge', [
            'title' => 'Discharge-Plan',
            'active' => 'Discharge',
            'plandischarges' => $discharges,
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
        $activity = Stripping::where('jenis_kegiatan', 'Stripping')->get();
        $shipping_company = ShippingCompany::all();
        $pol = Pelabuhan::all();
        $pot = Pelabuhan::all();
        $pod = Pelabuhan::all();
        $pengirim = Pengirim::all();
        $penerima = Penerima::all();
        $kontainer = Container::all();

        return view('plan.discharge.plandischarge-create',[
            'title' => 'Buat Discharge-Plan',
            'activity' => $activity,
            'active' => 'Plan',
            'shippingcompany' => $shipping_company,
            'pol' => $pol,
            'pot' => $pot,
            'pod' => $pod,
            'pengirim' => $pengirim,
            'penerima' => $penerima,
            'kontainer' => $kontainer,

            ]);
    }

    /**
     * Store a newly created resource in storage.
     */


    public function create_job_plandischarge(Request $request)
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
            'pol' => $request->pol,
            'pot' => $request->pot,
            'pod' => $request->pod,
            'pengirim' => $request->pengirim,
            'penerima' => $request->penerima,
            'nomor_do' => $request->nomor_do,
            'tanggal_tiba' => $request->tanggal_tiba,
            'slug' => $slug,
            'status' => "Plan-Discharge",
        ];

        PlanDischarge::create($orderJob);

        $id = PlanDischarge::where('slug', $slug)->value('id');

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
                PlanDischargeContainer::create($container);
            }
        }

        return response()->json(['success' => true]);
    }

    public function edit(Request $request)
    {
        $id = PlanDischarge::where('slug', $request->slug)->value('id');
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
        return view('plan.discharge.plandischarge-edit', [
            'title' => 'Edit Discharge-Plan',
            'active' => 'Plan',
            'activity' => $activity,
            'shippingcompany' => $shipping_company,
            'pol' => $pol,
            'pot' => $pot,
            'pod' => $pod,
            'pengirim' => $pengirim,
            'penerima' => $penerima,
            'sizes' => $size,
            'types' => $type,
            'planload' => PlanDischarge::find($id),
            'containers' => PlanDischargeContainer::select('type', 'jumlah_kontainer', 'size', 'cargo')->where('job_id', $id)->groupBy('jumlah_kontainer', 'type', 'size', 'cargo')->get()
        ]);

    }
    public function update(Request $request)
    {
        // dd($request);

        $old_slug = $request->old_slug;

        $old_id = PlanDischarge::where('slug', $old_slug)->value('id');

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

        $PlanDischarge = PlanDischarge::findOrFail($old_id);

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
            'nomor_do' => $request->nomor_do,
            'tanggal_tiba' => $request->tanggal_tiba,
            'slug' => $slug,
        ];

        $PlanDischarge->update($orderJob);

        PlanDischargeContainer::where('job_id', $old_id)->delete();
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
                PlanDischargeContainer::create($container);
            }
        }

        return response()->json(['success' => true]);

    }


    /**
     * Display the specified resource.
     */
    public function getNoSurat_discharge(Request $request) {
        $tahun = $request->tahun;
        $no_surat = PlanDischargeContainer::where('tahun', $tahun)->get();
        $count_no_surat = count($no_surat);

        return response()->json($count_no_surat);
    }

    public function getSealProcessLoad(Request $request) {
        $seal = PlanDischargeContainer::all();
        $seal_process_load = [];
        for($i = 0; $i < count($seal); $i++) {
            $seal_process_load[$i] = $seal[$i]->seal;
        }
        $seal_process_load_without_null = array_merge(array_diff($seal_process_load, array(null)));
        return response()->json($seal_process_load_without_null);
    }

    public function getNoContainer() {
        $no_container = PlanDischargeContainer::all();
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
        $get_id = PlanDischarge::where('slug', $slug)->value('id');
        $get_container = PlanDischargeContainer::select('kontainer')->where('job_id', $get_id)->get();
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
        $plandischarges = PlanDischarge::orderBy('id', 'DESC')->get();
        $containers = PlanDischargeContainer::all();
        $containers_group = PlanDischargeContainer::select('job_id', 'size', 'type', 'cargo', 'jumlah_kontainer' )->groupBy('job_id', 'size', 'type', 'cargo', 'jumlah_kontainer')->get();
        $select_company =  PlanDischarge::all()->unique('select_company');
        $vessel =  PlanDischarge::all()->unique('vessel');

        $biayas= BiayaLainDischarge::all();
        $alihkapal= AlihKapal::all();
        $batalmuat= BatalMuat::all();
        return view('process.discharge.processdischarge',[
            'title' => 'Discharge-Process',
            'active' => 'Discharge',
            'plandischarges' => $plandischarges,
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
        $id = PlanDischarge::where('slug', $request->slug)->value('id');
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
        return view('process.discharge.processdischarge-create',[
            'title' => 'Discharge-Process',
            'active' => 'Discharge',
            'shippingcompany' => $shipping_company,
            'pol' => $pol,
            'pot' => $pot,
            'pod' => $pod,
            'pengirim' => $pengirim,
            'penerima' => $penerima,
            'kontainers' => $kontainer,
            'lokasis' => $lokasis,
            'activity' => $activity,
            'seals' => $seals,
            'planload' => PlanDischarge::find($id),
            'containers' => PlanDischargeContainer::where('job_id', $id)->get(),

        ]);
    }

    public function store_process(Request $request)
    {

        // dd($request);


        $old_slug = $request->old_slug;

        $old_id = PlanDischarge::where('slug', $old_slug)->value('id');

        $PlanDischarge = PlanDischarge::findOrFail($old_id);

        $orderjob = [
            'status' => 'Process-Discharge',
            'biaya_do' => str_replace('.','', $request->biaya_do),

        ];

        $PlanDischarge->update($orderjob);



        $all_id = PlanDischargeContainer::where('job_id', $old_id)->get('id');

        $processload_update = [];

        for($i = 0; $i < count($all_id); $i++) {
            $processload_update[$i] =   $all_id[$i]->id;
        }

        $urutan = (int)$request->urutan;

        $status = "Process-Discharge";

        for ($k = 0; $k < $urutan; $k++) {
            $container = [
                'nomor_kontainer' => $request->nomor_kontainer[$k],
                'cargo' => $request->cargo[$k],
                'detail_barang' => $request->detail_barang[$k],
                'seal' => $request->seal[$k],
                'date_activity' => $request->date_activity[$k],
                'lokasi_pickup' => $request->lokasi[$k],
                'driver' => $request->driver[$k],
                'nomor_polisi' => $request->nomor_polisi[$k],
                'activity' => $request->activity[$k],
                'biaya_relokasi' => str_replace('.','', $request->biaya_relokasi[$k]),
                'jaminan_kontainer' => str_replace('.','', $request->jaminan_kontainer[$k]),
                'remark' => $request->remark[$k],
                'jenis_mobil' => $request->jenis_mobil[$k],
                'slug' => $request->nomor_kontainer[$k].'-'.$request->seal[$k].'-'.time(),
                'status' => $status,
            ];
            PlanDischargeContainer::where('id',$processload_update[$k])->update($container);
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

            BiayaLainDischarge::create($biayas);
        }



        return response()->json(['success' => true]);
    }

    public function realisasi()
    {
        $plandischarges = PlanDischarge::orderBy('id', 'DESC')->where('status', 'Realisasi')->orWhere('status', 'Process-Discharge')->get();
        $containers = PlanDischargeContainer::all();
        $containers_group = PlanDischargeContainer::select('job_id', 'size', 'type', 'cargo', 'jumlah_kontainer' )->groupBy('job_id', 'size', 'type', 'cargo', 'jumlah_kontainer')->get();
        $select_company =  PlanDischarge::all()->unique('select_company');
        $vessel =  PlanDischarge::all()->unique('vessel');

        $biayas= BiayaLainDischarge::all();
        $alihkapal= AlihKapal::all();
        $batalmuat= BatalMuat::all();
        return view('realisasi.discharge.realisasi',[
            'title' => 'Discharge-Realisasi',
            'active' => 'Discharge',
            'plandischarges' => $plandischarges,
            'containers' => $containers,
            'containers_group' => $containers_group,
            'select_company' => $select_company,
            'vessel' => $vessel,
            'biayas' => $biayas,
            'alihkapal' => $alihkapal,
            'batalmuat' => $batalmuat,

        ]);
    }

    public function realisasi_create(Request $request)
    {
        $id = PlanDischarge::where('slug', $request->slug)->value('id');

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
        return view('realisasi.discharge.realisasi-create',[
            'title' => 'Buat Discharge-Realisasi',
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
            'planload' => PlanDischarge::find($id),
            'containers' => PlanDischargeContainer::where('job_id', $id)->get(),
            'biayas' => BiayaLainDischarge::where('job_id', $id)->get(),

        ]);
    }

    public function store_realisasi(Request $request)
    {

        // dd($request);


        $old_slug = $request->old_slug;

        $old_id = PlanDischarge::where('slug', $old_slug)->value('id');

        $PlanDischarge = PlanDischarge::findOrFail($old_id);

        $orderjob = [
            'status' => 'Realisasi',

        ];

        $PlanDischarge->update($orderjob);



        $all_id = PlanDischargeContainer::where('job_id', $old_id)->get('id');

        $processload_update = [];

        for($i = 0; $i < count($all_id); $i++) {
            $processload_update[$i] =   $all_id[$i]->id;
        }

        $urutan = (int)$request->urutan;

        $status = "Realisasi";

        for ($k = 0; $k < $urutan; $k++) {
            $container = [

                'biaya_trucking' => str_replace('.','', $request->biaya_trucking[$k]),
                'biaya_thc' => str_replace('.','', $request->biaya_thc[$k]),
                'biaya_demurrage' => str_replace('.','', $request->biaya_demurrage[$k]),
                'lokasi_kembali' => $request->lokasi_kembali[$k],
                'tanggal_kembali' => $request->tanggal_kembali[$k],
                'status' => $status,
            ];
            PlanDischargeContainer::where('id',$processload_update[$k])->update($container);
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

            BiayaLainDischarge::create($biayas);
        }


        return response()->json(['success' => true]);
    }






}
