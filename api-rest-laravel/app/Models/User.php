<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'surname',
        'description',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /*
        Metodo que devuelve todos los posts de una categoria
    */
    public function posts(){
        // En este caso, la relación está definida en el modelo Category. Esta relación indica que una categoría puede tener muchos posts.
        // El método hasMany se utiliza para definir una relación uno-a-muchos. Recibe como parámetros el nombre de la clase modelo que representa los objetos relacionados y, opcionalmente, los nombres de las claves foráneas personalizadas.
        return $this->hasMany('App\Models\Post');
    }


}
