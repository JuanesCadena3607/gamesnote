<?php

namespace App\Http\Controllers;

use App\Models\Suggestion;
use App\Models\VideoGame;
use Illuminate\Http\Request;

class SuggestionController extends Controller
{


    public function sendSuggestion(Request $request)
    {
        $name = $request->input('name');

        // Buscar si el nombre ya existe en la tabla video_games
        $videoGame = VideoGame::where('name', $name)->first();

        if ($videoGame) {
            return redirect()->back()->with('message', 'El videojuego ya está en la página.');
        }

        // Si el nombre no existe, crear la sugerencia
        $sugerencia = Suggestion::create([
            'name' => $name,
            'video_game_id' => null, // o asigna aquí el ID del videojuego si lo tienes disponible
        ]);

        return redirect()->back()->with('message', 'Suggestion creada con éxito.');
    }

    public function suggest()
    {
        return view('pages.suggestions.suggest');
    }
}
