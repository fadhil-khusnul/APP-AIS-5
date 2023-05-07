<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Barryvdh\DomPDF\PDF as DomPDFPDF;
use App\Models\PlanLoad;
use App\Models\AlihKapal;
use App\Models\BatalMuat;
use App\Models\Stuffing;
use App\Models\ShippingCompany;
use App\Models\Pelabuhan;
use App\Models\Pengirim;
use App\Models\Penerima;
use App\Models\Container;
use App\Models\Depo;
use App\Models\Seal;
use App\Models\BiayaLainnya;
use Illuminate\Support\Str;
use App\Models\ProcessLoad;
use App\Models\OrderJobPlanload;
use App\Models\ContainerPlanload;

class PdfController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function create_si(Request $request)
    {
        //

        $old_slug = $request->old_slug;
        $old_id = OrderJobPlanload::where('slug', $old_slug)->value('id');
        $all_id = ContainerPlanload::where('job_id', $old_id)->get('id');

        $update_si = [];

        for($i = 0; $i < count($all_id); $i++) {
            $update_si[$i] =   $all_id[$i]->id;
        }

        $urutan = (int)$request->urutan;

        for ($i=0; $i <$urutan ; $i++) {
            $container = [
                'status' => "SI",
            ];

            ContainerPlanload::where('id',$update_si[$i])->update($container);

        }



        $loads = [];
        $containers = [];


        $pdf = Pdf::loadview('pdf.create_si',[

            "containers" => $containers,
            "loads" => $loads,
            "vessel" => $vessel,


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
