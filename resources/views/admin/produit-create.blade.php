@extends('layout.admin')
@section('title', 'Ajouter un Produit')


@section('content')
<div class="page-header">
    <div>
        <h1>Ajouter un nouveau Produit</h1>
        <p class="page-subtitle">Remplissez les informations pour ajouter un article à votre catalogue.</p>
    </div>
    {{-- Bouton de retour à la page de gestion des produits --}}
    <a href="{{ route('admin.produits.index') }}" class="btn btn-secondary">
        <i class="fas fa-arrow-left"></i> Retour à la liste
    </a>
</div>

<div class="content-section">
    {{-- Le formulaire cible la méthode store du contrôleur AdminProductController --}}
    <form action="{{ route('admin.produits.store') }}" method="POST" class="form-container">
        @csrf
        
        <div class="form-grid">
            
            {{-- Nom du produit --}}
            <div class="form-group">
                <label for="nom">Nom du Produit *</label>
                <input type="text" id="nom" name="nom" value="{{ old('nom') }}" required>
                @error('nom') <span class="text-danger">{{ $message }}</span> @enderror
            </div>

            {{-- Prix --}}
            <div class="form-group">
                <label for="prix">Prix (FCFA) *</label>
                <input type="number" id="prix" name="prix" value="{{ old('prix') }}" min="0" step="1" required>
                @error('prix') <span class="text-danger">{{ $message }}</span> @enderror
            </div>

            {{-- Catégorie --}}
            <div class="form-group">
                <label for="categorie">Catégorie *</label>
                <select id="categorie" name="categorie" required>
                    <option value="">Sélectionner une catégorie</option>
                    <option value="Femmes" {{ old('categorie') == 'Football' ? 'selected' : '' }}>Football</option>
                    <option value="Hommes" {{ old('categorie') == 'Hommes' ? 'selected' : '' }}>Hommes</option>
                    <option value="Matériel" {{ old('categorie') == 'Matériel' ? 'selected' : '' }}>Matériel</option>
                </select>
                @error('categorie') <span class="text-danger">{{ $message }}</span> @enderror
            </div>
            
            {{-- Stock --}}
            <div class="form-group">
                <label for="stock">Stock (Quantité) *</label>
                <input type="number" id="stock" name="stock" value="{{ old('stock') }}" min="0" required>
                @error('stock') <span class="text-danger">{{ $message }}</span> @enderror
            </div>
            
            {{-- Image URL (Image URL is assumed to take full width for better display) --}}
            <div class="form-group full-width">
                <label for="image_url">URL de l'Image du Produit</label>
                <input type="url" id="image_url" name="image_url" value="{{ old('image_url') }}">
                @error('image_url') <span class="text-danger">{{ $message }}</span> @enderror
            </div>

            {{-- Description (Description takes full width) --}}
            <div class="form-group full-width">
                <label for="description">Description *</label>
                <textarea id="description" name="description" rows="5" required>{{ old('description') }}</textarea>
                @error('description') <span class="text-danger">{{ $message }}</span> @enderror
            </div>

        </div>

        <div class="form-actions">
            <button type="submit" class="btn btn-primary">
                <i class="fas fa-plus"></i> Créer le Produit
            </button>
            <button type="reset" class="btn btn-secondary-outline">Annuler</button>
        </div>
    </form>
</div>
@endsection