<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inscription - Étape 1 | VitaForme</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="/assets/css/register.css">
</head>
<body>

    <div class="login-container">
        <div class="login-card">
            <header class="login-header">
                <div class="logo">Vita<span>Forme</span></div>
                
                <div class="step-indicator">
                    <span class="step active">1</span>
                    <div class="line"></div>
                    <span class="step">2</span>
                </div>

                <h1>Créer un compte</h1>
                <p>Commencez par vos informations de base.</p>
            </header>

            <!-- On pointe vers le fichier de l'étape 2 -->
            <form action="register-step2.html" method="GET">
                <div class="input-row">
                    <div class="input-group">
                        <label for="nom">Nom</label>
                        <input type="text" id="nom" name="nom" placeholder="Nom" required>
                    </div>
                    <div class="input-group">
                        <label for="prenom">Prénom</label>
                        <input type="text" id="prenom" name="prenom" placeholder="Prénom" required>
                    </div>
                </div>

                <div class="input-group">
                    <label for="email">Email</label>
                    <input type="email" id="email" name="email" placeholder="nom@exemple.com" required>
                </div>

                <div class="input-group">
                    <label>Genre</label>
                    <div class="gender-selector">
                        <input type="radio" name="genre" id="homme" value="H" checked>
                        <label for="homme" class="gender-btn">Homme</label>
                        
                        <input type="radio" name="genre" id="femme" value="F">
                        <label for="femme" class="gender-btn">Femme</label>
                    </div>
                </div>

                <div class="input-group">
                    <label for="password">Mot de passe</label>
                    <input type="password" id="password" name="password" placeholder="••••••••" required>
                </div>

                <button type="submit" class="btn-login">Suivant : Profil Santé</button>
            </form>

            <footer class="login-footer">
                <p>Déjà inscrit ? <a href="login.html">Connectez-vous</a></p>
            </footer>
        </div>
        
        <div class="blob blob-1"></div>
        <div class="blob blob-2"></div>
    </div>

</body>
</html>