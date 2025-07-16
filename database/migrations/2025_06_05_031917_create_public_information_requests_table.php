<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('public_information_requests', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id')->nullable();
            $table->enum('request_category', ['individual', 'organization', 'group'])->default('individual');
            $table->string('nama_pemohon', 64);
            $table->string('nik', 16);
            $table->string('no_hp', 15);
            $table->string('email');
            $table->text('informasi_terkait');
            $table->text('alasan_informasi');
            // Pengguna Informasi/
            $table->string('nama_pengguna_informasi', 64);
            $table->string('nik_pengguna_informasi', 16);
            $table->text('alamat_pengguna_informasi');
            $table->string('no_hp_pengguna_informasi', 15);
            $table->string('email_pengguna_informasi');
            $table->text('alasan_pengguna_informasi');
            // Informasi Tambahan
            $table->string('cara_mendapatkan_informasi')->nullable();
            $table->string('cara_mendapatkan_informasi_lainnya')->nullable();
            $table->string('formats')->nullable();
            $table->string('format_lainnya')->nullable();
            $table->string('pengiriman_informasi')->nullable();
            $table->string('pengiriman_informasi_lainnya')->nullable();
            // Scan foto KTP/upload KTP menggunakan file
            $table->binary('ktp');
            $table->enum('status', ['Approved', 'Checking', 'Rejected'])->default('Checking');
            $table->text('reject_reason')->nullable();
            $table->timestamps();
        });
        Schema::table('public_information_requests', function (Blueprint $table) {
            $table->foreign('user_id')->references('id')->on('users')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('public_information_requests');
    }
};
