@extends('layouts.app')
<link rel="stylesheet" href="/css/form.css">

@section('content')
    <div class="container">
        <div class="row">
            <!-- Profilkép-->
            <div class="col-md-5 col-12">
                <h2 class="text-start">Profilkép</h2>
                <div class="profil-picture">
                    <div class="form w-100 text-center">
                        <img class="img-account-profile rounded-circle my-5" src="/img/avatar.jpg" alt="profil picture">
                        <div class="small font-italic text-muted mb-2">JPG vagy PNG kiterjesztés</div>
                        <button class="register-login-btn">Kép feltöltése</button>
                    </div>
                </div>
            </div>
            <div class="col-md-7 col-12">
                <div class="row">
                    <!-- Felhasználói adatok-->
                    <div class="col-12">
                        <form action="/editProfil" method="post">
                            @csrf
                            <input type="hidden" name="_token" value="{{ csrf_token() }}" />

                            <h2 class="text-start">Felhasználói adatok</h2>
                            <div class="form">
                                <input name="Username" type="text" placeholder="Felhasználónév">
                                <label for="Username">Felhasználónév</label>
                                <input name="EmailAddress" type="email" placeholder="Email cím">
                                <label for="EmailAddress">Email cím</label>
                                <button class="register-login-btn">Változtatások mentése</button>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="row">
                    <!-- jelszó változtatás -->
                    <div class="col-12">
                        <form action="/editProfil" method="post">
                            @csrf
                            <h2 class="text-start">Jelszó változtatás</h2>
                            <div class="form">
                                <input name="PwdHash" type="password" placeholder="Jelszó">
                                <input name="NewPwdHash" type="password" placeholder="Új jelszó">
                                <input name="NewPwdHash_confirmation" type="password" placeholder="Új jelszó megerősítése">
                                <button class="register-login-btn">Változtatások mentése</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
