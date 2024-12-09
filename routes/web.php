<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DocumentController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
})->name('login');

Route::get('/tableaudeboard', function () {
    return view('dashboard.index');
})->name('tab');

Route::get('/action', function () {
    return view('action.index');
})->name('tab');




Route::get('/dashboard', [DocumentController::class, 'dashboard'])->name('dashboard');
Route::get('/courriers', [DocumentController::class, 'courriers'])->name('documents.courriers');
Route::get('/documents', [DocumentController::class, 'index'])->name('documents.index');
Route::get('/documents/attente', [DocumentController::class, 'attente'])->name('documents.attente');
Route::get('/documents/valide', [DocumentController::class, 'valide'])->name('documents.valide');
Route::get('/documents/partages', [DocumentController::class, 'partages'])->name('documents.partages');
Route::get('/documents/recherche', [DocumentController::class, 'recherche'])->name('documents.recherche');
Route::get('/documents/archives', [DocumentController::class, 'archives'])->name('documents.archives');
Route::get('/documents/verification', [DocumentController::class, 'verification'])->name('documents.verification');
Route::get('/documents/historique', [DocumentController::class, 'historique'])->name('documents.historique');
Route::get('/utilisateur', [DocumentController::class, 'utilisateur'])->name('utilisateur.index');
Route::get('/ressources-humaines', [DocumentController::class, 'ressourcesHumaines'])->name('ressources.humaines');
Route::get('/parametres', [DocumentController::class, 'parametres'])->name('parametres.index');
