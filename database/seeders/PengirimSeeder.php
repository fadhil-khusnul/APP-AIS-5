<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Pengirim;

class PengirimSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        //
        Pengirim::create([
            'nama_costumer' => 'Nama Pengirim 01',
            'alamat' => 'Alamat Pengirim 01',
            'email' => 'Email Pengirim 01',
            'no_telp' => 'No. Telp Pengirim 01',
            'rekening' => 'Rekening Pengirim 01',
        ]);

        Pengirim::create([
            'nama_costumer' => 'Nama Pengirim 02',
            'alamat' => 'Alamat Pengirim 02',
            'email' => 'Email Pengirim 02',
            'no_telp' => 'No. Telp Pengirim 02',
            'rekening' => 'Rekening Pengirim 02',
        ]);

        Pengirim::create([
            'nama_costumer' => 'Nama Pengirim 03',
            'alamat' => 'Alamat Pengirim 03',
            'email' => 'Email Pengirim 03',
            'no_telp' => 'No. Telp Pengirim 03',
            'rekening' => 'Rekening Pengirim 03',
        ]);

        Pengirim::create([
            'nama_costumer' => 'Nama Pengirim 04',
            'alamat' => 'Alamat Pengirim 04',
            'email' => 'Email Pengirim 04',
            'no_telp' => 'No. Telp Pengirim 04',
            'rekening' => 'Rekening Pengirim 04',
        ]);

        Pengirim::create([
            'nama_costumer' => 'Nama Pengirim 05',
            'alamat' => 'Alamat Pengirim 05',
            'email' => 'Email Pengirim 05',
            'no_telp' => 'No. Telp Pengirim 05',
            'rekening' => 'Rekening Pengirim 05',
        ]);

        Pengirim::create([
            'nama_costumer' => 'Nama Pengirim 06',
            'alamat' => 'Alamat Pengirim 06',
            'email' => 'Email Pengirim 06',
            'no_telp' => 'No. Telp Pengirim 06',
            'rekening' => 'Rekening Pengirim 06',
        ]);

        Pengirim::create([
            'nama_costumer' => 'Nama Pengirim 07',
            'alamat' => 'Alamat Pengirim 07',
            'email' => 'Email Pengirim 07',
            'no_telp' => 'No. Telp Pengirim 07',
            'rekening' => 'Rekening Pengirim 07',
        ]);
    }
}
