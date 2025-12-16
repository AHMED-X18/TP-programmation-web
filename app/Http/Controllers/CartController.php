<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\CartItem; 
use App\Models\Product;

class CartController extends Controller
{
    public function index()
    {
        // Si utilisateur connecté, on prend depuis la BDD
        if (Auth::check()) {
            $cartItems = CartItem::where('user_id', Auth::id())->with('product')->get();
            $total = $cartItems->sum(function($item) {
                return $item->product->price * $item->quantity;
            });
        } 
        // Sinon panier vide (ou session si vous gérez le mixte)
        else {
            $cartItems = collect();
            $total = 0;
        }

        return view('cart.index', compact('cartItems', 'total'));
    }

    public function add(Request $request, $id)
    {
        $product = Product::findOrFail($id);
        $quantity = $request->input('quantity', 1);

        if (Auth::check()) {
            $cartItem = CartItem::where('user_id', Auth::id())
                                ->where('product_id', $id)
                                ->first();

            if ($cartItem) {
                $cartItem->quantity += $quantity;
                $cartItem->save();
            } else {
                CartItem::create([
                    'user_id' => Auth::id(),
                    'product_id' => $id,
                    'quantity' => $quantity,
                ]);
            }
            return redirect()->back()->with('success', 'Produit ajouté au panier !');
        } else {
            return redirect()->route('login')->with('error', 'Vous devez être connecté pour ajouter au panier.');
        }
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'quantity' => 'required|integer|min:1'
        ]);

        if (Auth::check()) {
            // On cherche l'article par son ID unique
            $cartItem = CartItem::where('id', $id)
                                ->where('user_id', Auth::id())
                                ->first();

            if ($cartItem) {
                $cartItem->quantity = $request->quantity;
                $cartItem->save();
                return redirect()->back()->with('success', 'Quantité mise à jour !');
            }
        }

        return redirect()->back()->with('error', 'Impossible de mettre à jour.');
    }

    public function destroy($id)
    {
        if (Auth::check()) {
            CartItem::where('id', $id)->where('user_id', Auth::id())->delete();
            return redirect()->back()->with('success', 'Article retiré du panier.');
        }
    }

    public function clear()
    {
        if (Auth::check()) {
            CartItem::where('user_id', Auth::id())->delete();
            return redirect()->back()->with('success', 'Panier vidé !');
        }
    }
}