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
        $name = $request->input('name');
        return "Hola mundo desde el controlador de usuarios - método REGISTRO ".$name;
    }

    public function login(Request $request){
        return "Hola mundo desde el controlador de usuarios - método LOGIN";
    }
}
