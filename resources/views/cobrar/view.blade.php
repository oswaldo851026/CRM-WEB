

 

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
			<h2>Ver Cuenta de cobro</h2>
			<br>
		</div>



	<br>
 <form action= "{{url('cobrar') }}" method= "post">
	 <input type="hidden" name="_token" value="{{ csrf_token() }}">
	<div class="row">
  <input type="hidden"  name="idusuario" id= '{{$idusuario}}' class="form-control" value= "1">
		
<!--Primera columna -->
		<div class="col-xs-6">
			<div class="form-group" >
			<div class="col-lg-12">
			<label for="estatus" class="col-lg-10">Estatus</label>
			<input  readonly type="text" tabindex="1" name="estatus" id= 'estatus' class="form-control" placeholder=" Estatus" required> <br/>
			</div>
			</div>
			
			<div class="form-group" >
			<div class="col-lg-12">
			<label for="monto" class="col-lg-10">Monto</label>
			<input readonly type="number" tabindex="5" name="monto" id= 'monto' class="form-control" placeholder="monto" > <br/>
			</div>
		</div>
		</div>




 <!--Segunda columna -->
		<div class="col-xs-6">
     <div class="form-group" >
			<div class="col-lg-12">
			<label for="detalle_ordenes_compras" class="col-lg-10">Orden de Compra</label>
			<select disabled type="text" tabindex="4" name="id_ordencompra" id= 'id_ordencompra' class="form-control"  >
            <option value= "">Eliga una opción</option>
            @foreach ($detalle_ordenes_compras as $row)
		    <option value= {{$row->id}}>{{$row->id_ordencompra}}</option>
		      @endforeach
			</select> <br/>
			</div>
	</div>

	 <div class="form-group" >
			<div class="col-lg-12">
			<label for="proveedores" class="col-lg-10">Proveedor</label>
			<select disabled type="text" tabindex="6" name="id_proveedor" id= 'id_proveedor' class="form-control"  ><!--CAMBIE id_proveedor POR id clientes-->
            <option value= "">Eliga una opción</option>
            @foreach ($proveedores as $row)
		    <option value= {{$row->id}}>{{$row->razon_social}}</option>
		      @endforeach
			</select> <br/>
			</div>
	  </div>
	 </div>

	<div class= "col-lg-12 col-lg-offset-9 col-xs-12 col-xs-offset-4">
	<br>

	 <a href= {{ url('cobrar') }}  type="submit" class="btn btn-default">Regresar</a>
	
	 <br>
 </div>

	</div>
</form>
</div>
</div>
</div>
</body>
@endsection