<?php

namespace App\Http\Controllers;

use App\Models\ProcessLoad;
use App\Http\Requests\StoreProcessLoadRequest;
use App\Http\Requests\UpdateProcessLoadRequest;

class ProcessLoadController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('process.processload',[
            'title' => 'Process Load'

        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('process.processload-create',[
            'title' => 'Buat Job Order Process Load'
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreProcessLoadRequest $request)
    {
        //
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
