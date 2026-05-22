<?php $__env->startSection('title', 'Accueil'); ?>

<?php $__env->startSection('content'); ?>


<section class="hero">
    <div class="hero-bg"></div>
    <div class="container hero-inner">
        <div class="hero-content fade-in">
            <span class="hero-badge"> Experts Sous Régionaux</span>
            <h1 class="hero-title">
                Votre mémoire,<br>
                <em class="text-gradient">rédigé par des experts</em>
            </h1>
            <p class="hero-subtitle">
                Service professionnel de rédaction académique pour les étudiants
                des 17 pays membres de l'OHADA, de l'UEMOA et de la CEDEAO.
                Devis gratuit en moins de 2h.
            </p>
            <div class="hero-actions">
                <a href="<?php echo e(route('devis')); ?>" class="btn btn-orange btn-lg">
                    Demander un devis gratuit →
                </a>
                <a href="https://wa.me/221775646246" target="_blank" class="btn btn-outline-white btn-lg">
                    💬 WhatsApp
                </a>
            </div>
            <p class="hero-reassurance">✅ Devis sous 2h · Paiement en 2 fois · Révisions illimitées</p>
        </div>
        <div class="hero-visual fade-in delay-1">
            <div class="hero-card">
                <p class="card-label">🎓 Mémoire Master complet</p>
                <ul class="card-features">
                    <li>80 pages de contenu expert</li>
                    <li>Suivi soutenance offert</li>
                    <li>Révisions illimitées</li>
                    <li>Livraison garantie en 14 jours</li>
                </ul>
            </div>
        </div>
    </div>
</section>


<section class="stats-bar">
    <div class="container stats-grid">
        <div class="stat-item">
            <span class="stat-number">500+</span>
            <span class="stat-label">Mémoires livrés</span>
        </div>
        <div class="stat-item">
            <span class="stat-number">4.9/5</span>
            <span class="stat-label">Satisfaction client</span>
        </div>
        <div class="stat-item">
            <span class="stat-number">100%</span>
            <span class="stat-label">Experts Sous régionaux </span>
        </div>
        <div class="stat-item">
            <span class="stat-number">17</span>
            <span class="stat-label">Pays OHADA couverts</span>
        </div>
        <div class="stat-item">
            <span class="stat-number">2h</span>
            <span class="stat-label">Devis gratuit</span>
        </div>
    </div>
</section>


<section class="section services-preview">
    <div class="container">
        <div class="section-header fade-in">
            <span class="section-badge">Ce que nous faisons</span>
            <h2 class="section-title">Nos services académiques</h2>
            <p class="section-subtitle">De la problématique à la soutenance, nous vous accompagnons à chaque étape.</p>
        </div>
        <div class="services-grid">
            <div class="service-card fade-in delay-1">
                <div class="service-icon">📝</div>
                <h3>Rédaction de mémoires</h3>
                <p>Master (80p) et Licence (50p) — par partie ou complet. Toutes disciplines.</p>
                <p class="service-price">À partir de 60 000 FCFA</p>
                
            </div>
            <div class="service-card fade-in delay-2">
                <div class="service-icon">✏️</div>
                <h3>Correction & Relecture</h3>
                <p>Orthographe, grammaire, style. Mise en conformité normes OHADA/UEMOA.</p>
                <p class="service-price">10 000 FCFA / partie</p>
                
            </div>
            <div class="service-card fade-in delay-3">
                <div class="service-icon">🎓</div>
                <h3>Accompagnement</h3>
                <p>Formation en méthodologique, séances Google Meet, suivi soutenance.</p>
                <p class="service-price">À partir de 5 000 FCFA</p>
                
            </div>
            <div class="service-card fade-in delay-1">
                <div class="service-icon">📊</div>
                <h3>PowerPoint soutenance</h3>
                <p>Présentation professionnelle adaptée à votre mémoire et votre jury.</p>
                <p class="service-price">5 000 FCFA</p>
                <a href="<?php echo e(route('services')); ?>#powerpoint" class="btn btn-outline-navy btn-sm">En savoir plus →</a>
            </div>
            <div class="service-card fade-in delay-2">
                <div class="service-icon">📄</div>
                <h3>Rédaction diverse</h3>
                <p>Rapport de stage, CV + Lettre de motivation, dissertations.</p>
                <p class="service-price">À partir de 5 000 FCFA</p>
                <a href="<?php echo e(route('services')); ?>#redaction" class="btn btn-outline-navy btn-sm">En savoir plus →</a>
            </div>
            <div class="service-card service-card-cta fade-in delay-3">
                <div class="service-icon">⚡</div>
                <h3>Devis gratuit en 2h</h3>
                <p>Décrivez votre besoin, recevez un devis personnalisé sans engagement.</p>
                <a href="<?php echo e(route('devis')); ?>" class="btn btn-orange">Obtenir mon devis →</a>
            </div>
        </div>
    </div>
</section>


<section class="section section-alt why-us">
    <div class="container">
        <div class="section-header fade-in">
            <span class="section-badge">Nos garanties</span>
            <h2 class="section-title">Pourquoi choisir AcadémieOHADA ?</h2>
        </div>
        <div class="guarantees-grid">
            <?php $__currentLoopData = [
                ['✅','Révisions illimitées','Sans frais supplémentaires'],
                ['⏱️','Livraison garantie','Remise automatique si retard de notre fait'],
                ['🔒','Confidentialité totale','Vos données ne sont jamais partagées'],
                ['💳','Paiement flexible','50/50 ou par partie — Wave, Orange Money, Free Money'],
                ['⚡','Devis sous 2h','Réponse rapide, sans engagement'],
                ['🇸🇳','Experts sous Régionaux','Diplômés Master ou Doctorat, sénégalais'],
                ['🎓','Suivi soutenance','Offert avec tout mémoire complet'],
                ['📜','Normes respectées','APA, MLA, normes internes, OHADA/UEMOA/CEDEAO'],
            ]; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $g): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="guarantee-item fade-in" style="animation-delay: <?php echo e(0.1 * $index); ?>s">
                <span class="guarantee-icon"><?php echo e($g[0]); ?></span>
                <div>
                    <strong><?php echo e($g[1]); ?></strong>
                    <p><?php echo e($g[2]); ?></p>
                </div>
            </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
    </div>
</section>


<section class="section disciplines">
    <div class="container">
        <div class="section-header">
            <span class="section-badge">Toutes filières</span>
            <h2 class="section-title">Disciplines couvertes</h2>
            <p class="section-subtitle">Nos experts couvrent l'ensemble des filières académiques.</p>
        </div>
        <div class="disciplines-grid">
            <?php $__currentLoopData = ['Droit OHADA','Finance & Économie','Sciences Politiques','Informatique & SI','Marketing','Sociologie','Comptabilité','Lettres & Linguistique','Ressources Humaines','Santé & Médecine','Commerce international','Sciences de l\'éducation']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $d): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <span class="discipline-tag"><?php echo e($d); ?></span>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
        
    </div>
</section>


<section class="section section-alt testimonials">
    <div class="container">
        <div class="section-header fade-in">
            <span class="section-badge">Ils nous font confiance</span>
            <h2 class="section-title">Témoignages</h2>
        </div>
        <div class="testimonials-grid">
            <?php $__currentLoopData = [
                ['Aminata D.','UCAD — Master Droit OHADA','Mon mémoire a été livré en Deux mois jours, impeccable. Mon jury a félicité la qualité de la rédaction.','⭐⭐⭐⭐⭐'],
                ['Moussa K.','ISM — Master Finance','Service exceptionnel. La correction de ma 1ère partie a transformé mon mémoire. Je recommande.','⭐⭐⭐⭐⭐'],
                ['Fatou B.','ESP — Licence Informatique','Devis reçu en 1h, accompagnement jusqu\'à la soutenance. Merci AcadémieOHADA !','⭐⭐⭐⭐⭐'],
            ]; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $t): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="testimonial-card fade-in" style="animation-delay: <?php echo e(0.2 * $index); ?>s">
                <p class="testimonial-stars"><?php echo e($t[3]); ?></p>
                <p class="testimonial-text">"<?php echo e($t[2]); ?>"</p>
                <div class="testimonial-author">
                    <div class="testimonial-avatar"><?php echo e(substr($t[0],0,1)); ?></div>
                    <div>
                        <p class="testimonial-name"><?php echo e($t[0]); ?></p>
                        <p class="testimonial-role"><?php echo e($t[1]); ?></p>
                    </div>
                </div>
            </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
    </div>
</section>


<section class="cta-section fade-in">
    <div class="container cta-inner">
        <h2 class="fade-in delay-1">Prêt à commencer votre mémoire ?</h2>
        <p class="fade-in delay-2">Devis gratuit en moins de 2h. Paiement flexible. Experts Sous Régionaux.</p>
        <div class="cta-actions fade-in delay-3">
            <a href="<?php echo e(route('devis')); ?>" class="btn btn-orange btn-lg">Demander un devis gratuit →</a>
            <a href="https://wa.me/221775646246" target="_blank" class="btn btn-outline-white btn-lg">💬 Discuter sur WhatsApp</a>
        </div>
    </div>
</section>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\academieohada-laravel\academieohada\resources\views/pages/accueil.blade.php ENDPATH**/ ?>