@extends('layouts.app')
<link rel="stylesheet" href="/css/form.css">

@section('content')
    <div class="row">
        <div class="col-12 col-md-5 col-lg-4 mx-auto mt-3">
            @if (session('errors'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    {{ session('errors') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            <h2>Bejelentkezés</h2>
            <form action="/login" method="post">
                @csrf
                <div class="form">
                    <input name="Username" type="text" placeholder="Felhasználónév">
                    @if ($errors->has('Username'))
                        <span class="text-danger text-left">{{ $errors->first('Username') }}</span>
                    @endif
                    <input name="PwdHash" type="password" placeholder="Jelszó" class="mb-3">
                    @if ($errors->has('PwdHash'))
                        <span class="text-danger text-left">{{ $errors->first('PwdHash') }}</span>
                    @endif
                    <button class="register-login-btn" type="submit">Belépés</button>

                    <p class="link">Nincs fiókod?<br>
                        <a href="/register">Regisztrálj</a> itt</a>
                    </p>
                    <p class="link">
                        <a href="/forgottenpw">Elfelejtetted a jelszavad?</a>
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
        </div>
    </div>
    <script src="https://unpkg.com/ionicons@5.4.0/dist/ionicons.js"></script>
@endsection
