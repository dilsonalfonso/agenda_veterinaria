@extends('index')
@section('contenido')
<?php
$id='';
$cedula="";
$nombres='';
$apellidos='';
$celular='';
$email='';
if($accion=='Actualizar'){
    $id=$clientes['id'];
    $cedula=$clientes['cedu_clie'];
    $nombres=$clientes['nomb_clie'];
    $apellidos=$clientes['apel_clie'];
    $celular=$clientes['celu_clie'];
    $email=$clientes['emai_clie'];
}
?>
<div> 
    <h3>{{$accion}} Cliente</h3>
    @if( $accion == 'Actualizar')
        <form action="{{route('ClientesUpdate')}}" method="post">
            <input type="hidden" name="id" id="id" value="{{$id}}">
    @endif
    @if( $accion == 'Crear')
        <form action="{{route('ClientesCreate')}}" method="post">
    @endif
    {{ csrf_field() }}
        <ul class="formulario">
            <li>
                <label for="cedula">Cédula</label>
                @if($errors->first('cedula'))
                    <p class="formulario-error">{{$errors->first('cedula')}}</p>
                @endif
            </li>
            <li>
                <input type="number" name="cedula" id="cedula"
                @if(old('cedula') != '' )
                    value="{{old('cedula')}}"
                @else
                    value="{{$cedula}}"
                @endif
                 autofocus>
            </li>
        </ul>
        <ul class="formulario">
            <li>
                <label for="nombres">Nombres</label>
                @if($errors->first('nombres'))
                    <p class="formulario-error">{{$errors->first('nombres')}}</p>
                @endif
            </li>
            <li>
                <input type="text" name="nombres" id="nombres" 
                @if(old('nombres') != '' )
                    value="{{old('nombres')}}"
                @else
                    value="{{$nombres}}"
                @endif
                >
            </li>
        </ul>
        <ul class="formulario">
            <li>
                <label for="apellidos">Apellidos</label>
                @if($errors->first('apellidos'))
                    <p class="formulario-error">{{$errors->first('apellidos')}}</p>
                @endif
            </li>
            <li>
                <input type="text" name="apellidos" id="apellidos" 
                @if(old('apellidos') != '' )
                    value="{{old('apellidos')}}"
                @else
                    value="{{$apellidos}}"
                @endif
                >
            </li>
        </ul>
        <ul class="formulario">
            <li>
                <label for="celular">Celular</label>
                @if($errors->first('celular'))
                    <p class="formulario-error">{{$errors->first('celular')}}</p>
                @endif
            </li>
            <li>
                <input type="number" name="celular" id="celular" 
                @if(old('celular') != '' )
                    value="{{old('celular')}}"
                @else
                    value="{{$celular}}"
                @endif
                >
            </li>
        </ul>
        <ul class="formulario">
            <li>
                <label for="email">Email</label>
                @if($errors->first('email'))
                    <p class="formulario-error">{{$errors->first('email')}}</p>
                @endif
            </li>
            <li>
                <input type="email" name="email" id="email" 
                @if(old('email') != '' )
                    value="{{old('email')}}"
                @else
                    value="{{$email}}"
                @endif
                >
            </li>
        </ul>
        <ul class="formulario">
            <li>	
                <input type="submit" value="{{$accion}}" name="{{$accion}}">
                <a href="{{route('ClientesR')}}"><input id="boton_cerrar" class="Terc" type="button" value="Cancelar" name="Cancelar"></a>
            </li>
        </ul>
    </form>
</div>
@stop