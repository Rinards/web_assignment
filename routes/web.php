<?php

use App\Http\Controllers\MoviesController;
use App\Http\Controllers\TvController;
use App\Http\Controllers\MovieListController;
use App\Http\Controllers\MovieListingController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\WatchingController;
use App\Models\MovieListing;
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

// Home route
Route::get('/', function () {
    return redirect()->route('movies');
});

// USER ROUTES
Route::get('users', [UserController::class, 'index'])->name('users');
Route::get('users/destroy', [UserController::class, 'destroy'])->name('users.destroy');

// MOVIE ROUTES
Route::get('movies/{page?}', [MoviesController::class, 'index'])->name('movies');
Route::get('movie/{id}', [MoviesController::class, 'show']);

// TV ROUTES
Route::get('tv_shows/{page?}', [TvController::class, 'index'])->name('tv_shows');
Route::get('tv_show/{id}', [TvController::class, 'show']);

// LIST ROUTES
Route::get('list', [MovieListController::class, 'index'])->name('list');
Route::get('list/create/{listing_id}', [MovieListController::class, 'create'])->name('list.create');
Route::post('list/edit/{listing_id}', [MovieListController::class, 'edit'])->name('list.edit');

// LISTING ROUTES
Route::get('listing/{listing_id}', [MovieListingController::class, 'show'])->name('listing.show');
Route::post('listing/create/{type}', [MovieListingController::class, 'create'])->name('listing.create');
Route::post('listing/destroy/{listing_id}', [MovieListingController::class, 'destroy'])->name('listing.destroy');

// WATCHING ROUTES
Route::post('watching/create/{listing_id}', [WatchingController::class, 'create'])->name('watching.create');
Route::post('watching/show/{listing_id}', [WatchingController::class, 'show'])->name('watching.show');
Route::post('watching/edit/{listing_id}', [WatchingController::class, 'edit'])->name('watching.edit');
Route::get('watching/destroy/{listing_id}', [WatchingController::class, 'destroy'])->name('watching.destroy');
Route::get('watching/{listing_id}', [WatchingController::class, 'show']);

require __DIR__ . '/auth.php';
