<?php

namespace App\Http\Controllers;

use App\Models\OngkoSupir;
use App\Models\SupirMobil;
use App\Models\VendorMobil;
use App\Models\RekeningBank;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Str;

use App\Models\DetailBarangLoad;
use App\Models\OrderJobPlanload;
use App\Models\ContainerPlanload;
use App\Models\ReportVendorTruck;

class OngkoSupirController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $danas = OngkoSupir::orderBy('id', 'DESC')->get();
        return view('pages.ongkos-supir', [
            'title' => 'Data Ongkos Supir',
            'active' => 'ongkos',
            'danas' => $danas,

        ]);
    }
    public function index_supir()
    {
        //
        $vendors = VendorMobil::all();
        $supirs = SupirMobil::orderBy('id', 'DESC')->get();
        return view('pages.vendor.vendor-supir', [
            'title' => 'Data Vendor Mobil Truck',
            'active' => 'Vendor',
            'supirs' => $supirs,
            'vendors' => $vendors,

        ]);
    }

    public function index_load()
    {
        $planloads = OrderJobPlanload::orderBy('id', 'DESC')->where('status', 'Process-Load')->orWhere('status', 'Plan-Load')->orWhere('status', 'Realisasi')->get();
        $containers = ContainerPlanload::orderBy('id', 'DESC')->get();
        $sizez = ContainerPlanload::orderBy('id', 'DESC')->get('size');
        $containers_group = ContainerPlanload::select('job_id', 'size', 'type', 'cargo', 'jumlah_kontainer')->groupBy('job_id', 'size', 'type', 'cargo', 'jumlah_kontainer')->get();



        // dd($containers_group);
        $select_company =  OrderJobPlanload::all()->unique('select_company');
        $vessel =  OrderJobPlanload::all()->unique('vessel');


        return view('pages.vendor.load', [
            'title' => 'Report Vendor (Load)',
            'active' => 'Load',
            'planloads' => $planloads,
            'containers' => $containers,
            'containers_group' => $containers_group,
            'select_company' => $select_company,
            'vessel' => $vessel,

        ]);
    }

    public function report_load($slug)
    {
        $id = OrderJobPlanload::where("slug", $slug)->value('id');

        // dd($id);
        $containers = ContainerPlanload::orderBy('updated_at', 'DESC')->where("job_id", $id)->whereNotNull('biaya_trucking')->get();

        $planload = OrderJobPlanload::find($id);
        $vendors = VendorMobil::all();
        $vessels = OrderJobPlanload::select('vessel')->distinct()->get();





        $lunas_dibayar = ContainerPlanload::sum('dibayar');
        $truck = ContainerPlanload::sum('biaya_trucking');
        $supir = ContainerPlanload::sum('ongkos_supir');

        $belum_lunas = $truck - $supir - $lunas_dibayar;

        // $reports = ReportVendorTruck::select("id", "tanggal_bayar", "job_id", "kontainer_id", "path", "dibayarkan_ke", "cara_bayar", "keterangan_transfer", "dibayar", "created_at")->where("job_id", $id)->groupBy("created_at")->get();
        // $reports = ReportVendorTruck::distinct()->where('job_id', $id)->groupBy('created_at')->get(['dibayarkan_ke', 'cara_bayar']);

        $reports = ReportVendorTruck::orderBy('created_at')->get()->groupBy('created_at')->toArray();

        $newArray = [];
        foreach ($reports as $res) {
            $newArray[] = array_values($res);
        }

        // dd($newArray);

        $new_container_a = [];
        for ($i=0; $i <count($newArray) ; $i++) { 
            $new_container_a[$i] = [];
            for ($j=0; $j <count($newArray[$i]) ; $j++) { 
                $new_container_a[$i][$j] = new ReportVendorTruck([
                    'id' => $newArray[$i][$j]['id'],
                    'tanggal_bayar' => $newArray[$i][$j]['tanggal_bayar'],
                    'job_id' => $newArray[$i][$j]['job_id'],
                    'kontainer_id' => $newArray[$i][$j]['kontainer_id'],
                    'path' => $newArray[$i][$j]['path'],
                    'dibayarkan_ke' => $newArray[$i][$j]['dibayarkan_ke'],
                    'cara_bayar' => $newArray[$i][$j]['cara_bayar'],
                    'keterangan_transfer' => $newArray[$i][$j]['keterangan_transfer'],
                    'dibayar' => $newArray[$i][$j]['dibayar'],
                    'created_at' => $newArray[$i][$j]['created_at'],
                    'updated_at' => $newArray[$i][$j]['updated_at'],
                    
    
                ]);
            }
        }
        // dd($new_container_a);
        // $reports = ReportVendorTruck::where("job_id", $id)->distinct('created_at')->get();

        return view('pages.vendor.report-load', [

            'title' => 'Report Mobil Truck Load',
            'active' => 'truck',
            "containers" => $containers,
            "reports" => $new_container_a,
            "planload" => $planload,
            "vendors" => $vendors,
            "vessels" => $vessels,
            "lunas_dibayar" => $lunas_dibayar,
            "belum_lunas" => $belum_lunas,

        ]);
    }




    /**
     * Show the form for creating a new resource.
     */

    public function selisih(Request $request)
    {
        $tabel_kontainer = [];
        for ($i = 0; $i < count($request->id); $i++) {
            $tabel_kontainer[$i] = ContainerPlanload::find($request->id[$i]);
        }

        $selisih = [];
        for ($i = 0; $i < count($tabel_kontainer); $i++) {
            $selisih[$i] = $tabel_kontainer[$i]->biaya_trucking - $tabel_kontainer[$i]->ongkos_supir - (float)$tabel_kontainer[$i]->dibayar;
        }

        $total_selisih = 0;
        for ($i = 0; $i < count($selisih); $i++) {
            $total_selisih += $selisih[$i];
        }

        return response()->json($total_selisih);
    }

    public function dibayar(Request $request)
    {
        dd($request);
        $container = [];
        for ($i = 0; $i < count($request->id); $i++) {
            $container[$i] = ContainerPlanLoad::find($request->id[$i]);
        }

        $selisih = [];
        for ($i = 0; $i < count($container); $i++) {
            $selisih[$i] = $container[$i]->biaya_trucking - $container[$i]->ongkos_supir - (float)$container[$i]->dibayar;
        }

        $total_selisih = (float)$request->selisih;
        for ($i = 0; $i < count($selisih); $i++) {
            $total_selisih -= $selisih[$i];
            if ($total_selisih > 0) {
                $terbayar = (float)$container[$i]->dibayar + $selisih[$i];
                $dibayar = [
                    "dibayar" => $terbayar
                ];

                ContainerPlanload::where('id', $request->id[$i])->update($dibayar);
            } else {
                $terbayar = (float)$container[$i]->dibayar + $selisih[$i] + $total_selisih;
                $dibayar = [
                    "dibayar" => $terbayar
                ];

                ContainerPlanload::where('id', $request->id[$i])->update($dibayar);
                break;
            }
        }

        $job_id = OrderJobPlanload::where("slug", $request->old_slug)->value('id');
        $random = Str::random(15);
        $random_time = $random . time();

        $load = OrderJobPlanload::find($job_id);


        for ($i = 0; $i < count($request->id); $i++) {
            $reports = [
                'job_id' => $job_id,
                'path' => 'Report-Vendor-' . $request->old_slug . '-' . $random_time,
                'kontainer_id' => $request->id[$i],
                'dibayarkan_ke' => $request->dibayarkan_ke,
                'cara_bayar' => $request->cara_bayar,
                'keterangan_transfer' => $request->keterangan_transfer,
                'tanggal_bayar' => $request->tanggal_bayar,
                'dibayar' => $request->selisih,

            ];

            $report_container = ReportVendorTruck::create($reports);
        }


        $checked = [];
        $containers = [];
        $get_container = [];


        for ($i = 0; $i < count($request->id); $i++) {
            $checked[$i] =   $request->id[$i];
        }
        // dd($checked);

        for ($j = 0; $j < count($checked); $j++) {
            $containers[$j] = [];
            $get_container[$j] = ContainerPlanload::where('id', $checked[$j])->get();
            // dd($get_container);
            for ($k = 0; $k < count($get_container[$j]); $k++) {
                $containers[$j][$k] = ContainerPlanload::where('id', $get_container[$j][$k]->id)->get();
            }
        }



        $new_container = [];

        for ($i = 0; $i < count($containers); $i++) {
            $new_container[$i] = [
                'id' => $containers[$i][0][0]->id,
                'job_id' => $containers[$i][0][0]->job_id,
                'size' => $containers[$i][0][0]->size,
                'type' => $containers[$i][0][0]->type,
                'jumlah_kontainer' => $containers[$i][0][0]->jumlah_kontainer,
                'nomor_kontainer' => $containers[$i][0][0]->nomor_kontainer,
                'biaya_trucking' => $containers[$i][0][0]->biaya_trucking,
                'ongkos_supir' => $containers[$i][0][0]->ongkos_supir,
                'cargo' => $containers[$i][0][0]->cargo,

            ];
        }

        $save1 = 'storage/report/Report-Vendor-' . $request->old_slug . '-' . $random_time . '.pdf';

        $pdf1 = Pdf::loadview('pdf.vendors.report-vendor-load', [
            "load" => $load,
            "containers" => $new_container,
            'dibayarkan_ke' => $request->dibayarkan_ke,
            'cara_bayar' => $request->cara_bayar,
            'keterangan_transfer' => $request->keterangan_transfer,
            'dibayar' => $request->selisih,
            'selisih' => $request->total_bayar,
            'tanggal_bayar' => $request->tanggal_bayar,


        ]);

        $pdf1->save($save1);

        return response()->download($save1);


        // return response()->json([
        //     'success'   => true
        // ]);
    }

    public function preview_report(Request $request)

    {
        $id = ReportVendorTruck::where('path', $request->path)->value('id');
        $job_id = ReportVendorTruck::where('path', $request->path)->value('job_id');
        $pdf= ReportVendorTruck::findOrFail($id);

        return view('invoice.pdf.preview-report-vendorload', [
            'title' => 'Preview Report Vendor Truck LOAD',
            'active' => 'Realisasi',
            'pdf' => $pdf,
            'planload' => OrderJobPlanload::find($job_id),


        ]);
    }

    public function delete_report(Request $request, $id)
    {

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // dd($request);
        $data = [

            'pj' => $request->pj,
            'tanggal_deposit' => $request->tanggal_deposit,
            'nominal' => str_replace('.', '', $request->nominal),

        ];

        OngkoSupir::create($data);

        return response()->json([
            'success'   => true
        ]);
    }

    public function store_rekening(Request $request)
    {
        //
        $data = [

            'nama_bank' => $request->nama_bank,
            'no_rekening' => $request->no_rekening,
            'atas_nama' => $request->atas_nama,

        ];

        RekeningBank::create($data);

        return response()->json([
            'success'   => true
        ]);
    }
    public function store_supir(Request $request)
    {
        //
        $data = [

            'vendor_id' => $request->nama_vendor,
            'nama_supir' => $request->nama_supir,
            'nomor_polisi' => $request->nomor_polisi,

        ];

        SupirMobil::create($data);

        return response()->json([
            'success'   => true
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(OngkoSupir $ongkoSupir)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $ongkoSupir = OngkoSupir::find($id);

        return response()->json([
            'result' => $ongkoSupir,
        ]);
    }

    public function edit_rekening($id)
    {
        //
        $RekeningBank = RekeningBank::find($id);

        return response()->json([
            'result' => $RekeningBank,
        ]);
    }
    public function edit_supir($id)
    {
        //
        $SupirMobil = SupirMobil::find($id);

        return response()->json([
            'result' => $SupirMobil,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        // dd($request);


        $danas = OngkoSupir::findOrFail($id);

        $data = [
            "pj" => $request->pj,
            "tanggal_deposit" => $request->tanggal_deposit,
            'nominal' => str_replace('.', '', $request->nominal),
        ];

        $danas->update($data);
        return response()->json(['success' => true]);
    }



    public function update_rekening(Request $request, $id)
    {
        //

        $danas = RekeningBank::findOrFail($id);

        $data = [
            'nama_bank' => $request->nama_bank,
            'no_rekening' => $request->no_rekening,
            'atas_nama' => $request->atas_nama,
        ];

        $danas->update($data);
        return response()->json(['success' => true]);
    }
    public function update_supir(Request $request, $id)
    {
        //

        $supirs = SupirMobil::findOrFail($id);

        $data = [
            'vendor_id' => $request->nama_vendor,
            'nama_supir' => $request->nama_supir,
            'nomor_polisi' => $request->nomor_polisi,
        ];

        $supirs->update($data);
        return response()->json(['success' => true]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        //u
        $danas = OngkoSupir::find($id);
        $danas->delete();
        return response()->json([
            'success'   => true
        ]);
    }

    public function destroy_rekening($id)
    {
        //u
        $danas = RekeningBank::find($id);
        $danas->delete();
        return response()->json([
            'success'   => true
        ]);
    }

    public function destroy_supir($id)
    {
        //u
        $danas = SupirMobil::find($id);
        $danas->delete();
        return response()->json([
            'success'   => true
        ]);
    }

    public function print_dana(Request $request, $id)
    {




        // $old_slug = $request->old_slug;
        // $old_id = OrderJobPlanload::where('slug', $old_slug)->value('id');
        // $loads = OrderJobPlanload::where('id', $old_id)->get();

        // $kontainer_id = DetailBarangLoad::where("job_id", $old_id)->distinct()->get('kontainer_id');



        // for ($i=0; $i <count($kontainer_id) ; $i++) {
        //     $containers[$i] = ContainerPlanload::where('id', $kontainer_id[$i]->kontainer_id)->get();
        // }
        // $new_container = [];


        // for($i = 0; $i < count($containers); $i++) {
        //     $new_container[$i] = [
        //         'id' => $containers[$i][0]->id,
        //         'job_id' => $containers[$i][0]->job_id,
        //         'size' => $containers[$i][0]->size,
        //         'type' => $containers[$i][0]->type,
        //         'nomor_kontainer' => $containers[$i][0]->nomor_kontainer,
        //         'pengirim' => $containers[$i][0]->pengirim,
        //         'pod_container' => $containers[$i][0]->pod_container,

        //     ];

        // }
        // // dd($containers[1][0]->nomor_kontainer);

        // $details = DetailBarangLoad::where("job_id", $old_id)->get();

        // // dd($request);


        // dd($request, $id);

        $danas = OngkoSupir::find($id);
        $awal = OngkoSupir::where('id', $id)->value('nominal_awal');

        $containers = ContainerPlanload::where('dana', $id)->get();

        // dd($containers);
        $total_container = ContainerPlanload::where('dana', $id)->sum('ongkos_supir');

        $sisa = (int)$awal - (int)$total_container;




        $save = 'storage/deposit_report.pdf';

        $pdf1 = Pdf::loadview('pdf.detail.deposit_report', [
            "danas" => $danas,
            "report" => "MUATAN",
            "containers" => $containers,
            "total_container" => $total_container,
            "sisa" => $sisa,




        ]);
        $pdf1->setPaper('A4', 'landscape');
        $pdf1->save($save);
        return response()->download($save);
    }
}
