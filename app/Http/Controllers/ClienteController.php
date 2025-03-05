<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use Exception;
use Illuminate\Http\Request;

class ClienteController extends Controller
{


    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try{

            $cliente = Cliente::all();
            $respuesta = $this ->get_response(
                $this -> respuesta_exitosa,
                200,
                $cliente
            );

            return response()->json($respuesta,200);

        }catch(Exception $e){
            $respuesta = $this -> get_response( // Ahora devuelve una respuesta JSON
                $e->getMessage(),500,[]);
                return response()-> json($respuesta, 500);

        }
    }

    /**
     * Store a newly created resource in storage./para crear
     */
    public function store(Request $request)
    {
        try {
            $data = $request->validate([
                'nombre' => 'required|string|max:50',
                'apellido' => 'required|string|max:60',
                'ruc' => 'required|string',
                'razon_social' => 'required|string|max:100',
                'email' => 'nullable|string',
                'fecha_nacimiento' => 'nullable|string',
                'direccion' => 'nullable|string|max:255',
                'telefono' => 'nullable|string|max:255'
            ]);

            $cliente = Cliente::create($data);

            return response()->json($this->get_response(
                'Registro exitoso', //Se pasa el mensaje correctamente
                200, // Código HTTP de éxito
                $cliente // Se envía la empresa creada
            ), 200);

        } catch (\Exception $e) {
            return response()->json($this->get_response(
                $e->getMessage(), // Mensaje de error
                500, // Código HTTP de error
                [] // retorna vacio
            ), 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        try {
            $cliente = Cliente::findOrFail($id);

            $respuesta = $this -> get_response(
               $this -> respuesta_exitosa,
                200,
                $cliente
            );

            return response()->json($respuesta);

        } catch (Exception $e) {

            return response()->json([ // Ahora devuelve una respuesta JSON
                "error" => true,
                "estado" => 500, // Se añade un código de estado HTTP
                "mensaje" => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
