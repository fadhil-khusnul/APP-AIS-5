<?php

namespace App\Http\Controllers;

use App\Models\Trucking;
use Illuminate\Http\Request;

class TruckingController extends Controller
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
        $validatedData = $request->validate([

            'nomor_polisi' => 'required',
            'nama_driver' => 'required'

        ]);
        Trucking::create($validatedData);
        return redirect('/data');
    }

    /**
     * Display the specified resource.
     */
    public function show(Trucking $trucking)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        //

        $Trucking = Trucking::find($id);

        return response()->json([
            'result' => $Trucking,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        //

        $request->validate([

            'nomor_polisi' => 'required',
            'nama_driver' => 'required',

        ]);

        $trucking = Trucking::findOrFail($id);

        $data = [
            "nomor_polisi" =>$request->nomor_polisi,
            "nama_driver" =>$request->nama_driver,
        ];
        $trucking->update($data);
        return response()->json(['success' => true]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        //

        $Trucking = Trucking::find($id);
        $Trucking->delete();
        return response()->json([
            'success'   => true
        ]);
    }
}
