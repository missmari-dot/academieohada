<?php $__env->startSection('title','Mémoires par discipline'); ?>
<?php $__env->startSection('content'); ?>
<section class="page-hero">
    <div class="container">
        <h1>Mémoires par discipline</h1>
        <p>Nos experts couvrent toutes les filières académiques des pays membres OHADA, UEMOA et CEDEAO.</p>
    </div>
</section>
<section class="section">
    <div class="container">
        <?php $__currentLoopData = $disciplines; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $categorie => $sousDisc): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <div class="discipline-section" id="<?php echo e(Str::slug($categorie)); ?>">
            <h2 class="discipline-cat-title"><?php echo e($categorie); ?></h2>
            <div class="discipline-cards">
                <?php $__currentLoopData = $sousDisc; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $d): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="discipline-card">
                    <h4><?php echo e($d); ?></h4>
                    <p>Mémoire Master ou Licence rédigé par un expert spécialisé en <?php echo e($d); ?>.</p>
                    <div class="discipline-prices">
                        <span>Master : <strong>100 000 FCFA</strong></span>
                        <span>Licence : <strong>60 000 FCFA</strong></span>
                    </div>
                    <a href="<?php echo e(route('devis')); ?>" class="btn btn-outline-navy btn-sm mt-2">Commander →</a>
                </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
        </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>
</section>
<section class="cta-section">
    <div class="container cta-inner">
        <h2>Votre discipline n'est pas listée ?</h2>
        <p>Contactez-nous, nous avons des experts dans de nombreuses autres filières.</p>
        <a href="https://wa.me/221775646246" target="_blank" class="btn btn-orange btn-lg">💬 Nous contacter sur WhatsApp</a>
    </div>
</section>
<?php $__env->stopSection(); ?>
<?php $__env->startPush('styles'); ?>
<style>
.discipline-section { margin-bottom: 3rem; }
.discipline-cat-title { font-size: 1.5rem; color: #1a2e4a; margin-bottom: 1.5rem; padding-bottom: .75rem; border-bottom: 3px solid #f97316; }
.discipline-cards { display: grid; grid-template-columns: repeat(3,1fr); gap: 1.25rem; }
.discipline-card { border: 1px solid #e5e7eb; border-radius: 12px; padding: 1.5rem; transition: all .2s; }
.discipline-card:hover { box-shadow: 0 8px 24px rgba(0,0,0,.1); border-color: #f97316; }
.discipline-card h4 { color: #1a2e4a; margin-bottom: .5rem; }
.discipline-card p   { font-size: .875rem; margin-bottom: .75rem; }
.discipline-prices   { display: flex; gap: 1.5rem; font-size: .85rem; color: #6b7280; }
.discipline-prices strong { color: #f97316; }
@media(max-width:768px){ .discipline-cards { grid-template-columns: 1fr; } }
</style>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\academieohada-laravel\academieohada\resources\views/pages/memoires.blade.php ENDPATH**/ ?>