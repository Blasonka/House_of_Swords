@extends('layouts.app')
<link rel="stylesheet" href="/css/form.css">

@section('content')
    <div class="row">
        <div class="col-12 col-md-4 mx-auto">

            <h2>Bejelentkezés</h2>
            <div class="form">
                {{-- @csrf --}}
                <input name="Usename" type="text" placeholder="Felhasználónév">
                <input name="PwdHash" type="password" placeholder="Jelszó">
                <button class="register-login-btn" type="submit">Belépés</button>

                <p class="link">Nincs fiókod?<br>
                    <a href="/register">Regisztrálj</a> itt</a>
                </p>
                <p class="liw">Lépj be ezzel:</p>

                <div class="icons text-center">
                    <a href="#">
                        <ion-icon name="logo-facebook"></ion-icon>
                    </a>
                    <a href="#">
                        <ion-icon name="logo-instagram"></ion-icon>
                    </a>
                    <a href="#">
                        <ion-icon name="logo-google"></ion-icon>
                    </a>
                </div>
        </div>
    </div>
    <script src="https://unpkg.com/ionicons@5.4.0/dist/ionicons.js"></script>
@endsection
