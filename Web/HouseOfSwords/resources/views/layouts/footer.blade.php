<footer class="p-5 mt-5 bg-dark text-light w-100">
    <div class="row">

        <div class="col-4">
            <h3>Kapcsolat</h3>
            <ul class="list-group">
                <li class="list-group-item">Email: <a href="mailto:">lorem@lorem.com</a></li>
                <li class="list-group-item">A second item</li>
                <li class="list-group-item">A third item</li>
                <li class="list-group-item">A fourth item</li>
                <li class="list-group-item">And a fifth one</li>
            </ul>
        </div>
        <div class="col-4">
            <h3>Navigálás</h3>
            <ul class="list-unstyled list pl-5">
                <li class="my-nav-item">
                    <a href="{{ route('index') }}">Főoldal</a>
                </li>
                <li class="my-nav-item">
                    <a href="{{ route('about') }}">A játékról</a>
                </li>
                <li class="my-nav-item">
                    <a href="{{ route('download') }}">Letöltés</a>
                </li>
                <li class="my-nav-item">
                    <a href="{{ route('bugReport') }}">Hiba jelentése</a>
                </li>
                <li class="my-nav-item">
                    <a href="{{ route('register.show') }}">Regisztráció</a>
                </li>
                <li class="my-nav-item">
                    <a href="{{ route('login.show') }}">Belépés</a>
                </li>
            </ul>
        </div>
        <div class="col-3 text-center">
            <img src="/img/logo.png" alt="logo" class="w-50">
            <h3>House of Swords</h3>
            <p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Aperiam distinctio minima eum ab tempora,
                quisquam dolore eveniet expedita, inventore.</p>
        </div>
    </div>
</footer>
