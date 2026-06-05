<?php $__env->startSection('title','Commandes'); ?>
<?php $__env->startSection('page-title','Gestion des commandes'); ?>
<?php $__env->startSection('sidebar-role','Administration'); ?>
<?php $__env->startSection('sidebar-links'); ?>
<a href="<?php echo e(route('admin.dashboard')); ?>" class="sidebar-link <?php echo e(request()->routeIs('admin.dashboard') ? 'active':''); ?>">📊 Dashboard</a>
<a href="<?php echo e(route('admin.commandes')); ?>" class="sidebar-link <?php echo e(request()->routeIs('admin.commandes*') ? 'active':''); ?>">📋 Commandes <?php if(isset($badges['devis']) && $badges['devis']): ?><span class="badge-pill"><?php echo e($badges['devis']); ?></span><?php endif; ?></a>
<a href="<?php echo e(route('admin.candidatures')); ?>" class="sidebar-link <?php echo e(request()->routeIs('admin.candidatures*') ? 'active':''); ?>">👤 Candidatures <?php if(isset($badges['candidatures']) && $badges['candidatures']): ?><span class="badge-pill"><?php echo e($badges['candidatures']); ?></span><?php endif; ?></a>
<a href="<?php echo e(route('admin.messages')); ?>" class="sidebar-link <?php echo e(request()->routeIs('admin.messages*') ? 'active':''); ?>">✉️ Messages <?php if(isset($badges['messages']) && $badges['messages']): ?><span class="badge-pill"><?php echo e($badges['messages']); ?></span><?php endif; ?></a>
<a href="<?php echo e(route('admin.reclamations')); ?>" class="sidebar-link <?php echo e(request()->routeIs('admin.reclamations*') ? 'active':''); ?>">⚠️ Réclamations <?php if(isset($badges['reclamations']) && $badges['reclamations']): ?><span class="badge-pill"><?php echo e($badges['reclamations']); ?></span><?php endif; ?></a>
<a href="<?php echo e(route('admin.clients.index')); ?>" class="sidebar-link <?php echo e(request()->routeIs('admin.clients*') ? 'active':''); ?>">👥 Clients</a>
<a href="<?php echo e(route('admin.experts.index')); ?>" class="sidebar-link <?php echo e(request()->routeIs('admin.experts*') ? 'active':''); ?>">🎓 Experts</a>
<a href="<?php echo e(route('admin.users.index')); ?>" class="sidebar-link <?php echo e(request()->routeIs('admin.users*') ? 'active':''); ?>">⚙️ Administrateurs</a>
<a href="<?php echo e(route('admin.statistiques')); ?>" class="sidebar-link <?php echo e(request()->routeIs('admin.statistiques') ? 'active':''); ?>">📈 Statistiques</a>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>

<form method="GET" class="filters-bar">
    <input type="text" name="search" value="<?php echo e(request('search')); ?>" placeholder="Rechercher référence, sujet..." class="form-input filter-input">
    <select name="statut" class="form-select filter-select" onchange="this.form.submit()">
        <option value="">Tous les statuts</option>
        <?php $__currentLoopData = $statuts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $s): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <option value="<?php echo e($key); ?>" <?php echo e(request('statut') === $key ? 'selected':''); ?>><?php echo e($s['label']); ?></option>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </select>
    <button type="submit" class="btn btn-outline-navy btn-sm">Filtrer</button>
</form>

<div class="table-wrapper">
    <table class="data-table">
        <thead><tr><th>Référence</th><th>Client</th><th>Service</th><th>Expert</th><th>Montant</th><th>Statut</th><th>Date</th><th>Action</th></tr></thead>
        <tbody>
            <?php $__empty_1 = true; $__currentLoopData = $commandes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cmd): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
            <tr>
                <td><strong><?php echo e($cmd->reference); ?></strong></td>
                <td><?php echo e($cmd->client_name); ?></td>
                <td><?php echo e($cmd->service); ?></td>
                <td><?php echo e($cmd->expert?->nom_complet ?? '<span class="text-muted">Non assigné</span>'); ?></td>
                <td><?php echo e(number_format($cmd->montant, 0, ',', ' ')); ?> F</td>
                <td><span class="badge badge-<?php echo e($cmd->statut_color); ?>"><?php echo e($cmd->statut_label); ?></span></td>
                <td><?php echo e($cmd->created_at->format('d/m/Y')); ?></td>
                <td><a href="<?php echo e(route('admin.commandes.show', $cmd)); ?>" class="btn btn-outline-navy btn-xs">Gérer</a></td>
            </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
            <tr><td colspan="8" class="text-center">Aucune commande trouvée.</td></tr>
            <?php endif; ?>
        </tbody>
    </table>
    <?php echo e($commandes->links()); ?>

</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.dashboard', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\academieohada-laravel\academieohada\resources\views/admin/commandes/index.blade.php ENDPATH**/ ?>