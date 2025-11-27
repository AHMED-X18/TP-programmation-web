@extends('layout.admin')

@section('title', 'Mon Profil')

@section('content')
<div class="profile-container">
    
    <div class="profile-header">
        <div class="profile-avatar">
            {{ strtoupper(substr($user->nom, 0, 1)) }}
        </div>
        <div class="profile-info">
            <h1>{{ $user->nom }} {{ $user->prenom }}</h1>
            <span class="admin-badge">
                <i class="fas fa-shield-alt"></i> {{ ucfirst($user->role ?? 'Administrateur') }}
            </span>
            <p style="color: #6b7280; margin-top: 5px;">{{ $user->email }}</p>
        </div>
    </div>

    <div class="profile-card form-container">
        
        <div class="section-header">
            <i class="fas fa-user-edit"></i>
            <h3>Informations Personnelles</h3>
        </div>

        <form action="{{ route('admin.profile.update') }}" method="POST">
            @csrf
            @method('PUT')

            <div class="form-grid">
                <div class="form-group">
                    <label for="nom">Nom</label>
                    <div class="input-icon">
                        <input type="text" name="nom" id="nom" value="{{ old('nom', $user->nom) }}" required>
                    </div>
                </div>

                <div class="form-group">
                    <label for="prenom">Prénom</label>
                    <div class="input-icon">
                        <input type="text" name="prenom" id="prenom" value="{{ old('prenom', $user->prenom) }}" required>
                    </div>
                </div>

                <div class="form-group">
                    <label for="email">Adresse Email</label>
                    <div class="input-icon">
                        <input type="email" name="email" id="email" value="{{ old('email', $user->email) }}" required>
                    </div>
                </div>

                <div class="form-group">
                    <label for="telephone">Téléphone</label>
                    <div class="input-icon">
                        <input type="text" name="telephone" id="telephone" value="{{ old('telephone', $user->telephone) }}">
                    </div>
                </div>

                <div class="form-group full-width">
                    <label for="adresse">Adresse complète</label>
                    <textarea name="adresse" id="adresse" rows="2">{{ old('adresse', $user->adresse) }}</textarea>
                </div>
            </div>

            <hr style="border: 0; border-top: 1px solid #f0f4ff; margin: 2rem 0;">

            <div class="section-header">
                <i class="fas fa-lock"></i>
                <h3>Sécurité</h3>
            </div>

            <div class="alert alert-info" style="display: block; margin-bottom: 1.5rem;">
                <i class="fas fa-info-circle"></i> Laissez ces champs vides si vous ne souhaitez pas changer votre mot de passe.
            </div>

            <div class="form-grid">
                <div class="form-group full-width">
                    <label for="current_password">Mot de passe actuel (pour confirmation)</label>
                    <input type="password" name="current_password" id="current_password" autocomplete="current-password">
                    @error('current_password') <span class="text-danger">{{ $message }}</span> @enderror
                </div>

                <div class="form-group">
                    <label for="new_password">Nouveau mot de passe</label>
                    <input type="password" name="new_password" id="new_password" autocomplete="new-password">
                </div>

                <div class="form-group">
                    <label for="new_password_confirmation">Confirmer le nouveau mot de passe</label>
                    <input type="password" name="new_password_confirmation" id="new_password_confirmation" autocomplete="new-password">
                </div>
            </div>

            <div class="form-actions">
                <button type="reset" class="btn btn-secondary-outline">Annuler</button>
                <button type="submit" class="btn">
                    <i class="fas fa-save"></i> Enregistrer les modifications
                </button>
            </div>
        </form>
    </div>
</div>
@endsection