<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Email Confirmation</title>
</head>
<body>
    <p>¡Hola {{ $user->name }}!</p>

    <p>Gracias por registrarte en nuestra plataforma. Para activar tu cuenta, por favor haz clic en el siguiente enlace:</p>

    <a href="{{ route('verification.verify', ['id' => $user->id, 'hash' => sha1($user->email)]) }}">Confirmar Correo Electrónico</a>

    <p>Si no has solicitado este registro, por favor ignora este correo.</p>

    <p>¡Gracias!</p>
</body>
</html>
