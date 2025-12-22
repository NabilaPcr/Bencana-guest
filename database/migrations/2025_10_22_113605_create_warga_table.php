<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('warga', function (Blueprint $table) {
            $table->increments('warga_id');
            $table->string('no_ktp', 20)->unique();
            $table->string('nama');
            $table->enum('jenis_kelamin', ['L', 'P']);
            $table->string('agama');
            $table->string('pekerjaan');
            $table->string('telp');
            $table->string('email')->nullable();


            $table->text('alamat');
            $table->string('rt', 10);
            $table->string('rw', 10);
            $table->text('keterangan')->nullable();
            $table->text('kebutuhan_khusus')->nullable();

            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('warga');
    }
};
