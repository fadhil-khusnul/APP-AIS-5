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
        Schema::create('biaya_lainnyas', function (Blueprint $table) {
            $table->id();
            $table->string('job_id')->nullable();
            $table->string('job_id_discharge')->nullable();
            $table->string('job_id_trucking')->nullable();
            $table->string('kontainer_id')->nullable();
            $table->string('kontainer_id_discharge')->nullable();
            $table->string('kontainer_id_trucking')->nullable();
            $table->double('harga_biaya');
            $table->text('keterangan');
            $table->timestamps();
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('biaya_lainnyas');
    }
};
