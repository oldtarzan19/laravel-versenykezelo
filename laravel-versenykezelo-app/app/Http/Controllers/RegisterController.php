<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use Response;

class RegisterController extends Controller
{
    public function index(){
        return view('register');
    }

    public function store(Request $request)
    {

        $data = $request->validate([
            'nev' => 'required',
            'email' => ['required', 'email', Rule::unique('users', 'email')],
            'telefonszam' => 'required',
            'lakcim' => 'required',
            'szuletesi_ev' => 'required|integer',
            'password' => 'required|confirmed',
        ]);
        $data['password'] = bcrypt($data['password']);
        $user = User::create($data);
        auth()->login($user);
        return redirect('/');
    }

    public function authenticate(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'jelszo' => ['required'],
        ]);

        if (Auth::attempt(['email' => $credentials['email'], 'password' => $credentials['jelszo']])) {
            // Authentication passed...
            return redirect()->intended('/');
        }

        return back()->withErrors([
            'email' => 'A megadott hitelesítő adatok nem egyeznek a rekordjainkkal.',
        ]);
    }

    public function logout(){
        Auth::logout();
        return redirect('/');
    }


}
