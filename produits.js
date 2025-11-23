
        class ProductManager {
            constructor() {
                this.cookieName = 'allsports_products';
                this.bestSellersCookieName = 'allsports_best_sellers';
                this.loadProducts();
                this.loadBestSellers();
            }
            
            loadProducts() {
                try {
                    const cookies = document.cookie.split(';');
                    for (let cookie of cookies) {
                        const [name, value] = cookie.trim().split('=');
                        if (name === this.cookieName) {
                            this.products = JSON.parse(decodeURIComponent(value));
                            return;
                        }
                    }
                    this.products = this.getDefaultProducts();
                    this.saveProducts();
                } catch (e) {
                    this.products = this.getDefaultProducts();
                }
            }
            
            loadBestSellers() {
                try {
                    const cookies = document.cookie.split(';');
                    for (let cookie of cookies) {
                        const [name, value] = cookie.trim().split('=');
                        if (name === this.bestSellersCookieName) {
                            this.bestSellers = JSON.parse(decodeURIComponent(value));
                            return;
                        }
                    }
                    this.bestSellers = this.getDefaultBestSellers();
                    this.saveBestSellers();
                } catch (e) {
                    this.bestSellers = this.getDefaultBestSellers();
                }
            }
            
            getDefaultProducts() {
                return [
                    { id: '1', name: 'Chaussures de Running Pro', category: 'Femmes', price: 45000, description: 'Légères et performantes', stock: 24, sales: 120 },
                    { id: '2', name: 'Legging Sport Élégant', category: 'Femmes', price: 25000, description: 'Yoga & fitness', stock: 15, sales: 95 },
                    { id: '3', name: 'T-Shirt Performance', category: 'Hommes', price: 15000, description: 'Séchage rapide', stock: 20, sales: 80 },
                    { id: '4', name: 'Tapis de Yoga Premium', category: 'Matériel', price: 20000, description: 'Antidérapant', stock: 12, sales: 65 },
                    { id: '5', name: 'Veste Sport Imperméable', category: 'Hommes', price: 35000, description: 'Protection contre les intempéries', stock: 8, sales: 45 },
                    { id: '6', name: 'Sac de Sport Grande Capacité', category: 'Matériel', price: 18000, description: 'Idéal pour le sport', stock: 30, sales: 110 }
                ];
            }
            
            getDefaultBestSellers() {
                return ['1', '2', '6']; // IDs des produits les plus vendus
            }
            
            saveProducts() {
                const expirationDate = new Date();
                expirationDate.setDate(expirationDate.getDate() + 30);
                document.cookie = `${this.cookieName}=${encodeURIComponent(JSON.stringify(this.products))}; expires=${expirationDate.toUTCString()}; path=/`;
            }
            
            saveBestSellers() {
                const expirationDate = new Date();
                expirationDate.setDate(expirationDate.getDate() + 30);
                document.cookie = `${this.bestSellersCookieName}=${encodeURIComponent(JSON.stringify(this.bestSellers))}; expires=${expirationDate.toUTCString()}; path=/`;
            }
            
            addProduct(product) {
                product.id = Date.now().toString();
                product.sales = 0; // Nouveau produit, pas encore de ventes
                this.products.push(product);
                this.saveProducts();
                
                // Si le produit devient un best-seller, on l'ajoute à la liste
                this.updateBestSellers();
            }
            
            updateProduct(id, updatedProduct) {
                const index = this.products.findIndex(p => p.id === id);
                if (index !== -1) {
                    // Conserver les ventes existantes
                    updatedProduct.sales = this.products[index].sales;
                    this.products[index] = { ...this.products[index], ...updatedProduct };
                    this.saveProducts();
                    this.updateBestSellers();
                    return true;
                }
                return false;
            }
            
            deleteProduct(id) {
                const index = this.products.findIndex(p => p.id === id);
                if (index !== -1) {
                    this.products.splice(index, 1);
                    this.saveProducts();
                    this.updateBestSellers();
                    return true;
                }
                return false;
            }
            
            getProductById(id) {
                return this.products.find(p => p.id === id);
            }
            
            updateBestSellers() {
                // Trier les produits par ventes décroissantes
                const sortedProducts = [...this.products].sort((a, b) => b.sales - a.sales);
                
                // Prendre les 3 premiers (ou plus si égalité)
                this.bestSellers = sortedProducts.slice(0, 3).map(p => p.id);
                this.saveBestSellers();
            }
            
            getProducts() { 
                return this.products; 
            }
            
            getBestSellers() {
                return this.products.filter(p => this.bestSellers.includes(p.id));
            }
            
            searchProducts(query) {
                if (!query) return this.products;
                return this.products.filter(p => 
                    p.name.toLowerCase().includes(query.toLowerCase())
                );
            }
            
            filterByCategory(category) {
                if (category === 'all') return this.products;
                return this.products.filter(p => p.category === category);
            }
            
            filterByStock(stockType) {
                switch(stockType) {
                    case 'inStock':
                        return this.products.filter(p => p.stock > 15);
                    case 'lowStock':
                        return this.products.filter(p => p.stock > 0 && p.stock <= 15);
                    case 'outOfStock':
                        return this.products.filter(p => p.stock === 0);
                    default:
                        return this.products;
                }
            }
        }

        const productManager = new ProductManager();
        let currentFilter = 'all';
        let currentStockFilter = 'all';
        let currentSearchQuery = '';
        let productToDeleteId = null;

        function displayProducts() {
            let filteredProducts = productManager.getProducts();
            
            // Appliquer les filtres
            if (currentFilter !== 'all') {
                filteredProducts = productManager.filterByCategory(currentFilter);
            }
            
            if (currentStockFilter !== 'all') {
                filteredProducts = filteredProducts.filter(p => 
                    productManager.filterByStock(currentStockFilter).includes(p)
                );
            }
            
            if (currentSearchQuery) {
                filteredProducts = filteredProducts.filter(p => 
                    p.name.toLowerCase().includes(currentSearchQuery.toLowerCase())
                );
            }
            
            const tbody = document.getElementById('productsTableBody');
            tbody.innerHTML = filteredProducts.map(p => `
                <tr>
                    <td><strong>${p.name}</strong></td>
                    <td>${p.category}</td>
                    <td><strong>${p.price.toLocaleString('fr-FR')} FCFA</strong></td>
                    <td class="${p.stock <= 15 ? (p.stock === 0 ? 'stock-out' : 'stock-low') : ''}">
                        ${p.stock <= 15 ? (p.stock === 0 ? 'Rupture' : `${p.stock} (Faible)`) : p.stock}
                    </td>
                    <td>${p.sales}</td>
                    <td class="actions-cell">
                        <button class="btn btn-secondary btn-sm" onclick="editProduct('${p.id}')">
                            <i class="fas fa-edit"></i> Modifier
                        </button>
                        <button class="btn btn-danger btn-sm" onclick="deleteProduct('${p.id}', '${p.name}')">
                            <i class="fas fa-trash"></i> Supprimer
                        </button>
                    </td>
                </tr>
            `).join('');
            
            // Mettre à jour le compteur de produits
            document.getElementById('productCount').textContent = `${filteredProducts.length} produit(s) trouvé(s)`;
        }

        function displayBestSellers() {
            const bestSellers = productManager.getBestSellers();
            const tbody = document.getElementById('bestSellersTable');
            tbody.innerHTML = bestSellers.map(p => `
                <tr>
                    <td><strong>${p.name}</strong></td>
                    <td>${p.category}</td>
                    <td><strong>${p.price.toLocaleString('fr-FR')} FCFA</strong></td>
                    <td class="${p.stock <= 15 ? (p.stock === 0 ? 'stock-out' : 'stock-low') : ''}">
                        ${p.stock <= 15 ? (p.stock === 0 ? 'Rupture' : `${p.stock} (Faible)`) : p.stock}
                    </td>
                    <td><strong>${p.sales}</strong></td>
                </tr>
            `).join('');
        }

        function filterProducts() {
            currentSearchQuery = document.getElementById('searchInput').value;
            displayProducts();
        }

        function filterByCategory(category) {
            currentFilter = category;
            document.getElementById('categoryText').textContent = 
                category === 'all' ? 'Toute catégorie' : category;
            closeAllDropdowns();
            displayProducts();
        }

        function filterByStock(stockType) {
            currentStockFilter = stockType;
            const stockTexts = {
                'all': 'Tous les stocks',
                'inStock': 'En stock',
                'lowStock': 'Stock faible',
                'outOfStock': 'En rupture'
            };
            document.getElementById('stockText').textContent = stockTexts[stockType];
            closeAllDropdowns();
            displayProducts();
        }

        function setViewMode(mode) {
            document.getElementById('listViewBtn').classList.toggle('active', mode === 'list');
            // Pourrait être étendu pour d'autres modes de vue (grille, etc.)
        }

        function toggleDropdown(dropdownId) {
            const dropdown = document.getElementById(dropdownId);
            const isShowing = dropdown.classList.contains('show');
            
            // Fermer tous les dropdowns d'abord
            closeAllDropdowns();
            
            // Ouvrir celui-ci s'il n'était pas déjà ouvert
            if (!isShowing) {
                dropdown.classList.add('show');
            }
        }

        function closeAllDropdowns() {
            const dropdowns = document.querySelectorAll('.dropdown-content');
            dropdowns.forEach(dropdown => {
                dropdown.classList.remove('show');
            });
        }

        // Fermer les dropdowns en cliquant ailleurs
        document.addEventListener('click', function(event) {
            if (!event.target.matches('.dropdown-btn')) {
                closeAllDropdowns();
            }
        });

        function goToAddForm() {
            const form = document.getElementById('addForm');
            form.classList.add('active');
            form.scrollIntoView({ behavior: 'smooth', block: 'start' });
            document.getElementById('productForm').reset();
            document.getElementById('productId').value = '';
            document.getElementById('submitButton').textContent = 'Enregistrer';
            document.getElementById('productName').focus();
        }

        function toggleAddForm() {
            document.getElementById('addForm').classList.remove('active');
        }

        function editProduct(id) {
            const product = productManager.getProductById(id);
            if (product) {
                document.getElementById('productId').value = product.id;
                document.getElementById('productName').value = product.name;
                document.getElementById('productCategory').value = product.category;
                document.getElementById('productPrice').value = product.price;
                document.getElementById('productStock').value = product.stock;
                document.getElementById('productDescription').value = product.description;
                document.getElementById('submitButton').textContent = 'Mettre à jour';
                
                const form = document.getElementById('addForm');
                form.classList.add('active');
                form.scrollIntoView({ behavior: 'smooth', block: 'start' });
                document.getElementById('productName').focus();
            }
        }

        function deleteProduct(id, name) {
            productToDeleteId = id;
            document.getElementById('productToDeleteName').textContent = name;
            document.getElementById('deleteModal').classList.add('show');
        }

        function closeDeleteModal() {
            document.getElementById('deleteModal').classList.remove('show');
            productToDeleteId = null;
        }

        function confirmDelete() {
            if (productToDeleteId) {
                const success = productManager.deleteProduct(productToDeleteId);
                if (success) {
                    showAlert('Produit supprimé avec succès !', 'success');
                    displayProducts();
                    displayBestSellers();
                } else {
                    showAlert('Erreur lors de la suppression du produit', 'warning');
                }
                closeDeleteModal();
            }
        }

        document.getElementById('productForm').addEventListener('submit', function(e) {
            e.preventDefault();
            const productId = document.getElementById('productId').value;
            const product = {
                name: document.getElementById('productName').value,
                category: document.getElementById('productCategory').value,
                price: parseInt(document.getElementById('productPrice').value),
                description: document.getElementById('productDescription').value,
                stock: parseInt(document.getElementById('productStock').value) || 0
            };
            
            let message = '';
            if (productId) {
                // Mise à jour d'un produit existant
                const success = productManager.updateProduct(productId, product);
                message = success ? 'Produit mis à jour avec succès !' : 'Erreur lors de la mise à jour du produit';
            } else {
                // Ajout d'un nouveau produit
                productManager.addProduct(product);
                message = 'Produit ajouté avec succès !';
            }
            
            showAlert(message, 'success');
            displayProducts();
            displayBestSellers();
            toggleAddForm();
            window.scrollTo({ top: 0, behavior: 'smooth' }); // Retour en haut
        });

        function showAlert(message, type) {
            const alert = document.getElementById('alert');
            alert.textContent = message;
            alert.className = `alert alert-${type} show`;
            setTimeout(() => alert.classList.remove('show'), 4000);
        }

        function checkAuth() {
            if (!document.cookie.includes('admin_session')) {
                window.location.href = 'admin-login.html';
            }
        }

        function logout() {
            if (confirm('Déconnexion ?')) {
                document.cookie = 'admin_session=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/;';
                window.location.href = 'admin-login.html';
            }
        }

        // Initialiser l'affichage
        displayBestSellers();
        displayProducts();
