<?php

namespace App\Http\Controllers;

use App\Models\Penerima;
use Illuminate\Http\Request;

class PenerimaController extends Controller
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

            'nama_penerima' => 'required',
            'alamat_penerima' => 'required',
            'email_penerima' => 'required',
            'no_telp_penerima' => 'required',
            'rekening_penerima' => 'required',

        ]);
        Penerima::create($validatedData);
        return response()->json(['success' => true]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Penerima $penerima)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        //

        $penerima = Penerima::find($id);

        return response()->json([
            'result' => $penerima,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        //
        // dd($request);
        $request->validate([

            'nama_penerima' => 'required',
            'alamat_penerima' => 'required',
            'email_penerima' => 'required',
            'no_telp_penerima' => 'required',
            'rekening_penerima' => 'required',

        ]);

        $penerima = Penerima::findOrFail($id);

        $data = [
            "nama_penerima" =>$request->nama_penerima,
            "alamat_penerima" =>$request->alamat_penerima,
            "email_penerima" =>$request->email_penerima,
            "no_telp_penerima" =>$request->no_telp_penerima,
            "rekening_penerima" =>$request->rekening_penerima,
        ];
        $penerima->update($data);
        return response()->json(['success' => true]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        //

        $Penerima = Penerima::find($id);
        $Penerima->delete();
        return response()->json([
            'success'   => true
        ]);
    }
}
