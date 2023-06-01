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
            'nama_vendor' => 'Vendor Mobil PT. Meratus Line',
        ]);

        VendorMobil::create([
            'nama_vendor' => 'Vendor Mobil PT. Samudera Pacific Indonesia Lines',
        ]);
        VendorMobil::create([
            'nama_vendor' => 'Vendor Mobil PT. Tempuran EMAS',
        ]);
        VendorMobil::create([
            'nama_vendor' => 'Vendor Mobil PT. Tanto Intim Line',
        ]);
        VendorMobil::create([
            'nama_vendor' => 'Vendor Mobil PT. Samudera Indonesia',
        ]);
    }
}
