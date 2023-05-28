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
            //
            $table->string('harga_batal')->nullable()->after('slug');
            $table->string('keterangan_batal')->nullable()->after('harga_batal');
           

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
