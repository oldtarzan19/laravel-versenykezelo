@extends('layouts.app')
@section('content')
    <a href="{{ route('home') }}" class="btn btn-primary float-right">Vissza a főoldalra</a>

    <div class="d-flex justify-content-center align-items-center">
        <div class="mr-3 flex-grow-1 text-center">
            <!-- Regisztrációs űrlap -->
            <form method="POST">
                @csrf
                <div class="form-group">
                    <label for="nev">Név</label>
                    <input type="text" class="form-control" id="nev" name="nev" placeholder="Add meg a neved" value="{{old("nev")}}">
                    @error('nev')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="email">Email cím</label>
                    <input type="email" class="form-control" id="email" name="email" placeholder="Add meg az email címed" value="{{old("email")}}">
                    @error('email')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="telefonszam">Telefonszám</label>
                    <input type="tel" class="form-control" id="telefonszam" name="telefonszam" placeholder="Add meg a telefonszámod" value="{{old("telefonszam")}}">
                    @error('telefonszam')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="lakcim">Lakcím</label>
                    <input type="text" class="form-control" id="lakcim" name="lakcim" placeholder="Add meg a lakcímed" value="{{old("lakcim")}}">
                    @error('lakcim')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="szuletesi_ev">Születési év</label>
                    <input type="number" class="form-control" id="szuletesi_ev" name="szuletesi_ev" placeholder="Add meg a születési éved" value="{{old("szuletesi_ev")}}">
                    @error('szuletesi_ev')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="jelszo">Jelszó</label>
                    <input type="password" class="form-control" id="jelszo" name="password" placeholder="Add meg a jelszavad">
                    @error('password')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="jelszo_again">Jelszó újra</label>
                    <input type="password" class="form-control" id="jelszo_confirmation" name="password_confirmation" placeholder="Add meg újra a jelszavad">
                </div>
                <button type="submit" class="btn btn-primary">Regisztráció</button>
            </form>
        </div>



        <div class="ml-3 flex-grow-1 text-center justify-content-center">
            <!-- Bejelentkezési űrlap -->
            <form method="POST" id="loginForm">
                @csrf
                <div class="form-group">
                    <label for="login_email">Email cím</label>
                    <input type="email" class="form-control" id="login_email" name="login_email" placeholder="Add meg az email címed" value="{{old("login_email")}}">
                    @error('login_email')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="login_password">Jelszó</label>
                    <input type="password" class="form-control" id="login_password" name="login_password" placeholder="Add meg a jelszavad">
                    @error('jelszo')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
                <button type="submit" class="btn btn-primary">Bejelentkezés</button>
            </form>
        </div>
    </div>


@endsection
