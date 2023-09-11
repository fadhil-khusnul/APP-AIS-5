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
        Schema::create('report_vendor_trucks', function (Blueprint $table) {
            $table->id();
            $table->date('tanggal_bayar')->nullable();
            $table->string('job_id')->nullable();
            $table->string('kontainer_id')->nullable();
            $table->string('path')->nullable();
            $table->string('dibayarkan_ke')->nullable();
            $table->string('cara_bayar')->nullable();
            $table->string('keterangan_transfer')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('report_vendor_trucks');
    }
};
