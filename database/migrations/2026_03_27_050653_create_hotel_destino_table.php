<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('hotel_destino', function (Blueprint $table) {
            $table->id();
            $table->foreignId('hotel_id')->constrained('hoteles')->onDelete('cascade');
            $table->foreignId('destino_id')->constrained('destinos')->onDelete('cascade');
            $table->decimal('precio_ajuste', 10, 2)->nullable();
            $table->timestamps();
            
            $table->unique(['hotel_id', 'destino_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('hotel_destino');
    }
};
