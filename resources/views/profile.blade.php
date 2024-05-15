<style>
    body {
        background: url({{ asset('images/color3.jpg') }});
        background-repeat: no-repeat;
        background-size: cover;
    }

    .marg {
        margin-top: 5rem;
    }

    .logonav {
        width: 102px;

        margin-right: 0.5rem;
        margin-left: 0.5rem;
        margin-top: -1rem;
    }

    .container2 {
        padding: 1rem;
    }

    .brad {
        border-radius: 2rem;
        background-color: rgba(255, 255, 255, 1.2);
        display: flex; /* Usamos flexbox */
        flex-direction: column; /* Alineamos los elementos verticalmente */
        align-items: center; /* Centramos horizontalmente */
        justify-content: center; /* Centramos verticalmente */
        text-align: center; /* Alineamos el texto al centro */
    }

    h2 {
        margin-top: 1rem;
    }

    span {
        color: red;
    }

    .mrimg {
        margin-top: -2.5rem;
    }

    .underline {
        border-bottom: 1px solid black; /* Línea de 1px sólida de color negro */
        padding-bottom: 3px; /* Espacio entre el texto y la línea */
        margin-top: 10px;
    }

    .marplat {
        margin-top: 15px;
        margin-bottom: -2px;
    }


    .comment {
        width: 600px;
        margin: 0 auto;
        border: 2px solid #333;
        padding: 15px;
    }

    .comment h2 {
        text-align: center;
        margin-bottom: 15px;
    }

    .comment .form-control {
        border: none;
        border-bottom: 2px solid #aaa;
        background: white;
        margin-bottom: 10px;
        resize: none;
        outline: none;
    }

    .comment .btn-primary {
        margin-top: 10px;
    }


    .comment-list .card {
        max-width: 300px; /* ajusta el tamaño según tu preferencia */
    }

    .popup {
        position: fixed;
        top: 200px;
        left: 50%;
        transform: translateX(-50%);
        padding: 10px 20px;
        border-radius: 5px;
        color: white;
        z-index: 9999;
    }

    .success {
        background-color: green;
    }

    .error {
        background-color: red;
    }



    @media only screen and (max-width: 600px) {
        .container2.marg {
            padding: 0 10px;
        }

        .col-md-7 {
            width: 100%;
        }

        .col-md-5 {
            width: 100%;
            margin-top: 20px; /* Ajusta el margen superior según sea necesario */
        }





    }


    .comment-box {
        background-color: rgba(255, 255, 255, 1.9);
        width: 500px;
        border-radius: 10px;
        margin-top: 1rem;
        padding: 1rem;
        height: 12rem;
        overflow: auto; /* Cambiado de 'hidden' a 'auto' */
        transition: height 0.3s; /* Agrega una transición suave */
    }

    .comment-box.expanded {
        height: auto; /* Cambia la altura a 'auto' cuando está expandido */
    }

    .expand-button {
        margin-top: 0.5rem;
        display: none; /* Oculta el botón inicialmente */
    }

    .rating-square {
        width: 3rem;
        margin-right: 1.7rem;
        height: 100%;
        background-color: purple;
        color: white;
        font-size: clamp(1rem, 4vw, 2rem);
        display: flex;
        justify-content: center;
        align-items: center;
        border-radius: 10px;
    }

    @media screen and (max-width: 576px) {
        .comment-box {
            width: calc(100% - 2rem); /* Ancho del 100% menos los márgenes */
        }
        .mov{
            padding-top: 2rem;
        }

    }


    .card-item {
        margin: 0 auto;
        width: 50%; /* Tamaño deseado para las tarjetas, en este caso, ocupan la mitad del contenedor */
        margin-bottom: 20px; /* Espacio entre las tarjetas */
    }

    .card {
        border: 1px solid #ccc;
        border-radius: 10px;
        overflow: hidden;
        box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
    }

    .card-img-top {
        width: 100%;
        height: 200px; /* Tamaño deseado para las imágenes */
        object-fit: cover;
    }

    .card-body {
        padding: 10px;
        text-align: center;
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

    .img-custom {
        width: 220px;
        height: 300px;
        object-fit: cover;
        border-radius: 10px;
        transition: transform 0.3s;
    }



    .info {
        color: #fff;
        font-size: 1.2rem;
        margin-top: 2px;
        text-align: center;
        text-decoration: none;
    }
    a {
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

    .corazon{
        color: red;
        font-size: 39px;
    }
    .corazon:hover{
        scale: 117%;
    }




</style>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>

<!-- Agrega esto en la sección head de tu HTML -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

@extends('layouts.public')

@section('content')
    <body>

    <div id="popup-container"></div>
    <div class="container mov" style="margin-top: 4rem">
        <h1 class="text-white text-center " style="text-shadow: 1px 0 0 #000, 0 -1px 0 #000, 0 1px 0 #000, -1px 0 0 #000;">{{ strtoupper($user->name) }}</h1>
        <hr class="text-white"> <!-- Barra horizontal -->

    </div>
    <h2 class="text-white text-center" style="text-shadow: 1px 0 0 #000, 0 -1px 0 #000, 0 1px 0 #000, -1px 0 0 #000;">Juegos favoritos</h2>

    @if($favorites->isEmpty())
        <p class="text-white text-center mt-5 mb-5" style="text-shadow: 1px 0 0 #000, 0 -1px 0 #000, 0 1px 0 #000, -1px 0 0 #000;">No hay juegos favoritos agregados </p>
    @else
    <div class="video-game-grid">

            @foreach ($favorites->reverse() as $favorite)
                <div class="game-item">
                    <div class="position-relative img-custom mx-auto">
                        @if(auth()->check() && (auth()->user()->id == $user->id || auth()->user()->role == 1))
                            <a class="position-absolute bottom-0 end-0" href="{{ route('favorites.remove', $favorite->game_id) }}" onclick="event.preventDefault(); document.getElementById('remove-favorite-form-{{ $favorite->game_id }}').submit();">
                                <i class="fas fa-heart corazon" onclick="removeFavorite({{ $favorite->game_id }})"></i>
                            </a>
                            <form id="remove-favorite-form-{{ $favorite->game_id }}" action="{{ route('favorites.remove', $favorite->game_id) }}" method="POST" style="display: none;">
                                @csrf
                                @method('DELETE')
                            </form>
                        @endif
                        <img class="img-custom p-0" src="{{ Storage::url($favorite->box_art) }}" alt="{{ $favorite->name }}">
                    </div>
                    <div class="fw-semibold">
                        <a class="text-decoration-none" href="{{ route('video_games.show', $favorite->game_id) }}">
                            <h3 class="text-white text-center mt-4" style="text-shadow: 1px 0 0 #000, 0 -1px 0 #000, 0 1px 0 #000, -1px 0 0 #000;">{{ $favorite->game_name }}</h3>
                        </a>
                    </div>
                </div>
            @endforeach
        @endif
    </div>

    <div class="container mov">
        <hr class="text-white ">

    </div>

    <h2 class="text-white text-center" style="text-shadow: 1px 0 0 #000, 0 -1px 0 #000, 0 1px 0 #000, -1px 0 0 #000; margin-bottom: -1rem" >Comentarios</h2>

    <div class="container p-4 d-flex justify-content-center" >
        <div class="row">
            @if($comments->isEmpty())
                @if(auth()->check() && auth()->user()->id == $user->id)
                    <div class="col-md-12">
                        <div class="comment-box d-flex flex-column justify-content-center align-items-center mx-auto">
                            <p class="text-center"  style="text-shadow: 1px 0 0 #000, 0 -1px 0 #000, 0 1px 0 #000, -1px 0 0 #000;">Aún no has puesto comentarios.</p>
                        </div>
                    </div>


                @else
                    <div class="col-md-12">
                        <div class="comment-box d-flex flex-column justify-content-center align-items-center mx-auto">
                            <p class="text-center">Este usuario aún no ha puesto comentarios.</p>
                        </div>
                    </div>
                @endif
            @else
                @foreach($comments as $comment)
                    <div class="col-md-6">
                        <a class="text-decoration-none" href="{{ route('video_games.show', $comment->video_game_id) }}">
                            <h3 class="text-white text-center mt-4" style="text-shadow: 1px 0 0 #000, 0 -1px 0 #000, 0 1px 0 #000, -1px 0 0 #000;">{{ $comment->videoGame->name }}</h3>
                        </a>

                        <div class="comment-box d-flex flex-column mx-auto">
                            <div class="comment-header text-center d-flex justify-content-between align-items-center mb-3">
                                <div class="d-flex">
                                    <div class="rating-square">{{ $comment->rating }}</div>
                                    <h5 class="mb-0" style="margin-top: 0.7rem">{{ $comment->user->name }}</h5>
                                </div>
                                <p class="mb-0 me-3 ">{{ \Carbon\Carbon::parse($comment->created_at)->format('Y-m-d') }}</p>
                            </div>
                            <div style="margin-top: -0.8rem">
                                <p>{{ $comment->text }}</p>
                            </div>
                            @if(auth()->check() && (auth()->user()->id == $user->id || auth()->user()->role == 1))
                                <form action="{{ route('comments.delete', $comment->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button  type="submit" class="btn btn-danger" onclick="return confirm('¿Estás seguro de que deseas eliminar este comentario?')">
                                        <i class="fas fa-trash-alt"></i> <!-- Ícono de basurero -->
                                    </button>
                                </form>
                            @endif

                            <button class="expand-button">Expandir</button>
                        </div>
                    </div>
                @endforeach
            @endif
        </div>
    </div>

    </body>

    <script>
        // Función para mostrar un pop-up con el mensaje y el estilo dado
        function showAlert(message, style) {
            var popupContainer = document.getElementById('popup-container');

            // Crear el elemento de pop-up
            var popup = document.createElement('div');
            popup.className = 'popup ' + style;
            popup.innerHTML = message;

            // Agregar el pop-up al contenedor
            popupContainer.appendChild(popup);

            // Eliminar el pop-up después de 3 segundos
            setTimeout(function() {
                popup.remove();
            }, 1000);
        }

        // Mostrar el pop-up de éxito si existe
        @if(session('success'))
        showAlert('{{ session('success') }}', 'success');
        @endif

        // Mostrar el pop-up de error si existe
        @if(session('error'))
        showAlert('{{ session('error') }}', 'error');
        @endif

        function confirmDelete(gameId) {
            var confirmDelete = confirm("¿Seguro que quieres eliminar este juego de favoritos?");
            if (confirmDelete) {
                document.getElementById('remove-favorite-form-' + gameId).submit();
            }
        }

        function removeFavorite(gameId) {
            // Confirmar la eliminación con el usuario
            var confirmDelete = confirm("¿Seguro que quieres eliminar este juego de favoritos?");

            // Si el usuario confirma, enviar el formulario de eliminación
            if (confirmDelete) {
                document.getElementById('remove-favorite-form-' + gameId).submit();
            }
        }
    </script>
@endsection
