<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use PDF;
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
use App\Models\PlanDischarge;
use App\Models\PlanDischargeContainer;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;


use Webklex\PDFMerger\Facades\PDFMergerFacade as PDFMerger;


class PdfController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function create_si(Request $request)
    {
        // dd($request);

        // $all_id = ContainerPlanload::where('job_id', $old_id)->get('id');

        // $update_si = [];

        // for($i = 0; $i < count($all_id); $i++) {
        //     $update_si[$i] =   $all_id[$i]->id;
        // }
        $unique_size = array_values(array_unique($request->size));
        $jumlah = [];
        $quantity = [];
        for($i = 0; $i < count($unique_size); $i++) {
            $jumlah[$i] = 0;
            for($j = 0; $j < count($request->size); $j++) {
                if($unique_size[$i] == $request->size[$j]) {
                    $jumlah[$i] += 1;
                }
            }
            $quantity[$i] = $jumlah[$i].' X '.$unique_size[$i];
        }

        // for($i = 0; $i)
        // dd($quantity);
        // $sup_unique_size =
        // $urutan = (int)$request->urutan;
        $old_slug = $request->old_slug;
        $old_id = OrderJobPlanload::where('slug', $old_slug)->value('id');
        $loads = OrderJobPlanload::where('id', $old_id)->get();

        // dd($containers);

        for ($i=0; $i < count($request->chek_container) ; $i++) {
            $container = [
                'status' => "Realisasi",
            ];

            OrderJobPlanload::where('id', $old_id)->update($container);
            ContainerPlanload::where('id',$request->chek_container[$i])->update($container);
        }

        $checked = [];
        $containers = [];
        $get_container = [];


        for($i = 0; $i < count($request->chek_container); $i++) {
            $checked[$i] =   $request->chek_container[$i];
        }
        // dd($checked);

         for($j = 0; $j < count($checked); $j++) {
            $containers[$j] = [];
            $get_container[$j] = ContainerPlanload::where('id', $checked[$j])->get();
            // dd($get_container);
            for ($k=0; $k < count($get_container[$j]) ; $k++) {
                $containers[$j][$k] = ContainerPlanload::where('id',$get_container[$j][$k]->id)->get();
            }
        }



        $new_container = [];

        for($i = 0; $i < count($containers); $i++) {
            $new_container[$i] = [
                'id' => $containers[$i][0][0]->id,
                'job_id' => $containers[$i][0][0]->job_id,
                'size' => $containers[$i][0][0]->size,
                'type' => $containers[$i][0][0]->type,
                'jumlah_kontainer' => $containers[$i][0][0]->jumlah_kontainer,
                'nomor_kontainer' => $containers[$i][0][0]->nomor_kontainer,
                'seal' => $containers[$i][0][0]->seal,
                'lokasi_depo' => $containers[$i][0][0]->lokasi_depo,
                'cargo' => $containers[$i][0][0]->cargo,

            ];


        }



        // for ($i=0; $i <count($groupby) ; $i++) {
        //     $new_groupby [$i] =[

        //     ];
        // }


        // $new_container = [];
        // for($i = 0; $i < count($request->chek_container); $i++) {
        //     $new_container[$i] = [
        //         'size' => $request->size[$i],
        //         'type' => $request->type[$i],
        //         'nomor_kontainer' => $request->nomor_kontainer[$i],
        //         'seal' => $request->seal[$i],
        //         'cargo' => $request->cargo[$i],

        //     ];

        $dt = Carbon::now()->isoFormat('YYYY-MMMM-DDDD-dddd-HH-mm-ss');


        $path1 = 'storage/si-container/SI-'.$old_slug.'-'.$dt.'.pdf';
        // dd($path1);


        $pdf = Pdf::loadview('pdf.create_si',[
            "loads" => $loads,
            "containers" => $new_container,
            "vessel" => $old_slug,
            "shipper" => $request->shipper,
            "consigne" => $request->consigne,
            "quantity" => $quantity

        ]);

        $pdf->save($path1);

        return response()->download($path1);
    }

    public function invoice_load(Request $request)
    {
        // dd($request->slug);


        $old_slug = $request->slug;
        $old_id = OrderJobPlanload::where('slug', $old_slug)->value('id');
        $loads = OrderJobPlanload::where('id', $old_id)->get();









        $dt = Carbon::now()->isoFormat('YYYY-MMMM-DDDD-dddd-HH-mm-ss');


        $path1 = 'storage/load-invoice/Invoice-'.$old_slug.'-'.$dt.'.pdf';
        // dd($path1);


        $pdf = Pdf::loadview('pdf.invoice',[

            "loads" => $loads,

        ]);

        $pdf->save($path1);

        return response()->download($path1);







    }




    public function si_discharge(Request $request)
    {

        $old_slug = $request->old_slug;
        $old_id = PlanDischarge::where('slug', $old_slug)->value('id');
        $loads = PlanDischarge::where('id', $old_id)->get();


        for ($i=0; $i < count($request->chek_container) ; $i++) {
            $container = [
                'status' => "SI",
            ];

            PlanDischargecontainer::where('id',$request->chek_container[$i])->update($container);
        }

        $checked = [];
        $containers = [];
        $get_container = [];


        for($i = 0; $i < count($request->chek_container); $i++) {
            $checked[$i] =   $request->chek_container[$i];
        }




        for($j = 0; $j < count($checked); $j++) {
            $containers[$j] = [];
            $get_container[$j] = PlanDischargecontainer::where('id', $checked[$j])->get();
            // dd($get_container);
            for ($k=0; $k < count($get_container[$j]) ; $k++) {
                $containers[$j][$k] = PlanDischargecontainer::where('id',$get_container[$j][$k]->id)->get();
            }
        }

        $new_container = [];
        for($i = 0; $i < count($containers); $i++) {
            $new_container[$i] = [
                'id' => $containers[$i][0][0]->id,
                'job_id' => $containers[$i][0][0]->job_id,
                'size' => $containers[$i][0][0]->size,
                'type' => $containers[$i][0][0]->type,
                'jumlah_kontainer' => $containers[$i][0][0]->jumlah_kontainer,
                'nomor_kontainer' => $containers[$i][0][0]->nomor_kontainer,
                'seal' => $containers[$i][0][0]->seal,
                'lokasi_depo' => $containers[$i][0][0]->lokasi_depo,

            ];


        }
        $dt = Carbon::now()->isoFormat('YYYY-MMMM-DDDD-dddd-HH-mm-ss');


        $path1 = 'storage/si-container/SI-'.$old_slug.'-'.$dt.'.pdf';
        // dd($path1);


        $pdf = Pdf::loadview('pdf.create_si',[

            "loads" => $loads,
            "containers" => $new_container,
            "vessel" => $old_slug,

        ]);

        $pdf->save($path1);

        return response()->download($path1);







    }

    /**
     * Show the form for creating a new resource.
     */
}
