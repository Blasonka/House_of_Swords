<!doctype html>
<html lang="hu">
<head>
    <meta charset="utf-8">
    <meta name="description" content="House of Swords - online stratégiai, középkori játék. Fejleszd a városod, toborozz katonákat, kereskedj és hódíts!">
    <meta name="keywords" content="house, House, of, Of, Swords, swords, hu, HU, strategia, stratégia, játék, jatek, online">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>House of Swords</title>
    <link rel="icon" type="image/x-icon" href="/img/logo.png">
    @include('layouts.styles')
</head>
<body>
    <div class="bg-image"></div>

    <header>
        @include('layouts.header')

        @include('layouts.navigation')
    </header>

    <main class="container">
        @yield('content')
    </main>

    @include('layouts.scripts')
</body>
</html>
