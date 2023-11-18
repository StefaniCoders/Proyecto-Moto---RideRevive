<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ClienteController;
use App\Http\Controllers\EmpleadoController;
use App\Http\Controllers\MotoController;
use App\Http\Controllers\CategoriaController;
use App\Http\Controllers\HorarioController;
use App\Http\Controllers\UsuarioController;
use App\Http\Controllers\CitaController;
use App\Http\Controllers\ReporteController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/', function () {
//     return view('login');
// });

Route::get('/', [AuthController::class, 'index']);


Route::post('/authenticate', [AuthController::class, 'authenticate'])->name('authenticate');
Route::get('/logout', [AuthController::class, 'logout']);



Route::group(['middleware' => 'usercheck'], function () {

    Route::get('/home', [DashboardController::class, 'index'])->name('home');
    
    Route::get('/clientes',  [App\Http\Controllers\ClienteController::class, 'index'])->name('clientes');
    Route::get('/clientes-records/{search?}',  [App\Http\Controllers\ClienteController::class, 'records']);
    Route::get('/clientes-edit/{id}',  [App\Http\Controllers\ClienteController::class, 'getCliente']);
    Route::get('/clientes-create',  [App\Http\Controllers\ClienteController::class, 'create'])->name('clientes-create');
    Route::post('/clientes-store',  [App\Http\Controllers\ClienteController::class, 'store'])->name('clientes-store');
    Route::get('/clientes-delete/{id}',  [App\Http\Controllers\ClienteController::class, 'delete'])->name('clientes-delete');

    Route::get('/empleados', [App\Http\Controllers\EmpleadoController::class, 'index'])->name('empleados');
    Route::get('/empleados-records/{search?}',  [App\Http\Controllers\EmpleadoController::class, 'records']);
    Route::get('/empleados-create', [App\Http\Controllers\EmpleadoController::class, 'create'])->name('empleados-create');
    Route::post('/empleados-store',  [App\Http\Controllers\EmpleadoController::class, 'store'])->name('empleados-store');
    Route::get('/empleados-edit/{id}',  [App\Http\Controllers\EmpleadoController::class, 'getEmpleado']);
    Route::get('/empleados-delete/{id}',  [App\Http\Controllers\EmpleadoController::class, 'delete'])->name('empleados-delete');
    

    Route::get('/motos',  [App\Http\Controllers\MotoController::class, 'index'])->name('motos');
    Route::get('/motos-records',  [App\Http\Controllers\MotoController::class, 'records']);
    Route::get('/moto-create',  [App\Http\Controllers\MotoController::class, 'create'])->name('moto-create');
    Route::get('/moto-edit',  [App\Http\Controllers\MotoController::class, 'getMoto']);
    Route::post('/moto-store',  [App\Http\Controllers\MotoController::class, 'store'])->name('moto-store');
    Route::get('/buscarMoto/{search?}',  [App\Http\Controllers\MotoController::class, 'buscarMoto'])->name('buscarMoto');
    Route::get('/moto-delete/{id}',  [App\Http\Controllers\MotoController::class, 'delete'])->name('moto-delete');



    Route::get('/categorias/{search?}',  [App\Http\Controllers\CategoriaController::class, 'index'])->name('categorias');
    Route::get('/buscarcategoria/{search?}',  [App\Http\Controllers\CategoriaController::class, 'buscarCategoria'])->name('buscarcategoria');
    Route::get('/categorias-records',  [App\Http\Controllers\CategoriaController::class, 'records']);
    Route::get('/categoria-create',  [App\Http\Controllers\CategoriaController::class, 'create'])->name('categoria-create');
    Route::get('/categoria-edit',  [App\Http\Controllers\CategoriaController::class, 'getCategoria']);
    Route::post('/categoria-store',  [App\Http\Controllers\CategoriaController::class, 'store'])->name('categoria-store');
    Route::get('/categoria-delete/{id}',  [App\Http\Controllers\CategoriaController::class, 'delete'])->name('categoria-delete');

    //Route::get('/horarios',  [App\Http\Controllers\HorarioController::class, 'index'])->name('horarios');
    Route::get('/horarios',  [App\Http\Controllers\HorarioController::class, 'index'])->name('horarios');
    Route::post('/horario-store',  [App\Http\Controllers\HorarioController::class, 'store'])->name('horario-store');
    Route::get('/horario-categoria/{IdCategoria}',  [App\Http\Controllers\HorarioController::class, 'horariocategoria']);
    Route::get('/horario-show',  [App\Http\Controllers\HorarioController::class, 'show'])->name('horario-show');
    Route::get('/horario-edit/{IdHorario}/{IdCategoria}',  [App\Http\Controllers\HorarioController::class, 'edit'])->name('horario-edit');


    Route::get('/citas',  [App\Http\Controllers\CitaController::class, 'index'])->name('citas');
    Route::get('/cita-create/{id?}',  [App\Http\Controllers\CitaController::class, 'create'])->name('cita-create');
    Route::get('/citas-create/{id?}',  [App\Http\Controllers\CitaController::class, 'creates'])->name('citas-create');
    Route::post('/cita-store',  [App\Http\Controllers\CitaController::class, 'store']);
    Route::post('/cita-edits',  [App\Http\Controllers\CitaController::class, 'editstore']);
    Route::get('/cita-edits', 'CitaController@editstore')->name('cita-edits');

    Route::get('/cita-delete/{id}',  [App\Http\Controllers\CitaController::class, 'delete'])->name('cita-delete');
   
    Route::post('/cita-finish',  [App\Http\Controllers\CitaController::class, 'finish'])->name('cita-finish');
    Route::get('/cita-export',  [App\Http\Controllers\CitaController::class, 'downloadExcel'])->name('cita-export');


    Route::get('/gethorario/{fecha}',  [App\Http\Controllers\HorarioController::class, 'getHorario']);

    Route::get('/grafico',  [App\Http\Controllers\CitaController::class, 'grafico']);
    Route::get('/buscarCita/{search?}',  [App\Http\Controllers\CitaController::class, 'buscarCita'])->name('buscarCita');


   // Route::post('/usuario-store',  [App\Http\Controllers\UsuarioController::class, 'store']);


    Route::get('/reporte',  [ReporteController::class, 'index'])->name('reporte');
    Route::get('/reporte-records/{IdCategoria}',  [ReporteController::class, 'records']);
    Route::get('/reporte-excel/{IdCategoria}', [ReporteController::class, 'exportExcel']);
    Route::get('/reporte-pdf/{IdCategoria}', [ReporteController::class, 'exportPdf']);

    // Route::post('/cita-store',  [App\Http\Controllers\CitaController::class, 'store'])->name('cita-store');

});
//Route::get('/horario-show1',  [App\Http\Controllers\HorarioController::class, 'show']);
// Route::post('/empleado-update',  [App\Http\Controllers\CategoriaController::class, 'update'])->name('empleado-update');
//TODO: MOVER LO DE ABAJO, DENTRO DEL MIDDLEWARE DE ARRIBA 🐷
//usuarios
Route::get('/usuarios',  [App\Http\Controllers\UsuarioController::class, 'index'])->name('usuarios');
Route::get('/usuarios-records/{search?}',  [App\Http\Controllers\UsuarioController::class, 'buscarUsuario']);
Route::post('/usuario-store',  [App\Http\Controllers\UsuarioController::class, 'store'])->name('usuario-store');;
Route::get('/usuarios-delete/{id}',  [App\Http\Controllers\UsuarioController::class, 'delete'])->name('usuarios-delete');
//categoria update check
Route::get('/categoria-update',  [App\Http\Controllers\CategoriaController::class, 'update'])->name('categoria-update');


Route::get('/usuario-create',  [App\Http\Controllers\UsuarioController::class, 'create'])->name('usuarios');

Route::get('/usuario-edit',  [App\Http\Controllers\UsuarioController::class, 'getMoto']);

//moto-update check TODO: CAMBIAR A POST MARRANO 🐖
Route::get('/moto-update',  [App\Http\Controllers\MotoController::class, 'update'])->name('moto-update');
//usuario store TODO: CAMBIAR A POST MARRANO 🐖
Route::get('/usuario-update',  [App\Http\Controllers\UsuarioController::class, 'store'])->name('usuario-update');
Route::get('/cita-store',  [App\Http\Controllers\CitaController::class, 'store'])->name('cita-store');

// Route::post('/empleado-update',  [App\Http\Controllers\CategoriaController::class, 'update'])->name('empleado-update');

//Route::middleware(['usercheck'])->group(function () {

//});



