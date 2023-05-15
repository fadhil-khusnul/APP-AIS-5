<?php

namespace App\Http\Controllers;

use App\Models\Stripping;
use Illuminate\Http\Request;

class StrippingController extends Controller
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

            'kegiatan' => 'required',
            'jenis_kegiatan' => 'required',

        ]);
        Stripping::create($validatedData);
        return redirect('/data');
    }

    /**
     * Display the specified resource.
     */
    public function show(Stripping $stripping)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        //
        $Stripping = Stripping::find($id);

        return response()->json([
            'result' => $Stripping,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        //


        $stripping = Stripping::findOrFail($id);

        $data = [
            "kegiatan" =>$request->kegiatan,
            "jenis_kegiatan" =>$request->jenis_kegiatan,
        ];
        $stripping->update($data);
        return response()->json(['success' => true]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $Stripping = Stripping::find($id);
        $Stripping->delete();
        return response()->json([
            'success'   => true
        ]);
    }
}
