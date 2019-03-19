<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
</head>
<body>
    <h1>To confirm your account, follow the link:</h1>
    <a href="{{ route('confirm-email', [$user, $token]) }}">Click to go</a>
</body>
</html>