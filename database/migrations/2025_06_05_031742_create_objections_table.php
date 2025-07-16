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
        Schema::create('objection', function (Blueprint $table) {
            $table->id();
            // Pemohon
            $table->unsignedBigInteger('user_id')->nullable();
            $table->string('nama_pemohon', 50);
            $table->text('alamat_pemohon');
            $table->string('pekerjaan_pemohon', 100);
            $table->string('no_hp_pemohon', 15);
            $table->string('email_pemohon');
            // identitas kuasa pemohon
            $table->string('nama_kuasa_pemohon', 64)->nullable();
            $table->text('alamat_kuasa_pemohon')->nullable();
            $table->string('no_hp_kuasa_pemohon', 15)->nullable();
            $table->text('alasan_pengajuan')->nullable();
            $table->text('kasus_posisi')->nullable();
            // foto ktp pemohon dalam bentuk file
            $table->binary('ktp_pemohon')->nullable();
            $table->enum('status', ['Approved', 'Rejected', 'Checking'])->default('checking');
            $table->text('reject_reason')->nullable();
            $table->timestamps();
        });
        Schema::table('objection', function (Blueprint $table) {
            $table->foreign('user_id')->references('id')->on('users')->onDelete('set null');
        });
    }
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('objection');
    }
};
