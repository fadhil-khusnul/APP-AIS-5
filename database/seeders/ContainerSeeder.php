<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Container;


class ContainerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        Container::create([

            'size_container' => '20"',
        ]);
        Container::create([

            'size_container' => '21"',
        ]);
        Container::create([

            'size_container' => '40"',
        ]);
        Container::create([
            'size_container' => '45"',
        ]);

    }
}
