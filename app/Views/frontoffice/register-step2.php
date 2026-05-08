<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inscription - Étape 2 | VitalVibe</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="/assets/css/register.css">
</head>
<body>

    <div class="login-container">
        <div class="login-card">
            <header class="login-header">
                <div class="logo">Vital<span>Vibe</span></div>
                
                <div class="step-indicator">
                    <span class="step">1</span>
                    <div class="line active"></div>
                    <span class="step active">2</span>
                </div>

                <h1>Profil Santé</h1>
                <p>Ces données nous permettent de calculer vos besoins.</p>
            </header>

            <form action="dashboard.html" method="POST">
                <div class="input-group">
                    <label for="taille">Taille (cm)</label>
                    <input type="number" id="taille" name="taille" placeholder="Ex: 175" required>
                </div>

                <div class="input-group">
                    <label for="poids">Poids actuel (kg)</label>
                    <input type="number" id="poids" name="poids" placeholder="Ex: 70" required>
                </div>

                <button type="submit" class="btn-login">Terminer l'inscription</button>
                <a href="/register/1" class="btn-back-link">Retour à l'étape précédente</a>
            </form>
        </div>
        
        <div class="blob blob-1"></div>
        <div class="blob blob-2"></div>
    </div>

</body>
</html>