<?php

use App\Http\Controllers\BatchesController;
use App\Http\Controllers\DataController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/', function (Request $request) {
    return response()->json(['sucess' => true], 200);
});

Route::prefix('data')->group(function () {
    Route::post('/', [DataController::class, 'upload']);
});

Route::prefix('batches')->group(function () {
    Route::get('/', [BatchesController::class, 'index']);
});
