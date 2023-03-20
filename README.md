# PROYECTO: "full-stack-lrvl-ng"
Proyecto en laravel y angular para un blog. Se realiza el Backend utilizando *Laravel* y el Frontend utilizando *Angular* 

## 1. Backend

Aquí podrías incluir una descripción breve de la sección 1.

### 1.1 Acceso a la WEB

#### 1.1.2 - Registro de Usuarios

URL --> http://lrvlapirest.com.devel/user/register

Hay que enviar un archivo JSON para testear las diferentes opciones de la API

- Datos Incorrectos: { "name": "", "surname": "García", "email": "juangarcia@example.com", "password": "contraseña123" } 
- Datos Correctos: { "name": "José", "surname": "Nuñez", "email": "jga@pruebas.com", "password": "contraseña123" } 
- Formulario Vacio: No enviamos nada


#### 1.1.3 - Login
URL --> http://lrvlapirest.com.devel/user/login

Hay que enviar un archivo JSON para testear las diferentes opciones de la API

- Datos Correctos - Token FALSE: { "email": "maria.garcia@example.com", "password": "password2", "getToken":"false"}
- Datos Correctos - Token TRUE: { "email": "maria.garcia@example.com", "password": "password2", "getToken":"true"}


URL -> http://lrvlapirest.com.devel/user/update

Hay que enviar un parámetro "Authorization" en la cabecera "Headers", con el token: 
"eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJlbWFpbCI6Im1hcmlhLmdhcmNpYUBleGFtcGxlLmNvbSIsIm5hbWUiOiJNYXJcdTAwZWRhIiwic3VybmFtZSI6IkdhcmNcdTAwZWRhIiwiaWF0IjoxNjc5MzE3MTE3LCJleHAiOjE2Nzk5MjE5MTd9.1vBzbjoWeBH8BAHes7U2nddpt2Wxuh4XvbVI7lihW7k" 

El token lleva toda la información cifrada de un determinado usuario, lo podemos enviar bien o mal formado para ver si el usuario se registra correctamente o no

## 2. Frontend



###### URLs de Prueba - ENDPOINTS
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

 
