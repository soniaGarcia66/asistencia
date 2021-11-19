@extends('layouts.mi-layout')

@section("title", "Listado de personas")

@section('contenido')

<div class="row">
    <div class="col-12">
      <div class="card">
        <div class="card-header">
          <h3 class="card-title">Responsive Hover Table</h3>

          <div class="card-tools">
            <div class="input-group input-group-sm" style="width: 150px;">
              <input type="text" name="table_search" class="form-control float-right" placeholder="Search">

              <div class="input-group-append">
                <button type="submit" class="btn btn-default">
                  <i class="fas fa-search"></i>
                </button>
              </div>
            </div>
          </div>
        </div>
        <!-- /.card-header -->
        <div class="card-body table-responsive p-0">
          <table class="table table-hover text-nowrap">
            <thead>
              <tr>
                <th>Areas</th>
                <th>Usuario</th>
                <th>ID</th>
                <th>Nombre</th>
                <th>Apellido Paterno</th>
                <th>Apellido Materno</th>
                <th>Codigo</th>
                <th>Correo</th>
                <th>Telefono</th>
              </tr>
            </thead>
            <tbody>
                @foreach($personas as $persona)
                <tr>
                    <td>
                        <ol>
                            @foreach($persona->areas as $area)
                                <li>{{ $area->nombre_area }} </li>
                            @endforeach
                        </ol>                       
                    </td>
                    <td>
                        {{ $persona->user->name }}
                    </td>
                    <td>
                        <a href="{{ route('persona.show', $persona->id) }}">
                            {{ $persona->id }}
                        </a>    
                    </td>
                    <td>{{ $persona->nombre }}</td>
                    <td>{{ $persona->apellido_paterno }}</td>
                    <td>{{ $persona->apellido_materno }}</td>
                    <td>{{ $persona->codigo }}</td>
                    <td>{{ $persona->correo }}</td>
                    <td>{{ $persona->telefono }}</td>
                </tr>
            @endforeach
            </tbody>
          </table>
        </div>
        <!-- /.card-body -->
      </div>
      <!-- /.card -->
    </div>
  </div>
    
@endsection
