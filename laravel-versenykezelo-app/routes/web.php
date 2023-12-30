<?php

use App\Http\Controllers\CrudController;
use App\Http\Controllers\RegisterController;
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

Route::get('/', [CrudController::class, 'index'])->name('home');
Route::get('/register', [RegisterController::class, 'index'])->middleware('guest')->name('register');
Route::post('/register', [RegisterController::class, 'store']);
Route::post('/login', [RegisterController::class, 'authenticate']) -> name('login');
Route::post('/competition', [CrudController::class, 'storeCompetition']);
Route::post('/round', [CrudController::class, 'storeRound']);
Route::get('/participants/{id}', [CrudController::class, 'showParticipant']);
Route::post('/round_participant', [CrudController::class, 'storeRoundParticipant']);
Route::delete('/delete_participant', [CrudController::class, 'deleteParticipant']);
Route::post('/logout', [RegisterController::class, 'logout'])->name('logout');

Route::fallback(function () {
    return redirect()->route('home');
});
