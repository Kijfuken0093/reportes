
@extends('layouts.repo')
 
<h1>FUNCIONAL</h1>
@section('content')

<form action="{{ route('reportes.store')}}" method="POST">

    <div class="row">
        <div class="col-md-6 mx-auto">
  
    @csrf
  <div>
    <p>NOMBRE:</p><input type="text" name="nombre" placeholder="Nombre del reporte">
    
</div>
    <br>
<div>
 <p>NUMERO DE FILAS:</p>
    <input type="number" name="filas" placeholder="Número de filas" min="0">
</div>
 
  <br>
  <button type="submit">Generar reporte</button>
<br>
  <a href="{{route('index')}}">REGRESAR</a>
</div>  
</div>


</form>
@endsection

  
