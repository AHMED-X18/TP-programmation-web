@extends('layouts.app')

@section('title', 'Boutique')

@section('content')
    <div class="section-container" style="padding-top: 40px; text-align: center;">
        <h1 class="section-title">Notre Boutique</h1>
        <p class="section-subtitle">Découvrez tous nos produits et équipements</p>
    </div>

    <div class="section-container" style="text-align: center; margin-bottom: 30px;">
        <a href="{{ route('products.index') }}" class="btn-secondary" style="margin: 0 5px; padding: 8px 15px; border: 1px solid #ddd; border-radius: 20px; text-decoration: none; color: #333;">Tout</a>
        <a href="{{ route('products.index', ['category' => 'Hommes']) }}" class="btn-secondary" style="margin: 0 5px; padding: 8px 15px; border: 1px solid #ddd; border-radius: 20px; text-decoration: none; color: #333;">Hommes</a>
        <a href="{{ route('products.index', ['category' => 'Femmes']) }}" class="btn-secondary" style="margin: 0 5px; padding: 8px 15px; border: 1px solid #ddd; border-radius: 20px; text-decoration: none; color: #333;">Femmes</a>
        <a href="{{ route('products.index', ['category' => 'Materiel']) }}" class="btn-secondary" style="margin: 0 5px; padding: 8px 15px; border: 1px solid #ddd; border-radius: 20px; text-decoration: none; color: #333;">Matériel</a>
    </div>

    <section id="products" class="section products" style="padding-top: 0;">
        <div class="section-container">
            <div class="products-grid">
                @forelse($products as $product)
                    <div class="product-card">
                        <div class="product-image">
                            <div class="product-image-placeholder">
                                <a href="{{ route('products.show', $product->id) }}" style="display:contents;">
                                    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24" style="position: absolute; opacity: 0.1; width: 50%; height: 50%;">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                    </svg>
                                    <img src="{{ asset('/assets/' . $product->image) }}" alt="{{ $product->name }}" style="z-index: 1; max-width: 100%; max-height: 100%;">
                                </a>
                            </div>
                        </div>
                        <div class="product-content">
                            <div class="product-category">{{ $product->category }}</div>
                            <h3 class="product-title">{{ $product->name }}</h3>
                            <p class="product-description">{{ Str::limit($product->description, 50) }}</p>
                            <div class="product-footer">
                                <span class="product-price">{{ number_format($product->price, 0, ',', ' ') }} FCFA</span>
                                <form action="{{ route('cart.add', $product->id) }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="quantity" value="1">
                                    <button class="add-to-cart-btn">Ajouter au panier</button>
                                </form>
                            </div>
                        </div>
                    </div>
                @empty
                    <p style="text-align:center; width:100%;">Aucun produit trouvé dans cette catégorie.</p>
                @endforelse
            </div>
        </div>
    </section>
@endsection