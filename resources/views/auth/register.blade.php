
<link rel="stylesheet" href="{{asset('css/register.css')}}">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="shortcut icon" type="image/png" href="{{ asset('images/logo.ico') }}">
<link rel="shortcut icon" sizes="192x192" href="{{ asset('images/logo.ico') }}">


<section style="background:url({{('images/bg3.gif')}}); background-repeat: no-repeat; background-size: cover;">


    <div class="register-box">
        <a href="{{ route('home') }}" style="text-decoration: none;  margin-top:-28.5rem;">
            <button style="background: none; border: none; cursor: pointer;">
                <ion-icon name="arrow-back-outline" style="font-size: 24px;  color: white;"></ion-icon>
            </button>
        </a>
        <form method="POST" action="{{ route('register') }}" style="margin-top: 1rem">
            @csrf

            <h2 style="margin-top: -2rem">Registrarse</h2>
            <div class="input-box">
                    <span class="icon">
                        <ion-icon name="person"></ion-icon>
                    </span>
                <input type="text" name="name" value="{{ old('name') }}" required autofocus>
                <label>Nombre de Usuario</label>
            </div>
            <div class="input-box">
                    <span class="icon">
                        <ion-icon name="mail"></ion-icon>
                    </span>
                <input type="email" name="email" value="{{ old('email') }}" required>
                <label>Correo</label>
            </div>
            <div class="input-box">
                    <span class="icon">
                        <ion-icon name="lock-closed"></ion-icon>
                    </span>
                <input type="password" name="password" required>
                <label>Contraseña</label>
            </div>
            <div class="input-box">
                    <span class="icon">
                        <ion-icon name="lock-closed"></ion-icon>
                    </span>
                <input type="password" name="password_confirmation" required>
                <label>Confirmar Contraseña</label>
            </div>

            <div class="remember-forgot">
                <label><input type="checkbox">Recuérdame</label>
                <!--  <a href="#">Olvidaste tu contraseña?</a> -->
            </div>
            <button class="glow-on-hover" type="submit">Registrarse</button>

            <div class="register-link" >
                <p class="cuenta">¿Ya tienes cuenta?
                    <a style="color:yellow" href="{{ route('login') }}">Inicia sesión aquí</a>
                </p>
            </div>
        </form>
    </div>
</section>

<script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
<script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>



