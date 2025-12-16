@extends('layouts.app')

@section('title', 'Accueil')

@section('content')
    <section class="hero" style="
        position: relative;
        min-height: 80vh;
        width: 100%;
        display: flex;
        align-items: center;
        justify-content: center;
        text-align: center;
        color: white;
        background-color: #1f2937;
        background-image: linear-gradient(rgba(0, 0, 100, 0.6), rgba(0, 0, 100, 0.6)), url('{{ asset('/assets/sport.jpg') }}');
        background-size: cover;
        background-position: center;
        background-repeat: no-repeat;
    ">
        <div class="hero-container" style="
            position: relative;
            z-index: 10;
            max-width: 800px;
            padding: 20px;
        ">
            <h1 style="
                font-size: 3rem;
                font-weight: 800;
                margin-bottom: 20px;
                text-transform: uppercase;
                text-shadow: 2px 2px 4px rgba(0,0,0,0.7);
            ">
                Équipez-vous pour l'Excellence
            </h1>
            
            <p style="
                font-size: 1.25rem;
                margin-bottom: 30px;
                text-shadow: 1px 1px 2px rgba(0,0,0,0.7);
            ">
                Découvrez notre collection premium de vêtements et équipements de sport.
            </p>
            
            <a href="{{ route('products.index') }}" style="text-decoration: none;">
                <button style="
                    background-color: #4f9cf9;
                    color: white;
                    padding: 15px 40px;
                    border: none;
                    border-radius: 50px;
                    font-size: 1.1rem;
                    font-weight: bold;
                    cursor: pointer;
                    box-shadow: 0 4px 6px rgba(0,0,0,0.3);
                ">
                    Explorer la Collection
                </button>
            </a>
        </div>
    </section>

    <section class="trust-section">
        <div class="section-container">
            <div class="trust-grid">
                <div class="trust-item">
                    <div class="trust-icon">
                        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                        </svg>
                    </div>
                    <h3>Livraison Rapide</h3>
                    <p>Expédition sous 24h<br>Livraison gratuite dès 32 800 FCFA</p>
                </div>
                <div class="trust-item">
                    <div class="trust-icon">
                        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
                        </svg>
                    </div>
                    <h3>Paiement Sécurisé</h3>
                    <p>Transactions cryptées SSL<br>Tous moyens de paiement</p>
                </div>
                <div class="trust-item">
                    <div class="trust-icon">
                        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                    <h3>Qualité Garantie</h3>
                    <p>Produits certifiés<br>Garantie 2 ans minimum</p>
                </div>
                <div class="trust-item">
                    <div class="trust-icon">
                        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18.364 5.636l-3.536 3.536m0 5.656l3.536 3.536M9.172 9.172L5.636 5.636m3.536 9.192L5.636 18.364M12 2v20M2 12h20"></path>
                        </svg>
                    </div>
                    <h3>Support 7j/7</h3>
                    <p>Équipe dédiée disponible<br>Réponse sous 2h garantie</p>
                </div>
            </div>
        </div>
    </section>

    <section class="section categories">
        <div class="section-container">
            <h2 class="section-title">Nos Catégories</h2>
            <p class="section-subtitle">Trouvez l'équipement parfait pour votre sport favori</p>
            <div class="categories-grid">
                <a href="{{ route('products.index', ['category' => 'Hommes']) }}" class="category-card" style="text-decoration: none; color: inherit;">
                    <div class="category-icon">
                        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path>
                        </svg>
                    </div>
                    <h3>Vêtements de Sport</h3>
                    <p>T-shirts techniques, shorts, leggings et vestes pour tous vos entraînements</p>
                </a>

                <a href="{{ route('products.index', ['category' => 'Femmes']) }}" class="category-card" style="text-decoration: none; color: inherit;">
                    <div class="category-icon">
                        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                        </svg>
                    </div>
                    <h3>Chaussures Performance</h3>
                    <p>Running, training, basketball - la technologie au service de vos performances</p>
                </a>

                <a href="{{ route('products.index', ['category' => 'Materiel']) }}" class="category-card" style="text-decoration: none; color: inherit;">
                    <div class="category-icon">
                        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z"></path>
                        </svg>
                    </div>
                    <h3>Équipements & Accessoires</h3>
                    <p>Sacs, gourdes, montres connectées et tout l'équipement pour vos activités</p>
                </a>
            </div>
        </div>
    </section>

    <section id="products" class="section products">
        <div class="section-container">
            <h2 class="section-title">Produits Populaires</h2>
            <p class="section-subtitle">Les favoris de nos clients pour des performances optimales</p>
            <div class="products-grid">
                @forelse($products as $product)
                    <div class="product-card">
                        
                        <div class="product-image">
                            <div class="product-image-placeholder">
                                <a href="{{ route('products.show', $product->id) }}" style="display:block; width:100%; height:100%;">
                                    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24" style="position: absolute; opacity: 0.1; width: 50%; height: 50%; top: 25%; left: 25%;">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                    </svg>
                                    <img src="{{ asset('/assets/' . $product->image) }}" alt="{{ $product->name }}" style="position: relative; z-index: 1; width: 100%; height: 100%; object-fit: cover;">
                                </a>
                            </div>
                        </div>

                        <div class="product-content">
                            <div class="product-category">{{ $product->category }}</div>
                            
                            <a href="{{ route('products.show', $product->id) }}" style="text-decoration: none; color: inherit;">
                                <h3 class="product-title">{{ $product->name }}</h3>
                            </a>

                            <p class="product-description">{{ Str::limit($product->description, 50) }}</p>
                            
                            <div class="product-footer">
<span class="product-price">{{ number_format($product->price) }} FCFA</span>                                
                                <form action="{{ route('cart.add', $product->id) }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="quantity" value="1">
                                    <button class="add-to-cart-btn">Ajouter au panier</button>
                                </form>
                            </div>
                        </div>
                    </div>
                @empty
                    <p style="text-align:center; width:100%;">Aucun produit disponible.</p>
                @endforelse
            </div>
        </div>
    </section>

    <section class="newsletter">
        <div class="newsletter-container">
            <h2>Restez dans la Course</h2>
            <p>Recevez en exclusivité nos nouveautés, conseils d'experts et offres spéciales</p>
            <form class="newsletter-form">
                <label for="newsletter-email" class="sr-only">Adresse email</label>
                <input type="email" id="newsletter-email" placeholder="Votre adresse email" class="newsletter-input" required>
                <button type="submit" class="newsletter-btn">S'abonner</button>
            </form>
        </div>
    </section>
@endsection