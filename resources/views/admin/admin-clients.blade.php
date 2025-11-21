@extends('layout.admin')

@section('title', 'Gestion des Clients')

@push('styles')
<link rel="stylesheet" href="{{ asset('css/clients.css') }}">
@endpush

{{-- CORRECTION : Le code JS est intégré ici pour ne pas avoir besoin de clients.js --}}
@push('scripts')
<script>
    /**
     * Fonction de recherche côté client pour filtrer les clients
     */
    function searchClients() {
        // 1. Récupérer la valeur de la recherche et la mettre en minuscules pour une comparaison insensible à la casse
        const input = document.getElementById('searchInput');
        const filter = input.value.toLowerCase();
        
        // 2. Récupérer toutes les lignes du corps du tableau des clients
        const tableBody = document.getElementById('clientsTableBody');
        const trs = tableBody.getElementsByTagName('tr');
        
        let visibleCount = 0;

        // 3. Parcourir toutes les lignes
        for (let i = 0; i < trs.length; i++) {
            const tr = trs[i];
            
            // Récupérer les données de nom et d'email stockées dans les attributs data-
            const nameData = tr.getAttribute('data-name') || '';
            const emailData = tr.getAttribute('data-email') || '';
            
            // Vérifier si le filtre correspond au nom ou à l'email
            if (nameData.includes(filter) || emailData.includes(filter)) {
                tr.style.display = ''; // Afficher la ligne
                visibleCount++;
            } else {
                tr.style.display = 'none'; // Cacher la ligne
            }
        }
        
        // 4. Mettre à jour le compteur de clients affichés
        const clientCountElement = document.querySelector('.client-count');
        if (clientCountElement) {
            clientCountElement.textContent = `${visibleCount} client(s) trouvé(s)`;
        }
    }

    // Fonction factice nécessaire pour le bouton "Liste"
    function setViewMode(mode) {
        // Rendre le bouton "Liste" actif (logique minimale)
        const listViewBtn = document.getElementById('listViewBtn');
        if (listViewBtn) {
            listViewBtn.classList.add('active');
        }
    }

    // Exécuter au chargement pour s'assurer que le bouton est actif
    document.addEventListener('DOMContentLoaded', function() {
        setViewMode('list'); 
    });
</script>
@endpush

@section('content')
<div class="page-header">
    <div>
        <h1>Gestion des Clients</h1>
        <p class="page-subtitle">Gérez tous vos clients</p>
    </div>
</div>

{{-- STATISTIQUES --}}
<div class="stats-grid">
    <div class="stat-card">
        <div class="stat-number">{{ $totalClients }}</div>
        <div class="stat-label">Clients total</div>
    </div>
    <div class="stat-card">
        <div class="stat-number">{{ $loyalClients->count() }}</div>
        <div class="stat-label">Clients fidèles (≥ 3 commandes)</div>
    </div>
</div>

{{-- CLIENTS FIDÈLES --}}
<div class="content-section">
    <h2 style="margin-bottom: 1.5rem; color: #1e3a8a;">Clients fidèles</h2>
    <div class="table-container">
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nom</th>
                    <th>Email</th>
                    <th>Téléphone</th>
                    <th>Commandes</th>
                    <th>Inscrit le</th>
                </tr>
            </thead>
            <tbody>
                @forelse($loyalClients as $client)
                <tr>
                    <td>#{{ $client->id }}</td>
                    <td>{{ $client->nom }} {{ $client->prenom }}</td>
                    <td>{{ $client->email }}</td>
                    <td>{{ $client->telephone ?? '—' }}</td>
                    <td>{{ $client->commandes_count }}</td>
                    {{-- FIXE: Utilisation de l'opérateur null-safe (?->) --}}
                    <td>{{ $client->created_at?->format('d/m/Y') ?? '—' }}</td> 
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="text-center">Aucun client fidèle pour le moment.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

{{-- LISTE COMPLÈTE DES CLIENTS --}}
<div class="content-section">
    <h2 style="margin-bottom: 1.5rem; color: #1e3a8a;">Liste des clients</h2>

    <div class="filters-section">
        <div class="search-box">
            <i class="fas fa-search search-icon"></i>
            {{-- Le onkeyup="searchClients()" appelle la fonction JS intégrée ci-dessus --}}
            <input type="text" id="searchInput" placeholder="Rechercher par nom ou email..." onkeyup="searchClients()">
        </div>
    </div>

    <div class="view-options">
        <button id="listViewBtn" class="btn btn-outline active" onclick="setViewMode('list')">
            <i class="fas fa-list"></i> Liste
        </button>
    </div>

    <div class="client-count">{{ $clients->count() }} client(s)</div>

    <div class="table-container">
        <table id="clientsTable">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nom</th>
                    <th>Email</th>
                    <th>Téléphone</th>
                    <th>Commandes</th>
                    <th>Inscrit le</th>
                </tr>
            </thead>
            <tbody id="clientsTableBody">
                @foreach($clients as $client)
                {{-- data-attributes sont essentiels pour la recherche JS --}}
                <tr data-name="{{ strtolower($client->nom . ' ' . $client->prenom) }}" data-email="{{ strtolower($client->email) }}">
                    <td>#{{ $client->id }}</td>
                    <td>{{ $client->nom }} {{ $client->prenom }}</td>
                    <td>{{ $client->email }}</td>
                    <td>{{ $client->telephone ?? '—' }}</td>
                    <td>{{ $client->commandes_count }}</td>
                    {{-- FIXE: Utilisation de l'opérateur null-safe (?->) --}}
                    <td>{{ $client->created_at?->format('d/m/Y') ?? '—' }}</td> 
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection