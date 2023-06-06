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
            $table->string('kondisi_invoice')->nullable()->after('status_container');
            $table->string('keterangan_invoice')->nullable()->after('kondisi_invoice');
            $table->string('price_invoice')->nullable()->after('keterangan_invoice');
            $table->string('status_invoice')->nullable()->after('price_invoice');

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
