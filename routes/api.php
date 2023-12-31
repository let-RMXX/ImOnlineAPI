<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\api\UserInfoController;

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

Route::get('usersinfo', [UserInfoController::class, 'index']);
Route::post('usersinfo', [UserInfoController::class, 'store']);
Route::get('usersinfo/{id}', [UserInfoController::class,'show']);
Route::get('usersinfo/{id}/edit', [UserInfoController::class,'edit']);
Route::put('usersinfo/{id}/update', [UserInfoController::class,'update']);
Route::delete('usersinfo/{id}/delete', [UserInfoController::class,'destroy']);