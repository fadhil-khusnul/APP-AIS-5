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
        Schema::table('report_vendor_trucks', function (Blueprint $table) {
            //
            $table->string('dibayar')->nullable()->after('keterangan_transfer');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('report_vendor_trucks', function (Blueprint $table) {
            //
        });
    }
};