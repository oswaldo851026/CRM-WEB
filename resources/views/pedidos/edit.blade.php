

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
			<h2>Editar pedido </h2>
			<h4>Folio: <strong> po-{{$pedidos->id}} </strong> </h4>
		
		</div>

<div class="col-xs-12 ">
		
			<h3>Detalles generales</h3>
			<br>
		</div>


	<br>
 <form action= "{{url('pedidos') }}/{{$pedidos->id}}" method= "post" enctype="multipart/form-data">
		  {{ method_field('PATCH') }}
   {{ csrf_field() }}

	<div class="row">
  <input type="hidden"  name="idusuario" id= '{{$idusuario}}' class="form-control" value= "1">
		


<!--Primera columna -->
		
  

        





		<div class="col-xs-6">
			<div class="form-group" >
			<div class="col-lg-12">
			<label for="asunto" class="col-lg-10">Fecha de creación</label>
			<input  readonly value = "{{ date('d-m-Y', strtotime($pedidos->created_at))}}" type="text"  tabindex="1" name="asunto" id= ""   class="form-control" > <br/>
			</div>
			</div>
			
			<div class="form-group" >
			<div class="col-lg-12">
			<label for="asunto" class="col-lg-10">*Asunto</label>
			<input type="text"  value= "{{$pedidos->asunto}}" tabindex="1" name="asunto" id= 'asunto' class="form-control" placeholder="Asunto" required> <br/>
			</div>
			</div>
			
			 <div class="form-group" >
			<div class="col-lg-12">
			<label for="estatus" class="col-lg-10">Estatus</label>
		  <?php $array= array("creado" => "Creado" , "enviado" => "Enviado" , "pagado" => "Pagado" , "cancelado" => "Cancelado")?>
		   <select type="text" tabindex="3" name="estatus" id= 'estatus' class="form-control"  >
		   @foreach($array as $key => $value)
		   <?php $selected = ""; ?>
           <?php   if($pedidos->estatus== $key) {$selected = "selected";} ?>
           <option {{$selected}} value= "{{$key}}">{{$value}}</option>
           @endforeach	
			</select> <br/>
			</div>
	        </div>

			
		</div>




 <!--Segunda columna -->
		<div class="col-xs-6">

				 <div class="form-group" >
			<div class="col-lg-12">
			<label for="estatus" class="col-lg-10">Fecha de modificación</label>
		    <input readonly  type="text" tabindex="1" name="asunto" id= "" value = "{{ date('d-m-Y', strtotime($pedidos->updated_at))}}" class="form-control" > <br/>
			</div>
	        </div>

     	 
     	 <div class="form-group" >
			<div class="col-lg-12">
			<label for="metodo_pago" class="col-lg-10">*Método de pago</label>
		   
		    <?php   $array= array("Efectivo" => "Efectivo" , "Credito" => "Crédito")?>
		    <select required type="text" tabindex="2" name="metodo_pago" id= 'metodo_pago' class="form-control"  >
             @foreach($array as $key => $value)
              <?php  $selected = ""; ?>
		    <?php if($pedidos->metodo_pago == $key) {$selected = "selected";} ?>

		    <option {{$selected}} value= "{{$key}}">{{$value}}</option>
		    @endforeach	
          
			</select> <br/>
			</div>
	        </div>
     


	         <div class="form-group" >
			<div class="col-lg-12">
			<label for="idvendedor" class="col-lg-10">Vendedor asignado</label>
			<select type="text" tabindex="4" name="id_vendedor" id= 'idvendedor' class="form-control"  >
            <?php $selected = ""; ?>
            @foreach($lista_usuarios as $row)
            <?php $selected = ""; if($row->id == $pedidos->id_vendedor){ $selected = "selected";} ?>
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
	 <textarea  value="{{$pedidos->comentarios}}" style="height: 70px;" class="form-control" rows="5" type="text" tabindex="5" name="comentarios" id= 'comentarios'> {{$pedidos->comentarios}} </textarea> <br/>
	 </div>
    </div>
	</div>

 
<div class="col-xs-12 ">
<div class="col-xs-12 ">
		
			<h3>Cliente</h3> 
		<br>	
</div>
</div>





<!--Primera columna -->
		<div class="col-xs-6">
         
          <div class="form-group cliente_select" >
			<div class="col-lg-12">
			<label for="razon_social" class="col-lg-10">*Nombre del Cliente</label>
			 <?php $selected = ""; ?>
              <select  height="36px" class="select2 form-control cliente_input2" tabindex="8" name="datos_cliente" id="razon_social" required>
              <option value= "" >Seleccione una opción </option>
              @foreach($clientes as $r)
              <?php if($pedidos->id_cliente == $r->id){ $selected = "selected";} ?>

            <option  {{$selected}} value= '{"idcliente":"{{$r->id}}","descuento":"{{$r->descuento}}", "direccion":"{{$r->direccion}}"}'> {{$r->razon_social}} </option>
            @endforeach

            </select>

			</div>
			</div>  

		   

	
			
			
		</div>




 <!--Segunda columna -->
		<div class="col-xs-6">
     	 
              <div class="form-group" >
			<div class="col-lg-12">
			<label for="descuento" class="col-lg-10">Descuento (%)</label>
			<input readonly value= "5" type="number" min="0" tabindex="15" name="descuento" id= 'descuento' class="form-control cliente_input" value=0 required> <br/>
			</div>
			</div>


	 </div>
      
    <div class="col-xs-12 ">
<div class="col-xs-12 ">
		

<h3>Detalles de envio</h3> 	
<div class="checkbox ">

		<label  >  <input class= "ocultarEnvio" tabindex="18" type="checkbox" id="copiarDir" value="">Copiar dirección</label> 

</div>
</div>
 

</div>


<!--Primera columna -->
		<div class="col-xs-6 ">
     <div class="form-group ocultarEnvio" >
			<div class="col-lg-12">
			<label for="razon_social" class="col-lg-10">Dirección de envio</label>
			<input type="text" tabindex="20" value= "{{$pedidos->direccion_envio}}" name="direccion_envio" id="direccion_envio" class="form-control " placeholder="n/a si es local" required> <br/>
			</div>
			</div>
           
		
		</div>
<!--Segunda columna -->
		<div class="col-xs-6 ">
      


			 <div class="form-group" >
			<div class="col-lg-12">
		<div class="col-lg-12"> <label for="periodo" ><strong>Fecha de entrega</strong></label> </div>
      <div class="input-group date form-group " id="enddate" data-date-orientation= "bottom" data-date-autoclose= true data-provide="datepicker" data-date-start-date="default" >
      <input value= "{{$pedidos->fecha_entrega}}" required class="form-control fechaFin " placeholder= "fecha_entrega"  type="text"  name="fecha_entrega" id= 'fin' class="form-control datepicker " tabindex="19"><div class="input-group-addon">
      <span class="glyphicon glyphicon-th"></span>
      </div>
      </div>

           
			</div>
	        </div>
      	


	 </div>


	 <div class="col-xs-12 ">
	
        <div class="col-xs-12 ">
			<h3>Detalles del pedido</h3> 
		
     <?php if($pedidos->estatus != "enviado" && $pedidos->estatus != "pagado") {
   
     $disabledbtn = "";  ?>


    <div class="checkbox "> 	
		<label >  <input class= "" tabindex="22" name="aplicar_descuento" type="checkbox" id="aplicar_descuento" value="1">Aplicar descuento</label> 
     </div> 
 	
    </div>	

</div>


   


 <div class="col-xs-3">

        <div class="form-group" >
		<div class="col-lg-12">
		<label for="producto" class="col-lg-10">Producto</label>
		

     <select class="select2 form-control cliente_input2" tabindex="21" name="datos_producto" id="datos_producto" >
        <option value= ''>Seleccione un producto </option>
          
            @foreach($productos as $r) 
            <option value= '{"idproducto":"{{$r->id}}","nombre":"{{$r->nombre}}", "descripcion":"{{$r->descripcion}}" , "precio": "{{$r->precio}}", "existencias": "{{$r->existencias}}"}'>{{$r->id}}: {{$r->nombre}} ({{$r->existencias}}) </option>
            @endforeach

</select>

</div>
</div>





     </div> 
  <div class="col-xs-3">
   <div class="form-group" >
		<div class="col-lg-12">
		<label for="producto" class="col-lg-10">Cantidad</label>
    <input  type="number" id="cantidad" class= "form-control" value = 1> 
    </div>
    </div>
     </div>  
   
     <div class="col-xs-6">
        
       

      <button  id="btnagregar" style="margin-top: 5%; margin-left: -5%;"  tabindex="23" type="button" class="btn btn-success btn-sm">Agregar</button> 
     </div>  

  <?php }else{$disabledbtn = "disabled";} ?>

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
           @if(sizeof($detalle_pedidos) > 0)
           @foreach($detalle_pedidos as $row)
      		
           <tr>
          <td><button type= "button" class= "btn btn-danger quitar" id="quitar"><i class="glyphicon glyphicon-remove"></i></button></td>
          <td id="">{{$row->id_producto}}
          <input name="idproducto[]" type="hidden" value= "{{$row->id_producto}}">
          </td>
          <td id="nombre_td_{{$row->id_producto}}">{{$row->nombre_producto}}
          <input name="producto_{{$row->id_producto}}" type="hidden" value= "{{$row->nombre_producto}}">
         </td>
         <td id="descripcion_td_{{$row->id_producto}}">{{$row->descripcion_producto}}
         <input name="descripcion_{{$row->id_producto}}" type="hidden" value= "{{$row->descripcion_producto}}">
          </td>
          <td id="precio_td_'+idproducto+'">${{number_format($row->precio_producto)}}
          <input name="precio_{{$row->id_producto}}" type="hidden" value= "{{$row->precio_producto}}">
           </td>
          <td id="cantidad_td_{{$row->cantidad_producto}}">{{$row->cantidad_producto}}
          <input name="cantidad_{{$row->id_producto}}" type="hidden" value= "{{$row->cantidad_producto}}">
           </td>
         <td class=".importe" id="importe_td_{{$row->id_producto}}">${{number_format($row->importe)}}
         <input  id="importe" name="importe_{{$row->id_producto}}" type="hidden" value= "{{$row->importe}}">
          </td>
           @endforeach
		   @else

      		<tr id="row_Nohay">
			<td   class="text-center" colspan="12">No ha seleccionado ningún producto.</td>
			</tr>
		   @endif
			</tbody>      

			</table>
			  
			    <div class="box-footer clearfix">
         
				</div>
			  </div> <!-- divtabla-->
		     </div>
		</div>
      <div class="col-xs-1"></div>
     <div class="col-xs-10 text-right">
     <br>
    <h4><strong>Subtotal: </strong><span id=subtotal_text> ${{number_format($pedidos->subtotal)}} </span></h4>
    <input type="hidden" name="subtotal" id="subtotal_input" value= "{{$pedidos->subtotal}}"> 
    <h4><strong>Descuento: </strong><span id=descuento_text>${{number_format($pedidos->descuento)}}  </span></h4>
    <input type="hidden" name="descuento" id="descuento_input" value= "{{$pedidos->descuento}}"> 
    <h4><strong>Iva: </strong><span id=iva_text  >  ${{number_format($pedidos->iva)}} </span ></h4>
    <input value= "{{$pedidos->iva}}" type="hidden" name="iva" id="iva_input" val= 0> 
    <h4><strong>Total:  </strong><span id=total_text>  ${{number_format($pedidos->total)}} </span  > </h4>
    <input type="hidden" name="total" id="total_input" value= "{{$pedidos->total}}"> 
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




//$("input").attr("autocomplete","true");

$("#copiarDir").on("click", function(){
if($("#copiarDir").is(':checked')){

var cliente = $("#razon_social").val();
if(cliente != ""){
cliente = JSON.parse(cliente);
$("#direccion_envio").val(cliente.direccion);	
}
console.log("soy existente");
}



});





  //<option value= '{"idproducto":"{{$r->id}}","nombre":"{{$r->nombre}}", "descripcion":"{{$r->descripcion}}" , "precio": "{{$r->precio}}"}'>{{$r->id}}: {{$r->nombre}} ({{$r->existencias}}) </option>



var contador= 1;
var numarray = 0; 
var subtotal = 0;
var iva = .16;
var total = 0; 
var descuento = 0;
var descuento2 = 0;

$("#razon_social").change(function(){
var cliente = $("#razon_social").val();
cliente = JSON.parse(cliente);
$("#descuento").val(cliente.descuento);
});



$("#btnagregar").on("click change", function(add){
var subtotal = $("#subtotal_input").val();
console.log(subtotal) ;
 subtotal = parseFloat(subtotal);
 console.log(subtotal) ;
var datos = $("#datos_producto").val();
var cantidad = $("#cantidad").val();
if(datos == "" ) {

alert("No ha seleccionado ningún producto");
add.preventDefault();
return false

}
datos =	JSON.parse(datos);

  /// ------------------------VALIDACION DE EXISTENCIAS -----------------------
if(datos.existencias < cantidad) {

alert("No hay suficientes existencias para el producto " + datos.nombre);
add.preventDefault();
return false

}





var idproducto = datos.idproducto;
var nombre = datos.nombre;
var precio= datos.precio;
var descripcion = datos.descripcion;

var importe = precio*cantidad;

var descuento_cliente = $("#datos_producto").val();
$('#row_Nohay').remove();
$('#tableProductos').append(
      '<tr>'
      //btnquitar
      +'<td><button type= "button" class= "btn btn-danger quitar '+<?php echo $disabledbtn; ?>+ '" id="quitar"><i class="glyphicon glyphicon-remove"></i></button></td>'
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
      +'<td id="precio_td_'+idproducto+'">'+" $"+parseFloat(precio).toFixed(2).replace(/\B(?=(\d{3})+(?!\d))/g, ",")
      +'<input name="precio_'+idproducto+'" type="hidden" value= "'+precio+'">'
      + '</td>'
      //cantidad
      +'<td id="cantidad_td_'+idproducto+'">'+cantidad
      +'<input name="cantidad_'+idproducto+'" type="hidden" value= "'+cantidad+'">'
      + '</td>'

       //importe
      +'<td class=".importe" id="importe_td_'+idproducto+'">'+" $"+parseFloat(importe).toFixed(2).replace(/\B(?=(\d{3})+(?!\d))/g, ",")
      +'<input  id="importe" name="importe_'+idproducto+'" type="hidden" value= "'+importe+'">'
      + '</td>'


      
      +'</tr>');


subtotal = subtotal + importe
if($("#aplicar_descuento").is(":checked")){


descuento = ($("#descuento").val())/100;
console.log(descuento);
descuento = subtotal * descuento;


} else {

descuento = 0;
}


Iva = (subtotal - descuento) * iva;
total =  subtotal - descuento + Iva

$("#subtotal_input").val(subtotal);
$("#descuento_input").val(descuento);
$("#iva_input").val(Iva);
$("#total_input").val(total);



$("#subtotal_text").text(" $"+ subtotal.toFixed(2).replace(/\B(?=(\d{3})+(?!\d))/g, ","));
$("#descuento_text").text(" $"+descuento.toFixed(2).replace(/\B(?=(\d{3})+(?!\d))/g, ","));
$("#iva_text").text(" $"+Iva.toFixed(2).replace(/\B(?=(\d{3})+(?!\d))/g, ","));
$("#total_text").text(" $"+total.toFixed(2).replace(/\B(?=(\d{3})+(?!\d))/g, ","));






contador++;




});
$("#tableProductos").on('click','#quitar',function(){



var restar_importe = $(this).closest('tr').find("td:nth-child(7)").children("input").val();
var subtotal = $("#subtotal_input").val();


$(this).closest('tr').remove();

subtotal = subtotal - restar_importe;
if($("#aplicar_descuento").is(":checked")){

console.log("entra descuento");
descuento = ($("#descuento").val())/100;
descuento = subtotal * descuento;

} else {

descuento = 0;
}


Iva = (subtotal - descuento) * iva;
total =  subtotal - descuento + Iva


$("#subtotal_input").val(subtotal);
$("#descuento_input").val(descuento);
$("#iva_input").val(Iva);
$("#total_input").val(total);




$("#subtotal_text").text(" $"+ subtotal.toFixed(2).replace(/\B(?=(\d{3})+(?!\d))/g, ","));
$("#descuento_text").text(" $"+descuento.toFixed(2).replace(/\B(?=(\d{3})+(?!\d))/g, ","));
$("#iva_text").text(" $"+Iva.toFixed(2).replace(/\B(?=(\d{3})+(?!\d))/g, ","));
$("#total_text").text(" $"+total.toFixed(2).replace(/\B(?=(\d{3})+(?!\d))/g, ","));


});













});
</script>

</body>



@endsection