<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DocumentsController;


use App\Http\Controllers\ServiceController;
use App\Http\Controllers\DirectionController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DocumentController;
use App\Http\Controllers\ArchiveController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\HistoryController;
use App\Http\Controllers\CourrierController;
use App\Http\Controllers\ShareGroupController;
// routes/web.php
use App\Http\Controllers\AttestationStageController;
use App\Http\Controllers\AutorisationAbsenceController;
use App\Http\Controllers\CertificatTravailController;
use App\Http\Controllers\AttestationTravailController;

use App\Http\Controllers\DemandeAbsenceController;
use App\Http\Controllers\DemandeDepartCongesController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\CategorieController;
use App\Http\Controllers\SousCategorieController;
use App\Http\Controllers\DocumentworkerController;
use App\Http\Controllers\AttestationController;
use App\Http\Controllers\OrdreMissionController;
use App\Http\Controllers\DemandeSpecialeController;

Route::resource('demandes_speciales', DemandeSpecialeController::class);
Route::patch('/demandes_speciales/{id}/valider', [DemandeSpecialeController::class, 'valider'])->name('demandes_speciales.valider');
Route::patch('/demandes_speciales/{id}/annuler', [DemandeSpecialeController::class, 'annuler'])->name('demandes_speciales.annuler');

Route::resource('ordres', OrdreMissionController::class);

Route::middleware(['auth'])->group(function () {
    Route::resource('attestations', AttestationController::class);
});

Route::middleware(['auth'])->group(function () {
    // Liste des employés
    Route::get('/personnel', [App\Http\Controllers\PersonnelController::class, 'index'])->name('personnel.index');
    
    // Afficher le formulaire de création
    Route::get('/personnel/create', [App\Http\Controllers\PersonnelController::class, 'create'])->name('personnel.create');
    
    // Enregistrer un nouvel employé
    Route::post('/personnel', [App\Http\Controllers\PersonnelController::class, 'store'])->name('personnel.store');
    
    // Afficher les détails d'un employé
    Route::get('/personnel/{id}', [App\Http\Controllers\PersonnelController::class, 'show'])->name('personnel.show');
    
    // Afficher le formulaire d'édition
    Route::get('/personnel/{id}/edit', [App\Http\Controllers\PersonnelController::class, 'edit'])->name('personnel.edit');
    
    // Mettre à jour un employé
    Route::put('/personnel/{id}', [App\Http\Controllers\PersonnelController::class, 'update'])->name('personnel.update');
    
    // Supprimer un employé
    Route::delete('/personnel/{id}', [App\Http\Controllers\PersonnelController::class, 'destroy'])->name('personnel.destroy');
});

Route::middleware('auth')->group(function () {

    
Route::resource('document_rh', DocumentworkerController::class);
Route::get('/get-sous-categories/{id}', [DocumentworkerController::class, 'getSousCategories']);

Route::get('categories', [CategorieController::class, 'index'])->name('categories.index');
Route::get('categories/create', [CategorieController::class, 'create'])->name('categories.create');
Route::post('categories', [CategorieController::class, 'store'])->name('categories.store');
Route::get('categories/{id}/edit', [CategorieController::class, 'edit'])->name('categories.edit');
Route::put('categories/{id}', [CategorieController::class, 'update'])->name('categories.update');
Route::delete('categories/{id}', [CategorieController::class, 'destroy'])->name('categories.destroy');

Route::get('sous-categories', [SousCategorieController::class, 'index'])->name('sous-categories.index');
Route::get('sous-categories/create', [SousCategorieController::class, 'create'])->name('sous-categories.create');
Route::post('sous-categories', [SousCategorieController::class, 'store'])->name('sous-categories.store');
Route::get('sous-categories/{id}/edit', [SousCategorieController::class, 'edit'])->name('sous-categories.edit');
Route::put('sous-categories/{id}', [SousCategorieController::class, 'update'])->name('sous-categories.update');
Route::delete('sous-categories/{id}', [SousCategorieController::class, 'destroy'])->name('sous-categories.destroy');

Route::get('/dashboardrh', [DashboardController::class, 'index'])->name('dashboardrh');

Route::get('/demandes', [DemandeDepartCongesController::class, 'index'])->name('demandes.index');
Route::get('/demandes/create', [DemandeDepartCongesController::class, 'create'])->name('demandes.create');
Route::post('/demandes', [DemandeDepartCongesController::class, 'store'])->name('demandes.store');
Route::get('/demandes/{id}', [DemandeDepartCongesController::class, 'show'])->name('demandes.show');
Route::get('/demandesvalide/{id}', [DemandeDepartCongesController::class, 'showvalidedoc'])->name('demandes.showvalidedoc');
Route::get('/demandes/{id}/edit', [DemandeDepartCongesController::class, 'edit'])->name('demandes.edit');
Route::put('/demandes/{id}', [DemandeDepartCongesController::class, 'update'])->name('demandes.update');
Route::delete('/demandes/{id}', [DemandeDepartCongesController::class, 'destroy'])->name('demandes.destroy');
Route::post('demandes/{id}/validate', [DemandeDepartCongesController::class, 'validateDemande'])->name('demandes.validate');

// Rejeter une demande d'absence
Route::post('demandes/{id}/reject', [DemandeDepartCongesController::class, 'rejectDemande'])->name('demandes.reject');

    // Liste des demandes (toutes)
    Route::get('demandes_absence', [DemandeAbsenceController::class, 'index'])->name('demandes_absence.index');

    // Liste des demandes du user connecté
    Route::get('mes_demandes_absence', [DemandeAbsenceController::class, 'userDemandes'])->name('demandes_absence.user');

    // Formulaire de création
    Route::get('demandes_absence/create', [DemandeAbsenceController::class, 'create'])->name('demandes_absence.create');

    // Enregistrer une nouvelle demande
    Route::post('demandes_absence', [DemandeAbsenceController::class, 'store'])->name('demandes_absence.store');

    // Afficher une demande
    Route::get('demandes_absence/{id}', [DemandeAbsenceController::class, 'show'])->name('demandes_absence.show');

    // Formulaire d'édition
    Route::get('demandes_absence/{id}/edit', [DemandeAbsenceController::class, 'edit'])->name('demandes_absence.edit');

    // Mettre à jour une demande
    Route::put('demandes_absence/{id}', [DemandeAbsenceController::class, 'update'])->name('demandes_absence.update');

    // Supprimer une demande
    Route::delete('demandes_absence/{id}', [DemandeAbsenceController::class, 'destroy'])->name('demandes_absence.destroy');
     // Valider une demande d'absence
     Route::post('demandes_absence/{id}/validate', [DemandeAbsenceController::class, 'validateDemande'])->name('demandes_absence.validate');

     // Rejeter une demande d'absence
     Route::post('demandes_absence/{id}/reject', [DemandeAbsenceController::class, 'rejectDemande'])->name('demandes_absence.reject');
 
});

Route::middleware('auth')->group(function () {
    // Afficher toutes les attestations
    Route::get('attestations_travail', [AttestationTravailController::class, 'index'])->name('attestations_travail.index');

    // Afficher le formulaire de création
    Route::get('attestations_travail/create', [AttestationTravailController::class, 'create'])->name('attestations_travail.create');

    // Enregistrer une nouvelle attestation
    Route::post('attestations_travail', [AttestationTravailController::class, 'store'])->name('attestations_travail.store');

    // Afficher une attestation spécifique
    Route::get('attestations_travail/{id}', [AttestationTravailController::class, 'show'])->name('attestations_travail.show');

    // Afficher le formulaire d'édition
    Route::get('attestations_travail/{id}/edit', [AttestationTravailController::class, 'edit'])->name('attestations_travail.edit');

    // Mettre à jour une attestation
    Route::put('attestations_travail/{id}', [AttestationTravailController::class, 'update'])->name('attestations_travail.update');

    // Supprimer une attestation
    Route::delete('attestations_travail/{id}', [AttestationTravailController::class, 'destroy'])->name('attestations_travail.destroy');

    // Valider une attestation
    Route::post('attestations_travail/{id}/validate', [AttestationTravailController::class, 'validateAttestation'])->name('attestations_travail.validate');

    // Rejeter une attestation
    Route::post('attestations_travail/{id}/reject', [AttestationTravailController::class, 'rejectAttestation'])->name('attestations_travail.reject');


Route::prefix('certificats')->name('certificats.')->group(function() {
    // Afficher la liste des certificats
    Route::get('/', [CertificatTravailController::class, 'index'])->name('index');
    
    // Créer un certificat
    Route::get('/create', [CertificatTravailController::class, 'create'])->name('create');
    Route::post('/', [CertificatTravailController::class, 'store'])->name('store');
    
    // Afficher un certificat spécifique
    Route::get('{id}', [CertificatTravailController::class, 'show'])->name('show');
    
    // Modifier un certificat
    Route::get('{id}/edit', [CertificatTravailController::class, 'edit'])->name('edit');
    Route::put('{id}', [CertificatTravailController::class, 'update'])->name('update');
    
    // Supprimer un certificat
    Route::delete('{id}', [CertificatTravailController::class, 'destroy'])->name('destroy');
    
    // Valider un certificat
    Route::post('{id}/valider', [CertificatTravailController::class, 'valider'])->name('valider');
    
    // Rejeter un certificat
    Route::post('{id}/rejeter', [CertificatTravailController::class, 'rejeter'])->name('rejeter');
});


Route::post('autorisations/{id}/valider', [AutorisationAbsenceController::class, 'valider'])->name('autorisations.valider');
Route::post('autorisations/{id}/rejeter', [AutorisationAbsenceController::class, 'rejeter'])->name('autorisations.rejeter');

Route::get('autorisations', [AutorisationAbsenceController::class, 'index'])->name('autorisations.index'); // Liste
Route::get('autorisations/create', [AutorisationAbsenceController::class, 'create'])->name('autorisations.create'); // Formulaire de création
Route::post('autorisations', [AutorisationAbsenceController::class, 'store'])->name('autorisations.store'); // Enregistrement
Route::get('autorisations/{id}', [AutorisationAbsenceController::class, 'show'])->name('autorisations.show'); // Afficher
Route::get('autorisations/{id}/edit', [AutorisationAbsenceController::class, 'edit'])->name('autorisations.edit'); // Formulaire de modification
Route::put('autorisations/{id}', [AutorisationAbsenceController::class, 'update'])->name('autorisations.update'); // Mise à jour
Route::delete('autorisations/{id}', [AutorisationAbsenceController::class, 'destroy'])->name('autorisations.destroy'); // Suppression

Route::get('attestations_stage', [AttestationStageController::class, 'index'])->name('attestations_stage.index');
Route::get('attestations_stage/create', [AttestationStageController::class, 'create'])->name('attestations_stage.create');
Route::post('attestations_stage', [AttestationStageController::class, 'store'])->name('attestations_stage.store');
Route::get('attestations_stage/{id}', [AttestationStageController::class, 'show'])->name('attestations_stage.show');
Route::get('attestations_stage/{id}/edit', [AttestationStageController::class, 'edit'])->name('attestations_stage.edit');
Route::put('attestations_stage/{id}', [AttestationStageController::class, 'update'])->name('attestations_stage.update');
Route::delete('attestations_stage/{id}', [AttestationStageController::class, 'destroy'])->name('attestations_stage.destroy');
Route::post('attestations_stage/{id}/validate', [AttestationStageController::class, 'validated'])->name('attestations_stage.validate');
    
// Route pour rejeter une attestation
Route::post('attestations_stage/{id}/reject', [AttestationStageController::class, 'reject'])->name('attestations_stage.reject');
});

Route::middleware(['auth'])->group(function () {
    // Afficher les documents partagés avec l'utilisateur
    Route::get('/documents/shared-with-me', [DocumentController::class, 'sharedWithMe'])->name('documents.sharedWithMe');
    Route::post('/profile/update-photo', [ProfileController::class, 'updatePhoto'])->name('profile.updatePhoto');

    // Afficher les documents partagés par l'utilisateur
    Route::get('/documents/shared-by-me', [DocumentController::class, 'sharedByMe'])->name('documents.sharedByMe');
});

Route::middleware('auth')->group(function () {
    // Afficher les documents filtrés par statut
    Route::get('documents/ajoutes', [DocumentController::class, 'added'])->name('documents.added');
    Route::get('documents/soumis', [DocumentController::class, 'submitted'])->name('documents.submitted');
    Route::get('documents/en-attente', [DocumentController::class, 'pending'])->name('documents.pending');
    Route::get('documents/valide', [DocumentController::class, 'validated'])->name('documents.validated');
    Route::get('documents/rejete', [DocumentController::class, 'rejected'])->name('documents.rejected');


Route::get('/share-groups', [ShareGroupController::class, 'index'])->name('share_groups.index');
Route::get('/share-groups/create', [ShareGroupController::class, 'create'])->name('share_groups.create');
Route::post('/share-groups', [ShareGroupController::class, 'store'])->name('share_groups.store');
Route::get('/share-groups/{id}', [ShareGroupController::class, 'show'])->name('share_groups.show');
Route::post('/share-groups/{id}/add-member', [ShareGroupController::class, 'addMember'])->name('share_groups.addMember');
Route::delete('/share-groups/{groupId}/remove-member/{userId}', [ShareGroupController::class, 'removeMember'])->name('share_groups.removeMember');

// Liste des courriers
Route::get('/courriers', [CourrierController::class, 'index'])->name('courriers.index');

// Formulaire de création de courrier
Route::get('/courriers/create', [CourrierController::class, 'create'])->name('courriers.create');

// Enregistrer un nouveau courrier
Route::post('/courriers', [CourrierController::class, 'store'])->name('courriers.store');

// Afficher un courrier spécifique
Route::get('/courriers/{courrier}', [CourrierController::class, 'show'])->name('courriers.show');

Route::get('/histories', [HistoryController::class, 'index'])->name('histories.index');


Route::get('documents', [DocumentController::class, 'index'])->name('documents.index'); // Liste des documents
Route::get('documents/create', [DocumentController::class, 'create'])->name('documents.create'); // Formulaire de création
Route::post('documents', [DocumentController::class, 'store'])->name('documents.store'); // Enregistrement d'un document
Route::get('documents/{document}', [DocumentController::class, 'show'])->name('documents.show'); // Afficher un document spécifique
Route::get('documents/{document}/edit', [DocumentController::class, 'edit'])->name('documents.edit'); // Formulaire de modification
Route::put('documents/{document}', [DocumentController::class, 'update'])->name('documents.update'); // Mise à jour d'un document
Route::delete('documents/{document}', [DocumentController::class, 'destroy'])->name('documents.destroy'); // Suppression d'un document
Route::post('/documents/{id}/update-status', [DocumentController::class, 'updateStatus'])->name('documents.updateStatus');

// Routes pour la gestion des utilisateurs


// Routes RESTful pour les directions
Route::prefix('directions')->name('directions.')->group(function () {
    // Afficher toutes les directions
    Route::get('/', [DirectionController::class, 'index'])->name('index');

    // Afficher le formulaire de création
    Route::get('/create', [DirectionController::class, 'create'])->name('create');

    // Ajouter une nouvelle direction
    Route::post('/', [DirectionController::class, 'store'])->name('store');

    // Afficher le formulaire de modification d'une direction
    Route::get('/{direction}/edit', [DirectionController::class, 'edit'])->name('edit');

    // Modifier une direction
    Route::put('/{direction}', [DirectionController::class, 'update'])->name('update');

    // Supprimer une direction
    Route::delete('/{direction}', [DirectionController::class, 'destroy'])->name('destroy');
});

// Routes RESTful pour les services
Route::prefix('services')->name('services.')->group(function () {
    // Afficher la liste des services
    Route::get('/', [ServiceController::class, 'index'])->name('index');

    // Afficher le formulaire de création d'un service
    Route::get('/create', [ServiceController::class, 'create'])->name('create');

    // Enregistrer un nouveau service
    Route::post('/', [ServiceController::class, 'store'])->name('store');

    // Afficher le formulaire d'édition d'un service
    Route::get('/{service}/edit', [ServiceController::class, 'edit'])->name('edit');

    // Mettre à jour un service
    Route::put('/{service}', [ServiceController::class, 'update'])->name('update');

    // Supprimer un service
    Route::delete('/{service}', [ServiceController::class, 'destroy'])->name('destroy');
});



});
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::put('/profile/update', [ProfileController::class, 'update'])->name('profile.update');
    Route::put('/profile/password', [ProfileController::class, 'updatePassword'])->name('profile.updatePassword');
});

Route::middleware(['auth'])->group(function () {
    Route::get('/archives', [ArchiveController::class, 'index'])->name('archives.index');
    Route::post('/archives/archive/{id}', [ArchiveController::class, 'archiveDocument'])->name('archives.archive');
    Route::post('/archives/unarchive/{id}', [ArchiveController::class, 'unarchiveDocument'])->name('archives.unarchive');

    Route::get('/archives/download/{id}', [ArchiveController::class, 'downloadDocument'])->name('archives.download');


    Route::get('/documentss', [DocumentsController::class, 'index'])->name('documentss.index');
Route::get('/documentss/attente', [DocumentsController::class, 'attente'])->name('documents.attente');
Route::get('/documentss/valide', [DocumentsController::class, 'valide'])->name('documents.valide');
Route::get('/documentss/partages', [DocumentsController::class, 'partages'])->name('documents.partages');
Route::get('/documentss/recherche', [DocumentsController::class, 'recherche'])->name('documents.recherche');
Route::get('/documentss/archives', [DocumentsController::class, 'archives'])->name('documents.archives');
Route::get('/documentss/verification', [DocumentsController::class, 'verification'])->name('documents.verification');
Route::get('/documentss/historique', [DocumentsController::class, 'historique'])->name('documents.historique');
Route::get('/utilisateur', [DocumentsController::class, 'utilisateur'])->name('utilisateur.index');
Route::get('/ressources-humaines', [DocumentsController::class, 'ressourcesHumaines'])->name('ressources.humaines');
Route::get('/parametres', [DocumentsController::class, 'parametres'])->name('parametres.index');
});


Route::get('/logins', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.submit');
Route::get('/dashboard', [AuthController::class, 'dashboard'])->name('dashboard');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');



Route::get('/', function () {
    return view('welcome');
})->name('login');



Route::get('/action', function () {
    return view('action.index');
})->name('tab');



Route::get('/menu', function () {
    return view('dashboard.menu');
})->name('menu');



Route::prefix('users')->name('users.')->group(function () {
    Route::get('/', [UserController::class, 'index'])->name('index');
    Route::get('/create', [UserController::class, 'create'])->name('create');
    Route::post('/', [UserController::class, 'store'])->name('store');
    Route::get('/{user}/edit', [UserController::class, 'edit'])->name('edit');
    Route::put('/{id}', [UserController::class, 'update'])->name('update');
    Route::delete('/{user}', [UserController::class, 'destroy'])->name('destroy');
});
//
