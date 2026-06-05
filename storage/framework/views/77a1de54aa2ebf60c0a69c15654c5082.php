<?php $__env->startSection('title', 'Modifier ' . $user->nom_complet); ?>
<?php $__env->startSection('page-title', 'Modifier le client : ' . $user->nom_complet); ?>
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
<div class="dashboard-section" style="max-width: 600px; margin: 0 auto;">
    <form method="POST" action="<?php echo e(route('admin.clients.update', $user)); ?>" class="form-container">
        <?php echo csrf_field(); ?>
        <?php echo method_field('PUT'); ?>
        
        <div class="form-group">
            <label class="form-label">Prénom *</label>
            <input type="text" name="prenom" class="form-input" value="<?php echo e(old('prenom', $user->prenom)); ?>" required>
        </div>

        <div class="form-group">
            <label class="form-label">Nom *</label>
            <input type="text" name="nom" class="form-input" value="<?php echo e(old('nom', $user->nom)); ?>" required>
        </div>

        <div class="form-group">
            <label class="form-label">Email *</label>
            <input type="email" name="email" class="form-input" value="<?php echo e(old('email', $user->email)); ?>" required>
        </div>

        <div class="form-group">
            <label class="form-label">Téléphone</label>
            <input type="text" name="telephone" class="form-input" value="<?php echo e(old('telephone', $user->telephone)); ?>">
        </div>

        <hr style="margin: 20px 0; border: none; border-top: 1px solid #ddd;">
        <h4 style="margin-bottom: 10px;">Changer le mot de passe (optionnel)</h4>

        <div class="form-group">
            <label class="form-label">Nouveau mot de passe</label>
            <input type="password" name="password" class="form-input" minlength="8">
            <small style="color: #666; font-size: 0.8rem;">Laissez vide pour conserver le mot de passe actuel.</small>
        </div>

        <div class="form-group">
            <label class="form-label">Confirmer le nouveau mot de passe</label>
            <input type="password" name="password_confirmation" class="form-input" minlength="8">
        </div>

        <div class="form-actions" style="margin-top: 20px; display: flex; gap: 10px;">
            <button type="submit" class="btn btn-orange">Enregistrer les modifications</button>
            <a href="<?php echo e(route('admin.clients.index')); ?>" class="btn btn-outline-navy">Annuler</a>
        </div>
    </form>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.dashboard', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\academieohada-laravel\academieohada\resources\views/admin/clients/edit.blade.php ENDPATH**/ ?>