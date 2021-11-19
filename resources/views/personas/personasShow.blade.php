<x-mi-layout> 
    <h1>Informacion de {{ $persona->nombre }}</h1>
    <a href="{{ route('persona.index') }}">Listado de Personas</a>

    <ul>
        <li>{{ $persona->apellido_paterno }}</li>
        <li>{{ $persona->apellido_materno }}</li>
        <li>{{ $persona->codigo }}</li>
        <li>{{ $persona->correo }}</li>
        <li>{{ $persona->telefono }}</li>
    </ul>
    <hr>
    Usuario Creador: {{ $persona->user->name }} ({{ $persona->user->email }})
    <hr>
    <a href="{{ route('persona.edit', $persona) }}">Editar</a>
    <hr>
    <form action="{{ route('persona.destroy', $persona) }}" method="POST">
        @csrf
        @method('DELETE')
        <input type="submit" value="Borrar">
    </form>

</x-mi-layout>