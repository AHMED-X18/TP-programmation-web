<?php

use Illuminate\Support\Facades\Route; // N'oubliez pas cet import souvent utile
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\OrderController;

/*
|--------------------------------------------------------------------------
| Routes Publiques (Accessibles à tous)
|--------------------------------------------------------------------------
*/

Route::get('/', [ProductController::class, 'index'])->name('home');

Route::get('/boutique', [ProductController::class, 'shop'])->name('products.index');

Route::get('/produits/{id}', [ProductController::class, 'show'])->name('products.show');


/*
|--------------------------------------------------------------------------
| Routes Authentification (Connexion / Inscription)
|--------------------------------------------------------------------------
*/
Route::middleware('guest')->group(function () {
    Route::get('/connexion', [LoginController::class, 'showLoginForm'])->name('login');
    Route::post('/connexion', [LoginController::class, 'login']);

    Route::post('/inscription', [RegisterController::class, 'register'])->name('register');
    
    Route::get('/inscription', function () {
        return redirect()->route('login');
    });
});

Route::view('/contact', 'contact')->name('contact');

Route::post('/deconnexion', [LoginController::class, 'logout'])->name('logout');

/*
|--------------------------------------------------------------------------
| Routes Profil (Protégées)
|--------------------------------------------------------------------------
*/
Route::middleware('auth')->group(function () {
    Route::get('/profil', [ProfileController::class, 'index'])->name('profile.index');
    
    Route::put('/profil', [ProfileController::class, 'update'])->name('profile.update');
    // === ROUTES COMMANDES ===
    
    Route::get('/commande/validation', [OrderController::class, 'create'])->name('orders.create');

    Route::post('/commande', [OrderController::class, 'store'])->name('orders.store');
    
    Route::get('/commande/merci/{id}', [OrderController::class, 'success'])->name('orders.success');
});

/*
|--------------------------------------------------------------------------
| Routes Panier
|--------------------------------------------------------------------------
*/
Route::get('/panier', [CartController::class, 'index'])->name('cart.index');

Route::post('/panier/vider', [CartController::class, 'clear'])->name('cart.clear');

Route::post('/panier/ajouter/{id}', [CartController::class, 'add'])->name('cart.add');
Route::patch('/panier/update/{id}', [CartController::class, 'update'])->name('cart.update');
Route::delete('/panier/{id}', [CartController::class, 'destroy'])->name('cart.destroy');