<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Depo;


class DepoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        Depo::create([
            'nama_depo' => 'CY Hatta',
        ]);
        Depo::create([
            'nama_depo' => 'Depo Meratus Sutam',
        ]);
        Depo::create([
            'nama_depo' => 'Depo Meratus Sukarno',
        ]);
        Depo::create([
            'nama_depo' => 'Depo Tanto Prusda',
        ]);
        Depo::create([
            'nama_depo' => 'Depo Tanto Tol',
        ]);
        Depo::create([
            'nama_depo' => 'Depo SPIL Satando',
        ]);
        Depo::create([
            'nama_depo' => 'Depo SPIL Sukarno',
        ]);
        Depo::create([
            'nama_depo' => 'Depo TEMAS Sutami',
        ]);
        Depo::create([
            'nama_depo' => 'Depo TEMAS LSP',
        ]);
        Depo::create([
            'nama_depo' => 'Depo Samudera Tol BGR (MT CON)',
        ]);
        Depo::create([
            'nama_depo' => 'Depo Samudera Sukarno',
        ]);
        Depo::create([
            'nama_depo' => 'Depo CTP Parangloe',
        ]);
        Depo::create([
            'nama_depo' => 'Depo CTP Tol Lama',
        ]);
        Depo::create([
            'nama_depo' => 'BONGKAR/MUAT',
        ]);
    }
}
