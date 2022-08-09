<?php

use App\Http\Controllers\Controller;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\IndikatorController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\TargetCapaianController;
use App\Http\Controllers\TargetController;
use App\Http\Controllers\TujuanController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;


Route::get('login', [LoginController::class, 'index'])->name('login');
Route::post('authenticate', [LoginController::class, 'authenticate'])->name('authenticate');
Route::get('logout', [LoginController::class, 'logout'])->name('logout');

Route::middleware(['auth'])->group(function () {
    Route::get('/', [HomeController::class, 'index']);

    Route::resource('target_capaian', TargetCapaianController::class);

    Route::resource('indikator', IndikatorController::class);
    Route::get('/get_target', [IndikatorController::class, 'get_target']);
    Route::get('/get_indikator', [IndikatorController::class, 'get_indikator']);

    Route::get('target', [TargetController::class, 'index']);
    Route::get('target/create', [TargetController::class, 'create']);
    Route::post('target/store', [TargetController::class, 'store']);
    Route::get('target/{id}', [TargetController::class, 'show']);
    Route::post('target/update', [TargetController::class, 'update']);
    Route::post('target/delete', [TargetController::class, 'delete']);

    Route::get('tujuan', [TujuanController::class, 'index']);
    Route::get('tujuan/{id}', [TujuanController::class, 'show']);
    Route::post('tujuan/{id}', [TujuanController::class, 'update']);

    Route::get('users', [UserController::class, 'index']);
    Route::get('users/create', [UserController::class, 'create']);
    Route::post('users/store', [UserController::class, 'store']);
    Route::get('users/{id}', [UserController::class, 'show']);
    Route::post('users/update', [UserController::class, 'update']);
    Route::post('users/delete', [UserController::class, 'delete']);

    Route::post('/users/roles', [UserController::class, 'user_roles']);
    Route::post('/users/ubahpassword', [UserController::class, 'ubahpassword']);

    Route::get('roles', [UserController::class, 'roles']);
    Route::post('roles/add', [UserController::class, 'roles_add']);
    Route::post('roles/edit', [UserController::class, 'roles_edit']);
    Route::post('roles/delete', [UserController::class, 'roles_delete']);

    Route::get('permissions', [UserController::class, 'permissions']);
    Route::post('permissions/add', [UserController::class, 'permissions_add']);
    Route::post('permissions/delete', [UserController::class, 'permissions_delete']);
});
