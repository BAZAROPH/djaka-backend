<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .container {
            background-color: #ffffff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            text-align: center;
            max-width: 400px;
            width: 100%;
        }

        .logo {
            width: 250px;
            height: 80px;
            margin-bottom: 20px;
        }

        .otp-code {
            font-size: 24px;
            font-weight: bold;
            color: #253BFF;
            margin-bottom: 20px;
        }

        p {
            margin-bottom: 20px;
            color: #333333;
        }

        .footer {
            color: #888888;
            font-size: 12px;
        }
    </style>
</head>
<body>
    <div class="container">
        <img src="{{asset('assets/brand/logo.png')}}" alt="Logo" class="logo">
        <p>Cher utilisateur, {{$user->first_name}}</p>
        <p>Votre code OTP pour la réinitialisation de votre mot de passe est :</p>
        <div class="otp-code"> {{ $user->otp }}</div>
        <p>Ce code expirera dans 3 minutes. Veuillez ne pas partager ce code avec qui que ce soit.</p>
        <p>Cordialement,</p>
        <p>Djaka</p>
        <div class="footer">Il s'agit d'un message automatisé. Veuillez ne pas répondre à cet e-mail.</div>
    </div>
</body>
</html>
