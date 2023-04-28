<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Biaya;

class BiayaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        //
        Biaya::create([
            'pekerjaan_biaya' => 'THC',
            'biaya_cost' => '20000000',
        ]);
        Biaya::create([
            'pekerjaan_biaya' => 'Seal',
            'biaya_cost' => '25000000',
        ]);
        Biaya::create([
            'pekerjaan_biaya' => 'ON EMPTY',
            'biaya_cost' => '35000000',
        ]);
        Biaya::create([
            'pekerjaan_biaya' => 'OFF EMPTY',
            'biaya_cost' => '32500000',
        ]);
        Biaya::create([
            'pekerjaan_biaya' => 'ON NULL',
            'biaya_cost' => '33500000',
        ]);
        Biaya::create([
            'pekerjaan_biaya' => 'OFF NULL',
            'biaya_cost' => '33500000',
        ]);
        Biaya::create([
            'pekerjaan_biaya' => 'Lanjut Stuffing ex DISCHARGE',
            'biaya_cost' => '53500000',
        ]);
        Biaya::create([
            'pekerjaan_biaya' => 'Stuffing Pindah Container',
            'biaya_cost' => '13500000',
        ]);
        Biaya::create([
            'pekerjaan_biaya' => 'Pindah Mobil',
            'biaya_cost' => '12500000',
        ]);
        Biaya::create([
            'pekerjaan_biaya' => 'Relokasi ke CY Hatta',
            'biaya_cost' => '22500000',
        ]);
        Biaya::create([
            'pekerjaan_biaya' => 'Relokasi ke CY Depo',
            'biaya_cost' => '22400000',
        ]);
    }
}
