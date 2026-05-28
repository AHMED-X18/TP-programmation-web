
        const clientsKey = 'allsports_clients';

        function getClients() {
            const data = localStorage.getItem(clientsKey);
            return data ? JSON.parse(data) : [
                { id: '1', name: 'Jean Dupont', email: 'jean@gmail.com', phone: '77 123 4567', orders: 8, date: '15/10/2025' },
                { id: '2', name: 'Marie Sarr', email: 'marie@hotmail.com', phone: '78 987 6543', orders: 12, date: '20/10/2025' },
                { id: '3', name: 'Paul Diagne', email: 'paul.diagne@yahoo.com', phone: '76 456 7890', orders: 3, date: '12/09/2025' },
                { id: '4', name: 'Sophie Ndiaye', email: 'sophie.ndiaye@gmail.com', phone: '77 234 5678', orders: 7, date: '05/11/2025' },
                { id: '5', name: 'Alioune Fall', email: 'alioune.fall@outlook.com', phone: '78 345 6789', orders: 15, date: '18/08/2025' },
                { id: '6', name: 'Fatou Ba', email: 'fatou.ba@gmail.com', phone: '76 567 8901', orders: 2, date: '22/11/2025' },
                { id: '7', name: 'Moussa Diallo', email: 'moussa.diallo@hotmail.com', phone: '77 678 9012', orders: 9, date: '30/07/2025' },
                { id: '8', name: 'Aminata Sow', email: 'aminata.sow@gmail.com', phone: '78 789 0123', orders: 6, date: '14/10/2025' },
                { id: '9', name: 'Ibrahim Kane', email: 'ibrahim.kane@yahoo.com', phone: '76 890 1234', orders: 4, date: '08/12/2025' },
                { id: '10', name: 'Adama Gueye', email: 'adama.gueye@gmail.com', phone: '77 901 2345', orders: 11, date: '25/09/2025' }
            ];
        }

        function saveClients(clients) {
            localStorage.setItem(clientsKey, JSON.stringify(clients));
        }

        function loadClients() {
            const clients = getClients();
            displayLoyalClients(clients);
            displayAllClients(clients);
            updateStats(clients);
        }

        function displayLoyalClients(clients) {
            const loyalClients = clients.filter(c => c.orders >= 5);
            const tbody = document.getElementById('loyalClientsTable');
            tbody.innerHTML = loyalClients.length === 0 ? 
                '<tr><td colspan="6" style="text-align:center; color:#6b7280;">Aucun client fidèle</td></tr>' :
                loyalClients.map(c => `
                    <tr class="loyal-client">
                        <td><strong>#${c.id}</strong></td>
                        <td>${c.name} <span class="loyal-badge">Fidèle</span></td>
                        <td>${c.email}</td>
                        <td>${c.phone || '-'}</td>
                        <td><strong>${c.orders}</strong></td>
                        <td>${c.date}</td>
                    </tr>
                `).join('');
        }

        function displayAllClients(clients) {
            const tbody = document.getElementById('clientsTableBody');
            tbody.innerHTML = clients.length === 0 ? 
                '<tr><td colspan="6" style="text-align:center; color:#6b7280;">Aucun client</td></tr>' :
                clients.map(c => `
                    <tr>
                        <td><strong>#${c.id}</strong></td>
                        <td>${c.name} ${c.orders >= 5 ? '<span class="loyal-badge">Fidèle</span>' : ''}</td>
                        <td>${c.email}</td>
                        <td>${c.phone || '-'}</td>
                        <td>${c.orders}</td>
                        <td>${c.date}</td>
                    </tr>
                `).join('');
            
            // Mettre à jour le compteur de clients
            document.getElementById('clientCount').textContent = `${clients.length} client(s) trouvé(s)`;
        }

        function updateStats(clients) {
            document.getElementById('totalClients').textContent = clients.length;
            const loyalClients = clients.filter(c => c.orders >= 5).length;
            document.getElementById('loyalClients').textContent = loyalClients;
        }

        function searchClients() {
            const query = document.getElementById('searchInput').value.toLowerCase();
            const clients = getClients();
            const filtered = clients.filter(c => 
                c.name.toLowerCase().includes(query) || 
                c.email.toLowerCase().includes(query)
            );
            displayAllClients(filtered);
        }

        function setViewMode(mode) {
            document.getElementById('listViewBtn').classList.toggle('active', mode === 'list');
            // Pourrait être étendu pour d'autres modes de vue (grille, etc.)
        }

        function showAlert(message, type) {
            const alert = document.getElementById('alert');
            alert.textContent = message;
            alert.className = `alert alert-${type} show`;
            setTimeout(() => alert.classList.remove('show'), 3000);
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
        displayLoyalClients(getClients());
        displayAllClients(getClients());
 