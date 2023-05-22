<?php

namespace App\Http\Controllers;

use App\Models\OngkoSupir;
use App\Models\RekeningBank;
use Illuminate\Http\Request;

class OngkoSupirController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $danas = OngkoSupir::orderBy('id', 'DESC')->get();
        return view('pages.ongkos-supir',[
            'title' => 'Data Ongkos Supir',
            'active' => 'ongkos',
            'danas' => $danas,

        ]);
    }
    public function index_rekening()
    {
        //
        $danas = RekeningBank::orderBy('id', 'DESC')->get();
        return view('pages.rekening-bank',[
            'title' => 'Data Rekening Bank',
            'active' => 'Rekening',
            'danas' => $danas,

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
        $data = [

            'pj' => $request->pj,
            'nominal' => str_replace('.','', $request->nominal),

        ];

        OngkoSupir::create($data);

        return response()->json([
            'success'   => true
        ]);
    }

    public function store_rekening(Request $request)
    {
        //
        $data = [

            'nama_bank' => $request->nama_bank,
            'no_rekening' => $request->no_rekening,
            'atas_nama' => $request->atas_nama,

        ];

        RekeningBank::create($data);

        return response()->json([
            'success'   => true
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(OngkoSupir $ongkoSupir)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        //
        $ongkoSupir = OngkoSupir::find($id);

        return response()->json([
            'result' => $ongkoSupir,
        ]);
    }

    public function edit_rekening($id)
    {
        //
        $RekeningBank = RekeningBank::find($id);

        return response()->json([
            'result' => $RekeningBank,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        //

        $danas = OngkoSupir::findOrFail($id);

        $data = [
            "pj" =>$request->pj,
            'nominal' => str_replace('.','', $request->nominal),
        ];

        $danas->update($data);
        return response()->json(['success' => true]);
    }

    public function update_rekening(Request $request, $id)
    {
        //

        $danas = RekeningBank::findOrFail($id);

        $data = [
            'nama_bank' => $request->nama_bank,
            'no_rekening' => $request->no_rekening,
            'atas_nama' => $request->atas_nama,
        ];

        $danas->update($data);
        return response()->json(['success' => true]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        //u
        $danas = OngkoSupir::find($id);
        $danas->delete();
        return response()->json([
            'success'   => true
        ]);
    }

    public function destroy_rekening($id)
    {
        //u
        $danas = RekeningBank::find($id);
        $danas->delete();
        return response()->json([
            'success'   => true
        ]);
    }
}
