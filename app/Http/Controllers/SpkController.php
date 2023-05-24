<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Spk;


class SpkController extends Controller
{
    //

    public function index()
    {
        $spks = Spk::where('status', 'input')->orderBy('id', 'DESC')->get();
        return view('spk.spk',[
            'title' => 'Data SPK',
            'active' => 'SPK',
            'spks' => $spks,

        ]);
    }

    public function index_report()
    {
        $tersedia = Spk::where('status', 'input')->orderBy('id', 'DESC')->get();
        $container = Spk::where('status', 'Container')->orderBy('id', 'DESC')->get();
        $spks = Spk::all();
        return view('spk.report-spk',[
            'title' => 'Report SPK',
            'active' => 'SPK',
            'tersedia' => $tersedia,
            'container' => $container,
            'spks' => $spks,

        ]);
    }

    public function edit($id)
    {
           $spk = Spk::find($id);

           return response()->json([
               'result' => $spk,
           ]);
    }

    public function update(Request $request, $id)
    {
        $request->validate([

            'kode_spk' => 'required',

        ]);

        $Spk = Spk::findOrFail($id);

        $data = [
            "kode_spk" =>$request->kode_spk,
        ];
        $Spk->update($data);
        return response()->json(['success' => true]);
    }

    public function destroy($id)
    {
        //

        $spk = Spk::find($id);
        $spk->delete();
        return response()->json([
            'success'   => true
        ]);

    }

    public function store(Request $request)
    {

        $spks = [];

        for ($i=0; $i <count($request->touch_spk) ; $i++) {
            # code...

            $spks= [
                'code' => $request->code[$i],
                'start_spk' => $request->start_spk[$i],
                'touch_spk' => $request->touch_spk[$i],
                'kode_spk' => $request->kode_spk[$i],
                'status' => 'input',
            ];

            Spk::create($spks);
        }


        return response()->json(['success' => true]);

    }

    public function getSpk()
    {
        $spk = Spk::all();
        return response()->json($spk);
    }

    public function getCodeSpk(Request $request) {
        $code = $request->code;
        $spk = Spk::where('code', $code)->get();
        // $count_spk = count($spk);

        return response()->json($spk);
    }

    public function getKodeSpk(Request $request) {
        $code = $request->code;
        $jumlah_spk = Spk::where('code', $code)->get();

        return response()->json($jumlah_spk);
        // $total_seal = $request->total_seal;
    }


}
