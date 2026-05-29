<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('movilidad_ubicacion', function (Blueprint $table) {
            $table->id();
            $table->foreignId('movilidad_id')->constrained('movilidades')->onDelete('cascade');
            $table->foreignId('ubicacion_id')->constrained('ubicaciones')->onDelete('cascade');
            $table->decimal('precio_ajuste', 10, 2)->nullable();
            $table->timestamps();
            
            $table->unique(['movilidad_id', 'ubicacion_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('movilidad_ubicacion');
    }
};
