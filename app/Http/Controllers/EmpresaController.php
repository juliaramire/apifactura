<?php

namespace App\Http\Controllers;

use App\Models\Empresa;
use Exception;
use Illuminate\Http\Request;
use PhpParser\Node\Stmt\TryCatch;
use PHPUnit\Event\Code\Throwable;

class EmpresaController extends Controller
{

private $respuesta_exitosa = "Respuesta exitosa";
protected $respuesta_error = "Ocurrio un error inesperado, consulte con soporte";


    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        try {

           // throw new \Exception('error');

            $empresa = Empresa::all();
            $respuesta = $this -> get_response(
               $this -> respuesta_exitosa,
                200,
                $empresa
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
        //metodo store es para guardar datos
        //paso uno validar datos que el cliente nos envia
        public function store(Request $request)
        {
            try {
                $data = $request->validate([
                    'nombre' => 'required|string|max:50',
                    'ruc' => 'required|string',
                    'razon_social' => 'required|string|max:100',
                    'direccion' => 'nullable|string|max:255',
                    'telefono' => 'nullable|string|max:255'
                ]);

                $empresa = Empresa::create($data); //Asegurar que esta línea termina en ";"

                return response()->json($this->get_response(
                    'Registro exitoso', //Se pasa el mensaje correctamente
                    200, // Código HTTP de éxito
                    $empresa // Se envía la empresa creada
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
     * Display the specified resource. Sirve para buscar por el numero de id
     */
    public function show(string $id)
{
    try {
        $empresa = Empresa::findOrFail($id);

        $respuesta = $this -> get_response(
           $this -> respuesta_exitosa,
            200,
            $empresa
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
        try{
            $data = $request->validate([
                'nombre' => 'required|string|max:50',
                'ruc' => 'required|string',
                'razon_social' => 'required|string|max:100',
                'direccion' => 'nullable|string|max:255',
                'telefono' => 'nullable|string|max:255'
            ]);

            $empresa = Empresa::findOrFail($id);
            $empresa->update($data);

            return response()->json(
                $this->get_response(
                    $this->respuesta_exitosa,
                    200,
                    $empresa
                )
            );

        }catch(Exception $e){
            return $this ->get_response(
                $e->getMessage(),
                503,
                []
            );

        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, string $id)
    {
        try{

            $empresa = Empresa::findOrFail($id);
            $empresa->delete();

            return response()->json(
                $this->get_response(
                    "Eliminado correctamente".$id,
                    200,
                    $empresa
                )
            );

        }catch(Exception $e){
            //simpre se debe ertornar, o queda de forma infitnita
            return $this ->get_response(
                $e->getMessage(),
                503,
                []
            );

        }

    }
}
