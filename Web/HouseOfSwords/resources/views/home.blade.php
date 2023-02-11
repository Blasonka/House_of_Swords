@extends('layouts.app')

@section('content')
    <div class="row">
        {{-- EZ NEM MŰKÖDIK, CSAK TESZTELTEM --}}
        {{--
    @foreach ($posts as $post)
        <div class="card m-5 col-6 col-md-4 col-lg-3 mx-auto" style="width: 18rem;">
            <img src="./img/{{$post->imageName}}" class="card-img my-3" alt="An image about coding">
            <div class="card-body d-flex flex-column">
                <h5 class="card-title">{{$post->title}}</h5>
                <p class="card-text">{{$post->brief}}</p>
                <a href="/" class="btn btn-primary">Elolvasom</a>
            </div>
        </div>
    @endforeach
    --}}

        @auth
            <div>
                {{ Auth::user()->Username }}
            </div>
        @endauth
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
                <a href="/" class="btn btn-primary disabled mt-auto">Elolvasom</a>
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
@endsection
