<?php

namespace App\Http\Controllers;

use App\Models\ContainerPlanload;
use App\Models\OrderJobPlanload;
use Illuminate\Http\Request;

class AlihKapalController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $planloads = OrderJobPlanload::orderBy('id', 'DESC')->get();
        $containers = ContainerPlanload::all();

        return view('process.alihkapal',[
            'title' => 'Alih Kapal Load',
            'planloads' => $planloads,
            'containers' => $containers,

        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(ContainerPlanload $containerPlanload)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ContainerPlanload $containerPlanload)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, ContainerPlanload $containerPlanload)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ContainerPlanload $containerPlanload)
    {
        //
    }
}
