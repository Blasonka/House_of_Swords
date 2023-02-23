<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Pw reset email</title>
</head>
<body>
    <p>Please click the link below to reset yout password: </p>
    <a href="{{ route('resetpw', $user->EmailVerificationToken) }}">Reset your password</a>
</body>
</html>
