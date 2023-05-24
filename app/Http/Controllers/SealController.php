<?php

namespace App\Http\Controllers;

use App\Models\Seal;
use Illuminate\Http\Request;

use App\Http\Requests\StoreSealRequest;
use App\Http\Requests\UpdateSealRequest;

class SealController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $seals = Seal::where('status', 'input')->orderBy('id', 'DESC')->get();
        return view('seal.seal',[
            'title' => 'Data Seal',
            'active' => 'Seal',
            'seals' => $seals,

        ]);
    }

    public function edit($id)
    {
           // dd($id);
           $Seal = Seal::find($id);

           return response()->json([
               'result' => $Seal,
           ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([

            'kode_seal' => 'required',

        ]);

        $seal = Seal::findOrFail($id);

        $data = [
            "kode_seal" =>$request->kode_seal,
        ];
        $seal->update($data);
        return response()->json(['success' => true]);
    }

    public function destroy($id)
    {
        //

        $sela = Seal::find($id);
        $sela->delete();
        return response()->json([
            'success'   => true
        ]);

    }

    public function index_damage()
    {
        $seal = Seal::where('status', 'input')->orderBy('id', 'DESC')->get();
        $seals = Seal::where('status', 'damage')->orderBy('id', 'DESC')->get();
        return view('seal.damage-seal',[
            'title' => 'Damage Seal',
            'active' => 'Seal',
            'seal' => $seal,
            'seals' => $seals,

        ]);
    }

    public function update_damage(Request $request) {
        $id = Seal::where('kode_seal', $request->seal)->value('id');

        $id_seal = Seal::findOrFail($id);
        $seal = [
            "keterangan_damage" => $request->keterangan_damage,
            "status" => "damage",

        ];

        $id_seal->update($seal);
        return response()->json(['success' => true]);

    }

    public function index_report()
    {
        $tersedia = Seal::where('status', 'input')->orderBy('id', 'DESC')->get();
        $rusak = Seal::where('status', 'damage')->orderBy('id', 'DESC')->get();
        $container = Seal::where('status', 'Container')->orderBy('id', 'DESC')->get();
        $seals = Seal::all();
        return view('seal.report-seal',[
            'title' => 'Report Seal',
            'active' => 'Seal',
            'tersedia' => $tersedia,
            'rusak' => $rusak,
            'container' => $container,
            'seals' => $seals,

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
       
        $seals = [];

        for ($i=0; $i <count($request->touch_seal) ; $i++) {
            # code...

            $seals= [
                'code' => $request->code[$i],
                'start_seal' => $request->start_seal[$i],
                'touch_seal' => $request->touch_seal[$i],
                'kode_seal' => $request->kode_seal[$i],
                'status' => 'input',
            ];

            Seal::create($seals);
        }


        return response()->json(['success' => true]);

    }

    /**
     * Display the specified resource.
     */
    public function show(Seal $seal)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */


    public function getSeal()
    {
        $seal = Seal::all();
        return response()->json($seal);
    }

    public function getCodeSeal(Request $request) {
        $code = $request->code;
        $seal = Seal::where('code', $code)->get();
        // $count_seal = count($seal);

        return response()->json($seal);
    }

    public function getKodeSeal(Request $request) {
        $code = $request->code;
        $jumlah_seal = Seal::where('code', $code)->get();

        return response()->json($jumlah_seal);
        // $total_seal = $request->total_seal;
    }
}
