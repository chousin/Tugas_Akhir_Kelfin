<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePresensiTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('presensi', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_karyawan');
            $table->float('longitude', 10, 6);
            $table->float('latitude', 10, 6);
            $table->dateTime('tanggal_masuk');
            $table->dateTime('tanggal_pulang');
            $table->integer('jumlah_lembur');
            $table->timestamps();

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
        Schema::dropIfExists('presensi');
    }
}