<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

/* RUTAS DE LA API */

    /* METODOS HTTP COMUNES
        - GET: Conseguir datos o recursos
        - POST: Guardar datos o recursos o hacer logica desde un formulario
        - PUT: Actualizar datos o recursos
        - DELETE: Eliminar datos o recursos
    */
    Route::post('/user/register', 'App\Http\Controllers\UserController@register');
    Route::post('/user/login', 'App\Http\Controllers\UserController@login');
    Route::post('/user/update', 'App\Http\Controllers\UserController@update');


    // Rutas de prueba
    Route::get('/categoria', 'App\Http\Controllers\CategoryController@index');
    Route::get('/user', 'App\Http\Controllers\UserController@index');
    Route::get('/post', 'App\Http\Controllers\PostController@index');


/* RUTAS DE PRUEBA */
Route::get('/', function () {
    return 'Kaixo mundua!';
});

Route::get('/testORM', 'App\Http\Controllers\PruebasController@testORM');
Route::get('/pruebacontrollerindex', 'App\Http\Controllers\PruebasController@index');

