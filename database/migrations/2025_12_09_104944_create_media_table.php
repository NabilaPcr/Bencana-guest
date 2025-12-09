<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('media', function (Blueprint $table) {
            $table->id('media_id');
            $table->string('ref_table', 100); // Nama tabel yang berelasi
            $table->unsignedBigInteger('ref_id'); // ID dari tabel yang berelasi
            $table->string('file_name'); // Nama file (dulunya file_url)
            $table->string('caption')->nullable(); // Keterangan file
            $table->string('mime_type'); // Tipe file: image/jpeg, application/pdf, dll
            $table->integer('sort_order')->default(1); // Urutan tampilan
            $table->timestamps();

            // Index untuk pencarian cepat
            $table->index(['ref_table', 'ref_id']);
        });
    }

    public function down()
    {
        Schema::dropIfExists('media');
    }
};
