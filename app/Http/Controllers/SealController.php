<?php

namespace App\Http\Controllers;

use App\Models\Seal;
use App\Http\Requests\StoreSealRequest;
use App\Http\Requests\UpdateSealRequest;

class SealController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('seal.seal',[
            'title' => 'Data Seal'

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
    public function store(StoreSealRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Seal $seal)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Seal $seal)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateSealRequest $request, Seal $seal)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Seal $seal)
    {
        //
    }

    public function getSeal()
    {
        $seal = Seal::all();
        return response()->json($seal);
    }
}
