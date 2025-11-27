<?php $__env->startSection('title', 'Gestion des Produits'); ?>

<?php $__env->startPush('styles'); ?>
<link rel="stylesheet" href="<?php echo e(asset('css/produits.css')); ?>">
<?php $__env->stopPush(); ?>




<?php $__env->startSection('content'); ?>
<div class="page-header">
    <div>
        <h1>Gestion des Produits</h1>
        <p class="page-subtitle">Gérez votre catalogue AllSports</p>
    </div>
    <a href="<?php echo e(route('admin.produits.create')); ?>" class="btn">Ajouter un produit</a>
</div>

<div class="content-section">
    <div class="table-responsive">
    <h2 style="margin-bottom: 1.5rem; color: #1e3a8a;">Liste des produits</h2>

    <div class="filters-section">
        <input type="text" id="searchInput" placeholder="Rechercher des produits...">

        <select id="categorieFilter" data-column-index="2">
            <option value="all">Toutes les catégories</option>
            <option value="Football">Football</option>
            <option value="Basketball">Basketball</option>
            <option value="Tennis">Tennis</option>
            <option value="Accessoires">Accessoires</option>
            <option value="Smartphones">Smartphones</option>    

        </select>
    </div>

    <div class="product-count" id="productCount">
        <?php echo e($produits->count()); ?> produit(s)
    </div>

    <table id="produits-table">
        <thead>
            <tr>
                <th>Image</th>
                <th>Nom</th>
                <th>Catégorie</th> 
                <th>Prix</th>
                <th>Stock</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody id="productsTableBody">
            <?php $__currentLoopData = $produits; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $produit): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <tr data-category="<?php echo e($produit->categorie ?? ''); ?>">
                <td>
                    <?php if($produit->image_url): ?>
                        <img src="<?php echo e($produit->image_url); ?>" alt="<?php echo e($produit->nom); ?>" style="width: 50px; height: 50px; object-fit: cover; border-radius: 4px;">
                    <?php else: ?>
                        <span style="color: #999;">—</span>
                    <?php endif; ?>
                </td>
                <td><?php echo e($produit->nom); ?></td>
                <td><?php echo e($produit->categorie ?? '—'); ?></td>
                <td><?php echo e(number_format($produit->prix)); ?> FCFA</td>
                <td class="<?php echo e($produit->stock <= 0 ? 'text-danger' : ($produit->stock <= 10 ? 'text-warning' : '')); ?>">
                    <?php echo e($produit->stock); ?>

                </td>
                <td>
                    <form action="<?php echo e(route('admin.produits.destroy', $produit->id_produit)); ?>"
                          method="POST" style="display:inline;" class="delete-form">
                        <?php echo csrf_field(); ?>
                        <?php echo method_field('DELETE'); ?>
                        <button type="submit" class="btn btn-danger btn-sm"
                                onclick="return confirm('Supprimer ce produit ?')">
                            Supprimer
                        </button>
                    </form>
                </td>
            </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </tbody>
    </table>

    <div id="noResults" class="text-center text-muted" style="display: none; margin-top: 1rem;">
        Aucun produit trouvé.
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layout.admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /home/fred/Documents/TP_Web/resources/views/admin/gestion-produits.blade.php ENDPATH**/ ?>