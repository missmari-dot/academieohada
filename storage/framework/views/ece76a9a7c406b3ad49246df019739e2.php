<?php $__env->startSection('title','Vérifiez votre email'); ?>
<?php $__env->startSection('content'); ?>
<section class="auth-section">
    <div class="auth-card text-center">
        <div class="auth-icon">✉️</div>
        <h2>Vérifiez votre email</h2>
        <p>Un lien de vérification a été envoyé à <strong><?php echo e(auth()->user()->email); ?></strong>.</p>
        <p>Cliquez sur le lien dans l'email pour activer votre compte.</p>
        <?php if(session('success')): ?><div class="alert alert-success mt-2"><?php echo e(session('success')); ?></div><?php endif; ?>
        <form method="POST" action="<?php echo e(route('verification.send')); ?>" class="mt-2">
            <?php echo csrf_field(); ?>
            <button type="submit" class="btn btn-outline-navy">Renvoyer l'email de vérification</button>
        </form>
        <form method="POST" action="<?php echo e(route('logout')); ?>" class="mt-1">
            <?php echo csrf_field(); ?>
            <button type="submit" class="btn-text">Se déconnecter</button>
        </form>
    </div>
</section>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\academieohada-laravel\academieohada\resources\views/auth/verification-email.blade.php ENDPATH**/ ?>