<!DOCTYPE html>
<html lang="fr" class="h-full">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AllSport - @yield('title', 'Boutique')</title>
    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    @vite(['resources/css/app.css', 'resources/css/accueil.css', 'resources/js/app.js'])
    @stack('styles')
</head>

<body>
    <header class="header">
        <div class="header-container">
            <a href="{{ route('home') }}" class="logo">AllSport</a>

            <nav class="desktop-nav">
                <ul class="nav-menu">
                    <li class="nav-item"><a href="{{ route('products.index') }}" class="nav-link">Boutique</a></li>
                    <li class="nav-item"><a href="{{ route('contact') }}" class="nav-link">Contact</a></li>
                    @auth
                        <li class="nav-item"><a href="{{ route('profile.index') }}" class="nav-link">Mon Profil</a></li>
                    @endauth
                </ul>
            </nav>
@if(session('success'))
    <div id="alert-message" style="
        position: fixed;
        top: 20px;
        right: 20px;
        background-color: #10b981; /* Vert joli */
        color: white;
        padding: 15px 25px;
        border-radius: 8px;
        box-shadow: 0 4px 6px rgba(0,0,0,0.1);
        z-index: 9999;
        display: flex;
        align-items: center;
        gap: 10px;
        font-weight: bold;
        animation: slideIn 0.5s ease-out;
    ">
        <i class='bx bx-check-circle' style="font-size: 1.5rem;"></i>
        <span>{{ session('success') }}</span>
    </div>

    <script>
        setTimeout(function() {
            var alert = document.getElementById('alert-message');
            if (alert) {
                alert.style.transition = "opacity 0.5s ease";
                alert.style.opacity = "0";
                setTimeout(function() { alert.remove(); }, 500);
            }
        }, 3000); 
    </script>
@endif

<style>
    @keyframes slideIn {
        from { transform: translateX(100%); opacity: 0; }
        to { transform: translateX(0); opacity: 1; }
    }
</style>
            <div class="header-actions">
                <form action="{{ route('products.index') }}" method="GET" class="search-form">
                    <input type="text" name="search" placeholder="Rechercher un article..." value="{{ request('search') }}">
                    <button type="submit">
                        <i class="fas fa-search"></i>
                    </button>
                </form>

                @guest
                    <a href="{{ route('login') }}" class="header-btn" title="Se connecter">
                        <i class="fas fa-user"></i>
                    </a>
                @else
                    <a href="{{ route('cart.index') }}" class="header-btn" title="Mon Panier">
                         <i class="fas fa-shopping-cart"></i>
                         </a>

                    <form action="{{ route('logout') }}" method="POST" style="display:inline;">
                        @csrf
                        <button type="submit" class="header-btn logout-btn" title="Déconnexion">
                            <i class="fas fa-sign-out-alt"></i>
                        </button>
                    </form>
                @endguest

                <button id="mobile-menu-btn" class="mobile-menu-btn">
                    <span class="hamburger-line"></span>
                    <span class="hamburger-line"></span>
                    <span class="hamburger-line"></span>
                </button>
            </div>
        </div>
        
        <nav id="mobile-nav" class="mobile-nav" style="display:none;">
            <ul class="mobile-nav-menu">
                <li><a href="{{ route('products.index') }}" class="mobile-nav-link">Boutique</a></li>
                <li><a href="{{ route('contact') }}" class="mobile-nav-link">Contact</a></li>
                @auth
                    <li><a href="{{ route('profile.index') }}" class="mobile-nav-link">Mon Profil</a></li>
                @else
                    <li><a href="{{ route('login') }}" class="mobile-nav-link">Connexion</a></li>
                @endauth
            </ul>
        </nav>
    </header>

    <main>
        @yield('content')
    </main>

    <footer class="footer">
        <div class="footer-container">
            <div class="footer-col">
                <h3>AllSport</h3>
                <p>Votre partenaire de confiance pour une vie active et sportive. Nous vous proposons les meilleurs équipements pour repousser vos limites.</p>
            </div>

            <div class="footer-col">
                <h3>Liens Rapides</h3>
                <ul class="footer-links">
                    <li><a href="{{ route('home') }}">Accueil</a></li>
                    <li><a href="{{ route('products.index') }}">Boutique</a></li>
                    <li><a href="{{ route('contact') }}">Contact</a></li>
                    @auth
                        <li><a href="{{ route('profile.index') }}">Mon Compte</a></li>
                    @else
                        <li><a href="{{ route('login') }}">Connexion</a></li>
                    @endauth
                </ul>
            </div>

            <div class="footer-col">
                <h3>Suivez-nous</h3>
                <div class="social-links">
                    <a href="#" class="social-icon"><i class="fab fa-facebook-f"></i></a>
                    <a href="#" class="social-icon"><i class="fab fa-twitter"></i></a>
                    <a href="#" class="social-icon"><i class="fab fa-instagram"></i></a>
                    <a href="#" class="social-icon"><i class="fab fa-linkedin-in"></i></a>
                </div>
            </div>
        </div>

        <div class="footer-bottom">
            <p>&copy; 2025 AllSport. Tous droits réservés.</p>
        </div>
    </footer>

    </body>
</html>

    <script>
        document.getElementById('mobile-menu-btn').addEventListener('click', function() {
            var nav = document.getElementById('mobile-nav');
            if (nav.style.display === 'block') {
                nav.style.display = 'none';
            } else {
                nav.style.display = 'block';
            }
        });
    </script>
</body>
</html>