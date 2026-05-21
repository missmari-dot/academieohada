<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
    <title><?php echo $__env->yieldContent('title', 'Dashboard'); ?> — AcadémieOHADA</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="<?php echo e(asset('css/ohada.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('css/dashboard.css')); ?>">
    <?php echo $__env->yieldPushContent('styles'); ?>
</head>
<body class="dashboard-body">

    
    <aside class="sidebar" id="sidebar">
        <div class="sidebar-brand">
            <a href="<?php echo e(route('accueil')); ?>" class="sidebar-logo">
                <img src="<?php echo e(asset('images/logo.jpg')); ?>" alt="Logo" class="sidebar-logo-img">
                <div class="sidebar-logo-text">
                    <span class="logo-text">AcadémieRédactionOHADA</span>
                    <span class="logo-sub"><?php echo $__env->yieldContent('sidebar-role', 'Espace'); ?></span>
                </div>
            </a>
        </div>

        <nav class="sidebar-nav">
            <?php echo $__env->yieldContent('sidebar-links'); ?>
        </nav>

        <div class="sidebar-footer">
            <div class="sidebar-user">
                <img src="<?php echo e(auth()->user()->avatar_url); ?>" alt="Avatar" class="avatar-sm">
                <div>
                    <p class="sidebar-user-name"><?php echo e(auth()->user()->nom_complet); ?></p>
                    <p class="sidebar-user-role"><?php echo e(auth()->user()->getRoleNames()->first()); ?></p>
                </div>
            </div>
            <form method="POST" action="<?php echo e(route('logout')); ?>">
                <?php echo csrf_field(); ?>
                <button type="submit" class="btn-logout">Déconnexion</button>
            </form>
        </div>
    </aside>

    
    <div class="dashboard-main">
        <header class="dashboard-header">
            <button class="sidebar-toggle" onclick="document.getElementById('sidebar').classList.toggle('open')" aria-label="Menu">
                <span></span><span></span><span></span>
            </button>
            <h1 class="dashboard-title"><?php echo $__env->yieldContent('page-title', 'Dashboard'); ?></h1>
            <div class="header-actions">
                <?php echo $__env->yieldContent('header-actions'); ?>
            </div>
        </header>

        <?php if(session('success')): ?>
            <div class="alert alert-success">
                <?php echo e(session('success')); ?>

                <button onclick="this.parentElement.remove()">✕</button>
            </div>
        <?php endif; ?>
        <?php if(session('error')): ?>
            <div class="alert alert-error">
                <?php echo e(session('error')); ?>

                <button onclick="this.parentElement.remove()">✕</button>
            </div>
        <?php endif; ?>
        <?php if($errors->any()): ?>
            <div class="alert alert-error">
                <ul><?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $e): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><li><?php echo e($e); ?></li><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?></ul>
            </div>
        <?php endif; ?>

        <div class="dashboard-content">
            <?php echo $__env->yieldContent('content'); ?>
        </div>
    </div>

    <script src="<?php echo e(asset('js/ohada.js')); ?>"></script>
    <?php echo $__env->yieldPushContent('scripts'); ?>
</body>
</html>
<?php /**PATH D:\academieohada-laravel\academieohada\resources\views/layouts/dashboard.blade.php ENDPATH**/ ?>