<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ShippingCompany;
use App\Models\Depo;
use App\Models\Pelabuhan;
use App\Models\Pengirim;
use App\Models\Penerima;
use App\Models\Biaya;
use App\Models\Trucking;
use App\Models\Container;
use App\Models\Stuffing;
use App\Models\Stripping;

class DataController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $companies = ShippingCompany::all();
        $depos = Depo::all();
        $pelabuhans = Pelabuhan::all();
        $pengirims = Pengirim::all();
        $penerimas = Penerima::all();
        $biayas = Biaya::all();
        $truckings = Trucking::all();
        $containers = Container::all();

        $stuffings = Stuffing::all();
        $strippings = Stripping::all();

        return view('pages.data',[
            'title' => 'Data',
            'companies' => $companies,
            'depos' => $depos,
            'pelabuhans' => $pelabuhans,
            'pengirims' => $pengirims,
            'penerimas' => $penerimas,
            'biayas' => $biayas,
            'truckings' => $truckings,
            'containers' => $containers,
            'stuffings' => $stuffings,
            'strippings' => $strippings,
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
