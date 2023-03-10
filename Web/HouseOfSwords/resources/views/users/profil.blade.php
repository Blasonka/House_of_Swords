@extends('layouts.app')
<link rel="stylesheet" href="/css/form.css">

@section('content')
    <div class="container">

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

        <div class="row">
            <!-- Profilkép               'Username' => 'unique:users|min:6|max:20|alpha_dash'-->
            <div class="col-md-5 col-12">
                <h2 class="text-start">Profilkép</h2>
                <div class="profil-picture">
                    <div class="form w-100 text-center">
                        @if (Auth::user()->ProfileImageUrl == null)
                            <img class="img-account-profile rounded-circle my-5"
                                src="img/avatar.jpg" alt="profil picture">
                        @else
                            <img class="img-account-profile rounded-circle my-5"
                                src="{{ asset('storage/images/' . Auth::user()->ProfileImageUrl) }}" alt="profil picture">
                        @endif
                        <div class="small font-italic text-muted mb-2">JPG vagy PNG kiterjesztés</div>
                        <form action="/save-image/{{ Auth::user()->UID }}" method="POST" enctype="multipart/form-data">
                            @method('PATCH')
                            @csrf
                            <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                            <input type="file" name="image">
                            <button type="submit" class="register-login-btn">Kép feltöltése</button>
                        </form>

                    </div>
                </div>
            </div>
            <div class="col-md-7 col-12">
                <div class="row">
                    <!-- Felhasználói adatok-->
                    <div class="col-12">
                        <form action="/profil/{{ Auth::user()->UID }}" method="POST">
                            @method('PATCH')
                            @csrf
                            <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                            <h2 class="text-start">Felhasználói adatok</h2>
                            <div class="form">
                                <input name="Username" type="text" placeholder="Felhasználónév"
                                    value="{{ Auth::user()->Username }}" required min="6" max="20">
                                <label class="mt-3" for="Username">Felhasználónév</label><br>
                                @if ($errors->has('Username'))
                                    <span class="text-danger text-left">{{ $errors->first('Username') }}</span>
                                @endif
                                <p class="mt-5 disabled">{{ Auth::user()->EmailAddress }}</p>
                                <label for="EmailAddress">Email cím</label>
                                <button class="register-login-btn">Változtatások mentése</button>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="row">
                    <!-- jelszó változtatás -->
                    <div class="col-12">
                        <form action="/profil/{{ Auth::user()->UID }}" method="POST">
                            @method('PATCH')
                            @csrf
                            <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                            <h2 class="text-start">Jelszó változtatás</h2>
                            <div class="form">
                                <input name="Password" type="password" placeholder="Jelszó" required>
                                @if ($errors->has('Password'))
                                    <span class="text-danger text-left">{{ $errors->first('Password') }}</span>
                                @endif
                                <input name="NewPassword" type="password" placeholder="Új jelszó" required>
                                @if ($errors->has('NewPassword'))
                                    <span class="text-danger text-left">{{ $errors->first('NewPassword') }}</span>
                                @endif
                                <input name="NewPassword_confirmation" type="password" placeholder="Új jelszó megerősítése"
                                    required>
                                @if ($errors->has('NewPassword_confirmation'))
                                    <span
                                        class="text-danger text-left">{{ $errors->first('NewPassword_confirmation') }}</span>
                                @endif
                                <button class="register-login-btn">Változtatások mentése</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
