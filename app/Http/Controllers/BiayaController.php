<?php

namespace App\Http\Controllers;

use App\Models\Biaya;
use Illuminate\Http\Request;

class BiayaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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
        //  dd($request);
         $validatedData = $request->validate([

            'pekerjaan_biaya' => 'required',
            'biaya_cost' => 'required'

        ]);
        Biaya::create($validatedData);
        return response()->json(['success' => true]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Biaya $biaya)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        //
        $Biaya = Biaya::find($id);

        return response()->json([
            'result' => $Biaya,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        //
        $request->validate([

            'pekerjaan_biaya' => 'required',
            'biaya_cost' => 'required',

        ]);

        $biaya = Biaya::findOrFail($id);

        $data = [
            "pekerjaan_biaya" =>$request->pekerjaan_biaya,
            "biaya_cost" =>$request->biaya_cost,
        ];
        $biaya->update($data);
        return response()->json(['success' => true]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        //
        $Biaya = Biaya::find($id);
        $Biaya->delete();
        return response()->json([
            'success'   => true
        ]);
    }
}
