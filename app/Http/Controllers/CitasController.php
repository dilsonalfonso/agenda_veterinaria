<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\citas;
use App\Models\mascotas;
use App\Models\clientes;

class CitasController extends Controller
{
    protected $mensaje;
    public function Citas()
    {
        $accion="ver";
        if (isset($GLOBALS['mensaje']) && $GLOBALS['mensaje'] != '')
        {
            $mensaje=$GLOBALS['mensaje'];
            return view('calendario',compact('accion','mensaje'));
        }
        else{
            return view('calendario',compact('accion'));
        }
    }
    public function CreateCita($fecha)
    {
        $accion='Agendar';
        $mascotas = mascotas::select('mascotas.id','mascotas.nomb_masc','clientes.nomb_clie','clientes.apel_clie','tipo_mascota.nomb_tipo')
                            ->join('clientes','clientes.id','=','mascotas.cliente_id')
                            ->join('tipo_mascota','tipo_mascota.id','=','mascotas.tipo_mascota_id')
                            ->orderBy('clientes.id')
                            ->get();
        if (isset($GLOBALS['mensaje']) && $GLOBALS['mensaje'] != '')
        {
            $mensaje=$GLOBALS['mensaje'];
            return view('calendario',compact('mascotas','mensaje','accion','fecha'));
        }
        else
        {
            return view('calendario',compact('mascotas','accion','fecha'));
        }
    }
    public function CreateCitaInsert(Request $request)
    {
        $this->validate($request,[
            'mascota' => 'required',
            'hora' => 'required',
            'fecha' => 'required' 
        ]);
        $fechaCita= $request->fecha.' '.$request->hora.':00:00';
        $citas = new citas;
        $citas->mascota_id = $request->mascota;
        $citas->fech_cita = $fechaCita;
        $citas->save();
        $mascota=mascotas::select('mascotas.nomb_masc','tipo_mascota.nomb_tipo', 'clientes.nomb_clie','clientes.apel_clie')
                ->join('clientes','clientes.id','=','mascotas.cliente_id')
                ->join('tipo_mascota','tipo_mascota.id','=','mascotas.tipo_mascota_id')
                ->where('mascotas.id',$request->mascota)
                ->get();
        $GLOBALS['mensaje']="La Cita para la Mascota ".$mascota[0]['nomb_masc']." (".$mascota[0]['nomb_tipo'].") 
                            perteneciente a ".$mascota[0]['nomb_clie']." ".$mascota[0]['apel_clie']." 
                            ha sido agendada para la fecha ".$fechaCita." con exito!";
        return $this->Citas();
    }
    public function ReadCita()
    {
        $citas = citas::select(citas::raw('CONCAT(mascotas.nomb_masc," (", clientes.nomb_clie,")") AS title'),'citas.id','citas.fech_cita as start','clientes.nomb_clie as description')
                        ->join('mascotas','mascotas.id','=','citas.mascota_id')
                        ->join('clientes','clientes.id','=','mascotas.cliente_id')
                        ->get();
        foreach($citas as $clave =>$valor)
        {
            $expFecha=explode(':',$citas[$clave]['start']);
            $citas[$clave]['end']=$expFecha[0].':59:00';
        }
       return response()->json($citas);
    }
    public function UpdateCita($id)
    {
        $citas = citas::find($id);
        $accion='Actualizar';
        $mascotas = mascotas::select('mascotas.id','mascotas.nomb_masc','clientes.nomb_clie','clientes.apel_clie','tipo_mascota.nomb_tipo')
                            ->join('clientes','clientes.id','=','mascotas.cliente_id')
                            ->join('tipo_mascota','tipo_mascota.id','=','mascotas.tipo_mascota_id')
                            ->orderBy('clientes.id')
                            ->get();
        return view('calendario')
        ->with('citas',$citas)
        ->with('mascotas',$mascotas)
        ->with('accion',$accion);
    }
    public function UpdateCitaUpdate(Request $request)
    {
        $this->validate($request,[
            'mascota' => 'required',
            'hora' => 'required',
            'fecha' => 'required' 
        ]);
        $fechaCita=$request->fecha." ".$request->hora.":00:00";
        $citas = citas::find($request->id);
        $citas->mascota_id =$request->mascota;
        $citas->fech_cita=$fechaCita;
        $citas->save();
        $GLOBALS['mensaje']="La Cita ha sido Actualizada con exito!";
        return $this->Citas();
    }
    public function DeleteCita($id)
    {
        $citas=citas::find($id);
        $citas->delete();
        $GLOBALS['mensaje']="La Cita ha sido Eliminada con exito!";
        return $this->Citas();
    }
    public function HorariosLibres($fecha)
    {
        //Suponiendo que las citas tienen una duracion fija para todas de 1 hora.
        $horaApertura=8;
        $horaCierre=18;
        $horaDescanso=12;
        $duracionDescanso=2;
        $contadorHoras=0;
        for($h=$horaApertura; $h>=$horaApertura && $h<$horaCierre ;$h++)
        {
            if($h<$horaDescanso || $h>=($horaDescanso+$duracionDescanso))
            {
                $fechaConsultar=$fecha.' '.$h.':00:00';
                $horas=citas::select('id')
                        ->where('fech_cita',$fechaConsultar)
                        ->get();
                if($horas->isEmpty())
                {
                    $fechasLibres[$contadorHoras]['hora']=$h;
                    $contadorHoras++;
                }
            }
        }
        return json_encode($fechasLibres);
    }
}
