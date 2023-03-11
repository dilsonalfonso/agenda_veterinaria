<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\clientes;

class ClientesController extends Controller
{
    protected $mensaje; //Esta Variable se estara modificando con $ GLOBAL para mostrar mensajes
    //Vista del formulario con la accion de crear nuevo
    public function CreateCliente()
    {
        $accion="Crear";
        return view('clientesformulario',compact('accion'));
    }
    //Creacion de cliente en DB
    public function CreateClienteInsert(Request $request)
    {
        $this->validate($request,[
            'cedula' => 'required|regex:/^[0-9]+$/|min:7|max:10',
            'nombres' => 'required|regex:/^[A-Z][A-Z,a-z, ,á,é,í,ó,ú,ñ,Ñ]+$/',
            'apellidos' => 'required|regex:/^[A-Z][A-Z,a-z, ,á,é,í,ó,ú,ñ,Ñ]+$/',
            'celular' => 'required|regex:/^[0-9]{10}$/',
            'email' => 'required|email' 
        ]);
        $cliente = new clientes;
        $cliente->cedu_clie = $request->cedula;
        $cliente->nomb_clie = $request->nombres;
        $cliente->apel_clie = $request->apellidos;
        $cliente->celu_clie = $request->celular;
        $cliente->emai_clie = $request->email;
        $cliente->save();
        $GLOBALS['mensaje']="Cliente $request->nombres $request->apellidos ha sido registrado con exito!";
        return $this->ReadCliente();
    }
    //Vista de Clientes registrados; Se hace llamado a esta funcion luego de Crear y Actualizar
    public function ReadCliente()
    {
        $clientes = clientes::all();
        if (isset($GLOBALS['mensaje']) && $GLOBALS['mensaje'] != '') //En caso de que se ubiese Creado o Actualizado
        {
            $mensaje=$GLOBALS['mensaje'];
            return view('clientes', compact('clientes','mensaje'));
        }
        else
        {
            return view('clientes', compact('clientes'));
        }
    }
    //Se muestra el formulario con accion Actualizar
    public function UpdateCliente($id)
    {
        $clientes = clientes::find($id);
        $accion="Actualizar";
        return view('clientesformulario')
        ->with('clientes',$clientes)
        ->with('accion',$accion);
    }
    //Se actualiza el cliente
    public function UpdateClienteUpdate(Request $request)
    {
        $this->validate($request,[
            'cedula' => 'required|regex:/^[0-9]+$/|min:7|max:10',
            'nombres' => 'required|regex:/^[A-Z][A-Z,a-z, ,á,é,í,ó,ú]+$/',
            'apellidos' => 'required|regex:/^[A-Z][A-Z,a-z, ,á,é,í,ó,ú]+$/',
            'celular' => 'required|regex:/^[0-9]{10}$/',
            'email' => 'required|email' 
        ]);
        $clientes = clientes::find($request->id);
        $clientes->cedu_clie=$request->cedula;
        $clientes->nomb_clie=$request->nombres;
        $clientes->apel_clie=$request->apellidos;
        $clientes->celu_clie=$request->celular;
        $clientes->emai_clie=$request->email;
        $clientes->save();
        $GLOBALS['mensaje']="Cliente $request->nombres $request->apellidos ha sido Actualizada con exito!";
        return $this->ReadCliente();
    }
    public function DeleteCliente($id)
    {
        $clientes=clientes::find($id);
        $clientes->delete();
        $GLOBALS['mensaje']="El Cliente ha sido Eliminado con exito!";
        return $this->ReadCliente();
    }
}
