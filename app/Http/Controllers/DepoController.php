<?php

namespace App\Http\Controllers;

use App\Models\Depo;
use Illuminate\Http\Request;

class DepoController extends Controller
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


    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        // dd($request);
        $validatedData = $request->validate([

            'nama_depo' => 'required',

        ]);
        Depo::create($validatedData);
        return redirect('/data');
    }

    /**
     * Display the specified resource.
     */
    public function show(Depo $depo)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
           // dd($id);
           $Depo = Depo::find($id);

           return response()->json([
               'result' => $Depo,
           ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([

            'nama_depo' => 'required',

        ]);

        $depo = Depo::findOrFail($id);

        $data = [
            "nama_depo" =>$request->nama_depo,
        ];
        $depo->update($data);
        return response()->json(['success' => true]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        //

        $depo = Depo::find($id);
        $depo->delete();
        return response()->json([
            'success'   => true
        ]);

    }

}
