<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\Api\ProductApiController;
use App\Http\Controllers\Api\OrderApiController;


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


Route::get('/products', [ProductController::class, 'index']); // Listar productos
Route::post('/products', [ProductController::class, 'store']); // Crear un nuevo producto


Route::get('/orders', [OrderController::class, 'index']); // Listar pedidos
Route::post('/orders', [OrderController::class, 'store']); // Crear un nuevo pedido




Route::apiResource('products', ProductApiController::class);
Route::apiResource('orders', OrderApiController::class);

