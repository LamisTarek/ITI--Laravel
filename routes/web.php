<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;

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

// Route::get('/', function () {
//     return view('welcome');
// });
// Route::get('/test', [PostController::class, 'test']);

//Finish The page UI
//1- route to show the page that lists the posts
//2- view to render the html
//3- Controller to render the view
Route::group(['middleware' => ['auth']], function () {
    Route::get('/posts', [PostController::class, 'index'])->name('posts.index');
    Route::get('/', [PostController::class, 'index'])->name('posts.index');
    Route::get('/posts/create', [PostController::class, 'create'])->name('posts.create');
    Route::get('/posts/{post}/edit', [PostController::class, 'edit'])->name('posts.edit');
    Route::post('/posts', [PostController::class, 'store'])->name('posts.store');
    Route::put('/posts/{post}', [PostController::class, 'update'])->name('posts.update');
    Route::get('/posts/{post}', [PostController::class, 'show'])->name(name:'posts.show');
    Route::delete('/posts/{id}', [PostController::class, 'destroy'])->name(name:'posts.destroy');
    Route::post('/posts/c', [PostController::class, 'storeComment'])->name(name:'posts.storeComment');
});


Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');