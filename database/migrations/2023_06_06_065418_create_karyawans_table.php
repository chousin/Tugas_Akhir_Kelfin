<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKaryawansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('karyawans', function (Blueprint $table) {
            $table->bigIncrements('id_karyawan');
            $table->integer('id_user');
            $table->string('nama_karyawan');
            $table->string('alamat');
            $table->date('tgl_lahir');
            $table->string('no_hp');
            $table->string('jenis_kelamin');
            $table->string('no_rekening');
            $table->string('no_ktp');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('karyawans');
    }
}