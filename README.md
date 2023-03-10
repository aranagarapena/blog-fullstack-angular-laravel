# full-stack-lrvl-ng
Proyecto en laravel y angular para un blog 

### URLs de Prueba - ENDPOINTS
/* RUTAS DE LA API */

    /* METODOS HTTP COMUNES
        - GET: Conseguir datos o recursos
        - POST: Guardar datos o recursos o hacer logica desde un formulario
        - PUT: Actualizar datos o recursos
        - DELETE: Eliminar datos o recursos
    */
    Route::post('/user/register', 'App\Http\Controllers\UserController@register');
    Route::post('/user/login', 'App\Http\Controllers\UserController@login');


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
