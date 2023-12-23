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
                    <input type="text" class="form-control" id="nev" name="nev" placeholder="Add meg a neved">
                    @error('nev')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="email">Email cím</label>
                    <input type="email" class="form-control" id="email" name="email" placeholder="Add meg az email címed">
                    @error('email')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="telefonszam">Telefonszám</label>
                    <input type="tel" class="form-control" id="telefonszam" name="telefonszam" placeholder="Add meg a telefonszámod">
                    @error('telefonszam')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="lakcim">Lakcím</label>
                    <input type="text" class="form-control" id="lakcim" name="lakcim" placeholder="Add meg a lakcímed">
                    @error('lakcim')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="szuletesi_ev">Születési év</label>
                    <input type="number" class="form-control" id="szuletesi_ev" name="szuletesi_ev" placeholder="Add meg a születési éved">
                    @error('szuletesi_ev')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="jelszo">Jelszó</label>
                    <input type="password" class="form-control" id="jelszo" name="password" placeholder="Add meg a jelszavad">
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
            <form method="POST" action="/login">
                @csrf
                <div class="form-group">
                    <label for="login_email">Email cím</label>
                    <input type="email" class="form-control" id="login_email" name="email" placeholder="Add meg az email címed">
                </div>
                <div class="form-group">
                    <label for="login_password">Jelszó</label>
                    <input type="password" class="form-control" id="login_password" name="jelszo" placeholder="Add meg a jelszavad">
                </div>
                <button type="submit" class="btn btn-primary">Bejelentkezés</button>
            </form>
        </div>
    </div>


@endsection
