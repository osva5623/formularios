<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;


use Illuminate\Support\Facades\Http; // Para consumir API

class formulariosController extends Controller
{

    public function index(Request $request)
    {
        $usuario = $request->query('user_id');
        $token = $request->query('token');
        try {
            // Consumir el endpoint de FastAPI
            $response = Http::get("https://e1c655a56504.ngrok-free.app/user/{$usuario}");

            if ($response->successful()) {
                $user = $response->json();
                return view('InfoExistente',  [
                    'user' => [
                        'id' => $user['id'],
                        'user_id' => $user['user_id'],
                        'nombre' => $user['nombre'],
                        'apellido_p' => $user['apellido_p'],
                        'apellido_m' => $user['apellido_m'],
                        'correo' => $user['correo'],
                        'fecha_nacimiento' => $user['fecha_nacimiento'],
                        'created_at' => $user['created_at'],
                    ]
                ]);
                // Si el usuario existe -> mostrar vista con datos
                
            }

            // Si la API responde 404 -> mostrar template de "no encontrado"
            if ($response->status() === 404) {
                
                return view('formularios',compact('usuario'));
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
