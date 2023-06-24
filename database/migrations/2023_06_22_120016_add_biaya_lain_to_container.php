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

            $table->string('total_biaya_lain')->default('0')->after('demurrage');
            $table->string('total')->default('0')->after('total_biaya_lain');

            //
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
