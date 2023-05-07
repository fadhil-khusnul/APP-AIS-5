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
        $seals = Seal::orderBy('id', 'DESC')->get();
        return view('seal.seal',[
            'title' => 'Data Seal',
            'active' => 'Seal',
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
        // dd($request);

        // $validatedData = $request->validate([

        //     'bulan_seal' => 'required',
        //     'kode_seal' => 'required',
        //     'touch_seal' => 'required',

        // ]);



        $seals = [];

        for ($i=0; $i <count($request->touch_seal) ; $i++) {
            # code...

            $seals= [
                'code' => $request->code[$i],
                'start_seal' => $request->start_seal[$i],
                'touch_seal' => $request->touch_seal[$i],
                'kode_seal' => $request->kode_seal[$i],
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
    public function edit(Seal $seal)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateSealRequest $request, Seal $seal)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Seal $seal)
    {
        //
    }

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
