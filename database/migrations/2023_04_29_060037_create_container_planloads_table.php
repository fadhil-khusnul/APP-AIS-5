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
        Schema::create('container_planloads', function (Blueprint $table) {
            $table->id();
            $table->foreignId('job_id');
            $table->string('kontainer');
            $table->string('size');
            $table->string('type');
            $table->string('seal')->nullable();
            $table->date('date_activity')->nullable();
            $table->string('cargo')->nullable();
            $table->string('lokasi_depo')->nullable();
            $table->string('driver')->nullable();
            $table->string('nomor_polisi')->nullable();
            $table->string('remark')->nullable();
            $table->string('biaya_stuffing')->nullable();
            $table->string('biaya_trucking')->nullable();
            $table->string('ongkos_supir')->nullable();
            $table->string('biaya_thc')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('container_planloads');
    }
};
