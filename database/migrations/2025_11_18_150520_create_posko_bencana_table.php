<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('posko_bencana', function (Blueprint $table) {

            // PRIMARY KEY auto increment
            $table->bigIncrements('posko_id');

            // FK
            $table->unsignedBigInteger('kejadian_id');

            $table->string('nama', 150);
            $table->text('alamat');
            $table->string('kontak', 50)->nullable();
            $table->string('penanggung_jawab', 100);

            $table->timestamps();

            // FOREIGN KEY
            $table->foreign('kejadian_id')
                ->references('kejadian_id')
                ->on('kejadian_bencana')
                ->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('posko_bencana');
    }
};
