<?php

use Illuminate\Support\Str;

Breadcrumbs::for('inicio', function ($trail) {
    $trail->push('Inicio', url('/'));
});
// Administración
Breadcrumbs::for('home', function ($trail) {
    $trail->push('Inicio', route('home'));
});
// Mi perfil
Breadcrumbs::for('miPerfil', function ($trail) {
    $trail->parent('home');
    $trail->push('Mi perfil', route('miPerfil'));
});


// soporte
Breadcrumbs::for('soporte', function ($trail) {
    $trail->parent('home');
    $trail->push('Soporte', route('soporte'));
});
// terminos  y condiciones
Breadcrumbs::for('terminosCondiciones', function ($trail) {
    $trail->parent('login');
    $trail->push('Términos y condiciones', route('terminosCondiciones'));
});

Breadcrumbs::for('login', function ($trail) {
    $trail->parent('inicio');
    $trail->push('Ingresar al sistema', route('login'));
});
Breadcrumbs::for('restablecerPassword', function ($trail) {
    $trail->parent('login');
    $trail->push('Restablecer contraseña', url('password/reset'));
});

/*autor:Fabian Lopez
descripcion: Breadcrumbs para modelos prograaticos*/
Breadcrumbs::for('modelosProgramaticos', function ($trail) {
	$trail->parent('home');
    $trail->push('Modelos programáticos', route('modelos'));
});
Breadcrumbs::for('nuevoModeloProgramatico', function ($trail) {	
	$trail->parent('modelosProgramaticos');
    $trail->push('Nuevo Modelo P.', route('nuevo-modelo'));
});
Breadcrumbs::for('editarModeloProgramatico', function ($trail,$modelo) {	
	$trail->parent('modelosProgramaticos');
    $trail->push('Actualizar Modelo P. '. $modelo->nombre, route('editar-modelo',$modelo->id));
});

Breadcrumbs::for('importarModelo', function ($trail) {    
    $trail->parent('modelosProgramaticos');
    $trail->push('Importar Modelos P. ', route('modelos'));
});

Breadcrumbs::for('importarActividad', function ($trail) {    
    $trail->parent('modelosProgramaticos');
    $trail->push('Importar Actividades ', route('modelos'));
});
Breadcrumbs::for('importarModulo', function ($trail) {    
    $trail->parent('modelosProgramaticos');
    $trail->push('Importar Módulos ', route('modelos'));
});
/*autor:Fabian Lopez
descripcion: Breadcrumbs para las actividades*/
Breadcrumbs::for('actividades', function ($trail,$modelo) {	
	$trail->parent('modelosProgramaticos');
    $trail->push('Actividad modelo '. $modelo->codigo, route('actividades',$modelo->id));
});
Breadcrumbs::for('nuevaActividades', function ($trail,$modelo) {	
	$trail->parent('actividades',$modelo);
    $trail->push('Nueva actividad '. $modelo->codigo, route('actividades',$modelo->id));
});

Breadcrumbs::for('editarActividades', function ($trail,$actividad) {	
	$trail->parent('actividades',$actividad->modeloProgramatico);
    $trail->push('Actualizar actividad '. $actividad->modeloProgramatico->codigo.''.$actividad->codigo, route('actividades',$actividad->id));
});
/*autor:Fabian Lopez
descripcion: Breadcrumbs para los modulos*/
Breadcrumbs::for('modulos', function ($trail,$modelo) { 
    $trail->parent('modelosProgramaticos');
    $trail->push('Módulos de '. $modelo->nombre, route('modulos',$modelo->id));
});
Breadcrumbs::for('nuevModulo', function ($trail,$modelo) {    
    $trail->parent('modulos',$modelo);
    $trail->push('Nuevo módulo de '. $modelo->nombre, route('modulos',$modelo->id));
});

Breadcrumbs::for('editarModulo', function ($trail,$modulo) {    
    $trail->parent('modulos',$modulo->modeloProgramatico);
    $trail->push('Actualizar módulo '. $modulo->modeloProgramatico->codigo.''.$modulo->codigo, route('modulos',$modulo->id));
});


/*autor:Fabian Lopez
descripcion: Breadcrumbs para tipos de participante*/
Breadcrumbs::for('tiposParticipante', function ($trail) {
    $trail->parent('home');
    $trail->push('Tipos de participantes', route('tipos-participante'));
});
Breadcrumbs::for('nuevoTipoParticipante', function ($trail) {
    $trail->parent('tiposParticipante');
    $trail->push('Nuevo tipo de participantes', route('nuevoTipoParticipante'));
});
Breadcrumbs::for('EditarParticipante', function ($trail,$tipoParticipante) {
    $trail->parent('tiposParticipante');
    $trail->push('Actualizar Tipo.P '.$tipoParticipante->nombre, route('editar-participante',$tipoParticipante->id));
});
/*autor:Fabian Lopez
descripcion: Breadcrumbs para Cuentas contables*/
Breadcrumbs::for('cuentaContables', function ($trail) {
    $trail->parent('home');
    $trail->push('Cuentas contables', route('cuentas-contables'));
});
Breadcrumbs::for('nuevoCuentaContable', function ($trail) {
    $trail->parent('cuentaContables');
    $trail->push('Nueva cuenta contable', route('nuevoCuentaContable'));
});
Breadcrumbs::for('EditarcuentaContable', function ($trail,$cuentaContable) {
    $trail->parent('cuentaContables');
    $trail->push('Actualizar cuenta contable', route('editar-cuenta',$cuentaContable->id));
});

/*autor:Fabian Lopez
descripcion: Breadcrumbs para materiales*/
Breadcrumbs::for('materiales', function ($trail) {
    $trail->parent('cuentaContables');
    $trail->push('Materiales', route('materiales'));
});
Breadcrumbs::for('nuevoMaterial', function ($trail) {
    $trail->parent('materiales');
    $trail->push('Nuevo material', route('nuevo-material'));
});
Breadcrumbs::for('Editarmaterial', function ($trail,$material) {
    $trail->parent('materiales');
    $trail->push('Actualizar material', route('editar-material',$material->id));
});

Breadcrumbs::for('importarMaterial', function ($trail) {
    $trail->parent('materiales');
    $trail->push('Importar material', route('importar-material'));
});
/*autor:Fabian Lopez
descripcion: Breadcrumbs para los niños*/
Breadcrumbs::for('ninios', function ($trail) {
    $trail->parent('home');
    $trail->push('Participantes registrados', route('ninios'));
});

Breadcrumbs::for('niniosInformacion', function ($trail,$ninio) {
    $trail->parent('ninios');
    $trail->push('Información de '.$ninio->nombres, route('ninios',$ninio->id));
});

Breadcrumbs::for('nuevoNinioAfiliado', function ($trail,$tipoParticipante) {
    $trail->parent('ninios');
    $trail->push('Nuevo participante '.$tipoParticipante->nombres, route('nuevo-ninio',$tipoParticipante->id));
});

Breadcrumbs::for('editarNinio', function ($trail,$ninio) {
    $trail->parent('ninios');
    $trail->push('Actualizar '.$ninio->nombres, route('editar-ninio',$ninio->id));
});
Breadcrumbs::for('subirNinio', function ($trail) {
    $trail->parent('ninios');
    $trail->push('Subir participantes', route('subir-ninios'));
});
Breadcrumbs::for('qrsNinioPdfDescargar', function ($trail) {
    $trail->parent('ninios');
    $trail->push('Descargar qrs', route('qrsNinioPdfDescargar'));
});
Breadcrumbs::for('buzonNinio', function ($trail,$ninio) {
    $trail->parent('ninios');
    $trail->push('Buzón de '.$ninio->nombres, route('buzonNinio',$ninio->id));
});

// A: Deivid
// D: breadcrums para mis partcipantes de gestores en la comunidades pertenecientes y familiares
Breadcrumbs::for('misParticipantes', function ($trail) {
    $trail->parent('home');
    $trail->push('Mis participantes registrados', route('misParticipantes'));
});
Breadcrumbs::for('nuevoMiParticipante', function ($trail,$tipoParticipante) {
    $trail->parent('misParticipantes');
    $trail->push('Nuvo participante '.$tipoParticipante->nombres, route('nuevoMiParticipante',$tipoParticipante->id));
});
Breadcrumbs::for('editarMiParticipante', function ($trail,$ninio) {
    $trail->parent('misParticipantes');
    $trail->push('Actualizar '.$ninio->nombres, route('editarMiParticipante',$ninio->id));
});
Breadcrumbs::for('informacionMiParticipante', function ($trail,$ninio) {
    $trail->parent('misParticipantes');
    $trail->push('Información de '.$ninio->nombres, route('informacionMiParticipante',$ninio->id));
});
Breadcrumbs::for('familiaMiParticipante', function ($trail,$ninio) {
    $trail->parent('misParticipantes');
    $trail->push('Familiares de '.$ninio->nombres, route('familiaMiParticipante',$ninio->id));
});
Breadcrumbs::for('buzonMisPartticipante', function ($trail,$ninio) {
    $trail->parent('misParticipantes');
    $trail->push('Buzón de '.$ninio->nombres, route('buzonMiParticipante',$ninio->id));
});
Breadcrumbs::for('crearBuzonMisPartticipante', function ($trail,$ninio) {
    $trail->parent('buzonMisPartticipante',$ninio);
    $trail->push('Crear cartas de '.$ninio->nombres, route('buzonMiParticipante',$ninio->id));
});
//A:Fabian Lopez 

/*autor:Fabian Lopez
descripcion: Breadcrumbs para la famila de los niños*/
Breadcrumbs::for('familiaNinios', function ($trail,$ninio) {
    $trail->parent('ninios');
    $trail->push('Familiares', route('familia',$ninio->id));
});
//A:Deivid
//D:Breadcrums de roles y permisos
Breadcrumbs::for('roles', function ($trail) {
    $trail->parent('home');
    $trail->push('Roles', route('roles'));
});
Breadcrumbs::for('permisos', function ($trail,$rol) {
    $trail->parent('roles');
    $trail->push('Permisos', route('permisos',$rol->id));
});

/*autor:Fabian Lopez
descripcion: Breadcrumbs para tipos las planicacion*/
Breadcrumbs::for('planificaciones', function ($trail) {
    $trail->parent('home');
    $trail->push('Planificaciones', route('planificaciones'));
});
Breadcrumbs::for('nuevaPlanificacion', function ($trail) {
    $trail->parent('planificaciones');
    $trail->push('Nueva Planificación', route('nueva-planificacion'));
});

Breadcrumbs::for('editarPlanificacion', function ($trail,$planificacion) {
    $trail->parent('planificaciones');
    $trail->push('Actualizar Planificación', route('editar-planificacion',$planificacion->id));
});

Breadcrumbs::for('planificacionesActas', function ($trail,$planificacion) {
    $trail->parent('planificaciones');
    $trail->push('Actividades con materiales', route('materiales-planificacion',$planificacion->id));
});

Breadcrumbs::for('Actas', function ($trail,$poaCuentaContableMes) {
    $trail->parent('planificacionesActas',$poaCuentaContableMes->cuentaContablePoaCuenta->poaContable->poa->planificacionModelo->planificacion);
    $trail->push('Actas Entrega Recepci{on ', route('materiales-planificacion',$poaCuentaContableMes->id));
});
Breadcrumbs::for('planificacionesExportar', function ($trail,$planificacion) {
    $trail->parent('planificaciones');
    $trail->push('Consulta por fechas', route('vistaExportarExcelFechas',$planificacion->id));
});
Breadcrumbs::for('planificacionesEliminarAsis', function ($trail,$planificacion) {
    $trail->parent('planificaciones');
    $trail->push('Eliminar Asistencias', route('listadoSinParticipacion',$planificacion->id));
});
/*autor:Fabian Lopez
descripcion: Breadcrumbs para planicacion asignar modelos programaticios*/
Breadcrumbs::for('planificaionModelos', function ($trail,$planificacion) {
    $trail->parent('planificaciones');
    $trail->push('Planificación de M.P ', route('planificaciones-modelo',$planificacion->id));
});

// A:Deivid
// D:actividades en poa
Breadcrumbs::for('armarPoa', function ($trail,$planificacionModelo) {
    $trail->parent('planificaionModelos',$planificacionModelo->planificacion);
    $trail->push('Actividades de M.P en '.Str::limit($planificacionModelo->modeloProgramatico->nombre,20,'..'), route('armarPoa',$planificacionModelo->id));
});

Breadcrumbs::for('nuevoPoaItem', function ($trail,$planificacionModelo) {
    $trail->parent('armarPoa',$planificacionModelo);
    $trail->push('Nueva actividad', route('nuevoPoaItem',$planificacionModelo->id));
});
Breadcrumbs::for('editarPoa', function ($trail,$poa) {
    $trail->parent('armarPoa',$poa->planificacionModelo);
    $trail->push('Actualizar actividad', route('editarPoa',$poa->id));
});

Breadcrumbs::for('poaActividad', function ($trail,$poa) {
    $trail->parent('armarPoa',$poa->planificacionModelo);
    $trail->push('N° de actividades en '.Str::limit($poa->actividad->nombre, 20,'..'), route('poaActividad',$poa->id));
});

Breadcrumbs::for('poaParticipantes', function ($trail,$poa) {
    $trail->parent('armarPoa',$poa->planificacionModelo);
    $trail->push('Participantes en '.Str::limit($poa->actividad->nombre, 20,'..'), route('poaParticipantes',$poa->id));
});

Breadcrumbs::for('poaCuentaContable', function ($trail,$poa) {
    $trail->parent('armarPoa',$poa->planificacionModelo);
    $trail->push('Cuenta contable'.Str::limit($poa->actividad->nombre, 10,'..'), route('poaCuentaContable',$poa->id));
});

Breadcrumbs::for('reportePoa', function ($trail,$comunidad) {
    $trail->parent('armarPoa',$comunidad->poaParticipante->poa->planificacionModelo);
    $trail->push('Reporte de '.Str::limit($comunidad->comunidad->nombre,20,'..'), route('reportesVista-poa',$comunidad->id));
});
//A:Deivid
//D:Breadcrums de usuarios
Breadcrumbs::for('usuarios', function ($trail) {
    $trail->parent('home');
    $trail->push('G. de Usuarios', route('usuarios'));
});
Breadcrumbs::for('usuariosNuevo', function ($trail) {
    $trail->parent('usuarios');
    $trail->push('Nuevo usuario', route('usuariosNuevo'));
});
Breadcrumbs::for('informacionUsuario', function ($trail,$user) {
    $trail->parent('usuarios');
    $trail->push('Información de usuario', route('informacionUsuario',$user->id));
});
Breadcrumbs::for('editarUsuario', function ($trail,$user) {
    $trail->parent('usuarios');
    $trail->push('Actualizar usuario', route('editarUsuario',$user->id));
});
Breadcrumbs::for('editarRolUsuario', function ($trail,$user) {
    $trail->parent('usuarios');
    $trail->push('Roles de usuario', route('editarRolUsuario',$user->id));
});
Breadcrumbs::for('usuariosImportar', function ($trail) {
    $trail->parent('usuarios');
    $trail->push('Importar usuarios', route('usuariosImportar'));
});

// coordinadores
Breadcrumbs::for('coordinadores', function ($trail) {
    $trail->parent('home');
    $trail->push('Coordinadores', route('coordinadores'));
});
Breadcrumbs::for('coordinadoresNuevo', function ($trail) {
    $trail->parent('coordinadores');
    $trail->push('Nuevo coordinador', route('coordinadoresNuevo'));
});
Breadcrumbs::for('coordinadoresAsignarProvincia', function ($trail,$user) {
    $trail->parent('coordinadores');
    $trail->push('Asignar provincia', route('coordinadoresAsignarProvincia',$user->id));
});
Breadcrumbs::for('editarCoordinador', function ($trail,$user) {
    $trail->parent('coordinadores');
    $trail->push('Actualizar coordinador', route('editarCoordinador',$user->id));
});
// getores
Breadcrumbs::for('gestores', function ($trail) {
    $trail->parent('home');
    $trail->push('Gestores', route('gestores'));
});
Breadcrumbs::for('gestoresNuevo', function ($trail) {
    $trail->parent('gestores');
    $trail->push('Nuevo gestor', route('gestoresNuevo'));
});
Breadcrumbs::for('editarGestor', function ($trail,$usuario) {
    $trail->parent('gestores');
    $trail->push('Actualizar gestor', route('editarGestor',$usuario->id));
});
// participantes
Breadcrumbs::for('participantes', function ($trail) {
    $trail->parent('home');
    $trail->push('Personal SL.', route('participantes'));
});
Breadcrumbs::for('participanteNuevoAsignacion', function ($trail,$usuario) {
    $trail->parent('participantes');
    $trail->push('Asignar comunidades', route('participanteNuevoAsignacion',$usuario->id));
});



Breadcrumbs::for('manuales', function ($trail) {
    $trail->parent('home');
    $trail->push('Manuales', route('manuales'));
});





// A:Deivid
// D:Breadcrums de localidades
Breadcrumbs::for('provincias', function ($trail) {
    $trail->parent('home');
    $trail->push('Provincias', route('provincias'));
});
Breadcrumbs::for('nuevaProvincia', function ($trail) {
    $trail->parent('provincias');
    $trail->push('Nueva provincia', route('nuevaProvincia'));
});

Breadcrumbs::for('editarProvincia', function ($trail,$provincia) {
    $trail->parent('provincias');
    $trail->push('Actualizar provincia', route('editarProvincia',$provincia->id));
});

// cantones
Breadcrumbs::for('cantones', function ($trail) {
    $trail->parent('home');
    $trail->push('Cantones', route('cantones'));
});
Breadcrumbs::for('nuevoCanton', function ($trail) {
    $trail->parent('cantones');
    $trail->push('Nuevo Cantón', route('nuevoCanton'));
});
Breadcrumbs::for('editarCanton', function ($trail,$canton) {
    $trail->parent('cantones');
    $trail->push('Actualizar cantón', route('editarCanton',$canton->id));
});

// cantones
// en provincia
Breadcrumbs::for('cantonesEnProvincia', function ($trail,$provincia) {
    $trail->parent('provincias');
    $trail->push('Cantones en provincia '.$provincia->nombre, route('cantonesEnProvincia',$provincia->id));
});
Breadcrumbs::for('editarCantonEnProvincia', function ($trail,$canton) {
    $trail->parent('cantonesEnProvincia',$canton->provincia);
    $trail->push('Actualizar cantón', route('editarCantonEnProvincia',$canton->id));
});

// comunidaes en canton provincia
Breadcrumbs::for('coomunidadesEnCanton', function ($trail,$canton) {
    $trail->parent('cantonesEnProvincia',$canton->provincia);
    $trail->push('Comunidades en cantón '.$canton->nombre, route('coomunidadesEnCanton',$canton->id));
});
Breadcrumbs::for('editarComunidadEnCanton', function ($trail,$comunidad) {
    $trail->parent('coomunidadesEnCanton',$comunidad->canton);
    $trail->push('Actualizar comunidad ', route('editarComunidadEnCanton',$comunidad->id));
});

// solo en comunidades
Breadcrumbs::for('comunidadesSoloCanton', function ($trail,$canton) {
    $trail->parent('cantones',$canton->provincia);
    $trail->push('Comunidades en cantón '.$canton->nombre, route('comunidadesSoloCanton',$canton->id));
});
Breadcrumbs::for('editarComunidadEnCantonSolo', function ($trail,$comunidad) {
    $trail->parent('comunidadesSoloCanton',$comunidad->canton);
    $trail->push('Actualizar comunidad ', route('editarComunidadEnCantonSolo',$comunidad->id));
});

// comunidaes

Breadcrumbs::for('comunidades', function ($trail) {
    $trail->parent('home');
    $trail->push('Comunidades', route('comunidades'));
});
Breadcrumbs::for('editarComunidad', function ($trail,$comunidad) {
    $trail->parent('comunidades');
    $trail->push('Editar comunidad', route('editarComunidad',$comunidad->id));
});
Breadcrumbs::for('importarComunidades', function ($trail) {
    $trail->parent('comunidades');
    $trail->push('Importar comunidades', route('importarComunidades'));
});
Breadcrumbs::for('nuevaComunidad', function ($trail) {
    $trail->parent('comunidades');
    $trail->push('Nueva comunidad', route('nuevaComunidad'));
});



// A:deivid
// D:breadcrums para regisrto de asistencias a actividades
Breadcrumbs::for('asistencia', function ($trail) {
    $trail->parent('home');
    $trail->push('Listado de actividades', route('asistencia'));
});
Breadcrumbs::for('asistencias', function ($trail,$comuPoaParticipante) {
    $trail->parent('asistencia');
    $trail->push('Listado de asistencias a actividades', route('asistencias',$comuPoaParticipante->id));
});
Breadcrumbs::for('registrarAsistencia', function ($trail,$asistencia) {
    $trail->parent('asistencias',$asistencia->comunidadPoaParticipante);
    $trail->push('Registro asistencias a actividades', route('registrarAsistencia',$asistencia));
});


Breadcrumbs::for('misActas', function ($trail,$acta) {
    $trail->parent('asistencia');
    $trail->push('Mi acta', route('mi-actas',$acta->id));
});



// A:deivid
// D: gestion de archivos
Breadcrumbs::for('misArchivos', function ($trail) {
    $trail->parent('home');
    $trail->push('Mis archivos', route('misArchivos'));
});

Breadcrumbs::for('nuevoArchivo', function ($trail) {
    $trail->parent('misArchivos');
    $trail->push('Nuevo archivo', route('nuevoArchivo'));
});

Breadcrumbs::for('listadoArchivo', function ($trail) {
    $trail->parent('misArchivos');
    $trail->push('Listado de archivos', route('listadoArchivo'));
});
Breadcrumbs::for('editarArchivo', function ($trail,$archivo) {
    $trail->parent('listadoArchivo');
    $trail->push('Actualizar archivo', route('editarArchivo',$archivo->id));
});
