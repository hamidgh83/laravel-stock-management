<?php

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

Route::prefix('/client')
    ->namespace('Stock\Controllers')
    ->as('client.')
    ->group(function () {
        // Route::post('/', CreateClientController::class)->name('create');
        Route::get('/', GetClientsController::class)->name('list');
        Route::get('/{client}/stocks', GetClientStocksController::class)->name('list-stocks');
    });

Route::prefix('/stock')
    ->namespace('Stock\Controllers')
    ->as('stock.')
    ->group(function () {
        Route::get('/', GetStocksController::class)->name('list');
    });
