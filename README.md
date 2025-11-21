Projet : Site E-commerce "Sports AllShop"
Il s'agit d'un projet de programmation web visant à développer un site e-commerce complet. Le site, nommé "Sports AllShop", permet la vente de produits organisés par catégories (vêtements, électronique, accessoires).

Le projet inclut un catalogue de produits, un panier d'achat fonctionnel, un système de gestion des commandes, des clients et des produits, ainsi qu'une authentification.

Fonctionnalités Principales
Le site est divisé en deux parties principales : les fonctionnalités accessibles aux clients/visiteurs et le panneau de gestion pour les administrateurs.

Fonctionnalités Client / Visiteur
Navigation : Les utilisateurs peuvent consulter la liste des produits et voir les détails sur une fiche produit dédiée.

Filtrage : Les produits peuvent être filtrés par catégorie.

Authentification : Les utilisateurs peuvent s'inscrire et se connecter à leur compte.

Panier d'achat :

Ajouter des produits au panier. Le panier est dynamique et mis à jour en JavaScript.

Supprimer des produits du panier.

Le prix total est calculé automatiquement.

Processus de Commande :

Valider le panier.

Remplir un formulaire de commande (nom, email, adresse) avec validation des champs.

Valider la commande.

Recevoir une confirmation de commande par email.

Espace Client :

Consulter et modifier les informations de profil.

Consulter l'historique des commandes passées.

Fonctionnalités Administrateur
Gestion des Produits (CRUD) :

Ajouter de nouveaux produits.

Modifier les produits existants.

Supprimer des produits.

Gestion des Commandes :

Accéder à un tableau de bord pour visualiser et suivre les commandes.

Changer le statut d'une commande (ex: "traitée", "expédiée").

Logique du Panier (côté client)
Le fichier boutique.js gère l'interactivité du panier d'achat côté client :

Stockage : Utilise le localStorage du navigateur (sous la clé allSports_cart_v1) pour conserver le panier entre les sessions.

Fonctions : Expose des fonctions pour ajouter (addToCart), charger (loadCart), et sauvegarder (saveCart) le panier.

Interface Utilisateur (UI) :

Met à jour dynamiquement le badge du panier (.cart-badge) pour refléter la quantité totale d'articles.

Gère les événements sur les boutons (.add-to-cart) et les formulaires (.add-to-cart-form) pour ajouter des produits.

Affiche des notifications "toast" pour confirmer les actions de l'utilisateur.

Pile Technologique
Ce projet est construit en utilisant les technologies suivantes, comme défini dans les spécifications :

Backend : Laravel (Framework PHP)

Frontend : HTML, CSS, JavaScript (pour la validation et la gestion dynamique du panier)

Base de données : MySQL ou PostgreSQL (gérée via Laravel Eloquent)

CMS / API : Intégration avec un CMS (ex: Strapi) via API REST pour la gestion du contenu des produits.

Emailing : Laravel Mailer (pour l'envoi des confirmations de commande)
Installation et Lancement (Exemple)
Cloner le dépôt :

Bash

git clone [URL_DU_DEPOT]
cd TP-programmation-web
Installer les dépendances Backend (PHP) :

Bash

composer install
Installer les dépendances Frontend (JS) :

Bash

npm install
Configuration :

Copiez .env.example vers .env.

Configurez vos identifiants de base de données (DB_HOST, DB_DATABASE, etc.).

Configurez votre service d'email (MAIL_MAILER, MAIL_HOST, etc.).

Configurez l'URL de l'API de votre CMS (CMS_API_URL).

Base de données :

Bash

php artisan key:generate
php artisan migrate
Lancer le serveur :

Bash

php artisan serve
