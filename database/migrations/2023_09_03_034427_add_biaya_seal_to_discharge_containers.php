<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('plan_discharge_containers', function (Blueprint $table) {
            $table->double('biaya_seal')->nullable()->after('nomor_polisi');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('plan_discharge_containers', function (Blueprint $table) {
            //
        });
    }
};
