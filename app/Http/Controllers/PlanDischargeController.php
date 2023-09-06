<?php

namespace App\Http\Controllers;

use App\Models\Depo;
use App\Models\Seal;
use App\Models\Penerima;
use App\Models\Pengirim;
use App\Models\PlanLoad;
use App\Models\AlihKapal;
use App\Models\BatalMuat;
use App\Models\Container;
use App\Models\Pelabuhan;
use App\Models\Stripping;
use App\Models\OngkoSupir;
use App\Models\SupirMobil;
use App\Models\VendorMobil;
use Illuminate\Support\Str;
use App\Models\BiayaLainnya;
use Illuminate\Http\Request;
use App\Models\PlanDischarge;
use App\Models\SealContainer;
use App\Models\TypeContainer;
use App\Models\ShippingCompany;
use Barryvdh\DomPDF\Facade\Pdf;
// use Validator;
use App\Models\DetailBarangLoad;
use App\Models\ContainerPlanload;
use App\Models\BiayaLainDischarge;
use Illuminate\Http\RedirectResponse;
use App\Models\PlanDischargeContainer;
use Illuminate\Support\Facades\Validator;
use App\Http\Requests\StorePlanLoadRequest;
use App\Http\Requests\UpdatePlanLoadRequest;


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
    public function create(Request $request)
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
            'status' => "Plan",
        ];

        PlanDischarge::create($orderJob);

        return response()->json(['success' => true, 'slug' => $slug]);
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
        $containers = PlanDischargeContainer::where('job_id', $id)->get();
        $sealsc = SealContainer::where('job_id_discharge', $id)->get();

        $seals_edit = Seal::where('status', 'input')->orWhere('status', 'Container')->get();

        $seals = Seal::where('status', 'input')->get();

        // dd($seal_containers);

        return view('plan.discharge.plandischarge-edit', [
            'title' => 'Discharge-Plan',
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
            'seals' => $seals,
            'sealsc' => $sealsc,
            'seals_edit' => $seals_edit,
            'planload' => PlanDischarge::find($id),
            'containers' => $containers
        ]);

    }
    public function update(Request $request)
    {
        // dd($request);

        $validator = Validator::make($request->all(),[
            'activity' => 'required',
            'select_company' => 'required',
            'vessel' => 'required',
            'vessel_code' => 'required',
            'pol' => 'required',
            'pot' => 'required',
            'pod' => 'required',
            'pengirim' => 'required',
            'penerima' => 'required',
            'nomor_do' => 'required',
            'tanggal_tiba' => 'required',
        ], [
            "pengirim.required" => "pengirim Kosong",
        ]);

        $error = collect($validator->errors())->collapse()->toArray();
        $errors = implode(', ',$error);


        $old_slug = $request->old_slug;

        $old_id = PlanDischarge::where('slug', $old_slug)->value('id');

        if ($request->biaya_do === null) {
            $biaya_do = PlanDischarge::where('id', $old_id)->value('biaya_do');
        }
        else{
            $biaya_do = $request->biaya_do;
        }

        // dd($biaya_do);

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
            'biaya_do' => $biaya_do,
        ];

        $PlanDischarge->update($orderJob);

        if ($validator->passes()) {
            return response()->json(['success'=> true, "slug"=>$old_slug]);
        }
        else{

            return response()->json(['error'=>$errors, "slug"=>$old_slug]);
        }

       


    }

    public function input_tambah(Request $request)
    {
        // dd($request);

        $planload = PlanDischarge::findOrFail($request->job_id);

        $status = [
            "status" => "Process",
        ];

        $planload->update($status);


        $data = [
            'job_id' => $request->job_id,
            'size' => $request->size,
            'type' => $request->type,
            'nomor_kontainer' => $request->nomor_kontainer,
            'cargo' => $request->cargo,
            'biaya_seal' => $request->biaya_seal,
            "status" => "Process",

        ];

        $id = PlanDischargeContainer::create($data);

        for ($i=0; $i <count($request->seal) ; $i++) {

            $seal = [
                "job_id_discharge" => $request->job_id,
                "kontainer_id_discharge" => $id->id,
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



        return response()->json(['success' => true]);
    }

    public function input_edit(Request $request, $id)
    {
        // dd($request);
        $container = PlanDischargeContainer::findOrFail($id);
        $planload = PlanDischarge::findOrFail($request->job_id);


        $status = "Process";

        $load = [
            'status' => $status,
        ];

        $data = [
           
            'size' => $request->size,
            'type' => $request->type,
            'nomor_kontainer' => $request->nomor_kontainer,
            'cargo' => $request->cargo,
            'biaya_seal' => $request->biaya_seal,
            'status' => $status,
        ];


        SealContainer::where('kontainer_id_discharge', $id)->delete();

        for ($i=0; $i <count($request->seal) ; $i++) {

            $seal = [
                "job_id_discharge" => $request->job_id,
                "kontainer_id_discharge" => $id,
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
        $planload->update($load);
        $container->update($data);

        return response()->json(['success' => true]);
    }

    public function input($id)
    {
        $container = PlandischargeContainer::find($id);
        $seal_discharge = SealContainer::where("kontainer_id_discharge", $id)->get();
        // dd($container, $seal_discharge);
        
        return response()->json([
            'result' => $container,
            'seal_discharge' => $seal_discharge,
        ]);
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
        $pol = Pelabuhan::orderBy('id','DESC')->get();
        $pot = Pelabuhan::orderBy('id','DESC')->get();
        $pod = Pelabuhan::orderBy('id','DESC')->get();
        $pengirim = Pengirim::orderBy('id','DESC')->get();
        $penerima = Penerima::orderBy('id','DESC')->get();
        $kontainer = Container::orderBy('id','DESC')->get();
        $lokasis = Depo::orderBy('id','DESC')->get();
        $seals = Seal::orderBy('id','DESC')->get();

        $sizes = Container::orderBy('id','DESC')->get();
        $types = TypeContainer::orderBy('id','DESC')->get();
        $containers = PlanDischargeContainer::where('job_id', $id)->get();
        $containers_info = PlanDischargeContainer::where('job_id', $id)->whereNull('slug')->get();
        $pelabuhans = Pelabuhan::orderBy('id', 'DESC')->get();

        $sealsc = SealContainer::where('job_id_discharge', $id)->get();
        $vendors = SupirMobil::orderBy('id', 'DESC')->get();
        $vendors2 = VendorMobil::orderBy('id', 'DESC')->get();

        $kontainer_id = DetailBarangLoad::where("job_id_discharge", $id)->distinct()->get('kontainer_id_discharge');

        $containers_barang = [];
        $new_container = [];
        if ($kontainer_id != null) {
            for ($i=0; $i <count($kontainer_id) ; $i++) {
                $containers_barang[$i] = PlanDischargeContainer::where('id', $kontainer_id[$i]->kontainer_id_discharge)->get();
            }


            for($i = 0; $i < count($containers_barang); $i++) {
                $new_container[$i] = [
                    'id' => $containers_barang[$i][0]->id,
                    'job_id' => $containers_barang[$i][0]->job_id,
                    'size' => $containers_barang[$i][0]->size,
                    'type' => $containers_barang[$i][0]->type,
                    'nomor_kontainer' => $containers_barang[$i][0]->nomor_kontainer,
                    'penerima' => $containers_barang[$i][0]->penerima,
                    'tanggal_kembali' => $containers_barang[$i][0]->tanggal_kembali,
                    'slug' => $containers_barang[$i][0]->slug,

                ];

            }
        }

        $id_biaya = BiayaLainnya::where("job_id_discharge", $id)->distinct()->get('kontainer_id_discharge');

        // dd($id_biaya);
        $containers_biaya = [];
        $new_container_biaya = [];
        if ($id_biaya != null) {
            for ($i=0; $i <count($id_biaya) ; $i++) {
                $containers_biaya[$i] = PlanDischargeContainer::where('id', $id_biaya[$i]->kontainer_id_discharge)->get();
            }


            for($i = 0; $i < count($containers_biaya); $i++) {
                $new_container_biaya[$i] = [
                    'id' => $containers_biaya[$i][0]->id,
                    'job_id_discharge' => $containers_biaya[$i][0]->job_id,
                    'size' => $containers_biaya[$i][0]->size,
                    'type' => $containers_biaya[$i][0]->type,
                    'nomor_kontainer' => $containers_biaya[$i][0]->nomor_kontainer,
                    'total_biaya_lain' => $containers_biaya[$i][0]->total_biaya_lain,
                    'penerima' => $containers_biaya[$i][0]->penerima,
                    'tanggal_kembali' => $containers_biaya[$i][0]->tanggal_kembali,
                    'slug' => $containers_biaya[$i][0]->slug

                ];

            }
        }

        $new_container = collect($new_container)->whereNull('slug');
        $new_container_biaya = collect($new_container_biaya)->whereNull('slug');
        $select_barang = PlanDischargeContainer::where('job_id', $id)->whereNull('status_barang')->whereNotNull('tanggal_kembali')->whereNull('slug')->get();
        $select_batal_edit = PlanDischargeContainer::where('job_id', $id)->whereNotNull('tanggal_kembali')->whereNull('slug')->get();
        $select_biaya = PlanDischargeContainer::where('job_id', $id)->whereNull('total_biaya_lain')->whereNotNull('tanggal_kembali')->whereNull('slug')->get();


        return view('process.discharge.processdischarge-create',[
            'title' => 'Discharge-Process',
            'active' => 'Discharge',
            'shippingcompany' => $shipping_company,
            'pols' => $pol,
            'pot' => $pot,
            'pod' => $pod,
            'containers_barang' => $new_container,
            'new_container_biaya' => $new_container_biaya,
            'pengirim' => $pengirim,
            'penerimas' => $penerima,
            'kontainers' => $kontainer,
            'lokasis' => $lokasis,
            'activity' => $activity,
            'seals' => $seals,
            'sealsc' => $sealsc,
            'sizes' => $sizes,
            'types' => $types,
            'pelabuhans' => $pelabuhans,
            'vendors' => $vendors,
            'vendors2' => $vendors2,
            'plandischarge' => PlanDischarge::find($id),
            'containers' => $containers,
            'select_barang' => $select_barang,
            'select_batal_edit' => $select_batal_edit,
            'select_biaya' => $select_biaya,
            'containers_info' => $containers_info,
            'biayas' => BiayaLainnya::where('job_id_discharge', $id)->get(),
            'details' => DetailBarangLoad::where('job_id_discharge', $id)->get(),


        ]);
    }

    public function detail(Request $request, $id)
    {
        // dd($request);
        $container = PlanDischargeContainer::findOrFail($id);
        $planload = PlanDischarge::findOrFail($request->job_id);


        $status = "Process";

        $load = [
            'status' => $status,
        ];

        $data = [
            'size' => $request->size,
            'type' => $request->type,
            'nomor_kontainer' => $request->nomor_kontainer,
            'cargo' => $request->cargo,
            'tanggal_kembali' => $request->tanggal_kembali,
            'lokasi_kembali' => $request->lokasi_kembali,
            'penerima' => $request->penerima,
            'alamat_pengantaran' => $request->alamat_pengantaran,
            'driver' => $request->driver,
            'nomor_polisi' => $request->nomor_polisi,
            'remark' => $request->remark,
            'biaya_cleaning' => $request->biaya_cleaning,
            'biaya_retribusi' => $request->biaya_retribusi,
            'biaya_thc' => $request->biaya_thc,
            'biaya_trucking' => $request->biaya_trucking,
            'ongkos_supir' => $request->ongkos_supir,
            'biaya_seal' => $request->biaya_seal,
            'jaminan_kontainer' => $request->jaminan_kontainer,
            'return_to' => $request->return_to,
            'status' => $status,
        ];
        $planload->update($load);
        $container->update($data);

        SealContainer::where('kontainer_id_discharge', $id)->delete();

        for ($i=0; $i <count($request->seal) ; $i++) {

            $seal = [
                "job_id_discharge" => $request->job_id,
                "kontainer_id_discharge" => $id,
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


        return response()->json(['success' => true]);
    }

    public function detail_edit(Request $request, $id)
    {
        // dd($request);
        $container = PlanDischargeContainer::findOrFail($id);
        $planload = PlanDischarge::findOrFail($request->job_id);


        $status = "Process";

        $load = [
            'status' => $status,
        ];

        $data = [
            'size' => $request->size,
            'type' => $request->type,
            'nomor_kontainer' => $request->nomor_kontainer,
            'cargo' => $request->cargo,
            'tanggal_kembali' => $request->tanggal_kembali,
            'lokasi_kembali' => $request->lokasi_kembali,
            'penerima' => $request->penerima,
            'alamat_pengantaran' => $request->alamat_pengantaran,
            'driver' => $request->driver,
            'nomor_polisi' => $request->nomor_polisi,
            'remark' => $request->remark,
            'biaya_cleaning' => $request->biaya_cleaning,
            'biaya_retribusi' => $request->biaya_retribusi,
            'biaya_thc' => $request->biaya_thc,
            'biaya_trucking' => $request->biaya_trucking,
            'jaminan_kontainer' => $request->jaminan_kontainer,
            'ongkos_supir' => $request->ongkos_supir,
            'biaya_seal' => $request->biaya_seal,
            'return_to' => $request->return_to,
            'status' => $status,
        ];
        $planload->update($load);
        $container->update($data);

        SealContainer::where('kontainer_id_discharge', $id)->delete();

        for ($i=0; $i <count($request->seal) ; $i++) {

            $seal = [
                "job_id_discharge" => $request->job_id,
                "kontainer_id_discharge" => $id,
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

        return response()->json(['success' => true]);
    }
    public function detail_tambah(Request $request)
    {
        // dd($request);
        $planload = PlanDischarge::findOrFail($request->job_id);


        $status = "Process";

        $load = [
            'status' => $status,
        ];

        $data = [
            'job_id' => $request->job_id,
            'size' => $request->size,
            'type' => $request->type,
            'nomor_kontainer' => $request->nomor_kontainer,
            'cargo' => $request->cargo,
            'tanggal_kembali' => $request->tanggal_kembali,
            'lokasi_kembali' => $request->lokasi_kembali,
            'penerima' => $request->penerima,
            'alamat_pengantaran' => $request->alamat_pengantaran,
            'driver' => $request->driver,
            'nomor_polisi' => $request->nomor_polisi,
            'remark' => $request->remark,
            'biaya_cleaning' => $request->biaya_cleaning,
            'biaya_retribusi' => $request->biaya_retribusi,
            'biaya_thc' => $request->biaya_thc,
            'biaya_trucking' => $request->biaya_trucking,
            'ongkos_supir' => $request->ongkos_supir,
            'biaya_seal' => $request->biaya_seal,
            'return_to' => $request->return_to,
            'status' => $status,
        ];
        $planload->update($load);

        $container = PlanDischargeContainer::create($data);


        for ($i=0; $i <count($request->seal) ; $i++) {

            $seal = [
                "job_id_discharge" => $request->job_id,
                "kontainer_id_discharge" => $container->id,
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

        return response()->json(['success' => true]);
    }
    public function detail_destroy(Request $request, $id)
    {
        // dd($request, $id);
        $seals = SealContainer::where('kontainer_id_discharge', $request->id)->get('seal_kontainer');

        for ($i = 0; $i < count($seals) ; $i++) {
            $input = [
                "status" => 'input',
            ];
            Seal::where('kode_seal', $seals[$i]->seal_kontainer)->update($input);
        }

        SealContainer::where('kontainer_id_discharge', $request->id)->delete();

        $container = PlanDischargeContainer::find($request->id);
        $container->delete();


        return response()->json([
            'success'   => true
        ]);

    }

    public function detailbarang(Request $request)
    {
        $container = PlanDischargeContainer::findOrFail($request->kontainer_id);

        $update_container = [
            'status_barang' => "done",
        ];

        $container->update($update_container);

        for($i = 0; $i < count($request->detail_barang); $i++) {
            $data = [
                'job_id_discharge' => $request->job_id,
                'kontainer_id_discharge' => $request->kontainer_id,
                'detail_barang' => $request->detail_barang[$i],
            ];
            DetailBarangLoad::create($data);
        }

        return response()->json(['success' => true]);
    }

    public function detailbarang_update(Request $request, $id)
    {
        DetailBarangLoad::where('kontainer_id_discharge', $id)->delete();

        for($i = 0; $i < count($request->detail_barang); $i++) {
            $data = [
                'job_id_discharge' => $request->job_id,
                'kontainer_id_discharge' => $id,
                'detail_barang' => $request->detail_barang[$i],
            ];
            DetailBarangLoad::create($data);
        }
        // dd($data);

        return response()->json(['success' => true]);
    }
    public function destroy_detailbarang(Request $request)
    {
        DetailBarangLoad::where('kontainer_id_discharge', $request->id)->delete();
        return response()->json([
            'success'   => true
        ]);

    }

    public function cetak_detail(Request $request){

        // dd($request);

        $old_slug = $request->old_slug;
        $old_id = PlanDischarge::where('slug', $old_slug)->value('id');
        $loads = PlanDischarge::where('id', $old_id)->get();

        $kontainer_id = DetailBarangLoad::where("job_id_discharge", $old_id)->distinct()->get('kontainer_id_discharge');



        for ($i=0; $i <count($kontainer_id) ; $i++) {
            $containers[$i] = PlanDischargeContainer::where('id', $kontainer_id[$i]->kontainer_id_discharge)->get();
        }
        $new_container = [];


        for($i = 0; $i < count($containers); $i++) {
            $new_container[$i] = [
                'id' => $containers[$i][0]->id,
                'job_id' => $containers[$i][0]->job_id,
                'size' => $containers[$i][0]->size,
                'type' => $containers[$i][0]->type,
                'nomor_kontainer' => $containers[$i][0]->nomor_kontainer,
                'penerima' => $containers[$i][0]->penerima,
                'tanggal_kembali' => $containers[$i][0]->tanggal_kembali,

            ];

        }

        $details = DetailBarangLoad::where("job_id_discharge", $old_id)->get();
        $save = 'storage/detail-load.pdf';

        $pdf1 = Pdf::loadview('pdf.detail.detail_barang_discharge',[
            "loads" => $loads,
            "report" => "DISCHARGE",
            "details" => $details,
            "containers" => $new_container,
        ]);
        // $pdf1->setPaper('A4', 'landscape');
        $pdf1->save($save);
        return response()->download($save);


    }

    public function biayalain(Request $request)
    {
        $container = PlanDischargeContainer::findOrFail($request->kontainer_id);

        $update_container = [
            'total_biaya_lain' => $request->harga_biaya,
        ];

        $container->update($update_container);

        for($i = 0; $i < count($request->keterangan_biaya); $i++) {
            $data = [
                'job_id_discharge' => $request->job_id,
                'harga_biaya' => 0,
                'kontainer_id_discharge' => $request->kontainer_id,
                'keterangan' => $request->keterangan_biaya[$i],
            ];
            BiayaLainnya::create($data);
        }

        return response()->json(['success' => true]);
    }

    public function biayalain_edit($id)
    {

        $biaya = BiayaLainnya::where('kontainer_id_discharge',$id)->get();

        $total_biaya = PlanDischargeContainer::where('id', $id)->value('total_biaya_lain');
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

        PlanDischargeContainer::where('id', $id)->update($container);

        BiayaLainnya::where('kontainer_id_discharge', $id)->delete();

        for($i = 0; $i < count($request->keterangan); $i++) {
            $data = [
                'job_id_discharge' => $request->job_id,
                'kontainer_id_discharge' => $id,
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



        $container = PlanDischargeContainer::find($request->id);

        $data = [
            "status" => "Process",
            "total_biaya_lain" => null,
        ];

        $container->update($data);

        BiayaLainnya::where('kontainer_id_discharge', $request->id)->delete();


        return response()->json([
            'success'   => true
        ]);

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
