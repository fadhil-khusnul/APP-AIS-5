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
            'jenis_container' => 'Container 01',
            'type_container' => 'GP',
            'size_container' => '20`',
        ]);
        Container::create([
            'jenis_container' => 'Container 02',
            'type_container' => 'Open Top',
            'size_container' => '21`',
        ]);
        Container::create([
            'jenis_container' => 'Container 03',
            'type_container' => 'Tunnel ISO TANK',
            'size_container' => '40`',
        ]);
        Container::create([
            'jenis_container' => 'Container 04',
            'type_container' => 'Open Side',
            'size_container' => '45`',
        ]);
        Container::create([
            'jenis_container' => 'Container 05',
            'type_container' => 'Flat Rack',
            'size_container' => '21`',
        ]);
        Container::create([
            'jenis_container' => 'Container 06',
            'type_container' => 'Half Container',
            'size_container' => '20`',
        ]);
        Container::create([
            'jenis_container' => 'Container 07',
            'type_container' => 'Refrigerated',
            'size_container' => '40`',
        ]);

    }
}
