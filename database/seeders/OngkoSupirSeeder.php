<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\OngkoSupir;


class OngkoSupirSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        OngkoSupir::create([
            'tanggal_deposit' => '2023-6-29',
            'pj' => 'Andi Firmansyah',
            'nominal' => '1200000',
            'nominal_awal' => '1200000',
        ]);
        OngkoSupir::create([
            'tanggal_deposit' => '2023-6-29',
            'pj' => 'Putri Ramadhani',
            'nominal' => '1700000',
            'nominal_awal' => '1700000',
        ]);
        OngkoSupir::create([
            'tanggal_deposit' => '2023-6-29',
            'pj' => 'Saputra Yahya',
            'nominal' => '1520000',
            'nominal_awal' => '1520000',
        ]);
        OngkoSupir::create([
            'tanggal_deposit' => '2023-6-29',
            'pj' => 'Putri Salsabila',
            'nominal' => '2790200',
            'nominal_awal' => '2790200',
        ]);
    }
}
