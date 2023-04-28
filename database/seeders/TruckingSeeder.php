<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Trucking;

class TruckingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        //
        Trucking::create([
            'nomor_polisi' => 'DD2122OS',
            'nama_driver' => 'Nama Driver 01',
        ]);
        Trucking::create([
            'nomor_polisi' => 'DD3112OQ',
            'nama_driver' => 'Nama Driver 02',
        ]);
        Trucking::create([
            'nomor_polisi' => 'DD1982OCA',
            'nama_driver' => 'Nama Driver 03',
        ]);
        Trucking::create([
            'nomor_polisi' => 'DD3386OSS',
            'nama_driver' => 'Nama Driver 04',
        ]);
        Trucking::create([
            'nomor_polisi' => 'DD6435EEA',
            'nama_driver' => 'Nama Driver 05',
        ]);
        Trucking::create([
            'nomor_polisi' => 'DD5678ECE',
            'nama_driver' => 'Nama Driver 06',
        ]);
        Trucking::create([
            'nomor_polisi' => 'DD8635GVV',
            'nama_driver' => 'Nama Driver 07',
        ]);
    }
}
