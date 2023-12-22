<?php

use App\Http\Controllers\CrudController;
use App\Http\Controllers\RegisterController;
use App\Models\User;
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

Route::get('/', [CrudController::class, 'index']);
Route::post('/register', [RegisterController::class, 'index'])->name('register');
Route::post('/competition', [CrudController::class, 'storeCompetition']);
Route::post('/round', [CrudController::class, 'storeRound']);

//Route::resource('competition', CrudController::class);
