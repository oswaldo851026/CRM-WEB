
 

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
			<h2>Editar Usuario</h2>
			<br>
		</div>



	<br>
  <form action= "{{url('user') }}/{{$user->id}}" method= "post" enctype="multipart/form-data">
   {{ method_field('PATCH') }}
   {{ csrf_field() }}

	<div class="row">
  <input type="hidden"  name="idusuario" id= '{{$idusuario}}' class="form-control" value= "1">
		
<!--Primera columna -->
		<div class="col-xs-6">
			<div class="form-group" >
			<div class="col-lg-12">
			<label for="nombre" class="col-lg-10">Primer nombre</label>
			<input type="text" tabindex="1" value= "{{$user->first_name}}" name="nombre" id= 'nombre' class="form-control" placeholder="Primer nombre" > <br/>
			</div>
			</div>
			
			<div class="form-group" >
			<div class="col-lg-12">
			<label for="descripcion" class="col-lg-10">Email</label>
			<input type="email"  tabindex="3" name="email" value="{{$user->email}}"  id= 'erp' class="form-control" placeholder="E mail" > <br/>
			</div>
			</div>
			
	


         <div class="form-group" >
			<div class="col-lg-12">
			<label for="password" class="col-lg-10">Password</label>
			<input  type="password"  value= "" tabindex="5" name="password_1" id= 'password_1' class="form-control" placeholder="" > <br/>
			</div>
			</div>

			<div class="form-group" >
			<div class="col-lg-12">
			<label for="usuario" class="col-lg-10">Nombre de usuario</label>
			<input type="text" value= "{{$user->username}}"  tabindex="7" name="usuario" id= 'password_2' class="form-control" placeholder="" > <br/>
			</div>
		  </div>


		</div>




 <!--Segunda columna -->
		<div class="col-xs-6">
      <div class="form-group" >
			<div class="col-lg-12">
			<label for="apellidos" class="col-lg-10">Apellidos</label>
			<input type="text" tabindex="2" value= "{{$user->last_name}}" name="apellidos" id= 'apellidos' class="form-control" placeholder="Apellidos" required> <br/>
			</div>
			</div>
     <div class="form-group" >
			<div class="col-lg-12">
			<label for="proveedor" class="col-lg-10">Rol</label>
			<select required type="text" tabindex="4" name="id_perfil" id= 'id_perfil' class="form-control"  >
            <option value= "">Eliga una opción</option>
            @foreach ($perfiles as $row)
            <?php $selected = ""; if($user->id_perfil == $row->id) {$selected = "selected";} ?>
		    <option {{$selected}} value= {{$row->id}}>{{$row->nombre}}</option>
		      @endforeach
			</select> <br/>
			</div>
	</div>
    
         <div class="form-group" >
			<div class="col-lg-12">
			<label for="password" class="col-lg-10">*Confirmar Password</label>
			<input  type="password"  value= "" tabindex="6" name="password_2" id= 'password_2' class="form-control" placeholder="" > <br/>
			</div>
			</div>

	


	 </div>


  



	<div class= "col-lg-12 col-lg-offset-9 col-xs-12 col-xs-offset-4">
	<br>
	 <button type="submit" class="btn btn-primary">Guardar</button>
	 <a href= {{ url('user') }}  type="submit" class="btn btn-default">Regresar</a>
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