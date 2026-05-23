<?php $__env->startSection('title','Mon profil'); ?>
<?php $__env->startSection('page-title','Mon profil'); ?>
<?php $__env->startSection('sidebar-role','Espace Client'); ?>
<?php $__env->startSection('sidebar-links'); ?>
<a href="<?php echo e(route('client.dashboard')); ?>" class="sidebar-link">🏠 Tableau de bord</a>
<a href="<?php echo e(route('client.commandes')); ?>" class="sidebar-link">📋 Mes commandes</a>
<a href="<?php echo e(route('client.profil')); ?>" class="sidebar-link active">👤 Mon profil</a>
<a href="<?php echo e(route('devis')); ?>" class="sidebar-link sidebar-cta">⚡ Nouvelle commande</a>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
<div class="form-card">
    <div class="profil-header">
        <img src="<?php echo e($user->avatar_url); ?>" alt="Avatar" class="avatar-lg">
        <div><h3><?php echo e($user->nom_complet); ?></h3><p><?php echo e($user->email); ?></p></div>
    </div>
    <form method="POST" action="<?php echo e(route('client.profil.update')); ?>">
        <?php echo csrf_field(); ?> <?php echo method_field('PUT'); ?>
        <div class="form-row">
            <div class="form-group"><label>Prénom *</label><input type="text" name="prenom" value="<?php echo e(old('prenom', $user->prenom)); ?>" required class="form-input"></div>
            <div class="form-group"><label>Nom *</label><input type="text" name="nom" value="<?php echo e(old('nom', $user->nom)); ?>" required class="form-input"></div>
        </div>
        <div class="form-group"><label>Téléphone / WhatsApp</label><input type="tel" name="telephone" value="<?php echo e(old('telephone', $user->telephone)); ?>" class="form-input"></div>
        <div class="form-row">
            <div class="form-group"><label>Pays</label><input type="text" name="pays" value="<?php echo e(old('pays', $user->pays)); ?>" class="form-input"></div>
            <div class="form-group"><label>Ville</label><input type="text" name="ville" value="<?php echo e(old('ville', $user->ville)); ?>" class="form-input"></div>
        </div>
        <div class="form-row">
            <div class="form-group"><label>Établissement</label><input type="text" name="etablissement" value="<?php echo e(old('etablissement', $user->etablissement)); ?>" class="form-input"></div>
            <div class="form-group"><label>Niveau d'études</label><input type="text" name="niveau_etudes" value="<?php echo e(old('niveau_etudes', $user->niveau_etudes)); ?>" class="form-input"></div>
        </div>
        <button type="submit" class="btn btn-orange">Enregistrer les modifications</button>
    </form>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.dashboard', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\academieohada-laravel\academieohada\resources\views/client/profil.blade.php ENDPATH**/ ?>