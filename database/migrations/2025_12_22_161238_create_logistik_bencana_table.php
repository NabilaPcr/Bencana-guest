<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('logistik_bencana', function (Blueprint $table) {
            $table->id('logistik_id');
            $table->unsignedBigInteger('kejadian_id');
            $table->string('nama_barang', 200);
            $table->string('satuan', 50);
            $table->integer('stok')->default(0);
            $table->string('sumber', 200)->nullable();
            $table->timestamps();

            // Foreign key constraint
            $table->foreign('kejadian_id')
                  ->references('kejadian_id')
                  ->on('kejadian_bencana')
                  ->onDelete('cascade')
                  ->onUpdate('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('logistik_bencana');
    }
};
