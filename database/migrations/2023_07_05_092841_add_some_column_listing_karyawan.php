<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddSomeColumnListingKaryawan extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('listing_karyawan', function (Blueprint $table) {
            $table->string('jumlah_hari')->after('gaji_pokok')->default(0);
            $table->string('jumlah_lembur')->after('nominal_transport')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('listing_karyawan', function (Blueprint $table) {
            $table->dropColumn(['jumlah_hari', 'jumlah_lembur']);
        });
    }
}
