<?php

namespace Database\Seeders;

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
    }
}
