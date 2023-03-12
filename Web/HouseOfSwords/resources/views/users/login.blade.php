@extends('layouts.app')
<link rel="stylesheet" href="/css/form.css">

@section('content')
    <div class="row">
        <div class="col-12 col-md-5 col-lg-4 mx-auto mt-3">
            @if (session('error'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    {{ session('error') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            <h2>Bejelentkezés</h2>
            <form action="/login" method="post">
                @csrf
                <input type="hidden" name="_token" value="{{ csrf_token() }}" />

                <div class="form">
                    <input name="Username" type="text" placeholder="Felhasználónév" value="{{ old('Username') }}">

                    <div class="d-flex">
                        <input id="PwdField" name="PwdHash" type="password" placeholder="Jelszó" class="mb-3">
                        <button id="showPwdButton" type="button" class="showPwdIcon" onclick="showPwd(true);">
                            <img src="img/showPassword.png" alt="Show password"/>
                        </button>
                    </div>

                    @if ($errors->has('Username') || $errors->has('PwdHash'))
                        <span class="text-danger text-left">Hibás felhasználónév vagy jelszó!</span>
                    @endif

                    {{-- @if ($errors->has('Username'))
                        <span class="text-danger text-left">{{ $errors->first('Username') }}</span>
                    @endif
                    @if ($errors->has('PwdHash'))
                        <span class="text-danger text-left">{{ $errors->first('PwdHash') }}</span>
                    @endif --}}

                    <button class="register-login-btn" type="submit">Belépés</button>

                    <p class="link">Nincs fiókod?<br>
                        <a href="/register">Regisztrálj itt</a>
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

    <script src="js/showPwd.js"></script>
    <script src="https://unpkg.com/ionicons@5.4.0/dist/ionicons.js"></script>
@endsection
