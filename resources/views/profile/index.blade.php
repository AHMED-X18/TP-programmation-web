@extends('layouts.app')

@section('title', 'Mon Profil')

@push('styles')
    @vite(['resources/css/profil.css'])
@endpush

@section('content')
<div class="profil-page-wrapper" style="max-width: 1200px; margin: 0 auto; padding: 20px;">
    <h1 style="text-align: center; margin-bottom: 30px;">Mon Profil</h1>

    @if(session('success'))
        <div style="background: #d4edda; color: #155724; padding: 15px; border-radius: 4px; margin-bottom: 20px;">
            {{ session('success') }}
        </div>
    @endif

    <section class="profil-container">
        <div class="profil-card">
            <div class="icon-wrapper"><i class="fa-solid fa-user"></i></div>
            <h2>Informations personnelles</h2>
            <p><strong>Nom :</strong> {{ $user->name }}</p>
            <p><strong>Email :</strong> {{ $user->email }}</p>
            <p><strong>Téléphone :</strong> {{ $user->phone ?? 'Non renseigné' }}</p>
            <button onclick="openModal('modal-profil')">Modifier mes informations</button>
        </div>

        <div class="profil-card">
            <div class="icon-wrapper"><i class="fa-solid fa-location-dot"></i></div>
            <h2>Adresse de livraison</h2>
            <p>{{ $user->address ?? 'Aucune adresse enregistrée' }}</p>
            <button onclick="openModal('modal-adresse')">Gérer mes adresses</button>
        </div>

        <div class="profil-card">
            <div class="icon-wrapper"><i class="fa-solid fa-gear"></i></div>
            <h2>Paramètres</h2>
            <ul style="list-style: none; padding: 0;">
                <li><a href="#">Changer le mot de passe</a></li>
                <li><a href="#">Préférences de notification</a></li>
            </ul>
        </div>
    </section>

    <section class="commandes" style="margin-top: 40px;">
        <div class="header-commandes">
            <i class="fa-solid fa-box"></i>
            <h2>Mes Commandes</h2>
        </div>

        @if($orders->isEmpty())
            <div class="no-order">
                <i class="fa-solid fa-box-open"></i>
                <p>Vous n'avez pas encore passé de commande</p>
            </div>
        @else
            <div class="orders-list">
                @foreach($orders as $order)
                    <div class="order-item" style="border: 1px solid #ddd; padding: 15px; border-radius: 8px; margin-bottom: 15px; background: white;">
                        <div style="display: flex; justify-content: space-between; border-bottom: 1px solid #eee; padding-bottom: 10px; margin-bottom: 10px;">
                            <div>
                                <strong>Commande #{{ $order->id }}</strong>
                                <br><small>{{ $order->created_at->format('d/m/Y') }}</small>
                            </div>
                            <div style="text-align: right;">
                                <span style="font-weight: bold; color: #4f9cf9;">{{ number_format($order->total_amount, 0, ',', ' ') }} FCFA</span>
                                <br><span class="badge">{{ ucfirst($order->status) }}</span>
                            </div>
                        </div>
                        <ul style="padding-left: 20px;">
                            @foreach($order->orderItems as $item)
                                <li>{{ $item->quantity }}x {{ $item->product->name }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endforeach
            </div>
        @endif
    </section>
</div>

<div id="modal-profil" class="modal" style="display:none; position: fixed; z-index: 1000; left: 0; top: 0; width: 100%; height: 100%; background-color: rgba(0,0,0,0.5);">
    <div class="modal-content" style="background-color: #fefefe; margin: 10% auto; padding: 20px; border: 1px solid #888; width: 80%; max-width: 500px; border-radius: 8px;">
        <span class="close" onclick="closeModal('modal-profil')" style="float: right; font-size: 28px; cursor: pointer;">&times;</span>
        <h2>Modifier mes informations</h2>
        <form action="{{ route('profile.update') }}" method="POST">
            @csrf
            @method('PUT')
            <label style="display:block; margin-top:10px">Nom :</label>
            <input type="text" name="name" value="{{ $user->name }}" required style="width:100%; padding:8px; margin-top:5px;">
            
            <label style="display:block; margin-top:10px">Email :</label>
            <input type="email" name="email" value="{{ $user->email }}" required style="width:100%; padding:8px; margin-top:5px;">
            
            <label style="display:block; margin-top:10px">Téléphone :</label>
            <input type="tel" name="phone" value="{{ $user->phone }}" style="width:100%; padding:8px; margin-top:5px;">
            
            <button type="submit" style="margin-top:20px; padding:10px 20px; background:#4f9cf9; color:white; border:none; border-radius:4px; cursor:pointer;">Enregistrer</button>
        </form>
    </div>
</div>

<div id="modal-adresse" class="modal" style="display:none; position: fixed; z-index: 1000; left: 0; top: 0; width: 100%; height: 100%; background-color: rgba(0,0,0,0.5);">
    <div class="modal-content" style="background-color: #fefefe; margin: 10% auto; padding: 20px; border: 1px solid #888; width: 80%; max-width: 500px; border-radius: 8px;">
        <span class="close" onclick="closeModal('modal-adresse')" style="float: right; font-size: 28px; cursor: pointer;">&times;</span>
        <h2>Modifier mon adresse</h2>
        <form action="{{ route('profile.update') }}" method="POST">
            @csrf
            @method('PUT')
            <label style="display:block; margin-top:10px">Adresse complète :</label>
            <textarea name="address" rows="4" style="width:100%; padding:8px; margin-top:5px;">{{ $user->address }}</textarea>
            
            <input type="hidden" name="name" value="{{ $user->name }}">
            <input type="hidden" name="email" value="{{ $user->email }}">
            
            <button type="submit" style="margin-top:20px; padding:10px 20px; background:#4f9cf9; color:white; border:none; border-radius:4px; cursor:pointer;">Enregistrer</button>
        </form>
    </div>
</div>

<script>
    function openModal(id) {
        document.getElementById(id).style.display = 'block';
    }
    function closeModal(id) {
        document.getElementById(id).style.display = 'none';
    }
    window.onclick = function(event) {
        if (event.target.classList.contains('modal')) {
            event.target.style.display = "none";
        }
    }
</script>
@endsection