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

// 1. Route pour AFFICHER la page (GET)
Route::get('/contact', function () {
    return view('contact');
})->name('contact');

use Illuminate\Http\Request;
use App\Services\ContactService;

Route::post('/contact', [ContactController::class, 'submit'])->name('contact.submit');
    

Route::post('/contact', function (Request $request, ContactService $contactService) {
    // 1. Validation des données
    $validated = $request->validate([
        'name'    => 'required|string|max:255',
        'email'   => 'required|email',
        'message' => 'required|string',
    ]);

    // 2. Envoi via le service
    try {
        $contactService->sendContactEmail($validated);
        return redirect()->back()->with('success', 'Votre message a bien été envoyé !');
    } catch (\Exception $e) {
        return redirect()->back()->with('error', 'Un problème est survenu, réessayez plus tard.');
    }
})->name('contact.submit');
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


Route::get('/profile/password', [ProfileController::class, 'editPassword'])->name('password.edit');
Route::put('/profile/password', [ProfileController::class, 'updatePassword'])->name('password.update');