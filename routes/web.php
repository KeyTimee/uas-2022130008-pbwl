<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CardController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\DeckController;
use App\Http\Controllers\DeckCardsController;
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
Route::get('/', function () {
    return redirect()->route('login');
});

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/add', MainController::class)->name('main');

Auth::routes();

Route::resource('card', CardController::class);
Route::resource('categories', CategoryController::class);

Route::get('/decks/index', [DeckController::class, 'index'])->name('decks.index');
Route::post('/decks/create', [DeckController::class, 'create'])->name('decks.create');
Route::resource('decks', DeckController::class);

Route::get('/deck', [DeckCardsController::class, 'index'])->name('deckcards.index');
Route::post('/deck/{card}', [DeckCardsController::class, 'addToDeck'])->name('deckcards.add');
Route::delete('/deck/{card}', [DeckCardsController::class, 'removeFromDeck'])->name('deckcards.remove');
