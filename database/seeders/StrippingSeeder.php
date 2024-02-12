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
            'kegiatan' => 'Stripping Dalam',
            'jenis_kegiatan' => 'Stripping',
        ]);
        Stripping::create([
            'kegiatan' => 'Stripping Luar',
            'jenis_kegiatan' => 'Stripping',
        ]);
        Stripping::create([
            'kegiatan' => 'Stuffing Luar',
            'jenis_kegiatan' => 'Stuffing',
        ]);

        Stripping::create([
            'kegiatan' => 'Stuffing Dalam',
            'jenis_kegiatan' => 'Stuffing',
        ]);
        Stripping::create([
            'kegiatan' => 'Trucking Muatan',
            'jenis_kegiatan' => 'Stuffing',
        ]);
        Stripping::create([
            'kegiatan' => 'Trucking Bongkaran',
            'jenis_kegiatan' => 'Strpping',
        ]);
    }
}
