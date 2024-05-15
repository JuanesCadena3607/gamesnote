<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crear Videojuego</title>
    <style>
        body {
            text-align: center;
            min-height: 100vh;
            background: url({{ asset('images/color3.jpg') }});
            background-size: cover;
            background-repeat: no-repeat;
        }

        .form-container {
            max-width: 80%;
            margin: 0 auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-label {
            font-weight: bold;
            font-size: 14px; /* Tamaño de fuente reducido */
        }

        .form-control {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-sizing: border-box;
        }

        .checkbox-group {
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
        }

        .checkbox-label {
            margin-right: 10px;
            font-size: 14px; /* Tamaño de fuente reducido */
        }

        .btn-primary {
            background-color: #007bff;
            color: #fff;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        .btn-primary:hover {
            background-color: #0056b3;
        }
    </style>
</head>

@extends('layouts.public')

@section('content')
    <div class="form-container" style="margin-top: 5rem">
        <h1>Editar Videojuego</h1>
        <form method="POST" action="{{ route('admin.video_games.update', ['id' => $videoGame->id]) }}" enctype="multipart/form-data">
            @csrf
            @method('PUT') <!-- Para indicar que este formulario enviará una solicitud PUT -->

            <!-- Nombre del juego -->
            <div class="form-group">
                <label for="name" class="form-label">Nombre del juego</label>
                <input type="text" class="form-control" id="name" name="name" value="{{ $videoGame->name }}" required>
            </div>

            <!-- Descripción -->
            <div class="form-group">
                <label for="description" class="form-label">Descripción</label>
                <textarea class="form-control" id="description" name="description" rows="7" required>{{ $videoGame->description }}</textarea>
            </div>

            <!-- Año de lanzamiento -->
            <div class="form-group">
                <label for="release" class="form-label">Fecha de lanzamiento</label>
                <input type="date" class="form-control" id="release" name="release" value="{{ $videoGame->release }}" required>
            </div>

            <!-- Portada -->
            <div class="form-group">
                <label for="cover" class="form-label">Portada</label>
                <input type="file" class="form-control" id="cover" name="cover">
                @if($videoGame->cover)
                    <p class="text- mr-2">Portada actual: <img src="{{ asset('storage/video_game_covers/' . basename($videoGame->cover)) }}" alt="Portada" style="max-width: 200px;"></p>
                @endif
            </div>

            <!-- Box Art -->
            <div class="form-group">
                <label for="box_art" class="form-label">Carátula</label>
                <input type="file" class="form-control" id="box_art" name="box_art">
                @if($videoGame->box_art)
                    <p class="text-muted mt-2 mr-2">Carátula actual: <img src="{{ asset('storage/video_game_box_art/' . basename($videoGame->box_art)) }}" alt="Carátula" style="max-width: 200px;"></p>
                @endif
            </div>

            <!-- Plataformas -->

            <div class="form-group" style="text-align: center;">
                <label class="form-label">Plataformas:</label><br>
                <div class="checkbox-group" style="display: inline-block;">
                    @foreach ($platform as $pla)
                        <div class="form-check form-check-inline" style="display: inline-block;">
                            <input type="checkbox" id="{{ $pla }}" name="platforms[]" value="{{ $pla }}" class="form-check-input" {{ in_array($pla, $videoGame->platform) ? 'checked' : '' }}>
                            <label for="{{ $pla }}" class="form-check-label">{{ ucfirst(str_replace('_', ' ', $pla)) }}</label>
                        </div>
                    @endforeach
                </div>
            </div>
            <!-- Géneros -->
            <div class="form-group " style="padding: 2rem ">
                <label class="form-label  ">Géneros:</label><br>
                <!-- Aquí debes iterar sobre los géneros disponibles y marcar aquellos que estén seleccionados -->
                @foreach ($genres as $genre)
                    <input type="checkbox" id="{{ $genre }}" name="genres[]" value="{{ $genre }}" class="form-check-input" @if (in_array($genre, $videoGame->genres)) checked @endif>
                    <label for="{{ $genre }}" class="checkbox-label mb-2">{{ $genre }}</label>
                @endforeach
            </div>
            @if(session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif
            <!-- Botón de enviar -->
            <button type="submit" id="submitButton" class="btn btn-primary">Actualizar Videojuego</button>
        </form>
    </div>

    <script>
        // JavaScript para verificar si al menos un checkbox está seleccionado antes de enviar el formulario
        document.getElementById('submitButton').addEventListener('click', function(event) {
            // Obtener todos los checkboxes de plataformas
            var platformCheckboxes = document.querySelectorAll('input[name="platforms[]"]');
            var platformChecked = false;
            platformCheckboxes.forEach(function(checkbox) {
                if (checkbox.checked) {
                    platformChecked = true;
                }
            });

            // Obtener todos los checkboxes de géneros
            var genreCheckboxes = document.querySelectorAll('input[name="genres[]"]');
            var genreChecked = false;
            genreCheckboxes.forEach(function(checkbox) {
                if (checkbox.checked) {
                    genreChecked = true;
                }
            });

            // Validar si al menos una plataforma y un género están seleccionados
            if (!platformChecked || !genreChecked) {
                if (!platformChecked) {
                    alert('Debe seleccionar al menos una plataforma.');
                }
                if (!genreChecked) {
                    alert('Debe seleccionar al menos un género.');
                }
                event.preventDefault(); // Evitar la acción por defecto del botón de enviar
            }
        });
    </script>
@endsection
