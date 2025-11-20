<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('posko_bencana', function (Blueprint $table) {

            // Primary key auto increment dengan nama custom
            $table->bigIncrements('posko_id');

            // FK ke kejadian_bencana
            $table->unsignedBigInteger('kejadian_id');

            $table->string('nama', 150);
            $table->text('alamat');
            $table->string('kontak', 50)->nullable();
            $table->string('penanggung_jawab', 100);

            $table->timestamps();

            // Relasi FK
            $table->foreign('kejadian_id')
                ->references('kejadian_id')
                ->on('kejadian_bencana')
                ->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::table('posko_bencana', function (Blueprint $table) {
            $table->dropForeign(['kejadian_id']);
        });

        Schema::dropIfExists('posko_bencana');
    }
};
