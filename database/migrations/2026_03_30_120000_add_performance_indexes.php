<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('reservas', function (Blueprint $table) {
            $table->index('created_at');
            $table->index('estado');
            $table->index('fecha_inicio');
            $table->index(['estado', 'created_at']);
        });

        Schema::table('movilidad_ubicacion', function (Blueprint $table) {
            $table->index('ubicacion_id');
        });

        Schema::table('movilidad_ruta', function (Blueprint $table) {
            $table->index('ruta_id');
        });
    }

    public function down(): void
    {
        Schema::table('movilidad_ruta', function (Blueprint $table) {
            $table->dropIndex(['ruta_id']);
        });

        Schema::table('movilidad_ubicacion', function (Blueprint $table) {
            $table->dropIndex(['ubicacion_id']);
        });

        Schema::table('reservas', function (Blueprint $table) {
            $table->dropIndex(['created_at']);
            $table->dropIndex(['estado']);
            $table->dropIndex(['fecha_inicio']);
            $table->dropIndex(['estado', 'created_at']);
        });
    }
};
