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
        Schema::create('alih_kapals', function (Blueprint $table) {
            $table->id();
            $table->string('job_id');
            $table->string('kontainer_alih');
            $table->double('harga_alih_kapal');
            $table->string('keterangan_alih_kapal');
            $table->string('pelayaran_alih');
            $table->string('pot_alih')->nullable();
            $table->string('pod_alih');
            $table->string('vesseL_alih');
            $table->string('code_vesseL_alih');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('alih_kapals');
    }
};
