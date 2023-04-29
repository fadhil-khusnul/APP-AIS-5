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
        Schema::create('order_job_planloads', function (Blueprint $table) {
            $table->id();
            $table->date('tanggal_planload');
            $table->string('activity');
            $table->string('select_company');
            $table->text('vessel');
            $table->string('pol');
            $table->string('pot');
            $table->string('pod');
            $table->string('pengirim');
            $table->string('penerima');
            $table->text('nama_barang');
            $table->text('slug');
           
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('order_job_planloads');
    }
};
