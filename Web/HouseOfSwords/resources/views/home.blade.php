@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-12 text-center bg-text">
            <h1 class="display-3"><strong>House of Swords</strong></h1>
            <img id="header_logo" src="/img/logo.png" alt="">
        </div>
    </div>

    <div class="container">
        <div class="row">

            <div class="card m-5 col-6 col-md-4 col-lg-3 mx-auto text-center" style="width: 18rem;">
                <img src="./img/coding.png" class="card-img my-3" alt="An image about coding">
                <hr class="text-secondary opacity-5">
                <div class="card-body d-flex flex-column">
                    <h5 class="card-title">Devlog</h5>
                    <p class="card-text">A játék fejlesztésének jelenlegi állapotáról olvashatsz itt.</p>
                    <a href="/" class="btn btn-primary disabled mt-auto">Elolvasom</a>
                </div>
            </div>

            <div class="card m-5 col-6 col-md-4 col-lg-3 mx-auto text-center" style="width: 18rem;">
                <img src="./img/information.png" class="card-img my-3" alt="Information sign">
                <hr class="text-secondary opacity-5">
                <div class="card-body d-flex flex-column">
                    <h5 class="card-title">Általános információk</h5>
                    <p class="card-text">A projekttel kapcsolatos tudnivalók.</p>
                    <a href="/" class="btn btn-primary disabled mt-auto">Elolvasom</a>
                </div>
            </div>

            <div class="card m-5 col-6 col-md-4 col-lg-3 mx-auto text-center" style="width: 18rem;">
                <img src="./img/devTeam.png" class="card-img my-3" alt="Three people in a team">
                <hr class="text-secondary opacity-5">
                <div class="card-body d-flex flex-column">
                    <h5 class="card-title">Csapat</h5>
                    <p class="card-text">A fejlesztőcsapat bemutatása.</p>
                    <a href="/cards/developers" class="btn btn-primary mt-auto">Elolvasom</a>
                </div>
            </div>

            <div class="card m-5 col-6 col-md-4 col-lg-3 mx-auto text-center" style="width: 18rem;">
                <img src="./img/eula.png" class="card-img my-3" alt="An image about coding">
                <hr class="text-secondary opacity-5">
                <div class="card-body d-flex flex-column">
                    <h5 class="card-title">EULA</h5>
                    <p class="card-text">A végfelhasználói licenszszerződést tudod itt elolvasni.</p>
                    <a href="/" class="btn btn-primary disabled mt-auto">Elolvasom</a>
                </div>
            </div>
        </div>
    </div>
@endsection
