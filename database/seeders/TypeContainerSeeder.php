<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\TypeContainer;


class TypeContainerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        //
        TypeContainer::create([

            'type_container' => 'GP',
        ]);

        TypeContainer::create([

            'type_container' => 'Open Top',
        ]);
        
        TypeContainer::create([

            'type_container' => 'Tunnel ISO TANK',
        ]);
        TypeContainer::create([
            'type_container' => 'Open Side',
        ]);
        TypeContainer::create([
            'type_container' => 'Flat Rack',
        ]);

        TypeContainer::create([
            'type_container' => 'Half Container',
        ]);

        TypeContainer::create([
            'type_container' => 'Refrigerated',
        ]);


    }
}
