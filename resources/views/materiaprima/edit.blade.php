
 

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
			<h2>Nueva Materia Prima</h2>
			<br>
		</div>



	<br>
 <form action= "{{url('materiaprima') }}/{}" method= "post" enctype="multipart/form-data">
	 <input type="hidden" name="_token" value="{{ csrf_token() }}">
	<div class="row">
  <input type="hidden"  name="idusuario" id= '{{$idusuario}}' class="form-control" value= "1">
		
<!--Primera columna -->
		<div class="col-xs-6">
			<div class="form-group" >
			<div class="col-lg-12">
			<label for="nombre" class="col-lg-10">*Nombre de la materia prima</label>
			<input type="text" tabindex="1" name="nombre" id= 'nombre' class="form-control" placeholder="Primer nombre" required> <br/>
			</div>
			</div>
			
			<div class="form-group" >
			<div class="col-lg-12">
			<label for="descripcion" class="col-lg-10">Descripción</label>
			<input type="text" tabindex="3" name="descripcion" id= 'descripcion' class="form-control" placeholder="Descripcion" > <br/>
			</div>
			</div>
			
			<div class="form-group" >
			<div class="col-lg-12">
			<label for="precio" class="col-lg-10">costo</label>
			<input type="number" tabindex="5" name="costo" id= 'precio' class="form-control" placeholder="costo" > <br/>
			</div>
			</div>
			<div class="form-group" >
			{{-- <div class="col-lg-12">
			<label for="notas" class="col-lg-10">Código de barras</label>
			<input type="codigo_barras" tabindex="9" name="codigo_barras" id= 'codigo_barras' class="form-control" placeholder="código de barras" > <br/>
			</div> --}}
		</div>
		<div class="form-group" >
			<div class="col-lg-12">
			<label for="existencias" class="col-lg-10">Medidas</label>
			
			<select name="medidas" id="" class="form-control">
				<option value="">Eligie una opción</option>
				<option value="toneladas">Toneladas</option>
				<option value="centimetros">Centimetros</option>
				<option value="onzas">Onzas</option>
				<option value="pulgadas">Pulgadas</option>
				<option value="gramos">gramos</option>
			</select>
			</div>
			</div>
		</div>




 <!--Segunda columna -->
		<div class="col-xs-6">
      <div class="form-group" >
			<div class="col-lg-12">
			<label for="codigo" class="col-lg-10">*codigo</label>
			<input type="text" tabindex="2" name="codigo" id= 'email' class="form-control" placeholder="codigo" required> <br/>
			</div>
			</div>
     <div class="form-group" >
			<div class="col-lg-12">
			<label for="proveedor" class="col-lg-10">nombre del proveedor</label>
			<select type="text" tabindex="4" name="id_proveedor" id= 'id_proveedor' class="form-control"  >
            <option value= "">Eliga una opción</option>
            @foreach ($proveedores as $row)
		    <option value= {{$row->id}}>{{$row->razon_social}}</option>
		      @endforeach
			</select> <br/>
			</div>
	</div>

	 <div class="form-group" >
			<div class="col-lg-12">
			<label for="categoria" class="col-lg-10">Categoria</label>
			<select type="text" tabindex="6" name="id_categoria" id= 'id_categoria' class="form-control"  >
            <option value= "">Eliga una opción</option>
            @foreach ($categorias as $row)
		    <option value= {{$row->id}}>{{$row->nombre}}</option>
		      @endforeach
			</select> <br/>
			</div>
	</div>

			
		

         <div class="form-group" >
			<div class="col-lg-12">
			<label for="existencias" class="col-lg-10">Existencias</label>
			<input type="text" readonly value= "0" tabindex="8" name="existencias" id= 'existencias' class="form-control" placeholder="" > <br/>
			</div>
			</div>



	 </div>


   <div class="col-xs-12">
	 <div class="form-group" >
	 <div class="col-lg-12">
	 <label for="comentarios" class="col-lg-10">Comentarios</label>
	 <textarea class="form-control" rows="5" type="text" tabindex="7" name="comentarios" id= 'comentarios'> </textarea> <br/>
	 </div>
    </div>
	</div>

	{{--  <div class="col-xs-4">
	 <div class="form-group" >
	 <div class="col-lg-12">
	 <label for="comentarios" class="col-lg-10">Imagen del producto</label>
	 <input type="file" class="form-control" type="text" tabindex="8" name="imagen_principal" id= 'imagen_principal'>  <br/>
	 </div>
    </div>
	</div> --}}



	<div class= "col-lg-12 col-lg-offset-9 col-xs-12 col-xs-offset-4">
	<br>
	 <button type="submit" class="btn btn-primary">Guardar</button>
	 <a href= {{ url('materiaprima') }}  type="submit" class="btn btn-default">Regresar</a>
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