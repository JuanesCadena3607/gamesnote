<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>GamesNotes</title>
    <!-- Favicon-->
    <link rel="shortcut icon" type="image/png" href="{{ asset('images/logo.ico') }}">
    <link rel="shortcut icon" sizes="192x192" href="{{ asset('images/logo.ico') }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <style>

        hr.divider-light {
            background-color: #fff;
        }

        #mainNav {
            box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.15);
            background-color: #fff;
            transition: background-color 0.2s ease;
        }
        #mainNav .navbar-brand {
            font-family: "Merriweather Sans", -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, "Noto Sans", sans-serif, "Apple Color Emoji", "Segoe UI Emoji", "Segoe UI Symbol", "Noto Color Emoji";
            font-weight: 700;
            color: #212529;
        }
        #mainNav .navbar-nav .nav-item .nav-link {
            color: #6c757d;
            font-family: "Merriweather Sans", -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, "Noto Sans", sans-serif, "Apple Color Emoji", "Segoe UI Emoji", "Segoe UI Symbol", "Noto Color Emoji";
            font-weight: 700;
            font-size: 0.9rem;
            padding: 0.75rem 0;
        }
        #mainNav .navbar-nav .nav-item .nav-link:hover, #mainNav .navbar-nav .nav-item .nav-link:active {
            color: #f4623a;
        }
        #mainNav .navbar-nav .nav-item .nav-link.active {
            color: #f4623a !important;
        }
        @media (min-width: 992px) {
            #mainNav {
                box-shadow: none;
                background-color: transparent;
            }
            #mainNav .navbar-brand {
                color: rgba(255, 255, 255, 0.7);
            }
            #mainNav .navbar-brand:hover {
                color: #fff;
            }
            #mainNav .navbar-nav .nav-item .nav-link {
                color: rgba(255, 255, 255, 0.7);
                padding: 0 1rem;
            }
            #mainNav .navbar-nav .nav-item .nav-link:hover {
                color: #fff;
            }
            #mainNav .navbar-nav .nav-item:last-child .nav-link {
                padding-right: 0;
            }
            #mainNav.navbar-shrink {
                box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.15);
                background-color: #fff;
            }
            #mainNav.navbar-shrink .navbar-brand {
                color: #212529;
            }
            #mainNav.navbar-shrink .navbar-brand:hover {
                color: #f4623a;
            }
            #mainNav.navbar-shrink .navbar-nav .nav-item .nav-link {
                color: #212529;
            }
            #mainNav.navbar-shrink .navbar-nav .nav-item .nav-link:hover {
                color: #f4623a;
            }
        }


        header.masthead {
            padding-top: 0;
            margin-bottom: 0;
            background-position: center;
            background-repeat: no-repeat;
            background-attachment: scroll;
            background-size: cover;
        }
        header.masthead h1, header.masthead .h1 {
            font-size: 2.25rem;
        }

        .log{
            width: 30%;
        }
        @media (min-width: 992px) {
            header.masthead {
                height: 100vh;
                min-height: 40rem;
                padding-top: 1rem;
                padding-bottom: 0;
            }
            header.masthead p {
                font-size: 1.15rem;
            }
            header.masthead h1, header.masthead .h1 {
                font-size: 3rem;
            }
        }
        @media (min-width: 1200px) {
            header.masthead h1, header.masthead .h1 {
                font-size: 3.5rem;
            }
        }


        @media only screen and (max-width: 768px) {
            .navbar-brand{
                padding: 0;

            }

            .log{
                width: 50%;

            }



        }


    </style>
</head>

<body id="page-top ">
<!-- Navigation-->
<nav class="navbar navbar-expand-lg navbar-light fixed-top py-3" id="mainNav">
    <div class="container px-4 px-lg-5">
        <a class="navbar-brand" style="width: 15%" href="{{ url('/') }}">  <img class="log" src="{{ asset('images/logo.png') }}" alt=""> GamesNotes</a>

        <button class="navbar-toggler navbar-toggler-right" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false"
                aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
        <div class="collapse navbar-collapse" id="navbarResponsive">

            <ul class="navbar-nav ms-auto my-2 my-lg-0">
                @auth
                    @if(auth()->user()->role == 1)
                        <li class="nav-item"><a class="nav-link" href="{{ route('admin.video_games.index') }}">Admin</a></li>
                    @endif
                @endauth

                @guest
                    {{-- Opciones de inicio de sesión y registro --}}
                @else
                    {{-- Opciones de saludo personalizado y cierre de sesión --}}
                @endguest
                <li class="nav-item"><a class="nav-link" href="{{ route('video_games.list') }}">Lista de juegos</a></li>

                    <li class="nav-item"><a class="nav-link" href="{{ route('suggestions.suggest') }}">Sugerir juego</a></li>


                @guest
                    {{-- Mostrar enlaces de inicio de sesión y registro cuando el usuario no está autenticado --}}
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('login') }}">Iniciar Sesión</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('register') }}">Registrarse</a>
                    </li>
                @else
                    {{-- Mostrar saludo personalizado y enlace de cierre de sesión cuando el usuario está autenticado --}}
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('profile.show', ['id' => auth()->id()]) }}">Ver Perfil</a>
                    </li>

                    <li class="nav-item">
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="nav-link btn btn-link">Cerrar Sesión</button>
                        </form>
                    </li>
                @endguest
            </ul>

        </div>
    </div>
</nav>

@yield('content')

<!-- Footer-->
<footer class="mt-3">
    <div class="container px-4 px-lg-5">
        <div class=" text-center text-white" style="font-size:x-large;">
            <p style="text-shadow: 1px 0 0 #000, 0 -1px 0 #000, 0 1px 0 #000, -1px 0 0 #000;" class="">Copyright &copy; 2024 - GamesNote</p>  </div>
    </div>
</footer>
<!-- Bootstrap core JS-->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
<!-- SimpleLightbox plugin JS-->
<script src="https://cdnjs.cloudflare.com/ajax/libs/SimpleLightbox/2.1.0/simpleLightbox.min.js"></script>
<!-- Core theme JS-->
<script>

    window.addEventListener('DOMContentLoaded', event => {

// Navbar shrink function
        var navbarShrink = function () {
            const navbarCollapsible = document.body.querySelector('#mainNav');
            if (!navbarCollapsible) {
                return;
            }
            if (window.scrollY === 0) {
                navbarCollapsible.classList.remove('navbar-shrink')
            } else {
                navbarCollapsible.classList.add('navbar-shrink')
            }

        };

// Shrink the navbar
        navbarShrink();

// Shrink the navbar when page is scrolled
        document.addEventListener('scroll', navbarShrink);

// Activate Bootstrap scrollspy on the main nav element
        const mainNav = document.body.querySelector('#mainNav');
        if (mainNav) {
            new bootstrap.ScrollSpy(document.body, {
                target: '#mainNav',
                rootMargin: '0px 0px -40%',
            });
        };

// Collapse responsive navbar when toggler is visible
        const navbarToggler = document.body.querySelector('.navbar-toggler');
        const responsiveNavItems = [].slice.call(
            document.querySelectorAll('#navbarResponsive .nav-link')
        );
        responsiveNavItems.map(function (responsiveNavItem) {
            responsiveNavItem.addEventListener('click', () => {
                if (window.getComputedStyle(navbarToggler).display !== 'none') {
                    navbarToggler.click();
                }
            });
        });

// Activate SimpleLightbox plugin for portfolio items
        new SimpleLightbox({
            elements: '#portfolio a.portfolio-box'
        });

    });
</script>
<!-- * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *-->
<!-- * *                               SB Forms JS                               * *-->
<!-- * * Activate your form at https://startbootstrap.com/solution/contact-forms * *-->
<!-- * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *-->
<script src="https://cdn.startbootstrap.com/sb-forms-latest.js"></script>


</body>

</html>
