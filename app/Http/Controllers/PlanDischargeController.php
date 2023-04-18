<?php

namespace App\Http\Controllers;

use App\Models\PlanDischarge;
use App\Http\Requests\StorePlanDischargeRequest;
use App\Http\Requests\UpdatePlanDischargeRequest;

class PlanDischargeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('plan.plandischarge', [
            'title' => 'Plan Discharge'

        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('plan.plandischarge-create',[
            'title' => 'Buat Job Order Plan Discharge'
            ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePlanDischargeRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(PlanDischarge $planDischarge)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(PlanDischarge $planDischarge)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePlanDischargeRequest $request, PlanDischarge $planDischarge)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(PlanDischarge $planDischarge)
    {
        //
    }
}
