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
            
            $table->string('invoice')->nullable()->after('status_bayar');

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