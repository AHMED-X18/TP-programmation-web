
let cart = [];

// Mobile menu toggle
function toggleMobileMenu() {
    const mobileMenuBtn = document.getElementById('mobile-menu-btn');
    const mobileNav = document.getElementById('mobile-nav');
    
    mobileMenuBtn.classList.toggle('active');
    mobileNav.classList.toggle('active');
}

// Add to cart functionality
function addToCart(productName, price) {
    const existingItem = cart.find(item => item.name === productName);
    
    if (existingItem) {
        existingItem.quantity += 1;
    } else {
        cart.push({ 
            name: productName, 
            price: price, 
            quantity: 1 
        });
    }
    
    updateCartUI();
}

// Remove from cart
function removeFromCart(productName) {
    cart = cart.filter(item => item.name !== productName);
    updateCartUI();
}

// Update cart UI
function updateCartUI() {
    const cartCount = document.getElementById('cart-count');
    const cartItems = document.getElementById('cart-items');
    const cartTotal = document.getElementById('cart-total');
    const totalAmount = document.getElementById('total-amount');
    
    const totalItems = cart.reduce((sum, item) => sum + item.quantity, 0);
    const totalPrice = cart.reduce((sum, item) => sum + (item.price * item.quantity), 0);
    
    cartCount.textContent = totalItems;
    
    if (cart.length === 0) {
        cartItems.innerHTML = '<p style="text-align: center; color: #6b7280; padding: 48px 0; font-size: 16px;">Votre panier est vide</p>';
        cartTotal.classList.add('hidden');
    } else {
        cartItems.innerHTML = cart.map(item => `
            <div style="display: flex; justify-content: space-between; align-items: center; padding: 16px; background: #f8fafc; border-radius: 12px; margin-bottom: 12px; border: 1px solid #e2e8f0;">
                <div style="display: flex; align-items: center; gap: 16px;">
                    <div style="width: 60px; height: 60px; background: linear-gradient(135deg, #f1f5f9, #e2e8f0); border-radius: 8px; display: flex; align-items: center; justify-content: center;">
                        <svg width="24" height="24" fill="none" stroke="currentColor" viewBox="0 0 24 24" style="color: #6b7280;">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                        </svg>
                    </div>
                    <div>
                        <div style="font-weight: 600; color: #111827; margin-bottom: 4px;">${item.name}</div>
                        <div style="font-size: 14px; color: #6b7280;">${item.price.toLocaleString()} FCFA × ${item.quantity}</div>
                    </div>
                </div>
                <button onclick="removeFromCart('${item.name}')" style="background: #fee2e2; border: none; color: #dc2626; cursor: pointer; padding: 8px; border-radius: 8px; transition: all 0.3s ease;">
                    <svg width="20" height="20" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                    </svg>
                </button>
            </div>
        `).join('');
        cartTotal.classList.remove('hidden');
        totalAmount.textContent = `${totalPrice.toLocaleString()} FCFA`;
    }
}

// Event listeners
document.addEventListener('DOMContentLoaded', function() {
    // Mobile menu button
    document.getElementById('mobile-menu-btn').addEventListener('click', toggleMobileMenu);

    // Cart modal
    document.getElementById('cart-btn').addEventListener('click', () => {
        document.getElementById('cart-modal').classList.remove('hidden');
    });

    document.getElementById('close-cart').addEventListener('click', () => {
        document.getElementById('cart-modal').classList.add('hidden');
    });

    // Auth modal
    document.getElementById('account-btn').addEventListener('click', () => {
        document.getElementById('auth-modal').classList.remove('hidden');
    });

    document.getElementById('close-auth').addEventListener('click', () => {
        document.getElementById('auth-modal').classList.add('hidden');
    });

    // Auth form switching
    document.getElementById('show-register').addEventListener('click', () => {
        document.getElementById('login-form').classList.add('hidden');
        document.getElementById('register-form').classList.remove('hidden');
        document.getElementById('auth-title').textContent = 'Créer un compte';
    });

    document.getElementById('show-login').addEventListener('click', () => {
        document.getElementById('register-form').classList.add('hidden');
        document.getElementById('login-form').classList.remove('hidden');
        document.getElementById('auth-title').textContent = 'Connexion';
    });

    // Form submissions
    document.getElementById('login-form-element').addEventListener('submit', (e) => {
        e.preventDefault();
        document.getElementById('auth-modal').classList.add('hidden');
    });

    document.getElementById('register-form-element').addEventListener('submit', (e) => {
        e.preventDefault();
        document.getElementById('auth-modal').classList.add('hidden');
    });

    // Newsletter form
    document.querySelector('.newsletter-form').addEventListener('submit', (e) => {
        e.preventDefault();
        const email = document.getElementById('newsletter-email').value;
        if (email) {
            alert('Merci pour votre inscription !');
            document.getElementById('newsletter-email').value = '';
        }
    });

    // Add to cart buttons
    document.querySelectorAll('.add-to-cart-btn').forEach((btn, index) => {
        const products = [
            { name: 'T-shirt Performance Pro', price: 19650 },
            { name: 'Chaussures Running Elite', price: 85250 },
            { name: 'Legging Compression Pro', price: 32800 },
            { name: 'Sac de Sport Premium', price: 26250 },
            { name: 'Short Training Flex', price: 16400 },
            { name: 'Gourde Isotherme 750ml', price: 13100 }
        ];
        
        btn.addEventListener('click', (e) => {
            e.stopPropagation();
            const product = products[index];
            if (product) {
                addToCart(product.name, product.price);
            }
        });
    });

    // Close modals when clicking outside
    [document.getElementById('cart-modal'), document.getElementById('auth-modal')].forEach(modal => {
        modal.addEventListener('click', (e) => {
            if (e.target === modal) {
                modal.classList.add('hidden');
            }
        });
    });

    // Close mobile menu when clicking on links
    document.querySelectorAll('.mobile-nav-link').forEach(link => {
        link.addEventListener('click', () => {
            document.getElementById('mobile-menu-btn').classList.remove('active');
            document.getElementById('mobile-nav').classList.remove('active');
        });
    });
});
(function(){function c(){var b=a.contentDocument||a.contentWindow.document;if(b){var d=b.createElement('script');d.innerHTML="window.__CF$cv$params={r:'98f42be311b2af4f',t:'MTc2MDU4MjIxNi4wMDAwMDA='};var a=document.createElement('script');a.nonce='';a.src='/cdn-cgi/challenge-platform/scripts/jsd/main.js';document.getElementsByTagName('head')[0].appendChild(a);";b.getElementsByTagName('head')[0].appendChild(d)}}if(document.body){var a=document.createElement('iframe');a.height=1;a.width=1;a.style.position='absolute';a.style.top=0;a.style.left=0;a.style.border='none';a.style.visibility='hidden';document.body.appendChild(a);if('loading'!==document.readyState)c();else if(window.addEventListener)document.addEventListener('DOMContentLoaded',c);else{var e=document.onreadystatechange||function(){};document.onreadystatechange=function(b){e(b);'loading'!==document.readyState&&(document.onreadystatechange=e,c())}}}})();