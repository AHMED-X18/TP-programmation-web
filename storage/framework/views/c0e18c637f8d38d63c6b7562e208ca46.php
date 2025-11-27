<?php $__env->startSection('title', 'Gestion des Commandes'); ?>

<?php $__env->startPush('styles'); ?>
<link rel="stylesheet" href="<?php echo e(asset('css/commandes.css')); ?>">
<?php $__env->stopPush(); ?>

<?php $__env->startPush('scripts'); ?>
<script src="<?php echo e(asset('js/commandes.js')); ?>"></script>
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>
<div class="page-header">
    <div>
        <h1>Gestion des Commandes</h1>
        <p class="page-subtitle">Suivez et traitez toutes les commandes</p>
    </div>
</div>

<div class="filters-section">
    <div class="dropdown">
        
        <button class="dropdown-btn" onclick="toggleDropdown('statusDropdown')">
            <span id="statusText">
                
                <?php
                    $currentStatus = $status ?? 'all';
                    $statusDisplay = [
                        'all' => 'Tous les statuts',
                        'en_attente' => 'En attente',
                        'payée' => 'Payée',
                        'expédiée' => 'Expédiée',
                        'livrée' => 'Livrée',
                        'annulée' => 'Annulée',
                    ][$currentStatus];
                ?>
                <?php echo e($statusDisplay); ?>

            </span>
            <i class="fas fa-chevron-down"></i>
        </button>
        <div id="statusDropdown" class="dropdown-content">
            
            <a class="dropdown-item <?php if($currentStatus == 'all'): ?> selected <?php endif; ?>" onclick="filterByStatus('all')">Tous les statuts</a>
            <a class="dropdown-item <?php if($currentStatus == 'en_attente'): ?> selected <?php endif; ?>" onclick="filterByStatus('en_attente')">En attente</a>
            <a class="dropdown-item <?php if($currentStatus == 'payée'): ?> selected <?php endif; ?>" onclick="filterByStatus('payée')">Payée</a>
            <a class="dropdown-item <?php if($currentStatus == 'expédiée'): ?> selected <?php endif; ?>" onclick="filterByStatus('expédiée')">Expédiée</a>
            <a class="dropdown-item <?php if($currentStatus == 'livrée'): ?> selected <?php endif; ?>" onclick="filterByStatus('livrée')">Livrée</a>
            <a class="dropdown-item <?php if($currentStatus == 'annulée'): ?> selected <?php endif; ?>" onclick="filterByStatus('annulée')">Annulée</a>
        </div>
    </div>
</div>

<div class="order-count">Total : <?php echo e($commandes->count()); ?> commande(s)</div>

<div class="content-section">
    <div class="table-responsive">
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Client</th>
                <th>Email</th>
                <th>Date</th>
                <th>Montant (FCFA)</th>
                <th>Statut</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody id="ordersTable">
            <?php $__empty_1 = true; $__currentLoopData = $commandes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $commande): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
            <tr data-status="<?php echo e($commande->statut); ?>">
                <td>#<?php echo e($commande->id_commande); ?></td>
                <td><?php echo e($commande->client->nom); ?> <?php echo e($commande->client->prenom); ?></td>
                <td><?php echo e($commande->client->email); ?></td>
                <td><?php echo e($commande->date_commande->format('d/m/Y H:i')); ?></td>
                <td><?php echo e(number_format($commande->montant_total)); ?></td>
                <td>
                    <form action="<?php echo e(route('admin.commandes.updateStatus', $commande->id_commande)); ?>" method="POST" style="display:inline;">
                        <?php echo csrf_field(); ?>
                        <?php echo method_field('PATCH'); ?>
                        <select name="statut" onchange="this.form.submit()" class="status-select">
                            <option value="en_attente" <?php echo e($commande->statut == 'en_attente' ? 'selected' : ''); ?>>En attente</option>
                            <option value="payée" <?php echo e($commande->statut == 'payée' ? 'selected' : ''); ?>>Payée</option>
                            <option value="expédiée" <?php echo e($commande->statut == 'expédiée' ? 'selected' : ''); ?>>Expédiée</option>
                            <option value="livrée" <?php echo e($commande->statut == 'livrée' ? 'selected' : ''); ?>>Livrée</option>
                            <option value="annulée" <?php echo e($commande->statut == 'annulée' ? 'selected' : ''); ?>>Annulée</option>
                        </select>
                    </form>
                </td>
                <td>
                    <button type="button" onclick="showOrderDetails(<?php echo e($commande->id_commande); ?>)" class="btn btn-sm">Détails</button>
                </td>
            </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
            <tr>
                <td colspan="7" class="text-center">Aucune commande trouvée.</td>
            </tr>
            <?php endif; ?>
        </tbody>
    </table>
</div>

<!-- Modal Détails Commande -->
<div class="modal" id="orderModal">
    <div class="modal-content">
        <div class="modal-header">
            <h3>Détails de la commande</h3>
            <button class="close-modal" onclick="closeModal()">×</button>
        </div>
        <div id="modalBody">
            <!-- Contenu chargé via JS -->
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layout.admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /home/fred/Documents/TP_Web/resources/views/admin/admin-commandes.blade.php ENDPATH**/ ?>