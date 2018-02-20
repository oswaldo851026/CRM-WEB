

@extends(config('sentinel.layout'))

<style>
.letra
{
   font-size: 1em !important;
   font-family: Arial !important;

}
.formulario
{

   max-width:360px !important ; 
   min-width: 10px !important ; 
   max-height: 30px !important;
   background-color: #2c2c2d;
   border-radius: 10px !important;
}

.ingresar
{
   bottom:50px !important;
   width:50% !important ; 
   height:150% !important;
   min-width: 10px !important ; 
   max-width: 360px !important ; 
   max-height: 50px !important;
   background-color: #4d8759;
   
   font-size: 1em !important;
}


.texto2
{

   font-size: .90em !important;
   font-family: Arial !important;
}



input[type="text"], textarea, input[type="password"] {

  background-color : #2c2c2d; 
  color: white !important ;

}

.recordar{

    color: #fff !important;  margin-top: 30px !important; font-size: 1em !important;
}


.input-icon{
  position: absolute;
  left: 3px;
  top: calc(50% - 0.5em); /* Keep icon in center of input, regardless of the input height */
}
input{
  padding-left: 17px;
}
.input-wrapper{
  position: relative;


}

.checkb{

    max-width:17px;
    max-height:20px;
    padding-top: 40px;



}

.bodyall{
    
    background-position: center center;
    background-repeat: no-repeat;
    background-attachment: fixed;
    background-size: cover;
}

.formcontrol7{
    background:none !important;
    border: 0;
    border-bottom: 1px solid #c2cad8;
    -webkit-border-radius: 0;
    -moz-border-radius: 0;
    -ms-border-radius: 0;
    -o-border-radius: 0;
    border-radius: 0;
    color: #555;
    box-shadow: none;
    padding-left: 0;
    padding-right: 0;
    font-size: 14px;
    outline: 0!important;
    height: 40px;
    max-width:360px !important ; 
    min-width: 10px !important ;
    width:64% !important ; 
}

.colorblanco{
    color:white;
}

input:-webkit-autofill, textarea:-webkit-autofill, select:-webkit-autofill {
    background-color: #FF00FF !important;
    background-image: none;
    color: rgb(0, 0, 0);
}

</style>

    




{{-- Web site Title --}}
@section('title')
Log In
@stop

{{-- Content --}}
@section('content')

<meta name="viewport" content="width=device-width, initial-scale=1.0">


<body class="bodyall" background="<?= env('APP_URL'); ?>/img/img-login.jpg">
<div class= "row" >






<div class="col-md-3"> </div>
<div class="col-md-6 text-center" style= "margin-top: 5px;  padding: 15px;">
    
        <form method="POST" action="{{ route('sentinel.session.store') }}" accept-charset="UTF-8">
            <div style= " position: relative; left: 1%; " class="col-md-12">
            
            <h1 style="color: white;" > SISTEMA ERP </h1>
          </div>
            <br>
            <br>
           <div class="col-md-12 text-center">
               
            <div class="form-group {{ ($errors->has('email')) ? 'has-error' : '' }}">
                <div class="right-inner-addon">
            <i class="glyphicon glyphicon-user colorblanco"></i>
            <input type="text" class="formcontrol7 letra" placeholder="Usuario" aria-describedby="sizing-addon1" autofocus="autofocus" name="email" value="{{ Request::old('email') }}">
            <p style="color:white">
              {{ ($errors->has('email') ? $errors->first('email') : '') }}  
                
            </p>
            
                </div>
                
            </div>
            <br>

            <div class="form-group ">
                <div class="right-inner-addon">
            <i class="glyphicon glyphicon-lock colorblanco"></i>
                <input  class="formcontrol7 letra " placeholder="Contraseña" name="password" value="" type="password">
                <p style="color:white">
                    
                    {{ ($errors->has('password') ?  $errors->first('password') : '') }} 
                </p>
               
                 
              
            </div>

            

            <br>
                <div class="col-lg-11 col-xs-12 form-group pull-right center-block">
              
              
          </div>
           
            <br>
            <input name="_token" value="{{ csrf_token() }}" type="hidden">
            
            <input class="btn btn-danger ingresar" style="background:#4d8759; border-color: #4d8759;" value="Iniciar sesión" type="submit">
            <br>
            <br>
            <a class="btn btn-link recordar" href="{{ route('sentinel.forgot.form') }}"><u>¿Olvidaste tu contraseña?</u></a>
 
            

        </form>
      </div>
    
</div>
<div class="col-md-3"> </div>

</div>

</body


@stop
