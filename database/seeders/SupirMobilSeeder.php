<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\SupirMobil;


class SupirMobilSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        SupirMobil::create([

            'vendor_id' => '1',
            'nama_supir' => 'HERMAN',
            'nomor_polisi' => 'DD 22121 CX',
        ]);
        SupirMobil::create([

            'vendor_id' => '1',
            'nama_supir' => 'WAWAN',
            'nomor_polisi' => 'DD 91071 CCD',
        ]);
        SupirMobil::create([

            'vendor_id' => '2',
            'nama_supir' => 'RAHMAT',
            'nomor_polisi' => 'DD 821919 IOI',
        ]);
        SupirMobil::create([

            'vendor_id' => '2',
            'nama_supir' => 'AGUNG',
            'nomor_polisi' => 'DD 91092 QP',
        ]);
        SupirMobil::create([

            'vendor_id' => '3',
            'nama_supir' => 'PUTRA',
            'nomor_polisi' => 'DD 88821 YT',
        ]);
        SupirMobil::create([

            'vendor_id' => '3',
            'nama_supir' => 'SURIADI',
            'nomor_polisi' => 'DD 71211 NN',
        ]);
        SupirMobil::create([

            'vendor_id' => '4',
            'nama_supir' => 'ANTO',
            'nomor_polisi' => 'DD 512661 QQ',
        ]);
        SupirMobil::create([

            'vendor_id' => '4',
            'nama_supir' => 'ANDIKA',
            'nomor_polisi' => 'DD 45678 PP',
        ]);
    }
}
