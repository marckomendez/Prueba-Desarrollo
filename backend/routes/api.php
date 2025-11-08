<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PastelController;
use App\Http\Controllers\IngredienteController;

Route::middleware('api')->group(function () {
    Route::apiResource('pasteles', PastelController::class);
    Route::apiResource('ingredientes', IngredienteController::class);
});
