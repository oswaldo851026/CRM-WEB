
 

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
			<h2>Nuevo Cliente</h2>
			<br>
		</div>



	<br>
 <form action= "{{url('clientes') }}" method= "post" enctype="multipart/form-data">
	 <input type="hidden" name="_token" value="{{ csrf_token() }}">
	<div class="row">
  <input type="hidden"  name="idusuario" id= '{{$idusuario}}' class="form-control" value= "1">
		
<!--Primera columna -->
		<div class="col-xs-6">
			<div class="form-group" >
			<div class="col-lg-12">
			<label for="nombre" class="col-lg-10">*Nombre</label>
			<input type="text" tabindex="1" name="nombre" id= 'nombre' class="form-control" placeholder="Nombre" required> <br/>
			</div>
			</div>
			
			<div class="form-group" >
			<div class="col-lg-12">
			<label for="apellidos" class="col-lg-10">Apellidos</label>
			<input type="text" tabindex="3" name="apellidos" id= 'apellidos' class="form-control" placeholder="Apellidos" > <br/>
			</div>
			</div>
			
			<div class="form-group" >
			<div class="col-lg-12">
			<label for="direccion" class="col-lg-10">Dirección</label>
			<input type="text" tabindex="1" name="direccion" id= 'direccion' class="form-control" placeholder="Dirección" required> <br/>
			</div>
			</div>
			
		</div>




 <!--Segunda columna -->
		<div class="col-xs-6">
      <div class="form-group" >
			<div class="col-lg-12">
			<label for="notas" class="col-lg-10">Razon social</label>
			<input type="razon_social" tabindex="9" name="razon_social" id= 'razon_social' class="form-control" placeholder="Razón social" > <br/>
			</div>
		</div>
     <div class="form-group" >
			<div class="col-lg-12">
			<label for="notas" class="col-lg-10">Descuento</label>
			<input type="numeric" tabindex="9" name="descuento" id= 'descuento' class="form-control" placeholder="Descuento" > <br/>
			</div>
		</div>
		<div class="form-group" >
			<div class="col-lg-12">
			<label for="notas" class="col-lg-10">Telefono</label>
			<input type="numeric" tabindex="9" name="telefono" id= 'telefono' class="form-control" placeholder="telefono" > <br/>
			</div>
		</div>

	
         



	 </div>


   <div class="col-lg-12">
	 <div class="form-group" >
	 <div class="col-lg-12">
	 <label for="comentarios" class="col-lg-10">Comentarios</label>
	 <textarea class="form-control" rows="5" type="text" tabindex="7" name="comentarios" id= 'comentarios'> </textarea> <br/>
	 </div>
    </div>
	</div>

	



	<div class= "col-lg-12 col-lg-offset-9 col-xs-12 col-xs-offset-4">
	<br>
	 <button type="submit" class="btn btn-primary">Guardar</button>
	 <a href= {{ url('clientes') }}  type="submit" class="btn btn-default">Regresar</a>
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