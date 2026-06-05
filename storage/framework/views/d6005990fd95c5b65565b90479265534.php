<?php $__env->startSection('title', $candidature->nom_complet); ?>
<?php $__env->startSection('page-title', 'Candidature — ' . $candidature->nom_complet); ?>
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
<div class="detail-layout">
    <div class="detail-main">
        <div class="detail-card">
            <h3>👤 Profil du candidat</h3>
            <div class="detail-grid">
                <div class="detail-row"><span>Nom complet</span><strong><?php echo e($candidature->nom_complet); ?></strong></div>
                <div class="detail-row"><span>Email</span><span><?php echo e($candidature->email); ?></span></div>
                <div class="detail-row"><span>WhatsApp</span><span><?php echo e($candidature->telephone); ?></span></div>
                <div class="detail-row"><span>Localisation</span><span><?php echo e($candidature->ville); ?>, <?php echo e($candidature->pays); ?></span></div>
                <div class="detail-row"><span>Diplôme</span><strong><?php echo e($candidature->diplome); ?></strong></div>
                <div class="detail-row"><span>Spécialité</span><span><?php echo e($candidature->specialite); ?></span></div>
                <div class="detail-row"><span>Établissement</span><span><?php echo e($candidature->etablissement_diplome); ?></span></div>
                <div class="detail-row"><span>Expérience</span><span><?php echo e($candidature->annees_experience); ?> ans</span></div>
                <div class="detail-row"><span>Disponibilité</span><span><?php echo e($candidature->disponibilite); ?></span></div>
                <?php if($candidature->services_proposes): ?>
                <div class="detail-row"><span>Services proposés</span><span><?php echo e(implode(', ', $candidature->services_proposes)); ?></span></div>
                <?php endif; ?>
                <?php if($candidature->message_libre): ?>
                <div class="detail-row"><span>Message</span><span><?php echo e($candidature->message_libre); ?></span></div>
                <?php endif; ?>
                <div class="detail-row"><span>Statut</span>
                    <?php if($candidature->statut === 'en_attente'): ?><span class="badge badge-orange">En attente</span>
                    <?php elseif($candidature->statut === 'valide'): ?><span class="badge badge-green">Validée</span>
                    <?php else: ?><span class="badge badge-gray">Refusée <?php if($candidature->motif_refus): ?>— <?php echo e($candidature->motif_refus); ?><?php endif; ?></span><?php endif; ?>
                </div>
            </div>
        </div>
        <div class="detail-card">
            <h3>📄 Documents</h3>
            <a href="<?php echo e(route('admin.candidatures.cv', $candidature)); ?>" class="btn btn-outline-navy btn-sm">⬇ Télécharger le CV</a>
            <?php if($candidature->lettre_path): ?><span class="ml-2 text-muted">Lettre disponible</span><?php endif; ?>
        </div>
    </div>

    <?php if($candidature->statut === 'en_attente'): ?>
    <div class="detail-sidebar">
        
        <div class="detail-card">
            <h4>✅ Valider la candidature</h4>
            <p>Un compte expert sera créé automatiquement et un email d'accès sera envoyé.</p>
            <form method="POST" action="<?php echo e(route('admin.candidatures.valider', $candidature)); ?>">
                <?php echo csrf_field(); ?> <?php echo method_field('PUT'); ?>
                <button type="submit" class="btn btn-green btn-full" onclick="return confirm('Valider cette candidature et créer le compte expert ?')">Valider & Créer le compte</button>
            </form>
        </div>

        
        <div class="detail-card">
            <h4>❌ Refuser la candidature</h4>
            <form method="POST" action="<?php echo e(route('admin.candidatures.refuser', $candidature)); ?>">
                <?php echo csrf_field(); ?> <?php echo method_field('PUT'); ?>
                <div class="form-group">
                    <label>Motif du refus (optionnel)</label>
                    <textarea name="motif_refus" rows="3" class="form-textarea" placeholder="Expliquez brièvement le motif..."></textarea>
                </div>
                <button type="submit" class="btn btn-outline-navy btn-full btn-sm" onclick="return confirm('Refuser cette candidature ?')">Refuser</button>
            </form>
        </div>

        <a href="<?php echo e(route('admin.candidatures')); ?>" class="btn btn-outline-navy btn-full btn-sm mt-1">← Retour liste</a>
    </div>
    <?php else: ?>
    <div class="detail-sidebar">
        <a href="<?php echo e(route('admin.candidatures')); ?>" class="btn btn-outline-navy btn-full btn-sm">← Retour liste</a>
    </div>
    <?php endif; ?>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.dashboard', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\academieohada-laravel\academieohada\resources\views/admin/candidatures/show.blade.php ENDPATH**/ ?>