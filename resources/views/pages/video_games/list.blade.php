@extends('layouts.public')

@section('content')

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="icon" type="image/x-icon" href="assets/controlador.ico" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <title>Lista de juegos</title>
    </head>
        <style>
            body {
                text-align: center;
                min-height: 100vh;
                background: url({{ asset('images/color3.jpg') }});
                background-size: cover;
                background-repeat: no-repeat;
            }

            a {
                text-decoration: none;
            }

            .info {
                color: #fff;
                font-size: 1.2rem;
                margin-top: 2px;
                text-align: center;
                text-decoration: none;
            }

            a img:hover {
                animation: rotateLeftRight 2s infinite linear;
            }

            @keyframes rotateLeftRight {
                0% {
                    transform: rotate(-5deg);
                }
                50% {
                    transform: rotate(5deg);
                }
                100% {
                    transform: rotate(-5deg);
                }
            }

            .img-custom {
                width: 220px;
                height: 300px;
                object-fit: cover;
                border-radius: 10px;
                transition: transform 0.3s;
            }

            .video-game-grid {
                display: grid;
                grid-template-columns: repeat(auto-fill, minmax(215px, 1fr)); /* Define las columnas del grid */

                max-width: 100%; /* 80% del ancho de la pantalla */
                margin: 0 auto; /* Centrar el grid */
                padding: 1rem;
            }

            .game-item {
                text-align: center;
            }

            .search-form {

                width: 380px;
                margin-right: 0.5rem;
                height: 50px;
                background: white;
                box-sizing: border-box;
                border-radius: 25px;
                border: 4px solid white;
                padding: 5px;
                overflow: hidden;
                position: relative;

            }

            .search-input {
                position: absolute;
                top: 0;
                left: 0;
                width: 100%;
                height: 42.5px;
                line-height: 30px;
                outline: 0;
                border: 0;
                font-size: 1em;
                border-radius: 20px;
                padding: 0 20px;
                display: block; /* Mostrar siempre */
            }

            .search-icon {
                box-sizing: border-box;
                padding: 10px;
                width: 42.5px;
                height: 42.5px;
                position: absolute;
                top: 0;
                right: 0;
                border-radius: 50%;
                color: blueviolet;
                text-align: center;
                font-size: 1.2em;

            }

            .search-form:hover .search-icon {
                background: blueviolet;
                color: white;
            }

            .container2 {
                margin-top: 5rem;
            }


            input[type="search"]::-webkit-search-cancel-button {
                -webkit-appearance: none;
            }

            @media screen and (max-width: 768px) {
                #searchForm {
                    display: flex;
                    flex-wrap: wrap;
                    justify-content: center; /* Centra los elementos en el eje principal */
                    align-items: center; /* Centra los elementos en el eje secundario */
                    text-align: center; /* Centra el contenido dentro de los elementos */
                }

                #searchForm .col-md-3, #searchForm .col-md-2 {
                    margin-top: 1rem;
                    width: calc(100% - 2rem); /* Ancho total menos márgenes */
                    max-width: 300px; /* Ancho máximo para evitar que los elementos sean demasiado anchos */
                    margin-left: 1rem;
                }

                #searchForm .col-md-3 select, #searchForm .col-md-2 select {
                    width: 100%; /* Ocupa todo el ancho disponible */
                    font-size: 1.2rem; /* Tamaño de fuente más grande */
                    padding: 0.5rem; /* Espaciado interno más grande */
                }
                .video-game-grid {
                    display: grid;
                    grid-template-columns: repeat(auto-fill, minmax(150px, 1fr)); /* Cambiar el tamaño de las columnas para mostrar más juegos por línea */

                    gap: 10px; /* Espacio entre los elementos */
                    padding:  10px; /* Añadir un poco de espacio a los lados */
                    margin-bottom: 4rem;
                }

                .game-item {
                    text-align: center;
                }

                .img-custom {
                    width: 100%; /* La imagen ocupará todo el ancho del contenedor */
                    height: 80%; /* Altura automática para mantener la proporción */
                    max-width: 150px; /* Ancho máximo para que no se estire demasiado */
                    margin: 0 auto; /* Centrar la imagen horizontalmente */

                }

                .info {
                    font-size: 0.8rem; /* Reducir el tamaño del texto */
                }
            }
        </style>



    <body style="margin-top: 4rem">

    <div class="container2">
        <img src="{{ asset('images/videojuegos.png') }}" alt="" class="img-fluid">
    </div>

    <div class="mt-4">
        <form id="searchForm" action="{{ route('video_games.search') }}" method="GET" class="d-flex justify-content-between align-items-center px-4 mobile-styling">
            <div class="search-form col-md-4">
                <input class="search-input form-control" type="search" placeholder="Buscar Videojuego" name="search">
                <button><i id="searchIcon" class="fa fa-search search-icon"></i></button>
            </div>

            <div class="col-md-3">
                <select name="platform" id="platformSelect" class="form-select" style="margin-right: 45rem">
                    <option value="">Todas las plataformas</option>
                    @foreach ($availablePlatforms as $platform)
                        <option value="{{ $platform }}">{{ ucfirst(str_replace('_', ' ', $platform)) }}</option>
                    @endforeach
                </select>
            </div>

            <div class="col-md-3">
                <select name="genres" id="genres" class="form-select">
                    <option value="">Todos los géneros</option>
                    @foreach ($availableGenres as $genres)
                        <option value="{{ $genres }}">{{ ucfirst(str_replace('_', ' ', $genres)) }}</option>
                    @endforeach
                </select>
            </div>

            <div class="col-md-2">
                <select name="release_year" id="release_year" class="form-select">
                    <option value="">Todos los años</option>
                    @foreach ($years as $year)
                        <option value="{{ $year }}">{{ $year }}</option>
                    @endforeach
                </select>
            </div>
        </form>
    </div>

    <!-- Mostrar la lista de videojuegos -->
    <div>
        <ul>
            @if (request()->has('search'))

                <div class="container" style="margin-bottom: -2rem; margin-top: -0.5rem;">
                    <div class="row justify-content-center">
                        <div class="col-md-6">
                            <form action="{{ route('video_games.list') }}" method="GET">
                                <button id="mostrarTodosBtn" class="btn btn-secondary btn-block" type="submit">Mostrar Todos</button>

                            </form>
                        </div>
                    </div>
                </div>

            @endif
        </ul>
    </div>
    @if ($videoGames->isEmpty())
        <div class="p-4 m-0">
            <div class="" style=" padding: 1rem; background-color: rgba(255, 255, 255, 0.8); font-size: 1.5rem;"><p class="m-0">No se encontraron videojuegos con ese filtro. </p> </div>
        </div>
    @else
        <div class="video-game-grid" style="">

            @foreach ($videoGames->reverse() as $game)
                <div class="game-item">

                    <a href="{{ route('video_games.show', $game->id) }}">
                        <img class="img-custom" src="{{ Storage::url($game->box_art) }}" alt="{{ $game->name }}">

                    </a>
                    <div class="fw-semibold" style="text-shadow: 1px 0 0 #000, 0 -1px 0 #000, 0 1px 0 #000, -1px 0 0 #000;">
                    <a href="{{ route('video_games.show', $game->id) }}"><p class="info">{{ $game->name }}</p></a>
                    </div>
                </div>
            @endforeach
            @endif
        </div>










        <script>
            // Función para almacenar el estado de la búsqueda en el almacenamiento local
            function guardarEstadoBusqueda() {
                const searchInput = document.querySelector('.search-input');
                const platformSelect = document.getElementById('platformSelect');
                const genresSelect = document.getElementById('genres');
                const yearSelect = document.getElementById('release_year');

                localStorage.setItem('search', searchInput.value);
                localStorage.setItem('platform', platformSelect.value);
                localStorage.setItem('genres', genresSelect.value);
                localStorage.setItem('year', yearSelect.value);
            }

            // Función para cargar el estado de la búsqueda desde el almacenamiento local
            function guardarEstadoBusqueda() {
                const searchInput = document.querySelector('.search-input');
                const platformSelect = document.getElementById('platformSelect');
                const genresSelect = document.getElementById('genres');
                const yearSelect = document.getElementById('release_year');

                localStorage.setItem('search', searchInput.value);
                localStorage.setItem('platform', platformSelect.value);
                localStorage.setItem('genres', genresSelect.value);
                localStorage.setItem('year', yearSelect.value); // Guardar el año seleccionado
            }

            // Función para cargar el estado de la búsqueda desde el almacenamiento local
            function cargarEstadoBusqueda() {
                const searchInput = document.querySelector('.search-input');
                const platformSelect = document.getElementById('platformSelect');
                const genresSelect = document.getElementById('genres');
                const yearSelect = document.getElementById('release_year');

                const storedSearch = localStorage.getItem('search');
                const storedPlatform = localStorage.getItem('platform');
                const storedGenres = localStorage.getItem('genres');
                const storedYear = localStorage.getItem('year'); // Obtener el año seleccionado

                if (storedSearch) {
                    searchInput.value = storedSearch;
                }

                if (storedPlatform) {
                    platformSelect.value = storedPlatform;
                }

                if (storedGenres) {
                    genresSelect.value = storedGenres;
                }

                if (storedYear) {
                    // Restaurar el año seleccionado y mostrar solo el año en el filtro de búsqueda
                    yearSelect.value = storedYear; // No necesitas subcadena, ya que solo se almacena el año
                }
            }

            // Llama a la función para cargar el estado de la búsqueda cuando se carga la página
            window.onload = cargarEstadoBusqueda;

            // Llama a la función para guardar el estado de la búsqueda cuando se realiza una búsqueda
            document.getElementById('searchForm').addEventListener('submit', guardarEstadoBusqueda);

            // Agrega un evento de escucha al cambio del filtro de año para guardar el año seleccionado
            document.getElementById('release_year').addEventListener('change', guardarEstadoBusqueda);

            // Agrega un evento de escucha al botón "Mostrar Todos" para eliminar el almacenamiento local
            document.getElementById('mostrarTodosBtn').addEventListener('click', function() {
                localStorage.removeItem('search');
                localStorage.removeItem('platform');
                localStorage.removeItem('genres');
                localStorage.removeItem('year');
            });
        </script>

        @endsection
    </body>


