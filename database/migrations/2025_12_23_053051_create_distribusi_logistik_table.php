<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('distribusi_logistik', function (Blueprint $table) {
            $table->id('distribusi_id');
            $table->unsignedBigInteger('logistik_id');
            $table->unsignedBigInteger('posko_id');
            $table->date('tanggal');
            $table->integer('jumlah');
            $table->string('penerima');
            $table->string('lokasi')->nullable(); // Kolom lokasi baru
            $table->text('keterangan')->nullable();
            $table->timestamps();

            // Foreign keys
            $table->foreign('logistik_id')
                  ->references('logistik_id')
                  ->on('logistik_bencana')
                  ->onDelete('cascade');

            $table->foreign('posko_id')
                  ->references('posko_id')
                  ->on('posko_bencana')
                  ->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('distribusi_logistik');
    }
};
