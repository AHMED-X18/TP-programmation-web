@extends('layouts.app')

@section('title', 'Nos Produits')

@push('styles')
    @vite(['resources/css/reste.css'])
@endpush

@section('content')
<div class="section">
    <div class="container">
        <div class="text-center mb-4">
            <h1 class="section-title">
                @if(request('category'))
                    {{ request('category') }}
                @elseif(request('search'))
                    Résultats pour "{{ request('search') }}"
                @else
                    Tous nos produits
                @endif
            </h1>
            <a href="{{ route('products.index') }}" class="btn-secondary" style="margin-top: 10px; display:inline-block; padding: 5px 15px; border-radius: 20px; font-size: 0.9rem;">
                ← Retour aux catégories
            </a>
        </div>

        <div class="grid grid-4 products-grid">
            @forelse($products as $product)
                <div class="product-card card">
                    <div class="card-image-wrapper">
                        <a href="{{ route('products.show', $product->id) }}">
                            <img src="{{ asset('/assets/' . $product->image) }}" alt="{{ $product->name }}" class="card-image">
                        </a>
                    </div>
                    <div class="card-content">
                        <div class="product-category" style="color: #4f9cf9; font-size: 0.8rem; font-weight: bold; text-transform: uppercase;">{{ $product->category }}</div>
                        <h3 class="product-name">{{ $product->name }}</h3>
                        <p class="product-description">{{ Str::limit($product->description, 60) }}</p>
                        
                        <div style="display: flex; justify-content: space-between; align-items: center; margin-top: auto;">
                            <span class="card-price">{{ number_format($product->price, 0, ',', ' ') }} FCFA</span>
                            
                            <form action="{{ route('cart.add', $product->id) }}" method="POST">
                                @csrf
                                <input type="hidden" name="quantity" value="1">
                                <button type="submit" class="btn" style="padding: 0.5rem 1rem; font-size: 0.9rem; background-color: #4f9cf9; border:none; border-radius: 5px;">
                                    Ajouter
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            @empty
                <div style="grid-column: 1 / -1; text-align: center; padding: 40px;">
                    <p style="font-size: 1.2rem; color: #666;">Aucun produit trouvé dans cette section.</p>
                    <a href="{{ route('products.index') }}" class="btn" style="background-color: #4f9cf9; margin-top: 10px;">Voir toutes les catégories</a>
                </div>
            @endforelse
        </div>
    </div>
</div>
@endsection