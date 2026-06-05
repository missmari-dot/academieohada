<?php $__env->startSection('title', $commande->reference); ?>
<?php $__env->startSection('page-title', 'Commande ' . $commande->reference); ?>
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
            <h3>📋 Détails</h3>
            <div class="detail-grid">
                <div class="detail-row"><span>Référence</span><strong><?php echo e($commande->reference); ?></strong></div>
                <div class="detail-row"><span>Client</span><span><?php echo e($commande->client_name); ?> — <?php echo e($commande->client_email); ?></span></div>
                <div class="detail-row"><span>Service</span><span><?php echo e($commande->service); ?> <?php echo e($commande->niveau ? "({$commande->niveau})" : ''); ?></span></div>
                <div class="detail-row"><span>Sujet</span><span><?php echo e($commande->sujet); ?></span></div>
                <?php if($commande->filiere): ?><div class="detail-row"><span>Filière</span><span><?php echo e($commande->filiere); ?></span></div><?php endif; ?>
                <div class="detail-row"><span>Délai</span><span><?php echo e($commande->delai); ?></span></div>
                <?php if($commande->date_soutenance): ?><div class="detail-row"><span>Soutenance</span><span><?php echo e($commande->date_soutenance->format('d/m/Y')); ?></span></div><?php endif; ?>
                <div class="detail-row"><span>Montant</span><strong><?php echo e(number_format($commande->montant, 0, ',', ' ')); ?> FCFA</strong></div>
                <div class="detail-row"><span>Paiement</span><span><?php echo e($commande->mode_paiement ?? '—'); ?></span></div>
                <?php if($commande->instructions): ?><div class="detail-row"><span>Instructions</span><span><?php echo e($commande->instructions); ?></span></div><?php endif; ?>
                <?php if($commande->parties): ?><div class="detail-row"><span>Parties</span><span><?php echo e(implode(', ', $commande->parties)); ?></span></div><?php endif; ?>
                <?php if($commande->options): ?><div class="detail-row"><span>Options</span><span><?php echo e(implode(', ', $commande->options)); ?></span></div><?php endif; ?>
                <div class="detail-row"><span>Statut actuel</span><span class="badge badge-<?php echo e($commande->statut_color); ?>"><?php echo e($commande->statut_label); ?></span></div>
                <?php if($commande->expert): ?><div class="detail-row"><span>Expert assigné</span><span><?php echo e($commande->expert->nom_complet); ?></span></div><?php endif; ?>
                <?php if($commande->fichier_client): ?>
                <div class="detail-row">
                    <span>Fichier client</span>
                    <span>
                        <a href="<?php echo e(route('admin.commandes.fichier-client', $commande)); ?>" class="btn btn-outline-navy btn-xs" style="padding: 2px 8px; font-size: 0.8rem;">
                            📥 Télécharger
                        </a>
                    </span>
                </div>
                <?php endif; ?>
            </div>
        </div>

        
        <?php if($commande->fichiers->count()): ?>
        <div class="detail-card">
            <h3>📂 Fichiers livrés</h3>
            <?php $__currentLoopData = $commande->fichiers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $f): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="fichier-row">
                <span>📄 <?php echo e($f->nom_original); ?></span>
                <span><?php echo e($f->created_at->format('d/m/Y H:i')); ?></span>
            </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
        <?php endif; ?>
    </div>

    <div class="detail-sidebar">
        
        <div class="detail-card">
            <h4>🔄 Changer le statut</h4>
            <form method="POST" action="<?php echo e(route('admin.commandes.statut', $commande)); ?>">
                <?php echo csrf_field(); ?> <?php echo method_field('PUT'); ?>
                <select name="statut" class="form-select mb-2">
                    <?php $__currentLoopData = $statuts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $s): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <option value="<?php echo e($key); ?>" <?php echo e($commande->statut === $key ? 'selected':''); ?>><?php echo e($s['label']); ?></option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>
                <button type="submit" class="btn btn-orange btn-full btn-sm">Mettre à jour</button>
            </form>
        </div>

        
        <div class="detail-card">
            <h4>🎓 Assigner un expert</h4>
            <form method="POST" action="<?php echo e(route('admin.commandes.assigner', $commande)); ?>">
                <?php echo csrf_field(); ?> <?php echo method_field('PUT'); ?>
                <select name="expert_id" class="form-select mb-2">
                    <option value="">-- Choisir un expert --</option>
                    <?php $__currentLoopData = $experts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $e): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <option value="<?php echo e($e->id); ?>" <?php echo e($commande->expert_id === $e->id ? 'selected':''); ?>>
                        <?php echo e($e->nom_complet); ?>

                    </option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>
                <button type="submit" class="btn btn-outline-navy btn-full btn-sm">Assigner</button>
            </form>
        </div>

        
        <div class="detail-card">
            <h4>📱 Contacter le client</h4>
            <p><?php echo e($commande->client_email); ?></p>
            <p><?php echo e($commande->client_telephone); ?></p>
            <?php if($commande->client_telephone): ?>
            <a href="https://wa.me/<?php echo e(preg_replace('/[^0-9]/', '', $commande->client_telephone)); ?>?text=<?php echo e(rawurlencode('Bonjour, concernant votre commande '.$commande->reference.' — AcadémieOHADA')); ?>" target="_blank" class="btn btn-outline-navy btn-full btn-sm mt-1">💬 WhatsApp</a>
            <?php endif; ?>
        </div>

        <a href="<?php echo e(route('admin.commandes')); ?>" class="btn btn-outline-navy btn-full btn-sm">← Retour liste</a>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.dashboard', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\academieohada-laravel\academieohada\resources\views/admin/commandes/show.blade.php ENDPATH**/ ?>