<?php

namespace App\Http\Controllers;

use App\Models\Actividad;
use App\Models\Noticia;
use App\Models\Cita;
use App\Models\MensajeContacto;
use App\Models\Trayectoria;

class DashboardController extends Controller
{
    /**
     * Mostrar dashboard según el tipo de usuario
     */
    public function __invoke()
    {
        // Si es admin (guard admin)
        if (auth('admin')->check()) {
            // Dashboard Admin
            $totalCitas = Cita::count();
            $citasPendientes = Cita::where('estado', 'pendiente')->count();
            $totalMensajes = MensajeContacto::count();
            $mensajesNoLeidos = MensajeContacto::where('leido', false)->count();
            $totalNoticias = Noticia::count();
            $totalActividades = Actividad::count();
            $totalTrayectorias = Trayectoria::count();

            $ultimasCitas = Cita::orderBy('created_at', 'desc')->limit(5)->get();
            $ultimosMensajes = MensajeContacto::orderBy('created_at', 'desc')->limit(5)->get();

            return view('admin.dashboard', compact(
                'totalCitas',
                'citasPendientes',
                'totalMensajes',
                'mensajesNoLeidos',
                'totalNoticias',
                'totalActividades',
                'totalTrayectorias',
                'ultimasCitas',
                'ultimosMensajes'
            ));
        } 
        // Si es usuario normal (guard web)
        else if (auth('web')->check()) {
            // Dashboard Usuario
            $misCitas = auth('web')->user()->citas()->orderBy('fecha_cita', 'desc')->get();
            $proximasActividades = Actividad::where('fecha', '>=', now())
                ->orderBy('fecha')
                ->limit(3)
                ->get();
            $ultimasNoticias = Noticia::where('publicado', true)
                ->orderBy('fecha_publicacion', 'desc')
                ->limit(3)
                ->get();

            return view('dashboard', compact('misCitas', 'proximasActividades', 'ultimasNoticias'));
        }

        // Redirect si no hay autenticación
        return redirect()->route('home');
    }
}
