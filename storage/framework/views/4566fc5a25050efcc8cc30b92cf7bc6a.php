<?php $__env->startSection('title', 'À propos d\'AcadémieOHADA'); ?>

<?php $__env->startSection('content'); ?>

<section class="page-hero">
    <div class="container">
        <span class="section-badge">Notre histoire</span>
        <h1>À propos d'AcadémieOHADA</h1>
        <p>Un service académique de confiance, fondé par des experts sénégalais au service des étudiants de toute l'Afrique OHADA.</p>
    </div>
</section>


<section class="section">
    <div class="container">
        <div class="about-grid">
            <div>
                <span class="section-badge">Notre mission</span>
                <h2>Rendre l'excellence académique accessible</h2>
                <p>AcadémieOHADA est née d'un constat simple : trop d'étudiants brillants échouent à transformer leurs idées en mémoires académiques solides, faute d'accompagnement adapté.</p>
                <p class="mt-2">Notre équipe d'experts diplômés (Master et Doctorat) accompagne les étudiants des 17 pays membres de l'OHADA, de l'UEMOA et de la CEDEAO pour leur permettre d'atteindre leur plein potentiel académique.</p>
                <div class="about-stats">
                    <div class="about-stat"><span class="stat-big">500+</span><span>Mémoires livrés</span></div>
                    <div class="about-stat"><span class="stat-big">4.9/5</span><span>Satisfaction</span></div>
                    <div class="about-stat"><span class="stat-big">17</span><span>Pays couverts</span></div>
                </div>
            </div>
            <div class="about-values">
                <h3>Nos valeurs</h3>
                <?php $__currentLoopData = ['Excellence — Qualité académique irréprochable à chaque prestation','Intégrité — Confidentialité totale, engagement respecté','Proximité — Experts locaux qui comprennent vos normes et exigences','Accessibilité — Paiement flexible, par partie ou en deux fois']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $v): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="value-item">
                    <span class="value-dot"></span>
                    <p><strong><?php echo e(explode(' — ', $v)[0]); ?></strong> — <?php echo e(explode(' — ', $v)[1]); ?></p>
                </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
        </div>
    </div>
</section>


<section class="section section-alt" id="garanties">
    <div class="container">
        <div class="section-header">
            <span class="section-badge">Nos engagements</span>
            <h2 class="section-title">Garanties & Assurance qualité</h2>
        </div>
        <div class="guarantees-grid">
            <?php $__currentLoopData = $garanties; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $g): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="guarantee-item">
                <span class="guarantee-icon"><?php echo e($g['icon']); ?></span>
                <div>
                    <strong><?php echo e($g['titre']); ?></strong>
                    <p><?php echo e($g['texte']); ?></p>
                </div>
            </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
    </div>
</section>


<section class="section" id="institutions">
    <div class="container">
        <div class="section-header">
            <span class="section-badge">Zone de couverture</span>
            <h2 class="section-title">Institutions OHADA · UEMOA · CEDEAO</h2>
            <p class="section-subtitle">Notre service est disponible pour tous les étudiants des pays membres de l'OHADA, de l'UEMOA et de la CEDEAO.</p>
        </div>

        <?php $__currentLoopData = $institutions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $inst): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <div class="institution-block" style="--inst-color: <?php echo e($inst['color']); ?>">
            <div class="institution-header">
                <h3><?php echo e($inst['nom']); ?></h3>
                <span class="institution-count"><?php echo e(count($inst['pays'])); ?> pays membres</span>
            </div>
            <div class="institution-pays">
                <?php $__currentLoopData = $inst['pays']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $p): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <span class="pays-tag"><?php echo e($p); ?></span>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
        </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>
</section>

<?php $__env->stopSection(); ?>

<?php $__env->startPush('styles'); ?>
<style>
.about-grid { display: grid; grid-template-columns: 1fr 1fr; gap: 4rem; align-items: center; }
.about-grid p { margin-bottom: .5rem; }
.about-stats { display: flex; gap: 2rem; margin-top: 2rem; }
.about-stat  { text-align: center; }
.stat-big    { display: block; font-family:'Cormorant Garamond',serif; font-size: 2rem; font-weight: 700; color: #f97316; }
.about-values { background: #1a2e4a; color: #fff; border-radius: 16px; padding: 2rem; }
.about-values h3 { color: #fff; margin-bottom: 1.5rem; }
.value-item  { display: flex; gap: 1rem; align-items: flex-start; margin-bottom: 1rem; }
.value-dot   { width: 8px; height: 8px; border-radius: 50%; background: #f97316; flex-shrink: 0; margin-top: .45rem; }
.value-item p, .value-item strong { color: rgba(255,255,255,.85); font-size: .9rem; }
.institution-block { border: 1px solid #e5e7eb; border-radius: 16px; padding: 1.75rem; margin-bottom: 1.5rem; border-left: 4px solid var(--inst-color); }
.institution-header { display: flex; justify-content: space-between; align-items: center; margin-bottom: 1.25rem; }
.institution-header h3 { font-size: 1.3rem; color: var(--inst-color); }
.institution-count  { font-size: .8rem; color: #9ca3af; }
.institution-pays   { display: flex; flex-wrap: wrap; gap: .5rem; }
.pays-tag { background: #f9fafb; border: 1px solid #e5e7eb; border-radius: 50px; padding: .25rem .75rem; font-size: .8rem; color: #374151; }
@media(max-width:768px){ .about-grid { grid-template-columns: 1fr; } }
</style>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\academieohada-laravel\academieohada\resources\views/pages/a-propos.blade.php ENDPATH**/ ?>