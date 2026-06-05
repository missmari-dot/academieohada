<?php $__env->startSection('title','Administration'); ?>
<?php $__env->startSection('page-title','Dashboard Admin'); ?>
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


<div class="stats-cards stats-cards-4">
    <div class="stat-card"><span class="stat-card-number"><?php echo e($stats['commandes']); ?></span><span class="stat-card-label">Commandes totales</span></div>
    <div class="stat-card"><span class="stat-card-number"><?php echo e($stats['clients']); ?></span><span class="stat-card-label">Clients inscrits</span></div>
    <div class="stat-card stat-card-green"><span class="stat-card-number"><?php echo e($stats['experts_actifs']); ?></span><span class="stat-card-label">Experts actifs</span></div>
    <div class="stat-card <?php echo e($stats['a_traiter'] > 0 ? 'stat-card-red' : ''); ?>"><span class="stat-card-number"><?php echo e($stats['a_traiter']); ?></span><span class="stat-card-label">À traiter 🔴</span></div>
</div>


<?php if($notifications->count()): ?>
<div class="dashboard-section">
    <div class="section-header-row">
        <h3>🔔 Notifications récentes</h3>
        <form method="POST" action="<?php echo e(route('admin.notifications.lire-tout')); ?>">
            <?php echo csrf_field(); ?>
            <button type="submit" class="btn btn-outline-navy btn-xs">Tout marquer lu</button>
        </form>
    </div>
    <?php $__currentLoopData = $notifications; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $notif): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    <a href="<?php echo e($notif->lien ?: '#'); ?>" class="notif-row <?php echo e(!$notif->lu ? 'notif-unread' : ''); ?>">
        <span class="notif-type notif-<?php echo e($notif->type); ?>">
            <?php switch($notif->type):
                case ('devis'): ?> 📋 <?php break; ?>
                <?php case ('message'): ?> ✉️ <?php break; ?>
                <?php case ('candidature'): ?> 👤 <?php break; ?>
                <?php case ('reclamation'): ?> ⚠️ <?php break; ?>
                <?php case ('client'): ?> 🧑 <?php break; ?>
                <?php default: ?> 🔔
            <?php endswitch; ?>
        </span>
        <div class="notif-content">
            <strong><?php echo e($notif->titre); ?></strong>
            <p><?php echo e($notif->contenu); ?></p>
        </div>
        <span class="notif-time"><?php echo e($notif->created_at->diffForHumans()); ?></span>
    </a>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
</div>
<?php endif; ?>


<div class="dashboard-section">
    <div class="section-header-row">
        <h3>📋 Dernières commandes</h3>
        <a href="<?php echo e(route('admin.commandes')); ?>" class="btn btn-outline-navy btn-sm">Tout voir</a>
    </div>
    <div class="table-wrapper">
        <table class="data-table">
            <thead><tr><th>Réf.</th><th>Client</th><th>Service</th><th>Montant</th><th>Statut</th><th>Date</th><th>Action</th></tr></thead>
            <tbody>
                <?php $__currentLoopData = $commandes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cmd): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <tr>
                    <td><strong><?php echo e($cmd->reference); ?></strong></td>
                    <td><?php echo e($cmd->client_name); ?></td>
                    <td><?php echo e($cmd->service); ?></td>
                    <td><?php echo e(number_format($cmd->montant, 0, ',', ' ')); ?> F</td>
                    <td><span class="badge badge-<?php echo e($cmd->statut_color); ?>"><?php echo e($cmd->statut_label); ?></span></td>
                    <td><?php echo e($cmd->created_at->format('d/m/Y')); ?></td>
                    <td><a href="<?php echo e(route('admin.commandes.show', $cmd)); ?>" class="btn btn-outline-navy btn-xs">Gérer</a></td>
                </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </tbody>
        </table>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.dashboard', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\academieohada-laravel\academieohada\resources\views/admin/dashboard.blade.php ENDPATH**/ ?>