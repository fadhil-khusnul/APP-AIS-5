<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Pelabuhan;


class PelabuhanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        Pelabuhan::create([
            'area_code' => 'MKS',
            'nama_pelabuhan' => 'Makassar',
        ]);
        Pelabuhan::create([
            'area_code' => 'SUB',
            'nama_pelabuhan' => 'Surabaya',
        ]);
        Pelabuhan::create([
            'area_code' => 'YOG',
            'nama_pelabuhan' => 'Yogyakarta',
        ]);
        Pelabuhan::create([
            'area_code' => 'JKT',
            'nama_pelabuhan' => 'Jakarta',
        ]);
        Pelabuhan::create([
            'area_code' => 'BDG',
            'nama_pelabuhan' => 'Bandung',
        ]);
    }
}
