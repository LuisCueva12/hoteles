<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('testimonios_home', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('nombre');
            $table->string('origen');
            $table->string('cargo');
            $table->unsignedTinyInteger('calificacion')->default(5)->index();
            $table->text('texto');
            $table->string('color')->default('#2563EB');
            $table->integer('orden')->default(0)->index();
            $table->boolean('activo')->default(true)->index();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('testimonios_home');
    }
};
