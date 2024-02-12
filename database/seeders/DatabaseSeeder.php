<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\PPN;
use App\Models\Seal;
use Illuminate\Database\Seeder;


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
            BankInvoiceSeeder::class,
            OngkoSupirSeeder::class,
            RekeningBankSeeder::class,
            BiayaSeeder::class,
            ContainerSeeder::class,
            DepoSeeder::class,
            PelabuhanSeeder::class,
            PenerimaSeeder::class,
            PengirimSeeder::class,
            StuffingSeeder::class,
            StrippingSeeder::class,
            VendorMobilSeeder::class,
            SupirMobilSeeder::class,
            TypeContainerSeeder::class,
            PPNSeeder::class,
            JobPlanloadSeeder::class,
            SealCreateSeeder::class,
            ContainerLoadSeeder::class,

        ]);

        // Seal::factory(10)->create();


    }
}
