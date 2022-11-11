@extends('layouts.app')
<link rel="stylesheet" href="/css/form.css">
@section('content')

<div class="row">
    <div class="col-12 col-md-4 mx-auto">
        <form action="/register" method="post">
            @csrf
            <h2>Regisztráció</h2>
            <div class="form">
                <input name="Username" type="text" placeholder="Felhasználónév">
                <input name="EmailAddress" type="email" placeholder="Email cím">
                <input name="PwdHash" type="password" placeholder="Jelszó">
                <input name="PwdHash_confirmation" type="password" placeholder="Jelszó megerősítése">
                <button class="register-login-btn">Regisztrálok</button>

                <p class="link">Már regisztráltál?<br>
                    <a href="/login">Jelentkezz be</a> itt</a>
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
        </form>

        @if ($errors->any())
                <div class="alert alert-warning">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
    </div>
</div>

<script src="https://unpkg.com/ionicons@5.4.0/dist/ionicons.js"></script>
@endsection
