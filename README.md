# Sports AllShop – Site E-commerce

Ce projet est un exemple complet de site e-commerce développé dans le cadre d'un TP de programmation web. Il permet la vente en ligne de produits liés au sport (vêtements, électronique, accessoires…).

L’objectif principal du site est de permettre à toute personne de trouver et acheter facilement des articles sportifs en ligne, en profitant d’une navigation fluide, d’un panier interactif et d’une gestion sécurisée des commandes.

## Ce que fait le site (Résumé des fonctionnalités)

| Fonctionnalité                                    | Description détaillée                                                                                                        |
|---------------------------------------------------|-----------------------------------------------------------------------------------------------------------------------------|
| Catalogue par catégories                          | Présentation des produits répartis en catégories pour une navigation rapide et intuitive                                     |
| Fiches produits complètes                         | Détail des caractéristiques (photo, prix, description…), filtres par catégorie                                              |
| Ajout d’articles au panier                        | Sélection d’articles, ajout et retrait dynamique, affichage du montant total                                                |
| Panier persistant                                 | Stockage du panier en localStorage pour conserver les sélections entre les sessions utilisateur                             |
| Modification du panier                            | Possibilité de modifier les quantités ou de retirer chaque article, avec interface réactive                                 |
| Validation du panier                              | Formulaire complet de commande (nom, email, adresse…), validation et confirmation par email                                 |
| Espace utilisateur                                | Visualisation et modification des infos personnelles, accès à l’historique des commandes                                    |
| Authentification                                 | Inscription et connexion sécurisées, gestion des sessions utilisateurs                                                      |
| Suivi des commandes                              | Visualisation de l’état des commandes passées (en cours, expédiées…)                                                        |
| Administration                                    | Tableau de bord pour ajouter/éditer/supprimer produits, surveiller les commandes et gérer les utilisateurs                  |
| Gestion des utilisateurs                          | Possibilité pour les administrateurs de voir, modifier ou supprimer les comptes clients                                     |
| Sécurisation et validation                        | Validation côté client et serveur, contrôle des accès, sécurisation des transactions et des données                        |
| Notifications dynamiques                          | Toasts et messages de confirmation ou d’erreur lors des actions (ajout au panier, commande, authentification…)             |
| Envoi automatique d’emails                        | Notification automatique à la confirmation d’une commande                                                                  |
| Design responsive                                 | Interface adaptée à tous les supports (PC, mobile, tablette)                                                               |
| Technologie moderne                               | Front-end en HTML/CSS/JS, back-end en PHP Laravel, base de données relationnelle                                            |

## Objectifs du projet

Développer une application de vente en ligne avec :
- Un catalogue organisé par catégories.
- Un panier d'achat dynamique et persistant entre les sessions.
- Gestion des commandes et des clients.
- Espace client pour l’historique et modification des infos.
- Panneau d’administration pour la gestion des produits et commandes.
- Authentification utilisateur (inscription/connexion).
- Envoi de confirmation de commande par email.

## Logique du panier (front-end)

Le panier est géré via le fichier `boutique.js` :
- Stockage dans le localStorage du navigateur (`allSports_cart_v1`) pour une persistance entre sessions.
- Fonctions exposées : `addToCart`, `loadCart`, `saveCart`.
- Interface UI : badge du panier mis à jour en temps réel, boutons et formulaires associés.
- Affichage de notifications "toast" pour confirmer les actions de l'utilisateur.

## Pile technologique

- HTML/CSS pour la mise en page et le design responsive.
- JavaScript pour le dynamisme du panier et la validation côté client.
- PHP (Laravel) pour la partie serveur, gestion des données, envoi d’emails et sécurité.
- Base de données relationnelle pour stocker produits, utilisateurs et commandes.
- Envoi automatique de mails lors de la confirmation d’une commande.

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

### 4. Initialisation Base de données
```bash
php artisan key:generate
php artisan migrate
```

### 5. Lancer le serveur Laravel
```bash
php artisan serve
```

## Auteurs du projet

| Nom complet                              | Matricule   | Identifiant GitHub      |
|------------------------------------------|-------------|-------------------------|
| ATCHINE OUDAM HANNIEL                   | 22P590      | hanniel05               |
| NZUNGANG MBOUM FREDDY LIONEL            | 22P437      | Zouzou237               |
| AKOULOUZE MANY EVA FÉLICIA              | 22P508      | AkoulouzeMany           |
| TCHAPET NGAMINI ROLAIN                  | 22P608      | ROLAINTCHAPET           |
| NBEUYO KOLOGNE ULRICH MARTEL            | 22P204      | Ulrich ou Manitou       |
| AKOULOUZE JAMALI AMINA WENDY            | 22p340      | Amina-Akoulouze         |
| OWONA NGUINI MATTEO JORDAN              | 22p540      | Mattow-15               |
| NJEMPOU YAMPEN                          | 22p569      | rouchdayampen           |
| FEZE DJOUMESSI FRED                     | 22P334      | demuto21                |
| AHMED JALIL TADIDA D.                   | 22P265      | AHMED-X18               |
| ESSONO FLORA                            | 22P289      | flora-1141              |

---

