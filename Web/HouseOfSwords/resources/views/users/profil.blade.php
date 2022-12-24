@extends('layouts.app')
<link rel="stylesheet" href="/css/form.css">

@section('content')

<div class="container-xl px-4 mt-4">
    <div class="d-flex flex-row">
        <!-- Profilkép-->
        <div class="w-50 me-3">
            <h2 class="text-start">Profilkép</h2>
            <div class="profil-picture">
                <div class="form w-100 text-center">
                    <img class="img-account-profile rounded-circle my-5" src="/img/avatar.jpg" alt="profil picture">
                    <div class="small font-italic text-muted mb-2">JPG vagy PNG kiterjesztés</div>
                    <button class="register-login-btn">Kép feltöltése</button>
                </div>
            </div>
        </div>

        <div class="d-flex flex-column">

            <!-- Felhasználói adatok-->
            <div class="w-100">
                <form action="/editProfil" method="post">
                    @csrf
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

            <div class="w-100">
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

<!--
    <div class="row">
    <div class="col-12 col-md-4">
            <form action="/editProfil" method="post">

                <h2 class="text-start">Város</h2>
                <div class="form">
                    <input name="TownName" type="text" placeholder="Város neve">
                    <label for="TownName">Város neve</label>
                    <input name="PwdHash" type="password" placeholder="Jelszó">

                    <button class="register-login-btn">Változtatások mentése</button>
                </div>
            </form>
        </div>
    </div> -->


</div>

@endsection
