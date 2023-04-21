<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Helpers\AuthJWT;
use Illuminate\Support\Facades\Validator;


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

            $validate = Validator::make($params_array, [
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
                // $user->description = $params_array['description']; //TODO: Añadir campo description a la tabla users

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
        $jwtAuth = new AuthJWT();

        // 1. Recibir los datos por POST
        $json = $request->input('json', null);
        $params = json_decode($json);
        $params_array = json_decode($json,true);

        // 2. Validar los datos
        $validate = Validator::make($params_array, [
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

        // 1. Comprobar si el usuario está identificado
        $token = $request->header('Authorization');
        $jwtAuth = new AuthJWT();
        $checkToken = $jwtAuth->checkToken($token);

        // pruebas
        $json = $request->input('json', null); // cogemos la variable 'json' que me llega por PUT
        $params_array = json_decode($json,true);

            if($checkToken && !empty($params_array)){

                // 2. Actulizar el usuario
                $res = array(
                    'status' => 'success',
                    'code' => 200,
                    'message' => 'Login Correcto',
                    'token' => $token
                    
                );

                // sacar el usuario que se ha identificado
                $user = $jwtAuth->checkToken($token, true);
                // var_dump($user);
                // die();

                // 2.1 Recoger los datos por POST
                $json = $request->input('json', null); // cogemos la variable 'json' que me llega por POST
                $params_array = json_decode($json,true);

                // 2.2 Validar los datos
                $validate = Validator::make($params_array, [
                    'name' => 'required|alpha',
                    'surname' => 'required|alpha',
                    'email' => 'required|email|unique:users'
                ]);

                // 2.3 Quitar los datos que no quiera actualizar
                // auqnue me llegue una petición para actualizar estos campos, no los actualizaremos
                unset($params_array['id']);
                unset($params_array['role']);
                unset($params_array['password']);
                unset($params_array['created_at']);
                unset($params_array['remember_token']);

                // 2.4 Actualizar el usuario en la base de datos
                $user_update = User::where('email', $user->email)->update($params_array);

                // 2.5 Devolver el array con los resultados
                $res = array(
                    'status' => 'success',
                    'code' => 200,
                    'message' => 'Usuario actualizado correctamente',
                    'user' => $user_update,
                    'changes' => $params_array
                );
            }else{
                // si el usuario no está identificado
                $res =array(
                    'status' => 'error',
                    'code' => 400,
                    'message' => 'El usuario no está identificado',
                    'token' => $token
                    
                );
            }

        // convertimos a json y devolvemos la respuesta 
        return response()->json($res, $res['code']);
    }

}
