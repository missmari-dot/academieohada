<nav class="navbar" id="navbar">
    <div class="container">
        <a href="{{ route('accueil') }}" class="navbar-brand">
            <img src="{{ asset('images/logo.jpg') }}" alt="Logo AcadémieOHADA" class="navbar-logo-img">
            <div class="navbar-brand-text">
                <span class="brand-main">AcadémieRédactionOHADA</span>
                <span class="brand-sub">Rédaction · OHADA</span>
            </div>
        </a>

        <button class="nav-toggle" id="navToggle" aria-label="Menu" aria-expanded="false">
            <span></span><span></span><span></span>
        </button>

        <ul class="nav-menu" id="navMenu">

            {{-- Accueil --}}
            <li class="nav-item">
                <a href="{{ route('accueil') }}" class="nav-link {{ request()->routeIs('accueil') ? 'active' : '' }}">Accueil</a>
            </li>
 
            {{-- Nos Services (mega-menu) --}}
            <li class="nav-item has-dropdown">
                <a href="{{ route('services') }}" class="nav-link">
                    Services <span class="chevron">▾</span>
                </a>
                <div class="mega-menu">
                    <div class="mega-menu-inner">
                        <div class="mega-col">
                            <p class="mega-heading">── RÉDACTION ──</p>
                            <div class="mega-sub">
                                <p class="mega-sub-title">Rédaction</p>
                                <a href="{{ route('services') }}#rapport">Rapport de stage</a>
                                <a href="{{ route('services') }}#cv">CV + Lettre de motivation</a>
                                <a href="{{ route('services') }}#dissertation">Dissertation</a>
                                <a href="{{ route('services') }}#flyers">Flyers / Affiches / Cartes</a>
                                <a href="{{ route('services') }}" class="voir-tout">Tout voir →</a>
                            </div>
                        </div>
                        <div class="mega-col">
                            <p class="mega-sub-title">Mémoires</p>
                            <a href="{{ route('memoires') }}#francais">Français</a>
                            <a href="{{ route('memoires') }}#sociales">Sciences Sociales</a>
                            <a href="{{ route('memoires') }}#eco">Sciences Économiques</a>
                            <a href="{{ route('memoires') }}#juridiques">Sciences Juridiques</a>
                            <a href="{{ route('memoires') }}#pol">Sciences Juridiques & Politiques</a>
                        </div>
                        <div class="mega-col">
                            <p class="mega-heading">── ACCOMPAGNEMENT ──</p>
                            <a href="{{ route('services') }}#correction">Correction & Relecture</a>
                            <a href="{{ route('services') }}#formation">Formation en méthodologie</a>
                            <a href="{{ route('services') }}#suivi">Suivi & Accompagnement</a>
                        </div>
                    </div>
                </div>
            </li>
 
            {{-- Tarifs --}}
            <li class="nav-item">
                <a href="{{ route('tarifs') }}" class="nav-link {{ request()->routeIs('tarifs') ? 'active' : '' }}">Tarifs</a>
            </li>
 
            {{-- Informations (Combined À propos + Ressources) --}}
            <li class="nav-item has-dropdown">
                <a href="#" class="nav-link">
                    Plus <span class="chevron">▾</span>
                </a>
                <div class="dropdown-menu">
                    <p class="dropdown-heading">À PROPOS</p>
                    <a href="{{ route('a-propos') }}">Qui sommes-nous ?</a>
                    <a href="{{ route('equipe') }}">Notre équipe</a>
                    <a href="{{ route('a-propos') }}#garanties">Garanties</a>
                    <hr>
                    <p class="dropdown-heading">RESSOURCES</p>
                    <a href="{{ route('ressources') }}#rediger">Comment rédiger</a>
                    <a href="{{ route('ressources') }}#sujet">Choisir un sujet</a>
                    <a href="{{ route('ressources') }}#faq">FAQ</a>
                </div>
            </li>
 
            {{-- Nous contacter --}}
            <li class="nav-item has-dropdown">
                <a href="{{ route('contact') }}" class="nav-link">
                    Contact <span class="chevron">▾</span>
                </a>
                <div class="dropdown-menu">
                    <a href="{{ route('contact') }}">Contact général</a>
                    <a href="{{ route('reclamations') }}">Réclamations</a>
                </div>
            </li>
 
            {{-- Auth links --}}
            @auth
                <li class="nav-item has-dropdown">
                    <a href="#" class="nav-link user-link">
                        {{ auth()->user()->prenom }} <span class="chevron">▾</span>
                    </a>
                    <div class="dropdown-menu">
                        @if(auth()->user()->hasRole('super_admin'))
                            <a href="{{ route('admin.dashboard') }}">Administration</a>
                        @elseif(auth()->user()->hasRole('expert'))
                            <a href="{{ route('expert.dashboard') }}">Espace Expert</a>
                        @else
                            <a href="{{ route('client.dashboard') }}">Espace Client</a>
                        @endif
                        <hr>
                        <form action="{{ route('logout') }}" method="POST" id="logout-form" style="display: none;">
                            @csrf
                        </form>
                        <a href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" class="text-red">
                            Déconnexion
                        </a>
                    </div>
                </li>
            @else
                <li class="nav-item has-dropdown">
                    <a href="#" class="nav-link">Compte <span class="chevron">▾</span></a>
                    <div class="dropdown-menu">
                        <a href="{{ route('login') }}">Connexion</a>
                        <a href="{{ route('register') }}">Inscription</a>
                    </div>
                </li>
            @endauth
 
            {{-- CTA Devis --}}
            <li class="nav-item">
                <a href="{{ route('devis') }}" class="btn btn-orange btn-sm nav-cta">Devis</a>
            </li>
        </ul>
    </div>
</nav>
