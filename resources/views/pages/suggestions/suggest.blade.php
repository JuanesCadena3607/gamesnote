<style>
    body {
        background: url({{ asset('images/color3.jpg') }});

    }

    .form-content {
        background: linear-gradient(135deg, #8A2BE2, #800080, #9932CC);
        margin-top: 6rem;
        background-size: cover;
        width: 80%;
        height: 70%;
        border-radius: 25px;
        display: flex;
        flex-direction: column;
        align-items: center; /* Centrar horizontalmente */
        justify-content: center; /* Centrar verticalmente */
        margin-left: auto; /* Centrar horizontalmente */
        margin-right: auto; /* Centrar horizontalmente */

    }



    .form-content h2 {
        color: white;
        font-size: 60px;
        margin-bottom: 20px;
    }

    .formsugerir {
        display: flex;
        flex-direction: column;
        width: 60%;
    }

    label {
        font-size: 20px;
        color: black;
        margin-bottom: 10px;
        font-style: oblique;
    }

    input,
    textarea {
        padding: 17px 14px;
        background-color: white;
        border: 0;
        font-size: 25px;
        color: black;
        margin-bottom: 20px;
        border-radius: 10px;

    }



    .btn2 {
        background-color: purple;
        width: 150px;
        align-self: flex-end;
        cursor: pointer;
        color: white;
        margin-top: 1rem;
        font-size: 1rem;
    }

    .btn2:hover {
        background-color: purple;
    }

    @media (max-width: 991px) {
        .form-content {
            width: 100%; /* Cambiar a 100% */
            height: 50%; /* Cambiar a auto para que se ajuste al contenido */
            margin-top: 8rem;
            padding: 0 20px; /* Agregar un poco de espacio en los lados */

        }

        .formsugerir {
            width: 100%;
        }

        .form-content h2 {
            font-size: 25px; /* Ajustar tamaño de fuente para dispositivos móviles */
            margin-bottom: 20px; /* Ajustar margen inferior para dispositivos móviles */
        }

        input,
        textarea {
            padding: 14px 10px; /* Ajustar relleno */
            font-size: 20px; /* Ajustar tamaño de fuente */
            max-width: 100%; /* Establecer ancho máximo al 100% */
        }

        .btn2 {
            width: 100%; /* Cambiar ancho del botón al 100% */

        }
    }

</style>
@extends('layouts.public')



@section('content')
    <body>
        <div class="form-content">
        <h2 style="margin-bottom: -1rem; margin-top: -4rem">Sugerir un videojuego</h2>
        <h5 class="text-white p-4  text-center"> Deja el juego que quieres que añadamos a
        futuro en la web, procura escribir el nombre de manera correcta, así tendrá más posibilidad de ser añadido.</h5>
        <form class="formsugerir" method="post" action="{{ route('suggestions.sendSuggestion') }}">
            @csrf
            <input type="text" placeholder="Nombre del videojuego" name="name" required>
            <input class="btn2" type="submit" value="Enviar">
        </form>
    </div>

    @if(session('message'))
        <script>
            window.onload = function() {
                alert("{{ session('message') }}");
            }
        </script>
    @endif
    </body>


@endsection

