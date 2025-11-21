<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
    <title><?php echo $__env->yieldContent('title', 'Tableau de Bord'); ?> - Admin AllSports</title>

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <!-- Styles globaux -->
    <link rel="stylesheet" href="<?php echo e(asset('css/admin.css')); ?>">

    <!-- Styles spécifiques à la page -->
    <?php echo $__env->yieldPushContent('styles'); ?>
</head>
<body>
    <!-- En-tête -->
    <header class="admin-header">
        <div class="header-content">
            <div class="logo-section">
                <a href="<?php echo e(route('admin.dashboard')); ?>" class="logo">AllSports</a>
                <span class="admin-badge">Admin</span>
            </div>

            <div class="header-actions">
                <a href="<?php echo e(url('/')); ?>" class="btn btn-secondary" target="_blank">
                    <i class="fas fa-external-link-alt"></i> Voir le site
                </a>

                <div class="admin-info">
    <div class="admin-avatar">
        <?php echo e(strtoupper(substr(auth()->user()->nom ?? 'A', 0, 1))); ?>

    </div>

    <div class="admin-details">
        <a href="<?php echo e(route('admin.profile.edit')); ?>" class="admin-name-link" title="Modifier mon profil">
            <?php if(Auth::check()): ?>
                <?php echo e(Auth::user()->nom); ?> <?php echo e(Auth::user()->prenom); ?>

            <?php else: ?>
                Administrateur
            <?php endif; ?>
        </a>
        
        <span class="admin-email"><?php echo e(auth()->user()->email ?? ''); ?></span>

        <div class="admin-actions-buttons">
            <a href="<?php echo e(route('admin.profile.edit')); ?>" class="btn-mini btn-mini-profile">
                <i class="fas fa-user"></i> Profil
            </a>

            <form action="<?php echo e(route('logout')); ?>" method="POST" class="logout-form-inline">
                <?php echo csrf_field(); ?>
                <button type="submit" class="btn-mini btn-mini-logout">
                    <i class="fas fa-sign-out-alt"></i> Déconnexion
                </button>
            </form>
        </div>
    </div>
</div>
            </div>
        </div>
    </header>

    <!-- Contenu principal -->
    <main class="main-content">
        <div class="container">

            <!-- === Messages Flash (Session) === -->
            <?php if(session('success')): ?>
                <div class="alert alert-success alert-dismissible">
                    <i class="fas fa-check-circle"></i> <?php echo e(session('success')); ?>

                    <button type="button" class="close">&times;</button>
                </div>
            <?php endif; ?>

            <?php if(session('error')): ?>
                <div class="alert alert-danger alert-dismissible">
                    <i class="fas fa-exclamation-triangle"></i> <?php echo e(session('error')); ?>

                    <button type="button" class="close">&times;</button>
                </div>
            <?php endif; ?>

            <?php if(session('warning')): ?>
                <div class="alert alert-warning alert-dismissible">
                    <i class="fas fa-exclamation-circle"></i> <?php echo e(session('warning')); ?>

                    <button type="button" class="close">&times;</button>
                </div>
            <?php endif; ?>

            <?php if(session('info')): ?>
                <div class="alert alert-info alert-dismissible">
                    <i class="fas fa-info-circle"></i> <?php echo e(session('info')); ?>

                    <button type="button" class="close">&times;</button>
                </div>
            <?php endif; ?>

            <!-- === Erreurs de validation (Bag $errors) === -->
            <?php if($errors->any()): ?>
                <div class="alert alert-danger alert-dismissible">
                    <i class="fas fa-times-circle"></i> <strong>Erreurs de validation :</strong>
                    <ul class="mb-0 mt-2">
                        <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <li><?php echo e($error); ?></li>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </ul>
                    <button type="button" class="close">&times;</button>
                </div>
            <?php endif; ?>

            <!-- === Conflit : Utilisateur non admin === -->
            <?php if(auth()->check() && auth()->user()->type_user !== 'admin'): ?>
                <div class="alert alert-danger alert-dismissible">
                    <i class="fas fa-ban"></i> <strong>Accès refusé</strong> : Vous n'avez pas les droits d'administrateur.
                    <button type="button" class="close">&times;</button>
                </div>
                <?php redirect()->to('/')->send(); ?>
            <?php endif; ?>

            <!-- === Contenu dynamique === -->
            <?php echo $__env->yieldContent('content'); ?>
        </div>
    </main>

    <!-- Scripts -->
    <?php echo $__env->yieldPushContent('scripts'); ?>

    <!-- Script pour fermer les alertes -->
    <script>
        document.querySelectorAll('.alert .close').forEach(btn => {
            btn.addEventListener('click', () => {
                btn.parentElement.style.opacity = '0';
                setTimeout(() => btn.parentElement.remove(), 300);
            });
        });

        // Auto-fermeture après 5 secondes
        setTimeout(() => {
            document.querySelectorAll('.alert').forEach(alert => {
                if (!alert.querySelector('.close')) {
                    alert.style.opacity = '0';
                    setTimeout(() => alert.remove(), 300);
                }
            });
        }, 5000);
    </script>
    <script src="<?php echo e(asset('js/tableau de bord.js')); ?>" defer></script>
    <?php echo $__env->yieldPushContent('scripts'); ?>
</body>
</html>
<?php /**PATH /home/fred/Documents/TP_Web/resources/views/layout/admin.blade.php ENDPATH**/ ?>