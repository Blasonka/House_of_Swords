<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Email Verification</title>
</head>

<body>
    <p>Please verify your email with the link bellow: </p>
    <a href="{{ route('emailVerification', $user->EmailVerificationToken) }}">Verify Email</a>
</body>

</html>
