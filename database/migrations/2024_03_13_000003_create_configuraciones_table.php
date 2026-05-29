<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('configuraciones', function (Blueprint $table) {
            $table->id();
            $table->string('telefono_whatsapp', 15);
            $table->string('enlace_facebook')->nullable();
            $table->string('enlace_instagram')->nullable();
            
            $table->string('hero_avatar_1')->default('');
            $table->string('hero_avatar_2')->default('');
            $table->string('hero_avatar_3')->default('');
            $table->integer('hero_clientes_count')->default(1050);
            $table->decimal('hero_rating', 3, 1)->default(4.9);
            
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('configuraciones');
    }
};
