@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-12 text-center bg-text">
        <p class="display-6">Kérlek hitelesítsd az email címedet!</p>
        <p class="">Nézd meg a postaládádat, amennyiben nem kaptál levelet, a linkre kattintva köldhetsz egy újat</p>
        <div class="d-grid gap-2 col-6 mx-auto">
            <button class="btn btn-primary disabled" type="button">Email küldése újra</button>
          </div>
    </div>
</div>
@endsection
