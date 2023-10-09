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
            $table->string('ok')->default('0');
            $table->foreignId('job_id');
            $table->string('size');
            $table->string('type');
            $table->string('cargo');
            $table->string('pot_container')->nullable();
            $table->string('vessel_pot')->nullable();
            $table->string('kode_vessel_pot')->nullable();
            $table->string('pengirim')->nullable();
            $table->string('penerima')->nullable();
            $table->integer('jumlah_kontainer')->nullable();
            $table->string('nomor_kontainer')->nullable();
            $table->string('seal')->nullable();
            $table->date('date_activity')->nullable();
            $table->string('lokasi_depo')->nullable();
            $table->string('driver')->nullable();
            $table->string('nomor_polisi')->nullable();
            $table->string('remark')->nullable();
            $table->double('biaya_stuffing')->default(0);
            $table->double('biaya_trucking')->default(0);
            $table->double('ongkos_supir')->default(0);
            $table->double('biaya_thc')->default(0);
            $table->double('biaya_seal')->default(0);
            $table->double('freight')->default(0);
            $table->double('lss')->default(0);
            $table->double('thc_pod')->default(0);
            $table->double('lolo')->default(0);
            $table->double('dooring')->default(0);
            $table->double('demurrage')->default(0);
            $table->string('nomor_surat')->nullable();
            $table->string('jenis_mobil')->nullable();
            $table->text('detail_barang')->nullable();
            $table->integer('tahun')->nullable();
            $table->string('surat_si')->nullable();
            $table->string('dana')->nullable();
            $table->string('invoice')->nullable();
            $table->string('slug')->nullable();
            $table->string('status')->nullable();
            $table->string('status_bayar')->nullable();
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
