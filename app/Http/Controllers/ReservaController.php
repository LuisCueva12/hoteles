<?php

namespace App\Http\Controllers;

use App\Http\Requests\ReservaRequest;
use App\Models\Configuracion;
use App\Models\Modalidad;
use App\Models\Movilidad;
use App\Models\Reserva;

class ReservaController extends Controller
{
    public function index()
    {
        $reservas = Reserva::with('movilidad')
            ->latest()
            ->paginate(20);

        return view('admin.reservas.index', compact('reservas'));
    }

    public function show(Reserva $reserva)
    {
        $reserva->load('movilidad');
        return view('admin.reservas.mostrar', compact('reserva'));
    }

    public function store(ReservaRequest $request)
    {
        $datosValidados = $request->validated();
        $datosValidados['estado'] = 'pendiente';
        $pasajerosResumen = (string) ($datosValidados['pasajeros_resumen'] ?? '');
        unset($datosValidados['pasajeros_resumen']);

        $movilidad = Movilidad::query()
            ->with('marca:id,nombre')
            ->select(['id', 'nombre', 'marca_id', 'activo'])
            ->findOrFail($datosValidados['movilidad_id']);

        $reserva = Reserva::create($datosValidados);

        $mensajeWhatsapp = $this->construirMensajeWhatsapp($reserva, $movilidad, $pasajerosResumen);
        $configuracion = Configuracion::obtenerConfiguracion();
        $numeroWhatsapp = $configuracion->telefono_whatsapp;
        $urlWhatsapp = "https://wa.me/{$numeroWhatsapp}?text=" . urlencode($mensajeWhatsapp);

        return redirect()->away($urlWhatsapp);
    }

    private function construirMensajeWhatsapp(Reserva $reserva, Movilidad $movilidad, string $pasajerosResumen = ''): string
    {
        $mensaje = "🚗 *NUEVA SOLICITUD DE RESERVA*\n\n";
        $mensaje .= "📋 *Movilidad:* {$movilidad->nombre}\n";
        $mensaje .= "🏷️ *Marca:* " . ($movilidad->marca?->nombre ?? 'Sin marca') . "\n\n";
        $mensaje .= "👤 *Cliente:* {$reserva->cliente_nombre}\n";
        $mensaje .= "🆔 *DNI:* {$reserva->cliente_documento}\n";
        $mensaje .= "📱 *WhatsApp:* +51{$reserva->cliente_whatsapp}\n\n";
        $mensaje .= "🗺️ *Ruta:* {$reserva->ruta_viaje}\n";
        $mensaje .= "📅 *Inicio:* {$reserva->fecha_inicio->format('d/m/Y')}\n";
        $mensaje .= "📅 *Fin:* {$reserva->fecha_fin->format('d/m/Y')}\n";
        $nombreModalidad = Modalidad::where('slug', $reserva->modalidad)->value('nombre') ?? $reserva->modalidad;
        $mensaje .= "🚘 *Modalidad:* {$nombreModalidad}\n\n";
        $mensaje .= "👥 *Pasajeros:*\n";
        if ($pasajerosResumen !== '') {
            $mensaje .= "   • {$pasajerosResumen}\n";
        } else {
            $mensaje .= "   • Adultos: {$reserva->adultos}\n";
            $mensaje .= "   • Niños: " . ($reserva->ninos ?? 0) . "\n";
        }

        if ($reserva->detalles) {
            $mensaje .= "\n💬 *Detalles adicionales:*\n{$reserva->detalles}";
        }

        return $mensaje;
    }
}

