<?php $__env->startSection('title','Nous contacter'); ?>
<?php $__env->startSection('content'); ?>
<section class="page-hero"><div class="container"><h1>Nous contacter</h1><p>Notre équipe vous répond dans les 2 heures.</p></div></section>
<section class="section">
    <div class="container">
        <div class="contact-layout">
            <div class="contact-form-wrap">
                <h2>Envoyer un message</h2>
                <?php if($errors->any()): ?><div class="alert alert-error"><?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $e): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><p><?php echo e($e); ?></p><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?></div><?php endif; ?>
                <form method="POST" action="<?php echo e(route('contact.store')); ?>">
                    <?php echo csrf_field(); ?>
                    <div class="form-row">
                        <div class="form-group"><label>Prénom *</label><input type="text" name="prenom" value="<?php echo e(old('prenom')); ?>" required class="form-input"></div>
                        <div class="form-group"><label>Nom *</label><input type="text" name="nom" value="<?php echo e(old('nom')); ?>" required class="form-input"></div>
                    </div>
                    <div class="form-row">
                        <div class="form-group"><label>Email *</label><input type="email" name="email" value="<?php echo e(old('email')); ?>" required class="form-input"></div>
                        <div class="form-group"><label>Téléphone</label><input type="tel" name="telephone" value="<?php echo e(old('telephone')); ?>" class="form-input"></div>
                    </div>
                    <div class="form-group"><label>Sujet *</label><input type="text" name="sujet" value="<?php echo e(old('sujet')); ?>" required class="form-input" placeholder="Ex: Question sur les tarifs, Suivi de commande..."></div>
                    <div class="form-group"><label>Message *</label><textarea name="contenu" rows="6" required class="form-textarea" placeholder="Décrivez votre demande..."><?php echo e(old('contenu')); ?></textarea></div>
                    <button type="submit" class="btn btn-orange btn-lg">📲 Envoyer sur WhatsApp →</button>
                    <p class="form-note">Vous serez redirigé vers WhatsApp pour envoyer votre message.</p>
                </form>
            </div>
            <div class="contact-info">
                <h3>Nos coordonnées</h3>
                <div class="contact-methods">
                    <a href="https://wa.me/221775646246" target="_blank" class="contact-method">
                        <span class="contact-method-icon">💬</span>
                        <div><strong>WhatsApp</strong><p>+221 77 564 62 46</p><span>Réponse en moins de 2h</span></div>
                    </a>
                    <a href="mailto:academie.redactionohada@gmail.com" class="contact-method">
                        <span class="contact-method-icon">✉️</span>
                        <div><strong>Email</strong><p>academie.redactionohada@gmail.com</p><span>Réponse sous 24h</span></div>
                    </a>
                    <div class="contact-method">
                        <span class="contact-method-icon">📅</span>
                        <div><strong>Google Meet</strong><p>Sur rendez-vous</p><span>Via le formulaire de devis</span></div>
                    </div>
                    <div class="contact-method">
                        <span class="contact-method-icon">🕐</span>
                        <div><strong>Horaires</strong><p>Lundi – Samedi</p><span>8h00 – 20h00</span></div>
                    </div>
                    <div class="contact-method">
                        <span class="contact-method-icon">📍</span>
                        <div><strong>Localisation</strong><p>Dakar,Saint-Louis, Sénégal</p><span>Service disponible dans 17 pays OHADA</span></div>
                    </div>
                </div>
                <div class="contact-faq">
                    <h4>Questions fréquentes</h4>
                    <?php $__currentLoopData = ['Quel est le délai minimum pour un mémoire ?'=>'Nous pouvons livrer en 30 jours avec un supplément de 25%. Le délai standard est 4 mois.','Peut-on payer en plusieurs fois ?'=>'Oui : 50% à la commande et 50% à la livraison. Vous pouvez aussi commander partie par partie.','La confidentialité est-elle garantie ?'=>'Absolument. Vos données et travaux ne sont jamais partagés avec des tiers.']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $q => $r): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="faq-item">
                        <p class="faq-q"><strong><?php echo e($q); ?></strong></p>
                        <p class="faq-a"><?php echo e($r); ?></p>
                    </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
            </div>
        </div>
    </div>
</section>
<?php $__env->stopSection(); ?>
<?php $__env->startPush('styles'); ?>
<style>
.contact-layout { display: grid; grid-template-columns: 1fr 380px; gap: 3rem; align-items: start; }
.contact-form-wrap h2 { margin-bottom: 1.5rem; }
.contact-info h3   { margin-bottom: 1.5rem; }
.contact-methods   { display: flex; flex-direction: column; gap: 1rem; margin-bottom: 2rem; }
.contact-method    { display: flex; gap: 1rem; padding: 1rem; background: #f9fafb; border-radius: 10px; border: 1px solid #e5e7eb; text-decoration: none; color: inherit; transition: all .2s; }
.contact-method:hover { border-color: #f97316; }
.contact-method-icon { font-size: 1.5rem; flex-shrink: 0; width: 40px; text-align: center; }
.contact-method strong { color: #1a2e4a; display: block; margin-bottom: .2rem; }
.contact-method p  { font-size: .875rem; font-weight: 600; color: #374151; margin-bottom: .1rem; }
.contact-method span { font-size: .78rem; color: #9ca3af; }
.contact-faq h4    { margin-bottom: 1rem; color: #1a2e4a; }
.faq-item          { margin-bottom: 1rem; padding-bottom: 1rem; border-bottom: 1px solid #e5e7eb; }
.faq-q             { margin-bottom: .3rem; }
.faq-a             { font-size: .875rem; }
@media(max-width:900px){ .contact-layout { grid-template-columns: 1fr; } }
</style>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\academieohada-laravel\academieohada\resources\views/pages/contact.blade.php ENDPATH**/ ?>