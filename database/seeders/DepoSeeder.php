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
            'pelayaran_id' => 1,
            'nama_depo' => 'CY Hatta',
        ]);
        Depo::create([
            'pelayaran_id' => 1,
            'nama_depo' => 'Depo Meratus Sutam',
        ]);
        Depo::create([
            'pelayaran_id' => 2,
            'nama_depo' => 'Depo Meratus Sukarno',
        ]);
        Depo::create([
            'pelayaran_id' => 2,
            'nama_depo' => 'Depo Tanto Prusda',
        ]);
        Depo::create([
            'pelayaran_id' => 3,
            'nama_depo' => 'Depo Tanto Tol',
        ]);
        Depo::create([
            'pelayaran_id' => 3,
            'nama_depo' => 'Depo SPIL Satando',
        ]);
        Depo::create([
            'pelayaran_id' => 4,
            'nama_depo' => 'Depo SPIL Sukarno',
        ]);
        Depo::create([
            'pelayaran_id' => 4,
            'nama_depo' => 'Depo TEMAS Sutami',
        ]);
        Depo::create([
            'pelayaran_id' => 4,
            'nama_depo' => 'Depo TEMAS LSP',
        ]);
        Depo::create([
            'pelayaran_id' => 4,
            'nama_depo' => 'Depo Samudera Tol BGR (MT CON)',
        ]);
        Depo::create([
            'pelayaran_id' => 5,
            'nama_depo' => 'Depo Samudera Sukarno',
        ]);
        Depo::create([
            'pelayaran_id' => 5,
            'nama_depo' => 'Depo CTP Parangloe',
        ]);
        Depo::create([
            'pelayaran_id' => 5,
            'nama_depo' => 'Depo CTP Tol Lama',
        ]);
        Depo::create([
            'pelayaran_id' => 5,
            'nama_depo' => 'BONGKAR/MUAT',
        ]);
    }
}
