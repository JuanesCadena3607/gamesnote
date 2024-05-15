<?php

use App\Models\VideoGame;
use Illuminate\Support\Facades\Storage;

// Obtén los juegos más recientes
// Obtener los 4 últimos videojuegos
// Obtén los juegos más recientes
// Obtener los 4 últimos videojuegos
$latestVideoGames = VideoGame::latest()->take(4)->get();

// Definir la ruta predeterminada de la imagen
$defaultImageUrl = 'default.jpg';

// Extraer las URLs de las imágenes de los juegos más recientes
$firstLatestCoverUrl = isset($latestVideoGames[0]) ? Storage::url($latestVideoGames[0]->cover) : $defaultImageUrl;
$secondLatestCoverUrl = isset($latestVideoGames[1]) ? Storage::url($latestVideoGames[1]->cover) : $defaultImageUrl;
$thirdLatestCoverUrl = isset($latestVideoGames[2]) ? Storage::url($latestVideoGames[2]->cover) : $defaultImageUrl;
$fourthLatestCoverUrl = isset($latestVideoGames[3]) ? Storage::url($latestVideoGames[3]->cover) : $defaultImageUrl;

// Verificar si las imágenes tienen una extensión válida
$validExtensions = ['jpg', 'jpeg', 'png', 'webp']; // Añadir 'webp' a los formatos válidos
if (!in_array(pathinfo($firstLatestCoverUrl, PATHINFO_EXTENSION), $validExtensions)) {
    $firstLatestCoverUrl = $defaultImageUrl;
}
if (!in_array(pathinfo($secondLatestCoverUrl, PATHINFO_EXTENSION), $validExtensions)) {
    $secondLatestCoverUrl = $defaultImageUrl;
}
if (!in_array(pathinfo($thirdLatestCoverUrl, PATHINFO_EXTENSION), $validExtensions)) {
    $thirdLatestCoverUrl = $defaultImageUrl;
}
if (!in_array(pathinfo($fourthLatestCoverUrl, PATHINFO_EXTENSION), $validExtensions)) {
    $fourthLatestCoverUrl = $defaultImageUrl;
}

?>


@extends('layouts.public')
@section('content')

    <style>
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;


        }

        body {
            background: url({{asset('images/color3.jpg')}});
            background-size: cover; /* Ajusta el tamaño de la imagen para cubrir todo el fondo */
            background-repeat: no-repeat; /* Evita que la imagen se repita */
        }

        .wrapper2 {
            margin-top: 3rem;
            margin-bottom: 1rem;
            width: 100%;

            display: flex;
            align-items: center;
            justify-content: center;
        }

        .container2 {
            margin-top: 20px;
            height: 300px;
            display: flex;
            flex-wrap: nowrap;
            justify-content: start;
        }

        .card2 {
            width: 150px;
            border-radius: .75rem;
            background-size: cover;
            cursor: pointer;
            overflow: hidden;
            border-radius: 2rem;
            margin: 0 10px;
            display: flex;
            align-items: flex-end;
            transition: .6s cubic-bezier(.28, -0.03, 0, .99);
            box-shadow: 0px 10px 30px -5px rgba(0, 0, 0, 0.8);
        }

        .card2 > .row {
            color: white;
            display: flex;
            flex-wrap: nowrap;
        }

        .card2 > .row > .icon {
            background: #223;
            color: white;
            border-radius: 50%;
            width: 50px;
            height: 50px;
            display: flex;
            justify-content: center;
            align-items: center;
            margin-left: 1.5rem;
            margin-top: 0.5rem;
            font-size: larger;
        }

        .card2 > .row > .description {
            display: flex;
            justify-content: center;
            flex-direction: column;
            overflow: hidden;
            height: 80px;
            width: 520px;
            opacity: 0;
            transform: translateY(30px);
            transition-delay: .3s;
            transition: all .3s ease;

        }

        .description a {

            text-decoration: none;

        }


        .card2[for="c1"] {
            background-image: url('{{ $firstLatestCoverUrl }}');
        }

        .card2[for="c2"] {
            background-image: url('{{ $secondLatestCoverUrl }}');
        }

        .card2[for="c3"] {
            background-image: url('{{ $thirdLatestCoverUrl }}');
        }

        .card2[for="c4"] {
            background-image: url('{{ $fourthLatestCoverUrl }}');
        }



        .description p {
            color: #212529;
                font-size: 24px;

            font-weight: bold;
            line-height: 1.5;
            margin-bottom: 10px;
            background-color: rgba(255, 255, 255, 0.8);
            padding: 10px;
            border-radius: 5px;
        }

        .page-section {
            font-size: 24px;

            font-weight: bold;
            line-height: 1.5;
            margin-bottom: -3px;
            background: linear-gradient(45deg, rgba(142, 68, 173, 0.8), rgba(52, 152, 219, 0.8), rgba(231, 76, 60, 0.8));
            background-size: cover;
            padding: 1rem;
            border-radius: 40px;
            width: 70%;
            margin-left: auto;
            margin-right: auto;

        }

        .mar {
            margin-top: -9rem;
        }

        /* También puedes ajustar el margen superior del wrapper2 para tener más espacio en dispositivos móviles */
        .wrapper2 {
            margin-top: 2rem; /* Ajusta el valor según tus necesidades */
            margin-bottom: 0.5rem;
            padding: 1rem; /* Agregado para espacio adicional en dispositivos móviles */
        }


        input {
            display: none;
        }

        input:checked + label {
            width: 600px;
        }

        input:checked + label .description {
            opacity: 1 !important;
            transform: translateY(0) !important;
        }

        .link-unstyled {
            text-decoration: none; /* Elimina la subrayado */
            color: inherit; /* Hereda el color del texto de su contenedor */
        }

        .link-unstyled:hover {
            color: inherit; /* Mantener el color del texto incluso en el hover */
        }


        @media (max-width: 767px) {
            .mx-mobile-0 {
                margin-left: 0 !important;
                margin-right: 0 !important;

            }

            .wrapper2 {
                margin-top: 2rem;
                margin-bottom: 0.5rem;
                padding: 1rem; /* Agregado para espacio adicional en dispositivos móviles */
            }

            .container2 {
                padding-top: 0.5rem;
                width: 600px;
                height: auto;
                flex-direction: column;
                align-items: center;
                justify-content: center;
            }

            .card2 {
                width: 30%;
                margin: 10px 0;
                box-shadow: 0px 5px 15px -3px rgba(0, 0, 0, 0.8);
            }

            .card2 > .row > .description {
                width: 100%;
                max-width: 100%;


                border-radius: 20px;
            }

            .card2[for="c1"],
            .card2[for="c2"],
            .card2[for="c3"],
            .card2[for="c4"] {
                background-size: cover;
                height: 150px;
            }


            input:checked + label {
                width: 100%;
            }

            .description p {
                color: #212529;
                font-size: 20px;
                font-weight: bold;
                line-height: 1.5;
                margin-bottom: 10px;
                background-color: rgba(255, 255, 255, 0.8);

                border-radius: 2rem;
            }

            .pag_mov {
                margin-top: -2rem;

            }

            section {
                width: 80% !important;
            }

            input:checked + label .description {
                opacity: 1 !important;
                transform: translateY(0) !important;
            }

            /* Ajusta el tamaño de las tarjetas para dispositivos móviles */
            .card2 {
                width: 100%;
                margin: 10px 0;
                box-shadow: 0px 5px 15px -3px rgba(0, 0, 0, 0.8);
            }

            .card2 > .row > .description {
                width: 80%;
                max-width: 70%;
                padding: 15px;
                margin-bottom: 12px;
            }

            /* Agrega esta regla para mantener las tarjetas siempre expandidas en móviles */
            input:checked + label {
                width: 100%;
            }

            .card2 > .row > .description a {
                opacity: 1; /* Reestablece la opacidad a 1 */
                pointer-events: auto; /* Reestablece los eventos de puntero a su valor predeterminado */
                border: initial; /* Reestablece el borde a su valor predeterminado */
            }


        }


    </style>

    <!-- Masthead-->
    <header class="masthead mb-5 mt-3">
        <div class="container  h-100">
            <div class="row gx-lg-5  align-items-center justify-content-center text-center">

                <div class="col-lg-8 ">

                    <div class="wrapper2">
                        <div class="container2">
                            <input type="radio" name="slide" id="c1" checked>
                            <label for="c1" class="card2">
                                <div class="row">
                                    <div class="icon">
                                        @php
                                            $rating = isset($latestVideoGames[0]->rating) ? $latestVideoGames[0]->rating : null;
                                            // Verificar si el rating está definido y no es nulo
                                            if ($rating !== null) {
                                                // Verificar si el rating es un número entero
                                                if ($rating == intval($rating)) {
                                                    // Si es un número entero, mostrarlo sin decimales
                                                    echo number_format($rating, 0);
                                                } else {
                                                    // Si no es un número entero, mostrarlo con un decimal
                                                    echo number_format($rating, 1);
                                                }
                                            } else {
                                                // Si el rating está indefinido o es nulo, mostrar 'N/A'
                                             echo '<div style="font-size: 14px; line-height: 1; margin-top: -5px;">0 notas</div>';
                                            }
                                        @endphp
                                    </div>
                                    <div class="description">

                                        <a class=""
                                           href="{{ isset($latestVideoGames[0]) ? route('video_games.show', $latestVideoGames[0]->id) : '#' }}">
                                            <p class="textgames  " >{{ isset($latestVideoGames[0]) ? $latestVideoGames[0]->name : 'Nombre del juego 1' }}</p>
                                        </a>
                                    </div>
                                </div>
                            </label>
                            <input type="radio" name="slide" id="c2">
                            <label for="c2" class="card2">
                                <div class="row">
                                    <div class="icon">
                                        @php
                                            $rating = isset($latestVideoGames[1]->rating) ? $latestVideoGames[1]->rating : null;
                                            // Verificar si el rating está definido y no es nulo
                                            if ($rating !== null) {
                                                // Verificar si el rating es un número entero
                                                if ($rating == intval($rating)) {
                                                    // Si es un número entero, mostrarlo sin decimales
                                                    echo number_format($rating, 0);
                                                } else {
                                                    // Si no es un número entero, mostrarlo con un decimal
                                                    echo number_format($rating, 1);
                                                }
                                            } else {
                                                // Si el rating está indefinido o es nulo, mostrar 'N/A'
                                             echo '<div style="font-size: 14px; line-height: 1; margin-top: -5px;">0 notas</div>';
                                            }
                                        @endphp
                                    </div>


                                    <div class="description">

                                        <a href="{{ isset($latestVideoGames[1]) ? route('video_games.show', $latestVideoGames[1]->id) : '#' }}">
                                            <p class="textgames">{{ isset($latestVideoGames[1]) ? $latestVideoGames[1]->name : 'Nombre del juego 2' }}</p>
                                        </a>
                                    </div>
                                </div>
                            </label>
                            <input type="radio" name="slide" id="c3">
                            <label for="c3" class="card2">
                                <div class="row">
                                    <div class="icon">
                                        @php
                                            $rating = isset($latestVideoGames[2]->rating) ? $latestVideoGames[2]->rating : null;
                                            // Verificar si el rating está definido y no es nulo
                                            if ($rating !== null) {
                                                // Verificar si el rating es un número entero
                                                if ($rating == intval($rating)) {
                                                    // Si es un número entero, mostrarlo sin decimales
                                                    echo number_format($rating, 0);
                                                } else {
                                                    // Si no es un número entero, mostrarlo con un decimal
                                                    echo number_format($rating, 1);
                                                }
                                            } else {
                                                // Si el rating está indefinido o es nulo, mostrar 'N/A'
                                             echo '<div style="font-size: 14px; line-height: 1; margin-top: -5px;">0 notas</div>';
                                            }
                                        @endphp
                                    </div>

                                    <div class="description">
                                        <a href="{{ isset($latestVideoGames[2]) ? route('video_games.show', $latestVideoGames[2]->id) : '#' }}">
                                            <p class="textgames">{{ isset($latestVideoGames[2]) ? $latestVideoGames[2]->name : 'Nombre del juego 3' }}</p>
                                        </a>

                                    </div>
                                </div>
                            </label>
                            <input type="radio" name="slide" id="c4">
                            <label for="c4" class="card2">
                                <div class="row">
                                    <div class="icon">
                                        @php
                                            $rating = isset($latestVideoGames[3]->rating) ? $latestVideoGames[3]->rating : null;
                                            // Verificar si el rating está definido y no es nulo
                                            if ($rating !== null) {
                                                // Verificar si el rating es un número entero
                                                if ($rating == intval($rating)) {
                                                    // Si es un número entero, mostrarlo sin decimales
                                                    echo number_format($rating, 0);
                                                } else {
                                                    // Si no es un número entero, mostrarlo con un decimal
                                                    echo number_format($rating, 1);
                                                }
                                            } else {
                                                // Si el rating está indefinido o es nulo, mostrar 'N/A'
                                             echo '<div style="font-size: 14px; line-height: 1; margin-top: -5px;">0 notas</div>';
                                            }
                                        @endphp
                                    </div>


                                    <div class="description">

                                        <a href="{{ isset($latestVideoGames[3]) ? route('video_games.show', $latestVideoGames[3]->id) : '#' }}">
                                            <p class="textgames">{{ isset($latestVideoGames[3]) ? $latestVideoGames[3]->name : 'Nombre del juego 4' }}</p>
                                        </a>
                                    </div>
                                </div>
                            </label>
                        </div>
                    </div>
                    <p class="text-white align-items-center p-0" style="text-shadow: 1px 0 0 #000, 0 -1px 0 #000, 0 1px 0 #000, -1px 0 0 #000;">ÚLTIMOS JUEGOS AGREGADOS</p>

                    <h2 class="text-white font-weight-bold"></h2>
                    <hr class="divider divider-light"/>
                </div>
                <div class=" align-self-baseline">
                    <a class="btn btn-light btn-xl " href="{{ route('video_games.list') }}">Ver todos</a>
                </div>
            </div>
        </div>
    </header>

    <section class="page-section mar pag_mov">
        <div class="  ">
            <div class="row  justify-content-center">
                <div class="text-center">
                    <p class="text-white" id="acerca" style="text-shadow: 1px 0 0 #000, 0 -1px 0 #000, 0 1px 0 #000, -1px 0 0 #000;">Reseña Y Puntúa Tus Juegos Favoritos</p>
                    <hr class="divider divider-light"/>

                    <img src="{{asset('images/soinc.gif')}}" class="w-25" alt="">
                    <img src="{{asset('images/mario-super-unscreen.gif')}}" style="width:  18%;" alt="">

                    <p class="text-white mb-4 mx-5  mx-mobile-0" style="text-shadow: 1px 0 0 #000, 0 -1px 0 #000, 0 1px 0 #000, -1px 0 0 #000;">Gamesnotes es una página enfocada en los videojuegos y
                        en las reseñas
                        y puntuaciones de los mismos, aquí los usuarios dan vía libre a sus opiniones
                    </p>

                </div>
            </div>
        </div>
    </section>

    <!-- plataformas-->
    <section class="page-section" id="plataformas" style="margin-top:2rem; margin-bottom: 2rem;">
        <div class="container px-4 px-lg-5 " style="text-shadow: 1px 0 0 #000, 0 -1px 0 #000, 0 1px 0 #000, -1px 0 0 #000;">
            <h2 class="text-center text-white mt-0" >Plataformas</h2>
            <hr class="divider-light"/>
            <div class="row gx-4 gx-lg-5">
                <div class="col-lg-3 col-md-6 text-center">
                    <div class="mt-5">
                        <div class="mb-2"><i class=" fs-1 text-primary"></i></div>
                        <a class="link-unstyled"
                           href="{{ route('video_games.search', ['search' => '', 'platform' => 'nintendo_switch', 'genres' => '', 'release_year' => '']) }}">

                            <svg style="margin-top: -2rem" xmlns="http://www.w3.org/2000/svg" width="70" height="70"
                                 fill="red"
                                 class="bi bi-nintendo-switch" viewBox="0 0 16 16">
                                <path
                                    d="M9.34 8.005c0-4.38.01-7.972.023-7.982C9.373.01 10.036 0 10.831 0c1.153 0 1.51.01 1.743.05 1.73.298 3.045 1.6 3.373 3.326.046.242.053.809.053 4.61 0 4.06.005 4.537-.123 4.976-.022.076-.048.15-.08.242a4.136 4.136 0 0 1-3.426 2.767c-.317.033-2.889.046-2.978.013-.05-.02-.053-.752-.053-7.979Zm4.675.269a1.621 1.621 0 0 0-1.113-1.034 1.609 1.609 0 0 0-1.938 1.073 1.9 1.9 0 0 0-.014.935 1.632 1.632 0 0 0 1.952 1.107c.51-.136.908-.504 1.11-1.028.11-.285.113-.742.003-1.053ZM3.71 3.317c-.208.04-.526.199-.695.348-.348.301-.52.729-.494 1.232.013.262.03.332.136.544.155.321.39.556.712.715.222.11.278.123.567.133.261.01.354 0 .53-.06.719-.242 1.153-.94 1.03-1.656-.142-.852-.95-1.422-1.786-1.256Z"/>
                                <path
                                    d="M3.425.053a4.136 4.136 0 0 0-3.28 3.015C0 3.628-.01 3.956.005 8.3c.01 3.99.014 4.082.08 4.39.368 1.66 1.548 2.844 3.224 3.235.22.05.497.06 2.29.07 1.856.012 2.048.009 2.097-.04.05-.05.053-.69.053-7.94 0-5.374-.01-7.906-.033-7.952-.033-.06-.09-.063-2.03-.06-1.578.004-2.052.014-2.26.05Zm3 14.665-1.35-.016c-1.242-.013-1.375-.02-1.623-.083a2.81 2.81 0 0 1-2.08-2.167c-.074-.335-.074-8.579-.004-8.907a2.845 2.845 0 0 1 1.716-2.05c.438-.176.64-.196 2.058-.2l1.282-.003v13.426Z"/>
                            </svg>
                            <h3 class="h4 mb-2 mt-3 text-white">Nintendo Switch</h3>
                        </a>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 text-center">
                    <div class="mt-5">
                        <div class="mb-2"><i class=" fs-1 text-primary"></i></div>
                        <a class="link-unstyled"
                           href="{{ route('video_games.search', ['search' => '', 'platform' => 'steam', 'genres' => '', 'release_year' => '']) }}">
                            <svg style="margin-top: -2rem" xmlns="http://www.w3.org/2000/svg" width="70" height="70"
                                 fill="currentColor"
                                 class="bi bi-steam" viewBox="0 0 16 16">
                                <path
                                    d="M.329 10.333A8.01 8.01 0 0 0 7.99 16C12.414 16 16 12.418 16 8s-3.586-8-8.009-8A8.006 8.006 0 0 0 0 7.468l.003.006 4.304 1.769A2.198 2.198 0 0 1 5.62 8.88l1.96-2.844-.001-.04a3.046 3.046 0 0 1 3.042-3.043 3.046 3.046 0 0 1 3.042 3.043 3.047 3.047 0 0 1-3.111 3.044l-2.804 2a2.223 2.223 0 0 1-3.075 2.11 2.217 2.217 0 0 1-1.312-1.568L.33 10.333Z"/>
                                <path
                                    d="M4.868 12.683a1.715 1.715 0 0 0 1.318-3.165 1.705 1.705 0 0 0-1.263-.02l1.023.424a1.261 1.261 0 1 1-.97 2.33l-.99-.41a1.7 1.7 0 0 0 .882.84Zm3.726-6.687a2.03 2.03 0 0 0 2.027 2.029 2.03 2.03 0 0 0 2.027-2.029 2.03 2.03 0 0 0-2.027-2.027 2.03 2.03 0 0 0-2.027 2.027Zm2.03-1.527a1.524 1.524 0 1 1-.002 3.048 1.524 1.524 0 0 1 .002-3.048Z"/>
                            </svg>
                            <h3 class="h4 mb-2 mt-3 text-white">Steam</h3>
                        </a>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 text-center">
                    <div class="mt-5">
                        <div class="mb-2"><i class=" fs-1 text-primary"></i></div>
                        <a class="link-unstyled"
                           href="{{ route('video_games.search', ['search' => '', 'platform' => 'playstation_5', 'genres' => '', 'release_year' => '']) }}">
                            <svg style="margin-top: -2rem" xmlns="http://www.w3.org/2000/svg" width="70" height="70"
                                 fill="blue"
                                 class="bi bi-playstation" viewBox="0 0 16 16">
                                <path
                                    d="M15.858 11.451c-.313.395-1.079.676-1.079.676l-5.696 2.046v-1.509l4.192-1.493c.476-.17.549-.412.162-.538-.386-.127-1.085-.09-1.56.08l-2.794.984v-1.566l.161-.054s.807-.286 1.942-.412c1.135-.125 2.525.017 3.616.43 1.23.39 1.368.962 1.056 1.356ZM9.625 8.883v-3.86c0-.453-.083-.87-.508-.988-.326-.105-.528.198-.528.65v9.664l-2.606-.827V2c1.108.206 2.722.692 3.59.985 2.207.757 2.955 1.7 2.955 3.825 0 2.071-1.278 2.856-2.903 2.072Zm-8.424 3.625C-.061 12.15-.271 11.41.304 10.984c.532-.394 1.436-.69 1.436-.69l3.737-1.33v1.515l-2.69.963c-.474.17-.547.411-.161.538.386.126 1.085.09 1.56-.08l1.29-.469v1.356l-.257.043a8.454 8.454 0 0 1-4.018-.323Z"/>
                            </svg>
                            <h3 class="h4 mb-2 mt-3 text-white">PS5</h3>
                        </a>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 text-center mb-4">
                    <div class="mt-5">

                        <div class="mb-2"><i class=" fs-1 text-primary"></i></div>
                        <a class="link-unstyled"
                           href="{{ route('video_games.search', ['search' => '', 'platform' => 'xbox_series', 'genres' => '', 'release_year' => '']) }}">

                            <svg style="margin-top: -2rem" xmlns="http://www.w3.org/2000/svg" width="70" height="70"
                                 fill="green" class="bi bi-xbox"
                                 viewBox="0 0 16 16">
                                <path
                                    d="M7.202 15.967a7.987 7.987 0 0 1-3.552-1.26c-.898-.585-1.101-.826-1.101-1.306 0-.965 1.062-2.656 2.879-4.583C6.459 7.723 7.897 6.44 8.052 6.475c.302.068 2.718 2.423 3.622 3.531 1.43 1.753 2.088 3.189 1.754 3.829-.254.486-1.83 1.437-2.987 1.802-.954.301-2.207.429-3.239.33Zm-5.866-3.57C.589 11.253.212 10.127.03 8.497c-.06-.539-.038-.846.137-1.95.218-1.377 1.002-2.97 1.945-3.95.401-.417.437-.427.926-.263.595.2 1.23.638 2.213 1.528l.574.519-.313.385C4.056 6.553 2.52 9.086 1.94 10.653c-.315.852-.442 1.707-.306 2.063.091.24.007.15-.3-.319Zm13.101.195c.074-.36-.019-1.02-.238-1.687-.473-1.443-2.055-4.128-3.508-5.953l-.457-.575.494-.454c.646-.593 1.095-.948 1.58-1.25.381-.237.927-.448 1.161-.448.145 0 .654.528 1.065 1.104a8.372 8.372 0 0 1 1.343 3.102c.153.728.166 2.286.024 3.012a9.495 9.495 0 0 1-.6 1.893c-.179.393-.624 1.156-.82 1.404-.1.128-.1.127-.043-.148ZM7.335 1.952c-.67-.34-1.704-.705-2.276-.803a4.171 4.171 0 0 0-.759-.043c-.471.024-.45 0 .306-.358A7.778 7.778 0 0 1 6.47.128c.8-.169 2.306-.17 3.094-.005.85.18 1.853.552 2.418.9l.168.103-.385-.02c-.766-.038-1.88.27-3.078.853-.361.176-.676.316-.699.312a12.246 12.246 0 0 1-.654-.319Z"/>
                            </svg>

                            <h3 class="h4  mt-3 text-white">Xbox Series</h3>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>


    <section class="page-section " style="text-shadow: 1px 0 0 #000, 0 -1px 0 #000, 0 1px 0 #000, -1px 0 0 #000;">
        <div class="">
            <div class="row  justify-content-center" id="sugerir">
                <div class="text-center">
                    <p class="text-white mt-0">¿Falta algún juego que te guste?</p>
                    <hr class="divider divider-light"/>

                    <img src="{{asset('images/layton-unscreen.gif')}}" class="w-25" alt="">


                    <p class="text-white mb-2">Envianos tu sugerencia para añadirlo proximamente!
                    </p>
                    <a  href="{{ route('suggestions.suggest') }}" class="text-warning text-decoration-none">Sugerir</a>
                </div>
            </div>
        </div>
    </section>

@endsection


