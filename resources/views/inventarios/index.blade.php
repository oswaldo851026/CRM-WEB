<!DOCTYPE html>
<html lang="es">

<head>
<link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

</head>
<body>
@extends('layouts.app')
@section('content')





    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
	         <div class="panel-heading"><h4> Inventarios </h4></div>
          <div class="panel-body">
           


           <div class="col-md-6">
           
            <div class="form-group" >
            <div class="col-lg-12">
            <label for="estatus" class="col-lg-10">Seleccione producto o materias prima</label>
            <select type="text" tabindex="1" name="productos" id= 'productos' class="form-control"  >
            <option value= "">Seleccione una opción</option>
            @foreach($productos as $r)
            <option value= "{{$r->id}}">Prod{{$r->id}} {{$r->nombre}}</option>
            @endforeach
             @foreach($materia_prima as $r)
            <option value= "{{$r->id}}">MP{{$r->id}} {{$r->nombre}}</option>
            @endforeach

      </select> <br/>
      </div>
          </div>



           </div>

            <div class="col-md-6"> </div>
            <div class="col-md-12"> </div>

             <div class="col-md-6">
           
            <div class="form-group" >
            <div class="col-lg-12">
            <label for="estatus" class="col-lg-10">Filtrar por almacén</label>
            <select type="text" tabindex="1" name="productos" id= 'productos' class="form-control"  >
            <option value= "">Seleccione una opción</option>
            @foreach($productos as $r)
            <option value= "{{$r->id}}">A{{$r->id}} {{$r->nombre_almacen}}</option>
            @endforeach
          

      </select> <br/>
      </div>
          </div>

           </div>
       
       <div class="col-md-6">
              <div class="col-xs-6 row" style="margin-left: -9px;">
      <label for="periodo"><strong>Periodo</strong></label>
      <div class="input-group date form-group" id="startdate" data-date-orientation= "bottom" data-date-start-date="default" data-date-autoclose= true data-provide="datepicker" data-date-format="dd-mm-yyyy">
      <input required placeholder= "Inicio" class="form-control"  type="text"  name="inicio" id= 'inicio' class="form-control datepicker inicio" tabindex="4"><div class="input-group-addon">
      <span class="glyphicon glyphicon-th"></span>
      </div>
      </div>
      </div>

      <div class="col-xs-6 pull-left">
      <label style="color:transparent;" for="periodo"><strong>Termina</strong></label>
      <div class="input-group date form-group " id="enddate" data-date-orientation= "bottom" data-date-autoclose= true data-provide="datepicker" data-date-start-date="default" data-date-format="dd-mm-yyyy">
      <input required class="form-control fechaFin " placeholder= "Fin"  type="text"  name="fin" id= 'fin' class="form-control form_datetime" tabindex="4"><div class="input-group-addon">
      <span class="glyphicon glyphicon-th"></span>
      </div>
      </div>
      </div>
       </div>










           <div class="col-md-12">
			    <div class="box-body table-responsive">
			      <table class="table-bordered table-striped table-condensed table-hover" style= "width:100%;">
            <thead>
            <tr>
			      <th>Id</th>
            <th>Código</th>
            <th>Producto</th>
            <th>Descripción</th>
            <th>Almacén</th>
            <th>Tipo de movimiento</th>
            <th>Fecha</th>
            <th>Cantidad</th>

            </tr>
          </thead>
          <tbody>
            <?php if (count($listaInventarios) > 0): ?>
          <?php foreach ($listaInventarios as $row): ?>
            <tr>
    					<td style = "width:10%;">{{$row->idinventarios}}</td>
    					<td style = "width:10%;">{{$row->codigo}}</td>
              <td style = "width:10%;">{{$row->nombre}}</td>
              <td style = "width:10%;">{{$row->descripcion}}</td>
              <td style = "width:10%;">{{$row->nombre_almacen}}</td>
              <td style = "width:10%;">{{$row->tipo_movimiento}}</td>
              <td style = "width:10%;">{{$row->created_at}}</td>
              <td style = "width:10%;">{{$row->cantidad}}</td>

    				
            <td style = "width:20%;">
           
    
           
              <div class="btn-group">
              
    					<a href="{{url('categorias/'.$row->idcategorias.'/edit')}}" class="btn btn-warning"><i class="glyphicon glyphicon-pencil"></i></a>
              </div>
              </td>
  
    				</tr>
						<?php endforeach ?>
						<?php else: ?>
							<tr>
								<td class="text-center" colspan="12">No se encontraron resultados.</td>
							</tr>
						<?php endif ?>


			      </table>
			  
			    <div class="box-footer clearfix">
            <div class= col-xs-12>
                 {{$listaInventarios->render()}}

         		</div>
				</div>
			  </div> <!-- divtabla-->
		     </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
        
  @endsection 
    





<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
</body>
</html>


