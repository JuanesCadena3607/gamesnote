<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="{{asset('css/login.css')}}">
    <link rel="shortcut icon" type="image/png" href="{{ asset('images/logo.ico') }}">
    <link rel="shortcut icon" sizes="192x192" href="{{ asset('images/logo.ico') }}">
</head>

<body style="background:url({{('images/bg3.gif')}});">
<section>
    <div class="login-box" style="height: 450px;">
        <a href="{{ route('home') }}" style="text-decoration: none;  margin-top: -19rem;">
            <button style="background: none; border: none; cursor: pointer;">
                <ion-icon name="arrow-back-outline" style="font-size: 24px;  color: white;"></ion-icon>
            </button>
        </a>

        <form method="POST" action="{{ route('login') }}">
            @csrf

            <h2>Iniciar Sesión</h2>
            <!-- Email Address -->
            <div class="input-box">
                <span class="icon"><ion-icon name="mail"></ion-icon></span>
                <input type="email" id="email" name="email" required>
                <label>Correo</label>
            </div>
            <!-- Password -->
            <div class="input-box">
                <span class="icon"><ion-icon name="lock-closed"></ion-icon></span>
                <input type="password" id="password" name="password" required>
                <label>Contraseña</label>
            </div>
            <!-- Remember Me -->
            <div class="remember-forgot">
                <label><input type="checkbox" name="remember">Recuérdame</label>
            </div>
            <!-- Submit Button -->
            <button type="submit" class="glow-on-hover">Iniciar sesión</button>
            <!-- Registro -->
            <div class="register-link">
                <p>Si no tienes cuenta
                    <a style="color:yellow" href="{{ route('register') }}">Regístrate aquí</a>

                </p>
                @if ($errors->any())
                    <div style="color: white; text-align: center; text-decoration:none;">

                            @foreach ($errors->all() as $error)
                                <p>{{ $error }}</p>
                            @endforeach

                    </div>
                @endif
            </div>
        </form>
    </div>

</section>


<script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
<script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
</body>

</html>
