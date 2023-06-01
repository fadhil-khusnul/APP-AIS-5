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
        Schema::create('detail_barang_loads', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('job_id');
            $table->string('kontainer_id');
            $table->text('detail_barang');



        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('detail_barang_loads');
    }
};
