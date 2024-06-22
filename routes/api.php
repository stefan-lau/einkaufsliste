<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ItemController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::get('/items', [ItemController::class, 'index']);

Route::get('/items/all', [ItemController::class, 'indexAll']);


Route::prefix('/item')->group( function() {

    Route::post('/store', [ItemController::class, 'store']);
    Route::put('/{id}', [ItemController::class, 'update']);

});
