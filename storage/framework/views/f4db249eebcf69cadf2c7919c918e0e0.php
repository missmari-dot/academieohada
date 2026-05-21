<?php $__env->startSection('title','Ressources académiques'); ?>
<?php $__env->startSection('content'); ?>
<section class="page-hero"><div class="container"><h1>Ressources académiques</h1><p>Guides, méthodologie et conseils pour réussir votre mémoire.</p></div></section>
<section class="section">
    <div class="container">

        <div id="rediger" class="ressource-block">
            <h2>📝 Comment rédiger un mémoire ?</h2>
            <div class="ressource-steps">
                <?php $__currentLoopData = [['1','Choisir son sujet','Optez pour un sujet précis, délimité, faisable dans les délais et en lien avec votre filière.'],['2','Faire la revue de littérature','Recensez les travaux existants sur votre sujet pour situer votre contribution.'],['3','Formuler la problématique','Posez la question centrale à laquelle votre mémoire va répondre.'],['4','Définir la méthodologie','Choisissez entre méthode qualitative, quantitative ou mixte selon votre sujet.'],['5','Rédiger et structurer','Introduction → Partie 1 → Partie 2 → Conclusion. Respectez les normes de votre établissement.'],['6','Réviser et corriger','Relisez plusieurs fois, faites corriger par un tiers, vérifiez les citations et la bibliographie.']]; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $s): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="ressource-step">
                    <span class="step-circle"><?php echo e($s[0]); ?></span>
                    <div><strong><?php echo e($s[1]); ?></strong><p><?php echo e($s[2]); ?></p></div>
                </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
        </div>

        <div id="methodologie" class="ressource-block">
            <h2>🔬 Méthodologie de recherche</h2>
            <div class="ressource-grid">
                <?php $__currentLoopData = [['Qualitative','Entretiens, focus groups, observations. Comprend les phénomènes sociaux en profondeur.'],['Quantitative','Sondages, questionnaires, données statistiques. Mesure et généralise les résultats.'],['Mixte','Combine les deux approches pour une analyse plus complète et rigoureuse.'],['Analyse documentaire','Étude de documents, textes, archives, rapports officiels.'],['Étude de cas','Analyse approfondie d\'une organisation, situation ou phénomène particulier.'],['Comparative','Compare plusieurs cas, pays ou périodes pour identifier des tendances.']]; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $m): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="methodo-card">
                    <h4><?php echo e($m[0]); ?></h4>
                    <p><?php echo e($m[1]); ?></p>
                </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
        </div>

        <div id="faq" class="ressource-block">
            <h2>❓ FAQ — Questions fréquentes</h2>
            <div class="faq-list">
                <?php $__currentLoopData = [
                    ['Quelle est la différence entre un mémoire de Master et de Licence ?','Un mémoire de Master fait environ 80 pages et requiert une problématique approfondie, une revue de littérature solide et une méthodologie rigoureuse. Un mémoire de Licence fait environ 50 pages avec des exigences adaptées.'],
                    ['Combien de temps faut-il pour écrire un mémoire ?','En suivant notre service, nous pouvons livrer en 3 jours (urgent), 7 jours, 14 jours (standard) ou 30 jours (confort). Les délais varient selon la complexité et les parties commandées.'],
                    ['Quelles normes utilisez-vous ?','Nous respectons les normes APA, MLA, et les normes internes de votre établissement. Nous assurons également la conformité aux cadres OHADA, UEMOA et CEDEAO.'],
                    ['Puis-je commander seulement certaines parties ?','Oui. Vous pouvez commander partie par partie : choix du sujet, problématique, plan, introduction, parties 1 et 2, conclusion. Chaque partie a son propre tarif.'],
                    ['La confidentialité est-elle garantie ?','Absolument. Vos données personnelles et vos travaux ne sont jamais partagés avec des tiers. Confidentialité totale garantie.'],
                    ['Quels modes de paiement acceptez-vous ?','Wave, Orange Money, Free Money et virement bancaire. Paiement possible en 2 fois (50% commande + 50% livraison) ou par partie.'],
                ]; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $faq): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="faq-item-large">
                    <p class="faq-q-large"><strong><?php echo e($faq[0]); ?></strong></p>
                    <p class="faq-a-large"><?php echo e($faq[1]); ?></p>
                </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
        </div>

    </div>
</section>
<section class="cta-section">
    <div class="container cta-inner">
        <h2>Prêt à commencer votre mémoire ?</h2>
        <a href="<?php echo e(route('devis')); ?>" class="btn btn-orange btn-lg">Demander un devis gratuit →</a>
    </div>
</section>
<?php $__env->stopSection(); ?>
<?php $__env->startPush('styles'); ?>
<style>
.ressource-block { margin-bottom: 4rem; padding-bottom: 3rem; border-bottom: 1px solid #e5e7eb; }
.ressource-block:last-child { border: none; }
.ressource-block h2 { margin-bottom: 2rem; }
.ressource-steps { display: flex; flex-direction: column; gap: 1.25rem; }
.ressource-step  { display: flex; gap: 1.25rem; align-items: flex-start; }
.step-circle     { width: 36px; height: 36px; border-radius: 50%; background: #1a2e4a; color: #fff; display: flex; align-items: center; justify-content: center; font-weight: 700; flex-shrink: 0; }
.ressource-step strong { color: #1a2e4a; }
.ressource-step p { font-size: .9rem; margin-top: .25rem; }
.ressource-grid  { display: grid; grid-template-columns: repeat(3,1fr); gap: 1.25rem; }
.methodo-card    { border: 1px solid #e5e7eb; border-radius: 10px; padding: 1.25rem; }
.methodo-card h4 { color: #1a2e4a; margin-bottom: .5rem; }
.methodo-card p  { font-size: .875rem; }
.faq-list        { display: flex; flex-direction: column; gap: 0; }
.faq-item-large  { padding: 1.25rem 0; border-bottom: 1px solid #f3f4f6; }
.faq-q-large     { margin-bottom: .5rem; color: #1a2e4a; }
.faq-a-large     { font-size: .9rem; }
@media(max-width:768px){ .ressource-grid { grid-template-columns: 1fr; } }
</style>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\academieohada-laravel\academieohada\resources\views/pages/ressources.blade.php ENDPATH**/ ?>