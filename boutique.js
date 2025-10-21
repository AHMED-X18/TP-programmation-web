// Script pour gestion du panier (localStorage), ajout de produits et mise à jour du badge

(() => {
    const CART_KEY = 'allSports_cart_v1';
    const BADGE_SELECTOR = '.cart-badge';

    // Charge le panier depuis localStorage
    function loadCart() {
        try {
            return JSON.parse(localStorage.getItem(CART_KEY) || '[]');
        } catch (e) {
            console.warn('Erreur lecture panier:', e);
            return [];
        }
    }

    // Sauvegarde le panier et met à jour le badge
    function saveCart(cart) {
        try {
            localStorage.setItem(CART_KEY, JSON.stringify(cart));
        } catch (e) {
            console.warn('Erreur sauvegarde panier:', e);
        }
        updateBadge(cart);
    }

    // Calcule la quantité totale et met à jour l'affichage du badge
    function updateBadge(cart = null) {
        cart = cart || loadCart();
        const totalQty = cart.reduce((sum, item) => sum + (Number(item.quantity) || 0), 0);
        const badge = document.querySelector(BADGE_SELECTOR);
        if (!badge) return;
        badge.textContent = totalQty;
        badge.classList.remove('as-bump');
        // force reflow pour relancer l'animation si présente
        void badge.offsetWidth;
        badge.classList.add('as-bump');
        // retire la classe après animation (sécurité)
        clearTimeout(badge._t);
        badge._t = setTimeout(() => badge.classList.remove('as-bump'), 350);
    }

    // Ajoute un produit au panier (objet attendu: {id, name, price, image, quantity})
    function addToCart(product) {
        if (!product || !product.id) {
            console.warn('Produit invalide pour ajout au panier', product);
            return;
        }
        const cart = loadCart();
        const idx = cart.findIndex(p => String(p.id) === String(product.id));
        const qty = Math.max(1, Number(product.quantity) || 1);
        if (idx >= 0) {
            cart[idx].quantity = (Number(cart[idx].quantity) || 0) + qty;
        } else {
            cart.push({
                id: String(product.id),
                name: product.name || 'Produit',
                price: Number(product.price) || 0,
                image: product.image || '',
                quantity: qty
            });
        }
        saveCart(cart);
        showToast(`"${product.name || 'Produit'}" ajouté au panier (${qty})`);
        return cart;
    }

    // Message visuel temporaire (toast)
    function showToast(message) {
        let t = document.getElementById('as-toast');
        if (!t) {
            t = document.createElement('div');
            t.id = 'as-toast';
            t.style.cssText = [
                'position: fixed',
                'right: 1rem',
                'bottom: 1rem',
                'background: rgba(17,24,39,0.95)',
                'color: #fff',
                'padding: 0.6rem 1rem',
                'border-radius: 8px',
                'box-shadow: 0 6px 18px rgba(0,0,0,0.2)',
                'font-size: 0.95rem',
                'z-index: 9999',
                'transform: translateY(8px)',
                'opacity: 0',
                'transition: transform .18s ease, opacity .18s ease'
            ].join(';');
            document.body.appendChild(t);
        }
        t.textContent = message;
        requestAnimationFrame(() => {
            t.style.opacity = '1';
            t.style.transform = 'translateY(0)';
        });
        clearTimeout(t._t);
        t._t = setTimeout(() => {
            t.style.opacity = '0';
            t.style.transform = 'translateY(8px)';
        }, 1600);
    }

    // Bind des boutons standards <button class="add-to-cart" data-...>
    function bindAddButtons(root = document) {
        root.querySelectorAll('button.add-to-cart, a.add-to-cart').forEach(btn => {
            if (btn._as_bound) return;
            btn._as_bound = true;
            btn.addEventListener('click', (e) => {
                e.preventDefault();
                const el = e.currentTarget;
                const product = {
                    id: el.dataset.id || el.getAttribute('data-id'),
                    name: el.dataset.name || el.getAttribute('data-name'),
                    price: el.dataset.price || el.getAttribute('data-price'),
                    image: el.dataset.image || el.getAttribute('data-image'),
                    quantity: el.dataset.quantity || el.getAttribute('data-quantity') || 1
                };
                addToCart(product);
            });
        });
    }

    // Support pour formulaires product-add <form class="add-to-cart-form"> avec inputs name="id","name","price","image","quantity"
    function bindAddForms(root = document) {
        root.querySelectorAll('form.add-to-cart-form').forEach(form => {
            if (form._as_bound) return;
            form._as_bound = true;
            form.addEventListener('submit', (e) => {
                e.preventDefault();
                const formData = new FormData(form);
                const product = {
                    id: formData.get('id') || form.dataset.id,
                    name: formData.get('name') || form.dataset.name,
                    price: formData.get('price') || form.dataset.price,
                    image: formData.get('image') || form.dataset.image,
                    quantity: formData.get('quantity') || form.dataset.quantity || 1
                };
                addToCart(product);
            });
        });
    }

    // Expose une méthode pour ré-attacher (utile si le contenu est injecté dynamiquement)
    function bindAll(root = document) {
        bindAddButtons(root);
        bindAddForms(root);
    }

    // Initialisation au chargement
    document.addEventListener('DOMContentLoaded', () => {
        updateBadge();
        bindAll(document);

        // API publique pour debug / usage depuis la console
        window.AllSportsCart = {
            add: addToCart,
            get: loadCart,
            clear: () => {
                localStorage.removeItem(CART_KEY);
                updateBadge([]);
            },
            bind: bindAll
        };
    });

    // Si des éléments sont ajoutés dynamiquement via AJAX, on peut écouter des mutations (optionnel, léger)
    const observer = new MutationObserver(mutations => {
        for (const m of mutations) {
            if (m.addedNodes && m.addedNodes.length) {
                m.addedNodes.forEach(node => {
                    if (node.nodeType === 1) bindAll(node);
                });
            }
        }
    });
    observer.observe(document.documentElement || document.body, { childList: true, subtree: true });

})();
