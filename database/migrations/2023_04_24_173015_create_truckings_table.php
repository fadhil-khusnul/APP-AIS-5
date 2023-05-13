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
        Schema::create('truckings', function (Blueprint $table) {
            $table->id();
            $table->string('pelayaran');
            $table->text('vessel');
            $table->text('vessel_code');
            $table->string('activity');
            $table->string('emkl');
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
        Schema::dropIfExists('truckings');
    }
};
