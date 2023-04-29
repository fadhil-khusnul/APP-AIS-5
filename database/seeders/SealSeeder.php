<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Seal;
use Illuminate\Support\Str;



class SealSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        //

        Seal::create([
            'kode_seal' => Str::random(10),
            'tahun' => fake()->date(),
        ]);
    }
}
