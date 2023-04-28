<?php

namespace App\Http\Controllers;

use App\Models\PlanLoad;
use Illuminate\Http\Request;
use App\Models\Stuffing;
use App\Models\ShippingCompany;
use App\Models\Pelabuhan;
use App\Models\Pengirim;
use App\Models\Penerima;
use App\Models\Container;
use App\Http\Requests\StorePlanLoadRequest;
use App\Http\Requests\UpdatePlanLoadRequest;

class PlanLoadController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('plan.planload', [
            'title' => 'Plan Load'

        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        $activity = Stuffing::all();
        $shipping_company = ShippingCompany::all();
        $pol = Pelabuhan::all();
        $pot = Pelabuhan::all();
        $pod = Pelabuhan::all();
        $pengirim = Pengirim::all();
        $penerima = Penerima::all();
        $kontainer = Container::all();
        // dd($activity);
        return view('plan.planload-create', [
            'title' => 'Buat Job Order Plan Load',
            'activity' => $activity,
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
    public function store(StorePlanLoadRequest $request)
    {
        //
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
    public function edit(PlanLoad $planLoad)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePlanLoadRequest $request, PlanLoad $planLoad)
    {
        //
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
        $kontainer = Container::all();
        return response()->json($kontainer);
    }

    public function getSizeTypeContainer(Request $request) 
    {
        $id_container = (int)$request->post('id_container');
        $sizetype = Container::select('size_container', 'type_container')->where('id', $id_container)->get();
        return response()->json($sizetype);
    }
}
