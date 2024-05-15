<style>
    /* Media query para dispositivos con un ancho máximo de 767px */
    @media (max-width: 767px) {
        table {
            width: 100% !important; /* Hace que la tabla ocupe el 100% del ancho */
        }
        td{
            font-size: 10px;
        }

    }
</style>
<head>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" integrity="sha512-dT3ZW3aWd0kRzq3ZTc5Kfe0dD7kIusMqvB2QQMmt1VaSefmqeBJ4wWSHtvozKVkqGfusynP+0p7K0Npx0JUKfA==" crossorigin="anonymous" referrerpolicy="no-referrer" />

</head>

    @extends('layouts.admin')
    @section('content')
        <div class=" p-4 mt-5 ">

            <div class="bg-white p-4 rounded">

                <div class="table-responsive">
                    <h2 class=" text-center mb-4" style="color: #000; ">LISTA DE COMENTARIOS</h2>
                    <div class="mb-3">
                        <form action="{{ route('admin.comments.index') }}" method="GET">
                            <div class="input-group">
                                <input type="text" name="search" class="form-control" placeholder="Buscar por nombre de usuario">
                                <button type="submit" class="btn btn-primary">Buscar</button>
                            </div>
                        </form>
                    </div>

                <table class="table mx-auto text-dark"> <!-- Cambiado a text-dark para hacer que el texto sea negro -->
                    <thead>
                    <tr>
                        <th class="text-center">ID</th>
                        <th class="text-center">Usuario</th>
                        <th class="text-center">Videojuego</th>
                        <th class="text-center">Comentario</th>
                        <th class="text-center">Nota</th>
                        <th class="text-center">Acciones</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($comments as $comment)
                        <tr>
                            <td class="text-center">{{ $comment->id }}</td>
                            <td class="text-center">{{ $comment->user->name }}</td>
                            <td class="text-center">{{ $comment->videoGame->name }}</td>
                            <td class="text-center">{{ $comment->text }}</td>
                            <td class="text-center">{{ $comment->videoGame->rating }}</td>
                            <td class="text-center">
                                <div class="btn-group" role="group">
                                    <form title="Eliminar Comentario" id="delete-comment-form-{{ $comment->id }}" action="{{ route('comments.delete', ['id' => $comment->id]) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger" onclick="return confirm('¿Estás seguro de que deseas eliminar este comentario?')">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>

                                </div>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>

            {!! $comments->links() !!} <!-- Paginación -->
        </div>
    </div>
@endsection
