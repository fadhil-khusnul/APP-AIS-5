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
        Schema::table('trucking_containers', function (Blueprint $table) {
            $table->string('order_dari')->nullable()->after('cargo');
            $table->string('activity')->nullable()->after('order_dari');
            $table->double('biaya_trucking')->default(0)->after('status');
            $table->double('total_biaya_lain')->default(0)->after('biaya_trucking');
            $table->double('total')->default(0)->after('total_biaya_lain');
            $table->string('status_barang')->nullable()->after('total');
            $table->string('kondisi_invoice')->nullable()->after('status_barang');
            $table->string('keterangan_invoice')->nullable()->after('kondisi_invoice');
            $table->string('price_invoice')->nullable()->after('keterangan_invoice');
            $table->string('status_invoice')->nullable()->after('price_invoice');
            $table->string('status_bayar')->nullable()->after('status_invoice');
            $table->string('invoice')->nullable()->after('status_bayar');
            $table->string('slug')->nullable()->after('invoice');
            
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('trucking_containers', function (Blueprint $table) {
            //
        });
    }
};
