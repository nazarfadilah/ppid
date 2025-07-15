<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('public_information', function (Blueprint $table) {
            $table->id(); // Auto-increment primary key
            $table->string('name_pd_okpd'); // Nama PD/OKPD
            $table->string('document_name'); // Nama dokumen
            $table->year('creation_year'); // Tahun pembuatan
            $table->string('file_type'); // Tipe file
            $table->integer('file_size'); // Ukuran file (dalam bytes)
            $table->string('file'); // Path ke file
            $table->timestamps(); // Created at dan updated at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('public_information');
    }
};
