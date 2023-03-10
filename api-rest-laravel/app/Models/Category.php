<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;
    protected $table = 'categories';
    
    /*
        Metodo que devuelve todos los posts de una categoria
    */
    public function posts(){
        // En este caso, la relación está definida en el modelo Category. Esta relación indica que una categoría puede tener muchos posts.
        // El método hasMany se utiliza para definir una relación uno-a-muchos. Recibe como parámetros el nombre de la clase modelo que representa los objetos relacionados y, opcionalmente, los nombres de las claves foráneas personalizadas.
        return $this->hasMany('App\Models\Post');
    }
}
