<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Spk;
use App\Models\SpkContainer;
use App\Models\ShippingCompany;


class SpkController extends Controller
{
    //

    public function index()
    {
        $pelayarans = ShippingCompany::all();
        $spks = Spk::where('status', 'input')->orderBy('id', 'DESC')->get();
        return view('spk.spk',[
            'title' => 'Data SPK',
            'active' => 'SPK',
            'spks' => $spks,
            'pelayarans' => $pelayarans,

        ]);
    }

    public function index_report()
    {
        $tersedia = Spk::where('status', 'input')->orderBy('id', 'DESC')->get();
        $container = Spk::where('status', 'Container')->orderBy('id', 'DESC')->get();
        $spks = Spk::all();
        $spksc = SpkContainer::all();
        $pelayarans = ShippingCompany::all();

        return view('spk.report-spk',[
            'title' => 'Report SPK',
            'active' => 'SPK',
            'tersedia' => $tersedia,
            'container' => $container,
            'spks' => $spks,
            'spksc' => $spksc,
            'pelayarans' => $pelayarans,
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

        $Spk = Spk::findOrFail($id);

        $data = [
            "kode_spk" =>$request->kode_spk,
            "harga_spk" =>$request->harga_spk,
            // "keterangan_spk" =>$request->keterangan_spk,
            "pelayaran_id" =>$request->select_company,
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
                'harga_spk' => $request->harga_spk[$i],
                'kode_spk' => $request->kode_spk[$i],
                // 'keterangan_spk/' => $request->keterangan_spk[$i],
                'pelayaran_id' => $request->select_company[$i],
                'status' => 'input',
            ];

            Spk::create($spks);
        }


        return response()->json(['success' => true]);

    }
    public function tambah_keterangan(Request $request, $id) {
        // dd($id, $request);
        $Spk = Spk::findOrFail($id);

        $data = [
            "keterangan_spk" =>$request->keterangan_spk,
        ];
        $Spk->update($data);
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
