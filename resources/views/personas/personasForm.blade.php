@extends('layouts.mi-layout')

@section("title", "Agregar Persona")

@section("contenido")

@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<div class="row">
    <!-- left column -->
    <div class="col-md-12">
      <!-- general form elements -->
      <div class="card card-primary">
        <div class="card-header">
          <h3 class="card-title">Llenar los campos siguientes:</h3>
        </div>
        <!-- /.card-header -->
        <!-- form start -->
        @if(isset($persona))
            <form action="{{ route('persona.update', $persona) }}" method="POST">
            @method('PATCH')
        @else
            <form action="{{ route('persona.store') }}" method="POST" enctype="multipart/form-data">
        @endif
        
          @csrf 

          <div class="card-body">
            <div class="form-group">
              <label for="nombre">Nombre</label>
              <input type="text" class="form-control" name="nombre" id="nombre" placeholder="Nombre" value="{{ $persona->nombre ?? '' }}">
            </div>
            <div class="form-group">
              <label for="apellidopaterno">Apellido Paterno</label>
              <input type="text" class="form-control" id="apellidopaterno" name="apellido_paterno" placeholder="Apellido Paterno" value="{{ $persona->apellido_paterno ?? ''}}">
            </div>
            <div class="form-group">
              <label for="apellidomaterno">Apellido Materno</label>
              <input type="text" class="form-control" id="apellidopaterno" name="apellido_materno" placeholder="Apellido Materno" value="{{ $persona->apellido_materno ?? ''}}">
            </div>
            <div class="form-group">
            <label for="codigo">Codigo</label>
            <input type="number" class="form-control" id="codigo" name="codigo" placeholder="codigo" value="{{ $persona->codigo ?? ''}}">
            </div>
            <div class="form-group">
            <label for="correo">Correo</label>
            <input type="email" class="form-control" id="correo" name="correo" placeholder="correo" value="{{ $persona->correo ?? ''}}">
            </div>
            <div class="form-group">
            <label for="telefono">Telefono</label>
            <input type="number" class="form-control" id="telefono" name="telefono" placeholder="telefono" value="{{ $persona->telefono ?? ''}}">
            </div>
            <label for="area_id">Servicio:</label>
            <select name="area_id[]" id="area_id" multiple>
                @foreach($areas as $area)
                    <option value="{{ $area->id }}" {{ isset($persona) && array_search($area->id, $persona->areas->pluck('id')->toArray()) !== false ? 'selected' : '' }}>
                        {{ $area->nombre_area }}
                    </option>
                @endforeach
            </select>
          <!-- /.card-body -->
            <br>
            <input type="file" name="archivo">
            <br>
          <div class="card-footer">
            <button type="submit" class="btn btn-primary">Guardar</button>
          </div>
        </form>
      </div>
      <!-- /.card -->
    </div>
</div>


    {{-- @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    @if(isset($persona))
        <form action="{{ route('persona.update', $persona) }}" method="POST">
        @method('PATCH')
    @else
        <form action="{{ route('persona.store') }}" method="POST">
    @endif
        
        @csrf 
        <label for="nombre">Nombre: </label>
        <input type="text" name="nombre" value="{{ $persona->nombre ?? '' }}">
        <br>
        <label for="apellido_paterno">Apellido Paterno: </label>
        <input type="text" name="apellido_paterno" value="{{ $persona->apellido_paterno ?? ''}}">
        <br>
        <label for="apellido_materno">Apellido Materno: </label>
        <input type="text" name="apellido_materno" value="{{$persona->apellido_materno ?? ''}}">
        <br>
        <label for="codigo">Clave/Codigo: </label>
        <input type="text" name="codigo" value="{{$persona->codigo ?? ''}}">
        <br>
        <label for="correo">Correo: </label>
        <input type="text" name="correo" value="{{$persona->correo ?? ''}}">
        <br>
        <label for="telefono">Telefono: </label>
        <input type="text" name="telefono"value="{{$persona->telefono ?? ''}}">
        <br>
        <label for="area_id">Area:</label>
        <select name="area_id[]" id="area_id" multiple>
            @foreach($areas as $area)
                <option value="{{ $area->id }}" {{ isset($persona) && array_search($area->id, $persona->areas->pluck('id')->toArray()) !== false ? 'selected' : '' }}>
                    {{ $area->nombre_area }}
                </option>
            @endforeach
        </select>
        <input type="submit" value="Guardar">

    </form> --}}


@endsection