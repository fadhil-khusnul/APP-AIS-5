<?php

namespace App\Http\Controllers;

use App\Models\PlanLoad;
use Illuminate\Http\Request;
use App\Models\Stuffing;
use App\Models\Stripping;
use App\Models\ShippingCompany;
use App\Models\Pelabuhan;
use App\Models\Pengirim;
use App\Models\Penerima;
use App\Models\OrderJobPlanload;
use App\Models\Container;
use App\Models\ContainerPlanload;
use App\Models\TypeContainer;
use App\Http\Requests\StorePlanLoadRequest;
use App\Http\Requests\UpdatePlanLoadRequest;
use Illuminate\Support\Str;


class PlanLoadController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $planloads = OrderJobPlanload::orderBy('id', 'DESC')->where('status', 'Plan-Load')->get();
        $containers = ContainerPlanload::all();
        $select_company =  OrderJobPlanload::all()->unique('select_company');
        $vessel =  OrderJobPlanload::all()->unique('vessel');
        $containers_group = ContainerPlanload::select('job_id', 'size', 'type', 'cargo', 'jumlah_kontainer' )->groupBy('job_id', 'size', 'type', 'cargo', 'jumlah_kontainer')->get();

        return view('plan.load.planload', [
            'title' => 'Load-Plan',
            'active' => 'Load',
            'planloads' => $planloads,
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
        $activity = Stripping::where('jenis_kegiatan', 'Stuffing')->get();
        $shipping_company = ShippingCompany::all();
        $pol = Pelabuhan::all();
        $pot = Pelabuhan::all();
        $pod = Pelabuhan::all();
        $pengirim = Pengirim::all();
        $penerima = Penerima::all();
        $kontainer = Container::all();
        // dd($activity);
        return view('plan.load.planload-create', [
            'title' => 'Buat Load-Plan',
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
    public function create_job_planload(Request $request)
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
            // 'pod' => $request->pod,
            'pengirim' => $request->pengirim,
            'penerima' => $request->penerima,
            'tanggal' => $request->tanggal,
            'slug' => $slug,
            'status' => "Plan-Load",
        ];

        OrderJobPlanload::create($orderJob);

        $id = OrderJobPlanload::where('slug', $slug)->value('id');

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
                ContainerPlanload::create($container);
            }
        }

        return response()->json(['success' => true]);
    }

    /**
     * Display the specified resource.
     */
    public function show(PlanLoad $planLoad)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
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
        $size = Container::all();
        $type = TypeContainer::all();
        // dd($activity);
        return view('plan.load.planload-edit', [
            'title' => 'Edit Load-Plan',
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
            'planload' => OrderJobPlanload::find($id),
            'containers' => ContainerPlanload::select('type', 'jumlah_kontainer', 'size', 'cargo')->where('job_id', $id)->groupBy('jumlah_kontainer', 'type', 'size', 'cargo')->get()
        ]);

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        // dd($request);

        $old_slug = $request->old_slug;

        $old_id = OrderJobPlanload::where('slug', $old_slug)->value('id');

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

        $OrderJobPlanload = OrderJobPlanload::findOrFail($old_id);

        $orderJob = [
            'activity' => $request->activity,
            'select_company' => $request->select_company,
            'vessel' => $request->vessel,
            'vessel_code' => $request->vessel_code,
            'pol' => $request->pol,
            'pot' => $request->pot,
            // 'pod' => $request->pod,
            'pengirim' => $request->pengirim,
            'penerima' => $request->penerima,
            'slug' => $slug,
        ];

        $OrderJobPlanload->update($orderJob);

        ContainerPlanload::where('job_id', $old_id)->delete();
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
                ContainerPlanload::create($container);
            }
        }

        return response()->json(['success' => true]);

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(PlanLoad $planLoad)
    {
        //
    }

    public function getJenisKontainer()
    {
        $size = Container::all();
        $type = TypeContainer::all();
        $kontainer = [
            'size' => $size,
            'type' => $type
        ];
        return response()->json($kontainer);
    }

    public function getSizeTypeContainer(Request $request)
    {
        $id_container = (int)$request->post('id_container');
        $sizetype = Container::select('size_container', 'type_container')->where('id', $id_container)->get();
        return response()->json($sizetype);
    }
}
