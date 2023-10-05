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
            $table->double('rincian')->default(0)->after('dibayar');

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
