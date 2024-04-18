<?php

namespace Database\Seeders;

use App\Models\Kapal;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\ShippingCompany;


class ShippingCompanySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        ShippingCompany::create([
            'nama_company' => 'PT. Meratus Line',
        ]);
        ShippingCompany::create([
            'nama_company' => 'PT. Samudera Pacific Indonesia Lines',
        ]);
        ShippingCompany::create([
            'nama_company' => 'PT. Tempuran EMAS',
        ]);
        ShippingCompany::create([
            'nama_company' => 'PT. Tanto Intim Line',
        ]);
        ShippingCompany::create([
            'nama_company' => 'PT. Samudera Indonesia',
        ]);

        Kapal::create([
            'nama_kapal'=> 'Nama Kapal 01',
            'code_kapal'=> 'Code Kapal 01',
            'pelayaran_id'=> 1,

        ]);
        Kapal::create([
            'nama_kapal'=> 'Nama Kapal 02',
            'code_kapal'=> 'Code Kapal 02',
            'pelayaran_id'=> 2,

        ]);
        Kapal::create([
            'nama_kapal'=> 'Nama Kapal 03',
            'code_kapal'=> 'Code Kapal 03',
            'pelayaran_id'=> 3,

        ]);
        Kapal::create([
            'nama_kapal'=> 'Nama Kapal 04',
            'code_kapal'=> 'Code Kapal 04',
            'pelayaran_id'=> 4,

        ]);
    }
}
