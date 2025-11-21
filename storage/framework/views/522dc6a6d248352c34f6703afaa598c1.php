<?php $__env->startSection('title', 'Mon Profil'); ?>

<?php $__env->startPush('styles'); ?>
<link rel="stylesheet" href="<?php echo e(asset('css/admin.css')); ?>">
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>
<div class="profile-container">
    
    <div class="profile-header">
        <div class="profile-avatar-wrapper">
            <div class="profile-avatar">
                <?php echo e(strtoupper(substr($user->nom ?? 'A', 0, 1))); ?>

            </div>
        </div>
        <div class="profile-info">
            <h1><?php echo e($user->nom); ?> <?php echo e($user->prenom); ?></h1>
            <span class="badge-admin">Administrateur</span>
        </div>
    </div>

    <?php if(session('success')): ?>
        <div class="alert alert-success">
            <i class="fas fa-check-circle"></i> <?php echo e(session('success')); ?>

        </div>
    <?php endif; ?>

    <?php if($errors->any()): ?>
        <div class="alert alert-danger">
            <i class="fas fa-exclamation-triangle"></i> Veuillez corriger les erreurs dans le formulaire.
        </div>
    <?php endif; ?>

    <div class="profile-card">
        <form action="<?php echo e(route('admin.profile.update')); ?>" method="POST">
            <?php echo csrf_field(); ?>
            <?php echo method_field('PUT'); ?>

            <div class="section-header">
                <i class="fas fa-user-edit"></i>
                <h3>Informations Personnelles</h3>
            </div>
            
            <div class="form-grid">
                <div class="form-group">
                    <label for="nom">Nom</label>
                    <div class="input-icon">
                        <i class="fas fa-user"></i>
                        <input type="text" id="nom" name="nom" value="<?php echo e(old('nom', $user->nom)); ?>" required>
                    </div>
                    <?php $__errorArgs = ['nom'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <span class="text-error"><?php echo e($message); ?></span> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>

                <div class="form-group">
                    <label for="prenom">Prénom</label>
                    <div class="input-icon">
                        <i class="fas fa-user"></i>
                        <input type="text" id="prenom" name="prenom" value="<?php echo e(old('prenom', $user->prenom)); ?>" required>
                    </div>
                    <?php $__errorArgs = ['prenom'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <span class="text-error"><?php echo e($message); ?></span> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>

                <div class="form-group">
                    <label for="email">Email</label>
                    <div class="input-icon">
                        <i class="fas fa-envelope"></i>
                        <input type="email" id="email" name="email" value="<?php echo e(old('email', $user->email)); ?>" required>
                    </div>
                    <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <span class="text-error"><?php echo e($message); ?></span> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>

                <div class="form-group">
                    <label for="telephone">Téléphone</label>
                    <div class="input-icon">
                        <i class="fas fa-phone"></i>
                        <input type="text" id="telephone" name="telephone" value="<?php echo e(old('telephone', $user->telephone)); ?>">
                    </div>
                </div>
            </div>

            <div class="form-group full-width">
                <label for="adresse">Adresse</label>
                <div class="input-icon textarea-icon">
                    <i class="fas fa-map-marker-alt"></i>
                    <textarea id="adresse" name="adresse" rows="2"><?php echo e(old('adresse', $user->adresse)); ?></textarea>
                </div>
            </div>

            <div class="divider"></div>

            <div class="section-header">
                <i class="fas fa-lock"></i>
                <h3>Sécurité (Mot de passe)</h3>
            </div>
            <p class="text-muted">Remplissez uniquement pour changer de mot de passe.</p>

            <div class="form-group">
                <label for="current_password">Mot de passe actuel <span class="required">*</span></label>
                <div class="input-icon">
                    <i class="fas fa-key"></i>
                    <input type="password" id="current_password" name="current_password" placeholder="Requis pour valider les changements">
                </div>
                <?php $__errorArgs = ['current_password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <span class="text-error"><?php echo e($message); ?></span> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
            </div>

            <div class="form-grid">
                <div class="form-group">
                    <label for="new_password">Nouveau mot de passe</label>
                    <div class="input-icon">
                        <i class="fas fa-lock-open"></i>
                        <input type="password" id="new_password" name="new_password">
                    </div>
                    <?php $__errorArgs = ['new_password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <span class="text-error"><?php echo e($message); ?></span> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>

                <div class="form-group">
                    <label for="new_password_confirmation">Confirmer le nouveau</label>
                    <div class="input-icon">
                        <i class="fas fa-check-double"></i>
                        <input type="password" id="new_password_confirmation" name="new_password_confirmation">
                    </div>
                </div>
            </div>

            <div class="form-actions">
                <button type="submit" class="btn-save">
                    <i class="fas fa-save"></i> Enregistrer les modifications
                </button>
            </div>
        </form>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layout.admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /home/fred/Documents/TP_Web/resources/views/admin/profile.blade.php ENDPATH**/ ?>