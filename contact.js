/**
 * Fichier: contact.js
 * Description: Simule l'envoi du message du formulaire de contact et affiche une confirmation.
 */

document.addEventListener('DOMContentLoaded', () => {
    const contactForm = document.getElementById('contactForm');
    const confirmationMessage = document.getElementById('confirmationMessage');
    
    const formCard = contactForm ? contactForm.closest('.form-card') : null;

    if (contactForm && confirmationMessage && formCard) {
        contactForm.addEventListener('submit', function (event) {
            
            event.preventDefault(); 

            const formData = {
                name: document.getElementById('name').value,
                email: document.getElementById('email').value,
                topic: document.getElementById('topic').value,
                orderNumber: document.getElementById('order-number').value,
                message: document.getElementById('message').value
            };

            if (!formData.topic) {

                alert("Veuillez sélectionner un sujet pour votre demande.");
                return;
            }

            console.log('Tentative d\'envoi de message...');
            
            const submitButton = contactForm.querySelector('button[type="submit"]');
            const originalButtonText = submitButton.textContent;
            submitButton.textContent = 'Envoi en cours...';
            submitButton.disabled = true;
            submitButton.style.backgroundColor = '#6b7280';

            setTimeout(() => {

                let messageText = `Votre message concernant " ${formData.topic.toUpperCase().replace('_', ' ')} " a été envoyé avec succès !`;
                if (formData.orderNumber) {
                     messageText += ` (N° Commande: ${formData.orderNumber})`;
                }
                messageText += ` Notre équipe vous répondra par email (${formData.email}) sous 24-48h.`;

                confirmationMessage.querySelector('p').textContent = messageText;
                
                contactForm.style.display = 'none';
                confirmationMessage.style.display = 'flex';
                
                submitButton.textContent = originalButtonText;
                submitButton.disabled = false;
                submitButton.style.backgroundColor = '';

                contactForm.reset();

            }, 2000); 
        });
    } else {
        console.error("Erreur: Le formulaire (contactForm) ou le message de confirmation (confirmationMessage) n'a pas été trouvé dans le DOM.");
    }
});