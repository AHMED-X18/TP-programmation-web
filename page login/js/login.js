const conteneur = document.querySelector('.conteneur');
const lienInscription = document.querySelector('.LienInscription');
const lienConnexion = document.querySelector('.LienConnexion');

lienInscription.addEventListener('click', (e) => {
    e.preventDefault();
    conteneur.classList.add('actif');
});

lienConnexion.addEventListener('click', (e) => {
    e.preventDefault();
    conteneur.classList.remove('actif');
});