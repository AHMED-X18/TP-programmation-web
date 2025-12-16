@extends('layouts.app')

@section('title', 'Mon Historique de Commandes')

@section('content')

<div class="orders-history-container">
    <h1>Historique de mes commandes</h1>

    @if($orders->isEmpty())
        <div class="empty-state">
            <i class="fa-solid fa-box-open fa-3x"></i>
            <p>Vous n'avez pas encore passé de commande.</p>
            <a href="{{ route('products.index') }}" class="btn-primary">Commencer mes achats</a>
        </div>
    @else
        <div class="orders-list">
            @foreach($orders as $order)
                <div class="order-card status-{{ strtolower(str_replace(' ', '-', $order->status)) }}">
                    <div class="order-header">
                        <div class="order-ref">
                            <strong>Commande #{{ $order->id }}</strong>
                            <span class="date">Passée le {{ $order->created_at->format('d/m/Y H:i') }}</span>
                        </div>
                        <div class="order-summary">
                            <span class="status-badge">{{ $order->status }}</span>
                            <span class="total">{{ number_format($order->total_amount, 0, ',', ' ') }} FCFA</span>
                        </div>
                    </div>

                    <div class="order-details">
                        <p class="details-title">Articles commandés :</p>
                        <ul>
                            @foreach($order->orderItems as $item)
                                <li>
                                    <span class="item-qty">{{ $item->quantity }}x</span>
                                    <span class="item-name">{{ $item->product->name }}</span>
                                    <span class="item-price">{{ number_format($item->unit_price, 0, ',', ' ') }} FCFA</span>
                                </li>
                            @endforeach
                        </ul>
                    </div>

                    <div class="order-footer">
                        <p>Livraison à : {{ $order->shipping_address ?? $order->user->address }}</p>
                        </div>
                </div>
            @endforeach
        </div>
    @endif
</div>

<style>
    /* Styles rapides pour l'historique de commandes */
    .orders-history-container { max-width: 1000px; margin: 2rem auto; padding: 0 1rem; }
    h1 { text-align: center; margin-bottom: 2.5rem; }
    .order-card { background: #fff; border: 1px solid #ddd; border-radius: 10px; margin-bottom: 20px; padding: 20px; box-shadow: 0 2px 4px rgba(0,0,0,0.05); }
    .order-header { display: flex; justify-content: space-between; border-bottom: 1px solid #eee; padding-bottom: 15px; margin-bottom: 15px; }
    .order-ref strong { font-size: 1.2rem; display: block; }
    .date { color: #888; font-size: 0.9em; }
    .status-badge { padding: 5px 10px; border-radius: 50px; font-weight: bold; font-size: 0.8em; color: white; }
    .status-en-attente { background: #ffc107; color: #333; }
    .status-en-attente-de-paiement { background: #ffc107; color: #333; }
    .status-payee { background: #28a745; }
    .total { font-size: 1.5rem; font-weight: bold; color: #4f9cf9; display: block; margin-top: 5px; }
    .order-details ul { list-style: none; padding: 0; }
    .order-details ul li { display: flex; justify-content: space-between; padding: 5px 0; border-bottom: 1px dotted #f0f0f0; }
    .item-qty { font-weight: bold; width: 30px; }
    .item-name { flex-grow: 1; }
    .item-price { color: #333; }
    .order-footer { border-top: 1px solid #eee; padding-top: 15px; margin-top: 15px; color: #666; font-size: 0.9em; }
    .empty-state { text-align: center; padding: 50px; border: 2px dashed #ccc; border-radius: 10px; color: #888; }
</style>
@endsection