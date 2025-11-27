// Fonction utilitaire pour créer et ajouter les badges
function renderBadges(containerId, itemsArray) {
    const container = document.getElementById(containerId);
    if (!container) return; // Sécurité

    container.innerHTML = ''; // Vider le contenu existant
    itemsArray.forEach(item => {
        const badge = document.createElement('span');
        badge.className = 'badge';
        badge.textContent = item;
        container.appendChild(badge);
    });
}

// Fonction principale pour charger et afficher les détails du produit
function loadProductDetails() {
    // 1. Récupérer l'ID du produit depuis l'URL (ex: ?id=H_TSHIRT_PERF)
    const urlParams = new URLSearchParams(window.location.search);
    const productId = urlParams.get('id');

    // 2. Vérifier si l'ID est présent et si le produit existe
    // On suppose que PRODUCTS_DATA est chargé (grâce à products-data.js)
    if (!productId || !PRODUCTS_DATA || !PRODUCTS_DATA[productId]) {
        console.error("ID du produit non trouvé ou produit inexistant :", productId);
        // Afficher un message d'erreur clair
        document.getElementById('product-name').textContent = "Produit Introuvable";
        document.getElementById('product-price').textContent = "";
        document.getElementById('product-description-short').textContent = "Nous n'avons pas pu charger les détails de ce produit. Veuillez retourner à la boutique.";
        document.getElementById('product-image').src = ""; // Effacer l'image
        document.getElementById('product-description-long').textContent = "";
        document.getElementById('detail-tailles').innerHTML = "";
        document.getElementById('detail-couleurs').innerHTML = "";
        document.getElementById('detail-materiel').textContent = "---";
        document.getElementById('detail-fabrication').textContent = "---";
        return;
    }

    // 3. Récupérer les données du produit
    const product = PRODUCTS_DATA[productId];

    // 4. Mettre à jour les éléments HTML avec les données

    // Mettre à jour les informations principales
    document.getElementById('product-name').textContent = product.name;
    document.getElementById('product-price').textContent = product.price;
    document.getElementById('product-description-short').textContent = product.description_short;
    document.getElementById('product-description-long').textContent = product.description_long;

    // Mettre à jour l'image
    const productImage = document.getElementById('product-image');
    productImage.src = product.image;
    productImage.alt = product.name;

    // Mettre à jour les badges (Tailles et Couleurs)
    renderBadges('detail-tailles', product.details.tailles);
    renderBadges('detail-couleurs', product.details.couleurs);

    // Mettre à jour les autres détails
    document.getElementById('detail-materiel').textContent = product.details.materiel;
    document.getElementById('detail-fabrication').textContent = product.details.fabrication;
}

// Exécuter la fonction une fois que le DOM est complètement chargé

document.addEventListener('DOMContentLoaded', loadProductDetails);
