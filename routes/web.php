<?php

use App\Http\Controllers\ComentarioController;
use App\Http\Controllers\FollowerController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ImagenController;
use App\Http\Controllers\LikeController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\LogoutController;
use App\Http\Controllers\PerfilController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\RegisterController;

// Route::get('/', function () {
//     return view('auth.login'); //ROUTING CLOCESHURE
// });

Route::get('/', HomeController::class)->name('home');


Route::get('/home', HomeController::class)->name('home'); //COMO EL CONTROLADOR TIENE UN SOLO METODO Y ES __invoke NO HACE FALTA DEFINIR LA FUNCIÓN, NI UTILIZAR EL ARRAY

Route::get('/register',  [RegisterController::class, 'index'])->name('register');
Route::post('/register', [RegisterController::class, 'store']);//->name('register'); //NO HARIA FALTA PONER EL NAME YA QUE TOMA EL ANTERIOR SIEMPRE Y CUANDO ES LA MISMA URL. TAMBIEN SE QUITA SINO SAIL ARTISAN ROUTE:CACHE FALLA AL LIMPIAR


//Route::get('/login',  [RegisterController::class, 'index'])->name('login'); //EJEMPLO REDIRIGIAR A CUALQUIER VISTA UTILIZANDO login

Route::get('/login', [LoginController::class, 'index'])->name('login');
Route::post('/login', [LoginController::class, 'store']);// ->name('login'); IGUAL QUE ARRIBA

//HACER UN LOGOUT A UN USUARIO
Route::post('/logout', [LogoutController::class, 'store'])->name('logout');


//PERFIL
//SE EVITA PONER EL USERNAME EN LA URL, EL BOTON DE LAPIZ YA NO NECESITA ENVIAR EL USER
Route::get('/editar-perfil', [PerfilController::class, 'index'])->name('perfil.index');
Route::post('/editar-perfil', [PerfilController::class, 'store'])->name('perfil.store');

// Route::get('/muro', [PostController::class, 'index'])->name('post.index');
//Route model binding. Envia el modelo a la clase index para obtener los datos del usuario Utiliza el nombre del usuario en la url.
//localhost/rodrigo
Route::get('/{user:username}', [PostController::class, 'index'])->name('post.index'); 

Route::get('/post/create', [PostController::class, 'create'])->name('post.create');
Route::post('/post', [PostController::class, 'store'])->name('post.store');

Route::delete('/post/{post}', [PostController::class,'destroy'])->name('post.destroy');

//GUARDAR IMAGEN
Route::post('/imagenes', [ImagenController::class, 'store'])->name('imagenes.store');

//LIKES
Route::post('/post/{post}/likes', [LikeController::class, 'store'])->name('post.likes.store');
Route::delete('/post/{post}/likes', [LikeController::class, 'destroy'])->name('post.likes.destroy');

//PERFIL
//ASI FUNCIONA, PERO SE PUEDE EVITAR USAR EL USER NAME BORRANDOLO, PARA ESTO HAY Q SUBIR LOS ROUTES SINO BUSCAR ROUTE CON USER NAME PRIMERO, SE DEJAN COPIAS MÁS ARRIBA
// Route::get('/{user:username}/editar-perfil', [PerfilController::class, 'index'])->name('perfil.index');

// Route::post('/{user:username}/editar-perfil', [PerfilController::class, 'store'])->name('perfil.store');


Route::get('/{user:username}/post/{post}', [PostController::class, 'show'])->name('post.show');
Route::post('/{user:username}/post/{post}', [ComentarioController::class, 'store'])->name('comentarios.store');

//SIGUIEN USUARIO
Route::post('/{user:username}/follow', [FollowerController::class, 'store'])->name('user.follow');
Route::delete('/{user:username}/unfollow', [FollowerController::class, 'destroy'])->name('user.unfollow');