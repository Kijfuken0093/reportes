@extends('layouts.layout')

@section('content')

  <h1 style="font-size: 35px">Listado de Personas</h1>
  <a href="{{route('generar-reporte')}}">generar reporte</a>
<ul>
  @foreach($personas as $persona)
<li>
    
      Nombre:{{ $persona->nombre }}-{{$persona->apellidop}}-{{$persona->apellidom}}-{{$persona->codigo}}-{{$persona->ciudad}}-{{$persona->departamento}}-{{$persona->telefono}}-{{$persona->correo}}-{{$persona->detalle}}-{{$persona->empresa}}
      
    
</li>
  @endforeach
</ul>
  {{$personas->links()}}

@endsection

