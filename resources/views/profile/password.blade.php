@extends('layouts.app')

@section('content')
<div class="form-card" style="max-width: 500px; margin: 2rem auto; padding: 20px; background: white; border-radius: 15px; box-shadow: 0 4px 6px rgba(0,0,0,0.1);">
    <h2>Changer le mot de passe</h2>

    <form action="{{ route('password.update') }}" method="POST">
        @csrf
        @method('PUT')

        <div style="margin-bottom: 15px;">
            <label>Mot de passe actuel</label>
            <input type="password" name="current_password" required style="width: 100%; padding: 10px; border-radius: 8px; border: 1px solid #ddd;">
            @error('current_password') <span style="color: red;">{{ $message }}</span> @enderror
        </div>

        <div style="margin-bottom: 15px;">
            <label>Nouveau mot de passe</label>
            <input type="password" name="password" required style="width: 100%; padding: 10px; border-radius: 8px; border: 1px solid #ddd;">
            @error('password') <span style="color: red;">{{ $message }}</span> @enderror
        </div>

        <div style="margin-bottom: 20px;">
            <label>Confirmer le nouveau mot de passe</label>
            <input type="password" name="password_confirmation" required style="width: 100%; padding: 10px; border-radius: 8px; border: 1px solid #ddd;">
        </div>

        <button type="submit" style="background: #4f9cf9; color: white; border: none; padding: 10px 20px; border-radius: 8px; cursor: pointer; width: 100%;">
            Mettre à jour
        </button>
    </form>
</div>
@endsection