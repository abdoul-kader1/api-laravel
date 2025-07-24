<?php

use App\Http\Controllers\ClientController;
use Illuminate\Support\Facades\Route;

//Route::apiRessource('clients',ClientController::class);

Route::post('clients/create',[ClientController::class,'store']);