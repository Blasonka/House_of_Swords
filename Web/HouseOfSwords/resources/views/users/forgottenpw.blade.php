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
                @csrf
                <div class="form">
                    <input name="EmailAddress" type="email" placeholder="Email cím">
                    @if ($errors->has('EmailAddress'))
                        <span class="text-danger text-left">{{ $errors->first('EmailAddress') }}</span>
                    @endif
                    <p class="link">Küldj jelszó visszaállító emailt magadnak!</p>
                    <button class="register-login-btn" type="submit">Email küldése</button>
                </div>
            </form>
        </div>
    </div>
    <script src="https://unpkg.com/ionicons@5.4.0/dist/ionicons.js"></script>
@endsection
