<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\MainController;

use App\Http\Controllers\UsuarioController;

use App\Http\Controllers\PreregistroController;

use App\Http\Controllers\CustomAuthController;

use App\Http\Controllers\CatalogoGeograficoController;

use App\Http\Controllers\EmpresaController;

use App\Http\Controllers\AdminEmpresaController;

use App\Http\Controllers\RevisorController;

use App\Http\Controllers\ContralorController;

use App\Http\Controllers\SupervisorController;

use App\Http\Controllers\JefaturaController;

use App\Http\Controllers\RefrendoController;

use App\Exports\EmpresasExport;
use App\Exports\RefrendosExport;
use App\Exports\ProductividadExport;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

Route::get('login', [CustomAuthController::class, 'index'])->name('login');
Route::post('custom-login', [CustomAuthController::class, 'customLogin'])->name('login.custom');
Route::get('registro', [CustomAuthController::class, 'registration'])->name('register-user');
Route::post('custom-registration', [CustomAuthController::class, 'customRegistration'])->name('register.custom');
Route::get('logout', [CustomAuthController::class, 'signOut'])->name('logout');


Route::get('/', [MainController::class, 'index'])->middleware(['auth'])->name('inicio');

Route::get('/sql', [MainController::class, 'sql'])->middleware(['auth'])->name('sql');




/* Ruta Validacion */

Route::get('/validacion/{uuid}/{rfc}', [EmpresaController::class, 'validacion'])->name('empresa.validacion');

/* Ruta de Validacion*/


/* Ruta Reportes */

Route::get('/reportes', [MainController::class, 'reportesIndex'])->middleware(['auth'])->name('reportes.index');

Route::post('/reportes', [MainController::class, 'reportesGenerar'])->middleware(['auth'])->name('reportes.generar');


Route::get('/reportes/inscripcion', [MainController::class, 'reportesInscripciones'])->middleware(['auth'])->name('reportes.inscripcion');
Route::get('/reportes/refrendo', [MainController::class, 'reportesRefrendos'])->middleware(['auth'])->name('reportes.refrendo');


Route::get('/reportes/empresas', function () {
    return Excel::download(new EmpresasExport, 'ArranqueEmpresas.xlsx');
});


Route::get('/reportes/refrendos', function () {
    return Excel::download(new RefrendosExport, 'Refrendos.xlsx');
});


Route::get('/reportes/productividad', function () {
    return Excel::download(new ProductividadExport, 'productividad.xlsx');
});


/* Ruta de Reportes */





/* Rutas Preregistros */

Route::get('/preregistros', [PreregistroController::class, 'index'])->middleware(['auth'])->name('preregistros.index');

Route::post('/preregistro/acceso', [PreregistroController::class, 'crearAcceso'])->middleware(['auth']);

Route::get('/preregistro/acceso/{id_preregistro}', [PreregistroController::class, 'acceso'])->middleware(['auth'])->name('preregistros.acceso');

Route::get('/registro', [PreregistroController::class, 'registro'])->name('registro.index');
Route::post('/registro', [PreregistroController::class, 'registroStore'])->name('registro.store');

/* Fin Rutas Preregistros */


/* Rutas Jefatura */

Route::get('jefatura/empresas', [JefaturaController::class, 'index'])->middleware(['auth'])->name('jefatura.index');
Route::get('/jefatura/empresas/list', [JefaturaController::class, 'getEmpresas'])->middleware(['auth'])->name('jefatura.list');
Route::get('/jefatura/refrendos/list', [JefaturaController::class, 'getRefrendos'])->middleware(['auth'])->name('jefatura.refrendos.list');

Route::get('jefatura/refrendos', [JefaturaController::class, 'indexRefrendos'])->middleware(['auth'])->name('jefatura.refrendos.index');


Route::get('jefatura/empresas/ver/{id}', [JefaturaController::class, 'ver'])->middleware(['auth'])->name('jefatura.ver');
Route::get('jefatura/refrendos/ver/{id}', [JefaturaController::class, 'verRefrendo'])->middleware(['auth'])->name('jefatura.ver.refrendo');

Route::post('jefatura/constancia', [JefaturaController::class, 'constancia'])->middleware(['auth'])->name('jefatura.constancia');
Route::post('jefatura/constancia/refrendo', [JefaturaController::class, 'constanciaRefrendo'])->middleware(['auth'])->name('jefatura.constancia.refrendo');

Route::get('jefatura/constancia/ver/{id}', [JefaturaController::class, 'constanciaVer'])->middleware(['auth'])->name('jefatura.constancia.ver');
Route::get('jefatura/constancia/refrendo/ver/{id}', [JefaturaController::class, 'constanciaRefrendoVer'])->middleware(['auth'])->name('jefatura.constancia.ver.refrendo');


Route::get('/jefatura/especialidades/list/{id}', [JefaturaController::class, 'getEspecialidades'])->middleware(['auth'])->name('especialidades.list.jefatura');
Route::delete('/jefatura/especialidades', [JefaturaController::class, 'destroyEspecialidades'])->middleware(['auth'])->name('especialidades.destroy.jefatura');

Route::get('jefatura/perfil/{id}', [JefaturaController::class, 'perfilVer'])->middleware(['auth'])->name('jefatura.perfil.ver');
Route::post('jefatura/perfil/', [JefaturaController::class, 'perfilUpdate'])->middleware(['auth'])->name('jefatura.perfil.update');

/* Fin Rutas Jefatura*/



/* Rutas Supervisor */

Route::get('supervision/empresas', [SupervisorController::class, 'index'])->middleware(['auth'])->name('supervision.index');
Route::get('/supervision/empresas/list', [SupervisorController::class, 'getEmpresas'])->middleware(['auth'])->name('supervision.list');
Route::get('/supervision/refrendos/list', [SupervisorController::class, 'getRefrendos'])->middleware(['auth'])->name('supervision.refrendos.list');

Route::get('supervision/refrendos', [SupervisorController::class, 'indexRefrendos'])->middleware(['auth'])->name('supervision.index.refrendos');

Route::get('supervision/empresas/ver/{id}', [SupervisorController::class, 'ver'])->middleware(['auth'])->name('supervision.ver');
Route::get('supervision/refrendos/ver/{id}', [SupervisorController::class, 'verRefrendos'])->middleware(['auth'])->name('supervision.ver.refrendos');


Route::post('supervision/constancia', [SupervisorController::class, 'constancia'])->middleware(['auth'])->name('supervision.constancia');
Route::post('supervision/constancia/refrendo', [SupervisorController::class, 'constanciaRefrendo'])->middleware(['auth'])->name('supervision.constancia.refrendos');

Route::get('supervision/constancia/ver/{id}', [SupervisorController::class, 'constanciaVer'])->middleware(['auth'])->name('supervision.constancia.ver');
Route::get('supervision/constancia/refrendo/ver/{id}', [SupervisorController::class, 'constanciaRefrendoVer'])->middleware(['auth'])->name('supervision.constancia.ver.refrendo');

Route::get('/supervision/especialidades/list/{id}', [SupervisorController::class, 'getEspecialidades'])->middleware(['auth'])->name('especialidades.list.supervision');
Route::delete('/supervision/especialidades', [SupervisorController::class, 'destroyEspecialidades'])->middleware(['auth'])->name('especialidades.destroy.supervision');

Route::post('supervision/estatus', [SupervisorController::class, 'cambiarEstatus'])->middleware(['auth'])->name('supervision.cambiarEstatus');
Route::post('supervision/refrendos/estatus', [SupervisorController::class, 'cambiarEstatusRefrendo'])->middleware(['auth'])->name('supervision.cambiarEstatus.refrendos');

Route::get('supervision/perfil/{id}', [SupervisorController::class, 'perfilVer'])->middleware(['auth'])->name('supervision.perfil.ver');
Route::post('supervision/perfil/', [SupervisorController::class, 'perfilUpdate'])->middleware(['auth'])->name('supervision.perfil.update');



/* Fin Rutas Supervisor*/


/* Rutas Administracion */

Route::get('administracion/empresas', [AdminEmpresaController::class, 'index'])->middleware(['auth'])->name('empresas.index');
Route::get('/administracion/empresas/list', [AdminEmpresaController::class, 'getEmpresas'])->middleware(['auth'])->name('empresas.list');
Route::get('/administracion/refrendos/list', [AdminEmpresaController::class, 'getRefrendos'])->middleware(['auth'])->name('refrendos.list');


Route::get('administracion/refrendos', [AdminEmpresaController::class, 'indexRefrendos'])->middleware(['auth'])->name('administracion.refrendos.index');

Route::get('administracion/empresas/ver/{id}', [AdminEmpresaController::class, 'ver'])->middleware(['auth'])->name('empresas.ver');

Route::get('administracion/refrendos/ver/{id}', [AdminEmpresaController::class, 'verRefrendos'])->middleware(['auth'])->name('empresas.ver.refrendos');


Route::post('administracion/constancia', [AdminEmpresaController::class, 'constancia'])->middleware(['auth'])->name('administracion.constancia');

Route::post('administracion/constancia/refrendo', [AdminEmpresaController::class, 'constanciaRefrendo'])->middleware(['auth'])->name('administracion.constancia.refrendo');

Route::get('administracion/constancia/ver/{id}', [AdminEmpresaController::class, 'constanciaVer'])->middleware(['auth'])->name('administracion.constancia.ver');

Route::get('/administracion/especialidades/list/{id}', [AdminEmpresaController::class, 'getEspecialidades'])->middleware(['auth'])->name('especialidades.list.administracion');

Route::get('/administracion/refrendos/especialidades/list/{id}', [AdminEmpresaController::class, 'getEspecialidadesRefrendos'])->middleware(['auth'])->name('especialidades.list.administracion.refrendo');

Route::delete('/administracion/especialidades', [AdminEmpresaController::class, 'destroyEspecialidades'])->middleware(['auth'])->name('especialidades.destroy.administracion');



/* Fin Rutas Administracion*/



/* Rutas Empresas */

Route::post('/empresa', [EmpresaController::class, 'enviarARevision'])->middleware(['auth'])->name('empresa.enviar');

Route::get('/empresa/seleccion', [EmpresaController::class, 'seleccion'])->middleware(['auth'])->name('empresa.seleccion');
Route::post('/empresa/seleccion', [EmpresaController::class, 'redirigeSeleccion'])->middleware(['auth'])->name('empresa.seleccionEnviada');

Route::get('/empresa/informativo', [EmpresaController::class, 'informativo'])->middleware(['auth'])->name('empresa.informativo');




Route::get('/empresa/gral', [EmpresaController::class, 'informacionGeneral'])->middleware(['auth'])->name('empresa.general');
Route::post('/empresa/gral', [EmpresaController::class, 'informacionGeneralStore'])->middleware(['auth'])->name('empresa.general.store');
Route::get('/empresa/gral/modificar', [EmpresaController::class, 'informacionGralUpdate'])->middleware(['auth'])->name('empresa.gral.update');
Route::post('/empresa/gralMoral/modificar', [EmpresaController::class, 'gralMoralUpdate'])->middleware(['auth'])->name('empresa.gralMoral.update');
Route::post('/empresa/gralFisica/modificar', [EmpresaController::class, 'gralFisicaUpdate'])->middleware(['auth'])->name('empresa.gralFisica.update');



Route::get('/empresa/legal', [EmpresaController::class, 'informacionLegal'])->middleware(['auth'])->name('empresa.legal');
Route::post('/empresa/legal', [EmpresaController::class, 'informacionLegalStore'])->middleware(['auth'])->name('empresa.legal.store');
Route::get('/empresa/legal/modificar', [EmpresaController::class, 'informacionLegalUpdate'])->middleware(['auth'])->name('empresa.legal.update');
Route::post('/empresa/legal/modificar', [EmpresaController::class, 'legalUpdate'])->middleware(['auth'])->name('empresa.legal.update');



Route::get('/empresa/representante', [EmpresaController::class, 'informacionRepresentante'])->middleware(['auth'])->name('empresa.representante');
Route::post('/empresa/representante', [EmpresaController::class, 'informacionRepresentanteStore'])->middleware(['auth'])->name('empresa.representante.store');
Route::get('/empresa/representante/modificar', [EmpresaController::class, 'informacionRepresentanteUpdate'])->middleware(['auth'])->name('empresa.representante.update');
Route::post('/empresa/representante/modificar', [EmpresaController::class, 'representanteUpdate'])->middleware(['auth'])->name('empresa.representante.update');


Route::get('/empresa/socios', [EmpresaController::class, 'informacionSocios'])->middleware(['auth'])->name('empresa.socios');
Route::post('/empresa/socios', [EmpresaController::class, 'informacionSociosStore'])->middleware(['auth'])->name('empresa.socios.store');
Route::get('/empresa/socios/list', [EmpresaController::class, 'getSocios'])->middleware(['auth'])->name('socios.list');
Route::delete('/empresa/socios', [EmpresaController::class, 'destroySocios'])->middleware(['auth'])->name('socios.destroy');



Route::get('/empresa/especialidades', [EmpresaController::class, 'informacionEspecialidades'])->middleware(['auth'])->name('empresa.especialidades');
Route::post('/empresa/especialidades', [EmpresaController::class, 'informacionEspecialidadesStore'])->middleware(['auth'])->name('empresa.especialidades.store');
Route::get('/empresa/especialidades/list', [EmpresaController::class, 'getEspecialidades'])->middleware(['auth'])->name('especialidades.list');
Route::delete('/empresa/especialidades', [EmpresaController::class, 'destroyEspecialidades'])->middleware(['auth'])->name('especialidades.destroy');


Route::get('/empresa/contable', [EmpresaController::class, 'informacionContable'])->middleware(['auth'])->name('empresa.contable');
Route::post('/empresa/contable', [EmpresaController::class, 'informacionContableStore'])->middleware(['auth'])->name('empresa.contable.store');
Route::get('/empresa/contable/modificar', [EmpresaController::class, 'informacionContableUpdate'])->middleware(['auth'])->name('empresa.contable.update');
Route::post('/empresa/contable/modificar', [EmpresaController::class, 'contableUpdate'])->middleware(['auth'])->name('empresa.contable.update');


Route::get('/empresa/tecnica', [EmpresaController::class, 'informacionTecnica'])->middleware(['auth'])->name('empresa.tecnica');
Route::post('/empresa/tecnica', [EmpresaController::class, 'informacionTecnicaStore'])->middleware(['auth'])->name('empresa.tecnica.store');
Route::get('/empresa/tecnica/modificar', [EmpresaController::class, 'informacionTecnicaUpdate'])->middleware(['auth'])->name('empresa.tecnica.update');
Route::post('/empresa/tecnica/modificar', [EmpresaController::class, 'tecnicaUpdate'])->middleware(['auth'])->name('empresa.tecnica.update');

Route::post('/empresa/refrendo', [RefrendoController::class, 'informacionRefrendoStore'])->middleware(['auth'])->name('empresa.refrendo.store');
Route::get('/empresa/refrendo/modificar', [RefrendoController::class, 'informacionRefrendoUpdate'])->middleware(['auth'])->name('empresa.refrendo.update');
Route::post('/empresa/refrendo/modificar', [RefrendoController::class, 'refrendoUpdate'])->middleware(['auth'])->name('empresa.refrendo.update');
Route::get('/empresa/refrendo/especialidades/list', [RefrendoController::class, 'getEspecialidades'])->middleware(['auth'])->name('especialidades.refrendo.list');
Route::post('/empresa/refrendo/especialidades', [RefrendoController::class, 'informacionEspecialidadesStore'])->middleware(['auth'])->name('empresa.especialidades.refrendo.store');
Route::delete('/empresa/refrendo/especialidades', [RefrendoController::class, 'destroyEspecialidades'])->middleware(['auth'])->name('especialidades.refrendo.destroy');




Route::get('/empresa/constancia/generar', [EmpresaController::class, 'generarPDFConstancia'])->middleware(['auth'])->name('constancia.pdf');

/* Fin Rutas Empresas */


/* Rutas Revisor */

Route::get('/revisor', [RevisorController::class, 'index'])->name('revisor.index');
Route::get('/revisor/seguimiento', [RevisorController::class, 'indexSeguimiento'])->name('revisor.seguimiento.index');

Route::get('/revisor/refrendos', [RevisorController::class, 'indexRefrendos'])->name('revisor.refrendos.index');
Route::get('/revisor/refrendos/seguimiento', [RevisorController::class, 'indexRefrendosSeguimiento'])->name('revisor.refrendos.seguimiento.index');
Route::get('/revisor/refrendos/{id}', [RevisorController::class, 'revisarRefrendo'])->name('revisor.revisar.refrendo');
Route::post('/revisor/refrendos/observaciones', [RevisorController::class, 'observacionesRefrendo'])->name('revisor.refrendo.observaciones');
Route::post('/revisor/refrendos/validar', [RevisorController::class, 'validarRefrendo'])->name('revisor.validar.refrendo');


Route::post('/revisor/validar', [RevisorController::class, 'validar'])->name('revisor.validar');
Route::get('/revisor/{id}', [RevisorController::class, 'revisar'])->name('revisor.revisar');

Route::post('/revisor/observaciones', [RevisorController::class, 'observaciones'])->name('revisor.observaciones');

Route::get('/revisor/empresas/ver/{id}', [RevisorController::class, 'ver'])->middleware(['auth'])->name('revisor.ver');




/* Fin Rutas Revisor */




/* Rutas Contralor */

Route::get('/contralor', [ContralorController::class, 'index'])->name('contralor.index');
Route::post('/contralor/validar', [ContralorController::class, 'validar'])->name('contralor.validar');


Route::get('/contralor/refrendos', [ContralorController::class, 'indexRefrendos'])->name('contralor.refrendos.index');


Route::get('/contralor/refrendos/seguimiento', [ContralorController::class, 'indexRefrendosSeguimiento'])->name('contralor.refrendos.seguimiento.index');
Route::get('/contralor/refrendos/{id}', [ContralorController::class, 'revisarRefrendo'])->name('contralor.revisar.refrendo');
Route::post('/contralor/refrendos/observaciones', [ContralorController::class, 'observacionesRefrendo'])->name('contralor.refrendo.observaciones');
Route::post('/contralor/refrendos/validar', [ContralorController::class, 'validarRefrendo'])->name('contralor.validar.refrendo');

Route::get('/contralor/{id}', [ContralorController::class, 'revisar'])->name('contralor.revisar');

Route::post('/contralor/observaciones', [ContralorController::class, 'observaciones'])->name('contralor.observaciones');

Route::get('/contralor/empresas/ver/{id}', [ContralorController::class, 'ver'])->middleware(['auth'])->name('contralor.ver');

/* Fin Rutas Contralor */





/* Rutas Catalogo Geografico */

Route::post('/api/fetch-municipios', [CatalogoGeograficoController::class, 'fetchMunicipios']);
Route::post('/api/fetch-localidades', [CatalogoGeograficoController::class, 'fetchLocalidades']);


/* Fin Rutas Catalogo Geografico */



Route::get('/correo/prueba', [MainController::class, 'correo']);




/* Rutas de Recursos */

Route::group(["middleware" => "role:Jefatura|Supervisor|Administrador"], function() {
    Route::resource('/preregistros',  PreregistroController::class);
});


Route::group(["middleware" => "role:Jefatura|Supervisor|Administrador"], function() {
        Route::resource('/usuarios', UsuarioController::class);
});



/* Rutas Usuarios */

Route::get('/usuarios', [UsuarioController::class, 'index'])->middleware(['auth'])->name('usuarios.index');

Route::get('/usuarios/list/administracion', [UsuarioController::class, 'getUsuarios'])->middleware(['auth'])->name('administracion.usuarios.list');

Route::get('/usuarios/list/supervision', [UsuarioController::class, 'getUsuariosSupervision'])->middleware(['auth'])->name('supervision.usuarios.list');

Route::get('/usuarios/list/jefatura', [UsuarioController::class, 'getUsuariosJefatura'])->middleware(['auth'])->name('jefatura.usuarios.list');

Route::get('/usuarios/password/{id}/{password}', [UsuarioController::class, 'updatePassword'])->middleware(['auth'])->name('usuarios.updatedPassword');

Route::get('/perfil', [UsuarioController::class, 'perfil'])->middleware(['auth'])->name('perfil');

Route::post('/perfil', [UsuarioController::class, 'updatePerfil'])->middleware(['auth'])->name('updatePerfil');


Route::group(['middleware' => ['role:Jefatura|Supervisor|Administrador']], function () {
    Route::get('/usuarios/status/{id}', [UsuarioController::class, 'desactivar'])->name('desactivarUsuario');
});

/* Fin Rutas Usuarios */

/* Pruebas */

Route::get('/pruebas', [MainController::class, 'prueba'])->middleware(['auth'])->name('prueba');
