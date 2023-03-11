@extends('index')
@section('contenido')
<div>
    @if(isset($mensaje))
    <p class="mensaje_alerta">{{$mensaje}}</p>
    @endif
    <h3>Citas</h3>
    <table>
        <thead>
            <th>id</th>
            <th>Mascota</th>
            <th>Dueño (Cliente)</th>
            <th>Fecha y Hora</th>
            <th>Acciones <a href="{{route('CitasC')}}">Nueva Cita</a></th>
        </thead>
        <tbody><?php
        $contador=0;
        $citasJson=json_decode($citas, true);
        foreach($citasJson as $clave=>$valor)
        {
            $contador++;
            echo "<tr>";
            echo "<td>".$valor['id']."</td>";
            echo "<td>".$valor['nomb_masc']."</td>";
            echo "<td>".$valor['nomb_clie']." ".$valor['apel_clie']."</td>";
            echo "<td>".$valor['fech_cita']."</td>";
            echo "<td></td>";
            echo "</tr>";
        }unset($valor);
        if($contador==0)
        {
            echo "<td colspan='6'><span class='span'>No hay citas registradas en el sistema</span><td>";
        }?>
        </tbody>
    </table>
</div>
@stop