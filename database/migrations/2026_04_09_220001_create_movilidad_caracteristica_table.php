<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('movilidad_caracteristica', function (Blueprint $table) {
            $table->id();
            $table->foreignId('movilidad_id')->constrained('movilidades')->onDelete('cascade');
            $table->foreignId('caracteristica_id')->constrained('caracteristicas')->onDelete('cascade');
            $table->timestamps();

            $table->unique(['movilidad_id', 'caracteristica_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('movilidad_caracteristica');
    }
};
