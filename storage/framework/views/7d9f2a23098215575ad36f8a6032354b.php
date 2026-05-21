<?php $__env->startSection('title', 'Tarifs'); ?>
<?php $__env->startSection('description', 'Grille tarifaire AcadémieOHADA — Mémoires Master et Licence, correction, accompagnement, délais.'); ?>

<?php $__env->startSection('content'); ?>

<section class="page-hero">
    <div class="container">
        <span class="section-badge">Transparent & sans surprise</span>
        <h1>Nos tarifs</h1>
        <p>Payez par partie ou commandez le mémoire complet et économisez.</p>
    </div>
</section>

<section class="section">
    <div class="container">

        
        <div class="tarifs-toggle">
            <button class="toggle-btn active" id="btn-master" onclick="switchNiveau('master')">
                🎓 Master (80 pages)
            </button>
            <button class="toggle-btn" id="btn-licence" onclick="switchNiveau('licence')">
                📘 Licence (50 pages)
            </button>
        </div>

        
        <div id="tarifs-master">
            <div class="tarifs-grid">
                <?php $__currentLoopData = $tarifsMaster; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $t): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="tarif-card <?php echo e(isset($t['highlight']) ? 'tarif-highlight' : ''); ?>">
                    <div class="tarif-label"><?php echo e($t['label']); ?></div>
                    <div class="tarif-price"><?php echo e(number_format($t['prix'], 0, ',', ' ')); ?> <span>FCFA</span></div>
                    <?php if(isset($t['economie'])): ?>
                        <div class="tarif-economy">Économie <?php echo e(number_format($t['economie'], 0, ',', ' ')); ?> FCFA</div>
                    <?php endif; ?>
                    <a href="<?php echo e(route('devis')); ?>" class="btn <?php echo e(isset($t['highlight']) ? 'btn-orange' : 'btn-outline-navy'); ?> btn-sm">
                        Commander
                    </a>
                </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
        </div>

        
        <div id="tarifs-licence" style="display:none">
            <div class="tarifs-grid">
                <?php $__currentLoopData = $tarifsLicence; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $t): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="tarif-card <?php echo e(isset($t['highlight']) ? 'tarif-highlight' : ''); ?>">
                    <div class="tarif-label"><?php echo e($t['label']); ?></div>
                    <div class="tarif-price"><?php echo e(number_format($t['prix'], 0, ',', ' ')); ?> <span>FCFA</span></div>
                    <?php if(isset($t['economie'])): ?>
                        <div class="tarif-economy">Économie <?php echo e(number_format($t['economie'], 0, ',', ' ')); ?> FCFA</div>
                    <?php endif; ?>
                    <a href="<?php echo e(route('devis')); ?>" class="btn <?php echo e(isset($t['highlight']) ? 'btn-orange' : 'btn-outline-navy'); ?> btn-sm">
                        Commander
                    </a>
                </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
        </div>

        
        <div class="section-header mt-5">
            <h2 class="section-title">Modificateurs de délai</h2>
            <p class="section-subtitle">Le délai sélectionné ajuste automatiquement le prix final.</p>
        </div>
        <div class="delai-grid">
            <?php $__currentLoopData = $modificateurs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $m): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="delai-card delai-<?php echo e($m['classe']); ?>">
                <span class="delai-label"><?php echo e($m['delai']); ?></span>
                <span class="delai-mod"><?php echo e($m['mod']); ?></span>
            </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>

        
        <div class="section-header mt-5">
            <h2 class="section-title">Autres prestations</h2>
        </div>
        <div class="autres-tarifs">
            <div class="autres-col">
                <h3>Rédaction</h3>
                <div class="tarif-row"><span>Rapport de stage</span><span>Sur devis</span></div>
                <div class="tarif-row"><span>Dissertation</span><span>5 000 FCFA</span></div>
                <div class="tarif-row"><span>CV + Lettre de motivation</span><span>5 000 FCFA</span></div>
                <div class="tarif-row"><span>Flyers / Affiches</span><span>Sur devis</span></div>
            </div>
            <div class="autres-col">
                <h3>Correction & Accompagnement</h3>
                <div class="tarif-row"><span>Correction / partie</span><span>10 000 FCFA</span></div>
                <div class="tarif-row"><span>Formation méthodologie</span><span>15 000 FCFA / séance</span></div>
                <div class="tarif-row"><span>Accompagnement (1h)</span><span>5 000 FCFA</span></div>
                <div class="tarif-row"><span>Séance Google Meet</span><span>5 000 FCFA / h</span></div>
                <div class="tarif-row"><span>PowerPoint soutenance</span><span>5 000 FCFA</span></div>
                <div class="tarif-row tarif-offert"><span>Suivi à la soutenance</span><span>🎁 OFFERT</span></div>
            </div>
            <div class="autres-col">
                <h3>Paiement accepté</h3>
                <div class="payment-methods">
                    <span class="payment-badge">Wave</span>
                    <span class="payment-badge">Orange Money</span>
                    
                </div>
                <p class="mt-2">Paiement possible en 2 fois ou par partie.</p>
            </div>
        </div>

    </div>
</section>

<section class="cta-section">
    <div class="container cta-inner">
        <h2>Besoin d'un devis personnalisé ?</h2>
        <p>Réponse garantie en moins de 2h.</p>
        <a href="<?php echo e(route('devis')); ?>" class="btn btn-orange btn-lg">Obtenir mon devis →</a>
    </div>
</section>

<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts'); ?>
<script>
function switchNiveau(niveau) {
    document.getElementById('tarifs-master').style.display  = niveau === 'master'  ? 'block' : 'none';
    document.getElementById('tarifs-licence').style.display = niveau === 'licence' ? 'block' : 'none';
    document.getElementById('btn-master').classList.toggle('active',  niveau === 'master');
    document.getElementById('btn-licence').classList.toggle('active', niveau === 'licence');
}
</script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\academieohada-laravel\academieohada\resources\views/pages/tarifs.blade.php ENDPATH**/ ?>