<?php

use App\Http\Controllers\AbonnementController;
use App\Http\Controllers\CarteController;
use App\Http\Controllers\ClientController; // Assure-toi que cette ligne est présente
use App\Http\Controllers\FormuleController;
use App\Models\Abonnement;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// Route de test par défaut ajoutée par Sanctum, souvent sous 'auth:sanctum'
Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// routes de ressources pour le client
Route::post('clients/create', [ClientController::class,"store"]);
Route::get('clients/liste', [ClientController::class,"index"]);
Route::get('clients/{id}', [ClientController::class,"show"]);
Route::put('clients/{id}/update',[ClientController::class,"update"]);
Route::delete("clients/{id}/delete",[ClientController::class,"destroy"]);

// routes de ressources pour la formule
Route::post('formules/create', [FormuleController::class,"store"]);
Route::get('formules/liste', [FormuleController::class,"index"]);
Route::get('formules/{id}', [FormuleController::class,"show"]);
Route::put('formules/{id}/update',[FormuleController::class,"update"]);
Route::delete("formules/{id}/delete",[FormuleController::class,"destroy"]);

// routes de ressources pour la carte
Route::post('carte/create/client/{id}', [CarteController::class,"store"]);
Route::get("carte/liste",[CarteController::class,"index"]);
Route::put("carte/{idCarte}/client/{idClient}/update",[CarteController::class,"update"]);
Route::get("carte/client/{idClient}/liste",[CarteController::class,"show"]);

// routes de ressources pour l'abonnement
Route::post('abonnements/create', [AbonnementController::class,"store"]);
Route::get('abonnements/{id}/isExpire', [AbonnementController::class,"verifieAbonnementClient"]);