<?php

use App\Http\Controllers\Api\V1\AuthenticationController;
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

Route::middleware('auth:sanctum')->get('/v1/user', function (Request $request) {
    return response()->json([
        'message' => $request->user(),
    ]);
});

Route::middleware('auth:sanctum')->get('/v1/logout', [AuthenticationController::class, 'logout']);


Route::post('/v1/register', [AuthenticationController::class, 'store']);
Route::post('/v1/login', [AuthenticationController::class, 'show']);
