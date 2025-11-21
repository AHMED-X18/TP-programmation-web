# Sports AllShop – Site E-commerce

Ce projet est un exemple complet de site e-commerce développé dans le cadre d'un TP de programmation web. Il permet la vente en ligne de produits liés au sport (vêtements, électronique, accessoires), avec toutes les fonctionnalités essentielles.

## Objectifs du projet

Développer une application de vente en ligne avec :
- Un catalogue organisé par catégories.
- Un panier d'achat dynamique et persistant entre les sessions.
- Gestion des commandes et des clients.
- Espace client pour l’historique et modification des infos.
- Panneau d’administration pour la gestion des produits et commandes.
- Authentification utilisateur (inscription/connexion).
- Envoi de confirmation de commande par email.

## Fonctionnalités principales

### Côté client / visiteur
- Parcourir les produits par liste ou fiche détaillée.
- Filtrer les produits par catégorie.
- S’inscrire et se connecter à un compte.
- Ajouter et retirer des articles du panier, mis à jour dynamiquement (JavaScript).
- Calcul automatique du prix total.
- Valider le panier, remplir un formulaire de commande (nom, email, adresse) avec validation et recevoir la confirmation par mail.
- Consulter/modifier ses informations et accéder à l’historique des commandes.

### Côté administrateur
- Ajouter, modifier ou supprimer des produits (CRUD).
- Superviser les commandes, visualiser leur état et changer le statut (ex : "traitée", "expédiée") dans un tableau de bord.

## Logique du panier (front-end)

Le panier est géré via le fichier `boutique.js` :
- Stockage dans le localStorage du navigateur (`allSports_cart_v1`) pour une persistance entre sessions.
- Fonctions exposées : `addToCart`, `loadCart`, `saveCart`.
- Interface UI : badge du panier mis à jour en temps réel, boutons et formulaires associés.
- Affichage de notifications "toast" pour confirmer les actions de l'utilisateur.

## Pile technologique

- **Backend** : [Laravel](https://laravel.com/) (PHP)
- **Frontend** : HTML, CSS, JavaScript (gestion dynamique, validation formulaire)
- **Base de données** : MySQL ou PostgreSQL (via Laravel Eloquent)
- **CMS / API** : Intégration possible avec un CMS (ex. Strapi) via API REST pour gérer le contenu
- **Emailing** : Envoi des confirmations via Laravel Mailer

## Installation et lancement

### 1. Cloner le dépôt
```bash
git clone [URL_DU_DEPOT]
cd TP-programmation-web
```

### 2. Installer les dépendances
- Backend (PHP) :
    ```bash
    composer install
    ```
- Frontend (JS) :
    ```bash
    npm install
    ```

### 3. Configuration
- Copier `.env.example` vers `.env`.
- Renseigner vos identifiants de base de données (`DB_HOST`, `DB_DATABASE`, etc.)
- Renseigner vos paramètres email (`MAIL_MAILER`, `MAIL_HOST`, etc.)
- Renseigner l’URL de l’API du CMS (`CMS_API_URL`).

### 4. Initialisation Base de donnees
```bash
php artisan key:generate
php artisan migrate
```

### 5. Lancer le serveur Laravel
```bash
php artisan serve
```

## Aide et contribution

- Pour toute contribution, ouvrez une issue ou faites une pull-request.
- Pour démo, consulter le badge du panier, interagir avec les boutons et formulaires d’ajout au panier.

## Auteur

ATCHINE OUDAM HANNIEL 22P590 hanniel05
NZUNGANG MBOUM FREDDY LIONEL 22P437 Zouzou237
AKOULOUZE MANY EVA FÉLICIA 22P508 AkoulouzeMany
TCHAPET NGAMINI ROLAIN 22P608 ROLAINTCHAPET 
NBEUYO KOLOGNE ULRICH MARTEL 22P204  Ulrich ou Manitou
AKOULOUZE JAMALI AMINA WENDY 22p340 Amina-Akoulouze
OWONA NGUINI MATTEO JORDAN 22p540 Mattow-15
NJEMPOU YAMPEN 22p569 rouchdayampen
FEZE DJOUMESSI FRED 22P334 demuto21
AHMED JALIL TADIDA D.  22P265 AHMED-X18
---

Ce README couvre la structure et objectifs. Les détails techniques sont dans le code et la documentation Laravel.
