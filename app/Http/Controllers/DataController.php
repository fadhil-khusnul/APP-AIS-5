<?php

namespace App\Http\Controllers;

use App\Models\PPN;
use App\Models\Depo;
use App\Models\Biaya;
use App\Models\Penerima;
use App\Models\Pengirim;
use App\Models\Stuffing;
use App\Models\Trucking;
use App\Models\Container;
use App\Models\Pelabuhan;
use App\Models\Stripping;
use App\Models\VendorMobil;
use App\Models\RekeningBank;
use Illuminate\Http\Request;
use App\Models\TypeContainer;
use App\Models\ShippingCompany;


class DataController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $companies = ShippingCompany::orderBy('id', 'DESC')->get();
        $pelayarans = ShippingCompany::orderBy('id', 'DESC')->get();
        $depos = Depo::orderBy('id', 'DESC')->get();
        $pelabuhans = Pelabuhan::orderBy('id', 'DESC')->get();
        $pengirims = Pengirim::orderBy('id', 'DESC')->get();
        $penerimas = Penerima::orderBy('id', 'DESC')->get();
        $biayas = Biaya::orderBy('id', 'DESC')->get();
        $types = TypeContainer::orderBy('id', 'DESC')->get();
        $containers = Container::orderBy('id', 'DESC')->get();
        $stuffings = Stuffing::orderBy('id', 'DESC')->get();
        $strippings = Stripping::orderBy('id', 'DESC')->get();
        $vendors = VendorMobil::orderBy('id', 'DESC')->get();

        $ppn = PPN::select('ppn', 'id')->first();


        $danas = RekeningBank::orderBy('id', 'DESC')->get();

        return view('pages.data',[
            'title' => 'Data',
            'active' => 'Data',
            'companies' => $companies,
            'ppn' => $ppn,
            'pelayarans' => $pelayarans,
            'depos' => $depos,
            'pelabuhans' => $pelabuhans,
            'pengirims' => $pengirims,
            'penerimas' => $penerimas,
            'biayas' => $biayas,
            'types' => $types,
            'containers' => $containers,
            'stuffings' => $stuffings,
            'strippings' => $strippings,
            'vendors' => $vendors,
            'danas' => $danas,

        ]);
    }



    /**
     * Show the form for creating a new resource.
     */
    public function ppn_edit(Request $request, $id)
    {
        $ppn = PPN::find($id);

        return response()->json([
            'result' => $ppn,
        ]);

    }
    public function ppn_update(Request $request)
    {
        // dd($request);
        $ppn = PPN::find($request->id);


        $data = [
            "ppn" => $request->ppn,
        ];

        $ppn->update($data);

        return response()->json([
            'success' => true,
        ]);

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
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
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
