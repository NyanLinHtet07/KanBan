<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\RoleAndPermissions\RoleController;
use App\Http\Controllers\API\RoleAndPermissions\PermissionController;
use App\Http\Controllers\API\Auth\AuthController;
use App\Http\Controllers\API\KanBan\DataController;


Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::prefix('auth')->group(function () {
    Route::post('register', [AuthController::class, 'register']);
    Route::post('login', [AuthController::class, 'login']);
    Route::post('logout', [AuthController::class, 'logout']);
    Route::get('user', [AuthController::class, 'user']);
    Route::get('users', [AuthController::class, 'users']);
});

Route::resource('roles', RoleController::class);

Route::resource('permissions', PermissionController::class);

Route::resource('datas', DataController::class);