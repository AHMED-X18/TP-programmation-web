<?php $__env->startSection('title', 'Mon Profil'); ?>

<?php $__env->startSection('content'); ?>
<div class="profile-container">
    
    <div class="profile-header">
        <div class="profile-avatar">
            <?php echo e(strtoupper(substr($user->nom, 0, 1))); ?>

        </div>
        <div class="profile-info">
            <h1><?php echo e($user->nom); ?> <?php echo e($user->prenom); ?></h1>
            <span class="admin-badge">
                <i class="fas fa-shield-alt"></i> <?php echo e(ucfirst($user->role ?? 'Administrateur')); ?>

            </span>
            <p style="color: #6b7280; margin-top: 5px;"><?php echo e($user->email); ?></p>
        </div>
    </div>

    <div class="profile-card form-container">
        
        <div class="section-header">
            <i class="fas fa-user-edit"></i>
            <h3>Informations Personnelles</h3>
        </div>

        <form action="<?php echo e(route('admin.profile.update')); ?>" method="POST">
            <?php echo csrf_field(); ?>
            <?php echo method_field('PUT'); ?>

            <div class="form-grid">
                <div class="form-group">
                    <label for="nom">Nom</label>
                    <div class="input-icon">
                        <input type="text" name="nom" id="nom" value="<?php echo e(old('nom', $user->nom)); ?>" required>
                    </div>
                </div>

                <div class="form-group">
                    <label for="prenom">Prénom</label>
                    <div class="input-icon">
                        <input type="text" name="prenom" id="prenom" value="<?php echo e(old('prenom', $user->prenom)); ?>" required>
                    </div>
                </div>

                <div class="form-group">
                    <label for="email">Adresse Email</label>
                    <div class="input-icon">
                        <input type="email" name="email" id="email" value="<?php echo e(old('email', $user->email)); ?>" required>
                    </div>
                </div>

                <div class="form-group">
                    <label for="telephone">Téléphone</label>
                    <div class="input-icon">
                        <input type="text" name="telephone" id="telephone" value="<?php echo e(old('telephone', $user->telephone)); ?>">
                    </div>
                </div>

                <div class="form-group full-width">
                    <label for="adresse">Adresse complète</label>
                    <textarea name="adresse" id="adresse" rows="2"><?php echo e(old('adresse', $user->adresse)); ?></textarea>
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
                    <?php $__errorArgs = ['current_password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <span class="text-danger"><?php echo e($message); ?></span> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
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
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layout.admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /home/fred/Documents/TP_Web/resources/views/admin/profile.blade.php ENDPATH**/ ?>