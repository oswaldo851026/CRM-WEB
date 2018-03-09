

<head>

<style>
    

   .select2-selection--single {
    box-sizing: border-box !important;
    cursor: pointer !important ;
    display: block !important ;
    height: 36px !important ;
    user-select: none !important;
    -webkit-user-select: none !important;
    background-color: #fff !important;
    border: 1px solid #ccd0d2 !important;
}

</style>
 
<link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
<script src="<?= env('APP_URL'); ?>/js/jquery-3.3.1.js" type="text/javascript"></script>



</head>

@extends('layouts.app')

@section('content')





<body>

 <div class="container">
   <div class="row">	
   <div class="panel panel-default">	

		<div class="col-xs-12 ">
			<br>
			<h2>Nuevo pedido</h2>
		
		</div>

<div class="col-xs-12 ">
		
			<h3>Detalles generales</h3>
			<br>
		</div>


	<br>
 <form action= "{{url('pedidos') }}" method= "post" enctype="multipart/form-data">
	 <input type="hidden" name="_token" value="{{ csrf_token() }}">
	<div class="row">
  <input type="hidden"  name="idusuario" id= '{{$idusuario}}' class="form-control" value= "1">
		
<!--Primera columna -->
		<div class="col-xs-6">
			<div class="form-group" >
			<div class="col-lg-12">
			<label for="asunto" class="col-lg-10">*Asunto</label>
			<input type="text" tabindex="1" name="asunto" id= 'asunto' class="form-control" placeholder="Asunto" required> <br/>
			</div>
			</div>
			
			 <div class="form-group" >
			<div class="col-lg-12">
			<label for="estatus" class="col-lg-10">Estatus</label>
			<select type="text" tabindex="3" name="estatus" id= 'estatus' class="form-control"  >
            <option value= "creado">Creado</option>
            <option value= "enviado">Enviado</option>
			</select> <br/>
			</div>
	        </div>

			
		</div>




 <!--Segunda columna -->
		<div class="col-xs-6">
     	 
     	 <div class="form-group" >
			<div class="col-lg-12">
			<label for="metodo_pago" class="col-lg-10">*Método de pago</label>
			<select required type="text" tabindex="2" name="metodo_pago" id= 'metodo_pago' class="form-control"  >
            <option value= "creado">Efectivo</option>
            <option value= "enviado">Crédito</option>
			</select> <br/>
			</div>
	        </div>
     

    
	         <div class="form-group" >
			<div class="col-lg-12">
			<label for="idvendedor" class="col-lg-10">Vendedor asignado</label>
			<select type="text" tabindex="4" name="idvendedor" id= 'idvendedor' class="form-control"  >
            @foreach($lista_usuarios as $row)
            <?php $selected = ""; if($row->id == $idusuario){ $selected = "selected";} ?>
            <option {{$selected}} value= "{{$row->id}}">{{$row->first_name}}</option>
            @endforeach
			</select> <br/>
			</div>
	        </div>



	 </div>


   <div class="col-xs-12">
	 <div class="form-group" >
	 <div class="col-lg-12">
	 <label for="comentarios" class="col-lg-10">Comentarios</label>
	 <textarea style="height: 70px;" class="form-control" rows="5" type="text" tabindex="5" name="comentarios" id= 'comentarios'> </textarea> <br/>
	 </div>
    </div>
	</div>

 
<div class="col-xs-12 ">
<div class="col-xs-12 ">
		
			<h3>Cliente</h3> 
			
</div>
</div>



	    <div class="col-xs-12">
  
        <div class="form-group" >
			<div class="col-lg-12">
			
			<label class="radio-inline optradio"><input tabindex="6" checked type="radio" class="rcliente" value="existente" name="optradio">Existente</label>
			<label class="radio-inline optradio"><input tabindex="7"   type="radio" class="rcliente" value="nuevo" name="optradio">Nuevo</label>
        
			</div>
			</div>   
	<br>  
	</div>




<!--Primera columna -->
		<div class="col-xs-6">
         
          <div class="form-group cliente_select" >
			<div class="col-lg-12">
			<label for="razon_social" class="col-lg-10">*Nombre del Cliente</label>
			
			<select height="36px" class="select2 form-control cliente_input2" tabindex="8" name="razon_social" id="razon_social" required>
            <option value= "" >Seleccione una opción </option>
            @foreach($clientes as $r) 
            <option value= '{"idcliente":"{{$r->id}}","descuento":"{{$r->descuento}}", "direccion":"{{$r->direccion}}"}'> {{$r->razon_social}}' </option>
            @endforeach

</select>

			</div>
			</div>  

		     <div class="form-group cliente_div" >
			<div class="col-lg-12">
			<label for="razon_social" class="col-lg-10">*Nombre del Cliente</label>
			<input type="text" tabindex="8" name="razon_social" id="razon_social" class="form-control cliente_input" placeholder="Razón social" required> <br/>fpr
			</div>
			</div>

		   <div class="form-group cliente_div" >
			<div class="col-lg-12">
			<label for="apellidos" class="col-lg-10">*Apellido del contacto</label>
			<input type="text" tabindex="10" name="apellidos" id= 'apellidos' class="form-control cliente_input" placeholder="Apellidos" required> <br/>
			</div>
			</div>   


         
            	<div class="form-group cliente_div" >
			<div class="col-lg-12">
			<label for="telefono" class="col-lg-10">Teléfono</label>
			<input type="text" tabindex="12" name="telefono" id= 'telefono' class="form-control cliente_input" placeholder="telefono" required> <br/>
			</div>
			</div>    

	
			
			
		</div>




 <!--Segunda columna -->
		<div class="col-xs-6">
     	 
      
            <div class="form-group cliente_div" >
			<div class="col-lg-12">
			<label for="nombre" class="col-lg-10">*Nombre del contacto</label>
			<input type="text" tabindex="9" name="nombre" id= 'nombre' class="form-control cliente_input" placeholder="nombre" required> <br/>
			</div>
			</div>

		

			<div class="form-group cliente_div" >
			<div class="col-lg-12">
			<label for="direccion" class="col-lg-10">Dirección fiscal</label>
			<input type="text" tabindex="13" name="direccion" id= 'direccion' class="form-control cliente_input" placeholder="direccion" required> <br/>
			</div>
			</div> 
             
                     <div class="form-group" >
			<div class="col-lg-12">
			<label for="descuento" class="col-lg-10">Descuento (%)</label>
			<input type="number" min="0" tabindex="15" name="descuento" id= 'descuento' class="form-control cliente_input" placeholder="descuento" required> <br/>
			</div>
			</div>


	 </div>
      
    <div class="col-xs-12 ">
<div class="col-xs-12 ">
		

<h3>Detalles de envio</h3> 	
<div class="checkbox ">
		<label  >  <input class= "ocultarEnvio" tabindex="18" type="checkbox" value="">Copiar dirección</label> 

</div>
</div>
 

</div>


<!--Primera columna -->
		<div class="col-xs-6 ">
     <div class="form-group ocultarEnvio" >
			<div class="col-lg-12">
			<label for="razon_social" class="col-lg-10">Dirección de envio</label>
			<input type="text" tabindex="20" name="direccion_envio" id="direccion_envio" class="form-control " placeholder="n/a si es local" required> <br/>
			</div>
			</div>
           
		
		</div>
<!--Segunda columna -->
		<div class="col-xs-6 ">
      


			 <div class="form-group" >
			<div class="col-lg-12">
		<div class="col-lg-12"> <label for="periodo" ><strong>Fecha de entrega</strong></label> </div>
      <div class="input-group date form-group " id="enddate" data-date-orientation= "bottom" data-date-autoclose= true data-provide="datepicker" data-date-start-date="default" data-date-format="dd-mm-yyyy">
      <input required class="form-control fechaFin " placeholder= "fecha_entrega"  type="text"  name="fecha_entrega" id= 'fin' class="form-control datepicker " tabindex="19"><div class="input-group-addon">
      <span class="glyphicon glyphicon-th"></span>
      </div>
      </div>

           
			</div>
	        </div>
      	


	 </div>


	 <div class="col-xs-12 ">
	
        <div class="col-xs-12 ">
			<h3>Detalles del pedido</h3> 
			<div class="checkbox "> 	
		<label >  <input class= "" tabindex="22" type="checkbox" value="">Aplicar descuento</label> 
     </div> 
 	
    </div>	

</div>


   


 <div class="col-xs-3">

        <div class="form-group" >
		<div class="col-lg-12">
		<label for="producto" class="col-lg-10">Producto</label>
		 <select class="select2 form-control cliente_input2" tabindex="21" name="datos_producto" id="datos_producto" required>
            <option value= "" >Seleccione una opción </option>
            @foreach($productos as $r) 
            <option value= '{"idproducto":"{{$r->id}}","nombre":"{{$r->nombre}}", "descripcion":"{{$r->descripcion}}" , "precio": "{{$r->precio}}"}'>{{$r->id}}: {{$r->nombre}} ({{$r->existencias}}) </option>
            @endforeach

</select>

</div>
</div>





     </div> 
  <div class="col-xs-3">
   <div class="form-group" >
		<div class="col-lg-12">
		<label for="producto" class="col-lg-10">Cantidad</label>
    <input type="number" id="cantidad" class= "form-control" value = 1> 
    </div>
    </div>
     </div>  
   
     <div class="col-xs-6">
      <button  id="btnagregar" style="margin-top: 5%; margin-left: -5%;"  tabindex="23" type="button" class="btn btn-success btn-sm">Agregar</button> 
     </div>  
          <div class="col-md-12">
       <div class="col-md-12">
       <br/> 
			    <div class="box-body table-responsive">
			      <table id= "tableProductos" class="table-bordered table-striped table-condensed table-hover" style= "width:100%;">
            <thead>
            <tr>
            <th width= "3%">Cancelar</th>
            <th>Clave</th>
            <th>Nombre</th>
            <th>Descripción</th>
            <th>Precio</th>
            <th>Cantidad</th>
            <th>Importe</th>
            </tr>
          </thead>
          <tbody>
   
      		<tr id="row_Nohay">
			<td   class="text-center" colspan="12">No ha seleccionado ningún producto.</td>
			</tr>
			      </table>
			  
			    <div class="box-footer clearfix">
         
				</div>
			  </div> <!-- divtabla-->
		     </div>
		</div>
      <div class="col-xs-1"></div>
     <div class="col-xs-10 text-right">
     <br>
    <h4><strong>Subtotal:</strong><span id=subtotal_text> </span></h4>
    <input type="hidden" name="subtotal" id="subtotal_input" val= 0> 
    <h4><strong>Descuento:</strong><span id=descuento_text> </span></h4>
    <input type="hidden" name="descuento" id="descuento_input" val= 0> 
    <h4><strong>Iva:</strong><span id=iva_text  > </span ></h4>
    <input type="hidden" name="iva" id="iva_input" val= 0> 
    <h4><strong>Total:</strong><span id=total_text> </span  > </h4>
    <input type="hidden" name="total" id="total_input" val= 0> 
    </div>
    <div class="col-xs-1"></div>




	 


	<div class= "col-lg-12 col-lg-offset-9 col-xs-12 col-xs-offset-4">
	<br> <br/>
	 <button type="submit" class="btn btn-primary">Guardar</button>
	 <a href= {{ url('productos') }}  type="submit" class="btn btn-default">Regresar</a>
	 <button type="reset" class="btn btn-danger">Cancelar</button>
	 <br>
 </div>

	</div>
</form>
</div>
</div>
</div>

<script>
$(document).ready(function() {


$(".cliente_div").hide();
$(".cliente_input").attr("disabled", "disabled");

//$("input").attr("autocomplete","true");

$(".rcliente").change(function(){

var valrad = $(this).val();
console.log(valrad);
if(valrad == "existente"){
$(".cliente_div").hide();
$(".cliente_input").attr("disabled", "disabled");
$(".cliente_input2").removeAttr("disabled", "disabled");
$(".cliente_select").show();
} 
if(valrad == "nuevo"){
$(".cliente_div").show();
$(".cliente_input").removeAttr("disabled", "disabled");
$(".cliente_input2").attr("disabled", "disabled");
$(".cliente_select").hide();
}




});



  //<option value= '{"idproducto":"{{$r->id}}","nombre":"{{$r->nombre}}", "descripcion":"{{$r->descripcion}}" , "precio": "{{$r->precio}}"}'>{{$r->id}}: {{$r->nombre}} ({{$r->existencias}}) </option>



var contador= 1;
var numarray = 0; 
var subtotal = 0;
var iva = .16;
var total = 0; 


$("#btnagregar").on("click", function(add){
var datos = $("#datos_producto").val();
datos =	JSON.parse(datos);
add.preventDefault();
var idproducto = datos.idproducto;
var nombre = datos.nombre;
var precio= datos.precio;
var descripcion = datos.descripcion;
var cantidad = $("#cantidad").val();
var importe = precio*cantidad
var descuento_cliente = $("#datos_producto").val();
$('#row_Nohay').remove();
$('#tableProductos').append(
      '<tr>'
      //btnquitar
      +'<td><button type= "button" class= "btn btn-warning" id="quitar">quitar</button></td>'
      //idproducto
      +'<td id="idproducto_'+contador+'">'+idproducto
      +'<input name="idproducto[]" type="hidden" value= "'+idproducto+'">'
      + '</td>'
      //nombre del producto
      +'<td id="nombre_td_'+idproducto+'">'+nombre
      +'<input name="producto_'+idproducto+'" type="hidden" value= "'+nombre+'">'
      + '</td>'
      //Descripcion
      +'<td id="descripcion_td_'+idproducto+'">'+descripcion
      +'<input name="descripcion_'+idproducto+'" type="hidden" value= "'+descripcion+'">'
      + '</td>'
      //precio
      +'<td id="precio_td_'+idproducto+'">'+precio
      +'<input name="precio_'+idproducto+'" type="hidden" value= "'+precio+'">'
      + '</td>'
      //cantidad
      +'<td id="cantidad_td_'+idproducto+'">'+cantidad
      +'<input name="cantidad_'+idproducto+'" type="hidden" value= "'+cantidad+'">'
      + '</td>'

       //importe
      +'<td id="importe_td_'+idproducto+'">'+importe
      +'<input name="importe_'+idproducto+'" type="hidden" value= "'+importe+'">'
      + '</td>'






      
      +'</tr>');



subtotal = subtotal + importe
descuento = 0;
Iva = subtotal * iva;
total =  subtotal - descuento + iva
$("#subtotal_text").text(subtotal);
$("#iva_text").text(Iva);
$("#total_text").text(total);


contador++;




});
});
</script>

</body>



@endsection