<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;
    protected $respuesta_exitosa = "Respuesta exitosa";

    public function get_response($message, $estado, $data)
    {
        return [
        "estado" => $estado,
        "mensaje"=> $message,
        "data" => $data
        ];

    }
}
