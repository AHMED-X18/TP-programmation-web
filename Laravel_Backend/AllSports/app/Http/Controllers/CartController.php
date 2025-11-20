<?php

namespace App\Http\Controllers;

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
        $user = Auth::user();
        $cartItems = $user->cartItems()->with('product')->get();
        $total = $user->cartTotal();

        return response()->json([
            'success' => true,
            'cart_items' => $cartItems,
            'total' => $total
        ]);
    }

    // Ajouter un produit au panier
    public function add(Request $request, $productId)
    {
        $request->validate([
            'quantity' => 'integer|min:1'
        ]);

        $product = Product::findOrFail($productId);
        $quantity = $request->quantity ?? 1;

        if ($product->stock < $quantity) {
            return response()->json([
                'success' => false,
                'message' => 'Stock insuffisant'
            ], 400);
        }

        $cartItem = CartItem::where('user_id', Auth::id())
            ->where('product_id', $productId)
            ->first();

        if ($cartItem) {
            $newQuantity = $cartItem->quantity + $quantity;

            if ($newQuantity > $product->stock) {
                return response()->json([
                    'success' => false,
                    'message' => 'Stock insuffisant'
                ], 400);
            }

            $cartItem->update(['quantity' => $newQuantity]);
        } else {
            CartItem::create([
                'user_id' => Auth::id(),
                'product_id' => $productId,
                'quantity' => $quantity
            ]);
        }

        return response()->json([
            'success' => true,
            'message' => 'Produit ajouté au panier'
        ], 201);
    }

    // Mettre à jour la quantité
    public function update(Request $request, $cartItemId)
    {
        $request->validate([
            'quantity' => 'required|integer'
        ]);

        $cartItem = CartItem::where('id', $cartItemId)
            ->where('user_id', Auth::id())
            ->firstOrFail();

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
                'message' => 'Article retiré du panier'
            ]);
        }

        $cartItem->update(['quantity' => $request->quantity]);
        return response()->json([
            'success' => true,
            'message' => 'Panier mis à jour'
        ]);
    }

    // Supprimer un article du panier
    public function remove($cartItemId)
    {
        $cartItem = CartItem::where('id', $cartItemId)
            ->where('user_id', Auth::id())
            ->firstOrFail();

        $cartItem->delete();
        return response()->json([
            'success' => true,
            'message' => 'Article retiré du panier'
        ]);
    }

    // Vider le panier
    public function clear()
    {
        Auth::user()->cartItems()->delete();
        return response()->json([
            'success' => true,
            'message' => 'Panier vidé'
        ]);
    }
}

