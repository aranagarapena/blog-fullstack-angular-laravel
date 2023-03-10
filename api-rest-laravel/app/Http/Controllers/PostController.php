<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PostController extends Controller
{
    //    //
    public function index(Request $request){
        return "Hola mundo desde el controlador de posts";
    }
}
