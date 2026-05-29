<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('hotel_modalidad', function (Blueprint $table) {
            $table->id();
            $table->foreignId('hotel_id')->constrained('hoteles')->onDelete('cascade');
            $table->foreignId('modalidad_id')->constrained('modalidades')->onDelete('cascade');
            $table->timestamps();
            
            $table->unique(['hotel_id', 'modalidad_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('hotel_modalidad');
    }
};
