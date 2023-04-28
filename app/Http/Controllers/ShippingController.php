<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ShippingCompany;


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
        return redirect('/data');

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

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $companies = ShippingCompany::find($id);
        $companies->delete();
        return response()->json([
            'success'   => true
        ]);

    }
}
