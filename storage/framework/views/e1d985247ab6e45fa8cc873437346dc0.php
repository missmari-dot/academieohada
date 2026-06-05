<?php $__env->startSection('title', $user->nom_complet); ?>
<?php $__env->startSection('page-title', $user->nom_complet); ?>
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
<div class="detail-layout">
    <div class="detail-main">
        <div class="detail-card">
            <div class="profil-header">
                <img src="<?php echo e($user->avatar_url); ?>" alt="Avatar" class="avatar-lg">
                <div><h3><?php echo e($user->nom_complet); ?></h3><p><?php echo e($user->email); ?></p></div>
            </div>
            <div class="detail-grid">
                <div class="detail-row"><span>Téléphone</span><span><?php echo e($user->telephone ?? '—'); ?></span></div>
                <div class="detail-row"><span>Pays</span><span><?php echo e($user->pays ?? '—'); ?></span></div>
                <div class="detail-row"><span>Établissement</span><span><?php echo e($user->etablissement ?? '—'); ?></span></div>
                <div class="detail-row"><span>Niveau</span><span><?php echo e($user->niveau_etudes ?? '—'); ?></span></div>
                <div class="detail-row"><span>Inscrit le</span><span><?php echo e($user->created_at->format('d/m/Y')); ?></span></div>
                <div class="detail-row"><span>Statut</span><span class="<?php echo e($user->actif ? 'badge badge-green':'badge badge-red'); ?>"><?php echo e($user->actif ? 'Actif':'Désactivé'); ?></span></div>
            </div>
        </div>
        <div class="dashboard-section">
            <h3>Commandes (<?php echo e($commandes->count()); ?>)</h3>
            <?php $__currentLoopData = $commandes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cmd): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="commande-row">
                <div class="commande-info">
                    <span class="commande-ref"><?php echo e($cmd->reference); ?></span>
                    <span class="commande-service"><?php echo e($cmd->service); ?></span>
                    <span class="commande-sujet"><?php echo e(Str::limit($cmd->sujet, 60)); ?></span>
                </div>
                <div class="commande-meta">
                    <span class="badge badge-<?php echo e($cmd->statut_color); ?>"><?php echo e($cmd->statut_label); ?></span>
                    <span><?php echo e(number_format($cmd->montant, 0, ',', ' ')); ?> FCFA</span>
                </div>
                <a href="<?php echo e(route('admin.commandes.show', $cmd)); ?>" class="btn btn-outline-navy btn-xs">Voir</a>
            </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
    </div>
    <div class="detail-sidebar">
        <div class="detail-card">
            <h4>⚙️ Actions</h4>
            <a href="<?php echo e(route('admin.clients.edit', $user)); ?>" class="btn btn-outline-navy btn-full btn-sm mb-2">✏️ Modifier</a>
            
            <form method="POST" action="<?php echo e(route('admin.clients.toggle-bloque', $user)); ?>" onsubmit="return confirm('Voulez-vous vraiment <?php echo e($user->actif ? 'bloquer' : 'débloquer'); ?> ce client ?');">
                <?php echo csrf_field(); ?> <?php echo method_field('PUT'); ?>
                <button type="submit" class="btn <?php echo e($user->actif ? 'btn-red' : 'btn-green'); ?> btn-full btn-sm mb-2">
                    <?php echo e($user->actif ? '🚫 Bloquer le compte' : '✅ Débloquer le compte'); ?>

                </button>
            </form>

            <form method="POST" action="<?php echo e(route('admin.clients.destroy', $user)); ?>" onsubmit="return confirm('Voulez-vous vraiment supprimer ce client ? Cette action est irréversible.');">
                <?php echo csrf_field(); ?> <?php echo method_field('DELETE'); ?>
                <button type="submit" class="btn btn-outline-red btn-full btn-sm text-red mb-2" style="border-color: var(--red); color: var(--red);">🗑️ Supprimer</button>
            </form>
        </div>
        <a href="<?php echo e(route('admin.clients.index')); ?>" class="btn btn-outline-navy btn-full btn-sm">← Retour clients</a>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.dashboard', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\academieohada-laravel\academieohada\resources\views/admin/clients/show.blade.php ENDPATH**/ ?>