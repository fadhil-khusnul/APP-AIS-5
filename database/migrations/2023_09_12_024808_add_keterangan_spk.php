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
        Schema::table('spks', function (Blueprint $table) {
            //
            $table->longText('keterangan_spk')->nullable()->after('harga_spk');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('spks', function (Blueprint $table) {
            //
        });
    }
};
