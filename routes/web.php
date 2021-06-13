<?php

use App\Http\Controllers\MoviesController;
use App\Http\Controllers\TvController;
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

Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('login', 'Auth\LoginController@login');
Route::post('logout', 'Auth\LoginController@logout')->name('logout');

// Registration Routes...
Route::get('register', 'Auth\RegisterController@showRegistrationForm')->name('register');
Route::post('register', 'Auth\RegisterController@register');


Route::get('/list', function () {
    return view('list');
})->name('list');



Route::get('movies/{page?}', [MoviesController::class, 'index'])->name('movies');
Route::get('/movie/{id}', [MoviesController::class, 'show']);
Route::get('tv_shows/{page?}', [TvController::class, 'index'])->name('tv_shows');
Route::get('/tv_show/{id}', [TvController::class, 'show']);

Route::get('/', function () {
    return redirect()->route('movies');
});
// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth'])->name('dashboard');

require __DIR__.'/auth.php';
