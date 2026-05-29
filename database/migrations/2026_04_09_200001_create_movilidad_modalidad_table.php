<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('movilidad_modalidad', function (Blueprint $table) {
            $table->id();
            $table->foreignId('movilidad_id')->constrained('movilidades')->onDelete('cascade');
            $table->foreignId('modalidad_id')->constrained('modalidades')->onDelete('cascade');
            $table->timestamps();

            $table->unique(['movilidad_id', 'modalidad_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('movilidad_modalidad');
    }
};
