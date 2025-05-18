<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class ClienteMiddleware
{
    public function handle(Request $request, Closure $next): Response
    {
        if (!Auth::check() && Auth::user()->role !== 'cliente') {
            abort(403, 'Acceso denegado.');
        }
        // Obtener el objeto Cita desde la ruta
        // Si en URL viene: localhost/citas/clientes/3 recoge ese 3 y obtiene el objeto
        $cita = $request->route('cita');

        // Comprueba que la cita existe y el id de cliente coincide con el del usuario autenticado
        // Lo hace con método user() del modelo Cita (devuelve Usuario dueño de la cita) y se accede a su campo id
        // También se puede haciendo $cita->cliente_id (accediendo al campo del objeto Cita directamente)
        if(!$cita || $cita->user->id !== Auth::id())
        {
            abort(403, 'No tiene acceso a la cita solicitada');
        }
        return $next($request);
    }
}
