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
        Schema::table('ongko_supirs', function (Blueprint $table) {
            //
            $table->date('tanggal_deposit')->nullable()->after('nominal');
            $table->string('nominal_awal')->nullable()->after('tanggal_deposit');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('ongko_supirs', function (Blueprint $table) {
            //
        });
    }
};
