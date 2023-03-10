<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Jelszó visszaállító email</title>
</head>
<body>
    <p>Kérlek kattints a linkre egy új jelszó beállításához: </p>
    <a href="{{ route('resetpw', $user->EmailVerificationToken) }}">Új jelszó beállítása</a>
</body>
</html>
