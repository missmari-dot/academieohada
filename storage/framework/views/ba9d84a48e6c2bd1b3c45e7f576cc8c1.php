<?php $__env->startSection('title','Mon espace'); ?>
<?php $__env->startSection('page-title','Mon tableau de bord'); ?>
<?php $__env->startSection('sidebar-role','Espace Client'); ?>

<?php $__env->startSection('sidebar-links'); ?>
<a href="<?php echo e(route('client.dashboard')); ?>" class="sidebar-link <?php echo e(request()->routeIs('client.dashboard') ? 'active' : ''); ?>">
    🏠 Tableau de bord
</a>
<a href="<?php echo e(route('client.commandes')); ?>" class="sidebar-link <?php echo e(request()->routeIs('client.commandes*') ? 'active' : ''); ?>">
    📋 Mes commandes
</a>
<a href="<?php echo e(route('client.profil')); ?>" class="sidebar-link <?php echo e(request()->routeIs('client.profil') ? 'active' : ''); ?>">
    👤 Mon profil
</a>
<a href="<?php echo e(route('devis')); ?>" class="sidebar-link sidebar-cta">
    ⚡ Nouvelle commande
</a>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<div class="dashboard-welcome">
    <h2>Bonjour <?php echo e($user->prenom); ?> 👋</h2>
    <p>Voici l'état de vos commandes</p>
</div>


<div class="stats-cards">
    <div class="stat-card"><span class="stat-card-number"><?php echo e($stats['total']); ?></span><span class="stat-card-label">Total commandes</span></div>
    <div class="stat-card stat-card-orange"><span class="stat-card-number"><?php echo e($stats['en_cours']); ?></span><span class="stat-card-label">En cours</span></div>
    <div class="stat-card stat-card-green"><span class="stat-card-number"><?php echo e($stats['livres']); ?></span><span class="stat-card-label">Livrés</span></div>
    <div class="stat-card"><span class="stat-card-number"><?php echo e($stats['en_attente']); ?></span><span class="stat-card-label">En attente</span></div>
</div>


<div class="dashboard-section">
    <div class="section-header-row">
        <h3>Commandes récentes</h3>
        <a href="<?php echo e(route('client.commandes')); ?>" class="btn btn-outline-navy btn-sm">Tout voir</a>
    </div>

    <?php $__empty_1 = true; $__currentLoopData = $recentes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cmd): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
    <div class="commande-row">
        <div class="commande-info">
            <span class="commande-ref"><?php echo e($cmd->reference); ?></span>
            <span class="commande-service"><?php echo e($cmd->service); ?> <?php echo e($cmd->niveau ? "({$cmd->niveau})" : ''); ?></span>
            <span class="commande-sujet"><?php echo e(Str::limit($cmd->sujet, 60)); ?></span>
        </div>
        <div class="commande-meta">
            <span class="badge badge-<?php echo e($cmd->statut_color); ?>"><?php echo e($cmd->statut_label); ?></span>
            <span class="commande-montant"><?php echo e(number_format($cmd->montant, 0, ',', ' ')); ?> FCFA</span>
        </div>
        <div class="commande-actions">
            <?php if($cmd->statut === 'livre' || $cmd->statut === 'cloture'): ?>
                <a href="<?php echo e(route('client.commandes.show', $cmd)); ?>" class="btn btn-green btn-sm">⬇ Télécharger</a>
            <?php else: ?>
                <a href="<?php echo e(route('client.commandes.show', $cmd)); ?>" class="btn btn-outline-navy btn-sm">Voir détail →</a>
            <?php endif; ?>
        </div>
    </div>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
    <div class="empty-state">
        <p>Vous n'avez pas encore de commande.</p>
        <a href="<?php echo e(route('devis')); ?>" class="btn btn-orange">Demander un devis →</a>
    </div>
    <?php endif; ?>
</div>


<div class="dashboard-cta">
    <div class="cta-card">
        <h4>Besoin d'un nouveau service ?</h4>
        <p>Devis gratuit sous 2h · Paiement flexible</p>
        <a href="<?php echo e(route('devis')); ?>" class="btn btn-orange">Nouvelle commande →</a>
    </div>
    <div class="cta-card">
        <h4>Une question ?</h4>
        <p>Notre équipe vous répond sur WhatsApp</p>
        <a href="https://wa.me/221775646246" target="_blank" class="btn btn-outline-navy">💬 WhatsApp</a>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.dashboard', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\academieohada-laravel\academieohada\resources\views/client/dashboard.blade.php ENDPATH**/ ?>