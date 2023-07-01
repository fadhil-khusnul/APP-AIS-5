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
use App\Models\SiPdfContainer;
use App\Models\SealContainer;
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
        $random = Str::random(15);
        $id_container = $request->chek_container;

        for ($i=0; $i < count($id_container) ; $i++) {

            $sizez [$i] = ContainerPlanload::where('id', $id_container[$i])->value('size');

        }

        $unique_size = array_values(array_unique($sizez));

        $jumlah = [];
        $quantity = [];
        for($i = 0; $i < count($unique_size); $i++) {
            $jumlah[$i] = 0;
            for($j = 0; $j < count($sizez); $j++) {
                if($unique_size[$i] == $sizez[$j]) {
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
        $alihs = AlihKapal::where('kontainer_alih', $request->chek_container)->get();

        // dd($containers);

        $si_pdf =[
            'shipper' => $request->shipper,
            'status_si' => $request->status_si,
            'consigne' => $request->consigne,
            'job_id' => $old_id,
            'container_id' => $random.time(),
            'path' => 'SI-'.$old_slug.'-'.$random.time(),

        ];

        $sis = SiPdfContainer::create($si_pdf);

        for ($i=0; $i < count($request->chek_container) ; $i++) {
            $container = [
                'status' => "Realisasi",
            ];
            $container2 = [
                'surat_si' => $sis->id,
                'status' => "Realisasi",
                'slug' => $random.time(),
            ];

            OrderJobPlanload::where('id', $old_id)->update($container);
            ContainerPlanload::where('id',$request->chek_container[$i])->update($container2);
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
                'seal' => SealContainer::where('kontainer_id',$request->chek_container[$i])->get('seal_kontainer'),
                'lokasi_depo' => $containers[$i][0][0]->lokasi_depo,
                'cargo' => $containers[$i][0][0]->cargo,

            ];


        }

        $seal_container = [];

        // for ($i=0; $i <count($request->chek_container) ; $i++) {
        //     $seal_container[$i] = SealContainer::where('kontainer_id',$request->chek_container[$i])->get();

        // }

        // dd($new_container);




        $dt = Carbon::now()->isoFormat('YYYY-MMMM-DDDD-dddd-HH-mm-ss');


        $save1 = 'storage/si-container/SI-'.$old_slug.'-'.$random.time().'.pdf';
        $save2 = 'storage/si-container/SI-'.$old_slug.'-'.$random.time().'-progress.pdf';
        $save3 = 'storage/si-container/SI-'.$old_slug.'-'.$random.time().'-ditolak.pdf';





        // dd($si_pdf);


        $pdf1 = Pdf::loadview('pdf.create_si',[
            "loads" => $loads,
            "containers" => $new_container,
            "vessel" => $old_slug,
            "shipper" => $request->shipper,
            "consigne" => $request->consigne,
            "quantity" => $quantity,
            "seal_container" => $seal_container,
            "status_si" => $request->status_si,



        ]);

        $pdf1->save($save1);

        //ON-PROGRESS

        $pdf2 = Pdf::loadview('pdf.create_si_progress',[
            "loads" => $loads,
            "containers" => $new_container,
            "seal_container" => $seal_container,
            "vessel" => $old_slug,
            "shipper" => $request->shipper,
            "consigne" => $request->consigne,
            "quantity" => $quantity,
            "status_si" => $request->status_si,


        ]);
        $status1 = 'ON-PROGRESS';

        $this->make_watermark($pdf2, $status1);

        $pdf2->save($save2);


        //DITOLAK
        $pdf3 = Pdf::loadview('pdf.create_si_progress',[
            "loads" => $loads,
            "containers" => $new_container,
            "vessel" => $old_slug,
            "shipper" => $request->shipper,
            "consigne" => $request->consigne,
            "quantity" => $quantity,
            "seal_container" => $seal_container,
            "status_si" => $request->status_si,



        ]);

        $status2 = 'SI-DITOLAK';

        $this->make_watermark($pdf3, $status2);

        $pdf3->save($save3);



        return response()->download($save2);
    }
    public function create_si_alih(Request $request)
    {
        $random = Str::random(15);

        $id_alih = $request->chek_container;

        for ($i=0; $i < count($id_alih) ; $i++) {

            $sizez [$i] = ContainerPlanload::where('id', $id_alih[$i])->value('size');

        }

        $unique_size = array_values(array_unique($sizez));

        $jumlah = [];
        $quantity = [];
        for($i = 0; $i < count($unique_size); $i++) {
            $jumlah[$i] = 0;
            for($j = 0; $j < count($sizez); $j++) {
                if($unique_size[$i] == $sizez[$j]) {
                    $jumlah[$i] += 1;
                }

            }
            $quantity[$i] = $jumlah[$i].' X '.$unique_size[$i];
        }

        $old_slug = $request->old_slug;
        // dd($old_slug);
        $old_id = OrderJobPlanload::where('slug', $old_slug)->value('id');
        $alihs = AlihKapal::where('kontainer_alih', $request->chek_container)->get();


        $si_pdf =[
            'shipper' => $request->shipper,
            'status_si' => $request->status_si,
            'consigne' => $request->consigne,
            'job_id' => $old_id,
            'container_id' => $random.time(),
            'path' => 'SI-'.$old_slug.'-'.$random.time(),

        ];

        $sis = SiPdfContainer::create($si_pdf);

        for ($i=0; $i < count($request->chek_container) ; $i++) {
            $container = [
                'status' => "Realisasi",
            ];
            $container2 = [
                'surat_si' => $sis->id,
                'status' => "Realisasi-Alih",
                'slug' => $random.time(),
            ];

            OrderJobPlanload::where('id', $old_id)->update($container);
            ContainerPlanload::where('id',$request->chek_container[$i])->update($container2);
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
                'seal' => SealContainer::where('kontainer_id',$request->chek_container[$i])->get('seal_kontainer'),
                'lokasi_depo' => $containers[$i][0][0]->lokasi_depo,
                'cargo' => $containers[$i][0][0]->cargo,
            ];


        }

        // dd($new_container);

        $seal_container = [];

        // for ($i=0; $i <count($request->chek_container) ; $i++) {
        //     $seal_container[$i] = SealContainer::where('kontainer_id',$request->chek_container[$i])->get();

        // }

        // dd($new_container);




        $dt = Carbon::now()->isoFormat('YYYY-MMMM-DDDD-dddd-HH-mm-ss');


        $save1 = 'storage/si-container/SI-'.$old_slug.'-'.$random.time().'.pdf';
        $save2 = 'storage/si-container/SI-'.$old_slug.'-'.$random.time().'-progress.pdf';
        $save3 = 'storage/si-container/SI-'.$old_slug.'-'.$random.time().'-ditolak.pdf';









        // dd($si_pdf);


        $pdf1 = Pdf::loadview('pdf.create_si',[
            "alihs" => $alihs,
            "containers" => $new_container,
            "vessel" => $old_slug,
            "shipper" => $request->shipper,
            "consigne" => $request->consigne,
            "quantity" => $quantity,
            "seal_container" => $seal_container,
            "status_si" => $request->status_si,



        ]);

        $pdf1->save($save1);

        //ON-PROGRESS

        $pdf2 = Pdf::loadview('pdf.create_si_progress',[
            "alihs" => $alihs,
            "containers" => $new_container,
            "seal_container" => $seal_container,
            "vessel" => $old_slug,
            "shipper" => $request->shipper,
            "consigne" => $request->consigne,
            "quantity" => $quantity,
            "status_si" => $request->status_si,


        ]);
        $status1 = 'ON-PROGRESS';

        $this->make_watermark($pdf2, $status1);

        $pdf2->save($save2);


        //DITOLAK
        $pdf3 = Pdf::loadview('pdf.create_si_progress',[
            "alihs" => $alihs,
            "containers" => $new_container,
            "vessel" => $old_slug,
            "shipper" => $request->shipper,
            "consigne" => $request->consigne,
            "quantity" => $quantity,
            "seal_container" => $seal_container,
            "status_si" => $request->status_si,


        ]);

        $status2 = 'SI-DITOLAK';

        $this->make_watermark($pdf3, $status2);

        $pdf3->save($save3);



        return response()->download($save2);
    }


    public function masukkan_bl(Request $request)
    {
        // dd($request);
        $pdf = SiPdfContainer::findOrFail($request->id);

        $data = [

            "nomor_bl" => $request->nomor_bl,
            "tanggal_bl" => $request->tanggal_bl,
            "biaya_do_pol" => $request->biaya_do_pol,
            "status" => "BL",

        ];

        $pdf->update($data);


    }

    public function make_watermark($pdf, $status){
        $pdf->render();
        $canvas = $pdf->getCanvas();
        $height = $canvas->get_height();
        $width = $canvas->get_width();
        $height_divider = 1;
        $width_divider = 1;

        if($status == "SI-DITOLAK"){
            $height_divider = 1.7;
            $width_divider = 5;
        }
        else if($status == "ON-PROGRESS"){
            $height_divider = 1.7;
            $width_divider = 7;
        }
        // dd($status);
        $canvas->page_script('
        $pdf->set_opacity(.2, "Multiply");
        $pdf->text('.($width/$width_divider).', '.($height/$height_divider).', "'.($status).'",
        "Calibri",65, array(0,0,0), 10, 10, -30);');

    }

    public function preview_si(Request $request)

    {
        $id = SiPdfContainer::where('path', $request->path)->value('id');
        $job_id = SiPdfContainer::where('path', $request->path)->value('job_id');




        $pdf= SiPdfContainer::findOrFail($id);

        return view('realisasi.load.preview-si', [
            'title' => 'Preview Shipping Intructions',
            'active' => 'Realisasi',
            'pdf' => $pdf,
            'planload' => OrderJobPlanload::find($job_id),


        ]);



    }

    public function konfirmasi_si(Request $request){
        // dd($request->container_id);
        $pdf = SiPdfContainer::where('container_id', $request->container_id)->value('id');

        $si_pdf= SiPdfContainer::findOrFail($pdf);

        $data =[

            "status_approve" => $request->terima,

        ];

        $si_pdf->update($data);

        return response()->json(['success' => true]);

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

    public function getAlihKapal(Request $request) {
        $vessel = [];

        for($i = 0; $i < count($request->kontainer_alih); $i++) {
            $vessel[$i] = AlihKapal::where('kontainer_alih', $request->kontainer_alih[$i])->value('vessel_alih');
        }

        return response()->json($vessel);
    }

    public function delete_si(Request $request)
    {



        $pdf = SiPdfContainer::findOrFail($request->id);
        $job_id = SiPdfContainer::where('id',$request->id)->value('job_id');
        $container_id = SiPdfContainer::where('id',$request->id)->value('container_id');
        $path = SiPdfContainer::where('id',$request->id)->value('path');

        $status = [
            "status"=> "Process-Load",
        ];

        $alihorno = ContainerPlanload::where('slug', $container_id)->value('harga_alih');

        if ($alihorno != null) {
            $status1 = [
                "status"=> "Alih-Kapal",
                "slug"=> null,
            ];

        } else {
            $status1 = [
                "status"=> "Process-Load",
                "slug"=> null,
            ];
        }
        // dd($status1);



        $deletefiles = Storage::delete('public/si-container/'.$path.'.pdf');
        Storage::delete('public/si-container/'.$path.'-ditolak.pdf');
        Storage::delete('public/si-container/'.$path.'-progress.pdf');
        // dd($deletefiles);


        $job = OrderJobPlanload::where('id', $job_id)->update($status);
        $container = ContainerPlanload::where('slug', $container_id)->update($status1);

        $pdf->delete();





        return response()->json([
            'success'   => true
        ]);

    }
}
