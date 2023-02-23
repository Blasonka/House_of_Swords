<footer class="p-5 mt-5 bg-dark text-light w-100">
    <div class="row">

        <div class="col-md-4 col-12 mb-5 pe-5">
            <h3>Kapcsolat</h3>
            <ul class="list-unstyled list pl-5">
                <li class="footer-li">
                    <div class="row">
                        <div class="col-1"><img src="https://img.icons8.com/ios-filled/32/a6876e/apple-mail.png"/></div>
                        <div class="col-11">
                            <a href="mailto: info@houseofswords.hu" class="basic-link">info@houseofswords.hu</a>
                        </div>
                    </div>
                </li>
                <li class="footer-li">
                    <div class="row">
                        <div class="col-1"><img src="https://img.icons8.com/external-smashingstocks-glyph-smashing-stocks/32/a6876e/external-location-web-smashingstocks-glyph-smashing-stocks.png" class="" /></div>
                        <div class="col-11">
                            <p>9021 - Győr, Szent István út 7.</p>
                        </div>
                    </div>

                </li>
            </ul>
        </div>
        <div class="col-md-4 col-12 mb-5">
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
        <div class="col-md-3 col-12 text-center">
            <img src="/img/logo.png" alt="logo" class="w-50">
            <h3>House of Swords</h3>
            <p>A House of Swords egy izgalmas középkori világban játszódó stratégiai játék, ahol a játékosoknak rafináltan kell irányítaniuk a hadseregüket és ügyesen kezelniük erőforrásaikat a győzelem érdekében..</p>
        </div>
    </div>
</footer>