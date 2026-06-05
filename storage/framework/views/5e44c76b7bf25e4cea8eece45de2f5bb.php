<?php $__env->startSection('title','Clients'); ?>
<?php $__env->startSection('page-title','Gestion des clients'); ?>
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
<div class="section-header-row mb-2">
    <form method="GET" class="filters-bar" style="margin-bottom: 0;">
        <input type="text" name="search" value="<?php echo e(request('search')); ?>" placeholder="Rechercher un client..." class="form-input filter-input">
        <button type="submit" class="btn btn-outline-navy btn-sm">Rechercher</button>
    </form>
    <a href="<?php echo e(route('admin.clients.create')); ?>" class="btn btn-orange btn-sm">+ Ajouter un client</a>
</div>
<div class="table-wrapper">
    <table class="data-table">
        <thead><tr><th>Nom</th><th>Email</th><th>Pays</th><th>Établissement</th><th>Commandes</th><th>Inscrit le</th><th>Statut</th><th>Action</th></tr></thead>
        <tbody>
            <?php $__empty_1 = true; $__currentLoopData = $clients; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $c): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
            <tr>
                <td><strong><?php echo e($c->nom_complet); ?></strong></td>
                <td><?php echo e($c->email); ?></td>
                <td><?php echo e($c->pays ?? '—'); ?></td>
                <td><?php echo e($c->etablissement ?? '—'); ?></td>
                <td><?php echo e($c->commandes()->count()); ?></td>
                <td><?php echo e($c->created_at->format('d/m/Y')); ?></td>
                <td>
                    <span class="badge <?php echo e($c->actif ? 'badge-green' : 'badge-red'); ?>"><?php echo e($c->actif ? 'Actif' : 'Bloqué'); ?></span>
                </td>
                <td>
                    <div style="display: flex; gap: 5px;">
                        <a href="<?php echo e(route('admin.clients.show', $c)); ?>" class="btn btn-outline-navy btn-xs">Voir</a>
                        <a href="<?php echo e(route('admin.clients.edit', $c)); ?>" class="btn btn-outline-navy btn-xs">✏️</a>
                        <form method="POST" action="<?php echo e(route('admin.clients.toggle-bloque', $c)); ?>" onsubmit="return confirm('Voulez-vous vraiment <?php echo e($c->actif ? 'bloquer' : 'débloquer'); ?> ce client ?');">
                            <?php echo csrf_field(); ?> <?php echo method_field('PUT'); ?>
                            <button type="submit" class="btn btn-outline-navy btn-xs">
                                <?php echo e($c->actif ? '🚫' : '✅'); ?>

                            </button>
                        </form>
                        <form method="POST" action="<?php echo e(route('admin.clients.destroy', $c)); ?>" onsubmit="return confirm('Voulez-vous vraiment supprimer ce client ?');">
                            <?php echo csrf_field(); ?> <?php echo method_field('DELETE'); ?>
                            <button type="submit" class="btn btn-outline-navy btn-xs text-red">🗑️</button>
                        </form>
                    </div>
                </td>
            </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
            <tr><td colspan="7" class="text-center">Aucun client.</td></tr>
            <?php endif; ?>
        </tbody>
    </table>
    <?php echo e($clients->links()); ?>

</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.dashboard', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\academieohada-laravel\academieohada\resources\views/admin/clients/index.blade.php ENDPATH**/ ?>