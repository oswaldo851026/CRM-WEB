
 

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
			<h2>Ver Proveedor</h2>
			<br>
		</div>



	<br>
 <form action= "{{url('proveedores') }}/{{$proveedores->id}}" method= "post" enctype="multipart/form-data">
   {{ method_field('PATCH') }}
   {{ csrf_field() }}
	 <input type="hidden" name="_token" value="{{ csrf_token() }}">
	<div class="row">
  <input type="hidden"  name="idusuario" id= '{{$idusuario}}' class="form-control" value= "1">
	
<!--Primera columna -->
		<div class="col-xs-6">
			<div class="form-group" >
			<div class="col-lg-12">
			<label for="nombre_contacto" class="col-lg-10">*Nombre completo del contacto</label>
			<input readonly type="text" tabindex="1" name="nombre_contacto" id= 'nombre_contacto' value="{{$proveedores->nombre_contacto}}" class="form-control" placeholder="nombre_contacto" required> <br/>
			</div>
			</div>
			
			<div class="form-group" >
			<div class="col-lg-12">
			<label for="direccion" class="col-lg-10">Dirección</label>
			<input readonly type="text" tabindex="3" name="direccion" value="{{$proveedores->direccion}}" id= 'direccion' class="form-control" placeholder="direccion" > <br/>
			</div>
			</div>

			    <div class="form-group" >
			<div class="col-lg-12">
			<label for="razon_social" class="col-lg-10">Razón Social</label>
			<input readonly type="text" tabindex="5" name="razon_social" id= 'razon_social' value="{{$proveedores->razon_social}}" class="form-control" placeholder="razon_social" > <br/>
			</div>
			</div>

			
			
		</div>




 <!--Segunda columna -->
		<div class="col-xs-6">
      <div class="form-group" >
			<div class="col-lg-12">
			<label for="nombre_contacto" class="col-lg-10">Apellido del contacto</label>
			<input readonly type="text" tabindex="2" value= "{{$proveedores->apellido_contacto}}" name="apellido_contacto" id= 'apellido_contacto' class="form-control" placeholder="Primer nombre" required> <br/>
			</div>
			</div>
			<div class="form-group" >
			<div class="col-lg-12">
			<label for="notas" class="col-lg-10">Teléfono</label>
			<input readonly type="number" tabindex="4" name="telefono"  value="{{$proveedores->telefono}}" class="form-control" placeholder="telefono" > <br/>
			</div>
		</div>
	</div>

	 

	<div class= "col-lg-12 col-lg-offset-9 col-xs-12 col-xs-offset-4">
	<br>
	 <a href= {{ url('proveedores') }}  type="submit" class="btn btn-default">Regresar</a>

	 <br>
 </div>

	</div>
</form>
</div>
</div>
</div>
</body>
@endsection