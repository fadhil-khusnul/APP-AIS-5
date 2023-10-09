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
        Schema::table('plan_discharges', function (Blueprint $table) {
            $table->double('tanggal_free')->nullable()->after('tanggal_tiba');
            $table->date('total_hari')->nullable()->after('tanggaL_free');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('plan_discharges', function (Blueprint $table) {
            //
        });
    }
};
