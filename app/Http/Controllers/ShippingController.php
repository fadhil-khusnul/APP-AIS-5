<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ShippingCompany;
use App\Models\VendorMobil;


class ShippingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

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
        // dd($request);
        $validatedData = $request->validate([

            'nama_company' => 'required',

        ]);
        ShippingCompany::create($validatedData);
        return response()->json(['success' => true]);

    }

    public function store_vendor(Request $request)
    {
        // dd($request);
        $validatedData = $request->validate([

            'nama_vendor' => 'required',

        ]);
        VendorMobil::create($validatedData);
        return response()->json(['success' => true]);

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        // dd($id);
        $ShippingCompany = ShippingCompany::find($id);

        return response()->json([
            'result' => $ShippingCompany,
        ]);
    }
    public function edit_vendor($id)
    {
        // dd($id);
        $VendorMobil = VendorMobil::find($id);

        return response()->json([
            'result' => $VendorMobil,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([

            'nama_company' => 'required',

        ]);

        $companies = ShippingCompany::findOrFail($id);

        $data = [
            "nama_company" =>$request->nama_company,
        ];
        $companies->update($data);
        return response()->json(['success' => true]);
    }

    public function update_vendor(Request $request, $id)
    {
        $request->validate([

            'nama_vendor' => 'required',

        ]);

        $companies = VendorMobil::findOrFail($id);

        $data = [
            "nama_vendor" =>$request->nama_vendor,
        ];
        $companies->update($data);
        return response()->json(['success' => true]);
    }

    /**
     * Remove the specifi red resource from storage.
     */
    public function destroy($id)
    {
        $companies = ShippingCompany::find($id);
        $companies->delete();
        return response()->json([
            'success'   => true
        ]);

    }
    public function destroy_vendor($id)
    {
        $companies = VendorMobil::find($id);
        $companies->delete();
        return response()->json([
            'success'   => true
        ]);

    }
}
