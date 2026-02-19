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
        Schema::create('books', function (Blueprint $table) {
            $table->id();
            $table->string('Titulo')->nullable();
            $table->longText('Descripcion')->nullable();
            $table->Integer('ISBN')->nullable();
            $table->Integer('Copias')->nullable();
            $table->Integer('Copias_disponibles')->nullable();
            $table->string('Estado')->nullable();
            $table->timestamps();
        });

        Schema::create('book_loans  ', function (Blueprint $table) {
            $table->id();
            $table->Integer('ISBN')->nullable();
            $table->Integer('Nombre_usuario')->nullable();
            $table->Date('Fecha_prestamo')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('books');
        Schema::dropIfExists('book_loans');
    }
};
