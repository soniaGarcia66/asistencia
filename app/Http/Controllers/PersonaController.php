<?php

namespace App\Http\Controllers;

use App\Models\Area;
use App\Models\Persona;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;

//use Illuminate\Support\Facades\DB;//agregue esto, no funciono

class PersonaController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->except('index');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {     
        $personas = Persona::all();
        //$personas = Auth::user()->personas;//()->get();es igual,/ ó ->toSql(); para hacer validaciones, utilizar depende de lo que necesitemos

        return view('personas/personasIndex', compact('personas'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    //ESTE METODO SERIA EL EQUIVLNTE A CUANDO RECIBO EL FORM, ESTE NO GUARDA 
    //NINGUNA VISTA PERO SI TIENE QUE EXISTIR DENTRO DE LAS RUTAS
    public function create()
    {
        //ARCH. DE VISTA
        $areas = Area::all();//AGREGAR LA LIBRERIA
        return view('personas.personasForm', compact('areas'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)//Recibe la info del formulario
    {
        $request->validate([
            'nombre' => 'required|max:255',
            'apellido_paterno' => 'required|max:255',
            'apellido_materno' => 'max:255',
            //'codigo' => 'required|max:255|unique:App\Models\Persona,codigo',
            //'correo' => 'email|max:255',
            'telefono' => 'max:50',
        ]);
        // $request->file('archivo);
        $ruta = $request->archivo->store('imagenes');
        $mime = $request->archivo->getClientMimeType();
        $nombre_original = $request->archivo->getClientOriginalName();

        //Crear registro utilizando modelo
        //dd($request->all());
        //$persona = new Persona($request->all()); //OPC 1
        //Auth::user()->personas()->save($persona);

        $request->merge([ //OPC 2
            'archivo_original' => $nombre_original,
            'archivo_ruta' => $ruta,
            'mime' => $mime,
            'user_id' => Auth::id(), //Proporciona la info del usuario que no viene en el formulario para que la tenga en el request y la pueda insertar y asignar lo de el usuario loggeado
            'apellido_materno' => $request->apellido_materno ?? ''
        ]);
        $persona = Persona::create($request->all()); //crear el nuevo registro
        $persona->areas()->attach($request->area_id); //lo pasamos a nueva variable y lo relaciono al metodo attach 

        /*
        $persona = new Persona();
        $persona->nombre = $request->nombre; 
        $persona->apellido_paterno = $request->apellido_paterno;
        $persona->apellido_materno = $request->apellido_materno ?? '';
        $persona->codigo = $request->codigo ?? '';
        $persona->correo = $request->correo ?? '';
        $persona->telefono = $request->telefono ?? '';
        $persona->save(); */

        return redirect()->route('persona.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Persona  $persona
     * @return \Illuminate\Http\Response
     */
    public function show(Persona $persona)
    {
        return view('personas.personasShow', compact('persona'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Persona  $persona
     * @return \Illuminate\Http\Response
     */
    public function edit(Persona $persona)
    {
        $areas = Area::all();
        return view('personas.personasForm', compact('persona', 'areas'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Persona  $persona
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Persona $persona)//recibimos la instancia de la persona
    {
        //dd('si llego al metodo update');
        $request->validate([
            'nombre' => 'required|max:255',
            'apellido_paterno' => 'required|max:255',  
            'apellido_materno' => 'max:255',
            'codigo' => [
                'required',
                Rule::unique('personas')->ignore($persona->id),//Variable a ignorar
            ],
            'correo' => 'email|max:255',
            'telefono' => 'max:50',
        ]);
        //Crear registro utilizando modelo

        Persona::where('id', $persona->id) //Seleccionar el registro que queremos modificar
            ->update($request->except('_token', '_method', 'area_id'));//en lugar de except podriamos utilizar only(y pasar las variables que si quiero), con except le decimos cuales columnas no queremos
            
        $persona->areas()->sync($request->area_id);
            //Update recibe un arreglo y tambien podemos recibir arreglos masivos
        /*
        $persona->nombre = $request->nombre;
        $persona->apellido_paterno = $request->apellido_paterno;
        $persona->apellido_materno = $request->apellido_materno ?? '';
        $persona->codigo = $request->codigo ?? '';
        $persona->correo = $request->correo ?? '';
        $persona->telefono = $request->telefono ?? '';
        $persona->save();
        */
        return redirect()->route('persona.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Persona  $persona
     * @return \Illuminate\Http\Response
     */
    public function destroy(Persona $persona)
    {
        $persona->delete();
        return redirect()->route('persona.index');
    }

    public function descargarArchivo(Persona $persona)
    {
        $headers = ['Content-Type' => $persona->mime];
        return Storage::download($persona->archivo_ruta, $persona->archivo_original, $headers);
    }
}
