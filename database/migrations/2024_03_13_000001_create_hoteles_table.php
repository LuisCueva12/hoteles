<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('hoteles', function (Blueprint $table) {
            $table->id();
            $table->string('nombre')->index();
            $table->string('slug')->unique();
            $table->foreignId('marca_id')->constrained('marcas')->onDelete('cascade');
            $table->string('categoria')->index();
            $table->decimal('precio_base', 10, 2)->index();
            $table->integer('capacidad_personas');
            $table->json('caracteristicas')->nullable();
            $table->string('ruta_imagen')->nullable();
            $table->boolean('activo')->default(true)->index();
            $table->timestamps();
            
            $table->index(['activo', 'marca_id']);
            $table->index(['activo', 'categoria']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('hoteles');
    }
};
