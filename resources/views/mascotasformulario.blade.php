@extends('index')
@section('contenido')
<?php
$id='';
$nombre='';
$cliente='';
$tipo_mascota='';
if($accion=='Actualizar'){
    $id=$mascotas['id'];
    $nombre=$mascotas['nomb_masc'];
    $cliente=$mascotas['cliente_id'];
    $tipo_mascota=$mascotas['tipo_mascota_id'];
}
?>
<div> 
    <h3>{{$accion}} Mascota</h3>
    @if( $accion == 'Actualizar')
        <form action="{{route('MascotasUpdate')}}" method="post">
            <input type="hidden" name="id" id="id" value="{{$id}}">
    @endif
    @if( $accion == 'Crear')
        <form action="{{route('MascotasCreate')}}" method="post">
    @endif
    {{ csrf_field() }}
        {{ csrf_field() }}
        <ul class="formulario">
            <li>
                <label for="nombre">Nombre de la Mascota</label>
                @if($errors->first('nombre'))
                    <p class="formulario-error">{{$errors->first('nombre')}}</p>
                @endif
            </li>
            <li>
                <input type="text" name="nombre" id="nombre" 
                @if(old('nombre') != '' )
                    value="{{old('nombre')}}"
                @else
                    value="{{$nombre}}"
                @endif
                autofocus>
            </li>
        </ul>
        <ul class="formulario">
            <li>
                <label for="cliente">Dueño</label>
                @if($errors->first('cliente'))
                    <p class="formulario-error">{{$errors->first('cliente')}}</p>
                @endif
            </li>
            <li>
                <select name="cliente" id="cliente" required>
                    <option value="">Escoja un Cliente</option>
                    @foreach ($clientes as $cliente)
                        <option value="{{ $cliente->id }}"
                        <?php if($accion=='Actualizar'&&$cliente['id']==$mascotas['cliente_id']) echo "selected";?>
                        >{{ $cliente->nomb_clie }} {{ $cliente->apel_clie }}</p>
                    @endforeach
                </select>
            </li>
        </ul>
        <ul class="formulario">
            <li>
                <label for="tipo_mascota">Tipo de Mascota</label>
                @if($errors->first('tipo_mascota'))
                    <p class="formulario-error">{{$errors->first('tipo_mascota')}}</p>
                @endif
            </li>
            <li>
                <select name="tipo_mascota" id="tipo_mascota" required>
                    <option value="">Escoja un Tipo</option>
                    @foreach ($tiposMascota as $tipoMascota)
                        <option value="{{ $tipoMascota->id }}"
                        <?php if($accion=='Actualizar'&&$tipoMascota['id']==$mascotas['tipo_mascota_id']) echo "selected";?>
                        >{{ $tipoMascota->nomb_tipo }}</p>
                    @endforeach
                </select>
            </li>
        </ul>
        <ul class="formulario">
            <li>	
                <input type="submit" value="{{$accion}}" name="{{$accion}}">
                <a href="{{route('MascotasR')}}"><input id="boton_cerrar" class="Terc" type="button" value="Cancelar" name="Cancelar"></a>
            </li>
        </ul>
    </form>
</div>
@stop