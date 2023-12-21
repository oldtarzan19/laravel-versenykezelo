<?php

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

Route::get('/', function () {
    $felhasznalo = new User;
    $felhasznalo->nev = 'Teszt';
    $felhasznalo->jelszo = bcrypt('Teszt'); // Jelszót mindig titkosítani kell!
    $felhasznalo->email = 'email@example.com';
    $felhasznalo->save();

    return view('welcome');
});
