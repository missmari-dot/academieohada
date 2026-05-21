<?php $__env->startSection('title','Candidature reçue'); ?>
<?php $__env->startSection('content'); ?>
<section class="auth-section">
    <div class="auth-card text-center">
        <div class="auth-icon" style="font-size:3rem">🎉</div>
        <h2>Candidature envoyée !</h2>
        <p>Merci pour votre intérêt à rejoindre l'équipe AcadémieOHADA.</p>
        <p>Votre candidature a bien été reçue. Notre équipe l'examinera dans les <strong>48h</strong> et vous contactera par email.</p>
        <div class="mt-3">
            <a href="<?php echo e(route('accueil')); ?>" class="btn btn-orange">Retour à l'accueil</a>
        </div>
    </div>
</section>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\academieohada-laravel\academieohada\resources\views/auth/candidature-recue.blade.php ENDPATH**/ ?>