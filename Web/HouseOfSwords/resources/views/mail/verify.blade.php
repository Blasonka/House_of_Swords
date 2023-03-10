<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Email hitelesítése</title>
</head>

<body>
    <p>Kérlek hitelesítsd emailedet az alábbi linkkel: </p>
    <a href="{{ route('emailVerification', $user->EmailVerificationToken) }}">Email hitelesítése</a>
</body>

</html>
