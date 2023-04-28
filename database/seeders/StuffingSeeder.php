<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Stuffing;


class StuffingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //

        Stuffing::create([
            'kegiatan_stuffing' => 'Stuffing Dalam',
        ]);
        Stuffing::create([
            'kegiatan_stuffing' => 'Stuffing Luar',
        ]);
    }
}
