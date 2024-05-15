@extends('layouts.public')

@section('content')
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>GamesNotes</title>
    <!-- Favicon-->
    <link rel="icon" type="image/x-icon" href="assets/controlador.ico" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

</head>
    <style>
        body {
            background: url({{ asset('images/color3.jpg') }});
            background-repeat: no-repeat;
            background-size: cover;
        }

        .marg {
            margin-top: 6rem;
        }

        .logo {
            width: 102px;

            margin-right: 0.5rem;
            margin-left: 0.5rem;
            margin-top: -1rem;
        }

        .container2 {
            padding: 2rem;
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


        .comment-container {
            display: flex;
            flex-wrap: wrap;
        }

        .menmar{
            margin-top: -1.5rem;
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

            .brad {
                text-align: center;
            }

            .rating-square {
                position: static;
                margin-top: 10px; /* Ajusta el margen superior según sea necesario */
            }

            .marplat {
                display: flex;
                justify-content: center;
                align-items: center;
                flex-wrap: nowrap; /* Evita el salto de línea */
            }

            .logo {
                margin: 5px;
                width: 70px; /* Ajusta el tamaño de los íconos según sea necesario */
                height: auto; /* Ajusta la altura automáticamente */
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
                width: 100% !important;
                padding: 1rem;

            }
            .container{
                width: 100% !important;
            }
          .container2{
              margin-top: 8rem;
          }

          .fechamovil{
              margin-left: 2rem;
              padding-top: 0;
          }
            .comment {
                width: 90%; /* Ajusta el ancho del contenedor al 90% del ancho de la pantalla */
                margin: 0 auto; /* Centra el contenedor horizontalmente */
                padding: 15px; /* Añade un poco de espacio interior al contenedor */
                margin-top: 2rem;
            }

            .comment h2 {
                font-size: 1.5rem; /* Reduce el tamaño del título */
            }

            .comment .form-control {
                width: 100%; /* Ajusta el ancho del campo de entrada al 100% del contenedor */
                margin-bottom: 10px; /* Añade espacio entre los campos */
            }

        }

    </style>

    <div class="container2 marg">
        <div class="row align-items-start">
            <div class="col-md-7"> <!-- Cambiamos el ancho de esta columna a 7 -->
                <!-- Contenido para el elemento que ocupa el 60% -->
                <div class="bg-blue-600 mrimg">
                    <img src="{{ Storage::url($videoGame->cover) }}" alt="{{ $videoGame->name }}" class="img-fluid w-100 rounded-circle">
                </div>
            </div>
            <div class="col-md-5 d-flex align-items-start menmar justify-content-center">

                <div class="brad ">
                    <h2 class="underline">{{ $videoGame->name }}</h2>
                    @if ($videoGame->rating !== null)
                        <div class="brad position-relative" style="display: flex; align-items: center; justify-content: center;">
                            <h2 class="underline rating-square" style="height: 4rem; width: 5.34rem; margin: 0; padding: 0;">
                                @php
                                    $rating = $videoGame->rating;

                                    // Verificar si el rating es un número entero
                                    if ($rating == intval($rating)) {
                                        // Si es un número entero, mostrarlo sin decimales
                                        echo number_format($rating, 0);
                                    } else {
                                        // Si no es un número entero, mostrarlo con un decimal
                                        echo number_format($rating, 1);
                                    }
                                @endphp
                            </h2>

                        </div>
                    @endif
                    @if ($videoGame->platform)
                        <div class="d-flex justify-content-center align-items-center marplat ">
                            <!-- Utilizamos flexbox para centrar los logos -->
                            @if (in_array('steam', json_decode($videoGame->platform)))
                                <img src="{{ asset('images/steam_logo.png') }}" alt="Steam Logo" class="logo">
                            @endif

                            @if (in_array('nintendo_switch', json_decode($videoGame->platform)))
                                <img src="{{ asset('images/nintendo_switch_logo.png') }}" alt="Nintendo Switch Logo"
                                     class="logo">
                            @endif

                            @if (in_array('playstation_5', json_decode($videoGame->platform)))
                                <img src="{{ asset('images/playstation_5_logo.png') }}" alt="PlayStation 5 Logo"
                                     class="logo">
                            @endif

                            @if (in_array('xbox_series', json_decode($videoGame->platform)))
                                <img src="{{ asset('images/xbox_series_logo.png') }}" alt="Xbox Series Logo"
                                     class="logo">
                            @endif
                        </div>
                    @else
                        <p>No hay plataformas asociadas a este videojuego.</p>
                    @endif
                    <h5 class="underline" style="margin-top:2px"><span>Géneros</span>
                        @if ($videoGame->genres)
                            @foreach (json_decode($videoGame->genres) as $genre)
                                {{ $genre }}
                                @if (!$loop->last)
                                    , <!-- Agrega una coma si no es el último género -->
                                @endif
                            @endforeach
                        @else
                            No hay géneros asociados a este videojuego.
                        @endif
                    </h5>
                    <h5 class="underline " style="margin-top: -0.2rem">
                        <span>Lanzamiento:</span>
                        {{ \Carbon\Carbon::parse($videoGame->release)->format('d/m/Y') }}
                    </h5>
                    <p class="font-bold p-2" style="margin-top: -0.5rem" >{{ $videoGame->description }}</p>
                    <!-- Condición para mostrar el botón de agregar a favoritos solo si el usuario está autenticado -->
                    @auth
                        <!-- Botón de agregar a favoritos -->
                        <form id="favorite-form" class="mb-3" action="{{ route('toggle.favorite') }}" method="POST" style="margin-top: -1rem">
                            @csrf
                            <input type="hidden" name="video_game_id" value="{{ $videoGame->id }}">
                            <button id="favorite-btn" type="button" class="btn" style="background-color: #800080; color: #ffffff;">
                                <i id="favorite-icon" class="far fa-star"></i>
                                <span id="favorite-text" style="color: white"> Agregar a favoritos</span>
                            </button>
                        </form>


                        <!-- Fin del botón de agregar a favoritos -->
                    @endauth
                    <!-- Fin de la condición -->



                </div>
            </div>
        </div>
    </div>

<div class="card comment" style="border: none; border-radius: 10px">
    <div class="card-body">
        <h3 class="card-title text-center mb-3">Vota y deja un comentario</h3>
        @auth
            <!-- Verificar si el usuario ya ha dejado un comentario para este juego -->
            @php
                $existingComment = $comments->where('user_id', auth()->user()->id)->where('video_game_id', $videoGame->id)->isNotEmpty();
            @endphp

            @if ($existingComment)
                <p class="text-center">Ya has dejado un comentario para este juego.</p>
            @else
                <form method="POST" action="{{ route('comments.store') }}" class="voting-form d-flex">
                    @csrf
                    <input type="hidden" name="video_game_id" value="{{ $videoGame->id }}">

                    <div class="form-group w-50 pe-4">
                        <label for="comment" class=" col-form-label text-md-right">Tu comentario:</label>
                        <div class="">
                            <textarea class="form-control" style="border: purple solid 2px" id="comment" name="text" rows="3" required></textarea>
                        </div>
                    </div>
                    <div class="w-50 d-flex justify-content-between flex-column">
                        <div class="form-group d-flex">
                            <label for="vote" class="col-form-label text-md-right">Tu voto (del 1 al 10):</label>
                            <div class="ms-2">
                                <input type="number" class="form-control" id="vote" name="rating" min="1" max="10" step="0.1" required>
                            </div>
                        </div>
                        <div class="form-group row mb-0">
                            <div class="text-center">
                                <button type="submit" class="btn" style="background-color: purple; color: white ">Enviar</button>
                            </div>
                        </div>
                    </div>

                </form>
            @endif
        @else
            <p class="login-message text-center">Para votar y dejar un comentario, por favor <a href="{{ route('login') }}" style="color: purple">inicia sesión</a>.</p>
        @endauth
    </div>
</div>

    <div class="container p-4 d-flex justify-content-center">
        <div class="row">
            @if($comments->isEmpty())
                <div class="col-md-12">
                    <div class="comment-box d-flex flex-column justify-content-center align-items-center mx-auto">
                        <p class="text-center">Aún no hay comentarios ni notas.</p>
                    </div>
                </div>


            @else
            @foreach($comments as $comment)
                <div class="col-md-6">
                    <div class="comment-box d-flex flex-column mx-auto">
                        <div class="comment-header text-center d-flex justify-content-between align-items-center mb-3">
                            <div class="d-flex">
                                <div class="rating-square ratingmovil">{{ $comment->rating }}</div>
                                <a href="{{ route('profile.show', ['id' => $comment->user->id]) }}" style="color: black; text-decoration: none;">
                                    <h5 class="mb-0 namemovil" style="margin-top: 0.7rem">{{ $comment->user->name }}</h5>
                                </a>

                            </div>
                            <p class="mb-0 me-3 fechamovil">{{ $comment->created_at->format('Y-m-d') }}</p>
                        </div>
                        <div style="margin-top: -0.8rem">
                            <p>{{ $comment->text }}</p>

                        </div>
                        <div class=" text-end" style="margin-right: 2rem"> <!-- Contenedor para alinear a la derecha -->
                            @if(auth()->check() && (auth()->user()->id == $comment->user_id || auth()->user()->role == 1))
                                <!-- Mostrar el botón de eliminar solo si el usuario es el propietario del comentario o es un administrador -->
                                <form action="{{ route('comments.delete', $comment->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger">
                                        <i class="fas fa-trash-alt"></i> <!-- Ícono de basurero -->
                                    </button>
                                </form>
                            @endif

                        </div>

                        <button class="expand-button">Expandir</button>
                    </div>
                </div>
            @endforeach

            @endif
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const expandButtons = document.querySelectorAll('.expand-button');

            expandButtons.forEach(function(button) {
                button.addEventListener('click', function() {
                    const commentBox = this.parentElement;
                    commentBox.classList.toggle('expanded');
                    if (commentBox.classList.contains('expanded')) {
                        button.textContent = 'Contraer';
                    } else {
                        button.textContent = 'Expandir';
                    }
                });

                // Verificar si es necesario mostrar el botón de expansión
                const commentBoxes = document.querySelectorAll('.comment-box');
                commentBoxes.forEach(function(commentBox) {
                    const contentDiv = commentBox.querySelector('div');
                    if (contentDiv.scrollHeight > commentBox.clientHeight) {
                        commentBox.querySelector('.expand-button').style.display = 'block';
                    } else {
                        commentBox.querySelector('.expand-button').style.display = 'none';
                    }
                });
            });
        });
    </script>



<script>

    document.addEventListener('DOMContentLoaded', function() {
        const favoriteBtn = document.getElementById('favorite-btn');
        const favoriteIcon = document.getElementById('favorite-icon');
        const favoriteText = document.getElementById('favorite-text');
        let isFavorite = {{ $isInFavorites ? 'true' : 'false' }};
        const videoGameId = {{ $videoGame->id }};

        // Actualizar la apariencia inicial del botón
        if (isFavorite) {
            favoriteText.textContent = 'Juego Favorito';
            favoriteIcon.classList.remove('far');
            favoriteIcon.classList.add('fas');
        }

        favoriteBtn.addEventListener('click', function() {
            isFavorite = !isFavorite; // Cambiar el estado de favoritos al hacer clic

            // Actualizar el texto y el ícono del botón según el estado de favoritos
            if (isFavorite) {
                favoriteText.textContent = 'Juego Favorito';
                favoriteIcon.classList.remove('far');
                favoriteIcon.classList.add('fas');
            } else {
                favoriteText.textContent = 'Agregar a favoritos';
                favoriteIcon.classList.remove('fas');
                favoriteIcon.classList.add('far');
            }

            // Enviar el estado de favoritos al servidor utilizando AJAX
            const formData = new FormData();
            formData.append('video_game_id', videoGameId);
            formData.append('is_favorite', isFavorite ? 1 : 0);

            fetch('{{ route('toggle.favorite') }}', {
                method: 'POST',
                body: formData,
                headers: {
                    'X-CSRF-Token': '{{ csrf_token() }}'
                }
            })
                .then(response => {
                    if (!response.ok) {
                        throw new Error('Failed to toggle favorite status');
                    }
                    return response.json();
                })
                .then(data => {
                    // Manejar la respuesta del servidor si es necesario
                    console.log(data);
                })
                .catch(error => {
                    console.error(error);
                });
        });
    });
</script>

@endsection
