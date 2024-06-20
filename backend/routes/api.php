<?php

use Illuminate\Http\Request;
use App\Http\Controllers\admin\PackController;
use App\Http\Controllers\admin\DemandeController;
use App\Http\Controllers\admin\FactureController;
use App\Http\Controllers\admin\ActiviteController;
use App\Http\Controllers\admin\AnimateurController;
use App\Http\Controllers\admin\OffreController;
use App\Http\Controllers\parent\EnfantController;
use App\Http\Controllers\parent\InscriptionoffreController;
use App\Http\Controllers\animateur\EspaceanimateurController;



use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;


use Illuminate\Support\Facades\Auth;
use App\Http\controllers\forgetpassword;
use App\Http\Middleware\VerifierEmailEtBouton;
use App\Http\controllers\resetpassword;
use App\Http\Controllers\testeController;
use App\Http\Controllers\MailController;
use App\Http\Controllers\OblierController;


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

// Route::Post('/destroy/{id}', [OffreController::class, 'destroy']);
// Route::delete('/ressource/{id}', [OffreController::class, 'destroy']);
// Route::get('show/{id}', [OffreController::class, 'show']);
// Route::Post('/store', [OffreController::class, 'store']);


Route::post('/admin', [AuthController::class, 'adminR'])->name('bassma');




// Route::middleware('auth:sanctum')->group(function () {

// Route::get('/logout', [AuthController::class, 'logout']);


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
// Route::middleware('auth:sanctum')->group(function () {


/**
 ESPACE ADMIN
*/


// animateur routes

// Route::middleware('auth:sanctum')->group(function () {
Route::get('/admin/animateurs', [AnimateurController::class, 'index']);
Route::get('/admin/animateurs/{id}', [AnimateurController::class, 'show']);
Route::put('/admin/animateurs/{id}', [AnimateurController::class, 'update']);
Route::delete('/admin/animateurs/{id}', [AnimateurController::class, 'destroy']);
Route::post('/admin/animateurs/{activiteId}', [AnimateurController::class, 'affecter']);
// });


// demande routes

// Route::middleware('auth:sanctum')->group(function () {
Route::get('/demandes', [DemandeController::class, 'demandes']);
Route::get('/demandes-a-traiter', [DemandeController::class, 'demandesAtraiter']);
Route::get('/demandes/{id}', [DemandeController::class, 'show']);
Route::get('/demandes-acceptees', [DemandeController::class, 'demandeAcceptees']);
Route::get('/demandes-refusees', [DemandeController::class, 'demandeRefusees']);
Route::put('/demandes/{id}/accepter', [DemandeController::class, 'accepterDemande']);
Route::put('/demandes/{id}/refuser', [DemandeController::class, 'refuserDemande']);
// });

// facture routes

// Route::middleware('auth:sanctum')->group(function () {
Route::get('/factures', [FactureController::class, 'indexFactures']);
Route::get('/factures/{id}', [FactureController::class, 'getFacture']);
Route::get('/facturesapayer', [FactureController::class, 'facturesAPayer']);
Route::get('/factures-payees', [FactureController::class, 'facturesPayees']);
Route::get('/factures-non-payees', [FactureController::class, 'facturesNonPayees']);
Route::get('/factures-archivees', [FactureController::class, 'facturesArchivees']);
Route::put('/factures/{id}/Marquer-Payees', [FactureController::class, 'MarquerPayees']);
Route::put('/factures/{id}/Marquer-Non-Payees', [FactureController::class, 'MarquerNonPayees']);
// });

// pack routes

// Route::middleware('auth:sanctum')->group(function () {
Route::get('/packs', [PackController::class, 'index']);
Route::get('/packs/{id}', [PackController::class, 'show']);
Route::post('/packs', [PackController::class, 'store']);
Route::put('/packs/{id}', [PackController::class, 'update']);
Route::delete('/packs/{id}', [PackController::class, 'destroy']);
// });

//activites routes

Route::get('/activites', [ActiviteController::class, 'index']);
Route::get('/activites/{id}', [ActiviteController::class, 'show']);
Route::put('/activites/{id}', [ActiviteController::class, 'update']);
Route::delete('/activites/{id}', [ActiviteController::class, 'destroy']);


// offre routes

Route::get('/offres', [offreController::class, 'index']);
Route::get('/offres/{id}', [offreController::class, 'show']);
Route::post('/offres', [offreController::class, 'store']);
Route::put('/offres/{id}', [offreController::class, 'update']);
Route::delete('/offres/{id}', [offreController::class, 'destroy']);


Route::post('/logout', [AuthController::class, 'logout']);

// });


/**
 ESPACE PARENT
*/

// enfant routes

// Route::middleware('auth:sanctum')->group(function () {
    Route::get('/mesEnfants', [EnfantController::class, 'index']);
    Route::get('/mesEnfants/{id}', [EnfantController::class, 'show']);
    Route::post('/mesEnfants', [EnfantController::class, 'store']);
    Route::put('/mesEnfants/{id}', [EnfantController::class, 'update']);
    Route::delete('/mesEnfants/{id}', [EnfantController::class, 'destroy']);
// });


// Inscription
// Route::middleware('auth:sanctum')->group(function () {
Route::get('/enfants', [InscriptionoffreController::class, 'indexEnfant']);
Route::get('/inscriptions/offres', [InscriptionoffreController::class, 'indexOffre']);
Route::post('/inscriptionsDetermine', [InscriptionoffreController::class, 'determine']);
Route::get('/inscriptions/offres/{id}', [InscriptionoffreController::class, 'showOffre']);
Route::get('/inscriptions/enfants/{id}', [InscriptionoffreController::class, 'showEnfant']);
Route::get('/inscriptions/activites/{id}', [InscriptionoffreController::class, 'indexActivites']);
Route::get('/inscriptions_activites/{id}', [InscriptionoffreController::class, 'showActivite']);
Route::get('/inscriptions/option_paiements/{id_offre}', [InscriptionoffreController::class, 'indexpaiements']);
Route::get('/inscriptions/horaires_disponibles/{id_activite}', [InscriptionoffreController::class, 'Disponibilites']);
Route::post('/enregistrer_horaires/enfants/{enfantId}/{activiteId}', [InscriptionoffreController::class, 'storeDispo']);
Route::post('/inscriptions', [InscriptionoffreController::class, 'createDemande']);
Route::post('/inscriptions_packs', [InscriptionoffreController::class, 'demandeAfterPack']);
Route::get('/inscriptions/packs', [InscriptionoffreController::class, 'indexPacks'])->name('inscription_pack');
// });



/**
 ESPACE ANIMATEUR
*/

// Route::middleware('auth:sanctum')->group(function () {
 Route::get('/activites/animateur/{animateurId}', [EspaceanimateurController::class, 'afficherActivites']);
 Route::get('/activite/horaires/{activiteId}', [EspaceanimateurController::class, 'afficherHorairesActivite']);
 Route::post('/activite/animateur/horaires/{activiteId}/{animateurId}/', [EspaceanimateurController::class, 'enregistrerHorairesSelectionnes']);
 Route::get('/animateur/{id}',[EspaceanimateurController::class,'activite_animer'] );
 Route::get('/animateur/{id}',[EspaceanimateurController::class,'allinformation'] );
 Route::get('/enfant/{id}',[EspaceanimateurController::class,'listeenfant'] );
// });


















































//les route de l authentification :
// route de login :
Route::post('/hh', [AuthController::class, 'hhh']);
//oublier mot de pass :
Route::post('/oublierbassma', [OblierController::class, 'sendResetCodee']);
Route::post('/resetbassma', [OblierController::class, 'resetPP'])->name('resetpassword');
// route regester :
Route::post('/registerparent', [AuthController::class, 'registerParent']);
Route::get('/verify/{token}', [AuthController::class, 'verify'])->name('verify');







