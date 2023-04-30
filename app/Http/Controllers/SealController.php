<?php

namespace App\Http\Controllers;

use App\Models\Seal;
use Illuminate\Http\Request;

use App\Http\Requests\StoreSealRequest;
use App\Http\Requests\UpdateSealRequest;

class SealController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $seals = Seal::all();
        return view('seal.seal',[
            'title' => 'Data Seal',
            'seals' => $seals,

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

        $validatedData = $request->validate([

            'tahun_seal' => 'required',
            'kode_seal' => 'required',
            'touch_seal' => 'required',

        ]);


        Seal::create($validatedData);
        return redirect('/seal');

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
