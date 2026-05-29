<?php

namespace App\Http\Controllers;

use App\Http\Requests\ReservaRequest;
use App\Models\Configuracion;
use App\Models\Hotel;
use App\Models\Reserva;

class ReservaController extends Controller
{
    public function index()
    {
        $reservas = Reserva::with('hotel')
            ->latest()
            ->paginate(20);

        return view('admin.reservas.index', compact('reservas'));
    }

    public function show(Reserva $reserva)
    {
        $reserva->load('hotel');
        return view('admin.reservas.mostrar', compact('reserva'));
    }

    public function store(ReservaRequest $request)
    {
        $datosValidados = $request->validated();
        $datosValidados['estado'] = 'pendiente';
        $pasajerosResumen = (string) ($datosValidados['pasajeros_resumen'] ?? '');
        unset($datosValidados['pasajeros_resumen']);

        $hotel = Hotel::query()
            ->with('marca:id,nombre')
            ->select(['id', 'nombre', 'marca_id', 'activo'])
            ->findOrFail($datosValidados['hotel_id']);

        $reserva = Reserva::create($datosValidados);

        $mensajeWhatsapp = $this->construirMensajeWhatsapp($reserva, $hotel, $pasajerosResumen);
        $configuracion = Configuracion::obtenerConfiguracion();
        $numeroWhatsapp = $configuracion->telefono_whatsapp;
        $urlWhatsapp = "https://wa.me/{$numeroWhatsapp}?text=" . urlencode($mensajeWhatsapp);

        return redirect()->away($urlWhatsapp);
    }

    private function construirMensajeWhatsapp(Reserva $reserva, Hotel $hotel, string $pasajerosResumen = ''): string
    {
        $mensaje = "🏨 *NUEVA SOLICITUD DE RESERVA DE HOTEL*\n\n";
        $mensaje .= "📋 *Hotel:* {$hotel->nombre}\n";
        $mensaje .= "🏷️ *Cadena/Marca:* " . ($hotel->marca?->nombre ?? 'Sin marca') . "\n\n";
        $mensaje .= "👤 *Cliente:* {$reserva->cliente_nombre}\n";
        $mensaje .= "🆔 *Documento:* {$reserva->cliente_documento}\n";
        $mensaje .= "📱 *WhatsApp:* +{$reserva->cliente_whatsapp}\n\n";
        $mensaje .= "📅 *Check-In:* {$reserva->fecha_inicio->format('d/m/Y')}\n";
        $mensaje .= "📅 *Check-Out:* {$reserva->fecha_fin->format('d/m/Y')}\n\n";
        $mensaje .= "👥 *Huéspedes:*\n";
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
