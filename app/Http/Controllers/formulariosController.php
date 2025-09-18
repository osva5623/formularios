<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;


use Illuminate\Support\Facades\Http; // Para consumir API

class formulariosController extends Controller
{

    public function index($usuario)
    {
        try {
            // Consumir el endpoint de FastAPI
            $response = Http::get("https://e1c655a56504.ngrok-free.app/user/{$id}");

            if ($response->successful()) {
                $user = $response->json();

                // Si el usuario existe -> mostrar vista con datos
                return view('formularios',compact('usuario'));
            }

            // Si la API responde 404 -> mostrar template de "no encontrado"
            if ($response->status() === 404) {
                return view('InfoExistente');
            }

            // Otros errores (500, etc.)
            return response()->json([
                'error' => 'Error al consultar el servicio externo',
                'status' => $response->status()
            ], 500);

        } catch (\Exception $e) {
            // Error de conexión u otra excepción
            return response()->json([
                'error' => 'No se pudo conectar con el servicio',
                'message' => $e->getMessage()
            ], 500);
        }

        
        
    }

}
