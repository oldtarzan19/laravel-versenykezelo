<?php

namespace App\Http\Controllers;

use App\Models\User;
use Exception;
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
        try {
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
            return response()->json("success");
        }catch (Exception $e){
            return response()->json($e->getMessage(), 400);
        }

    }

    public function authenticate(Request $request)
    {
        $credentials = $request->validate([
            'login_email' => ['required', 'email'],
            'login_password' => ['required'],
        ]);

        if (Auth::attempt(['email' => $credentials['login_email'], 'password' => $credentials['login_password']])) {
            // Authentication passed...
            return Response::json("success");
        }
        return response()->json('Error', 400);
    }

    public function logout(Request $request){
        $data = $request->validate([
            'logout' => 'required',
        ]);
        if ($data['logout'] == 'logout')
        Auth::logout();
        return Response::json(true);
    }


}
