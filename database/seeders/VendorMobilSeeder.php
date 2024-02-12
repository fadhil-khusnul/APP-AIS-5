<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\VendorMobil;

class VendorMobilSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        VendorMobil::create([
            'nama_vendor' => 'MERAH PUTIH TRANS',
        ]);
        VendorMobil::create([
            'nama_vendor' => 'MITRA INTERTRANS FORWADING',
        ]);
        VendorMobil::create([
            'nama_vendor' => 'TRANS MITRA TRANSPORT',
        ]);
        VendorMobil::create([
            'nama_vendor' => 'MANSYUR',
        ]);
        VendorMobil::create([
            'nama_vendor' => 'RAHMAT JAYA LAUT',
        ]);

    }
}
