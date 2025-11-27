// Récupération des éléments DOM
const emptyCart = document.querySelector('.empty-cart');
const cartContent = document.querySelector('.cart-content');
const cartItemsContainer = document.querySelector('.cart-items');
const subtotalElement = document.getElementById('subtotal');
const totalElement = document.getElementById('total');
const cartBadge = document.querySelector('.cart-badge');

// Récupération du panier depuis localStorage
let cart = JSON.parse(localStorage.getItem('cart')) || [];

// Initialisation au chargement de la page
document.addEventListener('DOMContentLoaded', () => {
    displayCart();
    updateCartBadge();
});

// Afficher le panier
function displayCart() {
    if (cart.length === 0) {
        emptyCart.style.display = 'block';
        cartContent.style.display = 'none';
    } else {
        emptyCart.style.display = 'none';
        cartContent.style.display = 'flex';
        renderCartItems();
        updateCartSummary();
    }
}

// Rendre les articles du panier
function renderCartItems() {
    cartItemsContainer.innerHTML = '';
    
    cart.forEach((item, index) => {
        const cartItem = document.createElement('div');
        cartItem.className = 'cart-item';
        cartItem.innerHTML = `
            <div class="item-image" style="background-image: url('${item.image || '../../images/placeholder.jpg'}'); background-size: cover; background-position: center;"></div>
            
            <div class="item-details">
                <h3 class="item-name">${item.name}</h3>
                <p class="item-price">${formatPrice(item.price)}</p>
                
                <div style="display: flex; align-items: center; gap: 1rem; margin-top: 1rem;">
                    <div style="display: flex; align-items: center; gap: 0.5rem;">
                        <button class="quantity-btn" onclick="updateQuantity(${index}, -1)">
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <line x1="5" y1="12" x2="19" y2="12"></line>
                            </svg>
                        </button>
                        <span style="min-width: 30px; text-align: center; font-weight: 600;">${item.quantity}</span>
                        <button class="quantity-btn" onclick="updateQuantity(${index}, 1)">
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <line x1="12" y1="5" x2="12" y2="19"></line>
                                <line x1="5" y1="12" x2="19" y2="12"></line>
                            </svg>
                        </button>
                    </div>
                    
                    <button class="remove-btn" onclick="removeFromCart(${index})">
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <polyline points="3 6 5 6 21 6"></polyline>
                            <path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path>
                        </svg>
                        Supprimer
                    </button>
                </div>
            </div>
        `;
        
        cartItemsContainer.appendChild(cartItem);
    });
}

// Mettre à jour la quantité
function updateQuantity(index, change) {
    cart[index].quantity += change;
    
    if (cart[index].quantity <= 0) {
        removeFromCart(index);
    } else {
        saveCart();
        displayCart();
        updateCartBadge();
    }
}

// Supprimer un article du panier
function removeFromCart(index) {
    cart.splice(index, 1);
    saveCart();
    displayCart();
    updateCartBadge();
}

// Mettre à jour le récapitulatif
function updateCartSummary() {
    const subtotal = cart.reduce((sum, item) => sum + (item.price * item.quantity), 0);
    const shipping = subtotal > 50000 ? 0 : 2000; // Livraison gratuite au-dessus de 50 000 CFA
    const total = subtotal + shipping;
    
    subtotalElement.textContent = formatPrice(subtotal);
    totalElement.textContent = formatPrice(total);
    
    const shippingElement = document.getElementById('shipping');
    shippingElement.textContent = shipping === 0 ? 'Gratuite' : formatPrice(shipping);
}

// Mettre à jour le badge du panier
function updateCartBadge() {
    const totalItems = cart.reduce((sum, item) => sum + item.quantity, 0);
    if (cartBadge) {
        cartBadge.textContent = totalItems;
        cartBadge.style.display = totalItems > 0 ? 'flex' : 'none';
    }
}

// Sauvegarder le panier dans localStorage
function saveCart() {
    localStorage.setItem('cart', JSON.stringify(cart));
}

// Formater le prix
function formatPrice(price) {
    return new Intl.NumberFormat('fr-FR', {
        style: 'decimal',
        minimumFractionDigits: 0
    }).format(price) + ' CFA';
}

// Fonction pour ajouter un produit (à utiliser depuis les pages produits)
function addToCart(product) {
    const existingItem = cart.find(item => item.id === product.id);
    
    if (existingItem) {
        existingItem.quantity += 1;
    } else {
        cart.push({
            id: product.id,
            name: product.name,
            price: product.price,
            image: product.image,
            quantity: 1
        });
    }
    
    saveCart();
    updateCartBadge();
    
    // Notification visuelle
    alert('Produit ajouté au panier !');
}

// Vider le panier
function clearCart() {
    if (confirm('Êtes-vous sûr de vouloir vider le panier ?')) {
        cart = [];
        saveCart();
        displayCart();
        updateCartBadge();
    }
}

// Valider le panier
document.querySelector('.cart-summary .btn-primary')?.addEventListener('click', () => {
    if (cart.length === 0) {
        alert('Votre panier est vide !');
        return;
    }
    
    alert('Validation du panier en cours...\nTotal : ' + totalElement.textContent);
    // Ici, vous pouvez rediriger vers une page de paiement
    // window.location.href = '../checkout.html';
});

// Gestion du bouton "Continuer mes achats"
document.querySelector('.empty-cart .btn-primary')?.addEventListener('click', (e) => {
    e.preventDefault();
    window.location.href = '../boutique_html/shop.html';
});