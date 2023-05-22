<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Bankinvoice;

class BankInvoiceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        Bankinvoice::create([
            'nama_bank' => 'BNI',
            'atas_nama' => 'Annisa Putri',
            'no_rekening' => '212120912019',
        ]);

        Bankinvoice::create([
            'nama_bank' => 'BRI',
            'atas_nama' => 'Dimas Saputra',
            'no_rekening' => '90122801298',
        ]);

        Bankinvoice::create([
            'nama_bank' => 'BCA',
            'atas_nama' => 'Anggun Citra',
            'no_rekening' => '81210910921209',
        ]);
        Bankinvoice::create([
            'nama_bank' => 'MANDIRI',
            'atas_nama' => 'Muhammad Reza',
            'no_rekening' => '71821229012',
        ]);
    }
}
