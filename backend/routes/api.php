<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;


use Illuminate\Support\Facades\Auth;
use App\Http\controllers\forgetpassword;
use App\Http\Middleware\VerifierEmailEtBouton;
use App\Http\controllers\resetpassword;
use App\Http\Controllers\EnfantController;
use App\Http\Controllers\testeController;
use App\Http\Controllers\Demandeenffant;
use App\Http\Controllers\MailController;
use App\Http\Controllers\OblierController;




use App\Http\Controllers\admin\ActiviteController;
use App\Http\Controllers\admin\OffreController;
use App\Http\Controllers\admin\AnimateurController;
use App\Http\Controllers\admin\PackController;
use App\Http\Controllers\admin\DemandeController;
use App\Http\Controllers\admin\FactureController;


use App\Http\Controllers\parent\DemandeenfantController;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. Thesegit 
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->group(function () {


 
 /**
  ** animateur routes
  */
 Route::get('/admin/animateurs', [AnimateurController::class, 'index']);
 Route::get('/admin/animateurs/{id}', [AnimateurController::class, 'show']);
 Route::put('/admin/animateurs/{id}', [AnimateurController::class, 'update']);
 Route::delete('/admin/animateurs/{id}', [AnimateurController::class, 'destroy']);
 Route::post('/admin/animateurs/{activiteId}', [AnimateurController::class, 'affecter']);
 
 
 
  /** demande routes
  */
 
 Route::get('/demandes', [DemandeController::class, 'demandes']);
 Route::get('/demandes-a-traiter', [DemandeController::class, 'demandesAtraiter']);
 Route::get('/demandes/{id}', [DemandeController::class, 'show']);
 Route::get('/demandes-acceptees', [DemandeController::class, 'demandeAcceptees']);
 Route::get('/demandes-refusees', [DemandeController::class, 'demandeRefusees']);
 Route::put('/demandes/{id}/accepter', [DemandeController::class, 'accepterDemande']);
 Route::put('/demandes/{id}/refuser', [DemandeController::class, 'refuserDemande']);
 /**
  ** facture routes
  */
 Route::get('/factures', [FactureController::class, 'indexFactures']);
 Route::get('/factures/{id}', [FactureController::class, 'getFacture']);
 Route::get('/factures/a-payer', [FactureController::class, 'facturesAPayer']);
 Route::get('/factures-payees', [FactureController::class, 'facturesPayees']);
 Route::get('/factures-non-payees', [FactureController::class, 'facturesNonPayees']);
 Route::get('/factures-archivees', [FactureController::class, 'facturesArchivees']);
 Route::put('/factures/{id}/Marquer-Payees', [FactureController::class, 'MarquerPayees']);
 Route::put('/factures/{id}/Marquer-Non-Payees', [FactureController::class, 'MarquerNonPayees']);
 /**
  ** pack routes
  */
 Route::get('/packs', [PackController::class, 'index']);
 Route::get('/packs/{id}', [PackController::class, 'show']);
 Route::post('/packs', [PackController::class, 'store']);
 Route::put('/packs/{id}', [PackController::class, 'update']);
 Route::delete('/packs/{id}', [PackController::class, 'destroy']);
 
});
 //activites routes
 Route::get('/activites', [ActiviteController::class, 'index']);

 Route::get('/activites/{id}', [ActiviteController::class, 'show']);
 Route::post('/activites', [ActiviteController::class, 'store']);
 Route::put('/activites/{id}', [ActiviteController::class, 'update']);
 Route::delete('/activites/{id}', [ActiviteController::class, 'destroy']);

  Route::post('/logout', [AuthController::class, 'logout']);
  
//});

/**
  ** offre routes
  */
  Route::get('/offres', [offreController::class, 'index']);
  //Route::get('/offres/{id}', [offreController::class, 'show']);
  Route::post('/offres', [offreController::class, 'store']);
  Route::put('/offres/{id}', [offreController::class, 'update']);
  Route::delete('/offres/{id}', [offreController::class, 'destroy']);
  Route::get('/offres/{id}', [offreController::class, 'afficher']);

  


















































//les route de l authentification : 
// route de login : 
Route::post('/hh',[AuthController::class,'hhh'] );
//oublier mot de pass :
Route::post('/oublierbassma', [OblierController::class, 'sendResetCodee']);
Route::post('/resetbassma', [OblierController::class, 'resetPP'])->name('resetpassword');
// route regester : 
Route::post('/registerparent', [AuthController::class, 'registerParent']);
Route::get('/verify/{token}', [AuthController::class, 'verify'])->name('verify');












