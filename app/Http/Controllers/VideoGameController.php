<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\VideoGame;
use App\Models\Comment;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class VideoGameController extends Controller
{
    public function showList(Request $request)
    {
        // Obtener todos los videojuegos
        $videoGamesQuery = VideoGame::query();

        // Filtrar por búsqueda
        if ($request->has('filter') && $request->input('filter') === 'search' && $request->has('search')) {
            $searchTerm = $request->input('search');
            $videoGamesQuery->where('name', 'like', "%$searchTerm%");
        }

        // Filtrar por plataforma
        if ($request->has('filter') && $request->input('filter') === 'platform' && $request->has('platform')) {
            $platform = $request->input('platform');
            $videoGamesQuery->whereJsonContains('platform', $platform);
        }

        // Filtrar por genero
        if ($request->has('filter') && $request->input('filter') === 'genres' && $request->has('genres')) {
            $genres = $request->input('genres');
            $videoGamesQuery->whereJsonContains('genres', $genres);
        }

        $videoGames = $videoGamesQuery->get();

        $years = VideoGame::distinct()->pluck('release')->map(function ($date) {
            return \Carbon\Carbon::parse($date)->year;
        })
            ->unique() // Obtiene solo los años únicos
            ->sortDesc();





        $videoGames = $videoGamesQuery->get();
        $availablePlatforms = ['steam', 'nintendo_switch', 'playstation_5', 'xbox_series'];
        $availableGenres = [
            'RPG', 'Acción', 'Aventura', 'Estrategia', 'Simulación', 'Puzzle',
            'Deporte', 'Carreras', 'Lucha', 'Terror', 'Disparos', 'Sandbox',
            'Musical', 'Plataformas', 'MMO', 'Educativo', 'Fiesta', 'Arcade',
            'Novela Visual', 'Roguelike'
        ];

        return view('pages.video_games.list', compact('videoGames', 'availablePlatforms', 'years', 'availableGenres'));
    }


    public function create()
    {
        return view('pages.video_games.create');

    }




    public function store(Request $request)
    {
        try {
            // Validar los datos del formulario
            $validatedData = $request->validate([
                'name' => 'required|string|max:255',
                'description' => 'required|string|max:255',
                'release' => 'required|date',
                'cover' => 'required|image',
                'box_art' => 'required|image',
                'platforms' => 'required|array',
                'genres' => 'required|array',
                // Agrega validaciones adicionales si es necesario
            ]);

            // Validar el formato de las plataformas
            $platforms = $validatedData['platforms'];
            if (empty($platforms)) {
                throw new \Exception('Debe seleccionar al menos una plataforma.');
            }

            // Validar el formato de los géneros
            $genres = $validatedData['genres'];
            if (empty($genres)) {
                throw new \Exception('Debe seleccionar al menos un género.');
            }

            // Guardar la imagen de la portada (cover)
            $coverPath = Storage::putFile('public/video_game_covers', $request->file('cover'));

            // Guardar la imagen de la caja (box art)
            $boxArtPath = Storage::putFile('public/video_game_box_art', $request->file('box_art'));

            // Convertir el array de plataformas a JSON
            $validatedData['platform'] = json_encode($platforms);

            // Convertir el array de géneros a JSON
            $validatedData['genres'] = json_encode($genres);

            // Agregar las rutas de las imágenes al array validado
            $validatedData['cover'] = $coverPath;
            $validatedData['box_art'] = $boxArtPath;

            // Crear un nuevo videojuego con los datos del formulario
            $videoGame = VideoGame::create($validatedData);

            // Redirigir a la vista de lista de juegos
            return redirect()->route('video_games.list')->with('success', '¡El videojuego se ha creado correctamente!');
        } catch (\Exception $e) {
            // Manejar errores de validación u otros errores
            return redirect()->back()->withErrors([$e->getMessage()]);
        }
    }


    public function show($id)
    {
        // Obtener el videojuego correspondiente al ID proporcionado
        $videoGame = VideoGame::findOrFail($id);
        $comments = Comment::where('video_game_id', $id)->get();

        // Verificar si el usuario está autenticado y si tiene el juego en favoritos
        $user = Auth::user();
        $isInFavorites = false; // Inicializamos como falso por defecto

        if ($user) {
            $isInFavorites = $user->favorites()->where('video_game_id', $id)->exists();
        }

        // Retornar la vista "show" con el videojuego y la información sobre si está en favoritos
        return view('pages.video_games.show', compact('videoGame', 'comments', 'user', 'isInFavorites'));
    }



    public function search(Request $request)
    {
        $years = VideoGame::distinct()->pluck('release')->map(function ($date) {
            return \Carbon\Carbon::parse($date)->year;
        })
            ->unique() // Obtiene solo los años únicos
            ->sortDesc();
        // Obtener el término de búsqueda desde la solicitud
        $searchTerm = $request->input('search');
        $releaseYear = $request->input('release_year'); // Cambiar a releaseYear

        // Filtrar los videojuegos que coincidan con el término de búsqueda y/o el año de lanzamiento, si se proporcionan
        $videoGamesQuery = VideoGame::query();
        if (!empty($searchTerm)) {
            $videoGamesQuery->where('name', 'like', "%$searchTerm%");
        }
        if (!empty($releaseYear)) {
            $videoGamesQuery->whereYear('release', $releaseYear);
        }

        // Obtener todas las plataformas disponibles
        $availablePlatforms = ['steam', 'nintendo_switch', 'playstation_5', 'xbox_series'];

        //obtener todos los generos disponibles
        $availableGenres = [
            'RPG', 'Acción', 'Aventura', 'Estrategia', 'Simulación', 'Puzzle',
            'Deporte', 'Carreras', 'Lucha', 'Terror', 'Disparos', 'Sandbox',
            'Musical', 'Plataformas', 'MMO', 'Educativo', 'Fiesta', 'Arcade',
            'Novela Visual', 'Roguelike','Metroidvania', 'Soulslike', 'Mundo Abierto'
        ];

        // Verificar si se ha seleccionado una plataforma para filtrar
        if ($request->has('platform')) {
            $platform = $request->input('platform');
            if ($platform && in_array($platform, $availablePlatforms)) {
                // Filtrar los videojuegos que contengan la plataforma seleccionada
                $videoGamesQuery->where(DB::raw("JSON_CONTAINS(platform, '[" . json_encode($platform) . "]')"), true);
            }
        }

        if($request->has('genres')){
            $genres = $request->input('genres');
            if($genres && in_array($genres, $availableGenres)){
                // Filtrar los videojuegos que contengan el género seleccionado
                $videoGamesQuery->where(DB::raw("JSON_CONTAINS(genres, '[" . json_encode($genres) . "]')"), true);
            }
        }

        $videoGames = $videoGamesQuery->get();

        // Pasar los resultados de la búsqueda, los años y las plataformas disponibles a la vista
        return view('pages.video_games.list', compact('videoGames', 'availablePlatforms', 'years', 'availableGenres'));
    }


    public function calculateAverageRating($videoGameId)
    {
        // Obtener la cantidad de comentarios para el videojuego con el ID proporcionado
        $commentCount = Comment::where('video_game_id', $videoGameId)->count();

        // Si hay comentarios asociados al videojuego, calcular el promedio de calificación
        if ($commentCount > 0) {
            $averageRating = Comment::where('video_game_id', $videoGameId)->avg('rating');
        } else {
            // Si no hay comentarios, establecer el rating promedio como null
            $averageRating = null;
        }

        // Actualizar la calificación del videojuego en la base de datos
        VideoGame::where('id', $videoGameId)->update(['rating' => $averageRating]);

        return redirect()->back()->with('success', 'Calificación actualizada correctamente.');
    }






}
