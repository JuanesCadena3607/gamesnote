<?php

namespace App\Http\Controllers\Admin;
use Illuminate\Support\Facades\Request;

use App\Http\Controllers\Controller;
use App\Models\User;


class AdminUsersController extends Controller
{
    public function index()
    {
        // Verificar si el usuario está autenticado y tiene el rol de administrador
        if (auth()->check() && auth()->user()->role == 1) {
            // Obtener el término de búsqueda
            $search = Request::get('search');

            // Obtener todos los usuarios y aplicar el filtrado si se proporcionó un término de búsqueda
            $users = User::where(function($query) use ($search) {
                if (!empty($search)) {
                    $query->where('name', 'like', '%'.$search.'%');
                }
            })->paginate(10);

            // Devolver la vista del panel de administrador con los usuarios
            return view('admin.users.index', ['users' => $users]);
        }

        // Si el usuario no está autenticado o no tiene el rol de administrador, redirigir a otra página o mostrar un mensaje de error
        return redirect()->route('home')->with('error', 'No tiene permisos para acceder a esta página');
    }
    public function destroy($id)
    {
        // Verificar si el usuario está autenticado y tiene el rol de administrador
        if (auth()->check() && auth()->user()->role == 1) {
            // Encontrar el usuario por su ID
            $user = User::findOrFail($id);

            // Eliminar el usuario
            $user->delete();

            // Redirigir de vuelta con un mensaje
            return redirect()->route('admin.users.index')->with('success', 'El usuario ha sido eliminado correctamente.');
        }

        // Si el usuario no está autenticado o no tiene el rol de administrador, redirigir a otra página o mostrar un mensaje de error
        return redirect()->route('home')->with('error', 'No tiene permisos para realizar esta acción.');
    }

    public function updateRole(Request $request, $id)
    {
        // Obtener el usuario por su ID
        $user = User::findOrFail($id);

        // Verificar si el usuario actualmente es administrador
        if ($user->role == 1) {
            // Si es administrador, cambiar el rol a usuario normal (0)
            $user->role = 0;
            $message = 'Se ha quitado el rol de administrador al usuario correctamente.';
        } else {
            // Si no es administrador, cambiar el rol a administrador (1)
            $user->role = 1;
            $message = 'Se ha asignado el rol de administrador al usuario correctamente.';
        }

        // Guardar el usuario actualizado en la base de datos
        $user->save();

        // Redirigir de vuelta con un mensaje
        return redirect()->route('admin.users.index')->with('success', $message);
    }
}
