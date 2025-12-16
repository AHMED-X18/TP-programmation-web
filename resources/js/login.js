document.addEventListener('DOMContentLoaded', () => {
    const container = document.querySelector('.conteneur');
    const registerLink = document.querySelector('.register-link');
    const loginLink = document.querySelector('.login-link');

    if (registerLink) {
        registerLink.addEventListener('click', (e) => {
            e.preventDefault(); 
            container.classList.add('actif'); 
        });
    }

    if (loginLink) {
        loginLink.addEventListener('click', (e) => {
            e.preventDefault(); 
            container.classList.remove('actif'); 
        });
    }
});