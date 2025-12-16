<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AllSport - Connexion / Inscription</title>
    <link rel="stylesheet" href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css">
    
    @vite(['resources/css/login.css', 'resources/js/login.js'])
</head>
<body>
    <a href="{{ route('products.index') }}" style="position: absolute; top: 20px; left: 20px; text-decoration: none; color: #fff; z-index: 1000; font-weight: bold;">
        <i class='bx bx-arrow-back'></i> Retour accueil
    </a>

    <div class="conteneur">
        <div class="forme-courbee"></div>
        <div class="forme-courbee2"></div>

        @if ($errors->any())
            <div style="position: absolute; top: 10px; left: 50%; transform: translateX(-50%); background: #ffdddd; color: #a00; padding: 10px 20px; border-radius: 5px; z-index: 2000; text-align:center; min-width: 300px;">
                <ul style="list-style: none; margin: 0; padding: 0;">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        
        <div class="boite-formulaire Connexion">
            <h2 class="animation" style="--D:0; --S:21">Connexion</h2>
            
            <form action="{{ route('login') }}" method="POST">
                @csrf
                <div class="boite-saisie animation" style="--D:1; --S:22">
                    <input type="email" name="email" required value="{{ old('email') }}">
                    <label>Email</label>
                    <box-icon name='envelope' type='solid'></box-icon>
                </div>
                
                <div class="boite-saisie animation" style="--D:2; --S:23">
                    <input type="password" name="password" required>
                    <label>Mot de passe</label>
                    <box-icon name='lock-alt' type='solid'></box-icon>
                </div>
                
                <div class="boite-saisie animation" style="--D:3; --S:24">
                    <button class="bouton" type="submit">Se connecter</button>
                </div>
                
                <div class="lien-inscription animation" style="--D:4; --S:25">
                     <p>Vous n'avez pas de compte ? <br> 
                         <a href="#" class="register-link">S'inscrire</a>
                     </p>
                </div>
            </form>
        </div>
        
        <div class="contenu-info Connexion">
            <div class="logo animation" style="--D:0; --S:19">ALLSPORT</div>
            <h2 class="animation" style="--D:0; --S:20">BON RETOUR !</h2>
            <p class="animation" style="--D:1; --S:21">Connectez-vous pour accéder à votre espace personnel.</p>
        </div>
        
        <div class="boite-formulaire Inscription">
            <h2 class="animation" style="--li:17; --S:0">Inscription</h2>
            
            <form action="{{ route('register') }}" method="POST">
                @csrf
                <div class="boite-saisie animation" style="--li:18; --S:1">
                    <input type="text" name="name" required value="{{ old('name') }}">
                    <label>Nom d'utilisateur</label>
                    <box-icon type='solid' name='user'></box-icon>
                </div>
                
                <div class="boite-saisie animation" style="--li:19; --S:2">
                    <input type="email" name="email" required value="{{ old('email') }}">
                    <label>Email</label>
                    <box-icon name='envelope' type='solid'></box-icon>
                </div>
                
                <div class="boite-saisie animation" style="--li:19; --S:3">
                    <input type="password" name="password" required>
                    <label>Mot de passe</label>
                    <box-icon name='lock-alt' type='solid'></box-icon>
                </div>

                <div class="boite-saisie animation" style="--li:19; --S:3">
                    <input type="password" name="password_confirmation" required>
                    <label>Confirmer le mot de passe</label>
                    <box-icon name='lock-alt' type='solid'></box-icon>
                </div>
                
                <div class="boite-saisie animation" style="--li:20; --S:4">
                    <button class="bouton" type="submit">S'inscrire</button>
                </div>
                
                <div class="lien-inscription animation" style="--li:21; --S:5">
    <p>Vous avez déjà un compte ? <br> 
    <a href="#" class="login-link">Se connecter</a>
    </p>
</div>
            </form>
        </div>
        
        <div class="contenu-info Inscription">
            <div class="logo animation" style="--li:16; --S:0">ALLSPORT</div>   
            <h2 class="animation" style="--li:17; --S:0">BIENVENUE !</h2>
            <p class="animation" style="--li:18; --S:1">Rejoignez la communauté AllSport et découvrez nos équipements de qualité.</p>
        </div>
    </div>
</body>
</html>