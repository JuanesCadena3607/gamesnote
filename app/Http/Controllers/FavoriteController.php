<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Favorite;
use Illuminate\Support\Facades\Auth;

// Asegúrate de importar el modelo de Favoritos

class FavoriteController extends Controller
{
    /**
     * Agregar o quitar un juego de la lista de favoritos del usuario.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function toggleFavorite(Request $request)
    {
        // Verificar si el usuario está autenticado
        if (!$request->user()) {
            return response()->json(['success' => false, 'error' => 'Usuario no autenticado']);
        }

        // Validar la solicitud
        $request->validate([
            'video_game_id' => 'required|integer', // Asegúrate de que el video_game_id sea un entero
        ]);

        $videoGameId = $request->input('video_game_id');
        $userId = $request->user()->id;

        // Verificar si el juego ya está en la lista de favoritos del usuario
        $isFavorite = Favorite::where('user_id', $userId)->where('video_game_id', $videoGameId)->exists();

        // Si el juego ya está en la lista de favoritos, quitarlo
        if ($isFavorite) {
            Favorite::where('user_id', $userId)->where('video_game_id', $videoGameId)->delete();
            return response()->json(['success' => true, 'message' => 'Juego eliminado de favoritos']);
        } else {
            // Si el juego no está en la lista de favoritos, agregarlo
            Favorite::create([
                'user_id' => $userId,
                'video_game_id' => $videoGameId,
            ]);
            return response()->json(['success' => true, 'message' => 'Juego agregado a favoritos']);
        }
    }

    public function remove($id)
    {
        // Eliminar el favorito con el video_game_id igual a $id
        Favorite::where('video_game_id', $id)->delete();

        return redirect()->back()->with('message', 'Juego eliminado de favoritos.');
    }
}
