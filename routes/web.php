<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\GoogleController;
use App\Http\Controllers\Auth\CandidatureController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\DevisController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\ReclamationController;
use App\Http\Controllers\Client\DashboardController as ClientDashboard;
use App\Http\Controllers\Client\CommandeController as ClientCommande;
use App\Http\Controllers\Client\ProfilController as ClientProfil;
use App\Http\Controllers\Expert\DashboardController as ExpertDashboard;
use App\Http\Controllers\Expert\CommandeController as ExpertCommande;
use App\Http\Controllers\Expert\ProfilController as ExpertProfil;
use App\Http\Controllers\Admin\DashboardController as AdminDashboard;
use App\Http\Controllers\Admin\CommandeController as AdminCommande;
use App\Http\Controllers\Admin\ClientController as AdminClient;
use App\Http\Controllers\Admin\ExpertController as AdminExpert;
use App\Http\Controllers\Admin\CandidatureController as AdminCandidature;
use App\Http\Controllers\Admin\MessageController as AdminMessage;
use App\Http\Controllers\Admin\ReclamationController as AdminReclamation;
use App\Http\Controllers\Admin\StatistiqueController as AdminStat;

// ─── Pages publiques ─────────────────────────────────────────────────────────
Route::get('/', [PageController::class, 'accueil'])->name('accueil');
Route::get('/services', [PageController::class, 'services'])->name('services');
Route::get('/memoires', [PageController::class, 'memoires'])->name('memoires');
Route::get('/tarifs', [PageController::class, 'tarifs'])->name('tarifs');
Route::get('/a-propos', [PageController::class, 'aPropos'])->name('a-propos');
Route::get('/notre-equipe', [PageController::class, 'equipe'])->name('equipe');
Route::get('/ressources', [PageController::class, 'ressources'])->name('ressources');

// ─── Devis ────────────────────────────────────────────────────────────────────
Route::get('/devis', [DevisController::class, 'index'])->name('devis');
Route::post('/devis', [DevisController::class, 'store'])->name('devis.store')
    ->middleware('throttle:5,1');

// ─── Contact ──────────────────────────────────────────────────────────────────
Route::get('/nous-contacter', [ContactController::class, 'index'])->name('contact');
Route::post('/nous-contacter', [ContactController::class, 'store'])->name('contact.store')
    ->middleware('throttle:5,1');

// ─── Réclamations ─────────────────────────────────────────────────────────────
Route::get('/reclamations', [ReclamationController::class, 'index'])->name('reclamations');
Route::post('/reclamations', [ReclamationController::class, 'store'])->name('reclamations.store')
    ->middleware('throttle:3,1');

// ─── Authentification ─────────────────────────────────────────────────────────
Route::middleware('guest')->group(function () {
    Route::get('/connexion', [LoginController::class, 'showForm'])->name('login');
    Route::post('/connexion', [LoginController::class, 'login'])->middleware('throttle:5,1');

    Route::get('/inscription', [RegisterController::class, 'showForm'])->name('register');
    Route::post('/inscription', [RegisterController::class, 'register'])->middleware('throttle:5,1');

    Route::get('/mot-de-passe-oublie', [LoginController::class, 'forgotForm'])->name('password.request');
    Route::post('/mot-de-passe-oublie', [LoginController::class, 'forgot'])->name('password.email');
    Route::get('/reinitialiser-mot-de-passe/{token}', [LoginController::class, 'resetForm'])->name('password.reset');
    Route::post('/reinitialiser-mot-de-passe', [LoginController::class, 'reset'])->name('password.update');

    // Candidature expert
    Route::get('/rejoindre', [CandidatureController::class, 'showForm'])->name('rejoindre');
    Route::post('/rejoindre', [CandidatureController::class, 'store'])->name('rejoindre.store')
        ->middleware('throttle:3,1');
    Route::get('/candidature-recue', [CandidatureController::class, 'confirmation'])->name('candidature.confirmation');
});

Route::post('/deconnexion', [LoginController::class, 'logout'])->name('logout')->middleware('auth');

// Email vérification
Route::get('/verification-email', function () {
    return view('auth.verification-email');
})->middleware('auth')->name('verification.notice');
Route::get('/verification-email/{id}/{hash}', [RegisterController::class, 'verify'])
    ->middleware(['auth', 'signed'])->name('verification.verify');
Route::post('/verification-email/renvoyer', [RegisterController::class, 'resend'])
    ->middleware(['auth', 'throttle:6,1'])->name('verification.send');

// Google OAuth
Route::get('/auth/google', [GoogleController::class, 'redirect'])->name('auth.google');
Route::get('/auth/google/callback', [GoogleController::class, 'callback']);

// ─── Espace Client ────────────────────────────────────────────────────────────
Route::middleware(['auth', 'role:client'])->prefix('client')->name('client.')->group(function () {
    Route::get('/dashboard', [ClientDashboard::class, 'index'])->name('dashboard');
    Route::get('/commandes', [ClientCommande::class, 'index'])->name('commandes');
    Route::get('/commandes/{commande}', [ClientCommande::class, 'show'])->name('commandes.show');
    Route::get('/commandes/{commande}/fichiers/{fichier}/telecharger', [ClientCommande::class, 'download'])
        ->name('commandes.download');
    Route::get('/profil', [ClientProfil::class, 'show'])->name('profil');
    Route::put('/profil', [ClientProfil::class, 'update'])->name('profil.update');
});

// ─── Espace Expert ────────────────────────────────────────────────────────────
Route::middleware(['auth', 'role:expert'])->prefix('expert')->name('expert.')->group(function () {
    Route::get('/dashboard', [ExpertDashboard::class, 'index'])->name('dashboard');
    Route::get('/commandes', [ExpertCommande::class, 'index'])->name('commandes');
    Route::get('/commandes/{commande}', [ExpertCommande::class, 'show'])->name('commandes.show');
    Route::post('/commandes/{commande}/livrer', [ExpertCommande::class, 'livrer'])->name('commandes.livrer');
    Route::get('/profil', [ExpertProfil::class, 'show'])->name('profil');
    Route::put('/profil', [ExpertProfil::class, 'update'])->name('profil.update');
});

// ─── Espace Admin ─────────────────────────────────────────────────────────────
Route::middleware(['auth', 'role:super_admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [AdminDashboard::class, 'index'])->name('dashboard');

    // Commandes
    Route::get('/commandes', [AdminCommande::class, 'index'])->name('commandes');
    Route::get('/commandes/{commande}', [AdminCommande::class, 'show'])->name('commandes.show');
    Route::put('/commandes/{commande}/statut', [AdminCommande::class, 'updateStatut'])->name('commandes.statut');
    Route::put('/commandes/{commande}/assigner', [AdminCommande::class, 'assigner'])->name('commandes.assigner');
    Route::get('/commandes/{commande}/fichier-client', [AdminCommande::class, 'downloadFichierClient'])->name('commandes.fichier-client');

    // Clients & Experts
    Route::get('/clients', [AdminClient::class, 'index'])->name('clients');
    Route::get('/clients/{user}', [AdminClient::class, 'show'])->name('clients.show');
    Route::get('/experts', [AdminExpert::class, 'index'])->name('experts');
    Route::get('/experts/{user}', [AdminExpert::class, 'show'])->name('experts.show');
    Route::put('/experts/{user}/toggle', [AdminExpert::class, 'toggleActif'])->name('experts.toggle');

    // Candidatures
    Route::get('/candidatures', [AdminCandidature::class, 'index'])->name('candidatures');
    Route::get('/candidatures/{candidature}', [AdminCandidature::class, 'show'])->name('candidatures.show');
    Route::put('/candidatures/{candidature}/valider', [AdminCandidature::class, 'valider'])->name('candidatures.valider');
    Route::put('/candidatures/{candidature}/refuser', [AdminCandidature::class, 'refuser'])->name('candidatures.refuser');
    Route::get('/candidatures/{candidature}/cv', [AdminCandidature::class, 'downloadCv'])->name('candidatures.cv');

    // Messages & réclamations
    Route::get('/messages', [AdminMessage::class, 'index'])->name('messages');
    Route::get('/messages/{message}', [AdminMessage::class, 'show'])->name('messages.show');
    Route::put('/messages/{message}/lu', [AdminMessage::class, 'marquerLu'])->name('messages.lu');
    Route::get('/reclamations', [AdminReclamation::class, 'index'])->name('reclamations');
    Route::get('/reclamations/{reclamation}', [AdminReclamation::class, 'show'])->name('reclamations.show');
    Route::put('/reclamations/{reclamation}/statut', [AdminReclamation::class, 'updateStatut'])->name('reclamations.statut');

    // Statistiques
    Route::get('/statistiques', [AdminStat::class, 'index'])->name('statistiques');

    // Notifications
    Route::post('/notifications/lire-tout', [AdminDashboard::class, 'lireToutesNotifications'])->name('notifications.lire-tout');
});
