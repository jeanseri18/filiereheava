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

Route::middleware(['auth'])->group(function () {
    // Afficher les documents partagés avec l'utilisateur
    Route::get('/documents/shared-with-me', [DocumentController::class, 'sharedWithMe'])->name('documents.sharedWithMe');

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
Route::get('/courriers/{id}', [CourrierController::class, 'show'])->name('courriers.show');

Route::get('/histories', [HistoryController::class, 'index'])->name('histories.index');


Route::get('documents', [DocumentController::class, 'index'])->name('documents.index'); // Liste des documents
Route::get('documents/create', [DocumentController::class, 'create'])->name('documents.create'); // Formulaire de création
Route::post('documents', [DocumentController::class, 'store'])->name('documents.store'); // Enregistrement d'un document
Route::get('documents/{document}', [DocumentController::class, 'show'])->name('documents.show'); // Afficher un document spécifique
Route::get('documents/{document}/edit', [DocumentController::class, 'edit'])->name('documents.edit'); // Formulaire de modification
Route::put('documents/{document}', [DocumentController::class, 'update'])->name('documents.update'); // Mise à jour d'un document
Route::delete('documents/{document}', [DocumentController::class, 'destroy'])->name('documents.destroy'); // Suppression d'un document

// Routes pour la gestion des utilisateurs
Route::prefix('users')->name('users.')->group(function () {
    Route::get('/', [UserController::class, 'index'])->name('index');
    Route::get('/create', [UserController::class, 'create'])->name('create');
    Route::post('/', [UserController::class, 'store'])->name('store');
    Route::get('/{user}/edit', [UserController::class, 'edit'])->name('edit');
    Route::put('/{user}', [UserController::class, 'update'])->name('update');
    Route::delete('/{user}', [UserController::class, 'destroy'])->name('destroy');
});

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



//
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