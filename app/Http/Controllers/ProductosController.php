<?php

namespace App\Http\Controllers;

use App\Models\Productos;
use Exception;
use Illuminate\Http\Request;

class ProductosController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {

            // throw new \Exception('error');

             $producto = Productos::all();
             $respuesta = $this -> get_response(
                $this -> respuesta_exitosa,
                 200,
                 $producto
             );

             return response()->json($respuesta,200);

         } catch (Exception $e) {

             $respuesta = $this -> get_response( // Ahora devuelve una respuesta JSON
                 $e->getMessage(),500,[]);
                 return response()-> json($respuesta, 500);
         }
    }

    /**
     * Store a newly created resource in storage.
     */
    //request trae los datos del cliente
    public function store(Request $request)
    {
        $data = $request->validate([
            'nombre' => 'required|string|max:50',
            'descripcion' => 'nullable|string|max:255',
            'precio' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
           'imagen' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:500'
        ]);

        if($request->hasFile('imagen')){
            $data['imagen'] = $request->file('imagen')->store('public/productos');
        }

        $reponse = Productos::create($data);

        return response()->json ($this->get_response("Se creo el producto de manera exitosa", 200, $reponse),200);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        try {
            $producto = Productos::findOrFail($id);

            $respuesta = $this -> get_response(
               $this -> respuesta_exitosa,
                200,
                $producto
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
