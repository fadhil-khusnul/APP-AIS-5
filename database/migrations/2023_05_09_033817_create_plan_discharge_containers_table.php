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
        Schema::create('plan_discharge_containers', function (Blueprint $table) {
            $table->id();
            $table->foreignId('job_id');
            $table->string('size');
            $table->string('type');
            $table->integer('jumlah_kontainer')->nullable();
            $table->string('nomor_kontainer')->nullable();
            $table->string('cargo');
            $table->string('detail_barang')->nullable();
            $table->string('seal')->nullable();
            $table->date('date_activity')->nullable();
            $table->string('lokasi_pickup')->nullable();
            $table->string('driver')->nullable();
            $table->string('nomor_polisi')->nullable();
            $table->string('activity')->nullable();
            $table->string('remark')->nullable();
            $table->date('tanggal_kembali')->nullable();
            $table->string('lokasi_kembali')->nullable();
            $table->double('biaya_relokasi')->default(0);
            $table->double('jaminan_kontainer')->default(0);
            $table->double('biaya_trucking')->default(0);
            $table->double('ongkos_supir')->default(0);
            $table->double('biaya_thc')->default(0);
            $table->double('total_biaya_lain')->default(0);
            $table->string('jenis_mobil')->nullable();
            $table->string('nomor_surat')->nullable();
            $table->integer('tahun')->nullable();
            $table->string('status')->nullable();
            $table->string('slug')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('plan_discharge_containers');
    }
};
