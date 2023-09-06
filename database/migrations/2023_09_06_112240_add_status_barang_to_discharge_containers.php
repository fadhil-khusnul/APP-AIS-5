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
        Schema::table('plan_discharge_containers', function (Blueprint $table) {
            //
            $table->string('total')->nullable()->after('total_biaya_lain');
            $table->string('status_barang')->nullable()->after('status');
            $table->string('kondisi_invoice')->nullable()->after('status_barang');
            $table->string('keterangan_invoice')->nullable()->after('kondisi_invoice');
            $table->string('price_invoice')->nullable()->after('keterangan_invoice');
            $table->string('status_invoice')->nullable()->after('price_invoice');
            $table->string('status_bayar')->nullable()->after('status_invoice');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('plan_discharge_containers', function (Blueprint $table) {
            //
        });
    }
};
