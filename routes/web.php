<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CardController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\DeckController;
use App\Http\Controllers\MainController;

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

Route::get('/', MainController::class)->name('main');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::resource('card', CardController::class);
Route::resource('categories', CategoryController::class);

Route::get('/deck', [DeckController::class, 'index'])->name('deck.index');
Route::post('/deck/{card}', [DeckController::class, 'addToDeck'])->name('deck.add');
Route::delete('/deck/{card}', [DeckController::class, 'removeFromDeck'])->name('deck.remove');
