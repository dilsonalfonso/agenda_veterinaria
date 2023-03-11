@extends('index')
@section('contenido')
<div>
    @if(isset($mensaje))
    <p class="mensaje_alerta">{{$mensaje}}</p>
    @endif
    <h3>Clientes</h3>
    <table>
        <thead>
            <th>id</th>
            <th>Cédula</th>
            <th>Nombres y Apellidos</th>
            <th>Celular</th>
            <th>Email</th>
            <th>Acciones <a href="{{route('ClientesC')}}"><input class="Secun" type="button" value="Nuevo Cliente"></a></th>
        </thead>
        <tbody><?php
        $contador=0;
        //$clientesJson=json_decode($clientes, true);
        $clientesJson=$clientes;
        foreach($clientesJson as $clave =>$valor)
        {
            $contador++;
            $id=$valor['id'];
            echo "<tr>";
            echo "<td>".$valor['id']."</td>";
            echo "<td>".$valor['cedu_clie']."</td>";
            echo "<td>".$valor['nomb_clie']." ".$valor['apel_clie']."</td>";
            echo "<td>".$valor['celu_clie']."</td>";
            echo "<td>".$valor['emai_clie']."</td>";
            echo "<td>";?>
            <a href="{{route('ClientesU',['id'=>$id])}}"><input type="button" value="Editar"></a>
            <a href="{{route('ClientesD',['id'=>$id])}}"><input class="Cuar" type="button" value="Eliminar"></a><?php
            echo "</td>";
            echo "</tr>";
        }unset($valor);
        if($contador==0)
        {
            echo "<td colspan='6'><span class='span'>No hay clientes registrados en el sistema</span><td>";
        }?>
        </tbody>
    </table>
</div>
@stop