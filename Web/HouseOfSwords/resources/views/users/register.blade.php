@extends('layouts.app')
<link rel="stylesheet" href="/css/form.css">
@section('content')

    <div class="row">
        <div class="col-12 col-md-5 col-lg-4 mx-auto mt-3">
            <form action="/register" method="post">
                @csrf
                <input type="hidden" name="_token" value="{{ csrf_token() }}" />

                <h2>Regisztráció</h2>
                <div class="form">
                    {{-- FELHASZNÁLÓNÉV ÉS EMAIL CÍM --}}
                    <input name="Username" type="text" placeholder="Felhasználónév" value="{{ old('Username') }}">
                    @if ($errors->has('Username'))
                        <span class="text-danger text-left">{{ $errors->first('Username') }}</span>
                    @endif

                    <input name="EmailAddress" type="text" placeholder="Email cím" value="{{ old('EmailAddress') }}">
                    @if ($errors->has('EmailAddress'))
                        <span class="text-danger text-left">{{ $errors->first('EmailAddress') }}</span>
                    @endif

                    {{-- JELSZÓ --}}
                    <div class="d-flex">
                        <input id="PwdField" name="PwdHash" type="password" placeholder="Jelszó">
                        <button id="showPwdButton" type="button" class="showPwdIcon" onclick="showPwd(true);">
                            <img src="img/showPassword.png" alt="Show password"/>
                        </button>
                    </div>
                    @if ($errors->has('PwdHash'))
                        <span class="text-danger text-left">{{ $errors->first('PwdHash') }}</span>
                    @endif

                    <input id="PwdFieldConf" name="PwdHash_confirmation" type="password" placeholder="Jelszó megerősítése">
                    @if ($errors->has('PwdHash_confirmation'))
                        <span class="text-danger text-left">{{ $errors->first('PwdHash_confirmation') }}</span>
                    @endif

                    {{-- KÜLDÉS --}}
                    <button type="submit" class="register-login-btn">Regisztrálok</button>

                    <p class="link">Már regisztráltál?<br>
                        <a href="/login">Jelentkezz be itt</a>
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

            {{-- @if ($errors->any())
                <div class="alert alert-warning">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif --}}
        </div>
    </div>

    <script src="js/showPwd.js"></script>
    <script src="https://unpkg.com/ionicons@5.4.0/dist/ionicons.js"></script>
@endsection
