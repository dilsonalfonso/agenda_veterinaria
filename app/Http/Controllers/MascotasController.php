<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\mascotas;
use App\Models\clientes;
use App\Models\tipo_mascota;

class MascotasController extends Controller
{
    protected $mensaje;
    //Muestra Formulario de Creacion de cliente
    public function CreateMascota()
    {
        $clientes = clientes::select('id','nomb_clie','apel_clie')
                            ->get();
        $tiposMascota = tipo_mascota::select('id','nomb_tipo')
                            ->from('tipo_mascota')
                            ->get();
        $accion="Crear";
        if ( $clientes -> isNotEmpty())
        {
            return view('mascotasformulario', compact('clientes','tiposMascota','accion'));
        }
        else{
            $GLOBALS['mensaje']="Para poder registrar una mascota PRIMERO deben estar registrados el cliente (dueño de la mascota) y los tipos de mascotas!";
            return $this->ReadMascota();
        }
    }
    //Creacion de Mascota en DB
    public function CreateMascotaInsert(Request $request)
    {
        $this->validate($request,[
            'nombre' => 'required|regex:/^[A-Z][A-Z,a-z, ,á,é,í,ó,ú,ñ,Ñ]+$/',
            'cliente' => 'required',
            'tipo_mascota' => 'required' 
        ]);
        $mascota = new mascotas;
        $mascota->nomb_masc = $request->nombre;
        $mascota->cliente_id = $request->cliente;
        $mascota->tipo_mascota_id = $request->tipo_mascota;
        $mascota->save();
        $cliente=clientes::select('nomb_clie','apel_clie')
                ->where('id',$request->cliente)
                ->get();
        $GLOBALS['mensaje']="Mascota $request->nombre perteneciente a ".$cliente[0]['nomb_clie']." ".$cliente[0]['apel_clie']." ha sido registrado con exito!";
        return $this->ReadMascota();
    }
    //Vista de Mascotas registrados; Se hace llamado a esta funcion luego de Crear y Actualizar
    public function ReadMascota()
    {
        $mascotas = mascotas::select('mascotas.*', 'clientes.nomb_clie', 'clientes.apel_clie', 'tipo_mascota.nomb_tipo')
                    ->join('clientes','clientes.id','=','mascotas.cliente_id')
                    ->join('tipo_mascota','tipo_mascota.id','=','mascotas.tipo_mascota_id')
                    ->orderBy('mascotas.id')
                    ->get();
        if (isset($GLOBALS['mensaje']) && $GLOBALS['mensaje'] != '')
        {
            $mensaje=$GLOBALS['mensaje'];
            return view('mascotas', compact('mascotas','mensaje'));
        }
        else
        {
            return view('mascotas', compact('mascotas'));
        }
    }
    //Se va al formulario para actualizar Mascota
    public function UpdateMascota($id)
    {
        $clientes = clientes::select('id','nomb_clie','apel_clie')
                            ->get();
        $tiposMascota = tipo_mascota::select('id','nomb_tipo')
                            ->from('tipo_mascota')
                            ->get();
        $mascotas = mascotas::select('mascotas.*', 'clientes.nomb_clie', 'clientes.apel_clie', 'tipo_mascota.nomb_tipo')
                    ->join('clientes','clientes.id','=','mascotas.cliente_id')
                    ->join('tipo_mascota','tipo_mascota.id','=','mascotas.tipo_mascota_id')
                    ->orderBy('mascotas.id')
                    ->where('mascotas.id',$id)
                    ->get();
        $accion="Actualizar";
        return view('mascotasformulario')
        ->with('mascotas',$mascotas[0])
        ->with('clientes',$clientes)
        ->with('tiposMascota',$tiposMascota)
        ->with('accion',$accion);
    }
    //Se actualiza la informacion de la mascota
    public function UpdateMascotaUpdate(Request $request)
    {
        $this->validate($request,[
            'nombre' => 'required|regex:/^[A-Z][A-Z,a-z, ,á,é,í,ó,ú,ñ,Ñ]+$/',
            'cliente' => 'required',
            'tipo_mascota' => 'required' 
        ]);
        $mascotas = mascotas::find($request->id);
        $mascotas->nomb_masc=$request->nombre;
        $mascotas->cliente_id=$request->cliente;
        $mascotas->tipo_mascota_id=$request->tipo_mascota;
        $mascotas->save();
        $GLOBALS['mensaje']="Mascota $request->nombre ha sido Actualizada con exito!";
        return $this->ReadMascota();
    }
    //Se elimina la Mascota
    public function DeleteMascota($id)
    {
        $mascotas=mascotas::find($id);
        $mascotas->delete();
        $GLOBALS['mensaje']="La Mascota ha sido Eliminada con exito!";
        return $this->ReadMascota();
    }
}
