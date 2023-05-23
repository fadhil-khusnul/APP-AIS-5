<?php

namespace App\Http\Controllers;

use App\Models\Stuffing;
use Illuminate\Http\Request;

class StuffingController extends Controller
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
        $validatedData = $request->validate([

            'kegiatan_stuffing' => 'required',

        ]);
        Stuffing::create($validatedData);
        return response()->json(['success' => true]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Stuffing $stuffing)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        //

        $Stuffing = Stuffing::find($id);

        return response()->json([
            'result' => $Stuffing,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        //
        $request->validate([

            'kegiatan_stuffing' => 'required',

        ]);

        $stuffing = Stuffing::findOrFail($id);

        $data = [
            "kegiatan_stuffing" =>$request->kegiatan_stuffing,
        ];
        $stuffing->update($data);
        return response()->json(['success' => true]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        //

        $stuffing = Stuffing::find($id);
        $stuffing->delete();
        return response()->json([
            'success'   => true
        ]);
    }
}
