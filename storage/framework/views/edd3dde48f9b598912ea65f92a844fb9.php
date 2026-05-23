<?php $__env->startSection('title','Mes commandes'); ?>
<?php $__env->startSection('page-title','Mes commandes'); ?>
<?php $__env->startSection('sidebar-role','Espace Client'); ?>
<?php $__env->startSection('sidebar-links'); ?>
<a href="<?php echo e(route('client.dashboard')); ?>" class="sidebar-link">🏠 Tableau de bord</a>
<a href="<?php echo e(route('client.commandes')); ?>" class="sidebar-link active">📋 Mes commandes</a>
<a href="<?php echo e(route('client.profil')); ?>" class="sidebar-link">👤 Mon profil</a>
<a href="<?php echo e(route('devis')); ?>" class="sidebar-link sidebar-cta">⚡ Nouvelle commande</a>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
<div class="table-wrapper">
    <table class="data-table">
        <thead>
            <tr><th>Référence</th><th>Service</th><th>Sujet</th><th>Montant</th><th>Statut</th><th>Date</th><th>Action</th></tr>
        </thead>
        <tbody>
            <?php $__empty_1 = true; $__currentLoopData = $commandes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cmd): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
            <tr>
                <td><strong><?php echo e($cmd->reference); ?></strong></td>
                <td><?php echo e($cmd->service); ?> <?php echo e($cmd->niveau ? "({$cmd->niveau})" : ''); ?></td>
                <td><?php echo e(Str::limit($cmd->sujet, 50)); ?></td>
                <td><?php echo e(number_format($cmd->montant, 0, ',', ' ')); ?> FCFA</td>
                <td><span class="badge badge-<?php echo e($cmd->statut_color); ?>"><?php echo e($cmd->statut_label); ?></span></td>
                <td><?php echo e($cmd->created_at->format('d/m/Y')); ?></td>
                <td><a href="<?php echo e(route('client.commandes.show', $cmd)); ?>" class="btn btn-outline-navy btn-xs">Détail</a></td>
            </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
            <tr><td colspan="7" class="text-center">Aucune commande pour le moment.</td></tr>
            <?php endif; ?>
        </tbody>
    </table>
    <?php echo e($commandes->links()); ?>

</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.dashboard', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\academieohada-laravel\academieohada\resources\views/client/commandes/index.blade.php ENDPATH**/ ?>