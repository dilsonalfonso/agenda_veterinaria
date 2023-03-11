@extends('index')
@section('contenido')
<div class="container">
    @if(isset($mensaje))
    <p class="mensaje_alerta">{{$mensaje}}</p>
    @endif
    <h3>Calendario</h3>
    <p>Para este proyecto se establecio un modelo de citas con duracion de 1 hora.</p>
    <p class="informacion-spam">En el boton "Agenda" puedes ver los lapsos de tiempo de cada cita.</p>
    <div id="veterinariaCalendario"></div>
</div>
@if($accion=='Actualizar')
<?php
//Esto Sucede al actualizar la cita
$citas;//Informacion de la cita
$id=$citas['id'];
$selectMascota=$citas['mascota_id'];
//separo Fecha y Hora
$fechayHoraCita=explode(' ',$citas['fech_cita']);
$fechaCita=$fechayHoraCita[0];
$HoraCita=explode(':',$fechayHoraCita[1]);
$horaCita=$HoraCita[0];
?>
@endif
@if($accion!='ver')
<?php
$opcionesMascotas='';
$nombreMascotaActual='';
foreach ($mascotas as $clave =>$valor)
{
    $opcionesMascotas.="<option value='".$mascotas[$clave]['id']."'";
    if($accion=='Actualizar'&&$mascotas[$clave]['id']==$selectMascota){
        $opcionesMascotas.="selected";
        $nombreMascotaActual=$mascotas[$clave]['nomb_masc']." - ".$mascotas[$clave]['nomb_clie']." ".$mascotas[$clave]['apel_clie'];
    }
    $opcionesMascotas.= ">".$mascotas[$clave]['nomb_masc']." - ".$mascotas[$clave]['nomb_clie']." ".$mascotas[$clave]['apel_clie']."</option>";
}?>
<header id="header2" class="skel-layers-fixed" style="display:block"></header> 
<header id="header3" class="skel-layers-fixed" style="display:flex">

<h3>{{$accion}} Cita</h3>
@if($accion=='Actualizar')
    <p class="informacion-spam">Estas Actualizando la cita para la Mascota {{$nombreMascotaActual}}, el dia {{$fechaCita}} Hora: {{$horaCita}}:00:00</p>
@endif
    <form id="formularioDatos" action="@if($accion=='Actualizar'){{route('CitasUpdate')}}@endif @if($accion=='Agendar'){{route('CitasCreate')}}@endif" method="post">
        {{ csrf_field() }}
        @if($accion=='Actualizar')
        <input type="hidden" name="id" id="id" value="{{$id}}">
        @endif
        <ul class="formulario">
            <li>
                <label for="mascota">Mascota (Cliente)</label>
                @if($errors->first('mascota'))
                    <p class="formulario-error">{{$errors->first('mascota')}}</p>
                @endif
            </li>
            <li>
                <select name="mascota" id="mascota" required>
                    <option value="">Escoja una Mascota</option>
                    <?php echo $opcionesMascotas;  ?>
                </select>
            </li>
        </ul>
        <ul class="formulario">
            <li>
                <label for="fecha">Fecha de la Cita</label>
                @if($errors->first('fecha'))
                    <p class="formulario-error">{{$errors->first('fecha')}}</p>
                @endif
            </li>
            <li>
                <input type="date" id="fecha" name="fecha" value="@if($accion=='Actualizar'){{$fechaCita}}@else{{$fecha}}@endif" onchange="horariosDisponibles(2)" required>
                
            </li>
        </ul>
        <ul class="formulario">
            <li>
                <label for="hora">Hora de la Cita</label>
                @if($errors->first('hora'))
                    <p class="formulario-error">{{$errors->first('hora')}}</p>
                @endif
            </li>
            <li>
                <select id="hora" name="hora" required>
                    @if($accion=='Actualizar')
                        <option value="{{$horaCita}}" selected>{{$horaCita}}:00:00 Actualmente</option>
                    @endif
                </select>
            </li>
        </ul>
        <ul class="formulario">
            <li>	
                <input id="boton_agendar" type="submit" value="{{$accion}}" name="{{$accion}}">
                @if($accion=='Actualizar')
                <a href="{{route('CitasD',['id'=>$id])}}"><input id="boton_borrar" class="Secun" type="button" value="Eliminar" name="Eliminar"></a>
                @endif
                <script type="text/javascript">horariosDisponibles(1);</script>
                <a href="{{route('/')}}"><input id="boton_cerrar" class="Terc" type="button" value="Cancelar" name="Cancelar"></a>
            </li>
        </ul>
    </form>
</header>
@endif
@stop