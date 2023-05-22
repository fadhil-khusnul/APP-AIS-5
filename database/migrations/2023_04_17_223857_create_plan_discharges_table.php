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
        Schema::create('plan_discharges', function (Blueprint $table) {
            $table->id();
            $table->date('tanggal_tiba')->nullable();
            $table->string('nomor_do');
            $table->string('biaya_do')->nullable();
            $table->string('activity');
            $table->string('select_company');
            $table->text('vessel');
            $table->text('vessel_code');
            $table->string('pol');
            $table->string('pod');
            $table->string('pengirim');
            $table->string('penerima')->nullable();
            $table->text('slug');
            $table->string('status');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('plan_discharges');
    }
};
