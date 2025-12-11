<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('donasi_bencana', function (Blueprint $table) {
            $table->id('donasi_id');
            $table->unsignedBigInteger('kejadian_id');
            $table->string('donatur_nama', 100);
            $table->enum('jenis', ['uang', 'barang'])->default('uang');
            $table->decimal('nilai', 15, 2); // ← TANPA bukti_donasi
            $table->timestamps();

            $table->foreign('kejadian_id')
                  ->references('kejadian_id')
                  ->on('kejadian_bencana')
                  ->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('donasi_bencana');
    }
};
