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
	         <div class="panel-heading">Perfiles</div>
          <div class="panel-body">
          
           <div class="col-md-12">
			    <div class="box-body table-responsive">
			      <table class="table-bordered table-striped table-condensed table-hover" style= "width:100%;">
            <thead>
            <tr>
			      <th>id</th>
            <th>Nombre</th>
     

            </tr>
          </thead>
          <tbody>
            <?php if (count($listaPerfiles) > 0): ?>
          <?php foreach ($listaPerfiles as $row): ?>
            <tr>
    					<td style = "width:10%;">{{$row->id}}</td>
    					<td style = "width:20%;">{{$row->nombre}}</td>
  
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


