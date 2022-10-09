<?php

use Illuminate\Support\Facades\Route;
use Inadores\Autorizador\Http\Controllers\AutorizadorController;

Route::middleware(['auth:sanctum'])->group(function ()
{
    Route::middleware(['autorizador'])->group(function ()
    {
        Route::get('autorizador', [AutorizadorController::class, 'index']);
        Route::get('autorizador/{id}/rol', [AutorizadorController::class, 'mostrarRol']);
        Route::get('autorizador/{id}/usuario', [AutorizadorController::class, 'mostrarUsuario']);
        Route::get('autorizador/rol/lista', [AutorizadorController::class, 'listarRoles']);
        
        Route::post('autorizador/nuevo/rol', [AutorizadorController::class, 'nuevoRol']);
        Route::put('autorizador/{id}/modificar/rol', [AutorizadorController::class, 'modificarRol']);
        Route::delete('autorizador/{id}/eliminar/rol', [AutorizadorController::class, 'eliminarRol']);

        Route::post('autorizador/accion/rol', [AutorizadorController::class, 'autorizarRol']);
        Route::delete('autorizador/accion/rol', [AutorizadorController::class, 'desautorizarRol']);

        Route::post('autorizador/asignar/rol', [AutorizadorController::class, 'asignarRol']);
        Route::delete('autorizador/asignar/rol', [AutorizadorController::class, 'denegarRol']);

        Route::post('autorizador/{id}/accion', [AutorizadorController::class, 'asignarAccion']);
        Route::delete('autorizador/{id}/accion', [AutorizadorController::class, 'denegarAccion']);

        Route::delete('autorizador/{id}/resetear/usuario', [AutorizadorController::class, 'resetearUsuario']);
        Route::delete('autorizador/{id}/resetear/rol', [AutorizadorController::class, 'resetearRol']);
    });
});