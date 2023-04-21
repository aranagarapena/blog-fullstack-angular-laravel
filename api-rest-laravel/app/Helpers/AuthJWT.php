<?php
namespace App\Helpers;

use Firebase\JWT\JWT;
use Illuminate\Support\Facades\DB;
use App\Models\User;

class AuthJWT
{

    const KEY = 'clave_secreta';

    /**
     * Realiza la autenticación de un usuario a partir de su correo electrónico y contraseña,
     * generando un token JWT que contiene los datos del usuario identificado.
     *
     * @param string $email Correo electrónico del usuario
     * @param string $password Contraseña del usuario
     * @param boolean $getToken (opcional) Si se debe devolver el token generado o los datos decodificados (por defecto, el token)
     * 
     * @return mixed Si $getToken es false (o nulo), devuelve el token JWT generado. Si $getToken es true, devuelve los datos decodificados del token.
     * Si las credenciales son incorrectas, devuelve un mensaje de error.
     */
    public function signup ($email, $password, $getToken = null){

        // 1. Buscar si existe el usuario con sus credenciales
        $user = User::where([
            'email' => $email,
            'password' => $password
        ])->first();

        // 2. Comprobar si las credenciales son correctas
        $signup = false;
        if(is_object($user)){
            $signup = true;
        }

        // 3. Generar el token con los datos del usuario identificado
        if($signup){
            $token = array(
                'email' => $user->email,
                'name' => $user->name,
                'surname' => $user->surname,
                'iat' => time(), // cuando se creo el token
                'exp' => time() + (365 * 24 * 60 * 60) // cuando caducara el token
            );
            
            $jwtToken = JWT::encode($token,self::KEY,'HS256');

            if(is_null($getToken)){
                return $jwtToken;
            }else{
                $res = JWT::decode($jwtToken,self::KEY,['HS256']);
                return $res;
            }

        }else{
            $res =array(
                'status' => 'error',
                'message' => 'Login incorrecto'
            ); 
        }

        // 4. Devolver los datos decodificados o el token, en funcion de un parametro
        return $res;
        
    }

    /**
     * Comprueba la validez de un token JWT
     *
     * @param string $jwtToken El token JWT a comprobar
     * @param bool $getIdentity Si se establece en true, devuelve el objeto JWT decodificado en lugar de un valor booleano
     *
     * @return mixed Devuelve un valor booleano que indica si el token es válido o no, o el objeto JWT decodificado si se especificó $getIdentity como true
     */
    public function checkToken($jwtToken, $getIdentity = false){
        $auth = false;

        try{
            $jwt = JWT::decode($jwtToken,self::KEY,['HS256']);
        }catch(\UnexpectedValueException $e){
            $auth = false;
        }catch(\DomainException $e){
            $auth = false;
        }

        if(!empty($jwt) && is_object($jwt) && isset($jwt->email)){
            $auth = true;
        }else{
            $auth = false;
        }

        if($getIdentity){
            return $jwt;
        }
        if(true){}

        return $auth;
    }

}