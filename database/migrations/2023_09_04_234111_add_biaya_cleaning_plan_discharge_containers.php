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
            $table->string('penerima')->nullable()->after('nomor_polisi');
            $table->string('alamat_pengantaran')->nullable()->after('penerima');
            $table->string('return_to')->nullable()->after('alamat_pengantaran');
            $table->double('biaya_cleaning')->nullable()->after('jenis_mobil');
            $table->double('biaya_retribusi')->nullable()->after('biaya_cleaning');

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
