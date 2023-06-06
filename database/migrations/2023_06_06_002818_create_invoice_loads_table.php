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
        Schema::create('invoice_loads', function (Blueprint $table) {
            $table->id();
            $table->string('job_id')->nullable();
            $table->string('container_id')->nullable();
            $table->string('path')->nullable();
            $table->string('nomor_invoice')->nullable();
            $table->string('tahun_invoice')->nullable();
            $table->date('tanggal_invoice')->nullable();
            $table->string('yth')->nullable();
            $table->string('km')->nullable();
            $table->string('status')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('invoice_loads');
    }
};
