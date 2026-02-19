<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    
    public function up(): void
    {
    
        Schema::dropIfExists('books');

        Schema::create('books', function (Blueprint $table) {
            $table->id();
            $table->string('Titulo')->nullable();
            $table->longText('Descripcion')->nullable();
            $table->string('ISBN')->nullable();
            $table->integer('Copias')->nullable();
            $table->integer('Copias_disponibles')->nullable();
            $table->string('Estado')->nullable();
            $table->timestamps();
        });
    }

    
    public function down(): void
    {
        Schema::dropIfExists('books');
    }
};
