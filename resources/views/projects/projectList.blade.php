@extends('layouts.mi-layout')

@section('title', 'Listado de projectos')

@section('contenido')

<div class="row">
    <div class="col-12">
        <div class="card">
          <div class="card-header">
            <h3 class="card-title">Todos los projectos</h3>
  
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
                  <th>ID</th>
                  <th>Nombre</th>
                  <th>Estado</th>
                  <th>Precio</th>
                  <th>Servicio</th>
                  <th>ID del usuario</th>
                  <th>Creacion</th>
                  <th>Actulizacion</th>
                  <th>Acciones</th>
              </thead>
              <tbody>
                  @foreach($projects as $project)
                  <tr>
                      <td>
                          {{ $project->id }}
                      </td>
                      <td>{{ $project->name }}</td>
                      <td>{{ $project->status }}</td>
                      <td>{{ $project->price }}</td>
                      <td>{{ $project->service->name }}</td>
                      <td>{{ $project->user_id }}</td>
                      <td>{{ $project->created_at }}</td>
                      <td>{{ $project->updated_at }}</td>
                      <th>
                          <a href="{{ route('project.edit', $project) }}" class="btn btn-warning">Actualizar</a>
                          <form action="{{ route('project.destroy', $project) }}" method="POST" style="display: inline-block;">
                              @csrf
                              @method('DELETE')
                              <input type="submit" class="btn btn-danger" value="Eliminar">
                          </form>
                      </th>
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
</div>
    
@endsection