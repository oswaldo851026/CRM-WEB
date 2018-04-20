<!DOCTYPE html>
<html lang="es">

<head>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>


</head>
<body>
@extends('layouts.app')
@section('content')



   <form method="get" action="{{ url('inventarios') }}" accept-charset="UTF-8" class="" role="search">

    <div class="container">
        <div class="row">
            <div class="col-md-12 row">
                <div class="panel panel-default">
	         <div class="panel-heading"><h4> Inventarios </h4></div>
          <div class="panel-body">
           
 
 <div  class="col-md-12">   
<label class="radio-inline"><input {{$valcheck}} type="radio" id= "radioprod" value= "Prod" name="optradio">Producto</label>
<label class="radio-inline"><input {{$valcheck2}} type="radio" id= "radiomp" value="Mp" name="optradio">Materia prima</label>
<br>
 </div>

           <div class="col-md-6"  id= "divmp">
           
            <div class="form-group" >
            <div class="col-lg-12">
            <label for="estatus" class="col-lg-10">*Seleccione materia prima</label>
           
            <select required  type="text" tabindex="1" name="buscarmateriaprima" id= 'buscarmateriaprima' class="form-control select2"  >
            <option value= "">Seleccione una opción</option>
            <option value= "todos">Todos</option>
           
             @foreach($materia_prima as $r)
            <option value= "{{$r->id}}">MP{{$r->id}} - {{$r->nombre}}</option>
            @endforeach

      </select> <br/>
      </div>
          </div>



           </div>


            <div class="col-md-6"  id= "divprod">
           
            <div class="form-group" >
            <div class="col-lg-12">
            <label for="estatus" class="col-lg-10">*Seleccione producto</label>
            <select required type="text" tabindex="1" name="buscarproducto" id= 'buscarproducto' class="form-control select2"  >
            <option value= "">Seleccione una opción</option>
            <option value= "todos">Todos</option>
            @foreach($productos as $r)
            <option value= "{{$r->id}}">Prod{{$r->id}} - {{$r->nombre}}</option>
            @endforeach
         

      </select> <br/>
      </div>
          </div>



           </div>




          





            <div class="col-md-6"> 
              <div class="form-group" >
            <div class="col-lg-12">
            <label for="estatus" class="col-lg-10">Filtrar tipo de movimiento</label>
            <select type="text" tabindex="2" name="movimiento" id= 'movimiento' class="form-control"  >
            <option value= "">Seleccione una opción</option>
            <option value= "salida">Salida</option>
            <option value= "entrada">Entrada</option>
            <option value= "devolucion">Devolución</option>
          

      </select> <br/>
      </div>
          </div>
           
            </div>
            <div class="col-md-12"> </div>

             <div class="col-md-6">
           
            <div class="form-group" >
            <div class="col-lg-12">
            <label for="estatus" class="col-lg-10">Filtrar por almacén</label>
            <select type="text" tabindex="1" name="almacen" id= 'productos' class="form-control select2"  >
            <option value= "">Seleccione una opción</option>
            @foreach($almacenes as $r)
            <option value= "{{$r->id}}">A{{$r->id}} {{$r->nombre_almacen}}</option>
            @endforeach
          

      </select> <br/>
      </div>
          </div>

           </div>
       
       <div class="col-md-6">
              <div class="col-xs-6 row" style="margin-left: -9px;">
      <label for="periodo"><strong>Periodo</strong></label>
      <div class="input-group date form-group" id="startdate" data-date-orientation= "bottom"  data-date-autoclose= true data-provide="datepicker" data-date-format="dd-mm-yyyy">
      <input required placeholder= "Inicio" class="form-control"  type="text"  name="inicio" id= 'inicio' class="form-control datepicker inicio" tabindex="4"><div class="input-group-addon">
      <span class="glyphicon glyphicon-th"></span>
      </div>
      </div>
      </div>

      <div class="col-xs-6 pull-left">
      <label style="color:transparent;" for="periodo"><strong>Termina</strong></label>
      <div class="input-group date form-group " id="enddate" data-date-orientation= "bottom" data-date-autoclose= true data-provide="datepicker"  data-date-format="dd-mm-yyyy">
      <input required class="form-control fechaFin " placeholder= "Fin"  type="text"  name="fin" id= 'fin' class="form-control form_datetime" tabindex="4"><div class="input-group-addon">
      <span class="glyphicon glyphicon-th"></span>
      </div>
      </div>
      </div>
       </div>

          <div class= "col-lg-12 pull-left">
  <br><br>
   <button type="submit" class="btn btn-primary">Filtrar</button>
   <button type="button" class="btn btn-success" data-toggle="modal" data-target="#exampleModal">Ingresar movimiento</button>
 
   <br><br>
 </div>



           <div id="tableMp" class="col-md-12">
			    <div class="box-body table-responsive">
			      <table class="table-bordered table-striped table-condensed table-hover" style= "width:100%;">
            <thead>
            <tr>
			      <th>Id</th>
            <th>Código</th>
            <th>Producto</th>
            <th>Concepto</th>
            <th>Almacén</th>
            <th>Tipo de movimiento</th>
            <th>Fecha</th>
            <th>Cantidad</th>

            </tr>
          </thead>
          <tbody>
            <?php $cantidad_total = 0; if (count($listaInventarios2) > 0): ?>
          <?php   foreach ($listaInventarios2 as $row): ?>
            <tr>
    					<td style = "width:5%;">{{$row->idinventarios}}</td>
    					<td style = "width:5%;">{{$row->codigo}}</td>
              <td style = "width:15%;">{{$row->nombre}}</td>
              <td style = "width:15%;">{{$row->concepto}}</td>
              <td style = "width:10%;">{{$row->nombre_almacen}}</td>
              <td style = "width:10%;">{{$row->tipo_movimiento}}</td>
              <td style = "width:10%;">{{$row->created_at}}</td>
              <td style = "width:10%;">{{$row->cantidad}}</td>

    		
  
    				</tr>
						<?php  $cantidad_total =  $cantidad_total +  $row->cantidad ;  endforeach ?>
						<?php else: ?>
							<tr>
								<td class="text-center" colspan="12">No se encontraron resultados.</td>
							</tr>
						<?php endif ?>
          </tbody>

			      </table>
			     <div class= "col-xs-12 text-right"> <h5> Total de registros: {{$cantidad_total}}</h5> </div> 
			    <div class="box-footer clearfix">
            <div class= col-xs-12>
                 {{$listaInventarios->render()}}

         		</div>
				</div>
			  </div> <!-- divtabla-->
		     </div>
       

          <div id="tableProd" class="col-md-12">
          <div class="box-body table-responsive">
            <table class="table-bordered table-striped table-condensed table-hover" style= "width:100%;">
            <thead>
            <tr>
            <th>Id</th>
            <th>Código</th>
            <th>Producto</th>
            <th>Concepto</th>
            <th>Almacén</th>
            <th>Tipo de movimiento</th>
            <th>Fecha</th>
            <th>Cantidad</th>

            </tr>

          </thead>
          <tbody>
            <?php $cantidad_total = 0; if (count($listaInventarios) > 0): ?>
          <?php foreach ($listaInventarios as $row): ?>
            <tr>
              <td style = "width:5%;">{{$row->idinventarios}}</td>
              <td style = "width:5%;">{{$row->codigo}}</td>
              <td style = "width:15%;">{{$row->nombre}}</td>
              <td style = "width:15%;">{{$row->concepto}}</td>
              <td style = "width:10%;">{{$row->nombre_almacen}}</td>
              <td style = "width:10%;">{{$row->tipo_movimiento}}</td>
              <td style = "width:10%;">{{$row->created_at}}</td>
              <td style = "width:10%;">{{$row->cantidad}}</td>

        
  
            </tr>
            <?php $cantidad_total =  $cantidad_total +  $row->cantidad ; endforeach ?>
            <?php else: ?>
              <tr>
                <td class="text-center" colspan="12">No se encontraron resultados.</td>
              </tr>
            <?php endif ?>
          </tbody>

            </table>

            <div class= "col-xs-12 text-right"> <h5> Total de registros: {{$cantidad_total}}</h5> </div> 
        
          <div class="box-footer clearfix">
            <div class= col-xs-12>
                 {{$listaInventarios->render()}}

            </div>
        </div>
        </div> <!-- divtabla-->
         </div>





              </form>


        
 <form method="post" action="{{ url('inventarios') }}" accept-charset="UTF-8" class="" role="search">

<!-- Modal -->
<div class="modal fade" id="exampleModal" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">*Ingresar movimiento</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      
      <div class="col-md-12">
          
            <div class="col-md-6">
            <br> <br>
            <div class="form-group" >
           
            <label for="estatus" class="col-md-21">*Producto o materia prima</label>
            <select  required style="width: 90%" type="text" tabindex="1" name="inputproducto" id= 'productos' class="form-control select2"  >
            <option value= "">Seleccione una opción</option>
            @foreach($productos as $r)
            <option value= "{{$r->codigo}}">{{$r->codigo}} - {{$r->nombre}}</option>
            @endforeach
             @foreach($materia_prima as $r)
            <option value= "{{$r->codigo}}">{{$r->codigo}} - {{$r->nombre}}</option>
            @endforeach

      </select> <br/>
   
          </div>



           </div>



             <div class="col-md-6">
             <br> <br>
           <div class="form-group" >
            <div class="col-lg-12">
            <label for="estatus" class="col-lg-10">*Tipo de movimiento</label>
            <select  required style="width: 90%" type="text"  name="inputmovimiento" id= 'inputmovimiento' class="form-control select2"  >
            <option value= "">Seleccione una opción</option>
            <option value= "salida">Salida</option>
            <option value= "entrada">Entrada</option>
            <option value= "devolucion">Devolución</option>
          

      </select> 
      </div>
          </div>


           </div>
          </div>
          <div class="col-md-12">
            <div class="col-md-6">
            <br> <br>
           <div class="form-group" >
        
            <label for="estatus" class="col-lg-10">*Asignar Almaén</label>
            <select  required style="width: 90%" type="text" name="inputalmacen" id= 'almacen' class="form-control select2"  >
               @foreach($almacenes as $r)
            <option value= "{{$r->id}}">A{{$r->id}} {{$r->nombre_almacen}}</option>
            @endforeach
          

      </select>
    
          </div>


           </div>


            <div class="col-md-6">
      <br> <br>
            <div class="form-group" >
      <div class="col-lg-12">
      <label for="precio" class=" col-lg-10"   >Cantidad</label>
      <input type="number" name="inputcantidad" id= 'precio' class="form-control" placeholder="precio"  style="width: 90%"> <br/>
      </div>
      </div>

           </div>
       <br> <br>
       </div>
     <div class="col-md-12">
       <div class="col-md-12">
            
      <div class = "form-group">
      <label>Concepto </label>
      <input class = "form-control " name ="concepto">
      </div>  
          <br> <br>
            </div>
 </div>
     

      </div>
      <div class="modal-footer">
        <div class="col-md-12">
        <br>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Save changes</button>
        </div>
      </div>
    </div>
  </div>
</div>
</form>

<script type="text/javascript">
  
if($("#radioprod").is(":checked") == true ){
$("#divmp").hide();
$("#tableMp").hide();


}

if($("#radiomp").is(":checked") == true ){
$("#divprod").hide();
$("#tableprod").hide();

  
}

$("#buscarmateriaprima").attr("disabled", "disabled");


$("#radiomp").on("click", function(){
$("#divmp").show();
$("#divprod").hide();
$("#buscarmateriaprima").removeAttr("disabled", "disabled");
$("#buscarproducto").attr("disabled", "disabled");
$("#tableProd").hide();
$("#tableMp").show();

console.log("hola")

});

$("#radioprod").on("click", function(){
$("#divmp").hide();
$("#divprod").show();
$("#buscarmateriaprima").attr("disabled", "disabled");
$("#buscarproducto").removeAttr("disabled", "disabled");
$("#tableProd").show();
$("#tableMp").hide();
});







</script>







                    </div>
                </div>
            </div>
        </div>
    </div>
        
  @endsection 
    








</body>
</html>


