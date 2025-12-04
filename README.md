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

# Organisation des Branches et Contenu

Ce projet est structuré de manière rigoureuse pour séparer les environnements de production, de développement et les fonctionnalités individuelles. Voici le détail de l'architecture Git.

## Branches Principales

* **`main`** : Contient la version stable et finale du site. C'est le code validé, prêt à être déployé en production.
* **`develop`** : Branche d'intégration où toutes les fonctionnalités sont rassemblées et testées avant d'être validées et fusionnées vers `main`.

## Branches de Fonctionnalités (Features)

Ces branches contiennent les fichiers spécifiques à chaque module du projet, respectant la séparation des responsabilités :

### `feature/authentification`
* **Contenu** : Pages de connexion et d'inscription (`login.html`), feuilles de styles associées (`login.css`), et diagrammes de flux (`Diagramme activiteSeconnecter.drawio`).
* **Objectif** : Gestion sécurisée des accès utilisateurs et des inscriptions.

### `feature/catalogue`
* **Contenu** : Page d'accueil (`accueil.html`, `accueil.css`), base de données simulée des produits (`products-data.js`) et logique d'affichage dynamique des détails (`product-detail.js`).
* **Objectif** : Présentation attractive des produits et navigation fluide dans le catalogue.

### `feature/panier`
* **Contenu** : Logique JavaScript du panier (`boutique.js`), persistance des données via `localStorage`, et algorithmes de calcul des totaux.
* **Objectif** : Gestion complète du cycle d'achat côté client, de l'ajout au paiement.

### `feature/documentation`
* **Contenu** : Spécifications fonctionnelles (`SpecFonc_ProgWeb-2.pdf`), diagrammes UML globaux (`Cas_utilisation_Prog_Web.drawio`) et documentation technique.
* **Objectif** : Centralisation de tous les documents de conception et de référence.

---

## Détail des Branches de Contribution (Implémentation)

En complément de la structure logique ci-dessus, le développement a été réparti sur les branches suivantes, correspondant aux contributions spécifiques des membres de l'équipe :

### 1. `FEZE-DJOUMESSI-FRED` (Backend & Admin Core)
Cette branche contient le cœur du Backend Laravel et l'interface d'administration.
* **Backend** : Structure complète Laravel (`app/`, `config/`, `routes/`).
* **Logique Métier** : Contrôleurs d'administration (`AdminOrderController.php`, `AdminProductController.php`) et gestion du panier (`CartController.php`).
* **Base de données** : Migrations pour les tables `users`, `produits`, `commandes` et seeders de données.
* **Vues Admin** : Templates Blade pour le tableau de bord (`tableau de bord.blade.php`) et la gestion des produits.

### 2. `TEKEU-KAMCHI-NATHAN-FRANCK` (Frontend UX)
Cette branche se concentre sur l'interface utilisateur et la conception visuelle.
* **Interfaces** : Fichiers `accueil.html` et `login.html` avec leurs styles CSS dédiés.
* **Logique JS** : Scripts d'affichage des détails produits (`product-detail.js`).
* **Conception** : Diagrammes de contexte et d'activité (`Diagramme-de-contexte...drawio`).

### 3. `TCHAPET-NGAMINI-ROLAIN` (Contact & Auth Backend)
Combine des fonctionnalités backend avec le module de contact.
* **Backend** : Contrôleurs d'authentification (`LoginController.php`, `RegisterController.php`) et de commande.
* **Module Contact** : Dossier dédié `contact/` contenant le formulaire HTML et le style CSS.
* **Documentation** : PDF technique sur la communication Frontend-Backend.

### 4. `Amina-AKOULOUZE` (Prototypage Admin UI)
Dédiée à l'intégration HTML/CSS du Back-office.
* **Maquettes** : Fichiers statiques pour toutes les pages admin (`admin-categories.html`, `admin-clients.html`, `admin-commandes.html`).
* **Styles** : Feuilles de style CSS spécifiques pour chaque section du tableau de bord.

### 5. `NBEUYO-KOLOGNE` (Architecture JS)
Spécialisée dans la modularisation du JavaScript Frontend.
* **Scripts** : Découpage de la logique en fichiers distincts : `boutique.js`, `categories.js`, `clients.js`, `commandes.js`.
* **Docs** : Cahier des charges fonctionnel (`SpecFonc_ProgWeb-2.pdf`).

### 6. `ESSONO-SANDRINE-FLORA` (Catalogue Boutique)
Gère l'affichage des catégories de produits.
* **Pages** : Fichiers HTML pour les rayons `femmes.html`, `hommes.html`, `materiel.html`.
* **Assets** : Banque d'images des produits dans le dossier `imagesprogrammation/`.

### 7. `ATCHINE-OUDAM-HANNIEL` (Accueil & Navigation)
Développe l'expérience d'accueil utilisateur.
* **Variantes** : Version standard `accueil.html` et version connectée `accueil_apres_connexion.html`.
* **Styles** : CSS pour la mise en page de l'accueil et du formulaire de contact.

### 8. `AHMED-JALIL` (Sécurité Backend)
Implémentation avancée de la sécurité Laravel.
* **Auth** : Logique d'authentification personnalisée dans `app/Http/Authentification/`.
* **API** : Définition des routes API et Web.
* **Modèles** : Modèles Eloquent pour `User`, `Produit`, `Commande`, `Panier`.

### 9. `NZUNGANG-MBOUM-FREDDY-LIONEL` (Vitrine & Docs)
Servant de vitrine et de référentiel documentaire.
* **Landing Page** : Fichier `apercu.html`.
* **Documentation** : Version PDF complète du projet et spécifications fonctionnelles.
* **Assets** : Images WebP et icônes pour l'interface.

### 10. `NJEMPOU-YAMPEN-RACHIDA` (Module Login)
Focalisée exclusivement sur l'interface de connexion.
* **Composants** : Structure isolée dans le dossier `page login/` avec HTML, CSS et JS dédiés.
* **Visuels** : Images d'arrière-plan spécifiques pour la page de connexion.

### 11. `OWONA-NGUINI-MATTEO-JORDAN` (Espace Utilisateur)
Gestion du profil client.
* **Interface** : Fichier `profil.html` pour l'affichage des données personnelles.
* **Design** : Fichier `style.css` unique pour cette section.

### 12. `AKOULOUZE-MANY-EVA-FELICIA-MEG` (Cas d'Utilisation)
Documentation des interactions et pages boutique.
* **Catalogue** : Pages `shop.html` et détails produits.
* **Analyse** : Document PDF détaillant les cas d'utilisation du système.

### 13. `admin-css-html` (Kit UI Admin)
Fournit les briques visuelles pour l'administration.
* **Styles** : CSS distincts pour dashboard, produits et catégories.
* **Vues** : Structures HTML de base pour l'interface administrateur.

### 14. `TP1` (Initialisation)
Snapshot de l'état initial du projet.
* **Contenu** : Version statique HTML/CSS de base (Accueil, Login, Contact).

### 15. `TP2` (Interactivité)
Snapshot de l'étape d'ajout du JavaScript.
* **Évolution** : Introduction des scripts `login.js` et `panier.js` pour dynamiser le statique.

### 16. `TP4` (Backend Avancé)
Version correspondant au rendu du TP4 Laravel.
* **Framework** : Structure Laravel complète avec tests unitaires et fonctionnels (`tests/Feature/`).

### 17. `d5f9f2ac...` (Main Snapshot)
Branche principale agissant comme point de convergence.
* **Intégration** : Rassemble les fichiers racines (`README.md`, `products-data.js`) et sert de base pour l'application globale.


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
- Frontend : HTML, CSS, JS

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
| NBEUYO KOLOGNE ULRICH MARTEL            | 22P204      | ulrich675     |
| AKOULOUZE JAMALI AMINA WENDY            | 22p340      | Amina-Akoulouze         |
| OWONA NGUINI MATTEO JORDAN              | 22p540      | Mattow-15               |
| NJEMPOU YAMPEN                          | 22p569      | rouchdayampen           |
| FEZE DJOUMESSI FRED                     | 22P334      | demuto21                |
| AHMED JALIL TADIDA D.                   | 22P265      | AHMED-X18               |
| ESSONO SANDRINE FLORA                            | 22P289      | flora-1141    |
|TEKEU KAMCHI NATHAN FRANCK               |  22p345 | Nathantekeu |          
---

