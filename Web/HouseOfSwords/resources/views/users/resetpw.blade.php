@extends('layouts.app')
<link rel="stylesheet" href="/css/form.css">

@section('content')
    <div class="row">
        <div class="col-12 col-md-5 col-lg-4 mx-auto mt-3">

            @if (session('status'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('status') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @elseif (session('error'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    {{ session('error') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            <h2>Elfelejtett jelszó</h2>
            <form action="/resetpw" method="POST">
                @method('PUT')
                @csrf
                <div class="form">
                    <input name="UID" type="hidden" value="{{$user->UID}}">
                    <input name="PwdHash" type="password" placeholder="Jelszó">
                    @if ($errors->has('PwdHash'))
                        <span class="text-danger text-left">{{ $errors->first('EmailAddress') }}</span>
                    @endif
                    <input name="PwdHash_confirmation" type="password" placeholder="Jelszó megerősítése">
                    @if ($errors->has('PwdHash_confirmation'))
                        <span class="text-danger text-left">{{ $errors->first('PwdHash_confirmation') }}</span>
                    @endif
                    <button class="register-login-btn" type="submit">Jelszó beállítása</button>
                </div>
            </form>
        </div>
    </div>
@endsection
