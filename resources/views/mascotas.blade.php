@extends('index')
@section('contenido')
<div>
    @if(isset($mensaje))
    <p class="mensaje_alerta">{{$mensaje}}</p>
    @endif
    <h3>Mascotas</h3>
    <table>
        <thead>
            <th>id</th>
            <th>Nombre</th>
            <th>Dueño (Cliente)</th>
            <th>Tipo de Mascota</th>
            <th>Acciones <a href="{{route('MascotasC')}}"><input class="Secun" type="button" value="Nueva Mascota"></a></th>
        </thead>
        <tbody><?php
        $contador=0;
        $mascotasJson=json_decode($mascotas, true);
        foreach($mascotasJson as $clave=>$valor)
        {
            $id=$valor['id'];
            $contador++;
            echo "<tr>";
            echo "<td>".$valor['id']."</td>";
            echo "<td>".$valor['nomb_masc']."</td>";
            echo "<td>".$valor['nomb_clie']." ".$valor['apel_clie']."</td>";
            echo "<td>".$valor['nomb_tipo']."</td>";
            echo "<td>";?>
            <a href="{{route('MascotasU',['id'=>$id])}}"><input type="button" value="Editar"></a>
            <a href="{{route('MascotasD',['id'=>$id])}}"><input class="Cuar" type="button" value="Eliminar"></a><?php
            echo "</td>";
            echo "</tr>";
        }unset($valor);
        if($contador==0)
        {
            echo "<td colspan='6'><span class='span'>No hay mascotas registrados en el sistema</span><td>";
        }?>
        </tbody>
    </table>
</div>
@stop