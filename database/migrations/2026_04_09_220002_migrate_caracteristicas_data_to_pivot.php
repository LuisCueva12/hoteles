<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Str;

return new class extends Migration
{
    public function up(): void
    {
        $movilidades = DB::table('movilidades')
            ->whereNotNull('caracteristicas')
            ->select('id', 'caracteristicas')
            ->get();

        $slugToId = [];

        foreach ($movilidades as $movilidad) {
            $items = json_decode($movilidad->caracteristicas, true);

            if (!is_array($items)) {
                continue;
            }

            foreach ($items as $nombre) {
                $nombre = trim($nombre);

                if ($nombre === '') {
                    continue;
                }

                $slug = Str::slug($nombre, '_');

                if (!isset($slugToId[$slug])) {
                    $existing = DB::table('caracteristicas')->where('slug', $slug)->first();

                    if ($existing) {
                        $slugToId[$slug] = $existing->id;
                    } else {
                        $slugToId[$slug] = DB::table('caracteristicas')->insertGetId([
                            'nombre' => $nombre,
                            'slug' => $slug,
                            'created_at' => now(),
                            'updated_at' => now(),
                        ]);
                    }
                }

                DB::table('movilidad_caracteristica')->insertOrIgnore([
                    'movilidad_id' => $movilidad->id,
                    'caracteristica_id' => $slugToId[$slug],
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        }

        Schema::table('movilidades', function ($table) {
            $table->dropColumn('caracteristicas');
        });
    }

    public function down(): void
    {
        Schema::table('movilidades', function ($table) {
            $table->json('caracteristicas')->nullable()->after('ruta_imagen');
        });

        $movilidades = DB::table('movilidad_caracteristica')
            ->join('caracteristicas', 'caracteristicas.id', '=', 'movilidad_caracteristica.caracteristica_id')
            ->select('movilidad_caracteristica.movilidad_id', 'caracteristicas.nombre')
            ->get()
            ->groupBy('movilidad_id');

        foreach ($movilidades as $movilidadId => $items) {
            DB::table('movilidades')
                ->where('id', $movilidadId)
                ->update(['caracteristicas' => json_encode($items->pluck('nombre')->values()->all())]);
        }
    }
};
