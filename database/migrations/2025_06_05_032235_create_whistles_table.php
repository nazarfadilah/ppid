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
        Schema::create('whistles', function (Blueprint $table) {
            $table->id();
            $table->string('nama', 64);
            $table->string('no_hp', 15);
            $table->string('email')->nullable();
            $table->text('tindakan');
            $table->string('nama_terlapor', 64);
            $table->string('jabatan_terlapor', 64)->nullable();
            $table->dateTime('tanggal_waktu');
            $table->text('lokasi_kejadian')->nullable();
            $table->text('kronologis');
            $table->decimal('nominal_korupsi', 15, 2)->nullable();
            $table->blob('foto_bukti');
            $table->enum('status', ['pending','rejected','confirmed', 'finished'])->default('pending');
            $table->text('alasan')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('whistles');
    }
};
