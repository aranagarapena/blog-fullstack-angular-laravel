<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\User;
use App\Models\Category;

class PruebasController extends Controller
{
    // funcion de prueba para llamar al controlador y ver que carga
    public function index(){
        return "Hola mundo desde el controlador de pruebas";
    }

    // funcion de prueba para llamar a la BD y conseguir todos los datos
    public function testORM(){
        $this->getCategories();
        // $this-> getPosts();
        // $this-> getUsers();
        die();
    }

    // recueprar y pintar todos los posts de la BD
    private function getPosts(){
        foreach(Post::all() as $post){
            echo "<h1>{$post->title}</h1>";
            echo "<span style='color:gray;'>{$post->user->name} - {$post->category->name}</span>";
            echo "<p>{$post->content}</p>";
            echo "<hr>";
        }
    }

    // recueprar y pintar todas las categorias de la BD
    private function getCategories(){
        foreach(Category::all() as $category){
            echo "<h1>{$category->name}</h1>";
            foreach($category->posts as $post){
                echo "<h3>{$post->title}</h3>";
                echo "<p>{$post->content}</p>";
            }
            echo "<hr>";
        }
    }

    // recueprar y pintar todos los usuarios de la BD
    private function getUsers(){
        foreach(User::all() as $user){
            echo "<h1>{$user->name} {$user->surname}</h1>";
            foreach($user->posts as $post){
                echo "<h3>{$post->title}</h3>";
                echo "<p>{$post->content}</p>";
            }
            echo "<hr>";
        }
    }
}
