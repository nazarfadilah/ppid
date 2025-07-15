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
        Schema::create('reports', function (Blueprint $table) {
            $table->id(); // Auto-increment primary key
            $table->string('file'); // Path to the report file
            $table->string('photo'); // Path to the photo
            $table->enum('type', ['ppid', 'finance', 'performance', 'administration'])->default('ppid'); // Type of the report
            $table->year('year'); // Year of the report
            $table->enum('status', ['private', 'public'])->default('private'); // Status of the report
            $table->timestamps(); // Created at and updated at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reports');
    }
};
