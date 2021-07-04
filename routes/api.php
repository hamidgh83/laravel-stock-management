<?php

use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::fallback(function(){
    throw new HttpResponseException(response()->json([
        'message' => 'Page not found',
    ], Response::HTTP_NOT_FOUND));
});

Route::prefix('/client')
    ->namespace('Stock\Controllers')
    ->as('client.')
    ->group(function () {
        Route::post('/', CreateClientController::class)->name('create');
        Route::post('/{client}/stock/{stock}', CreateClientStockController::class)->name('purchase-stock');
        Route::get('/', GetClientsController::class)->name('list');
        Route::get('/{client}/stocks', GetClientStocksController::class)->name('list-stocks');
    });

Route::prefix('/stock')
    ->namespace('Stock\Controllers')
    ->as('stock.')
    ->group(function () {
        Route::post('/', CreateStockController::class)->name('create');
        Route::put('/{stock}', UpdateStockController::class)->name('update');
        Route::get('/', GetStocksController::class)->name('list');
    });
