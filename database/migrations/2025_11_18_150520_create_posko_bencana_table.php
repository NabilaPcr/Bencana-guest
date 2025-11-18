<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
      public function up()
    {
        Schema::create('posko_bencana', function (Blueprint $table) {
            $table->string('posko_id')->primary();
            $table->string('kejadian_id');
            $table->string('nama');
            $table->text('alamat');
            $table->string('foto')->nullable();
            $table->string('kontak');
            $table->string('penanggung_jawab');
            $table->string('media')->nullable();
            $table->timestamps();

        //     // Foreign key constraint
        //     $table->foreign('kejadian_id')
        //           ->references('kejadian_id')
        //           ->on('kejadian_bencana')
        //           ->onDelete('cascade');
         });
        }

        public function down()
    {
        Schema::dropIfExists('posko_bencana');
    }
}
;
