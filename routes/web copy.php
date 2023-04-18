<?php

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;




/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
/*
Route::get('/', function () {
    return ['Laravel Stunt' => app()->version()];
});
*/

Route::redirect('/', '/login');

Auth::routes();

Route::get('/home2', [App\Http\Controllers\HomeController::class, 'index'])->name('home2');

Route::group(['prefix' => '/', 'as' => 'admin.', 'namespace' => 'App\Http\Controllers', 'middleware' => 'auth'], function () {


    Route::get('usuarios', 'UserController@index')->name('usuarios');
    Route::get('usuarios/registro', 'UserController@registerUsuarios')->name('usuarios/registro');
    Route::post('usuarios/editar', 'UserController@updateUsuarios')->name('usuarios/editar');
    Route::get('usuario/editar/{id}', 'UserController@UsuariosEdit')->name('usuario/editar');
    Route::delete('usuarios/eliminar', 'UserController@destroyUsuario')->name('usuarios/eliminar');
});



Route::group(['middleware' => 'auth'], function () {

    Route::get('/', function () {

        if (Auth::user()->rol == 1) {

            return redirect('/usuarios');
        } else {

            return redirect('/home2');
        }
    })->name('/');
});


