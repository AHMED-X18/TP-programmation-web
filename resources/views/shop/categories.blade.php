@extends('layouts.app')

@section('title', 'Boutique - Catégories')

@push('styles')
    @vite(['resources/css/reste.css'])
@endpush

@section('content')
<div class="section">
    <div class="container">
        <div class="text-center mb-4">
            <h1 class="section-title">Notre Boutique</h1>
            <p style="font-size: 1.125rem; color: #6b7280; max-width: 800px; margin: 0 auto;">
                Découvrez nos collections de vêtements et équipements de sport pour tous
            </p>
        </div>

        <div class="grid grid-3" style="max-width: 1200px; margin: 2rem auto;">
            <a href="{{ route('products.index', ['category' => 'Femmes']) }}" class="card" style="text-decoration: none;">
                <div class="card-image-wrapper">
                    <img src="{{ asset('/assets/ballon.jpeg') }}" alt="Femmes" class="card-image">
                </div>
                <div class="card-content">
                    <h2>Femmes</h2>
                    <p>Découvrez notre collection de vêtements et accessoires de sport pour femmes</p>
                    <div style="color: #3b82f6; font-weight: 600; display: flex; align-items: center;">
                        Découvrir
                        <span class="arrow-icon">→</span>
                    </div>
                </div>
            </a>

            <a href="{{ route('products.index', ['category' => 'Hommes']) }}" class="card" style="text-decoration: none;">
                <div class="card-image-wrapper">
                    <img src="{{ asset('/assets/godasse.jpeg') }}" alt="Hommes" class="card-image">
                </div>
                <div class="card-content">
                    <h2>Hommes</h2>
                    <p>Explorez notre gamme complète d'équipements sportifs pour hommes</p>
                    <div style="color: #3b82f6; font-weight: 600; display: flex; align-items: center;">
                        Découvrir
                        <span class="arrow-icon">→</span>
                    </div>
                </div>
            </a>

            <a href="{{ route('products.index', ['category' => 'Materiel']) }}" class="card" style="text-decoration: none;">
                <div class="card-image-wrapper">
                    <img src="{{ asset('/assets/sport.jpg') }}" alt="Matériel de Sport" class="card-image">
                </div>
                <div class="card-content">
                    <h2>Matériel de Sport</h2>
                    <p>Équipez-vous avec notre sélection de matériel de sport de qualité</p>
                    <div style="color: #3b82f6; font-weight: 600; display: flex; align-items: center;">
                        Découvrir
                        <span class="arrow-icon">→</span>
                    </div>
                </div>
            </a>
        </div>
    </div>
</div>
@endsection