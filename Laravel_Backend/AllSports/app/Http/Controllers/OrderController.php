<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    // Afficher le formulaire de commande
    public function checkout()
    {
        $cartItems = Auth::user()->cartItems()->with('product')->get();
        
        if ($cartItems->isEmpty()) {
            return redirect()->route('cart.index')
                ->with('error', 'Votre panier est vide');
        }

        $total = Auth::user()->cartTotal();
        return view('orders.checkout', compact('cartItems', 'total'));
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
            return redirect()->route('cart.index')
                ->with('error', 'Votre panier est vide');
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
                    return back()->with('error', "Stock insuffisant pour {$product->name}");
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

            return redirect()->route('orders.show', $order->id)
                ->with('success', 'Commande passée avec succès');

        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Erreur lors de la commande');
        }
    }

    // Afficher les commandes de l'utilisateur
    public function index()
    {
        $orders = Auth::user()->orders()->orderBy('created_at', 'desc')->get();
        return view('orders.index', compact('orders'));
    }

    // Afficher une commande spécifique
    public function show($id)
    {
        $order = Order::where('id', $id)
            ->where('user_id', Auth::id())
            ->with('orderItems.product')
            ->firstOrFail();

        return view('orders.show', compact('order'));
    }

    // Annuler une commande
    public function cancel($id)
    {
        $order = Order::where('id', $id)
            ->where('user_id', Auth::id())
            ->firstOrFail();

        if ($order->status !== 'pending') {
            return back()->with('error', 'Cette commande ne peut pas être annulée');
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

            return back()->with('success', 'Commande annulée avec succès');

        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Erreur lors de l\'annulation');
        }
    }
}
