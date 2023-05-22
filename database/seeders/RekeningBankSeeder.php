<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\RekeningBank;


class RekeningBankSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        RekeningBank::create([
            'atas_nama' => 'Andi Pangeran',
            'no_rekening' => '1203109310',
            'nama_bank' => 'BCA',
        ]);

        RekeningBank::create([
            'atas_nama' => 'Fadel Pratama',
            'no_rekening' => '912109441009',
            'nama_bank' => 'BNI',
        ]);

        RekeningBank::create([
            'atas_nama' => 'Muhammad Fahri',
            'no_rekening' => '210298392910',
            'nama_bank' => 'MANDIRI',
        ]);

        RekeningBank::create([
            'atas_nama' => 'Sucitra Dewi',
            'no_rekening' => '31923049261',
            'nama_bank' => 'BRI',
        ]);
    }
}
