<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdController;
use App\Http\Controllers\WelcomeController;
use App\Http\Controllers\ContactoController;
use Illuminate\Support\Facades\Auth;

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

Route::resource('ads', AdController::class);
Route::delete('/ads/purgue', [AdController::class, 'purgue'])
    ->name('ads.purgue');

Route::get('/ads/{bike}/restore', [AdController::class, 'restore'])
    ->name('ads.restore');

Route::get('/', [WelcomeController::class, 'index'])
->name('portada');

Route::get('/ads/search', [AdController::class, 'search'])
    ->name('ads.search');


Route::get('ads/{bike}/delete', [AdController::class, 'delete'])
        ->name('ads.delete');

Route::get('/contacto', [ContactoController::class, 'index'])
    ->name('contacto');

Route::post('/contacto', [ContactoController::class, 'send'])
    ->name('contacto.email');


Auth::routes(['verify' => true]);

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
