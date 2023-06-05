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
        Schema::table('container_planloads', function (Blueprint $table) {
            $table->string('dibayar')->default('0')->after('ongkos_supir');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('container_planloads', function (Blueprint $table) {
            //
        });
    }
};
