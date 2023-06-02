<?php

namespace App\Http\Controllers;

use App\Models\OngkoSupir;
use App\Models\SupirMobil;
use App\Models\VendorMobil;
use App\Models\RekeningBank;
use App\Models\ContainerPlanload;
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
    public function index_supir()
    {
        //
        $vendors = VendorMobil::all();
        $supirs = SupirMobil::orderBy('id', 'DESC')->get();
        return view('pages.vendor-supir',[
            'title' => 'Data Vendor Mobil Truck',
            'active' => 'Vendor',
            'supirs' => $supirs,
            'vendors' => $vendors,

        ]);
    }

    public function report_load()
    {
        $containers = ContainerPlanload::orderBy('id', 'DESC')->get();

        return view('pages.vendor.report-load', [

            'title' => 'Report Mobil Truck Load',
            'active' => 'truck',
            "containers" => $containers,

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
    public function store_supir(Request $request)
    {
        //
        $data = [

            'vendor_id' => $request->nama_vendor,
            'nama_supir' => $request->nama_supir,
            'nomor_polisi' => $request->nomor_polisi,

        ];

        SupirMobil::create($data);

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
    public function edit_supir($id)
    {
        //
        $SupirMobil = SupirMobil::find($id);

        return response()->json([
            'result' => $SupirMobil,
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
    public function update_supir(Request $request, $id)
    {
        //

        $supirs = SupirMobil::findOrFail($id);

        $data = [
            'vendor_id' => $request->nama_vendor,
            'nama_supir' => $request->nama_supir,
            'nomor_polisi' => $request->nomor_polisi,
        ];

        $supirs->update($data);
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

    public function destroy_supir($id)
    {
        //u
        $danas = SupirMobil::find($id);
        $danas->delete();
        return response()->json([
            'success'   => true
        ]);
    }
}
