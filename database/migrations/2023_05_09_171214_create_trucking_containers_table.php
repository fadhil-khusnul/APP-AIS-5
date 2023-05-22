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
        Schema::create('trucking_containers', function (Blueprint $table) {
            $table->id();
            $table->foreignId('job_id');
            $table->string('size');
            $table->string('type');
            $table->string('cargo');
            $table->integer('jumlah_kontainer')->nullable();
            $table->string('nomor_kontainer')->nullable();
            $table->string('seal')->nullable();
            $table->string('detail_barang')->nullable();
            $table->date('date_activity')->nullable();
            $table->string('lokasi_pickup')->nullable();
            $table->string('lokasi_tujuan')->nullable();
            $table->string('mty_to')->nullable();
            $table->string('driver')->nullable();
            $table->string('nomor_polisi')->nullable();
            $table->double('ongkos_supir')->nullable();
            $table->string('remark')->nullable();
            $table->string('jenis_mobil')->nullable();
            $table->date('tanggal_kembali')->nullable();
            $table->string('nomor_surat')->nullable();
            $table->integer('tahun')->nullable();
            $table->string('status')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('trucking_containers');
    }
};
