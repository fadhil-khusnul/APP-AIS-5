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
        Schema::create('seal_containers', function (Blueprint $table) {
            $table->id();
            $table->string('job_id')->nullable();
            $table->string('job_id_discharge')->nullable();
            $table->string('job_id_trucking')->nullable();
            $table->string('kontainer_id')->nullable();
            $table->string('kontainer_id_discharge')->nullable();
            $table->string('kontainer_id_trucking')->nullable();
            $table->string('seal_kontainer')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('seal_containers');
    }
};
