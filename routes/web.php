<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ClientesController;
use App\Http\Controllers\MascotasController;
use App\Http\Controllers\CitasController;

/*Route::get('/', function () {
    return view('calendario');
})->name('/');*/

//Clientes
route::get('ClientesC',[ClientesController::class,'CreateCliente'])->name('ClientesC');
route::post('ClientesCreate',[ClientesController::class,'CreateClienteInsert'])->name('ClientesCreate');
route::get('ClientesR',[ClientesController::class,'ReadCliente'])->name('ClientesR');
route::get('ClientesU/{id}',[ClientesController::class,'UpdateCliente'])->name('ClientesU');
route::post('ClientesUpdate',[ClientesController::class,'UpdateClienteUpdate'])->name('ClientesUpdate');
route::get('ClientesD/{id}',[ClientesController::class,'DeleteCliente'])->name('ClientesD');

//Mascotas
route::get('MascotasC',[MascotasController::class,'CreateMascota'])->name('MascotasC');
route::post('MascotasCreate',[MascotasController::class,'CreateMascotaInsert'])->name('MascotasCreate');
route::get('MascotasR',[MascotasController::class,'ReadMascota'])->name('MascotasR');
route::get('MascotasU/{id}',[MascotasController::class,'UpdateMascota'])->name('MascotasU');
route::post('MascotasUpdate',[MascotasController::class,'UpdateMascotaUpdate'])->name('MascotasUpdate');
route::get('MascotasD/{id}',[MascotasController::class,'DeleteMascota'])->name('MascotasD');

//Citas
route::get('/',[CitasController::class,'Citas'])->name('/');;
route::get('/CitasC/{fecha}',[CitasController::class,'CreateCita'])->name('/CitasC');;
route::post('CitasCreate',[CitasController::class,'CreateCitaInsert'])->name('CitasCreate');
route::get('CitasR',[CitasController::class,'ReadCita'])->name('CitasR');
route::get('CitasU/{id}',[CitasController::class,'UpdateCita'])->name('CitasU');
route::post('CitasUpdate',[CitasController::class,'UpdateCitaUpdate'])->name('CitasUpdate');
route::get('CitasD/{id}',[CitasController::class,'DeleteCita'])->name('CitasD');
route::get('HorariosLibres/{fecha}',[CitasController::class,'HorariosLibres'])->name('HorariosLibres');


Route::get('/Ruta1/{dias}/{pagoDiario?}', function ($dias,$pagoDiario=null) {
    if ( $pagoDiario == null)
        $pagoDiario=20;
    $nomina = $pagoDiario * $dias;
    return "La nomina a pagar es de $nomina";
});
