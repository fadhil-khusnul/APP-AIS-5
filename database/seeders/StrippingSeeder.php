<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Stripping;


class StrippingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        Stripping::create([
            'kegiatan_stripping' => 'Stripping Dalam',
        ]);
        Stripping::create([
            'kegiatan_stripping' => 'Stripping Luar',
        ]);
    }
}
