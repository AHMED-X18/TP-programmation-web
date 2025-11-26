document.addEventListener('DOMContentLoaded', () => {
    const conteneur = document.querySelector('.conteneur');
    const lienInscription = document.querySelector('.LienInscription');
    const lienConnexion = document.querySelector('.LienConnexion');
    const formConnexion = document.querySelector('.boite-formulaire.Connexion form');
    const formInscription = document.querySelector('.boite-formulaire.Inscription form');

    // Clé pour stocker les utilisateurs dans localStorage
    const USERS_KEY = 'registeredUsers';

    // Fonction pour récupérer les utilisateurs stockés
    function getUsers() {
        const users = localStorage.getItem(USERS_KEY);
        return users ? JSON.parse(users) : [];
    }

    // Fonction pour sauvegarder les utilisateurs
    function saveUsers(users) {
        localStorage.setItem(USERS_KEY, JSON.stringify(users));
    }

    // Basculement vers Inscription
    if (lienInscription) {
        lienInscription.addEventListener('click', (e) => {
            e.preventDefault();
            conteneur.classList.add('actif');
        });
    }

    // Basculement vers Connexion
    if (lienConnexion) {
        lienConnexion.addEventListener('click', (e) => {
            e.preventDefault();
            conteneur.classList.remove('actif');
        });
    }

    // Gestion de l'inscription
    function handleSignup(event) {
        event.preventDefault();

        const form = event.target;
        const username = form.username.value.trim();
        const email = form.email.value.trim();
        const password = form.password.value.trim();

        if (!username || !email || !password) {
            alert('Veuillez remplir tous les champs obligatoires.');
            return;
        }

        const users = getUsers();

        // Vérifier si l'utilisateur existe déjà
        if (users.some(user => user.username === username)) {
            alert('Ce nom d\'utilisateur existe déjà.');
            return;
        }

        // Ajouter le nouvel utilisateur (mot de passe en clair pour simplicité ; en prod, hashez-le !)
        users.push({ username, email, password });
        saveUsers(users);

        alert('Inscription réussie ! Vous pouvez maintenant vous connecter.');
        // Bascule vers la vue Connexion
        conteneur.classList.remove('actif');
    }

    // Gestion de la connexion
    function handleLogin(event) {
        event.preventDefault();

        const form = event.target;
        const username = form.username.value.trim();
        const password = form.password.value.trim();

        if (!username || !password) {
            alert('Veuillez remplir tous les champs obligatoires.');
            return;
        }

        const users = getUsers();

        // Vérifier les credentials
        const user = users.find(u => u.username === username && u.password === password);

        if (!user) {
            alert('Nom d\'utilisateur ou mot de passe incorrect.');
            return;
        }

        // Simulation de session
        localStorage.setItem('loggedInUser', JSON.stringify({ username }));

        // Redirection vers la page d'accueil (ajustez le chemin)
        window.location.href = '../source/accueil_apres_connexion.html';
    }

    // Attachement des événements submit
    if (formInscription) {
        formInscription.addEventListener('submit', handleSignup);
    }

    if (formConnexion) {
        formConnexion.addEventListener('submit', handleLogin);
    }
});