@extends('layout.admin')

@section('title', 'Mon Profil')

@push('styles')
<link rel="stylesheet" href="{{ asset('css/admin.css') }}">
@endpush

@section('content')
<div class="profile-container">
    
    <div class="profile-header">
        <div class="profile-avatar-wrapper">
            <div class="profile-avatar">
                {{ strtoupper(substr($user->nom ?? 'A', 0, 1)) }}
            </div>
        </div>
        <div class="profile-info">
            <h1>{{ $user->nom }} {{ $user->prenom }}</h1>
            <span class="badge-admin">Administrateur</span>
        </div>
    </div>

    @if(session('success'))
        <div class="alert alert-success">
            <i class="fas fa-check-circle"></i> {{ session('success') }}
        </div>
    @endif

    @if($errors->any())
        <div class="alert alert-danger">
            <i class="fas fa-exclamation-triangle"></i> Veuillez corriger les erreurs dans le formulaire.
        </div>
    @endif

    <div class="profile-card">
        <form action="{{ route('admin.profile.update') }}" method="POST">
            @csrf
            @method('PUT')

            <div class="section-header">
                <i class="fas fa-user-edit"></i>
                <h3>Informations Personnelles</h3>
            </div>
            
            <div class="form-grid">
                <div class="form-group">
                    <label for="nom">Nom</label>
                    <div class="input-icon">
                        <i class="fas fa-user"></i>
                        <input type="text" id="nom" name="nom" value="{{ old('nom', $user->nom) }}" required>
                    </div>
                    @error('nom') <span class="text-error">{{ $message }}</span> @enderror
                </div>

                <div class="form-group">
                    <label for="prenom">Prénom</label>
                    <div class="input-icon">
                        <i class="fas fa-user"></i>
                        <input type="text" id="prenom" name="prenom" value="{{ old('prenom', $user->prenom) }}" required>
                    </div>
                    @error('prenom') <span class="text-error">{{ $message }}</span> @enderror
                </div>

                <div class="form-group">
                    <label for="email">Email</label>
                    <div class="input-icon">
                        <i class="fas fa-envelope"></i>
                        <input type="email" id="email" name="email" value="{{ old('email', $user->email) }}" required>
                    </div>
                    @error('email') <span class="text-error">{{ $message }}</span> @enderror
                </div>

                <div class="form-group">
                    <label for="telephone">Téléphone</label>
                    <div class="input-icon">
                        <i class="fas fa-phone"></i>
                        <input type="text" id="telephone" name="telephone" value="{{ old('telephone', $user->telephone) }}">
                    </div>
                </div>
            </div>

            <div class="form-group full-width">
                <label for="adresse">Adresse</label>
                <div class="input-icon textarea-icon">
                    <i class="fas fa-map-marker-alt"></i>
                    <textarea id="adresse" name="adresse" rows="2">{{ old('adresse', $user->adresse) }}</textarea>
                </div>
            </div>

            <div class="divider"></div>

            <div class="section-header">
                <i class="fas fa-lock"></i>
                <h3>Sécurité (Mot de passe)</h3>
            </div>
            <p class="text-muted">Remplissez uniquement pour changer de mot de passe.</p>

            <div class="form-group">
                <label for="current_password">Mot de passe actuel <span class="required">*</span></label>
                <div class="input-icon">
                    <i class="fas fa-key"></i>
                    <input type="password" id="current_password" name="current_password" placeholder="Requis pour valider les changements">
                </div>
                @error('current_password') <span class="text-error">{{ $message }}</span> @enderror
            </div>

            <div class="form-grid">
                <div class="form-group">
                    <label for="new_password">Nouveau mot de passe</label>
                    <div class="input-icon">
                        <i class="fas fa-lock-open"></i>
                        <input type="password" id="new_password" name="new_password">
                    </div>
                    @error('new_password') <span class="text-error">{{ $message }}</span> @enderror
                </div>

                <div class="form-group">
                    <label for="new_password_confirmation">Confirmer le nouveau</label>
                    <div class="input-icon">
                        <i class="fas fa-check-double"></i>
                        <input type="password" id="new_password_confirmation" name="new_password_confirmation">
                    </div>
                </div>
            </div>

            <div class="form-actions">
                <button type="submit" class="btn-save">
                    <i class="fas fa-save"></i> Enregistrer les modifications
                </button>
            </div>
        </form>
    </div>
</div>
@endsection