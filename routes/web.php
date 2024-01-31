<?php

use App\Http\Controllers\ArticleController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\ContactsController;
use App\Http\Controllers\FilmController;
use App\Http\Controllers\PhotoController;
use App\Http\Controllers\WelcomeController;
use App\Http\Controllers\UsersController;

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


// Route::get('/', function () {
//    return view('welcome');
//});


//Route::get('{n}', function($n) {
//    return 'Je suis la page ' . $n . ' !';
//})->where('n','[1-3]');

Route::get('/', [WelcomeController::class, 'index'])->name('home');
Route::get('article/{n}', [ArticleController::class, 'show'])->where('n', '[0-9]+');

Route::get('facture/{n}', function($n) {
    return view('facture')->with('num', $n);
})->where('n', '[0-9]+');


Route::get('users', [UsersController::class, 'create']);
Route::post('users', [UsersController::class, 'store']);

Route::get('contact', [ContactController::class, 'create']);
Route::post('contact', [ContactController::class, 'store']);

Route::get('photo', [PhotoController::class, 'create']);
Route::post('photo', [PhotoController::class, 'store']);

Route::get('contact', [ContactsController::class, 'create'])->name('contact.create');
Route::post('contact', [ContactsController::class, 'store'])->name('contact.store');

Route::resource('films', FilmController::class);

Route::controller(FilmController::class)->group(function () {
    Route::delete('films/force/{id}', 'forceDestroy')->name('films.force.destroy');
    Route::put('films/restore/{id}', 'restore')->name('films.restore');
    Route::get('category/{slug}/films', 'index')->name('films.category');
    Route::get('actor/{slug}/films', 'index')->name('films.actor');
});

