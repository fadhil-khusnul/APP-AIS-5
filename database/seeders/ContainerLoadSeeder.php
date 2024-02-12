<?php

namespace Database\Seeders;

use App\Models\Spk;
use App\Models\Seal;
use App\Models\Penerima;
use App\Models\Pengirim;
use App\Models\Container;
use App\Models\OngkoSupir;
use App\Models\SealContainer;
use App\Models\TypeContainer;
use Illuminate\Database\Seeder;
use App\Models\ContainerPlanload;
use App\Models\OrderJobPlanload;
use App\Models\Pelabuhan;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class ContainerLoadSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Fetch all containers with job_id between 1 and 5
        $containers = ContainerPlanload::whereIn('job_id', range(1, 5))->get();

        // Update the status of the order job planloads
        $status = "Process-Load";
        OrderJobPlanload::whereIn('id', range(1, 5))->update(['status' => $status]);

        foreach ($containers as $container) {
            $randomAlphabet = '';
            for ($k = 0; $k < 4; $k++) {
                $randomAlphabet .= chr(rand(65, 90)); // ASCII values for uppercase alphabets (A-Z)
            }

            // Generate a random 7-digit number
            $randomNumber = rand(1000000, 9999999);

            // Concatenate the random alphabet and random number to form the alphanumeric string
            $randomAlphanumeric = strtoupper($randomAlphabet) . $randomNumber;

            // Update the container data
            $containerData = [
                'pengirim' => Pengirim::inRandomOrder()->first()->nama_costumer, // Fetch random pengirim
                'penerima' => Penerima::inRandomOrder()->first()->nama_penerima, // Fetch random penerima
                // Assuming portName is pod_container
                'pod_container' => Pelabuhan::first()->nama_pelabuhan, 
                // Fetch random penerima
                'size' => Container::inRandomOrder()->first()->size_container, 
                'type' => TypeContainer::inRandomOrder()->first()->type_container, 
                'nomor_kontainer' => $randomAlphanumeric, 
                'status' => $status, 
            ];

            // Update the container with the new data
            $container->update($containerData);

            // Delete existing seal container records for the container
            SealContainer::where('kontainer_id', $container->id)->delete();

            // Insert new seal container records
            $seals = Seal::inRandomOrder()->limit(4)->pluck('kode_seal')->toArray();
            foreach ($seals as $seal) {
                SealContainer::create([
                    'job_id' => $container->job_id,
                    'kontainer_id' => $container->id,
                    'seal_kontainer' => $seal,
                ]);
            }

            // Update the status of seals referenced in the update operation
            Seal::whereIn('kode_seal', $seals)->update(['status' => 'Container']);
        }

        // Update the nominal value of the specified ongko supirs for all containers
        $ongkoSupirs = OngkoSupir::whereIn('id', range(1, 5))->get();
        foreach ($ongkoSupirs as $ongkoSupir) {
            $ongkoSupir->nominal -= $ongkoSupir->ongkos_supir; // Subtract ongkos_supir directly from nominal
            $ongkoSupir->save();
        }

        // Update the status of the specified SPK records for all containers, if provided
        // $spkCode = 'SPK123'; // Assuming SPK code is provided in the update
        // $spks = Spk::whereIn('kode_spk', range($spkCode, $spkCode + 4))->get();
        // foreach ($spks as $spk) {
        //     $spk->update(['status' => 'Container']);
        // }
    }
}

