<?php $__env->startSection('title','Réclamations'); ?>
<?php $__env->startSection('page-title','Réclamations & Suggestions'); ?>
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
<div class="table-wrapper">
    <table class="data-table">
        <thead><tr><th>Auteur</th><th>Type</th><th>Message</th><th>Statut</th><th>Date</th><th>Action</th></tr></thead>
        <tbody>
            <?php $__empty_1 = true; $__currentLoopData = $reclamations; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $r): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
            <tr>
                <td><?php echo e($r->nom_complet); ?></td>
                <td><span class="badge <?php echo e($r->type === 'reclamation' ? 'badge-red':'badge-blue'); ?>"><?php echo e(ucfirst($r->type)); ?></span></td>
                <td><?php echo e(Str::limit($r->message, 60)); ?></td>
                <td>
                    <?php if($r->statut === 'nouveau'): ?><span class="badge badge-orange">Nouveau</span>
                    <?php elseif($r->statut === 'en_traitement'): ?><span class="badge badge-blue">En traitement</span>
                    <?php else: ?><span class="badge badge-green">Résolu</span><?php endif; ?>
                </td>
                <td><?php echo e($r->created_at->format('d/m/Y')); ?></td>
                <td><a href="<?php echo e(route('admin.reclamations.show', $r)); ?>" class="btn btn-outline-navy btn-xs">Traiter</a></td>
            </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
            <tr><td colspan="6" class="text-center">Aucune réclamation.</td></tr>
            <?php endif; ?>
        </tbody>
    </table>
    <?php echo e($reclamations->links()); ?>

</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.dashboard', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\academieohada-laravel\academieohada\resources\views/admin/reclamations/index.blade.php ENDPATH**/ ?>