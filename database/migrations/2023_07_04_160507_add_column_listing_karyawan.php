<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnListingKaryawan extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('listing_karyawan', function (Blueprint $table) {
            $table->float('nominal_hutang')->after('gaji_pokok');
            $table->float('nominal_rembes')->after('nominal_hutang');
            $table->float('nominal_transport')->after('nominal_rembes');
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
            //
        });
    }
}
