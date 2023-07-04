<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateListingKaryawanTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('listing_karyawan', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_pengajuan_penggajian');
            $table->unsignedBigInteger('id_karyawan');
            $table->float('gaji_pokok');
            $table->timestamps();

            $table->foreign('id_pengajuan_penggajian')->references('id')->on('pengajuan_penggajian');
            $table->foreign('id_karyawan')->references('id_karyawan')->on('karyawans');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('listing_karyawan');
    }
}
