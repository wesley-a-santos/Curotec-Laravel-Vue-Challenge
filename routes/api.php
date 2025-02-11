<?php

use App\Http\Controllers\Api\V1\GenderController;
use App\Http\Controllers\Api\V1\RoleController;
use App\Http\Controllers\Api\V1\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


Route::middleware('auth:sanctum')->prefix('v1')->group(function () {
    Route::get('/roles', [RoleController::class, 'index']);

    Route::get('/genders', [GenderController::class, 'index']);

    Route::apiResource('/users', UserController::class);
});
