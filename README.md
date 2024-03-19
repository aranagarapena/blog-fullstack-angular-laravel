# PROYECTO: "Proyecto de ejemplo de desarrollo FullStack. Programado utilizando Laravel y Angular"
**_Ambito_**: Proyecto de un blog, en el que el usuario puede registrarse, loguearse, crear posts, categorías, etc. y ver los posts de otros usuarios.

**_Alcance_**: En primera instancia, el usuario podrá registrarse, loguarse y acceder al blog. Además podrán ver los posts de otros usuarios. En un futuro, se podrán crear posts, categorías, etc.

**_Tencologías:_**: Proyecto en laravel y angular para un blog. Se realiza el Backend utilizando *Laravel* y el Frontend utilizando *Angular* 

**_Antes de empezar:_**
- Arrancar XAMPP
    - Apache y MySQL
    - Acceder a la URL de prueba para ver que el proyecto funciona correctamente:
        - http://lrvlapirest.com.devel/pruebacontrollerindex
        - IMPORTANTE: para acceder a esa URL hay que configurar un VHOST para que nos resuelva el dominio

## 1. Backend

Aquí podrías incluir una descripción breve de la sección 1.

### 1.1 Acceso a la WEB

#### 1.1.2 - Registro de Usuarios

URL --> http://lrvlapirest.com.devel/user/register

Hay que enviar un archivo JSON para testear las diferentes opciones de la API

- **Registro - Datos Incorrectos:** 

{ "name": "", "surname": "García", "email": "juangarcia@example.com", "password": "contraseña123" } 
- **Registro - Datos Correctos:** 
Hay que enviar un JSON con este formato de datos, introduciendo datos que no existan en la BD, si no va a fallar 

{ "name": "José", "surname": "Nuñez", "email": "jga@pruebas.com", "password": "contraseña123" } 
- **Rgistro - Formulario Vacio:** 
No enviamos nada


#### 1.1.3 - Login
URL --> http://lrvlapirest.com.devel/user/login

Hay que enviar un archivo JSON para testear las diferentes opciones de la API

-**Login - Datos Correctos - Token FALSE:**
 { "email": "maria.garcia@example.com", "password": "password2", "getToken":"false"}
-**Login - Datos Correctos - Token TRUE:** 
{ "email": "maria.garcia@example.com", "password": "password2", "getToken":"true"}

-**Login - Update - Correcto**:
URL -> http://lrvlapirest.com.devel/user/update

Hay que enviar varios parametros desde el cliente (para esta operación en cocreto uso Postman):

*Info del Usuario (tiene que existir un usuario así en la BD)*:
-json - { "name": "Iker", "surname": "Arana", "email": "iarana@birt.eus", "password": "1234" }
-contraseña cifrada - "03ac674216f3e15c761ee1a5e255f067953623c8b388b4459e13f978d7c846f4" 
-token --> jwtToken - "eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJlbWFpbCI6ImlhcmFuYUBiaXJ0LmV1cyIsIm5hbWUiOiJJa2VyIiwic3VybmFtZSI6IkFyYW5hIiwiaWF0IjoxNjgyMDgxMTc1LCJleHAiOjE3MTM2MTcxNzV9.lwVvcj5J_E-uq_ynoW9ZqjvUNKzQMboFv8io3KPsQ9U"

- En el "Body" enviamos el siguiente parametro:
    - Key:  **json** 
    - Value --> aquí insertamos el valor que queremos actualizar (de Iker a Ikertxu): { "name": "Ikertxu", "surname": "Arana", "email": "iarana@birt.eus", "password": "1234" }
- En la cabecera "Headers" hay que enviar dos parámetros:
    - Primero 
        -Key:  **"Authorization"** con un token válido de la BD, para poder actualizar los datos del usuario en cuestion: 
        - Value: Token valido para los datos =  "eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJlbWFpbCI6Im1hcmlhLmdhcmNpYUBleGFtcGxlLmNvbSIsIm5hbWUiOiJNYXJcdTAwZWRhIiwic3VybmFtZSI6IkdhcmNcdTAwZWRhIiwiaWF0IjoxNjc5MzE3MTE3LCJleHAiOjE2Nzk5MjE5MTd9.1vBzbjoWeBH8BAHes7U2nddpt2Wxuh4XvbVI7lihW7k" 
    - Segundo:
        - Key: **"Content-Type"** 
        - Value: con el valor "application/x-www-form-urlencoded"

El token lleva toda la información cifrada de un determinado usuario, lo podemos enviar bien o mal formado para ver si el usuario se registra correctamente o no

## 2. Frontend

json - { "name": "Iker", "surname": "Arana", "email": "iarana@birt.eus", "password": "1234" }
contraseña cifrada - "03ac674216f3e15c761ee1a5e255f067953623c8b388b4459e13f978d7c846f4" 
token --> jwtToken - "eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJlbWFpbCI6ImlhcmFuYUBiaXJ0LmV1cyIsIm5hbWUiOiJJa2VyIiwic3VybmFtZSI6IkFyYW5hIiwiaWF0IjoxNjgyMDgxMTc1LCJleHAiOjE3MTM2MTcxNzV9.lwVvcj5J_E-uq_ynoW9ZqjvUNKzQMboFv8io3KPsQ9U"


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

 
