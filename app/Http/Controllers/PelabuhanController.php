<?php

namespace App\Http\Controllers;

use App\Models\Pelabuhan;
use App\Http\Requests\StorePelabuhanRequest;
use App\Http\Requests\UpdatePelabuhanRequest;
use Illuminate\Http\Request;


class PelabuhanController extends Controller
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
        // dd($request);
        $validatedData = $request->validate([

            'nama_pelabuhan' => 'required',
            'area_code' => 'required'

        ]);
        Pelabuhan::create($validatedData);
        return redirect('/data');
    }

    /**
     * Display the specified resource.
     */
    public function show(Pelabuhan $pelabuhan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        //
        $Pelabuhan = Pelabuhan::find($id);

        return response()->json([
            'result' => $Pelabuhan,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        //

        $request->validate([

            'area_code' => 'required',
            'nama_pelabuhan' => 'required',

        ]);

        $pelabuhan = Pelabuhan::findOrFail($id);

        $data = [
            "area_code" =>$request->area_code,
            "nama_pelabuhan" =>$request->nama_pelabuhan,
        ];
        $pelabuhan->update($data);
        return response()->json(['success' => true]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        //
        $Pelabuhan = Pelabuhan::find($id);
        $Pelabuhan->delete();
        return response()->json([
            'success'   => true
        ]);
    }
}
