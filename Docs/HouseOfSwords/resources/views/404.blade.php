@extends('layouts.app')

@section('content')

<div class="row">
    <div class="col-12">
        <h1 class="display-3 text-center text-danger">404-es hiba: A kért oldal nem található.</h1>
        <hr class="mx-auto text-danger w-75">
        <p class="display-6 text-center text-danger"><i>Keresett oldal: {{ request()->params }}</i></p>
    </div>
    <div class="col-12 text-center mt-3">
        <a href="/" class="btn btn-secondary">Vissza a főoldalra</a>
    </div>
</div>

@endsection
