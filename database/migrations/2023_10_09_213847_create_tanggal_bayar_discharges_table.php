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
        Schema::create('tanggal_bayar_discharges', function (Blueprint $table) {
            $table->id();
            $table->string('job_id')->nullable();
            $table->string('slug')->nullable();
            $table->string('invoice_id')->nullable();
            $table->string('pembayaran')->nullable();
            $table->double('rincian')->default(0);
            $table->date('tanggal_bayar')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tanggal_bayar_discharges');
    }
};
