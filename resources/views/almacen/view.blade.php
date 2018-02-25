
 

<head>
<link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
</head>
@extends('layouts.app')

@section('content')
 
<body>

 <div class="container">
   <div class="row">	
   <div class="panel panel-default">	

		<div class="col-xs-12 ">
			<br>
			<h2>Ver almacén</h2>
			<br>
		</div>



	<br>
 <form action= "{{url('almacenes') }}/{{$almacen->id}}" method= "post" enctype="multipart/form-data">
	   {{ method_field('PATCH') }}
   {{ csrf_field() }}
	<div class="row">
  <input type="hidden"  name="idusuario" id= '{{$idusuario}}' class="form-control" value= "1">
		
<!--Primera columna -->
		<div class="col-xs-6">
			<div class="form-group" >
			<div class="col-lg-12">
			<label for="nombre_almacen" class="col-lg-10">Nombre del Almacén</label>
			<input readonly type="text" value= "{{$almacen->nombre_almacen}}" tabindex="1" name="nombre_almacen" id= 'nombre_almacen' class="form-control" placeholder="nombre del almacen" required> <br/>
			</div>
			</div>

			 <div class="form-group" >
			<div class="col-lg-12">
			<label for="descripcion" class="col-lg-10">Prioridad de entrada</label>
			<input readonly type="number" value= "{{$almacen->prioridad_entrada}}" tabindex="3" name="prioridad_entrada" id= 'prioridad_entrada' class="form-control" placeholder="Escriba un numero. El numero menor es prioritario" > <br/>
			</div>
			</div>
	

			<div class="form-group" >
			<div class="col-lg-12">
			<label for="nombre_almacen" class="col-lg-10">Tipo de almacenamiento</label>
			<select disabled type="text" tabindex="5" name="tipo_almacen" id= 'nombre_almacen' class="form-control" placeholder="Primer nombre" required>
            <?php $array = ["materia prima" => "Materia prima", "producto" => "Producto"] ?>
			<option value= "">Seleccione una opción</option>
			@foreach ($array as $key => $name)
			<?php $selected = ""; if($almacen->tipo_almacen == $key ) { $selected = "selected";} ?>
            <option {{$selected}} value= "{{$key}}">{{$name}}</option>
            @endforeach
			</select>
			 <br/>
			</div>
			</div>
              
			
 
			
   </div>





 <!--Segunda columna -->
		<div class="col-xs-6">
      <div class="form-group" >
			<div class="col-lg-12">
			<label for="descripcion" class="col-lg-10">Descripción</label>
			<input readonly type="text" tabindex="2" value= "{{$almacen->descripcion}}" name="descripcion" id= 'descripcion' class="form-control" placeholder="descripcion breve del almacen" required> <br/>
			</div>
			</div>

	        <div class="form-group" >
			<div class="col-lg-12">
			<label for="descripcion" class="col-lg-10">Prioridad de salida</label>
			<input readonly type="number" tabindex="4" name="prioridad_salida" id= 'prioridad_salida' value= "{{$almacen->prioridad_salida}}" class="form-control" placeholder="Escriba un numero. El numero menor es prioritario" required> <br/>
			</div>
			</div>

				 <div class="form-group" >
			<div class="col-lg-12">
			<label for="descripcion" class="col-lg-10">Capacidad máxima</label>
			<input readonly  type="number" tabindex="6"  value= "{{$almacen->capacidad}}" name="capacidad" id= 'capacidad' class="form-control" placeholder="capacidad" required> <br/>
			</div>
			</div>

		
	 </div>


	



	<div class= "col-lg-12 col-lg-offset-9 col-xs-12 col-xs-offset-4">
	<br>

	 <a href= {{ url('almacenes') }}  type="submit" class="btn btn-default">Regresar</a>

	 <br>
 </div>

	</div>
</form>
</div>
</div>
</div>
</body>
@endsection