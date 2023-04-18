<?php

namespace App\Http\Controllers;

use App\Models\PlanLoad;
use Illuminate\Http\Request;
use App\Http\Requests\StorePlanLoadRequest;
use App\Http\Requests\UpdatePlanLoadRequest;

class PlanLoadController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('plan.planload',[
        'title' => 'Plan Load'

    ]);

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        // dd($request);
        return view('plan.planload-create',[
        'title' => 'Buat Job Order Plan Load'
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
}
