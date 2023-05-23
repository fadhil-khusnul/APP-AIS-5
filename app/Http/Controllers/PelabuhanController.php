<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pelabuhan;


class PelabuhanController extends Controller
{
    //
    public function store(Request $request)
    {
        //
        //  dd($request);
         $validatedData = $request->validate([

            'area_code' => 'required',
            'nama_pelabuhan' => 'required'

        ]);
        Pelabuhan::create($validatedData);
        return response()->json(['success' => true]);
    }

    public function edit($id)
    {
        //
        $Pelabuhan = Pelabuhan::find($id);

        return response()->json([
            'result' => $Pelabuhan,
        ]);
    }

    public function update(Request $request, $id)
    {
        //
        $request->validate([

            'area_code' => 'required',
            'nama_pelabuhan' => 'required',

        ]);

        $biaya = Pelabuhan::findOrFail($id);

        $data = [
            "area_code" =>$request->area_code,
            "nama_pelabuhan" =>$request->nama_pelabuhan,
        ];
        $biaya->update($data);
        return response()->json(['success' => true]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        //
        $Biaya = Pelabuhan::find($id);
        $Biaya->delete();
        return response()->json([
            'success'   => true
        ]);
    }
}
