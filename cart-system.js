// ==========================================
// GESTIONNAIRE DE PANIER AVEC COOKIES
// ==========================================

class CartManager {
    constructor() {
        this.cookieName = 'allsports_cart';
        this.loadCart();
    }

    loadCart() {
        try {
            const cookies = document.cookie.split(';');
            for (let cookie of cookies) {
                const [name, value] = cookie.trim().split('=');
                if (name === this.cookieName) {
                    this.cart = JSON.parse(decodeURIComponent(value));
                    console.log('Panier chargé depuis cookie:', this.cart);
                    return;
                }
            }
            this.cart = { items: [] };
            console.log('Nouveau panier créé');
        } catch (e) {
            console.error('Erreur chargement cookie:', e);
            this.cart = { items: [] };
        }
    }

    saveCart() {
        try {
            const cartString = encodeURIComponent(JSON.stringify(this.cart));
            const expirationDate = new Date();
            expirationDate.setDate(expirationDate.getDate() + 7);
            document.cookie = `${this.cookieName}=${cartString}; expires=${expirationDate.toUTCString()}; path=/`;
            console.log('Panier sauvegardé dans cookie:', this.cart);
            this.updateCartBadge();
        } catch (e) {
            console.error('Erreur sauvegarde cookie:', e);
        }
    }

    addItem(product) {
        console.log('Ajout produit:', product);
        
        const existingItem = this.cart.items.find(item => 
            item.name === product.name && 
            item.size === product.size && 
            item.color === product.color
        );

        if (existingItem) {
            existingItem.quantity += 1;
            console.log('Quantité augmentée:', existingItem);
        } else {
            this.cart.items.push({
                ...product,
                quantity: 1,
                id: Date.now().toString()
            });
            console.log('Nouveau produit ajouté');
        }

        this.saveCart();
        return true;
    }

    removeItem(index) {
        this.cart.items.splice(index, 1);
        this.saveCart();
    }

    updateQuantity(index, quantity) {
        if (quantity <= 0) {
            this.removeItem(index);
        } else {
            this.cart.items[index].quantity = quantity;
            this.saveCart();
        }
    }

    getItems() {
        return this.cart.items;
    }

    getTotal() {
        return this.cart.items.reduce((total, item) => {
            return total + (item.price * item.quantity);
        }, 0);
    }

    getTotalItems() {
        return this.cart.items.reduce((total, item) => total + item.quantity, 0);
    }

    updateCartBadge() {
        const badges = document.querySelectorAll('.cart-badge');
        const totalItems = this.getTotalItems();
        badges.forEach(badge => {
            badge.textContent = totalItems;
        });
    }

    clearCart() {
        this.cart.items = [];
        this.saveCart();
    }
}

// Initialiser le gestionnaire
const cartManager = new CartManager();
console.log('CartManager initialisé');

// ==========================================
// PAGE PRODUIT (product-detail-exemple.html)
// ==========================================
if (document.querySelector('.product-detail-image')) {
    console.log('=== PAGE PRODUIT DÉTECTÉE ===');
    
    let selectedSize = null;
    let selectedColor = null;

    // Gestion des badges de taille et couleur
    const badges = document.querySelectorAll('.badge');
    badges.forEach(badge => {
        const text = badge.textContent.trim();
        
        // Badge de taille (uniquement des chiffres)
        if (/^\d+$/.test(text)) {
            badge.style.cursor = 'pointer';
            badge.addEventListener('click', () => {
                badges.forEach(b => {
                    if (/^\d+$/.test(b.textContent.trim())) {
                        b.style.backgroundColor = 'rgba(59, 130, 246, 0.1)';
                        b.style.color = '#3b82f6';
                        b.style.fontWeight = 'normal';
                    }
                });
                badge.style.backgroundColor = '#3b82f6';
                badge.style.color = 'white';
                badge.style.fontWeight = 'bold';
                selectedSize = text;
                console.log('Taille sélectionnée:', selectedSize);
            });
        }
        // Badge de couleur (contient un slash /)
        else if (text.includes('/')) {
            badge.style.cursor = 'pointer';
            badge.addEventListener('click', () => {
                badges.forEach(b => {
                    if (b.textContent.trim().includes('/')) {
                        b.style.backgroundColor = 'rgba(59, 130, 246, 0.1)';
                        b.style.color = '#3b82f6';
                        b.style.fontWeight = 'normal';
                    }
                });
                badge.style.backgroundColor = '#3b82f6';
                badge.style.color = 'white';
                badge.style.fontWeight = 'bold';
                selectedColor = text;
                console.log('Couleur sélectionnée:', selectedColor);
            });
        }
    });

    // Bouton "Ajouter au panier"
    const addBtn = document.querySelector('.btn[onclick]');
    if (addBtn) {
        addBtn.removeAttribute('onclick');
        addBtn.addEventListener('click', (e) => {
            e.preventDefault();
            console.log('Clic sur Ajouter au panier');

            if (!selectedSize) {
                alert('Veuillez sélectionner une taille');
                return;
            }
            if (!selectedColor) {
                alert('Veuillez sélectionner une couleur');
                return;
            }

            const name = document.querySelector('.product-info h1').textContent.trim();
            const priceText = document.querySelector('.card-price').textContent;
            const price = parseFloat(priceText.replace(/[^\d]/g, ''));
            const image = document.querySelector('.product-detail-image').src;

            const product = {
                name: name,
                price: price,
                image: image,
                size: selectedSize,
                color: selectedColor
            };

            console.log('Produit à ajouter:', product);
            cartManager.addItem(product);

            const originalHTML = addBtn.innerHTML;
            addBtn.textContent = '✓ Ajouté au panier !';
            addBtn.style.backgroundColor = '#10b981';
            
            setTimeout(() => {
                addBtn.innerHTML = originalHTML;
                addBtn.style.backgroundColor = '#3b82f6';
            }, 1500);
        });
    }
}

// ==========================================
// PAGE PANIER (panier.html)
// ==========================================
if (document.querySelector('.empty-cart') && document.querySelector('.cart-content')) {
    console.log('=== PAGE PANIER DÉTECTÉE ===');
    
    function renderCart() {
        const items = cartManager.getItems();
        console.log('Rendu du panier avec', items.length, 'articles');
        
        const emptyCart = document.querySelector('.empty-cart');
        const cartContent = document.querySelector('.cart-content');
        const cartItemsContainer = document.querySelector('.cart-items');

        if (items.length === 0) {
            console.log('Affichage panier vide');
            emptyCart.style.display = 'block';
            cartContent.style.display = 'none';
        } else {
            console.log('Affichage des articles:', items);
            emptyCart.style.display = 'none';
            cartContent.style.display = 'flex';

            cartItemsContainer.innerHTML = items.map((item, index) => `
                <div class="cart-item" style="background: white; border-radius: 8px; padding: 1.5rem; margin-bottom: 1rem; display: flex; gap: 1.5rem; box-shadow: 0 1px 3px rgba(0,0,0,0.1);">
                    <img src="${item.image}" alt="${item.name}" class="item-image" style="width: 100px; height: 100px; object-fit: cover; border-radius: 8px; background: #e5e7eb;">
                    <div class="item-details" style="flex: 1;">
                        <h3 class="item-name" style="font-size: 1.1rem; font-weight: 600; margin-bottom: 0.5rem;">${item.name}</h3>
                        <p style="color: #6b7280; font-size: 0.875rem; margin-bottom: 0.5rem;">
                            Taille: ${item.size} | Couleur: ${item.color}
                        </p>
                        <p class="item-price" style="color: #3b82f6; font-weight: 600; font-size: 1.1rem; margin-bottom: 1rem;">
                            ${(item.price * item.quantity).toLocaleString('fr-FR')} CFA
                        </p>
                        <div style="display: flex; align-items: center; gap: 1rem;">
                            <div style="display: flex; align-items: center; gap: 0.5rem; border: 1px solid #e5e7eb; border-radius: 8px; padding: 0.25rem;">
                                <button class="qty-decrease" data-index="${index}" style="background: none; border: none; padding: 0.5rem; cursor: pointer; font-size: 1.2rem; color: #3b82f6; font-weight: bold;">−</button>
                                <span style="padding: 0 1rem; font-weight: 600; min-width: 30px; text-align: center;">${item.quantity}</span>
                                <button class="qty-increase" data-index="${index}" style="background: none; border: none; padding: 0.5rem; cursor: pointer; font-size: 1.2rem; color: #3b82f6; font-weight: bold;">+</button>
                            </div>
                            <button class="remove-item" data-index="${index}" style="background: none; border: none; color: #ef4444; cursor: pointer; font-size: 1.2rem; padding: 0.5rem;" title="Supprimer cet article">
                                <i class="fas fa-trash"></i>
                            </button>
                        </div>
                    </div>
                </div>
            `).join('');

            attachCartEvents();
            updateSummary();
        }
    }

    function attachCartEvents() {
        const items = cartManager.getItems();

        document.querySelectorAll('.qty-decrease').forEach(btn => {
            btn.addEventListener('click', () => {
                const index = parseInt(btn.dataset.index);
                const item = items[index];
                cartManager.updateQuantity(index, item.quantity - 1);
                renderCart();
            });
        });

        document.querySelectorAll('.qty-increase').forEach(btn => {
            btn.addEventListener('click', () => {
                const index = parseInt(btn.dataset.index);
                const item = items[index];
                cartManager.updateQuantity(index, item.quantity + 1);
                renderCart();
            });
        });

        document.querySelectorAll('.remove-item').forEach(btn => {
            btn.addEventListener('click', () => {
                const index = parseInt(btn.dataset.index);
                if (confirm('Voulez-vous vraiment retirer cet article ?')) {
                    cartManager.removeItem(index);
                    renderCart();
                }
            });
        });
    }

    function updateSummary() {
        const total = cartManager.getTotal();
        const subtotalEl = document.getElementById('subtotal');
        const totalEl = document.getElementById('total');
        
        if (subtotalEl) subtotalEl.textContent = `${total.toLocaleString('fr-FR')} CFA`;
        if (totalEl) totalEl.textContent = `${total.toLocaleString('fr-FR')} CFA`;
    }

    renderCart();

    const continueBtn = document.querySelector('.empty-cart .btn-primary');
    if (continueBtn) {
        continueBtn.addEventListener('click', (e) => {
            e.preventDefault();
            if (document.referrer && !document.referrer.includes('panier')) {
                window.history.back();
            } else {
                window.location.href = 'shop.html';
            }
        });
    }
}

// ==========================================
// NAVIGATION GLOBALE (toutes les pages)
// ==========================================
document.addEventListener('DOMContentLoaded', () => {
    console.log('=== INITIALISATION GLOBALE ===');
    cartManager.updateCartBadge();
    
    // Clic sur l'icône du panier
    document.querySelectorAll('.icon-btn, .icon-button').forEach(btn => {
        const hasCartIcon = btn.querySelector('svg circle[cx="9"]') || 
                           btn.querySelector('.fa-shopping-cart');
        if (hasCartIcon) {
            btn.style.cursor = 'pointer';
            btn.addEventListener('click', (e) => {
                e.preventDefault();
                console.log('Redirection vers panier.html');
                window.location.href = 'panier.html';
            });
        }
    });

    // Lien "Accueil" redirige vers shop.html depuis la page panier
    if (window.location.pathname.includes('panier')) {
        document.querySelectorAll('nav a, nav ul li a').forEach(link => {
            if (link.textContent.trim() === 'Accueil') {
                link.addEventListener('click', (e) => {
                    e.preventDefault();
                    window.location.href = 'shop.html';
                });
            }
        });
    }
});
