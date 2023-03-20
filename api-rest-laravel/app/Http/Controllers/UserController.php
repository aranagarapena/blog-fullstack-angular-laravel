<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Helpers\AuthJWT;

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
                'email' => 'required|email|unique:users', // 2.1 Comprobar si el usuario existe (duplicado)
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
                // 3. Cifrar la contraseña
                $pwd = hash('sha256', $params->password);

                // 4. Creamos el usuario usando el modelo User
                $user = new User();
                $user->name = $params_array['name'];
                $user->surname = $params_array['surname'];
                $user->email = $params_array['email'];
                $user->password = $pwd;
                $user->role = 'ROLE_USER';
                // $user->description = $params_array['description'];

                // // 5. guardar el usuario en la base de datos
                if ($user->save()) {
                    
                    // El usuario se ha guardado correctamente                  
                    $res =array(
                        'status' => 'success',
                        'code' => 200,
                        'message' => 'Usuario registrado correctamente'
                    );
                } else {
                    // Ha ocurrido un error al guardar el usuario
                    $res =array(
                        'status' => 'error',
                        'code' => 500,
                        'message' => 'Debido a un error interno los datos no se han podido guardar, 
                            intentalo más tarde'
                    );
                }
                

            }

        }else{
            $res =array(
                'status' => 'error',
                'code' => 404,
                'message' => 'Los datos enviados están vacios'
            );
        }

        return response()->json($res, $res['code']);
    }

    public function login(Request $request){
        $jwtAuth = new \JWTAuth();

        // 1. Recibir los datos por POST
        $json = $request->input('json', null);
        $params = json_decode($json);
        $params_array = json_decode($json,true);

        // 2. Validar los datos
        $validate = \Validator::make($params_array, [
            'email' => 'required|email',
            'password' => 'required'
        ]);

        if($validate->fails()){
            $res =array(
                'status' => 'error',
                'code' => 404,
                'message' => 'El usuario no se ha podido identificar',
                'errors' => $validate->errors()
            );
        }else{
            // 3. Cifrar la contraseña
            $pwd = hash('sha256', $params->password);

            // 4. Devolver el token o datos
            if(empty($params->getToken) || filter_var($params->getToken, FILTER_VALIDATE_BOOLEAN)==false){ 
                return $jwtAuth->signup($params->email, $pwd);

            }else{
                return $jwtAuth->signup($params->email, $pwd, true); // si recibimos el parametro 'getToken = true' en la petición

            }
        }


    }

    public function update(Request $request){
        $token = $request->header('Authorization');
        $jwtAuth = new \JWTAuth();
        $checkToken = $jwtAuth->checkToken($token);

        // if(checkTokenFormat($token)){
            if($checkToken){
                return json_encode(array(
                    'status' => 'success',
                    'code' => 200,
                    'message' => 'Login Correcto',
                    'token' => $token
                    
                ));
            }else{
                return json_encode(array(
                    'status' => 'error',
                    'code' => 404,
                    'message' => 'Login Incorrecto',
                    'token' => $token
                    
                ));
            }
        // }else{
        //     return json_encode(array(
        //         'status' => 'error',
        //         'code' => 404,
        //         'message' => 'El token no tiene el formato correcto',
        //         'token' => $token           
        //     ));
        // }
    }

}
