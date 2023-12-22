<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

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
            'jelszo' => 'required|confirmed',
        ]);
        $data['jelszo'] = bcrypt($data['jelszo']);
        $user = User::create($data);
        auth()->login($user);
        return redirect('/');
    }

    public function authenticate(Request $request)
    {
        $credentials = $request->only('email', 'jelszo');

        if (Auth::attempt($credentials)) {
            // Authentication passed...
            return redirect('/');
        }
        return redirect('/register');
    }
}
