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
            'nama_penerima' => 'Nama Penerima 01',
            'alamat_penerima' => 'Alamat Penerima 01',
            'email_penerima' => 'Email Penerima 01',
            'no_telp_penerima' => 'No. Telp Penerima 01',
            'rekening_penerima' => 'Rekening Penerima 01',
        ]);

        Penerima::create([
            'nama_penerima' => 'Nama Penerima 02',
            'alamat_penerima' => 'Alamat Penerima 02',
            'email_penerima' => 'Email Penerima 02',
            'no_telp_penerima' => 'No. Telp Penerima 02',
            'rekening_penerima' => 'Rekening Penerima 02',
        ]);

        Penerima::create([
            'nama_penerima' => 'Nama Penerima 03',
            'alamat_penerima' => 'Alamat Penerima 03',
            'email_penerima' => 'Email Penerima 03',
            'no_telp_penerima' => 'No. Telp Penerima 03',
            'rekening_penerima' => 'Rekening Penerima 03',
        ]);

        Penerima::create([
            'nama_penerima' => 'Nama Penerima 04',
            'alamat_penerima' => 'Alamat Penerima 04',
            'email_penerima' => 'Email Penerima 04',
            'no_telp_penerima' => 'No. Telp Penerima 04',
            'rekening_penerima' => 'Rekening Penerima 04',
        ]);

        Penerima::create([
            'nama_penerima' => 'Nama Penerima 05',
            'alamat_penerima' => 'Alamat Penerima 05',
            'email_penerima' => 'Email Penerima 05',
            'no_telp_penerima' => 'No. Telp Penerima 05',
            'rekening_penerima' => 'Rekening Penerima 05',
        ]);

        Penerima::create([
            'nama_penerima' => 'Nama Penerima 06',
            'alamat_penerima' => 'Alamat Penerima 06',
            'email_penerima' => 'Email Penerima 06',
            'no_telp_penerima' => 'No. Telp Penerima 06',
            'rekening_penerima' => 'Rekening Penerima 06',
        ]);

        Penerima::create([
            'nama_penerima' => 'Nama Penerima 07',
            'alamat_penerima' => 'Alamat Penerima 07',
            'email_penerima' => 'Email Penerima 07',
            'no_telp_penerima' => 'No. Telp Penerima 07',
            'rekening_penerima' => 'Rekening Penerima 07',
        ]);
    }
}
