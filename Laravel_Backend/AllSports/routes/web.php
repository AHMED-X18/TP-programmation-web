<?php

// ============================================
// routes/web.php
// ============================================

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\LoginController;

/*
|--------------------------------------------------------------------------
| Routes Publiques (Accessibles sans connexion)
|--------------------------------------------------------------------------
*/

// Page d'accueil - Redirection vers les produits
Route::get('/', function () {
    return redirect()->route('products.index');
});

// AUTHENTIFICATION
Route::middleware('guest')->group(function () {
    // Inscription
    Route::get('/inscription', [RegisterController::class, 'showRegistrationForm'])->name('register');
    Route::post('/inscription', [RegisterController::class, 'register']);

    // Connexion
    Route::get('/connexion', [LoginController::class, 's
    howLoginForm'])->name('login');
    Route::post('/connexion', [LoginController::class, 'login']);
});

// Déconnexion (accessible uniquement si connecté)
Route::post('/deconnexion', [LoginController::class, 'logout'])
    ->middleware('auth')
    ->name('logout');

// PRODUITS (accessibles à tous)
Route::prefix('produits')->name('products.')->group(function () {
    // Liste des produits
    Route::get('/', [ProductController::class, 'index'])->name('index');
    
    // Détail d'un produit
    Route::get('/{id}', [ProductController::class, 'show'])->name('show');
    
    // Recherche
    Route::get('/recherche/{id}', [ProductController::class, 'search'])->name('search');
    
    // Filtrer par catégorie
    Route::get('/categorie/{category}', [ProductController::class, 'category'])->name('category');
});

/*
|--------------------------------------------------------------------------
| Routes Protégées (Nécessitent une connexion)
|--------------------------------------------------------------------------
*/

Route::middleware('auth')->group(function () {
    
    // PANIER
    Route::prefix('panier')->name('cart.')->group(function () {
        // Voir le panier
        Route::get('/', [CartController::class, 'index'])->name('index');
        
        // Ajouter au panier
        Route::post('/ajouter/{productId}', [CartController::class, 'add'])->name('add');
        
        // Mettre à jour la quantité
        Route::patch('/{cartItemId}', [CartController::class, 'update'])->name('update');
        
        // Retirer un article
        Route::delete('/{cartItemId}', [CartController::class, 'remove'])->name('remove');
        
        // Vider le panier
        Route::delete('/', [CartController::class, 'clear'])->name('clear');
    });

    // COMMANDES
    Route::prefix('commandes')->name('orders.')->group(function () {
        // Liste des commandes
        Route::get('/', [OrderController::class, 'index'])->name('index');
        
        // Page de paiement/checkout
        Route::get('/commander', [OrderController::class, 'checkout'])->name('checkout');
        
        // Créer une commande
        Route::post('/', [OrderController::class, 'store'])->name('store');
        
        // Détail d'une commande
        Route::get('/{id}', [OrderController::class, 'show'])->name('show');
        
        // Annuler une commande
        Route::post('/{id}/annuler', [OrderController::class, 'cancel'])->name('cancel');
    });
});


