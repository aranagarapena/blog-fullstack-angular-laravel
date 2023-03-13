<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{
    //
    public function index(Request $request){
        return "Hola mundo desde el controlador de usuarios - método INDEX";
    }

    public function register(Request $request){

        // 1. Recoger los datos del usuario por POST
        $json = $request->input('json', null); // Si no se recibe nada, se asigna null https://laravel.com/docs/4.2/requests
        $params = json_decode($json); // Objeto
        $params_array = json_decode($json,true); // Array asociativo

        // 2. Validar los datos si no esta vacio
        $res = "";

        if(!empty($params) && !empty($params_array)){

            $params_array = array_map('trim',$params_array);// Eliminar espacios en blanco

            $validate = \Validator::make($params_array, [
                'name' => 'required|alpha',
                'surname' => 'required|alpha',
                'email' => 'required|email|unique:users', // Comprobar si el usuario existe (duplicado)
                'password' => 'required'
            ]);

            if($validate->fails()){
                $res =array(
                    'status' => 'error',
                    'code' => 404,
                    'message' => 'Validación incorrecta, algún campo no cumple los requisitos',
                    'errors' => $validate->errors()
                );

            }else{
                $res =array(
                    'status' => 'success',
                    'code' => 200,
                    'message' => 'Usuario registrado correctamente'
                );
            }

        }else{
            $res =array(
                'status' => 'error',
                'code' => 404,
                'message' => 'Los datos enviados están vacios'
            );
        }

        return response()->json($res, $res['code']);


        // 3. Cifrar la contraseña
        // 4. Comprobar si el usuario existe (duplicado)
        // 5. Si no existe, guardar el usuario en la base de datos

        // $data =array(
        //     'status' => 'success',
        //     'code' => 200,
        //     'message' => 'Usuario registrado correctamente'
        // );
        

        // return response()->json($data, $data['code']);

        // return "Hola mundo desde el controlador de usuarios - método REGISTRO ".$name;
    }

    public function login(Request $request){
        return "Hola mundo desde el controlador de usuarios - método LOGIN";
    }

}
