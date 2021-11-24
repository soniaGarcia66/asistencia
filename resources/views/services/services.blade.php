@extends('layouts.mi-layout')

@section('title', 'Servicios')

@section('contenido')

<div class="row">
    <div class="col-6">
        <div class="card card-primary">
            <div class="card-header">
              <h3 class="card-title">{{ isset($service) ? 'Actualizar servicio' : 'Crear servicio' }}</h3>
            </div>
            <!-- /.card-header -->
            <!-- form start -->
            @if(isset($service))
                <form action="{{ route('service.update', $service) }}" method="POST">
                @method('PATCH')
            @else
                <form action="{{ route('service.store') }}" method="POST">
            @endif
            
              @csrf 

              @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
              @endif
    
              <div class="card-body">
                <div class="form-group">
                  <label for="nombre">Nombre</label>
                  <input type="text" class="form-control" name="name" id="nombre" placeholder="Nombre" required value="{{ $service->name ?? '' }}">
                </div>
              </div>

              <div class="card-footer">
                <button type="submit" class="btn btn-primary">Guardar</button>
              </div>
            </form>
          </div>
      <!-- /.card -->
    </div>
    <div class="col-6">
        <div class="card">
          <div class="card-header">
            <h3 class="card-title">Listado</h3>
  
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
                  <th>Creacion</th>
                  <th>Actualizacion</th>
                  <th>Acciones</th>
              </thead>
              <tbody>
                  @foreach($services as $ser)
                  <tr>
                      <td>
                          {{ $ser->id }}
                      </td>
                      <td>{{ $ser->name }}</td>
                      <td>{{ $ser->created_at }}</td>
                      <td>{{ $ser->updated_at }}</td>
                      <th>
                          <a href="{{ route('service.edit', $ser) }}" class="btn btn-warning">Actualizar</a>
                          <form action="{{ route('service.destroy', $ser) }}" method="POST" style="display: inline-block;">
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

@endsection