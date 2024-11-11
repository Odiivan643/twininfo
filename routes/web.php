<?php

use App\Http\Controllers\TwinController;
use App\Http\Requests\PostController;
use App\Models\Post;
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


Route::get('/' , [TwinController::class, 'home'])->name('home');


// Route pour afficher les données du formulaire d'inscription
Route::get('/inscription', [TwinController::class, 'index'])->name('inscription')->middleware('guest');
// Route pour traiter les données du formulaire d'inscriptionn 
Route::post('/inscription/save', [TwinController::class, 'store'])->name('inscription.store');
// Route pour afficher les données du formulaire de connexion
Route::get('/connexion' , [TwinController::class, 'connexion'])->name('connexion')->middleware('guest');
// Route pour traiter les données du formulaire de connexion
Route::post('/authenticate/save' , [TwinController::class , 'authenticate'])->name('authenticate') ;



 


Route::prefix('admin')->name('admin.')->group(function(){

    //Get Posts datas
    Route::get('/posts', 'App\Http\Controllers\PostController@index')->name('post.index');

    //Show Post by Id
    Route::get('/posts/show/{id}', 'App\Http\Controllers\PostController@show')->name('post.show');

    //Get Posts by Id
    Route::get('/posts/create', 'App\Http\Controllers\PostController@create')->name('post.create');

    //Edit Post by Id
    Route::get('/posts/edit/{id}', 'App\Http\Controllers\PostController@edit')->name('post.edit');

    //Save new Post
    Route::post('/posts/store', 'App\Http\Controllers\PostController@store')->name('post.store');

    //Update One Post
    Route::put('/posts/update/{post}', 'App\Http\Controllers\PostController@update')->name('post.update');

    //Update One Post Speedly
    Route::put('/posts/speed/{post}', 'App\Http\Controllers\PostController@updateSpeed')->name('post.update.speed');

    //Delete Post
    Route::delete('/posts/delete/{post}', 'App\Http\Controllers\PostController@delete')->name('post.delete');

});
Route::prefix('admin')->name('admin.')->group(function(){

    //Get Users datas
    Route::get('/users', 'App\Http\Controllers\UserController@index')->name('user.index');

    //Show User by Id
    Route::get('/users/show/{id}', 'App\Http\Controllers\UserController@show')->name('user.show');

    //Get Users by Id
    Route::get('/users/create', 'App\Http\Controllers\UserController@create')->name('user.create');

    //Edit User by Id
    Route::get('/users/edit/{id}', 'App\Http\Controllers\UserController@edit')->name('user.edit');

    //Save new User
    Route::post('/users/store', 'App\Http\Controllers\TwinController@store')->name('user.store');

    //Update One User
    Route::put('/users/update/{user}', 'App\Http\Controllers\UserController@update')->name('user.update');

    //Update One User Speedly
    Route::put('/users/speed/{user}', 'App\Http\Controllers\UserController@updateSpeed')->name('user.update.speed');

    //Delete User
    Route::delete('/users/delete/{user}', 'App\Http\Controllers\UserController@delete')->name('user.delete');

});