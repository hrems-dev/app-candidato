<?php

namespace App\Http\Controllers;

use App\Models\Cita;
use App\Mail\CitaConfirmada;
use App\Mail\CitaRechazada;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class CitaController extends Controller
{
    /**
     * Mostrar formulario para solicitar cita
     */
    public function create()
    {
        return view('citas.create');
    }

    /**
     * Guardar nueva cita
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nombre' => 'required|string|max:255',
            'email' => 'required|email',
            'telefono' => 'required|string|max:20',
            'asunto' => 'required|string|max:500',
            'fecha_cita' => 'required|date_format:"Y-m-d H:i:s"|after_or_equal:now',
        ]);

        $validated['user_id'] = Auth::id();
        $validated['estado'] = 'pendiente';

        Cita::create($validated);

        return redirect()->route('dashboard')
            ->with('success', 'Cita solicitada correctamente. Espera la aprobación del administrador.');
    }

    /**
     * Ver mis citas (usuario)
     */
    public function misCitas()
    {
        $citas = Auth::user()->citas()->orderBy('fecha_cita', 'desc')->get();
        return view('citas.mis-citas', compact('citas'));
    }

    /**
     * Listar todas las citas (admin)
     */
    public function indexAdmin()
    {
        $citas = Cita::with('usuario')->orderBy('fecha_cita', 'desc')->paginate(10);
        return view('admin.citas.index', compact('citas'));
    }

    /**
     * Aprobar cita
     */
    public function aprobar(Cita $cita)
    {
        $cita->update(['estado' => 'confirmada']);

        // Enviar email de confirmación
        Mail::to($cita->email)->send(new CitaConfirmada($cita));

        return back()->with('success', 'Cita aprobada correctamente. Email enviado al usuario.');
    }

    /**
     * Rechazar cita
     */
    public function rechazar(Request $request, Cita $cita)
    {
        $validated = $request->validate([
            'razon_rechazo' => 'nullable|string|max:500',
        ]);

        $cita->update([
            'estado' => 'cancelada',
        ]);

        // Enviar email de rechazo
        Mail::to($cita->email)->send(new CitaRechazada($cita, $validated['razon_rechazo'] ?? ''));

        return back()->with('success', 'Cita cancelada correctamente. Email enviado al usuario.');
    }

    /**
     * Eliminar cita
     */
    public function destroy(Cita $cita)
    {
        $cita->delete();

        return back()->with('success', 'Cita eliminada correctamente');
    }
}
