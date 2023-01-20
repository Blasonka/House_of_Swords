<div class="row">
    <div class="col-12">
        <nav class="navbar navbar-expand-lg bg-light navbar-dark bg-dark mb-5 opacity-75">
            <div class="container-fluid">
                <a class="navbar-brand" href="/">House of Swords</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                    aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto mb-lg-0">
                        <li class="nav-item align-self-center">
                            {{-- EZEK A REQUEST-ES SOROK NÉZIK MEG, HOGY MELYIK OLDALON VAN A USER, ÉS ÚGY TESZIK AKTÍVVÁ A NAVBAR ELEMEIT --}}
                            <a class="nav-link {{ request()->is('/') ? 'active' : '' }}" aria-current="page"
                                href="{{ route('index') }}">Főoldal</a>
                        </li>
                        <li class="nav-item align-self-center">
                            <a class="nav-link {{ request()->is('about') ? 'active' : '' }}" href="{{ route('about') }}">A
                                játékról</a>
                        </li>
                    </ul>

                    <ul class="navbar-nav ms-auto mb-2 mb-lg-0">

                        @guest
                            <li class="nav-item align-self-center">
                                <a class="nav-link {{ request()->is('register') ? 'active' : '' }}"
                                    href="{{ route('register.show') }}">Regisztráció</a>
                            </li>

                            <li class="nav-item align-self-center">
                                <a class="nav-link {{ request()->is('login') ? 'active' : '' }}"
                                    href="{{ route('login.show') }}">Belépés</a>
                            </li>
                        @endguest

                        @auth
                            <li class="nav-item align-self-center">
                                <a class="nav-link" href="#">Ok</a>
                            </li>
                        @endauth
                    </ul>

                </div>
            </div>
        </nav>
    </div>
</div>
