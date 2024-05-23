<?php

use Illuminate\Http\Request;
use App\Http\Requests\requestoffre;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\resetpassword;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\forgetpassword;
use App\Http\Controllers\admin\PackController;
use App\Http\Controllers\admin\DemandeController;
use App\Http\Controllers\admin\FactureController;
use App\Http\Controllers\admin\ActiviteController;
use App\Http\Controllers\admin\AnimateurController;
use App\Http\Controllers\admin\OffreController;
use App\Http\Controllers\parent\EnfantController;
use App\Http\Controllers\DemandeenfantController;



/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::Post('/destroy/{id}', [OffreController::class, 'destroy']);
Route::delete('/ressource/{id}', [OffreController::class, 'destroy']);
Route::get('show/{id}', [OffreController::class, 'show']);
Route::Post('/store', [OffreController::class, 'store']);


Route::post('/admin', [AuthController::class, 'adminR'])->name('bassma');




Route::middleware('auth:sanctum')->group(function () {

    Route::get('/login', [AuthController::class, 'login'])->middleware('VerifierEmailEtBouton');
    Route::post('/logout', [AuthController::class, 'logout']);

    Route::get('/verifier', [AuthController::class, 'sendmailveriy'])->middleware('VerifierEmailEtBouton');
    // les route de l offre :
    Route::Post('/destroy/{id}', [OffreController::class, 'destroy']);
    Route::delete('/ressource/{id}', [OffreController::class, 'destroy']);
    Route::get('show/{id}', [OffreController::class, 'show']);
    Route::Post('/store', [OffreController::class, 'store']);
    Route::get('/logout', [AuthController::class, 'logout']);
    Route::Post('/index', [OffreController::class, 'index']);
});

//les route de forget and reset password:
Route::get('/forgetpassword', [forgetpassword::class, 'sendResetCode']);
Route::get('/resetpassword', [forgetpassword::class, 'resetPassword'])->name('resetpassword');



//les route d authetification


Route::post('/login', [AuthController::class, 'login'])->middleware('VerifierEmailEtBouton');
Route::post('/registerparent', [AuthController::class, 'registerParent']);
Route::post('/registeranimateur', [AuthController::class, 'registerAnimateur']);
Route::post('/fogetpassword', [AuthController::class, 'forgetpassword']);
Route::Post('/admin', [AuthController::class, 'adminR']);

Route::get('/verify/{token}', [AuthController::class, 'verify'])->name('verify');

//Route::get('/login', [AuthController::class, 'loginee']);



Route::get('/verifier', [AuthController::class, 'sendmailveriy']);


// test reset password ::
Route::get('/sendmail1', [resetpassword::class, 'sendmail']);
Route::get('/frorget1', [resetpassword::class, 'resetPassword']);
Route::get('/register', [resetpassword::class, 'adminR']);






/**
 ** animateur routes
 */
Route::get('/animateurs', [AnimateurController::class, 'index']);
Route::get('/animateurs/{id}', [AnimateurController::class, 'show']);
Route::post('/animateurs', [AnimateurController::class, 'store']);
Route::put('/animateurs/{id}', [AnimateurController::class, 'update']);
Route::delete('/animateurs/{id}', [AnimateurController::class, 'destroy']);
Route::post('/animateurs/{animateurId}/assign-activity/{activityId}', [AnimateurController::class, 'assignActivity']);


/**
 ** offre routes
 */
Route::get('/offres', [offreController::class, 'index']);
Route::get('/offres/{id}', [offreController::class, 'show']);
Route::post('/offres', [offreController::class, 'store']);
Route::put('/offres/{id}', [offreController::class, 'update']);
Route::delete('/offres/{id}', [offreController::class, 'destroy']);
Route::post('/offres', [offreController::class, 'store']);
Route::put('/offres/{id}', [offreController::class, 'update']);
Route::delete('/offres/{id}', [offreController::class, 'destroy']);
/**
 ** demande routes
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

/**
 ** enfant routes
 */
Route::middleware('auth:sanctum')->group(function () {
    Route::get('/mesEnfants', [EnfantController::class, 'index']);
    Route::get('/monEnfant/{id}', [EnfantController::class, 'show']);
    Route::post('/mesEnfants/{id}', [EnfantController::class, 'store']);
    Route::put('/monEnfant/{id}', [EnfantController::class, 'update']);
    Route::delete('/monEnfant/{id}', [EnfantController::class, 'destroy']);
});

//animateur routes

Route::get('/animateurs', [AnimateurController::class, 'index']);
Route::get('/animateurs/{id}', [AnimateurController::class, 'show']);
Route::post('/animateurs', [AnimateurController::class, 'store']);
Route::put('/animateurs/{id}', [AnimateurController::class, 'update']);
Route::delete('/animateurs/{id}', [AnimateurController::class, 'destroy']);
Route::post('/animateurs/{id}', [AnimateurController::class, 'affecter']);

//activites routes

Route::get('/activites', [ActiviteController::class, 'index']);
Route::get('/activites/{id}', [ActiviteController::class, 'show']);
Route::post('/activites', [ActiviteController::class, 'store']);
Route::put('/activites/{id}', [ActiviteController::class, 'update']);
Route::delete('/activites/{id}', [ActiviteController::class, 'destroy']);

//offre routes

Route::get('/offres', [OffreController::class, 'index']);
Route::get('/offres/{id}', [OffreController::class, 'show']);
Route::post('/offres', [offreController::class, 'store']);
Route::put('/offres/{id}', [offreController::class, 'update']);
Route::delete('/offres/{id}', [offreController::class, 'destroy']);

// demande routes

Route::get('/demandes', [demandeController::class, 'demandes']);
Route::get('/demandes/a-traiter', [demandeController::class, 'demandesAtraiter']);
Route::get('/demandes/{id}', [demandeController::class, 'show']);
Route::get('/demandes-acceptees', [DemandeController::class, 'demandeAcceptees']);
Route::get('/demandes-refusees', [DemandeController::class, 'demandeRefusees']);
Route::put('/demandes/{id}/accepter', [DemandeController::class, 'accepterDemande']);
Route::put('/demandes/{id}/refuser', [DemandeController::class, 'refuserDemande']);


// facture routes

Route::get('/factures', [FactureController::class, 'indexFactures']);
Route::get('/factures/{id}', [FactureController::class, 'getFacture']);
Route::get('/factures/a-payer', [FactureController::class, 'facturesAPayer']);
Route::get('/factures/payees', [FactureController::class, 'facturesPayees']);
Route::get('/factures/non-payees', [FactureController::class, 'facturesNonPayees']);
Route::put('/factures/{id}/Marquer-Payees', [FactureController::class, 'MarquerPayees']);
Route::put('/factures/{id}/Marquer-Non-Payees', [FactureController::class, 'MarquerNonPayees']);

// Packs routes

Route::get('/packs', [PackController::class, 'index']);
Route::get('/packs/{id}', [PackController::class, 'show']);
Route::post('/packs', [PackController::class, 'store']);
Route::put('/packs/{id}', [PackController::class, 'update']);
Route::delete('/packs/{id}', [PackController::class, 'destroy']);

/*
 **ESPACE PARENT
 */

//DEMANDE INSCRIPTION ROUTE
Route::get('/demandemesenfs/{id}', [DemandeenfantController::class, 'show']);


