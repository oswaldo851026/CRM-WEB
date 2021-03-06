
 




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
			<h2>Nuevo Almacen</h2>
			<br>
		</div>



	<br>
 <form action= "{{url('almacenes') }}" method= "post" enctype="multipart/form-data">
	 <input type="hidden" name="_token" value="{{ csrf_token() }}">
	<div class="row">
  <input type="hidden"  name="idusuario" id= '{{$idusuario}}' class="form-control" value= "1">
		
<!--Primera columna -->
		<div class="col-xs-6">
			<div class="form-group" >
			<div class="col-lg-12">
			<label for="nombre_almacen" class="col-lg-10">Nombre del Almacen</label>
			<input type="text" tabindex="1" name="nombre_almacen" id= 'nombre_almacen' class="form-control" placeholder="nombre del almacen" required> <br/>
			</div>
			</div>

			 <div class="form-group" >
			<div class="col-lg-12">
			<label for="descripcion" class="col-lg-10">Prioridad de entrada</label>
			<input type="number" tabindex="3" name="prioridad_entrada" id= 'prioridad_entrada' class="form-control" placeholder="Escriba un numero. El numero menor es prioritario" > <br/>
			</div>
			</div>
	

			<div class="form-group" >
			<div class="col-lg-12">
			<label for="nombre_almacen" class="col-lg-10">Tipo de almacenamiento</label>
			<select type="text" tabindex="5" name="tipo_almacen" id= 'nombre_almacen' class="form-control" placeholder="Primer nombre" required>
            <option value= "">Seleccione una opción</option>
            <option value= "materia prima">Materia prima</option>
            <option value= "producto">Producto</option>
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
			<input type="text" tabindex="2" name="descripcion" id= 'descripcion' class="form-control" placeholder="descripcion breve del almacen" required> <br/>
			</div>
			</div>

	        <div class="form-group" >
			<div class="col-lg-12">
			<label for="descripcion" class="col-lg-10">Prioridad de salida</label>
			<input type="number" tabindex="4" name="prioridad_salida" id= 'prioridad_salida' class="form-control" placeholder="Escriba un numero. El numero menor es prioritario" required> <br/>
			</div>
			</div>

				 <div class="form-group" >
			<div class="col-lg-12">
			<label for="descripcion" class="col-lg-10">Capacidad máxima</label>
			<input type="number" tabindex="6" name="capacidad" id= 'capacidad' class="form-control" placeholder="capacidad" required> <br/>
			</div>
			</div>

		
	 </div>


	



	<div class= "col-lg-12 col-lg-offset-9 col-xs-12 col-xs-offset-4">
	<br>
	 <button type="submit" class="btn btn-primary">Guardar</button>
	 <a href= {{ url('almacen') }}  type="submit" class="btn btn-default">Regresar</a>
	 <button type="reset" class="btn btn-danger">Cancelar</button>
	 <br>
 </div>

	</div>
</form>
</div>
</div>
</div>
</body>
@endsection