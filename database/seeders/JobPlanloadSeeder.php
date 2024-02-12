<?php

namespace Database\Seeders;

use App\Models\Container;
use App\Models\Spk;
use App\Models\Seal;
use App\Models\Penerima;
use App\Models\Pengirim;
use App\Models\Pelabuhan;
use App\Models\Stripping;
use App\Models\OngkoSupir;
use Illuminate\Support\Str;
use App\Models\SealContainer;
use App\Models\ShippingCompany;
use Illuminate\Database\Seeder;
use App\Models\OrderJobPlanload;
use App\Models\ContainerPlanload;
use App\Models\TypeContainer;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class JobPlanloadSeeder extends Seeder
{

    //     $shippingCompanies = ShippingCompany::all(); // Fetch all shipping companies
    //     $pelabuhans = Pelabuhan::all(); // Fetch all ports
    //     $strippings = Stripping::where('jenis_kegiatan', "stuffing")->get(); // Fetch all stripping activities

    //     for ($i = 0; $i < 5; $i++) {
    //         foreach ($shippingCompanies as $company) {
    //             foreach ($pelabuhans as $port) {
    //                 foreach ($strippings as $stripping) {
    //                     $random = Str::random(15);
    //                     $companyName = $company->nama_company;
    //                     $portName = $port->nama_pelabuhan;
    //                     $activity = $stripping->kegiatan;

    //                     $slug = Str::slug($companyName) . '-' . Str::slug($portName) . '-' . $random;

    //                     $orderJob = [
    //                         'activity' => $activity,
    //                         'select_company' => $companyName,
    //                         'vessel' => 'Vessel_' . Str::random(5),
    //                         'vessel_code' => 'Code_' . Str::random(5),
    //                         'pol' => $portName,
    //                         'pengirim' => 'Sender_' . Str::random(5),
    //                         'penerima' => 'Receiver_' . Str::random(5),
    //                         'tanggal' => now(),
    //                         'slug' => $slug,
    //                         'status' => 'Plan-Load',
    //                     ];

    //                     $orderJob = OrderJobPlanload::create($orderJob);

    //                     $containers = [];
    //                     for ($j = 0; $j < rand(1, 20); $j++) {
    //                         $containers[] = [
    //                             'job_id' => $orderJob->id,
    //                             'size' => 'Size_' . $j,
    //                             'type' => 'Type_' . $j,
    //                             'cargo' => 'Cargo_' . $j,
    //                         ];
    //                     }

    //                     ContainerPlanload::insert($containers);
    //                 }
    //             }
    //         }
    //     }
    // }

    public function run(): void
    {
        $shippingCompanies = ShippingCompany::all();
        $pelabuhans = Pelabuhan::all();
        $strippings = Stripping::where('jenis_kegiatan', "stuffing")->get();

        for ($i = 0; $i < 3; $i++) {
            foreach ($shippingCompanies as $company) {
                foreach ($pelabuhans as $port) {
                    foreach ($strippings as $stripping) {
                        $random = Str::random(15);
                        $companyName = $company->nama_company;
                        $portName = $port->nama_pelabuhan;
                        $activity = $stripping->kegiatan;

                        $slug = Str::slug($companyName) . '-' . Str::slug($portName) . '-' . $random;

                        // Create and retrieve the order job planload
                        $orderJob = OrderJobPlanload::create([
                            'activity' => $activity,
                            'select_company' => $companyName,
                            'vessel' => 'Vessel_' . Str::random(5),
                            'vessel_code' => 'Code_' . Str::random(5),
                            'pol' => $portName,
                            'pengirim' => Pengirim::inRandomOrder()->first()->nama_costumer, // Fetch random pengirim
                            'penerima' => Penerima::inRandomOrder()->first()->nama_penerima, // Fetch random penerima
                            'tanggal' => now(),
                            'slug' => $slug,
                            'status' => 'Plan-Load',
                        ]);

                        // Insert containers for the order job planload
                        $containers = [];
                        for ($j = 0; $j < rand(20, 50); $j++) {
                            $containers[] = [
                                'job_id' => $orderJob->id,
                                'size' => 'Size_' . $j,
                                'type' => 'Type_' . $j,
                                'cargo' => 'Cargo_' . $j,
                            ];
                        }
                        ContainerPlanload::insert($containers);
                    }
                }
            }
        }
    }
}
