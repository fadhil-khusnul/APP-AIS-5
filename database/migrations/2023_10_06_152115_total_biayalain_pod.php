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
        Schema::table('container_planloads', function (Blueprint $table) {
            $table->double('total_biaya_lain_pod')->default(0)->after('total_biaya_lain');

            //
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('container_planloads', function (Blueprint $table) {
            //
        });
    }
};