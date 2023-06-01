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
        Schema::create('si_pdf_containers', function (Blueprint $table) {
            $table->id();
            $table->string('job_id');
            $table->string('container_id');
            $table->string('path')->nullable();
            $table->string('shipper')->nullable();
            $table->string('consigne')->nullable();
            $table->date('tanggal_bl')->nullable();
            $table->string('nomor_bl')->nullable();
            $table->double('biaya_do_pol')->nullable();
            $table->date('tanggal_do_pol')->nullable();
            $table->double('biaya_do_pod')->nullable();
            $table->date('tanggal_do_pod')->nullable();
            $table->string('status')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('si_pdf_containers');
    }
};
