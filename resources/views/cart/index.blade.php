@extends('layouts.app')

@section('title', 'Mon Panier')

@push('styles')
    @vite(['resources/css/panier.css'])
@endpush

@section('content')
<main>
    <h1 class="page-title">Panier</h1>

    @if(session('success'))
        <div style="background: #d4edda; color: #155724; padding: 10px; margin-bottom: 20px; border-radius: 8px; text-align: center;">
            {{ session('success') }}
        </div>
    @endif

    @if($cartItems->isEmpty())
        <div class="empty-cart" style="display: block; text-align: center; padding: 50px;">
            <div class="cart-icon" style="font-size: 3rem; margin-bottom: 20px; color: #ccc;"><i class="fas fa-shopping-cart"></i></div>
            <h2>Votre panier est vide</h2>
            <a href="{{ route('products.index') }}" class="btn-primary" style="display: inline-block; margin-top: 20px; padding: 10px 20px; background: #007bff; color: white; text-decoration: none; border-radius: 5px;">Continuer mes achats</a>
        </div>
    @else
        <div class="cart-content">
            
            <div class="cart-items">
                @foreach($cartItems as $item)
                <div class="cart-item" style="display: flex; gap: 20px; margin-bottom: 20px; background: white; padding: 15px; border-radius: 8px; box-shadow: 0 2px 5px rgba(0,0,0,0.05);">
                    <div class="item-image" style="width: 100px; height: 100px; background-image: url('{{ asset('/assets/' . $item->product->image) }}'); background-size: cover; background-position: center; border-radius: 8px;"></div>
                    
                    <div class="item-details" style="flex: 1;">
                        <h3 class="item-name" style="margin: 0 0 5px;">{{ $item->product->name }}</h3>
                        <p class="item-price" style="color: #666; font-weight: bold;">{{ number_format($item->product->price, 0, ',', ' ') }} FCFA</p>
                        
                        <div style="display: flex; align-items: center; gap: 1rem; margin-top: 1rem;">
                            
                            <form action="{{ route('cart.update', $item->id) }}" method="POST">
                                @csrf 
                                @method('PATCH')
                                
                                <div style="display: flex; align-items: center; border: 1px solid #ddd; border-radius: 5px;">
                                    <button type="button" onclick="updateQty(this, -1)" style="border: none; background: #f8f9fa; padding: 5px 10px; cursor: pointer;">-</button>
                                    
                                    <input type="number" name="quantity" value="{{ $item->quantity }}" readonly style="width: 40px; text-align: center; border: none; outline: none;">
                                    
                                    <button type="button" onclick="updateQty(this, 1)" style="border: none; background: #f8f9fa; padding: 5px 10px; cursor: pointer;">+</button>
                                </div>
                            </form>
                            
                            <form action="{{ route('cart.destroy', $item->id) }}" method="POST">
                                @csrf @method('DELETE')
                                <button type="submit" class="remove-btn" style="background: none; border: none; color: #dc3545; cursor: pointer; display: flex; align-items: center; gap: 5px;">
                                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="3 6 5 6 21 6"></polyline><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path></svg>
                                    Supprimer
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>

            @php
                // Assurez-vous que $total est passé par le contrôleur, sinon on le calcule ici si nécessaire
                $subtotal = isset($total) ? $total : $cartItems->sum(function($item) { return $item->product->price * $item->quantity; });
                $shipping = $subtotal > 50000 ? 0 : 2000;
                $finalTotal = $subtotal + $shipping;
            @endphp

            <div class="cart-summary" style="background: white; padding: 20px; border-radius: 8px; height: fit-content; box-shadow: 0 2px 5px rgba(0,0,0,0.05);">
                <h2 class="summary-title" style="margin-top: 0;">Récapitulatif</h2>
                
                <div class="summary-row" style="display: flex; justify-content: space-between; margin-bottom: 10px;">
                    <span>Sous-total</span>
                    <span id="subtotal">{{ number_format($subtotal, 0, ',', ' ') }} FCFA</span>
                </div>
                <div class="summary-row" style="display: flex; justify-content: space-between; margin-bottom: 10px;">
                    <span>Livraison</span>
                    <span id="shipping">{{ $shipping == 0 ? 'Gratuite' : number_format($shipping, 0, ',', ' ') . ' FCFA' }}</span>
                </div>
                
                <div class="summary-total" style="display: flex; justify-content: space-between; margin-top: 20px; font-weight: bold; font-size: 1.2rem; border-top: 1px solid #eee; padding-top: 20px;">
                    <span>Total</span>
                    <span id="total">{{ number_format($finalTotal, 0, ',', ' ') }} FCFA</span>
                </div>
                
                <form action="{{ route('orders.store') }}" method="POST">
                    @csrf
                    <button class="btn-primary" type="submit" style="width: 100%; margin-top: 1.5rem; background: #007bff; color: white; padding: 10px; border: none; border-radius: 5px; cursor: pointer;">
                        Valider le panier
                    </button>
                </form>
                
               <form action="{{ route('cart.clear') }}" method="POST" onsubmit="return confirm('Êtes-vous sûr de vouloir vider tout le panier ?');" style="margin-top: 10px;">
                    @csrf
                    <button type="submit" class="btn-danger" style="width: 100%; background-color: #ef4444; color: white; padding: 10px; border: none; border-radius: 5px; cursor: pointer;">
                        <i class='bx bx-trash'></i> Vider le panier
                    </button>
                </form>
            </div>
        </div>
    @endif
</main>

<script>
    function updateQty(btn, change) {
        // Débogage : Affiche un message dans la console (F12) quand on clique
        console.log("Bouton cliqué : " + change);

        // 1. On trouve l'input qui est à côté du bouton cliqué
        const input = btn.parentElement.querySelector('input[name="quantity"]');
        
        // 2. Calcul de la nouvelle valeur
        let newValue = parseInt(input.value) + change;
        
        // 3. On empêche d'aller en dessous de 1
        if (newValue < 1) return;

        // 4. On change le chiffre visuellement
        input.value = newValue;

        // 5. On envoie le formulaire
        btn.closest('form').submit();
    }
</script>
@endsection