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
        Schema::create('batal_muats', function (Blueprint $table) {
            $table->id();
            $table->foreignId('job_id');
            $table->string('kontainer_batal');
            $table->double('harga_batal_muat');
            $table->string('keterangan_batal_muat');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('batal_muats');
    }
};
