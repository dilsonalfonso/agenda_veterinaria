@extends('index')
@section('formularioCita')
<div> 
    <h3>Crear Nueva Cita</h3>
    <form action="{{route('CitasCreate')}}" method="post">
        {{ csrf_field() }}
        <ul class="formulario">
            <li>
                <label for="mascota">Mascota</label>
            </li>
            <li>
                <select name="mascota" id="mascota">
                    <option value="">Escoja una Mascota</option>
                    @foreach ($mascotas as $mascota)
                        <option value="{{ $mascota->id }}">{{ $mascota->nomb_masc }}-{{ $mascota->nomb_clie }} {{ $mascota->apel_clie }}</p>
                    @endforeach
                </select>
            </li>
        </ul>
        <ul class="formulario">
            <li>
                <label for="fecha">fecha y hora de la Cita</label>
            </li>
            <li>
                <input type="date" id="fecha" name="fecha" onchange="horariosDisponibles()">
            </li>
        </ul>
        <ul class="formulario">
            <li>
                <label for="hora">fecha y hora de la Cita</label>
            </li>
            <li>
                <select type="date" id="hora" name="hora">

                </select>
            </li>
        </ul>
        <ul class="formulario">
            <li>	
                <input id="boton_agendar" type="submit" value="Agendar" name="Agendar">
            </li>
        </ul>
    </form>
</div>
@stop