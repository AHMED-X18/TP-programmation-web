<?php $__env->startSection('title', 'Gestion des Clients'); ?>

<?php $__env->startPush('styles'); ?>
<link rel="stylesheet" href="<?php echo e(asset('css/clients.css')); ?>">
<?php $__env->stopPush(); ?>


<?php $__env->startPush('scripts'); ?>
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
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>
<div class="page-header">
    <div>
        <h1>Gestion des Clients</h1>
        <p class="page-subtitle">Gérez tous vos clients</p>
    </div>
</div>


<div class="stats-grid">
    <div class="stat-card">
        <div class="stat-number"><?php echo e($totalClients); ?></div>
        <div class="stat-label">Clients total</div>
    </div>
    <div class="stat-card">
        <div class="stat-number"><?php echo e($loyalClients->count()); ?></div>
        <div class="stat-label">Clients fidèles (≥ 3 commandes)</div>
    </div>
</div>


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
                <?php $__empty_1 = true; $__currentLoopData = $loyalClients; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $client): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                <tr>
                    <td>#<?php echo e($client->id); ?></td>
                    <td><?php echo e($client->nom); ?> <?php echo e($client->prenom); ?></td>
                    <td><?php echo e($client->email); ?></td>
                    <td><?php echo e($client->telephone ?? '—'); ?></td>
                    <td><?php echo e($client->commandes_count); ?></td>
                    
                    <td><?php echo e($client->created_at?->format('d/m/Y') ?? '—'); ?></td> 
                </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                <tr>
                    <td colspan="6" class="text-center">Aucun client fidèle pour le moment.</td>
                </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>


<div class="content-section">
    <h2 style="margin-bottom: 1.5rem; color: #1e3a8a;">Liste des clients</h2>

    <div class="filters-section">
        <div class="search-box">
            <i class="fas fa-search search-icon"></i>
            
            <input type="text" id="searchInput" placeholder="Rechercher par nom ou email..." onkeyup="searchClients()">
        </div>
    </div>

    <div class="view-options">
        <button id="listViewBtn" class="btn btn-outline active" onclick="setViewMode('list')">
            <i class="fas fa-list"></i> Liste
        </button>
    </div>

    <div class="client-count"><?php echo e($clients->count()); ?> client(s)</div>

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
                <?php $__currentLoopData = $clients; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $client): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                
                <tr data-name="<?php echo e(strtolower($client->nom . ' ' . $client->prenom)); ?>" data-email="<?php echo e(strtolower($client->email)); ?>">
                    <td>#<?php echo e($client->id); ?></td>
                    <td><?php echo e($client->nom); ?> <?php echo e($client->prenom); ?></td>
                    <td><?php echo e($client->email); ?></td>
                    <td><?php echo e($client->telephone ?? '—'); ?></td>
                    <td><?php echo e($client->commandes_count); ?></td>
                    
                    <td><?php echo e($client->created_at?->format('d/m/Y') ?? '—'); ?></td> 
                </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </tbody>
        </table>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layout.admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /home/fred/Documents/TP_Web/resources/views/admin/admin-clients.blade.php ENDPATH**/ ?>