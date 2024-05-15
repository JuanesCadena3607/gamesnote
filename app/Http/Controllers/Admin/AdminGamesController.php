<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Comment;
use App\Models\VideoGame;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AdminGamesController extends Controller
{
    public function indexAdmin(Request $request)
    {
        // Verificar si el usuario está autenticado y tiene el rol de administrador
        if (auth()->check() && auth()->user()->role == 1) {
            // Obtener el término de búsqueda
            $search = $request->query('search');

            // Consulta de videojuegos con filtrado por término de búsqueda si está presente
            $query = VideoGame::query();
            if ($search) {
                $query->where('name', 'like', '%' . $search . '%');
            }
            $videoGames = $query->simplePaginate(10);

            // Devolver la vista del panel de administrador con los videojuegos
            return view('admin.videogames.index', ['videoGames' => $videoGames, 'search' => $search]);
        }

        // Si el usuario no está autenticado o no tiene el rol de administrador, redirigir a otra página o mostrar un mensaje de error
        return redirect()->route('home')->with('error', 'No tiene permisos para acceder a esta página');
    }



    public function deleteVideoGame($id)
    {
        $videoGame = VideoGame::find($id);

        if (!$videoGame) {
            return redirect()->back()->with('error', 'El videojuego no existe.');
        }


        Comment::whereHas('videoGame', function ($query) use ($id) {
            $query->where('video_game_id', $id);
        })->delete();

        // Eliminar el videojuego
        $videoGame->delete();

        return redirect()->back()->with('success', 'El videojuego y sus comentarios han sido eliminados correctamente.');
    }



    public function create()
    {
        return view('admin.videogames.create');

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

            // Generar nombres de archivo únicos para la portada y la carátula
            $coverName = $validatedData['name'] . '_cover.' . $request->cover->extension();
            $boxArtName = $validatedData['name'] . '_box_art.' . $request->box_art->extension();

            // Almacenar la portada y la carátula con los nombres de archivo únicos
            $validatedData['cover'] = $request->cover->storeAs('public/video_game_covers', $coverName);
            $validatedData['box_art'] = $request->box_art->storeAs('public/video_game_box_art', $boxArtName);

            // Convertir el array de plataformas a JSON
            $validatedData['platform'] = json_encode($platforms);

            // Convertir el array de géneros a JSON
            $validatedData['genres'] = json_encode($genres);

            // Crear un nuevo videojuego con los datos del formulario
            $videoGame = VideoGame::create($validatedData);

            // Redirigir a la vista de lista de juegos
            return redirect()->route('admin.video_games.index')->with('success', '¡El videojuego se ha creado correctamente!');
        } catch (\Exception $e) {
            // Manejar errores de validación u otros errores
            return redirect()->back()->withErrors([$e->getMessage()]);
        }
    }


    public function update(Request $request, $id)
    {
        try {
            // Encuentra el videojuego por su ID
            $videoGame = VideoGame::findOrFail($id);

            // Validar los datos del formulario
            $validatedData = $request->validate([
                'name' => 'required|string|max:255',
                'description' => 'required|string|max:255',
                'release' => 'required|date',
                'platforms' => 'required|array',
                'genres' => 'required|array',
            ]);

            // Validar el formato de las plataformas y géneros
            if (empty($validatedData['platforms'])) {
                throw new \Exception('Debe seleccionar al menos una plataforma.');
            }

            if (empty($validatedData['genres'])) {
                throw new \Exception('Debe seleccionar al menos un género.');
            }

            // Verificar si se envía una nueva imagen de portada
            if ($request->hasFile('cover')) {
                // Eliminar la imagen anterior si existe
                Storage::delete($videoGame->cover);

                // Almacenar la nueva imagen de portada con un nombre de archivo único
                $coverName = $validatedData['name'] . '_cover.' . $request->cover->extension();
                $validatedData['cover'] = $request->file('cover')->storeAs('public/video_game_covers', $coverName);
            }

            // Verificar si se envía una nueva imagen de carátula
            if ($request->hasFile('box_art')) {
                // Eliminar la imagen anterior si existe
                Storage::delete($videoGame->box_art);

                // Almacenar la nueva imagen de carátula con un nombre de archivo único
                $boxArtName = $validatedData['name'] . '_box_art.' . $request->box_art->extension();
                $validatedData['box_art'] = $request->file('box_art')->storeAs('public/video_game_box_art', $boxArtName);
            }

            // Convertir el array de plataformas y géneros a JSON
            $validatedData['platform'] = json_encode($validatedData['platforms']);
            $validatedData['genres'] = json_encode($validatedData['genres']);

            // Actualizar los atributos del videojuego con los datos del formulario
            $videoGame->update($validatedData);

            // Redirigir a la vista de lista de juegos con un mensaje de éxito
            return redirect()->route('admin.video_games.index')->with('success', '¡El videojuego se ha actualizado correctamente!');
        } catch (\Exception $e) {
            // Manejar errores de validación u otros errores
            return redirect()->back()->withErrors([$e->getMessage()])->withInput();
        }
    }



    public function edit($id)
    {
        try {
            // Encuentra el videojuego por su ID
            $videoGame = VideoGame::findOrFail($id);

            $videoGame->platform = json_decode($videoGame->platform);

            $videoGame->genres = json_decode($videoGame->genres);

            $platform = ['steam', 'nintendo_switch', 'playstation_5', 'xbox_series']; // Ejemplo, reemplaza esto con tus propias plataformas obtenidas de la base de datos
            $genres = ['RPG', 'Acción', 'Aventura', 'Estrategia', 'Simulación', 'Puzzle', 'Deporte', 'Carreras', 'Lucha', 'Terror', 'Disparos', 'Sandbox', 'Plataformas', 'MMO', 'Novela Visual', 'Roguelike', 'Metroidvania', 'Soulslike', 'Mundo Abierto'];

            return view('admin.videogames.edit', compact('videoGame', 'genres', 'platform'));
        } catch (\Exception $e) {
            // Manejar errores
            return redirect()->back()->withErrors([$e->getMessage()]);
        }
    }
}
