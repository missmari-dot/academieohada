# AcadémieOHADA — Plateforme de rédaction académique

> Service professionnel de rédaction de mémoires et accompagnement académique  
> pour les étudiants des pays membres de l'OHADA, l'UEMOA et la CEDEAO.

---

## 📋 Table des matières

1. [Présentation du projet](#présentation)
2. [Technologies utilisées](#technologies)
3. [Prérequis](#prérequis)
4. [Installation](#installation)
5. [Configuration](#configuration)
6. [Structure du projet](#structure)
7. [Rôles & Accès](#rôles)
8. [Pages & Routes](#routes)
9. [Fonctionnalités](#fonctionnalités)
10. [Sécurité](#sécurité)
11. [Déploiement production](#déploiement)

---

## Présentation

AcadémieOHADA est une plateforme web complète développée avec **Laravel 11** qui permet :

- **Aux étudiants** : demander des devis, suivre leurs commandes, télécharger leurs livrables
- **Aux experts** : recevoir leurs commandes assignées et livrer les travaux
- **À l'administrateur** : gérer l'intégralité de l'activité (commandes, experts, candidatures, messages)

### Flux principal

```
Étudiant → Formulaire devis → WhatsApp admin → Commande créée
→ Expert assigné → Travail livré → Client notifié → Téléchargement
```

---

## Technologies

| Couche | Technologie |
|--------|------------|
| Framework | Laravel 11 |
| Auth & Rôles | Laravel Breeze + Spatie Permission |
| OAuth | Laravel Socialite (Google) |
| Email | Laravel Notifications (Gmail SMTP) |
| PDF | barryvdh/laravel-dompdf |
| Anti-spam | msurguy/honeypot |
| Frontend | Blade + CSS custom (Cormorant Garamond + Outfit) |
| Base de données | MySQL 8+ |
| Storage | Laravel Storage (private) |

---

## Prérequis

- PHP **8.2+** avec extensions : `mbstring`, `openssl`, `pdo`, `tokenizer`, `xml`, `ctype`, `json`, `bcmath`, `fileinfo`
- **Composer** 2.x
- **MySQL** 8.0+
- **Node.js** 18+ (optionnel, pour assets)
- Compte **Gmail** avec App Password activé
- Projet **Google Cloud** avec OAuth2 configuré (pour connexion Google)

---

## Installation

### 1. Cloner le projet

```bash
git clone https://github.com/votre-repo/academieohada.git
cd academieohada
```

### 2. Installer les dépendances PHP

```bash
composer install
```

### 3. Configurer l'environnement

```bash
cp .env.example .env
php artisan key:generate
```

### 4. Créer la base de données

```sql
CREATE DATABASE academieohada CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
```

### 5. Lancer les migrations + seeder

```bash
php artisan migrate --seed
```

> ⚠️ Le seeder crée automatiquement le compte super admin :  
> **Email** : `academie.redactionohada@gmail.com`  
> **Mot de passe** : `Admin@2025!` ← **À changer immédiatement !**

### 6. Créer le lien storage

```bash
php artisan storage:link
```

### 7. Démarrer le serveur

```bash
php artisan serve
# → http://localhost:8000
```

---

## Configuration

Éditez le fichier `.env` avec vos vraies valeurs :

### Base de données

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=academieohada
DB_USERNAME=root
DB_PASSWORD=votre_mot_de_passe
```

### Email (Gmail SMTP + App Password)

```env
MAIL_MAILER=smtp
MAIL_HOST=smtp.gmail.com
MAIL_PORT=587
MAIL_USERNAME=academie.redactionohada@gmail.com
MAIL_PASSWORD=xxxx_xxxx_xxxx_xxxx   # App Password Gmail (pas le vrai mdp)
MAIL_ENCRYPTION=tls
MAIL_FROM_ADDRESS=academie.redactionohada@gmail.com
MAIL_FROM_NAME="AcadémieOHADA"
```

> 📌 Pour obtenir un App Password Gmail :  
> Mon compte Google → Sécurité → Validation en 2 étapes → Mots de passe d'application

### Google OAuth

```env
GOOGLE_CLIENT_ID=votre_client_id.apps.googleusercontent.com
GOOGLE_CLIENT_SECRET=votre_secret
GOOGLE_REDIRECT_URI=https://votre-domaine.com/auth/google/callback
```

> 📌 Créer les identifiants sur [console.cloud.google.com](https://console.cloud.google.com)  
> → APIs & Services → Identifiants → OAuth 2.0 → Ajouter l'URI de redirection

### WhatsApp admin

```env
ADMIN_WHATSAPP=221775646246
ADMIN_EMAIL=academie.redactionohada@gmail.com
ADMIN_NAME="Diabel"
```

---

## Structure du projet

```
academieohada/
│
├── app/
│   ├── Http/
│   │   ├── Controllers/
│   │   │   ├── Auth/           # Login, Register, Google, Candidature
│   │   │   ├── Admin/          # 8 controllers admin
│   │   │   ├── Client/         # Dashboard, Commande, Profil
│   │   │   ├── Expert/         # Dashboard, Commande, Profil
│   │   │   ├── PageController.php
│   │   │   ├── DevisController.php
│   │   │   ├── ContactController.php
│   │   │   └── ReclamationController.php
│   │   └── Middleware/
│   │       ├── CheckRole.php       # Vérification rôle Spatie
│   │       └── SecurityHeaders.php # En-têtes de sécurité HTTP
│   ├── Models/
│   │   ├── User.php           # Utilisateurs (admin/expert/client)
│   │   ├── Commande.php       # Commandes avec référence auto
│   │   ├── Candidature.php    # Candidatures experts
│   │   ├── Fichier.php        # Fichiers livrés
│   │   ├── Message.php        # Messages de contact
│   │   ├── Reclamation.php    # Réclamations & suggestions
│   │   └── NotificationAdmin.php
│   ├── Notifications/         # 9 notifications email
│   └── Policies/
│       └── CommandePolicy.php  # Client voit seulement SES commandes
│
├── database/
│   ├── migrations/            # 4 fichiers de migration
│   └── seeders/
│       └── DatabaseSeeder.php # Crée le super admin + rôles
│
├── resources/views/
│   ├── layouts/
│   │   ├── app.blade.php        # Layout public
│   │   └── dashboard.blade.php  # Layout espaces privés
│   ├── partials/
│   │   ├── navbar.blade.php     # Navbar avec mega-menu
│   │   └── footer.blade.php
│   ├── auth/                  # 7 vues authentification
│   ├── pages/                 # 10 pages publiques
│   ├── client/                # 4 vues espace client
│   ├── expert/                # 4 vues espace expert
│   └── admin/                 # 14 vues espace admin
│
├── public/
│   ├── css/
│   │   ├── ohada.css          # Design system complet (1200+ lignes)
│   │   └── dashboard.css      # Styles espaces privés
│   └── js/
│       └── ohada.js           # Navbar mobile, animations, utils
│
└── routes/
    └── web.php                # Toutes les routes (40+)
```

---

## Rôles & Accès

| Rôle | Création | Accès |
|------|----------|-------|
| `super_admin` | Manuel en base (seeder) | `/admin/*` — gestion totale |
| `expert` | Validé par l'admin depuis `/admin/candidatures` | `/expert/*` — commandes assignées |
| `client` | Inscription publique `/inscription` ou Google | `/client/*` — ses commandes uniquement |

### Redirection après connexion

```
/connexion
├── super_admin  → /admin/dashboard
├── expert       → /expert/dashboard
└── client       → /client/dashboard
```

---

## Routes

### Pages publiques

| Route | Description |
|-------|-------------|
| `GET /` | Page d'accueil |
| `GET /services` | Tous les services |
| `GET /memoires` | Mémoires par discipline |
| `GET /tarifs` | Grille tarifaire interactive |
| `GET /devis` | Formulaire de devis (7 étapes) |
| `GET /a-propos` | Mission, équipe, garanties, institutions |
| `GET /notre-equipe` | Présentation des experts |
| `GET /nous-contacter` | Formulaire de contact |
| `GET /reclamations` | Réclamations & suggestions |
| `GET /ressources` | Guides, méthodologie, FAQ |

### Authentification

| Route | Description |
|-------|-------------|
| `GET /connexion` | Page de connexion |
| `GET /inscription` | Inscription client |
| `GET /rejoindre` | Candidature expert |
| `GET /auth/google` | OAuth Google |

### Espace Client `/client/*`

| Route | Description |
|-------|-------------|
| `GET /client/dashboard` | Tableau de bord |
| `GET /client/commandes` | Liste des commandes |
| `GET /client/commandes/{id}` | Détail + timeline + téléchargements |
| `GET /client/profil` | Modifier le profil |

### Espace Expert `/expert/*`

| Route | Description |
|-------|-------------|
| `GET /expert/dashboard` | Tableau de bord |
| `GET /expert/commandes` | Commandes assignées |
| `GET /expert/commandes/{id}` | Détail + formulaire livraison |
| `POST /expert/commandes/{id}/livrer` | Livrer PDF + DOCX |

### Espace Admin `/admin/*`

| Route | Description |
|-------|-------------|
| `GET /admin/dashboard` | Dashboard + notifications |
| `GET /admin/commandes` | Toutes les commandes |
| `PUT /admin/commandes/{id}/statut` | Changer statut |
| `PUT /admin/commandes/{id}/assigner` | Assigner expert |
| `GET /admin/candidatures` | Candidatures experts |
| `PUT /admin/candidatures/{id}/valider` | Créer compte expert |
| `PUT /admin/candidatures/{id}/refuser` | Refuser + notifier |
| `GET /admin/clients` | Liste des clients |
| `GET /admin/experts` | Liste des experts |
| `GET /admin/messages` | Messages de contact |
| `GET /admin/reclamations` | Réclamations & suggestions |
| `GET /admin/statistiques` | CA, commandes, graphiques |

---

## Fonctionnalités

### ✅ Implémentées

- **Authentification complète** : email/password + Google OAuth + vérification email
- **3 rôles distincts** : super_admin, expert, client (Spatie Permission)
- **Formulaire devis 7 étapes** avec récapitulatif temps réel en JavaScript
- **Calcul automatique** des prix selon niveau (Master/Licence), parties et délai
- **Redirection WhatsApp** avec message pré-rempli structuré
- **Candidatures experts** : soumission → examen admin → création compte automatique
- **Notifications email** : 9 types différents (nouveau devis, candidature, livraison…)
- **Notifications admin** multi-canal : email + badge dashboard + lien WhatsApp
- **Espace client** : suivi timeline, téléchargement sécurisé des livrables
- **Espace expert** : réception commandes, upload PDF+DOCX, notification client
- **Espace admin** : gestion complète, statistiques, filtres, actions en masse
- **Policy Laravel** : client voit UNIQUEMENT ses propres commandes
- **Storage privé** : fichiers inaccessibles par URL directe, download contrôlé
- **Rate limiting** : throttle sur tous les formulaires publics
- **Headers de sécurité** : X-Frame-Options, CSP, HSTS, etc.
- **Références automatiques** : CMD-2025-0001, CMD-2025-0002…
- **Mega-menu navbar** avec sous-catégories par discipline
- **Design responsive** : mobile-first, adaptatif tablette et desktop
- **Toggle Master/Licence** sur la page tarifs
- **FAQ intégré** sur la page contact et ressources

### 🔔 Notifications déclenchées automatiquement

| Événement | Email admin | Dashboard | Email destinataire |
|-----------|------------|-----------|-------------------|
| Nouveau devis | ✅ | ✅ badge | — |
| Nouveau message | ✅ | ✅ badge | — |
| Nouvelle candidature | ✅ | ✅ badge | — |
| Nouvelle réclamation | — | ✅ badge | — |
| Nouveau client | ✅ | ✅ | — |
| Candidature validée | — | — | ✅ expert |
| Candidature refusée | — | — | ✅ candidat |
| Expert assigné | — | — | ✅ expert |
| Commande livrée | ✅ | ✅ | ✅ client |
| Statut modifié | — | — | ✅ client |

---

## Sécurité

### Authentification
- Mots de passe hashés avec **bcrypt** (`Hash::make()`)
- **Rate limiting** : 5 tentatives max / 15 min par route de connexion
- Email vérifié obligatoire avant accès au dashboard
- Tokens de réinitialisation expirés après 60 min
- Sessions révocables

### Autorisation
- Middleware `role` sur chaque groupe de routes
- **CommandePolicy** : client voit UNIQUEMENT ses commandes
- Super admin créé **uniquement via seeder** (pas d'inscription possible)
- Compte désactivé = déconnexion forcée immédiate

### Formulaires
- Token CSRF sur tous les formulaires Blade
- Throttle `throttle:5,1` sur toutes les soumissions publiques
- Validation serveur stricte sur tous les champs

### Fichiers
- Stockage dans `storage/app/private/` (inaccessible via URL)
- Téléchargement via `Storage::download()` avec vérification ownership
- UUID pour les noms de fichiers (pas de path traversal)
- Validation MIME type + taille max

### HTTP
- Headers de sécurité automatiques (SecurityHeaders middleware)
- HTTPS forcé en production via `URL::forceScheme('https')`
- `APP_DEBUG=false` en production (dans `.env.example`)

---

## Déploiement production

### 1. Variables d'environnement critiques

```env
APP_ENV=production
APP_DEBUG=false
APP_URL=https://votre-domaine.com
```

### 2. Optimisations Laravel

```bash
php artisan config:cache
php artisan route:cache
php artisan view:cache
php artisan optimize
```

### 3. Permissions

```bash
chmod -R 755 storage bootstrap/cache
chown -R www-data:www-data storage bootstrap/cache
```

### 4. Configuration Nginx (exemple)

```nginx
server {
    listen 443 ssl;
    server_name academieohada.com www.academieohada.com;

    root /var/www/academieohada/public;
    index index.php;

    location / {
        try_files $uri $uri/ /index.php?$query_string;
    }

    location ~ \.php$ {
        fastcgi_pass unix:/var/run/php/php8.2-fpm.sock;
        fastcgi_index index.php;
        include fastcgi_params;
        fastcgi_param SCRIPT_FILENAME $document_root$fastcgi_script_name;
    }

    # Bloquer l'accès direct au storage privé
    location ~* /storage/private {
        deny all;
    }

    ssl_certificate     /etc/letsencrypt/live/academieohada.com/fullchain.pem;
    ssl_certificate_key /etc/letsencrypt/live/academieohada.com/privkey.pem;
}
```

### 5. SSL Let's Encrypt

```bash
apt install certbot python3-certbot-nginx
certbot --nginx -d academieohada.com -d www.academieohada.com
```

### 6. Cron jobs (Laravel Scheduler)

```bash
# crontab -e
* * * * * cd /var/www/academieohada && php artisan schedule:run >> /dev/null 2>&1
```

### 7. Queue worker (pour les emails asynchrones)

```bash
# Avec Supervisor
php artisan queue:work --sleep=3 --tries=3 --daemon
```

---

## Informations de contact (configurées)

| Canal | Valeur |
|-------|--------|
| WhatsApp | +221 77 564 62 46 |
| Email | academie.redactionohada@gmail.com |
| Localisation | Dakar, Sénégal |
| Horaires | Lun–Sam 8h–20h |

---

## Packages installés

```json
{
    "laravel/framework": "^11.0",
    "laravel/socialite": "^5.12",
    "spatie/laravel-permission": "^6.4",
    "barryvdh/laravel-dompdf": "^2.2",
    "msurguy/honeypot": "^1.0",
    "laravel/breeze": "^2.1"
}
```

---

## Licence

Projet privé — AcadémieOHADA © 2025. Tous droits réservés.

---

*Développé avec ❤️ pour les étudiants des pays membres de l'OHADA*
