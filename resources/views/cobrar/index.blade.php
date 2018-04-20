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
	         <div class="panel-heading">Cuentas por Cobrar</div>
          <div class="panel-body">
           <div class="col-md-6">
           <a href="{{ url('cuentasPorCobrar/create') }}" class="btn btn-success btn-sm" title="Agregar un nuevo cobro">
                            <i class="fa fa-plus" aria-hidden="true"></i> Agregar 
             </a>
            <br>
           </div>
              <div class="col-md-6">
             <form method="GET" action="{{ url('cuentasPorCobrar') }}" accept-charset="UTF-8" class="navbar-form navbar-right" role="search">
                            <div class="input-group">
                                <input type="text" class="form-control" name="search" placeholder="Buscar..." value="{{ request('search') }}">
                                <span class="input-group-btn">
                                    <button class="btn btn-default" type="submit">
                                        <i class="fa fa-search"></i>
                                    </button>
                                </span>
                            </div>
                        </form>
              <br>
              </div>
           <div class="col-md-12">
			    <div class="box-body table-responsive">
			      <table class="table-bordered table-striped table-condensed table-hover" style= "width:100%;">
            <thead>
            <tr>
			      <th>id</th>
            <th>Orden de Compra</th>
            <th>Proveedores</th>
            <th>Estatus</th>
            <th>Monto</th>
            </tr>
          </thead>
          <tbody>
            <?php if (count($listacuentas_cobrar) > 0): ?>
          <?php foreach ($listacuentas_cobrar as $row): ?>
            <tr>
    					<td style = "width:10%;">{{$row->idcuentas_cobrar}}</td>
    					<td style = "width:10%;">{{$row->detalle_ordenes_compras}}</td>
    					<td style = "width:10%;">{{$row->proveedores}}</td>
    					<td style = "width:10%;">{{$row->estatus}}</td>
    					<td style = "width:10%;">{{$row->monto}}</td>
           
              <form action= "{{url('cuentasPorCobrar/'.$row->idcuentas_cobrar)}}" method= "post">
              <input type="hidden" name="_method" value="DELETE">
              <input type="hidden" name="_token" value="{{ csrf_token() }}">
              <div class="btn-group">
              <a href="{{url('cuentasPorCobrar/'.$row->idcuentas_cobrar)}}" class="btn btn-primary"><i class="glyphicon glyphicon-eye-open"></i></a>
    					<a href="{{url('cuentasPorCobrar/'.$row->idcuentas_cobrar.'/edit')}}" class="btn btn-warning"><i class="glyphicon glyphicon-pencil"></i></a>
              <button type="submit" class="btn btn-danger"><i class="glyphicon glyphicon-remove"></i></button>
              </form>
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
                 {{$listacuentas_cobrar->render()}}

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


