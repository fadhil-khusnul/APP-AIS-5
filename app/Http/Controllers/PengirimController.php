<?php

namespace App\Http\Controllers;

use App\Models\Pengirim;
use App\Http\Requests\StorePengirimRequest;
use App\Http\Requests\UpdatePengirimRequest;
use Illuminate\Http\Request;

class PengirimController extends Controller
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

            'nama_costumer' => 'required',
            'alamat' => 'required',
            'email' => 'required',
            'no_telp' => 'required',
            'rekening' => 'required',

        ]);
        Pengirim::create($validatedData);
        return redirect('/data');
    }

    /**
     * Display the specified resource.
     */
    public function show(Pengirim $pengirim)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        //
        $pengirim = Pengirim::find($id);

        return response()->json([
            'result' => $pengirim,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        //

        $request->validate([

            'nama_costumer' => 'required',
            'alamat' => 'required',
            'email' => 'required',
            'no_telp' => 'required',
            'rekening' => 'required',

        ]);

        $pengirim = Pengirim::findOrFail($id);

        $data = [
            "nama_costumer" =>$request->nama_costumer,
            "alamat" =>$request->alamat,
            "email" =>$request->email,
            "no_telp" =>$request->no_telp,
            "rekening" =>$request->rekening,
        ];
        $pengirim->update($data);
        return response()->json(['success' => true]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        //

        $Pengirim = Pengirim::find($id);
        $Pengirim->delete();
        return response()->json([
            'success'   => true
        ]);
    }
}
