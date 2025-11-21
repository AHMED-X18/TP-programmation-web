<?php $__env->startSection('title', 'Ajouter un Produit'); ?>


<?php $__env->startSection('content'); ?>
<div class="page-header">
    <div>
        <h1>Ajouter un nouveau Produit</h1>
        <p class="page-subtitle">Remplissez les informations pour ajouter un article à votre catalogue.</p>
    </div>
    
    <a href="<?php echo e(route('admin.produits.index')); ?>" class="btn btn-secondary">
        <i class="fas fa-arrow-left"></i> Retour à la liste
    </a>
</div>

<div class="content-section">
    
    <form action="<?php echo e(route('admin.produits.store')); ?>" method="POST" class="form-container">
        <?php echo csrf_field(); ?>
        
        <div class="form-grid">
            
            
            <div class="form-group">
                <label for="nom">Nom du Produit *</label>
                <input type="text" id="nom" name="nom" value="<?php echo e(old('nom')); ?>" required>
                <?php $__errorArgs = ['nom'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <span class="text-danger"><?php echo e($message); ?></span> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
            </div>

            
            <div class="form-group">
                <label for="prix">Prix (FCFA) *</label>
                <input type="number" id="prix" name="prix" value="<?php echo e(old('prix')); ?>" min="0" step="1" required>
                <?php $__errorArgs = ['prix'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <span class="text-danger"><?php echo e($message); ?></span> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
            </div>

            
            <div class="form-group">
                <label for="categorie">Catégorie *</label>
                <select id="categorie" name="categorie" required>
                    <option value="">Sélectionner une catégorie</option>
                    <option value="Femmes" <?php echo e(old('categorie') == 'Football' ? 'selected' : ''); ?>>Football</option>
                    <option value="Hommes" <?php echo e(old('categorie') == 'Hommes' ? 'selected' : ''); ?>>Hommes</option>
                    <option value="Matériel" <?php echo e(old('categorie') == 'Matériel' ? 'selected' : ''); ?>>Matériel</option>
                </select>
                <?php $__errorArgs = ['categorie'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <span class="text-danger"><?php echo e($message); ?></span> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
            </div>
            
            
            <div class="form-group">
                <label for="stock">Stock (Quantité) *</label>
                <input type="number" id="stock" name="stock" value="<?php echo e(old('stock')); ?>" min="0" required>
                <?php $__errorArgs = ['stock'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <span class="text-danger"><?php echo e($message); ?></span> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
            </div>
            
            
            <div class="form-group full-width">
                <label for="image_url">URL de l'Image du Produit</label>
                <input type="url" id="image_url" name="image_url" value="<?php echo e(old('image_url')); ?>">
                <?php $__errorArgs = ['image_url'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <span class="text-danger"><?php echo e($message); ?></span> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
            </div>

            
            <div class="form-group full-width">
                <label for="description">Description *</label>
                <textarea id="description" name="description" rows="5" required><?php echo e(old('description')); ?></textarea>
                <?php $__errorArgs = ['description'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <span class="text-danger"><?php echo e($message); ?></span> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
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
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layout.admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /home/fred/Documents/TP_Web/resources/views/admin/produit-create.blade.php ENDPATH**/ ?>