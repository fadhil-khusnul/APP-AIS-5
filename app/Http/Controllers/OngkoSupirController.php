<?php

namespace App\Http\Controllers;

use App\Models\OngkoSupir;
use App\Models\SupirMobil;
use App\Models\VendorMobil;
use App\Models\RekeningBank;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
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

    public function report_load()
    {
        $containers = ContainerPlanload::orderBy('updated_at', 'DESC')->whereNotNull('biaya_trucking')->get();

        $vendors = VendorMobil::all();
        $vessels = OrderJobPlanload::select('vessel')->distinct()->get();
        // dd($vessels);




        $lunas_dibayar = ContainerPlanload::sum('dibayar');
        $truck = ContainerPlanload::sum('biaya_trucking');
        $supir = ContainerPlanload::sum('ongkos_supir');

        $belum_lunas = $truck - $supir - $lunas_dibayar;



        return view('pages.vendor.report-load', [

            'title' => 'Report Mobil Truck Load',
            'active' => 'truck',
            "containers" => $containers,
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
        // dd($request);
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

        for ($i=0; $i <count($request->id) ; $i++) {
            # code...

            $reports= [
                'job_id' => $request->job_id,
                'kontainer_id' => $request->id[$i],
                'dibayarkan_ke' => $request->dibayarkan_ke,
                'cara_bayar' => $request->cara_bayar,
                'keterangan_transfer' => $request->keterangan_transfer,
                'tanggal_bayar' => $request->tanggal_bayar,
                
            ];

            ReportVendorTruck::create($reports);
        }




        return response()->json([
            'success'   => true
        ]);
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

    public function print_dana(Request $request, $id){




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

        $pdf1 = Pdf::loadview('pdf.detail.deposit_report',[
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
