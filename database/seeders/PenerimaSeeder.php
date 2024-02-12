<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Penerima;


class PenerimaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        //

        Penerima::create([
            'nama_penerima' => 'MEIWA',
            'alamat_penerima' => '-',
            'email_penerima' => '-',
            'no_telp_penerima' => '-',
            'rekening_penerima' => '-',
        ]);
        Penerima::create([
            'nama_penerima' => 'PT. AIS LOGISTIC MAKASSAR',
            'alamat_penerima' => 'MAKASSAR',
            'email_penerima' => '-',
            'no_telp_penerima' => '-',
            'rekening_penerima' => '-',
        ]);

        Penerima::create([
            'nama_penerima' => 'MAKMUR',
            'alamat_penerima' => '-',
            'email_penerima' => '-',
            'no_telp_penerima' => '-',
            'rekening_penerima' => '-',
        ]);
        Penerima::create([
            'nama_penerima' => 'DARPO',
            'alamat_penerima' => '-',
            'email_penerima' => '-',
            'no_telp_penerima' => '-',
            'rekening_penerima' => '-',
        ]);
        Penerima::create([
            'nama_penerima' => 'MARTIN',
            'alamat_penerima' => '-',
            'email_penerima' => '-',
            'no_telp_penerima' => '-',
            'rekening_penerima' => '-',
        ]);
        Penerima::create([
            'nama_penerima' => 'MUKTAR',
            'alamat_penerima' => '-',
            'email_penerima' => '-',
            'no_telp_penerima' => '-',
            'rekening_penerima' => '-',
        ]);
        Penerima::create([
            'nama_penerima' => 'GALIH',
            'alamat_penerima' => '-',
            'email_penerima' => '-',
            'no_telp_penerima' => '-',
            'rekening_penerima' => '-',
        ]);

       
    }
}
