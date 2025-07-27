<?php

use App\Http\Controllers\ClientController; // Assure-toi que cette ligne est présente
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// Route de test par défaut ajoutée par Sanctum, souvent sous 'auth:sanctum'
Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// Tes routes de ressources pour le client
Route::post('clients/create', [ClientController::class,"store"]);
Route::get('clients/liste', [ClientController::class,"index"]);
Route::get('clients/{id}', [ClientController::class,"show"]);
Route::put('clients/{id}/update',[ClientController::class,"update"]);
Route::delete("clients/{id}/delete",[ClientController::class,"destroy"]);