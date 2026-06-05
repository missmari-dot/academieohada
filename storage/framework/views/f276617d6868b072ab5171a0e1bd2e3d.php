<?php $__env->startSection('title','Candidatures'); ?>
<?php $__env->startSection('page-title','Candidatures experts'); ?>
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
    <select name="statut" class="form-select filter-select" onchange="this.form.submit()">
        <option value="">Tous les statuts</option>
        <option value="en_attente" <?php echo e(request('statut') === 'en_attente' ? 'selected':''); ?>>En attente</option>
        <option value="valide" <?php echo e(request('statut') === 'valide' ? 'selected':''); ?>>Validées</option>
        <option value="refuse" <?php echo e(request('statut') === 'refuse' ? 'selected':''); ?>>Refusées</option>
    </select>
</form>
<div class="table-wrapper">
    <table class="data-table">
        <thead><tr><th>Nom</th><th>Email</th><th>Spécialité</th><th>Diplôme</th><th>Expérience</th><th>Statut</th><th>Date</th><th>Action</th></tr></thead>
        <tbody>
            <?php $__empty_1 = true; $__currentLoopData = $candidatures; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $c): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
            <tr>
                <td><strong><?php echo e($c->nom_complet); ?></strong></td>
                <td><?php echo e($c->email); ?></td>
                <td><?php echo e($c->specialite); ?></td>
                <td><?php echo e($c->diplome); ?></td>
                <td><?php echo e($c->annees_experience); ?> ans</td>
                <td>
                    <?php if($c->statut === 'en_attente'): ?><span class="badge badge-orange">En attente</span>
                    <?php elseif($c->statut === 'valide'): ?><span class="badge badge-green">Validée</span>
                    <?php else: ?><span class="badge badge-gray">Refusée</span><?php endif; ?>
                </td>
                <td><?php echo e($c->created_at->format('d/m/Y')); ?></td>
                <td><a href="<?php echo e(route('admin.candidatures.show', $c)); ?>" class="btn btn-outline-navy btn-xs">Examiner</a></td>
            </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
            <tr><td colspan="8" class="text-center">Aucune candidature.</td></tr>
            <?php endif; ?>
        </tbody>
    </table>
    <?php echo e($candidatures->links()); ?>

</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.dashboard', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\academieohada-laravel\academieohada\resources\views/admin/candidatures/index.blade.php ENDPATH**/ ?>