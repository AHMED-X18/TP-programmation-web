@extends('layouts.app')

@section('title', $product->name)

@section('content')
<div class="product-page-wrapper" style="background-color: white; padding: 40px 0;">

    <div class="container" style="max-width: 1100px; margin: 0 auto; padding: 0 20px;">
        
        <a href="{{ route('products.index') }}" class="back-btn">
            <i class='bx bx-left-arrow-alt'></i> Retour à la boutique
        </a>

        <div class="product-grid-design">
            
            <div class="product-image-container">
                <img src="{{ asset('assets/' . $product->image) }}" 
                     alt="{{ $product->name }}" 
                     style="width: 100%; height: auto; object-fit: contain; border-radius: 8px;">
            </div>

            <div class="product-details-container">
                
                <h1 style="font-size: 2rem; color: #1e3a8a; font-weight: 800; margin-bottom: 10px;">
                    {{ $product->name }}
                </h1>

                <p style="font-size: 1.5rem; color: #3b82f6; font-weight: 700; margin-bottom: 15px;">
                    {{ number_format($product->price, 0, ",", " ") }} CFA
                </p>

                <p style="color: #6b7280; margin-bottom: 25px;">
                    {{ $product->category ?? 'Veste légère protection contre le vent' }}
                </p>

                <div class="details-box" style="background-color: #f8fafc; padding: 25px; border-radius: 12px; margin-bottom: 25px;">
                    
                    <p style="color: #1e3a8a; font-weight: 600; line-height: 1.5; margin-bottom: 25px;">
                        {{ $product->description }}
                    </p>

                    <form action="{{ route('cart.add', $product->id) }}" method="POST">
                        @csrf

                        <div style="margin-bottom: 20px;">
                            <label style="display: block; font-weight: 700; color: #4b5563; margin-bottom: 10px;">Tailles disponibles :</label>
                            <div class="options-grid sizes">
                                <label class="option-item">
                                    <input type="radio" name="size" value="S">
                                    <span>S</span>
                                </label>
                                <label class="option-item">
                                    <input type="radio" name="size" value="M" checked>
                                    <span>M</span>
                                </label>
                                <label class="option-item">
                                    <input type="radio" name="size" value="L">
                                    <span>L</span>
                                </label>
                                <label class="option-item">
                                    <input type="radio" name="size" value="XL">
                                    <span>XL</span>
                                </label>
                            </div>
                        </div>

                        <div style="margin-bottom: 25px;">
                            <label style="display: block; font-weight: 700; color: #4b5563; margin-bottom: 10px;">Couleurs disponibles :</label>
                            <div class="options-grid colors">
                                <label class="option-item pill">
                                    <input type="radio" name="color" value="Rouge Vif">
                                    <span>Rouge Vif</span>
                                </label>
                                <label class="option-item pill">
                                    <input type="radio" name="color" value="Bleu Ciel" checked>
                                    <span>Bleu Ciel</span>
                                </label>
                            </div>
                        </div>

                        <div style="margin-bottom: 15px;">
                            <span style="font-weight: 700; color: #4b5563;">Matériel :</span>
                            <span style="color: #1e3a8a; display: block; margin-top: 5px;">Nylon Ripstop déperlant</span>
                        </div>
                         <div>
                            <span style="font-weight: 700; color: #4b5563;">Date de fabrication :</span>
                            <span style="color: #1e3a8a; display: block; margin-top: 5px;">Mars 2024</span>
                        </div>

                </div> <input type="hidden" name="quantity" value="1">
                <button type="submit" style="width: 100%; background-color: #3b82f6; color: white; padding: 15px; border-radius: 8px; border: none; font-size: 1.1rem; font-weight: 700; cursor: pointer; display: flex; align-items: center; justify-content: center; gap: 10px; transition: background 0.3s;">
                    <i class='bx bx-cart'></i> Ajouter au panier
                </button>
                </form>

            </div>
        </div>
    </div>
</div>

<style>
    /* STYLE DU BOUTON RETOUR */
    .back-btn {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        color: #64748b; 
        text-decoration: none;
        font-weight: 600;
        margin-bottom: 30px;
        transition: color 0.3s;
        font-size: 1rem;
    }
    .back-btn:hover {
        color: #3b82f6; 
    }
    .back-btn i {
        font-size: 1.2rem;
    }

    .product-grid-design {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 60px; 
        align-items: start;
    }

    .options-grid {
        display: flex;
        flex-wrap: wrap;
        gap: 10px;
    }
    .option-item input[type="radio"] {
        display: none;
    }
    .option-item span {
        display: inline-block;
        padding: 8px 16px;
        background-color: #dbeafe; 
        color: #1e3a8a; 
        border-radius: 6px;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.2s;
        border: 2px solid transparent;
    }
    .option-item.pill span {
        border-radius: 20px;
        padding: 8px 20px;
    }
    .option-item input[type="radio"]:checked + span,
    .option-item span:hover {
        background-color: #bfdbfe;
        border-color: #3b82f6;
    }

    /* RESPONSIVE */
    @media (max-width: 900px) {
        .product-grid-design {
            grid-template-columns: 1fr;
            gap: 30px;
        }
    }
</style>
@endsection