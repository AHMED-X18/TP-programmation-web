<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    // Récupérer tous les produits
    public function index()
    {
        $products = Product::where('is_active', true)->paginate(12);
        
        return response()->json([
            'success' => true,
            'data' => $products->items(),
            'pagination' => [
                'current_page' => $products->currentPage(),
                'total_pages' => $products->lastPage(),
                'per_page' => $products->perPage(),
                'total' => $products->total()
            ]
        ], 200);
    }

    // Récupérer un produit spécifique
    public function show($id){
    
	    	$product = Product::find($id);

	    if (!$product) {
		return response()->json([
		    'success' => false,
		    'message' => 'Produit non trouvé'
		], 404);
	    }

	    return response()->json([
		'success' => true,
		'data' => $product
	    ], 200);
	}

    // Rechercher des produits
    public function search(Request $request)
    {
        $query = $request->input('query');
        
        $products = Product::where('name', 'like', "%$query%")
            ->orWhere('description', 'like', "%$query%")
            ->where('is_active', true)
            ->paginate(12);
        
        return response()->json([
            'success' => true,
            'data' => $products->items(),
            'query' => $query,
            'pagination' => [
                'current_page' => $products->currentPage(),
                'total_pages' => $products->lastPage(),
                'per_page' => $products->perPage(),
                'total' => $products->total()
            ]
        ], 200);
    }

    // Filtrer par catégorie
    public function category($category)
    {
        $products = Product::where('category', $category)
            ->where('is_active', true)
            ->paginate(12);
        
        return response()->json([
            'success' => true,
            'data' => $products->items(),
            'category' => $category,
            'pagination' => [
                'current_page' => $products->currentPage(),
                'total_pages' => $products->lastPage(),
                'per_page' => $products->perPage(),
                'total' => $products->total()
            ]
        ], 200);
    }

    // Récupérer toutes les catégories
    public function categories()
    {
        $categories = Product::where('is_active', true)
            ->distinct()
            ->pluck('category')
            ->filter();
        
        return response()->json([
            'success' => true,
            'data' => $categories
        ], 200);
    }
}

// ============================================
// 2. app/Http/Controllers/API/CartController.php
// ============================================
namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\CartItem;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    // Afficher le panier
    public function index()
    {
        $cartItems = Auth::user()->cartItems()->with('product')->get();
        $total = Auth::user()->cartTotal();
        
        return response()->json([
            'success' => true,
            'cart_items' => $cartItems,
            'total' => $total,
            'item_count' => $cartItems->sum('quantity')
        ], 200);
    }

    // Ajouter un produit au panier
    public function add(Request $request, $productId)
    {
        $product = Product::find($productId);

        if (!$product) {
            return response()->json([
                'success' => false,
                'message' => 'Produit non trouvé'
            ], 404);
        }
        
        // Vérifier le stock
        if ($product->stock < ($request->quantity ?? 1)) {
            return response()->json([
                'success' => false,
                'message' => 'Stock insuffisant'
            ], 400);
        }

        // Vérifier si le produit est déjà dans le panier
        $cartItem = CartItem::where('user_id', Auth::id())
            ->where('product_id', $productId)
            ->first();

        if ($cartItem) {
            // Mettre à jour la quantité
            $newQuantity = $cartItem->quantity + ($request->quantity ?? 1);
            
            if ($newQuantity > $product->stock) {
                return response()->json([
                    'success' => false,
                    'message' => 'Stock insuffisant'
                ], 400);
            }
            
            $cartItem->update(['quantity' => $newQuantity]);
        } else {
            // Créer un nouvel article dans le panier
            $cartItem = CartItem::create([
                'user_id' => Auth::id(),
                'product_id' => $productId,
                'quantity' => $request->quantity ?? 1
            ]);
        }

        $cartItem->load('product');

        return response()->json([
            'success' => true,
            'message' => 'Produit ajouté au panier',
            'cart_item' => $cartItem,
            'cart_total' => Auth::user()->cartTotal()
        ], 201);
    }

    // Mettre à jour la quantité
    public function update(Request $request, $cartItemId)
    {
        $request->validate([
            'quantity' => 'required|integer|min:0'
        ]);

        $cartItem = CartItem::where('id', $cartItemId)
            ->where('user_id', Auth::id())
            ->first();

        if (!$cartItem) {
            return response()->json([
                'success' => false,
                'message' => 'Article non trouvé dans le panier'
            ], 404);
        }

        $product = $cartItem->product;

        if ($request->quantity > $product->stock) {
            return response()->json([
                'success' => false,
                'message' => 'Stock insuffisant'
            ], 400);
        }

        if ($request->quantity <= 0) {
            $cartItem->delete();
            return response()->json([
                'success' => true,
                'message' => 'Article retiré du panier',
                'cart_total' => Auth::user()->cartTotal()
            ], 200);
        }

        $cartItem->update(['quantity' => $request->quantity]);
        $cartItem->load('product');

        return response()->json([
            'success' => true,
            'message' => 'Panier mis à jour',
            'cart_item' => $cartItem,
            'cart_total' => Auth::user()->cartTotal()
        ], 200);
    }

    // Supprimer un article du panier
    public function remove($cartItemId)
    {
        $cartItem = CartItem::where('id', $cartItemId)
            ->where('user_id', Auth::id())
            ->first();

        if (!$cartItem) {
            return response()->json([
                'success' => false,
                'message' => 'Article non trouvé dans le panier'
            ], 404);
        }

        $cartItem->delete();

        return response()->json([
            'success' => true,
            'message' => 'Article retiré du panier',
            'cart_total' => Auth::user()->cartTotal()
        ], 200);
    }

    // Vider le panier
    public function clear()
    {
        Auth::user()->cartItems()->delete();

        return response()->json([
            'success' => true,
            'message' => 'Panier vidé'
        ], 200);
    }
}

// ============================================
// 3. app/Http/Controllers/API/OrderController.php
// ============================================
namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    // Récupérer les commandes de l'utilisateur
    public function index()
    {
        $orders = Auth::user()->orders()
            ->orderBy('created_at', 'desc')
            ->with('orderItems.product')
            ->get();

        return response()->json([
            'success' => true,
            'data' => $orders
        ], 200);
    }

    // Créer une commande
    public function store(Request $request)
    {
        $request->validate([
            'shipping_address' => 'required|string|max:500',
            'phone' => 'required|string|max:20'
        ]);

        $cartItems = Auth::user()->cartItems()->with('product')->get();

        if ($cartItems->isEmpty()) {
            return response()->json([
                'success' => false,
                'message' => 'Votre panier est vide'
            ], 400);
        }

        DB::beginTransaction();

        try {
            // Créer la commande
            $order = Order::create([
                'user_id' => Auth::id(),
                'total_amount' => Auth::user()->cartTotal(),
                'status' => 'pending',
                'shipping_address' => $request->shipping_address,
                'phone' => $request->phone
            ]);

            // Créer les articles de la commande et déduire du stock
            foreach ($cartItems as $cartItem) {
                $product = $cartItem->product;

                // Vérifier le stock
                if ($product->stock < $cartItem->quantity) {
                    DB::rollBack();
                    return response()->json([
                        'success' => false,
                        'message' => "Stock insuffisant pour {$product->name}"
                    ], 400);
                }

                // Créer l'article de commande
                OrderItem::create([
                    'order_id' => $order->id,
                    'product_id' => $product->id,
                    'quantity' => $cartItem->quantity,
                    'unit_price' => $product->price
                ]);

                // Déduire du stock
                $product->decrement('stock', $cartItem->quantity);
            }

            // Vider le panier
            Auth::user()->cartItems()->delete();

            DB::commit();

            // Recharger avec les relations
            $order->load('orderItems.product');

            return response()->json([
                'success' => true,
                'message' => 'Commande passée avec succès',
                'data' => $order
            ], 201);

        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'success' => false,
                'message' => 'Erreur lors de la commande',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    // Afficher une commande spécifique
    public function show($id)
    {
        $order = Order::where('id', $id)
            ->where('user_id', Auth::id())
            ->with('orderItems.product')
            ->first();

        if (!$order) {
            return response()->json([
                'success' => false,
                'message' => 'Commande non trouvée'
            ], 404);
        }

        return response()->json([
            'success' => true,
            'data' => $order
        ], 200);
    }

    // Annuler une commande
    public function cancel($id)
    {
        $order = Order::where('id', $id)
            ->where('user_id', Auth::id())
            ->first();

        if (!$order) {
            return response()->json([
                'success' => false,
                'message' => 'Commande non trouvée'
            ], 404);
        }

        if ($order->status !== 'pending') {
            return response()->json([
                'success' => false,
                'message' => 'Cette commande ne peut pas être annulée'
            ], 400);
        }

        DB::beginTransaction();

        try {
            // Remettre le stock
            foreach ($order->orderItems as $item) {
                $item->product->increment('stock', $item->quantity);
            }

            // Mettre à jour le statut
            $order->update(['status' => 'cancelled']);

            DB::commit();

            return response()->json([
                'success' => true,
                'message' => 'Commande annulée avec succès',
                'data' => $order
            ], 200);

        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'success' => false,
                'message' => 'Erreur lors de l\'annulation'
            ], 500);
        }
    }
}

// ============================================
// 4. app/Http/Controllers/API/AuthController.php
// ============================================
namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    // Inscription
    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'phone' => 'nullable|string|max:20',
            'address' => 'nullable|string|max:500'
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'phone' => $request->phone,
            'address' => $request->address
        ]);

        // Créer un token pour l'utilisateur
        $token = $user->createToken('auth_token')->plainTextToken;

        return response()->json([
            'success' => true,
            'message' => 'Inscription réussie',
            'user' => $user,
            'token' => $token
        ], 201);
    }

    // Connexion
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        if (!Auth::attempt($credentials)) {
            return response()->json([
                'success' => false,
                'message' => 'Identifiants incorrects'
            ], 401);
        }

        $user = Auth::user();
        $token = $user->createToken('auth_token')->plainTextToken;

        return response()->json([
            'success' => true,
            'message' => 'Connexion réussie',
            'user' => $user,
            'token' => $token
        ], 200);
    }

    // Déconnexion
    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();

        return response()->json([
            'success' => true,
            'message' => 'Déconnexion réussie'
        ], 200);
    }

    // Obtenir l'utilisateur connecté
    public function user(Request $request)
    {
        return response()->json([
            'success' => true,
            'user' => $request->user()
        ], 200);
    }

    // Mettre à jour le profil
    public function updateProfile(Request $request)
    {
        $request->validate([
            'name' => 'sometimes|string|max:255',
            'phone' => 'sometimes|string|max:20',
            'address' => 'sometimes|string|max:500'
        ]);

        $user = Auth::user();
        $user->update($request->only(['name', 'phone', 'address']));

        return response()->json([
            'success' => true,
            'message' => 'Profil mis à jour',
            'user' => $user
        ], 200);
    }
}
