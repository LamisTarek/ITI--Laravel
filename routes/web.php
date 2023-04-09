<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use Laravel\Socialite\Facades\Socialite;
use App\Models\User;


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




Route::get('/auth/redirect', function () {
    return Socialite::driver('github')->stateless()->redirect();
});

Route::get('/auth/google/redirect', function () {
    return Socialite::driver('google')->stateless()->redirect();
});



Route::get('/auth/callback', function () {

    $user = Socialite::driver('github')->stateless()->user();
    // dd($user);
    $githubUser = Socialite::driver('github')->user();

    $user = User::updateOrCreate([
        'github_id' => $githubUser->id,
    ], [

        'name' => $githubUser->name,
        'email' => $githubUser->email,
        'password'=>bcrypt('12345678'),
        'github_id'=>  $githubUser->id,
        'github_token' => $githubUser->token,
        'github_refresh_token' => $githubUser->refreshToken,
    ]);

    Auth::login($user);

    return redirect('/');
});

Route::get('/auth/google/callback', function () {

    $user = Socialite::driver('google')->stateless()->user();
    // dd($user);
    $googleUser = Socialite::driver('google')->user();

    $user = User::updateOrCreate([
        'google_id' => $googleUser->id,
    ], [

        'name' => $googleUser->name,
        'email' => $googleUser->email,
        'password'=>bcrypt('12345678'),
        'google_id'=>  $googleUser->id,
        'google_token' => $googleUser->token,
        'google_refresh_token' => $googleUser->refreshToken,
    ]);

    Auth::login($user);

    return redirect('/');
});