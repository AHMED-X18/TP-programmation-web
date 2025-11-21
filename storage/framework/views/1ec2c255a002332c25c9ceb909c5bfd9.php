<?php $__env->startSection('title', 'Tableau de Bord'); ?>

<?php $__env->startPush('styles'); ?>
<link rel="stylesheet" href="<?php echo e(asset('css/tableau de bord.css')); ?>">
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>
<div class="page-header">
    <h1>Tableau de Bord</h1>
    <p class="page-subtitle">Aperçu général de votre boutique AllSports</p>
</div>

<!-- Statistiques -->
<div class="content-section">
    <h2 style="margin-bottom: 1.5rem; color: #1e3a8a;">Statistiques Globales</h2>
    <div class="stats-grid">
        <div class="stat-card">
            <div class="stat-number"><?php echo e(number_format($totalRevenue)); ?> FCFA</div>
            <div class="stat-label">Chiffre d'affaires</div>
        </div>
        <div class="stat-card">
            <div class="stat-number"><?php echo e($totalOrders); ?></div>
            <div class="stat-label">Commandes</div>
        </div>
        <div class="stat-card">
            <div class="stat-number"><?php echo e($totalCustomers); ?></div>
            <div class="stat-label">Clients</div>
        </div>
        <div class="stat-card">
            <div class="stat-number"><?php echo e($totalProducts); ?></div>
            <div class="stat-label">Produits</div>
        </div>
    </div>
</div>

<!-- Commandes récentes -->
<div class="content-section">
    <h2 style="margin-bottom: 1rem; color: #1e3a8a;">Commandes Récentes</h2>
    <div class="table-container">
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Client</th>
                    <th>Montant</th>
                    <th>Statut</th>
                    <th>Date</th>
                </tr>
            </thead>
            <tbody>
                <?php $__empty_1 = true; $__currentLoopData = $recentOrders; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $order): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                <tr>
                    <td>#<?php echo e($order->id_commande); ?></td>
                    <td><?php echo e($order->client->nom); ?> <?php echo e($order->client->prenom); ?></td>
                    <td><?php echo e(number_format($order->montant_total)); ?> FCFA</td>
                    <td>
                        <span class="status-badge status-<?php echo e(strtolower($order->statut)); ?>">
                            <?php echo e(ucfirst(str_replace('_', ' ', $order->statut))); ?>

                        </span>
                    </td>
                    <td><?php echo e($order->date_commande->format('d/m/Y H:i')); ?></td>
                </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                <tr>
                    <td colspan="5" class="text-center">Aucune commande récente.</td>
                </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>

<!-- Alertes stock -->
<div class="content-section">
    <h2 style="margin-bottom: 1rem; color: #1e3a8a;">Alerte Stock</h2>
    <div id="stockAlerts">
        <?php $__empty_1 = true; $__currentLoopData = $lowStockProducts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
        <div class="alert alert-warning">
            <strong><?php echo e($product->nom); ?></strong> : <?php echo e($product->stock); ?> en stock
        </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
        <p>Tous les produits sont en stock.</p>
        <?php endif; ?>
    </div>
</div>

<!-- Actions rapides -->
<div class="content-section">
    <h2 style="margin-bottom: 1.5rem; color: #1e3a8a;">Actions Rapides</h2>
    <div class="quick-actions">
        <a href="<?php echo e(route('produit.index')); ?>" class="action-btn">Gestion des produits</a>
        <a href="<?php echo e(route('admin.commandes.index')); ?>" class="action-btn">Voir les commandes</a>
        <a href="<?php echo e(route('admin.clients.index')); ?>" class="action-btn">Gérer les clients</a>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layout.admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /home/fred/Documents/TP_Web/resources/views/admin/tableau de bord.blade.php ENDPATH**/ ?>