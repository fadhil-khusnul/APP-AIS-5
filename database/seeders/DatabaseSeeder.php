<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Seal;


class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
        $this->call([
            ShippingCompanySeeder::class,
            BiayaSeeder::class,
            ContainerSeeder::class,
            DepoSeeder::class,
            PelabuhanSeeder::class,
            PenerimaSeeder::class,
            PengirimSeeder::class,
            StuffingSeeder::class,
            StrippingSeeder::class,
            TruckingSeeder::class,

        ]);

        Seal::factory(10)->create();


    }
}
