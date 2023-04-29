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
        //
        dd($request);

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

        $slug = $company.'-'.$vessel.'-'.$request->tanggal_planload.'-'.$random;

        $OrderJobPlanload = OrderJobPlanload::findOrFail($old_id);

        $orderJob = [
            'tanggal_planload' => $request->tanggal_planload,
            'activity' => $request->activity,
            'select_company' => $request->select_company,
            'vessel' => $request->vessel,
            'pol' => $request->pol,
            'pot' => $request->pot,
            'pod' => $request->pod,
            'pengirim' => $request->pengirim,
            'penerima' => $request->penerima,
            'nama_barang' => $request->nama_barang,
            'slug' => $slug,
        ];

        $OrderJobPlanload->update($orderJob);

        $job_id = [];

        $all_id = ContainerPlanload::where('job_id', $old_id)->get('id');

        $urutan = (int)$request->urutan;

        ContainerPlanload::where('job_id', $old_id)->delete();

        for ($i = 0; $i < $urutan; $i++) {
            $job_id[$i] = $old_id;
        }

        for ($k = 0; $k < $urutan; $k++) {
            $container = [
                'job_id' => $job_id[$k],
                'kontainer' => $request->kontainer[$k],
                'size' => $request->size[$k],
                'type' => $request->type[$k],
            ];
            ContainerPlanload::create($container);

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
}
