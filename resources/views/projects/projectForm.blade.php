@extends('layouts.mi-layout')

@section('title', 'Projectos')

@section('contenido')

<div class="col-12">
    <div class="card card-primary">
        <div class="card-header">
          <h3 class="card-title">{{ isset($project) ? 'Actualizar projecto' : 'Crear projecto' }}</h3>
        </div>
        <!-- /.card-header -->
        <!-- form start -->
        @if(isset($project))
            <form action="{{ route('project.update', $project) }}" method="POST">
            @method('PATCH')
        @else
            <form action="{{ route('project.store') }}" method="POST">
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
              <input type="text" class="form-control" name="name" id="nombre" placeholder="Nombre" required value="{{ $project->name ?? '' }}">
            </div>
            <div class="form-group">
                <label for="stauts">Estado</label>
                <select name="status" id="status">
                    @if(isset($project))
                        <option value="{{ $project->status }}">{{ $project->status }}</option>
                    @endif
                    <option value="planificando">planificando</option>
                    <option value="desarrollando">desarrollando</option>
                    <option value="entregado">entregado</option>
                </select>
            </div>
            <div class="form-group">
                <label for="price">Precio</label>
                <input type="number" class="form-control" name="price" id="price" placeholder="Precio" required value="{{ $project->price ?? '' }}">
            </div>
            <div class="form-group">
                <label for="service">Servicio</label>
                <select name="service_id" id="service">
                    @if(isset($project))
                        <option value="{{ $project->service->id }}">{{ $project->service->name }}</option>
                    @endif
                    @foreach ($services as $service)
                        <option value="{{ $service->id }}">{{ $service->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="user">Id del usuario</label>
                <input type="number" class="form-control" name="user_id" id="user" placeholder="Precio" required value="{{ $project->user_id ?? '' }}">
              </div>
            </div>
          <div class="card-footer">
            <button type="submit" class="btn btn-primary">Guardar</button>
          </div>
        </form>
      </div>
  <!-- /.card -->
</div>

@endsection