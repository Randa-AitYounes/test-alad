<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EmployeController;
use App\Http\Controllers\DemandeCongeController;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
// ajouter un employe
Route::post('/employes', [EmployeController::class, 'ajouterEmploye']);

// liste des employe d'un manager
Route::get('/managers/{id_manager}/employes', [EmployeController::class, 'listeEmployes']);


// faire une demande de congé
Route::post('/employes/{id_employe}/demande-conges', [DemandeCongeController::class, 'ajouterDemande']);

// liste des demandes de congé d'un employe
Route::get('/employes/{idEmploye}/demande-conges', [DemandeCongeController::class, 'listeDemandeParEmploye']);

// mettre a jour statut
Route::put('/employes/{id_employe}/demande-conges/{id_demande}', [DemandeCongeController::class, 'mettreAJourStatut']);

// lister des demandes de congé d'un manager pour ses employés uniquement)
Route::get('/managers/{idManager}/demande-conges', [DemandeCongeController::class, 'listeDemandeParManager']);

