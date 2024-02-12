<?php

namespace Database\Seeders;

use App\Models\Seal;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class SealCreateSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Fixed values
        $kodeSeal = 'AIS';
        $startSeal = 1;
        $hargaSeal = 200000; // Change the value as needed

        // Iterate based on count($request->touch_seal)
        $numberOfSeals = 100; // Assuming $request->touch_seal equals 100

        // Generate sample data for seals
        $sealsData = [];
        for ($i = 1; $i <= $numberOfSeals; $i++) {
            // Pad the kode_seal with leading zeros using str_pad
            $paddedKodeSeal = $kodeSeal . str_pad($i, 6, '0', STR_PAD_LEFT);
            $sealsData[] = [
                'code' => 'Code' . $i,
                'start_seal' => $startSeal,
                'touch_seal' => $i,
                'kode_seal' => $paddedKodeSeal,
                'harga_seal' => $hargaSeal,
                'status' => 'input',
            ];
        }

        // Insert sample seals into the database
        Seal::insert($sealsData);

        // Output a success message
        $this->command->info('Seals seeded successfully.');
    }
}
