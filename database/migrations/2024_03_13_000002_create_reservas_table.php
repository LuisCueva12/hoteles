<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('reservas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('movilidad_id')->constrained('movilidades')->cascadeOnDelete();
            $table->string('cliente_nombre');
            $table->string('cliente_documento', 8);
            $table->string('cliente_whatsapp', 9);
            $table->string('ruta_viaje', 500);
            $table->date('fecha_inicio');
            $table->date('fecha_fin');
            $table->enum('modalidad', ['con_conductor', 'sin_conductor']);
            $table->unsignedTinyInteger('adultos');
            $table->unsignedTinyInteger('ninos')->default(0);
            $table->text('detalles')->nullable();
            $table->enum('estado', ['pendiente', 'confirmada', 'cancelada'])->default('pendiente');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('reservas');
    }
};
