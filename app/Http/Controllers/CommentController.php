<?php

namespace App\Http\Controllers;
use App\Http\Controllers\VideoGameController;
use App\Models\VideoGame;

use Illuminate\Http\Request;
use App\Models\Comment; // Asegúrate de importar el modelo Comment

class CommentController extends Controller
{
    public function store(Request $request, VideoGameController $videoGameController)
    {
        // Validación de datos
        $request->validate([
            'text' => 'required|string',
            'rating' => 'required|numeric|min:1|max:10',
            'video_game_id' => 'required|exists:video_games,id',
        ]);

        // Verificar si el usuario ya ha dejado un comentario para el juego
        $existingComment = Comment::where('user_id', auth()->user()->id)
            ->where('video_game_id', $request->video_game_id)
            ->exists();

        // Si el usuario ya ha dejado un comentario para el juego, redirige con un mensaje de error
        if ($existingComment) {
            return redirect()->back()->with('error', 'Ya has dejado un comentario para este juego.');
        }

        // Crear el comentario
        $comment = new Comment();
        $comment->text = $request->text;
        $comment->rating = $request->rating;
        $comment->user_id = auth()->user()->id; // Asocia el comentario con el usuario autenticado
        $comment->video_game_id = $request->video_game_id;
        $comment->save();

        // Recalcula el promedio de calificación del juego
        $videoGameController->calculateAverageRating($request->video_game_id);

        return redirect()->back()->with('success', 'Comentario enviado correctamente.');
    }


    public function delete($id, VideoGameController $videoGameController)
    {
        // Buscar el comentario por su ID
        $comment = Comment::findOrFail($id);

        // Verificar si el usuario autenticado es el propietario del comentario
        if ($comment->user_id === auth()->id() || auth()->user()->role == 1) {
            // Guardar el ID del videojuego asociado antes de eliminar el comentario
            $videoGameId = $comment->video_game_id;

            // Eliminar el comentario
            $comment->delete();

            // Recalcula el promedio de calificación del juego después de eliminar el comentario
            $videoGameController->calculateAverageRating($videoGameId);

            // Redirigir de vuelta con un mensaje de éxito
            return redirect()->back()->with('success', 'Comentario eliminado correctamente.');
        } else {
            // Si el usuario no es el propietario del comentario ni un administrador, redirigir de vuelta con un mensaje de error
            return redirect()->back()->with('error', 'No tienes permiso para eliminar este comentario.');
        }
     }
    public function show($id)
    {
        // Obtener el usuario correspondiente al ID proporcionado
        $user = \App\Models\User::findOrFail($id);

        $comments = \App\Models\Comment::join('video_games', 'comments.video_game_id', '=', 'video_games.id')
            ->where('comments.user_id', $user->id) // Filtrar por el ID del usuario
            ->select('comments.*', 'video_games.name as game_name')
            ->with('videoGame')
            ->get();

        // Cargar los juegos favoritos del usuario con sus imágenes
        $favorites = \App\Models\Favorite::join('video_games', 'favorites.video_game_id', '=', 'video_games.id')
            ->where('favorites.user_id', $user->id)
            ->select('video_games.id as game_id', 'video_games.name as game_name', 'video_games.box_art')
            ->get();

        return view('profile', compact('user', 'comments', 'favorites'));
    }

}

