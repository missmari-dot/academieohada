<nav class="navbar" id="navbar">
    <div class="container">
        <a href="<?php echo e(route('accueil')); ?>" class="navbar-brand">
            <img src="<?php echo e(asset('images/logo.jpg')); ?>" alt="Logo AcadémieOHADA" class="navbar-logo-img">
            <div class="navbar-brand-text">
                <span class="brand-main">AcadémieRédactionOHADA</span>
                <span class="brand-sub">Rédaction · OHADA</span>
            </div>
        </a>

        <button class="nav-toggle" id="navToggle" aria-label="Menu" aria-expanded="false">
            <span></span><span></span><span></span>
        </button>

        <ul class="nav-menu" id="navMenu">

            
            <li class="nav-item">
                <a href="<?php echo e(route('accueil')); ?>" class="nav-link <?php echo e(request()->routeIs('accueil') ? 'active' : ''); ?>">Accueil</a>
            </li>
 
            
            <li class="nav-item has-dropdown">
                <a href="<?php echo e(route('services')); ?>" class="nav-link">
                    Services <span class="chevron">▾</span>
                </a>
                <div class="mega-menu">
                    <div class="mega-menu-inner">
                        <div class="mega-col">
                            <p class="mega-heading">── RÉDACTION ──</p>
                            <div class="mega-sub">
                                <p class="mega-sub-title">Rédaction</p>
                                <a href="<?php echo e(route('services')); ?>#rapport">Rapport de stage</a>
                                <a href="<?php echo e(route('services')); ?>#cv">CV + Lettre de motivation</a>
                                <a href="<?php echo e(route('services')); ?>#dissertation">Dissertation</a>
                                <a href="<?php echo e(route('services')); ?>#flyers">Flyers / Affiches / Cartes</a>
                                <a href="<?php echo e(route('services')); ?>" class="voir-tout">Tout voir →</a>
                            </div>
                        </div>
                        <div class="mega-col">
                            <p class="mega-sub-title">Mémoires</p>
                            <a href="<?php echo e(route('memoires')); ?>#francais">Français</a>
                            <a href="<?php echo e(route('memoires')); ?>#sociales">Sciences Sociales</a>
                            <a href="<?php echo e(route('memoires')); ?>#eco">Sciences Économiques</a>
                            <a href="<?php echo e(route('memoires')); ?>#juridiques">Sciences Juridiques</a>
                            <a href="<?php echo e(route('memoires')); ?>#pol">Sciences Juridiques & Politiques</a>
                        </div>
                        <div class="mega-col">
                            <p class="mega-heading">── ACCOMPAGNEMENT ──</p>
                            <a href="<?php echo e(route('services')); ?>#correction">Correction & Relecture</a>
                            <a href="<?php echo e(route('services')); ?>#formation">Formation en méthodologie</a>
                            <a href="<?php echo e(route('services')); ?>#suivi">Suivi & Accompagnement</a>
                        </div>
                    </div>
                </div>
            </li>
 
            
            <li class="nav-item">
                <a href="<?php echo e(route('tarifs')); ?>" class="nav-link <?php echo e(request()->routeIs('tarifs') ? 'active' : ''); ?>">Tarifs</a>
            </li>
 
            
            <li class="nav-item has-dropdown">
                <a href="#" class="nav-link">
                    Plus <span class="chevron">▾</span>
                </a>
                <div class="dropdown-menu">
                    <p class="dropdown-heading">À PROPOS</p>
                    <a href="<?php echo e(route('a-propos')); ?>">Qui sommes-nous ?</a>
                    <a href="<?php echo e(route('equipe')); ?>">Notre équipe</a>
                    <a href="<?php echo e(route('a-propos')); ?>#garanties">Garanties</a>
                    <hr>
                    <p class="dropdown-heading">RESSOURCES</p>
                    <a href="<?php echo e(route('ressources')); ?>#rediger">Comment rédiger</a>
                    <a href="<?php echo e(route('ressources')); ?>#sujet">Choisir un sujet</a>
                    <a href="<?php echo e(route('ressources')); ?>#faq">FAQ</a>
                </div>
            </li>
 
            
            <li class="nav-item has-dropdown">
                <a href="<?php echo e(route('contact')); ?>" class="nav-link">
                    Contact <span class="chevron">▾</span>
                </a>
                <div class="dropdown-menu">
                    <a href="<?php echo e(route('contact')); ?>">Contact général</a>
                    <a href="<?php echo e(route('reclamations')); ?>">Réclamations</a>
                </div>
            </li>
 
            
            <?php if(auth()->guard()->check()): ?>
                <li class="nav-item has-dropdown">
                    <a href="#" class="nav-link user-link">
                        <?php echo e(auth()->user()->prenom); ?> <span class="chevron">▾</span>
                    </a>
                    <div class="dropdown-menu">
                        <?php if(auth()->user()->hasRole('super_admin')): ?>
                            <a href="<?php echo e(route('admin.dashboard')); ?>">Administration</a>
                        <?php elseif(auth()->user()->hasRole('expert')): ?>
                            <a href="<?php echo e(route('expert.dashboard')); ?>">Espace Expert</a>
                        <?php else: ?>
                            <a href="<?php echo e(route('client.dashboard')); ?>">Espace Client</a>
                        <?php endif; ?>
                        <hr>
                        <form action="<?php echo e(route('logout')); ?>" method="POST" id="logout-form" style="display: none;">
                            <?php echo csrf_field(); ?>
                        </form>
                        <a href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" class="text-red">
                            Déconnexion
                        </a>
                    </div>
                </li>
            <?php else: ?>
                <li class="nav-item has-dropdown">
                    <a href="#" class="nav-link">Compte <span class="chevron">▾</span></a>
                    <div class="dropdown-menu">
                        <a href="<?php echo e(route('login')); ?>">Connexion</a>
                        <a href="<?php echo e(route('register')); ?>">Inscription</a>
                    </div>
                </li>
            <?php endif; ?>
 
            
            <li class="nav-item">
                <a href="<?php echo e(route('devis')); ?>" class="btn btn-orange btn-sm nav-cta">Devis</a>
            </li>
        </ul>
    </div>
</nav>
<?php /**PATH D:\academieohada-laravel\academieohada\resources\views/partials/navbar.blade.php ENDPATH**/ ?>