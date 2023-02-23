<footer class="p-5 mt-5 bg-dark text-light w-100">
    <div class="row">
        <div class="col-lg-4 col-12 my-5 text-center align-middle border-bottom">
            <h3>Kapcsolat</h3>
            <ul class="list-unstyled list pl-5 ">
                <li class="footer-li">
                    <img src="https://img.icons8.com/ios-filled/32/a6876e/apple-mail.png" class="me-3 align-top" />
                    <a href="https://mail.google.com/mail/?view=cm&fs=1&tf=1&to=info@houseofswords.hu" target="_blank" class="basic-link">info@houseofswords.hu</a>
                </li>
                <li class="footer-li">
                    <img src="https://img.icons8.com/external-smashingstocks-glyph-smashing-stocks/32/a6876e/external-location-web-smashingstocks-glyph-smashing-stocks.png" class="me-3 align-top" />
                    <a href="https://goo.gl/maps/TCH6KQC1W8Dss8Wi9" target="_blank" class="basic-link">Győr, Szent István út 7.</a>
                </li>
            </ul>
        </div>
        <div class="col-lg-4 col-12 text-center mx-auto border-bottom my-5">
            <img src="/img/logo.png" alt="logo" class="w-50">
            <h3>House of Swords</h3>
            <p>A House of Swords egy izgalmas középkori világban játszódó stratégiai játék, ahol a játékosoknak rafináltan kell irányítaniuk a hadseregüket és ügyesen kezelniük erőforrásaikat a győzelem érdekében..</p>
        </div>
        <div class="col-lg-4 col-12 text-center my-5 border-bottom">
            <h3>Navigálás</h3>
            <ul class="list-unstyled list pl-5 w-50 mx-auto">
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
    </div>
</footer>
