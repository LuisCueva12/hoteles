<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        $conConductor = DB::table('modalidades')->insertGetId([
            'nombre' => 'Con conductor',
            'slug' => 'con_conductor',
            'activo' => true,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        $sinConductor = DB::table('modalidades')->insertGetId([
            'nombre' => 'Sin conductor',
            'slug' => 'sin_conductor',
            'activo' => true,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        $movilidades = DB::table('movilidades')->select('id', 'modalidad')->get();

        $pivotData = [];

        foreach ($movilidades as $movilidad) {
            match ($movilidad->modalidad) {
                'con_conductor' => $pivotData[] = [
                    'movilidad_id' => $movilidad->id,
                    'modalidad_id' => $conConductor,
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
                'sin_conductor' => $pivotData[] = [
                    'movilidad_id' => $movilidad->id,
                    'modalidad_id' => $sinConductor,
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
                'ambos' => array_push($pivotData, [
                    'movilidad_id' => $movilidad->id,
                    'modalidad_id' => $conConductor,
                    'created_at' => now(),
                    'updated_at' => now(),
                ], [
                    'movilidad_id' => $movilidad->id,
                    'modalidad_id' => $sinConductor,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]),
                default => null,
            };
        }

        if ($pivotData) {
            DB::table('movilidad_modalidad')->insert($pivotData);
        }

        Schema::table('movilidades', function ($table) {
            $table->dropIndex(['modalidad']);
            $table->dropIndex(['activo', 'modalidad']);
            $table->dropColumn('modalidad');
        });
    }

    public function down(): void
    {
        Schema::table('movilidades', function ($table) {
            $table->string('modalidad')->default('ambos')->index()->after('ruta_imagen');
            $table->index(['activo', 'modalidad']);
        });

        $modalidades = DB::table('modalidades')->pluck('id', 'slug');
        $conId = $modalidades->get('con_conductor');
        $sinId = $modalidades->get('sin_conductor');

        $pivots = DB::table('movilidad_modalidad')
            ->select('movilidad_id', DB::raw('GROUP_CONCAT(modalidad_id) as modalidad_ids'))
            ->groupBy('movilidad_id')
            ->get();

        foreach ($pivots as $pivot) {
            $ids = explode(',', $pivot->modalidad_ids);
            $tieneCon = in_array((string) $conId, $ids, true);
            $tieneSin = in_array((string) $sinId, $ids, true);

            $valor = match (true) {
                $tieneCon && $tieneSin => 'ambos',
                $tieneCon => 'con_conductor',
                $tieneSin => 'sin_conductor',
                default => 'ambos',
            };

            DB::table('movilidades')
                ->where('id', $pivot->movilidad_id)
                ->update(['modalidad' => $valor]);
        }
    }
};
