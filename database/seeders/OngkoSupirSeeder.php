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
            'pj' => 'Andi Firmansyah',
            'nominal' => '1200000',
        ]);
        OngkoSupir::create([
            'pj' => 'Putri Ramadhani',
            'nominal' => '1700000',
        ]);
        OngkoSupir::create([
            'pj' => 'Saputra Yahya',
            'nominal' => '1520000',
        ]);
        OngkoSupir::create([
            'pj' => 'Putri Salsabila',
            'nominal' => '2790200',
        ]);
    }
}
