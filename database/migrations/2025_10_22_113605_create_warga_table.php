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

            // Tambahan untuk kebencanaan
            $table->enum('status_dampak', ['korban', 'pengungsi', 'relawan', 'warga_normal'])->default('warga_normal');

            // Foreign key ke kejadian_bencana.kejadian_id
            // $table->unsignedBigInteger('kejadian_id')->nullable();
            // $table->foreign('kejadian_id')
            //       ->references('kejadian_id')
            //       ->on('kejadian_bencana')
            //       ->onDelete('cascade');

            $table->text('alamat');
            $table->string('rt', 10);
            $table->string('rw', 10);
            $table->text('keterangan')->nullable();
            $table->enum('status_kesehatan', ['sehat', 'luka_ringan', 'luka_berat', 'meninggal'])->default('sehat');
            $table->text('kebutuhan_khusus')->nullable();

            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('warga');
    }
};
