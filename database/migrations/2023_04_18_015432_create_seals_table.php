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
        Schema::create('seals', function (Blueprint $table) {
            $table->id();
            $table->string('code')->nullable();
            $table->double('start_seal');
            $table->double('touch_seal')->nullable();
            $table->string('status')->nullable();
            $table->double('harga_seal')->nullable();
            $table->text('kode_seal');
            $table->string('keterangan_damage')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('seals');
    }
};
