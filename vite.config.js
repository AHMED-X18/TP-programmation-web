import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                // Fichiers par défaut
                'resources/css/app.css',
                'resources/js/app.js',
                
                // CSS MIGRÉS (Liste exhaustive)
                'resources/css/accueil.css',
                'resources/css/reste.css', 
                'resources/css/login.css',
                'resources/css/profil.css',
                'resources/css/panier.css',
                'resources/css/contact.css', 
                
                // JS MIGRÉS
                'resources/js/login.js',
            ],
            refresh: true,
        }),
    ],
    server: {
        // Permet d'écouter sur le réseau local (souvent nécessaire sous Linux/VM/Docker)
        host: '0.0.0.0', 
        hmr: {
            host: 'localhost', // Le navigateur peut continuer à utiliser localhost pour le rafraîchissement
        },
    },
});