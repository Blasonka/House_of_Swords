@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-12 text-center bg-text">

            @if (session('status'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('status') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @elseif (session('errors'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    {{ session('errors') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            <p class="display-6">Kérlek hitelesítsd az email címedet!</p>
            <p class="">Nézd meg a postaládádat, amennyiben nem kaptál levelet, a linkre kattintva küldhetsz egy újat
            </p>
            <div class="d-grid gap-2 col-6 mx-auto">
                <form action="/verifyresend" method="POST">
                    @csrf
                    <button method="post" class="btn btn-primary" type="submit">Email küldése újra</button>
                </form>
            </div>
        </div>
    </div>
@endsection
